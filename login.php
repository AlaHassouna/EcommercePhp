<?php
 require('connection.php');
 require('functions.php');
 $msg='';
 if(isset($_POST['submit'])) { 
   $username=get_safe_value($con,$_POST['username']);
   $password=get_safe_value($con,$_POST['password']);
   $sql="select * from admin_users where username='$username' and password='$password'";
   $res=mysqli_query($con,$sql);
   $count=mysqli_num_rows($res);
   if($count>0){
      $_SESSION['ADMIN_LOGIN']='yes';
      $_SESSION['ADMIN_USERNAME']=$username;
      header('location:categories.php');
      die();
   }else{
      $msg="Please enter correct login details";
   }
 }
?>

<!DOCTYPE html>
   <html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <!--=============== REMIXICONS ===============-->
      <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

      <!--=============== CSS ===============-->
      <link rel="stylesheet" href="assets/css/styleLogin.css">

      <title>E-commerce website</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Place logo1.png in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="images/logo3.png">
      <style>

      </style>
   </head>
   <body>
      <div class="login">
         <img src="assets/img/login.jpg" alt="login image" class="login__img">

         <form action="" class="login__form" method="post">
            <h1 class="login__title">Login</h1>

            <div class="login__content">
               <div class="login__box">
                  <i class="ri-user-3-line login__icon"></i>

                  <div class="login__box-input">
                     <input type="text" name="username" required class="login__input" id="login-email" placeholder=" " required >
                     <label for="login-email" class="login__label">Username</label>
                  </div>
               </div>

               <div class="login__box">
                  <i class="ri-lock-2-line login__icon"></i>

                  <div class="login__box-input">
                     <input type="password" required class="login__input" id="login-pass" name="password" placeholder=" " required>
                     <label for="login-pass" class="login__label">Password</label>
                     <i class="ri-eye-off-line login__eye" id="login-eye"></i>
                  </div>
               </div>
            </div>

            <div class="login__check">
               <div class="login__check-group">
                  <input type="checkbox" class="login__check-input" id="login-check">
                  <label for="login-check" class="login__check-label">Remember me</label>
               </div>

               <a  href="#" class="login__forgot">Forgot Password?</a>
            </div>

            <button type="submit" name="submit" class="login__button">Login</button>

            <p class="login__register">
               Don't have an account? <a href="#">Register</a>
               
               <div style="text-align:center;margin-top:2%;background-color:#7e441e;border-radius: .5rem;"> 
               <?php 
                  echo $msg; 
                  ?></div>
              
              
            </p>
            
         </form>
         
      </div>
      
      <!--=============== MAIN JS ===============-->
      <script src="assets/js/login.js"></script>
   </body>
</html>