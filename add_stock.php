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
$bname="";
$bprice="";
$bdes="";
$bid="";
$bnqty="";
if(isset($_POST['select'])){
    $bid=$_POST['select'];

    $result = mysqli_query($con, "SELECT * FROM book WHERE id='$bid' ");
    $row=mysqli_fetch_assoc($result);
    $bname=$row['name'];
    $bprice=$row['price'];
    $bdes=$row['description'];
}

if(isset($_POST['add'])){
    $name=$_POST['name'];
    $price=$_POST['price'];
    $qty=$_POST['qty'];

    $result = mysqli_query($con, "SELECT * FROM stock WHERE name='$name' ");
    if(mysqli_num_rows($result)==1){
        $row=mysqli_fetch_assoc($result);
        $sid=$row['id'];
        $oqty=$row['qty'];

        $nqty=$oqty+$qty;
        $result1 = mysqli_query($con, "UPDATE stock SET qty='$nqty' WHERE id='$sid' ");
    }
    else{
        $result2 = mysqli_query($con, "INSERT INTO stock(name,qty)VALUES('$name','$qty')");
    }

    if($result2||$result1) {
        header('Location:stock.php?success');
    }
    else{
        header('Location:stock.php?error');
    }
}


?>

<body>
<div class="container">
    <a class="btn btn-primary" href="stock.php">Back</a><br>
    <h1> Books </h1>
    <?php
    if(isset($_GET['error'])){
        echo '<p class="red">Error</p>';
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
                <form  method="post" action="add_stock.php" >
                    <td><button type="submit" name= "select" value = "<?php echo $id ?>" class="btn btn-warning">Select</button>
                    </td>
                </form>
            </tr>
            </tbody>
            <?php
        }
        ?>
    </table>
    <h1> Add Books </h1>
    <form action="add_stock.php" method="post" class="form-horizontal">
        <div class="form-group">
            <div class="form-row">
                <div class="col-md-7 col-sm-12"> <h5> Name </h5>
                    <input type="text" name="name" value="<?php echo $bname ?>" class="form-control"  placeholder="Name" required>
                </div>
                <div class="col-md-7 col-sm-12"> <h5> Description </h5>
                    <input type="text" name="des" value="<?php echo $bdes ?>" class="form-control"  placeholder="Description" required>
                </div>
                <div class="col-md-7 col-sm-12"> <h5> Price </h5>
                    <input type="text" name="price" value="<?php echo $bprice ?>" class="form-control"  placeholder="Price" required>
                </div>
                <div class="col-md-7 col-sm-12"> <h5> Qty </h5>
                    <input type="text" name="qty" class="form-control"  placeholder="Qty" required>
                </div>

            </div>
        </div>
        <div class="form-group">
            <div class="form-row">
                <div class="col-md-8 col-sm-6">
                    <button type="submit" name="add" class="btn btn-success">Add </button>
                </div><br>

            </div><br>
        </div>
    </form>



</div>
</body>
