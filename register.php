<?php  
$con= mysqli_connect("localhost","root","","fcti");
if(isset($_POST['register'])){
    $sname=$_POST['sname'];
    $username=$_POST['username'];
    $email=$_POST['email'];
    $number=$_POST['number'];
    $password=$_POST['password'];
    $c_pass=$_POST['c_pass'];
    $input_error=array();
    if(empty($sname)){
        $input_error['sname']="error";
    }
    if(empty($username)){
        $input_error['username']="error";
    }
    if(empty($email)){
        $input_error['email']="error";
    }
    if(empty($number)){
        $input_error['number']="error";
    }
    if(empty($password)){
        $input_error['password']="error";
    }
    if(empty($c_pass)){
        $input_error['c_pass']="error";
    }
    if(count($input_error)==0){
    $user_unique=mysqli_query($con, "SELECT * FROM `register` WHERE `username`='$username'");
    if(mysqli_num_rows($user_unique)==0){
    if($password==$c_pass){
    $password_32bit=md5($password);
    $query=mysqli_query($con, "INSERT INTO `register`(`sname`, `username`, `email`, `number`, `password`) VALUES ('$sname','$username','$email','$number','$password_32bit')");
    if($query){
        echo "<script>
           alert('Successfully your information submit');
        window.location.href='admin.php';
        </script>";
    }else{
        echo "<script>
        alert('Some error please try again!');
        window.location.href='register.php';
     </script>";
    }
    }else{
        $input_error['match']="<script>
        alert('COnfirm password is not macth please try again!');
        window.location.href='register.php';
        </script>";
    }
    }else{
        $input_error['user']="<script>
        alert('The Username already EXIST please try again!');
        window.location.href='register.php';
        </script>";
    }
     
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <link rel="stylesheet" href="register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
  <!-- ----register_form_design_start_----   -->
 <div class="container">
<div class="row">
<h1 class="re_logo">Register</h1>
    <form action="#" method="POST" >
     <!-- --form_itams_number_01_start----   -->
        <div class="form_itams">
        <i class="fa-solid fa-file-signature"></i>
            <input type="text" name="sname" placeholder="Name" class="form_info 
            <?php if(isset($input_error['sname'])){echo $input_error['sname'];} ?>
            ">
        </div>
     <!-- --form_itams_number_01_end----   -->
     <!-- --form_itams_number_02_start----   -->
        <div class="form_itams">
        <i class="fa-solid fa-user"></i>
            <input type="text" name="username" placeholder=" Username" class="form_info
                  <?php if(isset($input_error['username'])){echo $input_error['username'];} ?>
            ">
            <span>
                <?php if(isset($input_error['user'])){echo $input_error['user'];} ?>
            </span>
        </div>
     <!-- --form_itams_number_02_end----   -->
     <!-- --form_itams_number_03_start----   -->
        <div class="form_itams">
        <i class="fa-solid fa-square-envelope"></i>
            <input type="email" name="email" placeholder="Email" class="form_info
                  <?php if(isset($input_error['email'])){echo $input_error['email'];} ?>
            ">
        </div>
     <!-- --form_itams_number_03_end----   -->
     <!-- --form_itams_number_04_start----   -->
        <div class="form_itams">
        <i class="fa-solid fa-square-phone"></i>
            <input type="number" name="number" placeholder="Number." class="form_info
                  <?php if(isset($input_error['number'])){echo $input_error['number'];} ?>
            ">
        </div>
     <!-- --form_itams_number_04_end----   -->
     <!-- --form_itams_number_05_start----   -->
        <div class="form_itams">
        <i class="fa-solid fa-lock"></i>
            <input type="password" name="password" placeholder="password" title="Creat a new password.." class="form_info
                  <?php if(isset($input_error['password'])){echo $input_error['password'];} ?>
            ">
        </div>
     <!-- --form_itams_number_05_end----   -->
     <!-- --form_itams_number_06_start----   -->
        <div class="form_itams">
        <i class="fa-solid fa-clipboard-check"></i>
            <input type="password" name="c_pass" placeholder="Confirm Password" title="Confirm your password.." class="form_info
                  <?php if(isset($input_error['c_pass'])){echo $input_error['c_pass'];} ?>
            ">
            <span>
                <?php if(isset($input_error['match'])){echo $input_error['match'];} ?>
            </span>
        </div>
     <!-- --form_itams_number_06_end----   -->
   <!-- ----register_form_btn_start_---- -->
    <div class="register_btn">
        <input type="submit" name="register" class="re_btn" value="Submit" title="Fill the blanks and click the submit button " >
    </div>
   <!-- ----register_form_btn_end_---- -->
   <!-- ---form_link_start_----  -->
    <div class="link">
        Alrady Have a accunt?<a href="login.php" class="form_link">Login</a>
    </div>
   <!-- ---form_link_end_----  -->
    </form>
</div>
 </div>   
  <!-- ----register_form_design_start_----   -->
    
</body>
</html>