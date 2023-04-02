<?php
session_start();

//Get the email and password from the login form
$email=$_POST['email'];
$password=$_POST['password'];

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
   $hashed_password=$row['password'];

  // Use the password_verify() function to compare the user's entered password with the hashed password stored in the database
  if(password_verify($password,$hashed_password))
  {
      //If the email and password are correct,set session variable to remember that the user is logged in
      $_SESSION['loggedin']=true;
      $_SESSION['email']=$email;
     
      //Redirect the user to the welcome page
      header("Location:welcome.php");
      exit();
  }
  else
  {
     //If the password is incorrect,display an error message and allow the user to try again
     echo "Incorrect password.Please try again.";
  }
}
else
{
  //If the email is not found,display an error message and allow the user to try again
  echo "Email not found. Please try again.";
}

//Close the database connection
mysqli_close($conn);
?>