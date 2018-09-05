<?php
session_start();
if(!isset($_SESSION['type'])){
    header('Location:login.php');
}
include_once("header.php");
include_once("db.php");

if(isset($_POST['add'])){
    $id=$_POST['add'];
    $qty=$_POST['qty'];
    $result = mysqli_query($con, "SELECT * FROM book WHERE id='$id' ");
    $row=mysqli_fetch_assoc($result);
    $name=$row['name'];
    $price=$row['price'];
    $total=$price*$qty;
    $result1 = mysqli_query($con, "SELECT * FROM stock WHERE name='$name' ");
    $row=mysqli_fetch_assoc($result1);
    if($row['qty']>=$qty){
        $result = mysqli_query($con, "INSERT INTO cart(name,price,qty,total)VALUES('$name','$price','$qty','$total')");
        if($result) {
            header('Location:invoice.php?success');
        }
    }
    else{
        header('Location:invoice.php?error');
    }
}
?>

<body>
<div class="container">

    <a class="btn btn-primary" href="index.php">Back</a><br>
    <h1> Select books  </h1>
    <?php
    if(isset($_GET['error'])){
        echo '<p class="red">Out of Stock</p>';
    }
    elseif(isset($_GET['success'])){
        echo '<p class="green">Add successfully</p>';
    }
    ?>
    <table class="table table-hover ">
        <thead class="dark">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">name</th>
            <th scope="col">Description</th>
            <th scope="col">Price</th>
            <th scope="col" width="200px">Qty</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <?php
        $result = mysqli_query($con,"SELECT * FROM book");

        while($row=mysqli_fetch_array($result)) {
            $id=$row['id'];
            $name=$row['name'];
            $price=$row['price'];
            $des=$row['description'];
            ?>
            <tbody>
            <tr>
                <th><?php echo $id?></th>
                <td><?php echo $name?></td>
                <td><?php echo $des?></td>
                <td><?php echo number_format($price,2)?></td>
                <form  method="post" action="invoice.php" >
                    <td><input type="text" name="qty" class="form-control"  placeholder="Qty" required></td>
                    <td><button type="submit" name= "add" value = "<?php echo $id ?>" class="btn btn-warning">Add To Invoice</button>
                    </td>
                </form>
            </tr>
            </tbody>
            <?php
        }
        ?>
    </table>
    <a class="btn btn-primary" href="add_invoice.php">Generate Invoice</a><br>
</div>
</body>
