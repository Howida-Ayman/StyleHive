<?php 
require_once('connection.php');
session_start();
$errors=[];
if(isset($_POST['submit'])){
$title=trim(htmlspecialchars($_POST['title']));
$price=trim(htmlspecialchars($_POST['price']));
$desc=trim(htmlspecialchars($_POST['desc']));
$category=trim(htmlspecialchars($_POST['cat']));
$img=$_FILES['img'];
$img_name=$img['name'];
$img_path=$img['tmp_name'];
$extract_ext=explode(".",$img_name);  
$img_ext=strtolower(end($extract_ext));
$arr_ext=["png","jpg","jpeg","webp"];
if(empty($title))
{
    $errors[]="Title is Required";
}
else{
if(is_numeric($title)) {
    $errors[]="Title must be String";
}
}
if(empty($price))
{
    $errors[]="Price is Required";
}
else{
if(!is_numeric(value: $price)) {
    $errors[]="Price must be numeric";
}
}
if(empty($desc))
{
    $errors[]="Description is Required";
}
if(empty($category)||$category=='Choose...')
{
    $errors[]="Category is Required";
}
if(empty($_FILES['img']['name']))
{
    $errors[]="Image is Required";
}
else
{
  if(!in_array($img_ext,$arr_ext,)){
    $errors[]="Image must be png,jpg,jpeg";
  }
}
if(!empty($errors))
{
  $_SESSION['errors']=$errors;
  header("location:addproduct.php");
}else{
   move_uploaded_file($img_path,"assets/images/".$img_name);
   $query="insert into products(title,description,price,category_id,image) values('$title','$desc','$price','$category','$img_name')";
   $products=mysqli_query($connection,$query);
   if($products)
   {
    header("location:index.php?page=1");
   }
}
}else{
    header("location:addproduct.php");
}
?>