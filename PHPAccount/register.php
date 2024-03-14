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

        <form action="" method="">
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