<?php 
session_start();
require_once('connection.php');
$errors=[];
if(isset($_POST['submit']))
{
    $name=trim(htmlspecialchars($_POST['name']));
    $email=trim(htmlspecialchars($_POST['email']));
    $phone=trim(htmlspecialchars($_POST['phone']));
    $password=trim(htmlspecialchars($_POST['pass']));
    $confirm_password=trim(htmlspecialchars($_POST['c-pass']));
    if(empty($name))
    {
        $errors[]="Name is Required";
    }
    else{
    if(strlen($name)<3)
    {
        $errors[]="Name must be more than 3 characters"; 
    }
    elseif (is_numeric($name)) {
        $errors[]="Name must be String";
    }
}
if(empty($email))
{
    $errors[]="Email is Required";
}else {
    if(!filter_var($email,FILTER_VALIDATE_EMAIL))
    {
        $errors[]="Email Invalid";
    }
}
if(empty($phone))
    {
        $errors[]="Phone is Required";
    }
else{
    if(strlen($phone)<11||!is_numeric($phone))
    {
        $errors[]="Invalid Phone Number"; 
    }
}
if(empty($password))
{
    $errors[]="Password is Required";
}else{
    $pattern="/^(?=.*[A-Za-z]).{8,}$/";
    if(!preg_match($pattern,$password))
    {
        $errors[]="Password must be at least 8 characters long and contain at least one letter";
    }
}
if (empty($confirm_password)) {
    $errors[]="Confirm Password is Required";
}
else{
    if($confirm_password !== $password){
     $errors[]="Confirm Password doesn't Match";  
    }
}

if(!empty($errors))
{
  $_SESSION['errors']=$errors;
  header("location:register.php");
}else{
   $hashed_pass=password_hash($password,PASSWORD_DEFAULT);
   $query="insert into users(name,email,phone,password) values('$name','$email','$phone','$hashed_pass')";
   $user=mysqli_query($connection,query: $query);
   if($user)
   {
    header("location:index.php?page=1");
   }
}
}
else{
    header("location:register.php");
}
?>
