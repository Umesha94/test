<?php 
session_start();
if(!isset($_SESSION['type'])){
    header('Location:login.php');
}
else{
    if($_SESSION['type']!=2){
        header('Location:index.php');
    }
}
include_once("header.php");
include_once("db.php");
$id="";
$name="";
$qty="";
$totprice="";
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
<form action="item.php" method="post" class="form-horizontal">

<div class="form-group">
    <div class="form-row">
        <div class="col-md-7 col-sm-12"> <h5> Invoice No </h5>
            <input type="text" name="invoice no" value="<?php echo $id ?>" class="form-control"  placeholder="invo_id" required>
        </div>
        <div class="col-md-7 col-sm-12"> <h5> Item name </h5>
            <input type="text" name="name" value="<?php echo $name ?>" class="form-control"  placeholder="name" required>
        </div>
        <div class="col-md-7 col-sm-12"> <h5> Quantity </h5>
            <input type="text" name="qty" value="<?php echo $qty ?>" class="form-control"  placeholder="Qty" required>
        </div>
        <div class="col-md-7 col-sm-12"> <h5> Total amount </h5>
            <input type="text" name="amount" value="<?php echo $totprice ?>" class="form-control"  placeholder="amount" required>
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
            <th scope="col">invoice_ID</th>
            <th scope="col">item_name</th>
            <th scope="col">amount</th>
            <th scope="col">qty</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    
                           
</table>
</body>