<?php
require_once("includes/header.php");
error_reporting(E_ERROR);
$colNo=$_POST["noOfCol"];
// $query=$con->prepare()
if(isset($_POST["done"])) {
    $table=$_POST["tablename"];
    $comm="CREATE TABLE $table (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY";
   for($k=0;$k<2;$k++) {
       $comm.=", ";
         $col=$_POST["column$k"];
       $type=$_POST["type$k"];
       $size=$_POST["size$k"];
        $comm.="$col $type($size) NOT NULL";
    }
    $comm.=")";
    $query=$con->prepare("$comm");
    
    if($query->execute()) {
        header("Location: tables.php");
        
    }
    else {
      echo $comm." failed ";
      echo "ERROR!!";  
    }
}
?>
<style>
body {
    color: white;
    margin-top:20px;
    background: black;
}
form {
    color: black;
    display: flex;
    flex-direction: column;
}
form div {
    display: flex;
}
.btn {
    color: white;
    margin: 10px 45px;
}
.name {
    width: 250px;
    margin: 65px;
}
</style>
<form method="POST">
<?php
for($k=0;$k<$colNo;$k++) {
    echo "<div>
<input required type='text' placeholder='colName' name= 'column$k'>
<input required type='text' placeholder='type' name='type$k'>
<input required type='number' placeholder='size' name='size$k'>
</div>";
}
?>
<input type="text" class='name' placeholder='tablename'  name="tablename">
<input hidden type="text" value="<?php echo $colNo; ?>">
<input type="submit" value="Submit" name="done" class="btn">
</form>