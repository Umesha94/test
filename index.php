<?php
session_start();
if(!isset($_SESSION['id'])){
    header('Location:login.php');
}
include_once("header.php");
?>
<body>
<div class="container">
<h1> HOMES </h1>
</div>

<div class="container">

    <div class="cons">
        <?php if($_SESSION['type']==1){ ?>
            <a class="btn btn-danger col-md-12 col-sm-12" href="book.php">BOOKS</a>
            <a class="btn btn-danger col-md-12 col-sm-12" href="stock.php">STOCK</a>
            <a class="btn btn-danger col-md-12 col-sm-12" href="report.php">REPORT</a>
            <?php
        }?>
        <a class="btn btn-danger col-md-12 col-sm-12" href="invoice.php">INVOICE</a>
        <a class="btn btn-danger col-md-12 col-sm-12" href="logout.php">Logout</a>
    </div>
</div>
</body>


