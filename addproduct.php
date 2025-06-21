<?php 
session_start();
if(isset($_SESSION['user_id'])){
  if($_SESSION['role']=='admin'){
require_once('connection.php');
$query="select * from categories";
$data=mysqli_query($connection,$query);
$categories=mysqli_fetch_all($data,MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="assets/css/all.min.css" rel="stylesheet" >
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="all">
    <?php 
  if(!empty($_SESSION['errors'])):?>
  
    <?php foreach ($_SESSION['errors'] as $error):?>
       <div class="alert alert-danger w-50 mx-auto p-2">
        <?php echo $error?> 
      </div>
     <?php 
     endforeach;
    endif;
    unset($_SESSION['errors'])
     ?>
    <div class="container">
        <h2>Add New Product</h2>
        <form action="product_handle.php" method="post" enctype="multipart/form-data">
        <div class="row mb-3">
        <div class="input-group mb-3">
         <span class="input-group-text" id="inputGroup-sizing-default">Title</span>
         <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="title">
        </div>
      </div>
        <div class="input-group mb-3">
         <span class="input-group-text" id="inputGroup-sizing-default">Price</span>
         <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="price">
        </div>
        <div class="row mb-3">
      <div class="input-group">
       <span class="input-group-text">Description</span>
      <textarea class="form-control" aria-label="With textarea" name="desc"></textarea>
      </div>
      </div>
      <div class="row mb-3">
      <div class="input-group mb-3">
      <span class="input-group-text">Image</span>
      <input type="file" class="form-control" name="img" id="inputGroupFile03" aria-describedby="inputGroupFileAddon03" aria-label="Upload">
      </div>
      </div>
      <div class="row mb-3">
      <div class="input-group mb-3">
  <span class="input-group-text" for="inputGroupSelect01">Category Name</span>
  <select name="cat" class="form-select" id="inputGroupSelect01">
    <option>Choose...</option>
    <?php 
    foreach ($categories as $category):?>
    <option value="<?= $category['id']?>"><?= $category['name']?></option>
    <?php endforeach;?>
  </select>
  </div>
      </div>
      <button type="submit" class="btn btn-primary" name="submit">ADD Product</button>
    </form>
    </div>
    </div>
    <?php 
    }else
    {?>
      <div class="alert alert-danger text-center" role="alert">
                <h2><?="Only Admins Have The Authority to Add Product";?></h2>
               </div>
    <?php }}
    else{
         header("location:index.php");
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" ></script>
</body>
</html>