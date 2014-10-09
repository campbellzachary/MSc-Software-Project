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

    <title>Mood Guru History</title>

    <!-- Bootstrap core CSS -->
    <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="http://getbootstrap.com/examples/sticky-footer-navbar/sticky-footer-navbar.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="./Sticky Footer Navbar Template for Bootstrap_files/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  <style type="text/css"></style></head>

  <body style="">

  <!-- connecting the database -->
  <?php require_once '../htdocs/connect_db.php'; ?>
  <!-- truncating tables -->
  <?php require_once '../htdocs/truncate.php'; ?>
  <!-- implementing sql statements -->
  <?php require_once '../htdocs/sql_statements.php'; ?>
  <!-- sql chart queries -->
  <?php require_once '../htdocs/chart_query_history.php'; ?>

    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand">Mood Guru</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="../index.php">Search for Tweets</a></li>
            <li class="active"><a href="./history.php">Twitter History</a></li>
            <li><a href="./about.php">About this Project</a></li>
            <li><a href="../guru_clinic1.php">Guru Clinic</a></li>
            <li><a href="./feedback.php">Feedback for Guru Clinic</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <!-- Begin page content -->
<div class="container">
      <div class="page-header" style="text-align: center;">
        <h1>Twitter History</h1>

<?php 
$result = mysqli_query($dbc, "SELECT * FROM tweets_history"); 
$num_rows = mysqli_num_rows($result);
?>

      <h3>Total Tweets Collected: <b><?php echo $num_rows ?></b></h3>
      <h4>
      <?php 
  echo "<h3> <table border='1' align='center'>
  <th>Sentiment</th>
  <th>Score</th>
  </tr>";

  $result = mysqli_query($dbc,"SELECT * FROM result_history");
        while($row = mysqli_fetch_array($result)) {

        $color=null;
        if($row['sentiment']=='positive') {
        $color='#31B404';
        }

        else if ($row['sentiment']=='negative') {
        $color='#FF0000';
        }

        else if ($row['sentiment']=='neutral') {
        $color='#FFA62F';
        }

  echo "<tr style ='text-align: center'; id style=".$color.">";
  echo "<td>" . $row['sentiment'] . "</td>";
  echo "<td>" . $row['count'] . "</td>";

    }

    echo "<h3></table>";
?>
</div>

      </div>
      <div class="container">
      <h3 style="text-align: center">All Queries Entered into the Database</h3>
      <div id="all_query_piechart" style="width: auto; height: 300px;"></div>
      </div>
       </div>

   <!--   </div>
      <div class="container">
      <h3 style="text-align: center">Total Sentiment for Days of the Week</h3>
      <div id="all_query_piechart" style="width: auto; height: 300px;"></div>
      </div>
       </div> -->


      <div class="container">
      <h3 style="text-align: center">Total Collected Breakdown of Sentiment - Scart Chart<br></br> Plotting the Distribution of Positive, Negative and Neutral Tweets</h3>
      <div id="scatter_chart_history" style="width: auto; height: 300px;"></div>
      </div>
       </div>

      <div class="container">
      <div class="row">
        <div class="col-xs-6">

        <h3 style="text-align: center">Total Collected Breakdown of Sentiment - Pie Chart <br></br> Qualitative Analysis</h3>
        <div id="piechart_3d_history" style="width: auto; height: 300px;"></div>

        </div>
        <div class="col-xs-6">
        <h3 style="text-align: center">Total Collected Breakdown of Sentiment - Bar Chart <br></br> Quantitative Analysis</h3>
        <div id="barchart_history" style="width: auto; height: 300px;"></div>
        </div>
    </div>
</div>

<div class="container">
      <div class="row">
        <div class="col-xs-6">
        <h3 style="text-align: center">Total Collected Geographical Breakdown - Donut chart</h3>
        <div id="donutchart_history" style="width: auto; height: 300px;"></div>
        </div>
        
        <div class="col-xs-6">

        <h3 style="text-align: center">Total Collected Geographical Breakdown - World Map</h3>
        <div id="world_map_history" style="width: auto; height: 300px;"></div> 
        
        </div>
    </div>
</div>

<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
         <?php echo(implode(",",$query_piechart_history));?>
        ]);

        var options = {
          backgroundColor: '#E8E8E8',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('all_query_piechart'));
        chart.draw(data, options);
      }
</script>

<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
         <?php echo(implode(",",$query_piechart_history));?>
        ]);

        var options = {
          backgroundColor: '#E8E8E8',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('query_weekdays'));
        chart.draw(data, options);
      }
</script>

<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
         <?php echo(implode(",",$piechart_history));?>
        ]);

        var options = {
          backgroundColor: '#E8E8E8',
          colors: ['#FF0000', '#FFA62F', '#31B404'],
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d_history'));
        chart.draw(data, options);
      }
</script>

<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
        <?php echo(implode(",",$barchart_history));?>
        ]);

        var options = {
          backgroundColor: '#E8E8E8',
          legend: {position: 'none'}
          
        };

        var chart = new google.visualization.BarChart(document.getElementById('barchart_history'));

        chart.draw(data, options);
      }
    </script>

    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
        <?php echo(implode(",",$countrychart_history));?>
        ]);

        var options = {
          title: '',
          backgroundColor: '#98AFC7',
          pieHole: 0.5,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart_history'));
        chart.draw(data, options);
      }
    </script>

<script type="text/javascript">
      google.load("visualization", "1", {packages:["geochart"]});
      google.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {

        var data = google.visualization.arrayToDataTable([
          <?php echo(implode(",",$countrychart_history));?>
        ]);

        var options = { 
          backgroundColor: '#98AFC7',
          colorAxis: {colors: ['#254117', 'blue']}, 
          legend: 'none',
        };

        options['dataMode'] = 'regions';

        var chart = new google.visualization.GeoChart(document.getElementById('world_map_history'));

        chart.draw(data, options);
      }
    </script>

    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
        <?php echo(implode(",",$scartchart_history));?>
        ]);

        var options = {
          colors: ['purple'],
          hAxis: {title: ' Tweet Number', minValue: 1, maxValue: 10},
          vAxis: {title: 'Sentiment Value', minValue: -1, maxValue: 1},
          backgroundColor: '#E8E8E8',
          legend: {position: 'none'}
        };

        var chart = new google.visualization.ScatterChart(document.getElementById('scatter_chart_history'));

        chart.draw(data, options);
      }

      </script>
    
    <h2 style = "text-align: center"><br></br><a href="index.php">Click to return to main page</a><br></br> </h2>
        
    </div>

    <div class="footer">
    <p class="text-muted" style="text-align: center;"><a href="http://www.zacharycampbell.ie/"> Created by Zachary Campbell - Computer Science Student @ University College Dublin 2014</a></p>
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