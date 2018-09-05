<?php
session_start();
if(!isset($_SESSION['type'])){
    header('Location:login.php');
}
include_once("header.php");
include_once("db.php");
$totalamt="";
$result = mysqli_query($con, "SELECT SUM(total) AS totalamt FROM cart");
$row=mysqli_fetch_assoc($result);
$totalamt=$row['totalamt'];

if(isset($_POST['add'])){
    $cus=$_POST['customer'];
    $totalamt=$_POST['total'];
    $result = mysqli_query($con, "INSERT INTO invoice(customer,date,amount)VALUES('$cus',NOW(),$totalamt)");
    $inv_id = mysqli_insert_id( $con );
    $result1 = mysqli_query($con, "SELECT SUM(total) AS totalamt FROM cart");
    $result5 = mysqli_query($con,"SELECT * FROM cart");
    $rows=mysqli_num_rows($result5);
    for ($i = 1; $i <= $rows; $i++) {
        $result2 = mysqli_query($con,"SELECT * FROM cart WHERE id='$i'");
        $row=mysqli_fetch_assoc($result2);
        $name=$row['name'];
        $price=$row['price'];
        $qty=$row['qty'];
        $total=$row['total'];

        $result7 = mysqli_query($con,"SELECT * FROM stock WHERE name='$name'");
        $row=mysqli_fetch_assoc($result7);
        $oqty=$row['qty'];
        $nqty=$oqty-$qty;
        $result6 = mysqli_query($con, "UPDATE stock SET qty='$nqty' WHERE name='$name' ");
        $result3 = mysqli_query($con, "INSERT INTO invoice_item(invid,name,qty,price,total)VALUES('$inv_id','$name','$qty','$price','$total')");
    }
    if($result&& $result1 && $result2 && $result3) {
        $result4 = mysqli_query($con,"TRUNCATE TABLE cart");
        header('Location:report.php?success');
    }
    else{
        header('Location:report.php?error');
    }
}

?>

<body>
<div class="container">
    <a class="btn btn-primary" href="invoice.php">Back</a><br>
    <h1>Generate Invoice </h1>
    <table class="table table-hover ">
        <thead class="dark">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">name</th>
            <th scope="col">Price</th>
            <th scope="col">Qty</th>
            <th scope="col">Total</th>
        </tr>
        </thead>
        <?php
        $result = mysqli_query($con,"SELECT * FROM cart");
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
        ?>
    </table>
    <form action="add_invoice.php" method="post" class="form-horizontal">
        <div class="form-group">
            <div class="form-row">
                <div class="col-md-7 col-sm-12"> <h5> Customer Name </h5>
                    <input type="text" name="customer"  class="form-control"  placeholder="Customer Name" required>
                </div>
                <div class="col-md-7 col-sm-12"> <h5> Total Amount </h5>
                    <input type="text" name="total" value="<?php echo $totalamt ?>" class="form-control"  placeholder="Total" required>
                </div>

            </div>
        </div>
        <div class="form-group">
            <div class="form-row">
                <div class="col-md-8 col-sm-6">
                    <button type="submit" name="add" class="btn btn-success">Save invoice</button>
                </div><br>
            </div><br>
        </div>
    </form>
</div>
</body>
