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
$id="";
$name="";
$price="";
$qty="";
if(isset($_POST['add'])){
    $name=$_POST['name'];
    $price=$_POST['price'];
    $qty=$_POST['qty'];

    $result = mysqli_query($con, "INSERT INTO PRODUCT(name,price,qty)VALUES('$name','$price','$qty')");
    if($result) {   
            header('Location:product.php?success');       
    }
    else{
        header('Location:product.php?error');
    }
}

if(isset($_POST['edit'])){
    $id=$_POST['edit'];

    $result = mysqli_query($con, "SELECT * FROM product WHERE id='$id' ");
    $row=mysqli_fetch_assoc($result);
    $name=$row['name'];
    $price=$row['price'];
    $qty=$row['qty'];

}

if(isset($_POST['update'])){
    $id=$_POST['update'];
    $name=$_POST['name'];
    $price=$_POST['price'];
    $qty=$_POST['qty'];

    $result = mysqli_query($con, "UPDATE product SET name='$name',price='$price', qty='$qty' WHERE id='$id' ");
    if($result) {   
        header('Location:product.php?success');       
        }
    else{
         header('Location:product.php?error');
    }   
}

if(isset($_POST['delete'])){
    $id=$_POST['delete'];

    $result = mysqli_query($con, "DELETE FROM product WHERE id='$id' ");
    if($result) {   
        header('Location:product.php?success');       
        }
    else{
         header('Location:product.php?error');
    }   
}


?>

<body>
<div class="container">
                                        <?php
                                        if(isset($_GET['error'])){
                                            echo '<p class="red">Error</p>';
                                        }
                                        elseif(isset($_GET['success'])){
                                            echo '<p class="green">Add successfully</p>';
                                        }                                       
                                        ?>
<form action="product.php" method="post" class="form-horizontal">

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-7 col-sm-12"> <h5> Name </h5>
                                                    <input type="text" name="name" value="<?php echo $name ?>" class="form-control"  placeholder="Name" required>
                                                </div>
                                                <div class="col-md-7 col-sm-12"> <h5> Price </h5>
                                                    <input type="text" name="price" value="<?php echo $price ?>" class="form-control"  placeholder="Price" required>
                                                </div>
                                                <div class="col-md-7 col-sm-12"> <h5> Quantity </h5>
                                                    <input type="text" name="qty" value="<?php echo $qty ?>" class="form-control"  placeholder="Qty" required>
                                                    <h3> </h3>
                                                </div>
                                            </div><br><br>
                                            <div class="form-row">
                                                <div class="col-md-6 col-sm-6">
                                                    <button type="submit" name="add" class="btn btn-success">Add</button> 
                                                    <button type="submit" name="update" value="<?php echo $id ?>" class="btn btn-success">Update</button>                                                
                                                </div><br>
                                            
                                            </div><br>
                                        </div>
                                    </form>

        <table class="table table-hover ">
                            <thead class="dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">name</th>
                                <th scope="col">price</th>
                                <th scope="col">qty</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <?php
                            $result = mysqli_query($con,"SELECT * FROM product");
        
                            while($row=mysqli_fetch_array($result)) {
                                $id=$row['id'];
                                $name=$row['name'];
                                $price=$row['price'];
                                $qty=$row['qty'];
                                ?>
                                <tbody>
                                <tr>
                                    <th><?php echo $id?></th>
                                    <td><?php echo $name?></td>
                                    <td><?php echo $price?></td>
                                    <td><?php echo $qty?></td>
                                    <form  method="post" action="product.php" >
                                        <td><button type="submit" name= "edit" value = "<?php echo $id ?>" class="btn btn-secondary">Edit</button>
                                            <button type="submit" name= "delete" value = "<?php echo $id ?>" class="btn btn-secondary">Delete</button>
                                        </td>
                                    </form>
                                </tr>
                                </tbody>
                            <?php
                            }
                         ?>
                        </table>

</div>
</body>