<?php

#getting the total number of rows for the tweets history table
$result = mysqli_query($dbc, "SELECT * FROM tweets_history"); 
$num_rows = mysqli_num_rows($result);


#select query, count(*) from tweets group by query;
$allquery_piechart_history = mysqli_query($dbc,"SELECT query, count(*) as count FROM tweets_history group by query ");
      $query_piechart_history[] = "['Query', 'Count']";
      while ($r=mysqli_fetch_assoc($allquery_piechart_history))
      {
        $query = $r["query"];
        $count = $r['count'];
        $query_piechart_history[] = "['" .$query. "',".$count."]";
      }

#select query, count(*) from tweets group by query;
$piechartquery_history = mysqli_query($dbc,"SELECT sentiment, count FROM result_history ");
      $piechart_history[] = "['Sentiment', 'Count']";
      while ($r=mysqli_fetch_assoc($piechartquery_history))
      {
        $sentiment = $r["sentiment"];
        $count = $r['count'];
        $piechart_history[] = "['" .$sentiment. "',".$count."]";
      }

$countryquery_history = mysqli_query($dbc,"SELECT Location, Count FROM Location_History ");
      $countrychart_history[] = "['Location', 'Count']";
      while ($r=mysqli_fetch_assoc($countryquery_history))
      {
        $countrylocation = $r["Location"];
        $countrycount = $r['Count'];
        $countrychart_history[] = "['" .$countrylocation. "',".$countrycount."]";
      }

$barchartquery_history  = mysqli_query($dbc,"SELECT sentiment, count FROM result_history ");
      $barchart_history[] = "['Sentiment', 'Count', { role: 'style' }]";
      $colournew= array('#FF0000', '#FFA62F', '#31B404');
      $counter = 0;

      while ($r=mysqli_fetch_assoc($barchartquery_history))
      {

        $sentiment1 = $r["sentiment"];
        $count2 = $r['count'];
        $barchart_history[] = "['" .$sentiment1."',".$count2.",'".$colournew[$counter]."']";
        $counter++;
      }

$scartquery_history = mysqli_query($dbc,"SELECT Tweet_Number, Score FROM tweets_history ");
      $scartchart_history[] = "['Tweet_Number', 'Score']";
      while ($r=mysqli_fetch_assoc($scartquery_history))
      {
        $tweetnum = $r["Tweet_Number"];
        $score = $r['Score'];
        $scartchart_history[] = "[".$tweetnum. ",". $score."]";
      }
      
?>