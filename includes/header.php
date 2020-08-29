<?php
require_once("includes/config.php");
if(!isset($_SESSION["userLoggedIn"])) {
    // exit("Please Sign in");
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.min.css"/>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
   <div id="sideBar">
        <div class='toggle-btn' onclick='toggleSidebar()'>
        <span></span>
        <span></span>
        <span></span>
        </div>
        <ul>
            <li onclick="window.location.href='tables.php'">Tables</li>
            <li onclick="window.location.href='create.php'">Create Table</li>
            <li onclick="window.location.href='logout.php'">Log out</li>
        </ul>
    </div>
    <div class='content'>
    <script src="assets/js/actions.js"></script>

