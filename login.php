<?php
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
$DB_HOST="localhost";
$DB_NAME="csashesi_beatrice-lungahu";
$DB_USER="csashesi_bl16";
$DB_PWORD="db!hiJ35";

	//connect to database
$link = mysqli_connect($DB_HOST , $DB_USER, $DB_PWORD,$DB_NAME);


// Define $username and $password
$username=$_REQUEST['username'];
$password=$_REQUEST['password'];
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$link = mysqli_connect($DB_HOST , $DB_USER, $DB_PWORD,$DB_NAME);
/*
// To protect MySQL injection for Security purpose
$username = stripslashes($username);
$password = stripslashes($password);
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);
*/
// SQL query to fetch information of registerd users and finds user match.
$query = mysqli_query($link,"SELECT * from login WHERE password='$password' AND username='$username'");
$rows = mysqli_num_rows($query);

if ($query) {

session_start();
header('location: http://cs.ashesi.edu.gh/~csashesi/class2016/beatrice-lungahu/MobileWeb/AppPointofSale/#pagetwo'); // Redirecting To Other Page
} else {
  header('location: http://cs.ashesi.edu.gh/~csashesi/class2016/beatrice-lungahu/MobileWeb/AppPointofSale/');
}
mysqli_close($connection); // Closing Connection



?>
