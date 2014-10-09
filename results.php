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

    <title>Mood Guru Results</title>

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
  <!-- truncating tables -->
  <?php require_once './htdocs/truncate.php'; ?>
  <!-- accessing the analyse.py file -->
  <?php require_once './htdocs/command_line.php'; ?>
  <!-- implementing sql statements -->
  <?php require_once './htdocs/sql_statements.php'; ?>
  <!-- sql chart queries -->
  <?php require_once './htdocs/chart_query.php'; ?>

     <body style="">
    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand">Mood Guru</a>
        </div>
        <div class="navbar-header">
          <ul class="nav navbar-nav">
            <li><a href="./index.php">Return to Search</a></li>
            <li class="active"><a href="./index.php">Tweet Results for "<?php echo $_POST["query"]?>"</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <!-- Begin page content -->
<div class="container">
      <div class="page-header" style="text-align: center;">

      <h1>Sentiment results for <b>"<?php echo $_POST["query"]?>"</b></h1>
      <h3>Tweet Sample Size: <b><?php echo $_POST["num"]?></b></h3>
      </div>
      </div>

      <div class="container">
      <h3 style="text-align: center">Breakdown of Sentiment - Scart Chart<br></br> Plotting the Distribution of Positive, Negative and Neutral Tweets</h3>
      <div id="scatter_chart" style="width: auto; height: 300px;"></div>
      </div>
       </div>

      <div class="container">
      <div class="row">
        <div class="col-xs-6">

        <h3 style="text-align: center">Breakdown of Sentiment - Pie Chart <br></br> Qualitative Analysis</h3>
        <div id="piechart_3d" style="width: auto; height: 300px;"></div>

        </div>
        <div class="col-xs-6">
        <h3 style="text-align: center">Breakdown of Sentiment - Bar Chart <br></br> Quantitative Analysis</h3>
        <div id="barchart" style="width: auto; height: 300px;"></div>
        </div>
    </div>
</div>

<div class="container">
      <div class="row">
        <div class="col-xs-6">
        <h3 style="text-align: center">Geographical Breakdown - Donut chart</h3>
        <div id="donutchart" style="width: auto; height: 300px;"></div>
        </div>
        
        <div class="col-xs-6">

        <h3 style="text-align: center">Geographical Breakdown - World Map</h3>
        <div id="world_map" style="width: auto; height: 300px;"></div> 
        
        </div>
    </div>
</div>

<div class="container">
    <h3 style="text-align: center">Table of Tweets Retrieved</h3>
    <div id="table_div" style="width: auto; height: 300px;"></div>
</div>

<?php
    $tablequery = mysqli_query($dbc,'SELECT handle, t_text, t_timestamp,location, sentiment, score FROM tweets');
    $tablechart = array();

    // using mysqli_fetch_row to get indexed array
    while ($r = mysqli_fetch_row($tablequery)) {
        $tablechart[] = $r;
    }
?>

<script>
    (function (scope, tablechart) {
        'use strict';

        var document = scope.document,
            google = scope.google;

        google.load('visualization', '1', {
            packages: ['table']
        });

        google.setOnLoadCallback(function () {
            var data = new google.visualization.DataTable(),
                table = new google.visualization.Table(document.getElementById('table_div'));

            data.addColumn('string', 'User');
            data.addColumn('string', 'Text');
            data.addColumn('string', 'Timestamp');
            data.addColumn('string', 'Location');
            data.addColumn('string', 'Sentiment');
            data.addColumn('string', 'Score');

            data.addRows(tablechart);

            table.draw(data, {
                showRowNumber: true
            });
        });
    }(
        this,
        <?= json_encode($tablechart) ?>
    ));
</script>

<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
         <?php echo(implode(",",$piechart));?>
        ]);

        var options = {
          backgroundColor: '#E8E8E8',
          colors: ['#FF0000', '#FFA62F', '#31B404'],
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
</script>

<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
        <?php echo(implode(",",$barchart));?>
        ]);

        var options = {
          backgroundColor: '#E8E8E8',
          legend: {position: 'none'}
          
        };

        var chart = new google.visualization.BarChart(document.getElementById('barchart'));

        chart.draw(data, options);
      }
    </script>

    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
        <?php echo(implode(",",$countrychart));?>
        ]);

        var options = {
          title: '',
          backgroundColor: '#98AFC7',
          pieHole: 0.5,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>

<script type="text/javascript">
      google.load("visualization", "1", {packages:["geochart"]});
      google.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {

        var data = google.visualization.arrayToDataTable([
          <?php echo(implode(",",$countrychart));?>
        ]);

        var options = { 
          backgroundColor: '#98AFC7',
          colorAxis: {colors: ['#254117', 'blue']}, 
          legend: 'none',
        };

        options['dataMode'] = 'regions';

        var chart = new google.visualization.GeoChart(document.getElementById('world_map'));

        chart.draw(data, options);
      }
    </script>

    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
        <?php echo(implode(",",$scartchart));?>
        ]);

        var options = {
          colors: ['blue'],
          hAxis: {title: ' Tweet Number', minValue: 1, maxValue: 10},
          vAxis: {title: 'Sentiment Value', minValue: -1, maxValue: 1},
          backgroundColor: '#E8E8E8',
          legend: {position: 'none'}
        };

        var chart = new google.visualization.ScatterChart(document.getElementById('scatter_chart'));

        chart.draw(data, options);
      }

      </script>

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