
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
  if(!empty($_SESSION['errors'])):
  
   foreach ($_SESSION['errors'] as $error):?>
       <div class="alert alert-danger w-50 mx-auto p-2">
        <?php echo $error?> 
      </div>
     <?php 
     endforeach;
     unset($_SESSION['errors']);
    endif;
     ?>
     <div class="container">
        <h2>Register Here</h2>
        <form action="register_handle.php" method="post">
        <div class="row mb-3">
        <div class="input-group mb-3">
         <span class="input-group-text" id="inputGroup-sizing-default">Name</span>
         <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="name">
        </div>
      </div>
      <div class="row mb-3">
      <div class="input-group mb-3">
         <span class="input-group-text" id="inputGroup-sizing-default">Email</span>
         <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="email">
        </div>
      </div>
      <div class="row mb-3">
      <div class="input-group mb-3">
      <span class="input-group-text" id="inputGroup-sizing-default">Phone</span>
         <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="phone">
        </div>
      </div>
      <div class="row mb-3">
      <div class="input-group mb-3">
         <span class="input-group-text" id="inputGroup-sizing-default">Password</span>
         <input type="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="pass">
        </div>
      </div>
      <div class="row mb-3">
      <div class="input-group mb-3">
         <span class="input-group-text" id="inputGroup-sizing-default">Confirm Password</span>
         <input type="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="c-pass">
        </div>
      </div>
      <button type="submit" name="submit" class="btn btn-primary">Sign in</button>
    </form>
    <a href="login.php">لديك حساب بالفعل</a>
    </div> 
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>