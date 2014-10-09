<?php 
// escape variables for security
// adding queries into query table
$command_line = "C:\Python27\python.exe analyze_alchemy.py \"". $_POST["query"]."\" ". $_POST["num"];
$port_id = popen( $command_line,"r");
while( !feof( $port_id ) )
{
 echo fread($port_id, 256);
echo "\r\n";
 flush();
 ob_flush();
 usleep(100000);
}
pclose($port_id);
?>