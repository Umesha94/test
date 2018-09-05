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
    <a class="btn btn-primary" href="index.php">Back</a><br>
    <h1> Invoice Details </h1>

    <table class="table table-hover ">
        <thead class="dark">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Customer</th>
            <th scope="col">Date</th>
            <th scope="col">Total</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <?php
        $result = mysqli_query($con,"SELECT * FROM invoice");

        while($row=mysqli_fetch_array($result)) {
            $id=$row['id'];
            $name=$row['customer'];
            $date=$row['date'];
            $total=$row['amount'];
            ?>
            <tbody>
            <tr>
                <th><?php echo $id?></th>
                <td><?php echo $name?></td>
                <td><?php echo $date?></td>
                <td><?php echo number_format($total,2)?></td>
                <form  method="post" action="book.php" >
                    <td><a class="btn btn-warning" href="invoice_item.php?id=<?php echo $id?>">View</a></td>
            </tr>
            </tbody>
            <?php
        }
        ?>
    </table>

</div>
</body>