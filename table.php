<?php
require_once("includes/header.php");
require_once("includes/classes/TableClass.php");
require_once("includes/classes/createTable.php");
if(isset($_GET["tableName"])) {
    $table=$_GET["tableName"];
}
else {
    echo "No table name";
    exit();
}
$page=isset($_GET["page"]) ? $_GET["page"] : 1;
$cond=isset($_GET["cond"]) ? $_GET["cond"] : "";
$pageSize = 5;
?>
<div class="flexing">
<h3><?php echo $table ?> Database</h3>
<button class="btn" onclick="window.location.href='add.php?table=<?php echo $table?>'">ADD</button>
</div>
<?php
$table1=new createTable($con);
echo $table1->getTable($page, $pageSize, $table, $cond);
?>
 <div class="pageSystem">
        <div class="paginationButtons">
            <div class="pageNo">
                <img src="assets/images/begin.png" alt="Q">
            </div>
                <?php
                    $query=$con->prepare("SELECT * FROM $table $cond");
                    $query->execute();
                    $countOfResults=$query->rowCount();
                    $numToDisplay=10;
                    $present=$page-floor($numToDisplay/2);
                    $numberOfPages=ceil($countOfResults/$pageSize);
                    $pagesRemaining=min($numToDisplay, $numberOfPages);
                    
                    if($present<1) {
                        $present=1;
                    }
                    if($present+$pagesRemaining>$numberOfPages+1) {
                        $present=$numberOfPages+1-$pagesRemaining;
                    }
                    while($pagesRemaining!=0) {
                        if($present==$page) {
                            echo "<div class='pageNo'>
                                <img src='assets/images/clicked.png' alt='U'>
                                <span class='number'>$present</span>
                            </div>";
                        }
                        else {
                            echo "<div class='pageNo'>
                                    <a href='table.php?tableName=$table&page=$present&cond=$cond'>
                                        <img src='assets/images/middle.png' alt='U'>
                                        <span class='number'>$present</span>
                                    </a>
                                </div>";
                        }
                        
                        $present++;
                        $pagesRemaining--;
                    }
                ?>

            <div class="pageNo">
                    <img src="assets/images/final.png" alt="Q">
            </div>
        </div>
</div>
<div>
    <form method='GET'>
        <input hidden type="text" name="tableName" value='<?php echo $table; ?>'>
        <input hidden type="text" name="page" value='<?php echo $page; ?>'>
        <input class='query' type="text" name="cond" placeholder="Enter query">
        <button class='btn btn-primary' type='submit'>PERFORM</button>
    </form>
</div>
<script src="assets/js/delete.js"></script>