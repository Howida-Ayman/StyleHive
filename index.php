<?php 
session_start();
require_once('connection.php');
$errors=[];
if(!isset($_SESSION['user_id'])){
  header("location:Login.php");
}else{
if(isset($_POST['submit'])){
  $name=trim(htmlspecialchars($_POST['name']));
  $email=trim(htmlspecialchars($_POST['email']));
  $comment=trim(htmlspecialchars($_POST['comment']));
  if(empty($name))
  {
      $errors[]="Name is Required";
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
if(empty($comment))
{
    $errors[]="Comment is Required";
}
if(!empty($errors))
{
  $_SESSION['errors']=$errors;
   
}else{

   $query="insert into comments(name,email,comment) values('$name','$email','$comment')";
   $comments=mysqli_query(mysql: $connection,query: $query);
   if($comments)
   {
    $_SESSION['success']="comment submited Successfully";
  
   }
}
}
  $query = "select * from comments";
  $result=mysqli_query($connection,$query);
  $comments=mysqli_fetch_all($result,MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clothes</title>
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
                        <li> <a  href="#home">Home</a></li>
                        <li><a  href="#products">All Products</a></li>
                        <li><a  href="#categories"> Categories</a></li>
                        <li><a  href="#about">About Us</a></li>
                        <?php if($_SESSION['role']=="admin"){?>
                        <li><a  href="#comments">Comments</a></li>
                        <?php }else{?>
                        <li><a  href="#contact">Contact Us</a></li>
                        <?php }?>
                        <li><a  href="logout.php"> LogOut</a></li>
                        
            </ul>
        </nav>
        <div class="home" id="home">
            <div class="welcome">
                <h1>Welcome to StyleHive</h1>
            </div>
            <div class="buttons">
                <a href="#products"><button>All Products</button></a>
                <a href="#about"><button>About Us</button></a>
            </div> 
        </div>
        <div class="colored-line"></div>
        <div class="categories" id="categories">
          <div class="title text-center mx-auto">
            <h2>Categories</h2>
          </div>
          <div class="cat-item">
            <div class="cat-img">
              <img src="assets/images/men-cat.jpeg" >
              <div class="overlay">
                <a href="productOfcategory.php?page=1&category_name=Men Collection"><h2>Men's Collection</h2></a>
            </div>
            </div>
             <div class="cat-img">
              <img src="assets/images/home.jpg">
              <div class="overlay">
                <a href="productOfcategory.php?page=1&category_name=Women Collection"><h2>Women's Collection</h2></a>
               </div>
               </div>
        
            <div class="cat-img">
              <img src="assets/images/kid-cat.jpg" alt="">
              <div class="overlay">
                <a href="productOfcategory.php?page=1&category_name=Kids Collection"><h2>Kids Collection</h2></a>
            </div>
            </div>
            <div class="cat-img">
              <img src="assets/images/ac-cat.jpg" alt="">
              <div class="overlay">
                <a href="productOfcategory.php?page=1&category_name=Accessories"><h2>Accessories </h2></a>
            </div>
            </div> 
          </div>
    
        </div>
        <div class="colored-line"></div>
        <div class="products" id="products">
            <div class="title text-center mx-auto"><h2> All Products </h2></div>
            <?php 
            if(isset($_GET['page']))
            {
             $page=$_GET['page'];
            }
            $limit=5;
            $offset=($page-1) * $limit;
            $query="select count(id) as total from products";
            $result=mysqli_query($connection,$query);
            if(mysqli_num_rows($result)==1){
            $total=mysqli_fetch_assoc($result)['total'];
          }
            $numofpages=ceil($total/$limit);
            if($page>$numofpages||$page<1)
            {
              header("location:index.php?page=1");
            }
            $query="select id,title,image,price from products order by id limit $limit offset $offset";
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
      <li class="page-item"><a class="page-link" href="index.php?page=<?=$page-1?>#products">Previous</a></li>
      <li class="page-item"><a class="page-link" href="index.php?page=<?=$page?>#products"><?php echo $page;?> of <?php echo $numofpages?></a></li>
      <li class="page-item"><a class="page-link" href="index.php?page=<?=$page+1?>#products">Next</a></li>
    </ul>
  </nav>
         </div>
        <div class="colored-line"></div>
        <div class="about" id="about">
            <div class="title text-center mx-auto">
                <h4> About Us</h4>
            </div>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut ex ipsam quisquam adipisci accusamus dolores incidunt provident nisi, porro, illum animi eveniet impedit, voluptatum rerum? Nemo totam deleniti nulla? Possimus nobis assumenda harum quos modi vitae iusto maiores tenetur, quisquam provident dignissimos quia, dolore tempore? Deleniti illum dolorum eius expedita.</p>
        </div>
        <div class="colored-line"></div>
        <?php if($_SESSION['role']=="admin"){?>
          <div class="contact overflow-auto" id="comments">
          <div class="title text-center mx-auto">
            <h4> Comments</h4>
          </div>
          <table class="table">
           <thead class="table-light">
              <tr>
               <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Comment</th>
                <th>Date</th>
              </tr>
           </thead>
           <tbody>
            <?php 
            $counter=1;
            if(mysqli_num_rows($result)>=0):
              foreach ($comments as $comment):?>
              <tr>
                <td><?= $counter++?></td>
                <td><?= $comment['name']?></td>
                <td><?= $comment['email']?></td>
                <td><?= $comment['comment']?></td>
                <td><?= $comment['Date']?></td>
              </tr>
              <?php endforeach;
              endif;?>
              </tbody>
              </table>
          </div>
        
          <?php }else{?>
        
<div class="contact" id="contact">
    <div class="title text-center mx-auto">
        <h4> Contact Us</h4>
    </div>
    <form action="index.php?page=1#contact" method="post">
      <?php 
      if(!empty($_SESSION['errors'])):?>
        <?php foreach ($_SESSION['errors'] as $error):?>
    <div class="alert alert-danger p-2">
         <?= $error?>
        </div>
   <?php  endforeach;
    unset($_SESSION['errors']);
     endif;?>
            <?php 
      if(isset($_SESSION['success'])):?>
    <div class="alert alert-success p-2">
         <?= $_SESSION['success']?>;
        </div>
   <?php
    unset($_SESSION['success']);
  endif;?>
    <div class="input-group mb-3">
         <span class="input-group-text" id="inputGroup-sizing-default">Name</span>
         <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="name">
        </div>
        <div class="input-group mb-3">
         <span class="input-group-text" id="inputGroup-sizing-default">Email</span>
         <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="email">
        </div>
        <div class="row mb-3">
      <div class="input-group mb-3 ">
       <span class="input-group-text">Comment</span>
      <textarea class="form-control" aria-label="With textarea" name="comment"></textarea>
      </div>
      </div>
       <button type="submit" name="submit" class="btn btn-success">Send</button>
    </form>
</div>
<?php }?>
<footer>
  <a href="http://facebook.com"><i class="bi bi-facebook fs-3"></i></a>
  <a href="http://instagram.com"><i class="bi bi-instagram fs-3"></i></a>
  <a href="http://twitter.com"><i class="bi bi-twitter fs-3"></i></a>
  <a href="http://whatsapp.com"><i class="bi bi-whatsapp fs-3"></i></a>
    <p> All Rights reserved © for <span>StyleHive.</span> </p>
</footer>
<?php }?>
  <script src="assets/js/bootstrap.bundle.min.js "></script>     
</body>
</html>