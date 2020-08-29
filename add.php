<?php 
require_once("includes/header.php");
require_once("utility.php");
require_once("includes/classes/AddUpdateForm.php");
if(isset($_POST["addButton"])) {
        $table=$_GET["table"];
        $placeholders=AddUpdateForm::getPlaceholders($con, $table);
        $values=[];
        for($k=0;$k<sizeof($placeholders);$k++) {
            $values[]=$_POST[$placeholders[$k]];
        }
        $res=insert($con, $table, $placeholders, $values);
        if($res==1)
            header("Location: table.php?tableName=".$table);
        else
            echo "<div class='alert alert-danger'><b>ERROR! </b>Failed inserting data!</div>";
     
}
?>
<style>
body {
    display: flex;
    flex-direction: column;
    background-color: rgba(0,0,0,0.2);
}
</style>
<?php
$form=new AddUpdateForm($con, $_GET["table"]);
echo $form->createAddForm();
?>