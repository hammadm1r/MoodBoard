<?php 
global $dbcon;
$server = "127.0.0.1";
$username ="hammadm1r";
$password = "1337";
$dbname = "moodboard";

$dbcon = new mysqli($server,$username,$password,$dbname);
if($dbcon->ping()){
    echo "Connected to database";
}
else{
    printf($dbcon->error);
}
?>
