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
$des="";
if(isset($_POST['add'])){
    $name=$_POST['name'];
    $price=$_POST['price'];
    $des=$_POST['des'];

    $result = mysqli_query($con, "INSERT INTO book(name,description,price)VALUES('$name','$des','$price')");
    if($result) {
        header('Location:book.php?success');
    }
    else{
        header('Location:book.php?error');
    }
}

if(isset($_POST['edit'])){
    $id=$_POST['edit'];

    $result = mysqli_query($con, "SELECT * FROM book WHERE id='$id' ");
    $row=mysqli_fetch_assoc($result);
    $name=$row['name'];
    $price=$row['price'];
    $des=$row['description'];

}

if(isset($_POST['update'])){
    $id=$_POST['update'];
    $name=$_POST['name'];
    $price=$_POST['price'];
    $des=$_POST['des'];

    $result = mysqli_query($con, "UPDATE book SET name='$name',price='$price', description='$des' WHERE id='$id' ");
    if($result) {
        header('Location:book.php?success');
    }
    else{
        header('Location:book.php?error');
    }
}

if(isset($_POST['delete'])){
    $id=$_POST['delete'];

    $result = mysqli_query($con, "DELETE FROM book WHERE id='$id' ");
    if($result) {
        header('Location:book.php?success');
    }
    else{
        header('Location:book.php?error');
    }
}


?>

<body>
<div class="container">
    <a class="btn btn-primary" href="index.php">Back</a><br>
    <?php
    if(isset($_GET['error'])){
        echo '<p class="red">Error</p>';
    }
    elseif(isset($_GET['success'])){
        echo '<p class="green">Add successfully</p>';
    }
    ?>
    <h1> Add New Books </h1>
    <form action="book.php" method="post" class="form-horizontal">

        <div class="form-group">
            <div class="form-row">
                <div class="col-md-7 col-sm-12"> <h5> Name </h5>
                    <input type="text" name="name" value="<?php echo $name ?>" class="form-control"  placeholder="Name" required>
                </div>
                <div class="col-md-7 col-sm-12"> <h5> Description </h5>
                    <input type="text" name="des" value="<?php echo $des ?>" class="form-control"  placeholder="Description" required>
                </div>
                <div class="col-md-7 col-sm-12"> <h5> Price </h5>
                    <input type="text" name="price" value="<?php echo $price ?>" class="form-control"  placeholder="Price" required>
                </div>

            </div>
        </div>
        <div class="form-group">
            <div class="form-row">
                <div class="col-md-8 col-sm-6">
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
                <form  method="post" action="book.php" >
                    <td><button type="submit" name= "edit" value = "<?php echo $id ?>" class="btn btn-warning">Edit</button>
                        <button type="submit" name= "delete" value = "<?php echo $id ?>" class="btn btn-danger">Delete</button>
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