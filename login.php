<?php 
include_once("header.php");
include_once("db.php");
session_start();

if(isset($_POST['login'])){
    $name=$_POST['name'];
    $password=$_POST['password'];

    $result = mysqli_query($con, "SELECT * FROM user WHERE name='$name' AND password='$password' LIMIT 1");
    if(mysqli_num_rows($result)==1){
        $row=mysqli_fetch_assoc($result);
        $_SESSION['id']=$row['id'];
        $_SESSION['type']=$row['type'];
        header('Location:index.php'); 
    }else{
        header('Location:login.php?error'); 
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
<form action="login.php" method="post" class="form-horizontal">

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6 col-sm-12">
                                                    <input type="text" name="name"  class="form-control"  placeholder="Name" required>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <input type="password" name="password"  class="form-control"  placeholder="Password" required>
                                                </div>
                                            </div><br><br>
                                            <div class="form-row">
                                                <div class="col-md-6 col-sm-6">
                                                    <button type="submit" name="login" class="btn btn-success">login</button> 
                                                </div><br>
                                            
                                            </div><br>
                                        </div>
                                    </form>
                                    </body>