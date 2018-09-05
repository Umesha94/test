<?php
session_start();
if(!isset($_SESSION['type'])){
    header('Location:login.php');
}
else{
    if($_SESSION['type']!=1){
        header('Location:index.php');
    }
}
include_once("header.php");
include_once("db.php");
?>
<body>
<div class="container">
    <a class="btn btn-primary" href="index.php">Back</a>
    <a class="btn btn-primary" href="add_stock.php">Add Stock</a><br>
    <h1> stock </h1>
    <table class="table table-hover ">
        <thead class="dark">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">name</th>
            <th scope="col">Qty</th>
        </tr>
        </thead>
        <?php
        $result = mysqli_query($con,"SELECT * FROM stock");

        while($row=mysqli_fetch_array($result)) {
            $id=$row['id'];
            $name=$row['name'];
            $qty=$row['qty'];
            ?>
            <tbody>
            <tr>
                <th><?php echo $id?></th>
                <td><?php echo $name?></td>
                <td><?php echo $qty?></td>
            </tr>
            </tbody>
            <?php
        }
        ?>
    </table>
</div>
</body>