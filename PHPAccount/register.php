<?php
include('partials/header.php');
?>
    <div class="register_container">

        <div class="overlay">
            <!--this will have not content-->
        </div>

        <div class="titleDiv">
            <h1 class="title">Register</h1>
            <span class="subTitle">Thanks for choosing us!</span>
        </div>

        <form action="" method="POST">
           <div class="rows grid">
            <!--User Name-->
               <div class="row">
                   <label for="username">User Name</label>
                   <input type="text" id="username" name="userName" placeholder="Enter User Name" required>
               </div>

         <!--Email Address-->
         <div class="row">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" placeholder="Enter User email" required>
        </div>

         <!--Phone Number-->
                 <div class="row">
                    <label for="phone">Phone Number</label>
                    <input type="text" id="phone" name="phone" placeholder="Enter your phone number" required>
                </div>

            <!--Password-->
               <div class="row">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your Password" required>
            </div>



            <!--Submit Button-->
            <div class="row">
                
                <input type="submit" id="submitBtn" name="submit"  value="Login">
                <span class="registerLink">Have an account already? <a href="index.php"> Login</a></span>
            </div>


           </div>

        </form>
    </div>

<?php
include('partials/footer.php');
?>

<!--registracja do nowego accounta-->

<?php

if(isset($_POST['submit'])){

    $userName=$_POST['userName'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $phone=$_POST['phone'];

    $sql="INSERT INTO admin SET
          usernames='$userName',
          email='$email',
          passwords='$password',
          phone='$phone'
    ";

    $res=mysqli_query($conn, $sql);
    if($res==true){
        $_SESSION['accountCreated']='<span class="addedAccount">Account '.$userName.' created!</span>' ;

        header('location:' .SITEURL. 'index.php');
        exit();
    }

    else{
        $_SESSION['unSuccessful']='<span class="fail">Nie udało się utworzyć konta dla '.$userName.'!</span>' ;

        header('location:' .SITEURL. 'register.php');
        exit();
    }

}

?>
