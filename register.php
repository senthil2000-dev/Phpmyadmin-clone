<?php
require_once("includes/config.php");
if(isset($_POST["register"])) {
  $query=$con->prepare("INSERT INTO users(username, email, password) VALUES(:user, :email,:password)");
  $query->bindParam(":user", $user);
  $query->bindParam(":email", $email);
  $query->bindParam(":password", $password);
  $user=$_POST["username"];
  $email=$_POST["email"];
  $password=$_POST["password"];
  $query->execute();
  $_SESSION["userLoggedIn"] = $user;
  header("Location: tables.php");
}
?>
<link rel="stylesheet" type="text/css" href="assets/css/formStyle.css">
<div class="login-box">
  <h1>Register</h1>
  <form method='POST'>
  <div class="textbox">
    <i class="fas fa-user"></i>
    <input type="text" name='username' placeholder="Username" autocomplete="off">
  </div>
  <div class="textbox">
    <i class="fas fa-envelope"></i>
    <input type="email" name='email' placeholder="Email" autocomplete="off">
  </div>
  <div class="textbox">
    <i class="fas fa-lock"></i>
    <input type="password" name='password' placeholder="Password" autocomplete="off">
  </div>
    <input type="submit" name='register' class="btn" value="register">
  </form>
  <a href="login.php">Already have an account?</a>
</div>
<?php
require_once("includes/footer.php");
?>