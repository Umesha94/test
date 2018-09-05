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
    <a class="btn btn-primary" href="report.php">Back</a><br>
    <h1>Invoice Item Details</h1>

    <table class="table table-hover ">
        <thead class="dark">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Qty</th>
            <th scope="col">Amount</th>
        </tr>
        </thead>
        <?php
        if(isset($_GET['id'])){
        $id=$_GET['id'];
        $result = mysqli_query($con,"SELECT * FROM invoice_item WHERE invid='$id'");

        while($row=mysqli_fetch_array($result)) {
            $id=$row['id'];
            $name=$row['name'];
            $price=$row['price'];
            $qty=$row['qty'];
            $total=$row['total'];
            ?>
            <tbody>
            <tr>
                <th><?php echo $id?></th>
                <td><?php echo $name?></td>
                <td><?php echo number_format($price,2)?></td>
                <td><?php echo $qty?></td>
                <td><?php echo number_format($total,2)?></td>
            </tr>
            </tbody>
            <?php
        }
        }
        ?>


    </table>

</div>
</body>