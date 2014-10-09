<?php
$page_title = 'Contact Us' ;
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) 
	{
	require ( 'connect_db.php' );
    $errors = array() ;
	
	if ( empty( $_POST[ 'name' ] ) ) {
    $errors[] = 'Enter your name.';} 
	else 
	{$name = mysqli_real_escape_string($dbc, trim( $_POST[ 'name' ] ) );}
	
	if ( empty( $_POST[ 'email' ] ) ) {
    $errors[] = 'Enter your email address.';} 
	else 
	{$email = mysqli_real_escape_string($dbc, trim( $_POST[ 'email' ] ) );}
	
	if ( empty( $_POST[ 'gc_text_entered' ] ) ) {
    $errors[] = 'Enter the text you entered into Guru Clinic.';} 
	else 
	{$text = mysqli_real_escape_string($dbc, trim( $_POST[ 'gc_text_entered' ] ) );}

	if ( empty( $_POST[ 'gc_sentiment_entered' ] ) ) {
    $errors[] = 'Select the correct result received for your text from Guru Clinic.';} 
	else 
	{$text2 = mysqli_real_escape_string($dbc, trim( $_POST[ 'gc_sentiment_entered' ] ) );}
	
	if ( empty( $_POST[ 'gc_sentiment_correct_entered' ] ) ) {
    $errors[] = 'Select the correct sentiment value for the text.';} 
	else 
	{$text3 = mysqli_real_escape_string($dbc, trim( $_POST[ 'gc_sentiment_correct_entered' ] ) );}
	  
	if ( empty( $errors ) ) 
	 {
        $q = "INSERT INTO feedback
		(name, email, gc_text_entered, gc_sentiment_entered, gc_sentiment_correct_entered, feedback_date)
		 VALUES ('$name','$email','$text','$text2','$text3',NOW())";
        $r = mysqli_query ( $dbc , $q );
		
     if ( $r ) 
	 {
            echo '<h1>Submitted!</h1>'
                .'<p>Your comment has been submitted!</p>'
                .'<div id="maincontent>"><p>We will get back to you as soon as possible!</p></div>';
     }
	 
	 mysqli_close( $dbc ) ;
    	#exit();
	} 
	
	else 
	{
    echo '<h1>Error!</h1>
    <p id="err_msg">The following error(s) occurred:<br>';
    foreach ( $errors as $msg ) 
	{
        echo " - $msg<br>";
    }
    echo 'Please try again.</p>';
    mysqli_close( $dbc );	
	}
	}?>