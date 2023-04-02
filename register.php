<?php
//Checking whether the form was submitted
if($_SERVER['REQUEST_METHOD']=='POST')
{
   //For Getting the form data
   $first_name=$_POST['first_name'];
   $last_name=$_POST['last_name'];
   $email=$_POST['email'];
   $password=$_POST['password'];
   $confirm_password=$_POST['confirm_password'];
   
   // Validate the form data - I am adding my own validation rules here
   if(empty($first_name) || empty($last_name) || empty($email) || empty($password) || empty($confirm_password))
   {
      echo "Please fill out all fields.";
   }
   else if($password!=$confirm_password)
   {
      echo "Passwords not matching";
   }
   else if(!filter_var($email,FILTER_VALIDATE_EMAIL))
   {
      echo "Invalid Email Format";
   }
   else if(strlen($password)<8)
   {
      echo "Password must be atleast 8 characters";
   }
   else if(!preg_match('/[A-Z]/',$password))
   {
      echo "Password must contain at least one capital letter";
   }
   else if(!preg_match('/[a-z]/',$password))
   {
      echo "Password must contain atleast one lowercase character";
   }
   else if(!preg_match('/\d/',$password))
   {
      echo "Password must contain atleast one digit";
   }
   else if(!preg_match('/[_\W]/',$password))
   {
      echo "Password must contain atleast one special symbol";
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
       $first_name=mysqli_real_escape_string($conn,$first_name);
       $last_name=mysqli_real_escape_string($conn,$last_name);
       $email=mysqli_real_escape_string($conn,$email);
       $password=mysqli_real_escape_string($conn,$password);
       
       //Hash the password
          $hashed_password=password_hash($password,PASSWORD_DEFAULT);
      
       //Check if the email already exists in the database
       
       $result=$conn->query("SELECT * FROM users WHERE email='$email'");
       if($result->num_rows>0)
       {
          //Update the user data in the database
          $sql="UPDATE users SET first_name='$first_name',last_name='$last_name',password='$hashed_password' WHERE email='$email'";
      
          
          if($conn->query($sql)==TRUE)
          {
            echo "User Data Updated Successfully.";
          }
          else
          {
             echo "Error:".sql."<br>" .$conn->error;
          }
       }
       else
       {
           //Insert the user data into the database
           $sql="INSERT INTO users(first_name,last_name,email,password) VALUES('$first_name','$last_name','$email','$hashed_password')";
           if(mysqli_query($conn,$sql))
           {
               echo "Registration sucessful!";
           }
           else
          {
              echo "Error:" .$sql. "<br>" .mysqli_error($conn);
          }
          //Closing the database connection
          mysqli_close($conn); 
       }
   } 
}
?>