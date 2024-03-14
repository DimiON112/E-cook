<?php
include('partials/header.php');
?>

    <div class="form_container">

        <div class="overlay">
            <!--this will have not content-->
        </div>

        <div class="titleDiv">
            <h1 class="title">Login</h1>
            <span class="subTitle">Welcome back!</span>
        </div>

        <form action="" method="POST">
           <div class="rows grid">
            <!--User Name-->
               <div class="row">
                   <label for="username">User Name</label>
                   <input type="text" id="username" name="userName" placeholder="Enter User Name" required>
               </div>

            <!--Password-->
               <div class="row">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your Password" required>
            </div>

            <!--Submit Button-->
            <div class="row">
                
                <input type="submit" id="submitBtn" name="submit"  value="Login">
                <span class="registerLink">Don't have an account? <a href="register.php"> Register</a></span>
            </div>


           </div>

        </form>
    </div>

<?php
include('partials/footer.php');
?>

<!--Logowanie to DataBase-->

<?php
if(isset($_POST['submit'])){

   echo 'Yes data submited';
   // Twój kod sprawdzający logowanie z bazą danych
   // Pobierz dane użytkownika z bazy danych na podstawie nazwy użytkownika
   // Sprawdź, czy hasło z formularza zgadza się z hasłem w bazie danych
   // Jeśli dane logowania są poprawne, możesz przekierować użytkownika na inną stronę lub wykonać inne operacje
}
?>