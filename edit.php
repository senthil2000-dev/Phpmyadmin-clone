<?php
$id=$_GET["id"];
$table=$_GET["table"];
require_once("includes/header.php");
require_once("utility.php");
require_once("includes/classes/AddUpdateForm.php");
require_once("includes/classes/TableClass.php");
if(isset($_POST["saveButton"])) {
        $placeholders=AddUpdateForm::getPlaceholders($con, $table);
        $values=[];
        for($k=0;$k<sizeof($placeholders);$k++) {
            $values[]=$_POST[$placeholders[$k]];
        }
        $res=update($con, $table, $placeholders, $values, ['id'=>$id]);
        
        if($res!=1)
            echo "<div class='failure'><b>ERROR! </b>Failed inserting data</div>";
        else
            header("Location: table.php?tableName=".$table);
}
function isAlready($rollno, $con, $givenId) {
    $query=$con->prepare("SELECT id FROM nitians WHERE rollno = :roll");
    $query->bindParam(":roll", $rollno);
    $query->execute();
    $id=$query->fetchColumn();
    if(($query->rowCount()>0)&&($id!=$givenId))
        return true;        
    else
        return false;
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
$tab = new TableClass($con, $table, $id);
$form=new AddUpdateForm($con, $table);
echo $form->createEditDetailsForm($tab);
?>
