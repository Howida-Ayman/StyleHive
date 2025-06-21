<?php 
require_once('connection.php');
session_start();
$errors=[];
if(isset($_POST['submit']))
{
$email=trim(htmlspecialchars($_POST['email']));
$password=trim(htmlspecialchars($_POST['pass']));

$query="select id,email,password,role from users";
$result=mysqli_query($connection,$query);
$users=mysqli_fetch_all($result,MYSQLI_ASSOC);
$found_user=null;
if(empty($email))
{
    $errors[]="Email is Required";
}else {
    foreach ($users as $user) {
        if($email== $user['email'])
        {
           $found_user=$user;
           break;
        }
    }
    if(!$found_user)
    {
        $errors[]="Email not correct please,try again";
    }
}

if(empty($password))
{
    $errors[]="Password is Required";
}else{
    $old_pass=password_verify($password, $found_user['password']);
   if(!$old_pass){
    $errors[]="Password not correct please,try again";
   }
}
if(!empty($errors))
{
    $_SESSION['errors']=$errors;
    header("location:login.php");
}
else
{
    $_SESSION['user_id']=$found_user['id'];
    $_SESSION['role']=$found_user['role'];
    header("location:index.php?page=1");
}
}else{
    header("location:login.php");
}
?>
