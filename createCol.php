<?php
require_once("includes/header.php");
?>
<style>
input {
    border: none;
    outline: none;
    background: none;
    color: white;
    font-size: 18px;
    width: 25%;
    float: left;
    margin: 0 10px;
}
form {
    display: flex;
}
</style>
<form method="POST" action="create.php">
<input type="number" name="noOfCol" placeholder="Enter the number of columns" required>
<button type="submit" class="btn">CREATE</button>
</form>