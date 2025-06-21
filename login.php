<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="assets/css/all.min.css" rel="stylesheet" >
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="all">
    <?php 
 session_start();
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
        <h2>Login Here</h2>
        <form action="login_handle.php" method="post">
      <div class="row mb-3">
      <div class="input-group mb-3">
         <span class="input-group-text" id="inputGroup-sizing-default">Email</span>
         <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="email">
        </div>
      </div>
      <div class="row mb-3">
      <div class="input-group mb-3">
         <span class="input-group-text" id="inputGroup-sizing-default">Password</span>
         <input type="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="pass">
        </div>
      </div>
      <button type="submit" class="btn btn-primary" name="submit">Login in</button>
    </form>
    <a href="register.php">انشاء حساب جديد</a>
    </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>