<!DOCTYPE html>
<!-- saved from url=(0060)http://getbootstrap.com/examples/sticky-footer-navbar/#about -->
<html lang="en" data-minimalscrollbar="yes"><style>html::-webkit-scrollbar{display:none !important}body::-webkit-scrollbar{display:none !important}</style><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="title" content="Mood Guru"/>
    <meta name="keywords" content="Twitter, Sentiment Analysis, Data, Data Anlaysis, University College Dublin, Computer Science"/>
    <meta name="description" content="Mood Guru - Twitter Sentiment Analysis Software"/>
    <meta name="revisit-after" content="30 days"/>
    <meta name="author" content="Zachary Campbell"/>
    <meta name="language" content="en"/>
    <meta name="robot" content="all,index"/>


    <title>Guru Clinic</title>

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
    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand">Mood Guru</a>
        </div>
        <div class="navbar-header">
          <ul class="nav navbar-nav">
          <ul class="nav navbar-nav">

            <li><a href="index.php">Search for Tweets</a></li>
            <li><a href="./pages/history.php">Twitter History</a></li>
            <li><a href="./pages/about.php">About this Project</a></li>
            <li class="active"><a href="guru_clinic1.php">Guru Clinic</a></li>
            <li><a href="./pages/feedback.php">Feedback for Guru Clinic</a></li>

          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    <!-- End Navbar -->

    <!-- Begin page content -->
    <div class="container">
      <div class="page-header" style="text-align: center;">
        <h1>Welcome to the Guru Clinic!</h1>
        <h3>My name is Guru Cat and I'm here to help you find out the sentiments of your tweets.</h3>
        <h3>Are your tweets <font color="#31B404">positive</font>, <font color="#FF0000">negative</font> or <font color="#FFA62F">neutral</font>?</h3>
      </div>
      <!-- End heading -->
    
    <div class="form-group">
    <form method="post" action="guru_clinic2.php">
    <center> <img src="./images/doctor_cat.gif" alt="doctor cat" width="auto" height="200"> </center>
    <h3 style="text-align: center">

    <Code> Guru Cat is in beta and only processes text at this time. Coming soon hashtags and smilies!</Code>
    <Code> Guru Cat becomes smarter based on your feedback. If you aren't happy with the result please fill out the <a href=/twitter/pages/feedback.php>feedback form.</a></Code>

    <h3 style="text-align: center">Enter Text: <input type="text" name="query"> </h3>
    </div>
    <br>
    <div>
    <input style="margin: 0 auto; width: 200px;" class="btn btn-primary btn-block" type="submit" value="Find out your mood!" />
    <br></br>
    </div>
    </form>
    </div>
    
    <h4 style="text-align: center;"> Powered by:
    </h4>
    <h4 style="text-align: center;">
    <img src="./images/nltk_logo.png" alt="Natural Language Training Kit" width="auto" height="50"> 
    </h4>

    <div class="footer">
        
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