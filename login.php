<?php
// require_once("includes/header.php");
require_once("includes/config.php");
$error="";
if(isset($_POST["loginBtn"])) {
  $query=$con->prepare("SELECT * FROM users WHERE username=:user AND password=:password");
  $query->bindParam(":user", $user);
  $query->bindParam(":password", $password);
  $user=$_POST["username"];
  $password=$_POST["password"];
  $query->execute();
  if($query->rowCount()>0) {
    $_SESSION["userLoggedIn"] = $user;
    header("Location: tables.php");
  } 
  else {
    $error="<span class='error'>Invalid username/password</span>";
  }
}
?>

<link rel="stylesheet" type="text/css" href="assets/css/formStyle.css">
<div class="login-box">
  <h1>Login</h1>
  <?php echo $error;?>
  <form method='POST'>
  <div class="textbox">
    <i class="fas fa-user"></i>
    <input type="text" name='username' placeholder="Username" autocomplete="off">
  </div>

  <div class="textbox">
    <i class="fas fa-lock"></i>
    <input type="password" name='password' placeholder="Password" autocomplete="off">
  </div>
    <input type="submit" name='loginBtn' class="btn" value="SignIn">
  </form>
  <a href="register.php">New to this site?</a>
</div>
<?php
require_once("includes/footer.php");
?>