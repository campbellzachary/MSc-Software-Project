import sys
import nltk
import MySQLdb

#the training set for positive, neutral and negative was quickly created written to get the program working.
#the idea behind Guru clinic is that users will decide the faith of how sentiment analysis works and the overall hive mind will
#show what is the true positive, negative and neutral of sentiment

#retrieving all words in text
def retrieve_words_in_text(text):
    retrieve_all_words = []
    for (words, sentiment) in text:
      retrieve_all_words.extend(words)
    return retrieve_all_words

#retrieving all word features - this will return all
def retrieve_word_features(listofallwords):
    listofallwords = nltk.FreqDist(listofallwords)
    retrieve_word_features = listofallwords.keys()
    return retrieve_word_features

#function to read text from positive, negative and training sets
def read_texts(file_name, t_type):
    texts = []
    f = open(file_name, 'r')
    line = f.readline()
    while line != '':
        texts.append([line, t_type])
        line = f.readline()
    f.close()
    return texts

#read in positive, neutral and negative training tweets
positive_texts = read_texts('positive.txt', 'positive')
neutral_texts = read_texts('neutral.txt', 'neutral')
negative_texts = read_texts('negative.txt', 'negative')

#texts makes an array of words and sentiment from positive texts, neutral texts and negative texts.
#the first position in the array contains the word and the second position contains the type of sentiment.
#words with less than 2 characters are removed e.g. he, is
texts=[]
for(words,sentiment)in positive_texts+neutral_texts+negative_texts:
 words_filtered=[e.lower() for e in words.split() if len(e)>=3]
 texts.append((words_filtered,sentiment))

#word features looks at the unique words to extra from the text.
#it makes a list of every unique word and orders it by its frequency of appearance
individual_word_features = retrieve_word_features(retrieve_words_in_text(texts))

#preparing to extract feature from words
def extract_features(record):
    record_words = set(record)
    features = {}
    for word in individual_word_features:
      features['contains(%s)' % word] = (word in record_words)
    return features

#using nltk library to train set, test training set and implement classifier
training_set = nltk.apply_features(extract_features, texts)
classifier = nltk.classify.NaiveBayesClassifier.train(training_set)

#database for storing guru cat
#open database connection
db = MySQLdb.connect("localhost", "root", "", "Twitter")
db.set_character_set('utf8')
#prepare a cursor object using cursor() method
cursor = db.cursor()
#passing tweet argument to command line
tweet = sys.argv[1]
#assigning classifer output as result
result = classifier.classify(extract_features(tweet.split()))
#using cursor to execute and insert results into database
cursor.execute("""INSERT INTO GURUCAT(Text,Result) VALUES (%s, %s);""",(tweet,result))
cursor.execute("""INSERT INTO GURUCAT_History(Text,Result) VALUES (%s, %s);""",(tweet,result))
db.commit()

def main():
    #Check the command line arguments
    if not len(sys.argv) == 2:
        sys.exit()

#run the script
main(sys.argv[1])