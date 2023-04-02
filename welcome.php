<?php
session_start();

//Check if the user is logged in
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!==true)
{
   //If the user is not logged in,redirect them to the login page
   header("Location:login_form.php");
   exit();
}

//Get the user's email from the session
$email=$_SESSION['email'];

//Connect to the MySQL database
$host='localhost';
$user='root';
$pass='Efghij';
$dbname='dblab8';
$conn=mysqli_connect($host,$user,$pass,$dbname);

//Query the "users" table to retrieve the user's data based on their email address
$query="SELECT * FROM users WHERE email='$email'";
$result=mysqli_query($conn,$query);

if(mysqli_num_rows($result)>0)
{
  //If the email is found,get the user's data
  $row=mysqli_fetch_assoc($result);
  $first_name=$row['first_name'];
  $last_name=$row['last_name'];

  //Display a welcome message with the user's first name and last name
  echo "<h2>Welcome, $first_name $last_name!</h2>";

  //Add a link to view the user's information
  echo "<p><a href='information.php'>View Your Information</a></p>";
}
else
{
  //If the email is not found,display an error message
  echo "Error:Email not found.";
}

//Close the database connection
mysqli_close($conn);
?>