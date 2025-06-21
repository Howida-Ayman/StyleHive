<?php 
session_start();
if(isset($_SESSION['user_id'])){
require_once('connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Of Category</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="assets/css/all.min.css" rel="stylesheet" >
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="navbar">
            <ul>
              <?php if($_SESSION['role']=="admin"){?>
              <li><a  href="addproduct.php"><button type="submit" class="btn btn-primary">Add New Product</button></a></li>
              <?php }?>
                        <li> <a  href="index.php?page=1#home">Home</a></li>
                        <li><a  href="index.php?page=1#products">All Products</a></li>
                        <li><a  href="index.php?page=1#categories"> Categories</a></li>
                        <li><a  href="index.php?page=1#about">About Us</a></li>
                        <li><a  href="index.php?page=1#contact">Contact Us</a></li>
                        <li><a  href="logout.php"> LogOut</a></li>
                        
            </ul>
        </nav>
<div class="products">

<?php if(isset($_GET['category_name']))
            {
             $category_name=$_GET['category_name'];
            }?>
            <div class="title text-center mx-auto"><h2> <?= $category_name ?> </h2></div>
            <?php 
            if(isset($_GET['page'])||isset($_GET['category_name']))
            {
             $page=$_GET['page'];
             $category_name=$_GET['category_name'];
            }
            $limit=5;
            $offset=($page-1) * $limit;
            $query="select count(p.id) as total from products p join categories c on p.category_id=c.id where c.name ='$category_name'";
            $result=mysqli_query($connection,$query);
            if(mysqli_num_rows($result)==1){
            $total=mysqli_fetch_assoc($result)['total'];
          }
            $numofpages=ceil($total/$limit);
            if($page>$numofpages||$page<1)
            {
              header("location:productOfcategory.php?page=1&category_name=$category_name");
            }
            $query="select p.id,p.title,p.image,p.price,p.category_id,c.name,c.id from products p join categories c on p.category_id=c.id where c.name ='$category_name' order by p.id limit $limit offset $offset";
            $result=mysqli_query($connection,$query);
            $products=mysqli_fetch_all($result,MYSQLI_ASSOC);
            if(mysqli_num_rows($result)>=1):
            ?>
            <?php foreach($products as $product):?>
              <div class="product-item">
                <img class="image" src="assets\images\<?=$product['image']?>" alt="">
                <div class="content">
                  <h5><?= $product['title']; ?></h5>
                  <h4>Price:<?= $product['price']; ?>$</h4>
                </div>
                <div class="cart">
                  <?php if($_SESSION['role']=='admin'):?>
                  <a href=""> <button class="btn btn-success"><p>Update</p></button></a>
                  <a href=""> <button class="btn btn-danger">Delete</button></a>
                  <?php else:?>
                  <a href=""> <button class="btn btn-dark">Add To Cart</button></a>
                  <?php endif;?>
              </div>
              </div>
              <?php 
              endforeach;
              else :?>
              <div class="alert alert-light text-center" role="alert">
                <h2><?="No Products Found";?></h2>
               </div>
               <?php
              endif;
                ?>
        </div><br>
        <div class=" d-flex justify-content-center">
  <nav aria-label="Page navigation">
    <ul class="pagination">
      <li class="page-item"><a class="page-link" href="productOfcategory.php?page=<?=$page-1?>&category_name=<?=$category_name?>">Previous</a></li>
      <li class="page-item"><a class="page-link" href="productOfcategory.php?page=<?=$page?>&category_name=<?=$category_name?>"><?php echo $page;?> of <?php echo $numofpages?></a></li>
      <li class="page-item"><a class="page-link" href="productOfcategory.php?page=<?=$page+1?>&category_name=<?=$category_name?>">Next</a></li>
    </ul>
  </nav><?php }else
  {header("location:login.php");
  }?>
</div>
<script src="assets/js/bootstrap.bundle.min.js "></script>    
</body>
</html>