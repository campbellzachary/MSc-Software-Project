<?php 

$piechartquery = mysqli_query($dbc,"SELECT sentiment, count FROM result ");
      $piechart[] = "['Sentiment', 'Count']";
      while ($r=mysqli_fetch_assoc($piechartquery))
      {
        $sentiment = $r["sentiment"];
        $count = $r['count'];
        $piechart[] = "['" .$sentiment. "',".$count."]";
      }

$countryquery = mysqli_query($dbc,"SELECT Location, Count FROM Location ");
      $countrychart[] = "['Location', 'Count']";
      while ($r=mysqli_fetch_assoc($countryquery))
      {
        $countrylocation = $r["Location"];
        $countrycount = $r['Count'];
        $countrychart[] = "['" .$countrylocation. "',".$countrycount."]";
      }

$barchartquery  = mysqli_query($dbc,"SELECT sentiment, count FROM result ");
      $barchart[] = "['Sentiment', 'Count', { role: 'style' }]";
      $colournew= array('#FF0000', '#FFA62F', '#31B404');
      $counter = 0;

      while ($r=mysqli_fetch_assoc($barchartquery))
      {

        $sentiment1 = $r["sentiment"];
        $count2 = $r['count'];
        $barchart[] = "['" .$sentiment1."',".$count2.",'".$colournew[$counter]."']";
        $counter++;
      }

$scartquery = mysqli_query($dbc,"SELECT Tweet_Number, Score FROM tweets ");
      $scartchart[] = "['Tweet_Number', 'Score']";
      while ($r=mysqli_fetch_assoc($scartquery))
      {
        $tweetnum = $r["Tweet_Number"];
        $score = $r['Score'];
        $scartchart[] = "[".$tweetnum. ",". $score."]";
      }
      
?>