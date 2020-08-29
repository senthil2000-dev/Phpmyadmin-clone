
<?php
class CreateTable{

    private $con;

    public function __construct($con) {
        $this->con=$con;
    }
    public function getTable($page, $pageSize, $table, $cond) {
        $query=$this->con->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'hackathon' AND TABLE_NAME = '$table' ORDER BY ORDINAL_POSITION");
        $query->execute();
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $result[]=$row["COLUMN_NAME"];    
        }
        $result=array_unique($result, SORT_REGULAR);
        $result=array_values($result);
        $html= "<table><tr>";
        for($k=0; $k<sizeof($result); $k++) {
            $html.="<th>".$result[$k]."</th>";
        }
        $html.="<th>Edit</th>
        <th>Delete</th>";
        $html.="</tr>";
        $fromLimit=($page - 1)*$pageSize;
        $query=$this->con->prepare("SELECT * FROM $table $cond LIMIT :fromLimit, :pageSize");
        $query->bindParam(":fromLimit", $fromLimit, PDO::PARAM_INT);
        $query->bindParam(":pageSize", $pageSize, PDO::PARAM_INT);
        $query->execute();
        while($row=$query->fetch(PDO::FETCH_ASSOC)){
            $id=$row["id"];
            $html.="<tr>";
            for($k=0; $k<sizeof($result); $k++) {
                $html.="<th>".$row[$result[$k]]."</th>";
            }
            $action2="editFunc($id, \"$table\")";
            $action="deleteFunc(this, $id, \"$table\")";
            $html.="<td><button class='btn' onclick='$action2'>EDIT</button></td>
                    <td><button class='btn' onclick='$action'>DELETE</button></td>";
            $html.="</tr>";
        }
        $html.="</table>";
        return $html;
    }

    public function Table() {
        $query = $this->con->prepare('show tables');
        $query->execute();
        $results=[];
        while($rows = $query->fetch(PDO::FETCH_ASSOC)){
            $results[]=$rows["Tables_in_hackathon"];
        }
        $html= "<table><tr><th>Table</th><th>DELETE OPTION</th>";
        $html.="</tr>";
        
        for($k=0; $k<sizeof($results); $k++) {
            if($results[$k]!="users") {
                $html.="<tr>";
                $html.="<td style='cursor:pointer;' onclick=\"window.location.href='table.php?tableName=$results[$k]'\">".$results[$k]."</td>";
                $action="deleteFunc2(this, \"$results[$k]\")";
                $html.="<td><button class='btn' onclick='$action'>DELETE</button></td>";
                $html.="</tr>";
            }
            
        }
        // $action2="editFunc($id, \"$table\")";<td><button class='btn' onclick='$action2'>EDIT</button></td>
        
        
        $html.="</table>";
        return $html;
    }
}
?>