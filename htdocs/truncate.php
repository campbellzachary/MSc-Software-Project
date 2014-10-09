<?php

#phpmyadmin truncate tables
#TRUNCATE TABLE feedback;
#TRUNCATE TABLE gurucat;
#TRUNCATE TABLE gurucat_history;
#TRUNCATE TABLE location;
#TRUNCATE TABLE location_history;
#TRUNCATE TABLE result;
#TRUNCATE TABLE result_history;
#TRUNCATE TABLE tweets;
#TRUNCATE TABLE tweets_history;

mysqli_query($dbc,"TRUNCATE `TWEETS`");
mysqli_query($dbc,"TRUNCATE `RESULT`");
mysqli_query($dbc,"TRUNCATE `RESULT_HISTORY`");
mysqli_query($dbc,"TRUNCATE `LOCATION`");
mysqli_query($dbc,"TRUNCATE `LOCATION_HISTORY`");
?>