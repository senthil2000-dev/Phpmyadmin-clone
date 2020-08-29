<?php
require_once("includes/header.php");
require_once("includes/classes/createTable.php");
$table1=new createTable($con);
echo $table1->Table();

?>
<script src="assets/js/delete.js"></script>