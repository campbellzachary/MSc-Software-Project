#Alchemy api analyse file created using the following tutorial link, alchemy github and modification of analyse.py file
#http://www.alchemyapi.com/developers/getting-started-guide/using-alchemyapi-with-python/
#https://github.com/AlchemyAPI/alchemyapi-twitter-python
#https://github.com/AlchemyAPI/alchemyapi-twitter-python/blob/master/analyze.py

import sys
import json
import config
import base64
import urllib2
import urllib
import time
import MySQLdb
from alchemyapi import AlchemyAPI

#Connect with the Twitter API and make a request for the OAuth access token.
#Once verified the token will be used to authorise the Twitter API search.

def oauth():

    #INPUT:
    #config.consumer_key -> the Twitter API consumer key, stored in config.py
    #config.consumer_secret -> the Twitter API consumer secret, stored in config.py

    #OUTPUT:
    #auth.access_token -> the token
    #auth.token_type -> the type of token (i.e. bearer)

    try:
        #Read in consumer key and consumer secret key for twitter authentifcation
        consumer_key = config.consumer_key
        consumer_secret = config.consumer_secret

        #Encode the credentials & setup the request
        encoded = base64.b64encode(consumer_key + ':' + consumer_secret)
        url = 'https://api.twitter.com/oauth2/token'
        params = { 'grant_type':'client_credentials' }
        headers = { 'Authorization':'Basic ' + encoded }

        #Create the request and hit the Twitter API
        request = urllib2.Request(url, urllib.urlencode(params), headers)
        response = json.loads(urllib2.urlopen(request).read())

        #Save the token
        auth = {}
        auth['access_token'] = response['access_token']
        auth['token_type'] = response['token_type']

        return auth
    except Exception as e:
        sys.exit()

# The auth token is now used with the specified query and attempts to return the requested number of tweets.
# If the requested number of tweets is not found the program will crash. This happens on a rare occasion.
# The Twitter response data contains multiple fields and returns the filtered data to only return the fields specified in
# the code.

#Tweets defined as 'RT' are ignored.

def search(auth, query, number_of_tweets):

    #INPUT:
    #	auth -> the authentication token and token type from the OAuth process
    #	query -> the query to search Twitter for (i.e. "Denver Broncos")
    #	number_of_tweets -> the number of tweets to attempt to gather

    #OUTPUT:
    #	tweets -> an array of tweets containing the filtered field set

    #Create the search request
    url = 'https://api.twitter.com/1.1/search/tweets.json'
    headers = { 'Authorization': auth['token_type'] + ' ' + auth['access_token'] }
    tweets = []
    MAX_PAGE_SIZE = 100
    counter = 0
    next_results = ''

    #Keep getting more data until the number of tweets have been collected
    while True:
        count = max(MAX_PAGE_SIZE, int(number_of_tweets) - counter)

        #Create the request
        if next_results:
            request = urllib2.Request(url + next_results, headers=headers)
        else:
            params = { 'q':query, 'lang':'en','count':count }
            request = urllib2.Request(url + '?' + urllib.urlencode(params), headers=headers)

        #Hit the Twitter API
        data = json.loads(urllib2.urlopen(request).read())

        #Scan through the Tweets and save the important information
        for status in data['statuses']:
            text=status['text'].encode('utf-8')

        #Ignore retweets (RT at start of text)
            if text.find('RT') != 0:
                #Save important info to be used inserted into database
                tweet = {}
                tweet['id_str'] = status['id_str']
                tweet['text'] = text
                tweet['location'] = status['user']['location']

                if status['place']:
                    tweet['location'] = status['place']['country']
                else:
                    tweet['location'] = 'Country Unavailable'

                tweet['screen_name'] = status['user']['screen_name']
                tweet['created_at'] = status['user']['created_at']
                tweet['time'] = time.strptime(status['created_at'], '%a %b %d %H:%M:%S +0000 %Y')
                tweet['date'] = time.strftime('%Y-%m-%d', tweet['time'])
                tweet['timeofday'] = time.strftime('%H:%M:%S', tweet['time'])
                tweets.append(tweet)
                counter += 1

            #Alchemy returned 5 tweets short for some reason, this addition of 5 solves the problem
            if counter >= number_of_tweets + 5:
                return tweets

        #Setup the next iteration
        if 'next_results' in data['search_metadata']:
            next_results = data['search_metadata']['next_results']

        #This is means the program will break when the number of tweets entered the count entered
        if counter == number_of_tweets:
            break;
            #If next_results is not present, it means Twitter has no more data for us, so move on
            #print 'Sorry, I could only find %d Tweets instead of %d' % (counter, number_of_tweets)
            return tweets

#The process function uses a worker thread to grab a found tweet of the queue and calculate the
#Sentiment via the AlchemyAPI.

#Sentiment is calculated at document level for the entire tweet.
def process(in_queue, out_queue):

    #INPUT:
	#query -> the query string that was used in the Twitter API search (i.e. "Denver Broncos")
	#in_queue -> the shared input queue that is filled with the found tweets.
	#out_queue -> the shared output queue that is filled with the analyzed tweets.

	#OUTPUT:
	#None

    #Create the alchemy api object
    alchemyapi = AlchemyAPI()

    while True:
        #Grab a tweet from the queue
        tweet = in_queue.get()
        #Initilise
        tweet['sentiment'] = {}

        try:
            #Calculate the sentiment for the entire tweet
            response = alchemyapi.sentiment('text',tweet['text'])

            #Add the score if its not returned neutral
            if response['status'] == 'OK':
                tweet['sentiment']['doc'] = {}
                tweet['sentiment']['doc']['type'] = response['docSentiment']['type']

                if 'score' in response['docSentiment']:
                    tweet['sentiment']['doc']['score'] = response['docSentiment']['score']
                else:
                    tweet['sentiment']['doc']['score'] = 0

            #Add the result to the output queue
            out_queue.put(tweet)

        except Exception as e:
            #If there's an error, just move on to the next item in the queue
            print 'Error ', e
            pass

        #Signal that the task is finished
        in_queue.task_done()

#Analyse spawns the thread pool and watches the number of threads to finish the process of inputs into the queue.
#Once complete it then unloads the output queue into an array and passes it on for further processing.

#The number of threads is set to concurrency_limit, which is the maximum number of concurrent
#processed allowed by Alchemy API (in the free plan for students)
def analyze(tweets):

    #INPUT:
	#tweets -> an array containing the tweets to analyze.
	#query -> the query string that was used in the Twitter API search (i.e. "Denver Broncos")

	#OUTPUT:
	#tweets -> an array containing the analyzed tweets

    import Queue
    import threading

    #Number of parallel threads to run to hit AlchemyAPI concurrently (higher is faster, the limit depends on your plan)
    CONCURRENCY_LIMIT = 5

    #Initialise
    in_queue = Queue.Queue()
    out_queue = Queue.Queue()

    #Load up the in_queue
    for tweet in tweets:
        in_queue.put(tweet)

    #Spawn and start the threads
    threads = []
    for x in xrange(CONCURRENCY_LIMIT):
        t = threading.Thread(target=process, args=( in_queue, out_queue))
        t.daemon = True
        threads.append(t)
        t.start()

    #Wait until the input queue is empty
    while True:
        #Check if the queue has been emptied out
        if in_queue.empty():
            break
        #Check if the threads are still alive
        check = False
        for t in threads:
            if t.isAlive():
                check = True
                break

        if not check:
            #All threads have died, so quit
            break
    #Pull the data off the out_queue
    output = []
    while not out_queue.empty():
        output.append(out_queue._get())
    #Return the tweets with the appended data
    return output

#Connect to the mysql database on phpMyAdmin
def output(tweets):

    #database location, user, password, databasename
    db = MySQLdb.connect("localhost", "root", "", "Twitter")    # Open database connection
    db.set_character_set('utf8')

    #Prepare a cursor object using cursor() method
    cursor = db.cursor()

    #If system arguments is equal to zero exit
    if len(tweets) == 0:
        sys.exit()

    #Record the two inputs from user to be passed into the code
    for tweet in tweets:

        query = sys.argv[1]
        input = sys.argv[2]

        #Cursor inserting data into the tweets table
        cursor.execute("""INSERT INTO TWEETS(Query,Input, TweetID, Handle,T_TimeStamp, T_Text, T_Date, T_Time, Sentiment, Score, Location) VALUES
                (%s, %s,%s,%s, %s, %s, %s, %s, %s,%s, %s);""",
                     (query,
                      input,
                      tweet['id_str'],
                      tweet['screen_name'],
                      tweet['created_at'],
                      tweet['text'],
                      tweet['date'],
                      tweet['timeofday'],
                      tweet['sentiment']['doc']['type'],
                      tweet['sentiment']['doc']['score'],
                      tweet['location'],
                     ))

        #Cursor inserting data into the tweets history table
        cursor.execute("""INSERT INTO TWEETS_HISTORY(Query,Input, TweetID, Handle,T_TimeStamp, T_Date, T_Time, Sentiment, Score, Location) VALUES
                (%s, %s,%s,%s, %s, %s, %s, %s,%s, %s);""",
                     (query,
                      input,
                      tweet['id_str'],
                      tweet['screen_name'],
                      tweet['created_at'],
                      tweet['date'],
                      tweet['timeofday'],
                      tweet['sentiment']['doc']['type'],
                      tweet['sentiment']['doc']['score'],
                      tweet['location'],
                     ))
    db.commit()

#The main script that calls each of the functions needed
def main(query, count):

#INPUT:
#query is the string to search the Twitter API
#count is the number of Tweets to attempt to gather from the Twitter API

#OUTPUT:
 #None
    #print 'Main Function is about to begin'
    auth = oauth()
    #print 'Authorisation succeeded <br></br>'
    tweets = search(auth, query, count)
    #print "Tweets found <br></br>"
    tweets = analyze(tweets)
    #print "Tweets analysed <br></br>"
    output(tweets)
    #print "Tweets stored in database"

#Check the command line arguments
if not len(sys.argv) == 3:
    sys.exit()

#Run the script
main(sys.argv[1], int(sys.argv[2]))

