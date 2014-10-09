<!DOCTYPE html>
<!-- saved from url=(0060)http://getbootstrap.com/examples/sticky-footer-navbar/#about -->
<html lang="en" data-minimalscrollbar="yes"><style>html::-webkit-scrollbar{display:none !important}body::-webkit-scrollbar{display:none !important}</style><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <head>
    <!-- Google Script (Load the AJAX API)-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

    <meta name="title" content="Mood Guru"/>
    <meta name="keywords" content="Twitter, Sentiment Analysis, Data, Data Anlaysis, University College Dublin, Computer Science"/>
    <meta name="description" content="Mood Guru - Twitter Sentiment Analysis Software"/>
    <meta name="revisit-after" content="30 days"/>
    <meta name="author" content="Zachary Campbell"/>
    <meta name="language" content="en"/>
    <meta name="robot" content="all,index"/>

    <title>Guru Clinic Results</title>

    <!-- Bootstrap core CSS -->
    <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="http://getbootstrap.com/examples/sticky-footer-navbar/sticky-footer-navbar.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="./Sticky Footer Navbar Template for Bootstrap_files/ie-emulation-modes-warning.js"></script>
    <!-- END Additional Styles/Scripts -->
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  <style type="text/css"></style>
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  </head>

<body style="">
<!-- connecting the database -->
  <?php require_once './htdocs/connect_db.php'; ?>
<!-- truncate table -->
  <?php mysqli_query($dbc,"TRUNCATE `gurucat`"); ?>

<!-- accessing the analyse.py file -->
  <?php require_once './htdocs/command_line_nltk.php'; ?>
  
    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand">Mood Guru</a>
        </div>
        <div class="navbar-header">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Return to HomePage</a></li>
            <li class="active"><a href="guru_clinic1.php">Guru Clinic Results</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

<!-- Begin page content -->
    <div class="container">
      <div class="page-header" style="text-align: center;">
        <h1>Guru Clinic Results</h1>

        <h2 style="text-align: center;">Is your text 
        <font color="#31B404">positive</font>, 
        <font color="#FF0000">negative</font> or 
        <font color="#FFA62F">neutral</font>?</h2>
        
      </div>

      <div class="container">

      <center> <img src="./images/cat.jpg" alt="doctor cat" width="auto" height="350"> </center>
<?php

$result = mysqli_query($dbc,"SELECT * FROM gurucat");
while($row = mysqli_fetch_array($result)) {

        $color=null;
        if($row['result']=='positive') {
        $color='#31B404';
        }

        else if ($row['result']=='negative') {
        $color='#FF0000';
        }

        else if ($row['result']=='neutral') {
        $color='#FFA62F';
        }

    echo "<h2><center>Text entered for analysis: '". $row['text'] . "'</center></h2>";
    echo "<h2><center>Guru Cat believes this text is: <font color=".$color."> ". $row['result']. "</font></center></h2>";

    }

    echo "</table>";
    ?>
      </div>

    <!-- Begin page content -->

<div class="container">
        <h1>Is Guru cat right?</h1>

        <h2>Guru cat uses a library called "Natural Language processing Kit" (NLTK). From this library a classifier is created in order to automatically classify if a piece of text is positive/negative/neutral.</h2>

        <h2>Guru cat is constantly training himself to become better at classifying text. If you believe your text was assigned the wrong sentiment please fill out the <a href=/twitter/pages/feedback.php> feedback form</a>.</h2>

        <h2>By using your sentiment the classifier will become more accurate but no classifier can
        ever predict all sentiments correctly. </h2>

</div>
</div>

    <h2 style = "text-align: center"><br></br><a href="index.php">Click to return to main page</a><br></br> </h2>

</div>
    
    <div class="footer">
    <p class="text-muted" title = "Link to www.zacharycampbell.ie" style="text-align: center;"><a href="http://www.zacharycampbell.ie/"> Created by Zachary Campbell - Computer Science Student @ University College Dublin 2014</a></p>
    </div>
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./Sticky Footer Navbar Template for Bootstrap_files/jquery.min.js"></script>
    <script src="./Sticky Footer Navbar Template for Bootstrap_files/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="./Sticky Footer Navbar Template for Bootstrap_files/ie10-viewport-bug-workaround.js"></script>
  
    <div id="scrollrail-vertical" class="disabled" style="width: 12px; border-left-width: 1px;">
    <div id="scrollbar-vertical" style="visibility: visible; border-top-left-radius: 5px 7px; border-top-right-radius:
    5px 7px; border-bottom-right-radius: 5px 7px; border-bottom-left-radius: 5px 7px; -webkit-box-shadow: rgba(255, 255, 255, 0.901961)
    0px 0px 1px 1px; height: 908px; top: 2px;"></div></div><div id="scrollrail-horizontal" class="disabled" style="height: 12px;
    border-top-width: 1px;"><div id="scrollbar-horizontal" style="visibility: visible;
    border-top-left-radius: 14px 10px; border-top-right-radius: 14px 10px;
    border-bottom-right-radius: 14px 10px; border-bottom-left-radius: 14px 10px;
    -webkit-box-shadow: rgba(255, 255, 255, 0.901961) 0px 0px 1px 1px; width: 1916px; left: 2px;"></div></div></body></html>