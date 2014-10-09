<?php

$negative = mysqli_query($dbc, "SELECT COUNT(sentiment) FROM TWEETS WHERE SENTIMENT LIKE 'negative'");
while ($row=mysqli_fetch_array($negative))
{
    $neg_count=$row[0];
    mysqli_query($dbc, "INSERT INTO RESULT(sentiment, count) VALUES ('Negative', '$neg_count')");
    #echo 'negative';
    #echo $neg_count;
}

$neutral = mysqli_query($dbc, "SELECT COUNT(sentiment) FROM TWEETS WHERE SENTIMENT LIKE 'neutral'");
while ($row=mysqli_fetch_array($neutral))
{
    $neu_count=$row[0];
    mysqli_query($dbc, "INSERT INTO RESULT(sentiment, count) VALUES ('Neutral', '$neu_count')");
    #echo 'neutral';
    #echo $neu_count;
}

$position = mysqli_query($dbc, "SELECT COUNT(sentiment) FROM TWEETS WHERE SENTIMENT LIKE 'positive'");
while ($row=mysqli_fetch_array($position))
{
    $pos_count=$row[0];
    mysqli_query($dbc, "INSERT INTO RESULT(sentiment, count) VALUES ('Positive', '$pos_count')");
    #echo 'positive';
    #echo $pos_count;
}

$negative_history = mysqli_query($dbc, "SELECT COUNT(sentiment) FROM TWEETS_HISTORY WHERE SENTIMENT LIKE 'negative'");
while ($row=mysqli_fetch_array($negative_history))
{
    $neg_count=$row[0];
    mysqli_query($dbc, "INSERT INTO RESULT_HISTORY(sentiment, count) VALUES ('Negative', '$neg_count')");
    #echo 'negative';
    #echo $neg_count;
}

$neutral_history = mysqli_query($dbc, "SELECT COUNT(sentiment) FROM TWEETS_HISTORY WHERE SENTIMENT LIKE 'neutral'");
while ($row=mysqli_fetch_array($neutral_history))
{
    $neu_count=$row[0];
    mysqli_query($dbc, "INSERT INTO RESULT_HISTORY(sentiment, count) VALUES ('Neutral', '$neu_count')");
    #echo 'neutral';
    #echo $neu_count;
}

$position_history= mysqli_query($dbc, "SELECT COUNT(sentiment) FROM TWEETS_HISTORY WHERE SENTIMENT LIKE 'positive'");
while ($row=mysqli_fetch_array($position_history))
{
    $pos_count=$row[0];
    mysqli_query($dbc, "INSERT INTO RESULT_HISTORY(sentiment, count) VALUES ('Positive', '$pos_count')");
    #echo 'positive';
    #echo $pos_count;
}

$location = "INSERT INTO Location (location, count)
                   SELECT t.Location, Count(*) FROM TWEETS t
                LEFT JOIN Location l 
                       ON t.location = l.Location
                    WHERE l.Location is null
                 GROUP BY t.Location";

$location_history = "INSERT INTO Location_history (location, count)
                   SELECT t.Location, Count(*) FROM tweets_history t
                LEFT JOIN Location l 
                       ON t.location = l.Location
                    WHERE l.Location is null
                 GROUP BY t.Location";

mysqli_query($dbc, $location);
mysqli_query($dbc, $location_history);


?>