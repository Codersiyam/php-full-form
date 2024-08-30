<?php  
 session_start();
 if(isset($_SESSION['user_login'])){
   header("location:admin.php");   
 }
$con=mysqli_connect("localhost","root","","fcti");
if(isset($_POST['login'])){
  $username=$_POST['username'];
$password=$_POST['password'];
$input_error=array();
if(empty($username)){
  $input_error['username']="error";
}
if(empty($password)){
  $input_error['password']="error";
}
$user_check=mysqli_query($con, "SELECT * FROM `register` WHERE `username`='$username'");  
if(mysqli_num_rows($user_check)==1){
$rows=mysqli_fetch_assoc($user_check);
if($rows['password']==md5($password)){
if($rows['status']=='Active'){
$_SESSION['user_login']=$username;
header('location:admin.php');
}else{
  echo "<script>
  alert('Your accunt is inactive please active your accunt!');
    window.location.href='login.php';
  </script>";
}
}else{
  echo "<script>
  alert('Your password is Wrong please try again!');
    window.location.href='login.php';
  </script>";
}
}else{
  echo "<script>
  alert('Username is Not Found!');
  window.location.href='login.php';
  </script>";
}



}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
    <!-- ----login_form_design_start__--- -->
     <div class="container">
      <div class="row">
        <h1 class="log_logo">Login</h1>
<form action="#"  method="POST" >
     <!-- --form_itams_number_01_start----   -->
     <div class="form_itams">
          <i class="fa-solid fa-address-book"></i>
            <input type="text" name="username" placeholder="Username" class="form_info 
            <?php if(isset($input_error['username'])){echo $input_error['username'];} ?>
            ">
        </div>
     <!-- --form_itams_number_01_end----   -->
     <!-- --form_itams_number_02_start----   -->
        <div class="form_itams">
        <i class="fa-solid fa-unlock"></i>
            <input id="show" type="password" name="password" placeholder=" Password" class="form_info
                  <?php if(isset($input_error['password'])){echo $input_error['password'];} ?>
            ">
        </div>
     <!-- --form_itams_number_02_end----   -->
 <!-- -----button_section_start__-----   -->
  <div class="buttom">
  <div class="forgot">
    <a class="fgot" href="#">Forgot password</a>
  </div>
  <div class="check">
    <input type="checkbox" name="chk" id="chk" onclick="myFunction()" > <span>Show password</span>
  </div>
  </div>
 <!-- -----button_section_end__-----   -->
  <div class="form_btn">
    <input type="submit" name="login" class="log_btn" title="please fill the blanks and submit" value="Submit" >
  </div>
  <!-- ---register_form_link_start_---- -->
   <div class="link">
    Not a Member? <a href="register.php" class="form_link">Register</a>
   </div>
  <!-- ---register_form_link_end_---- -->
</form>
      </div>
     </div>
    <!-- ----login_form_design_end__--- -->
    <script src="show_pass.js"></script>
</body>
</html>