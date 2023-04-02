<?php
//Checking whether the form was submitted
if($_SERVER['REQUEST_METHOD']=='POST')
{
   //For getting the form data
   $email=$_POST['email'];
   $password=$_POST['password'];

   //Validate the form data- I am adding my own validation rules here
   if(empty($email) || empty($password))
   {
      echo "Please fill out all fields.";
   }
   else
   {
        //If the form data is valid then connect the database name dblab8
        $conn=mysqli_connect('localhost','root','Efghij','dblab8');
        
        //Check if the connection was sucessful
        if(!$conn)
        {
           die("Connection failed:".mysqli_connect_error());
        }
        
        //Escape the form data to prevent SQL injection
       
        $email=mysqli_real_escape_string($conn,$email);
        $password=mysqli_real_escape_string($conn,$password);
       
        //Check if the email exists in the database

        $result=$conn->query("SELECT * FROM users WHERE email='$email'");
        
        if($result->num_rows>0)
        {
           $row=$result->fetch_assoc();
           
           //Verify the password
           if(password_verify($password,$row['password']))
           {
                //Delete the user account from the database
       
                $sql="DELETE FROM users WHERE email='$email'";
                if(mysqli_query($conn,$sql))
                {
                    echo "Account deleted sucessfully!";
                }
                else
                {
                   echo "Error deleting account:".mysqli_error($conn);
                }
             }
             else
             {
                echo "Incorrect password.";
             }
        }
        else
        {
            echo "User not found.";
        }
        
        //Close the database connection
        mysqli_close($conn);
   }
}
?>