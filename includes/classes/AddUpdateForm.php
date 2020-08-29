<?php
class AddUpdateForm{
    private $con, $table, $result;

    public function __construct($con, $table){
        $this->con=$con;
        $this->table=$table;
        
        $this->result=AddUpdateForm::getPlaceholders($con, $table);
    }
    public function createAddForm(){
        $result=$this->result;
        $html="<div class='column'>
                <h1>$this->table</h1>
                <h5>Add entry form</h5>
                <form class='styleForm' method='POST' enctype='multipart/form-data'>";
        for($k=0;$k<sizeof($result); $k++) {
            $name=$this->createInput(null, $result[$k]);
            $html.=$name;
        }
        $addButton=$this->createAddButton();
        $html.="$addButton</form></div>";

        return $html;
                
    }

    public function createEditDetailsForm($val){
        $result=$this->result;
        $html="<div class='column'>
                <h1>$this->table</h1>
                <h5>Add entry form</h5>
                <form class='styleForm' method='POST' enctype='multipart/form-data'>";
        $values = $val->getSql();
        for($k=0;$k<sizeof($result); $k++) {
            $value=$values[$result[$k]];
            $name=$this->createInput($value, $result[$k]);
            $html.=$name;
        }
        $saveButton=$this->createSaveButton();
        $html.="$saveButton</form></div>";

        return $html;
    }

    private function createInput($value, $placeholder){
        if($value==null) $value="";
        return "<div class='form-group'>
                    <input class='form-control' type='text' placeholder='$placeholder' name='$placeholder' value='$value' required>
                </div>";
    }
   
    private function createAddButton(){
        return "<button type='submit' class='btn' name='addButton'>Add</button>";
    }

    private function createSaveButton(){
        return "<button type='submit' class='btn' name='saveButton'>Save</button>";
    }

    public static function getPlaceholders($con, $table) {
        $result=[];
        $query=$con->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'hackathon' AND TABLE_NAME = '$table' ORDER BY ORDINAL_POSITION");
        $query->execute();
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $result[]=$row["COLUMN_NAME"];    
        }
        return $result;
    }

    
}
?>