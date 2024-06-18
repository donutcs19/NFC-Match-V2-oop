<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once('../config/cdn.php')?>
    <link rel="icon" type="image/png" href="../config/favicon/favicon-32x32.png">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <title>Sign-in Admin</title>
</head>
<body class="content" style="font-family: 'Courier New', Courier, monospace;">
    
<?php 
require_once('../config/connectDB.php');
require_once('../class/UserLogin.php');
require_once('../class/Alert.php');

$connectDB = new Database();
$db = $connectDB->getConnection();
$login = new UserLogin($db);
$alert = new Alert();

if (isset($_POST['sign-in'])){
$login->setUsername($_POST['username']);
$login->setPassword($_POST['password']);

if ($login->CheckUser()){
    $alert->display("Username not exists","danger");
    $alert->swal_alert("Username not exists","error");
}else{

    if ($login->verifyPassword()){
        $alert->swal_alert("Welcome Admin ^^ ","success");
    }else{
        $alert->display("Password is not exists","danger");
        $alert->swal_alert("Password is not exists","error");
    }
    
}


}
?>
  <header>
            <div class="logo text-center">
                <!-- <img src="images/NFC.png" alt="Logo Sign-in" width="10%"> -->
                <img src="images/dsimju.jpg" alt="Logo Sign-in" width="18.7%">
            </div>
        </header><br>
        <div class="container">
            <div class="row">
                <div class="col-md-offset-4 col-md-4 col-sm-offset-3 col-sm-6 col-xs-offset-3 col-xs-6 width-100">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
                        <div class="loginpage">
                            <input class="form-control placeholder-fix" type="text" placeholder="Username" name="username" required="">
                            <input class="form-control placeholder-fix" type="password" placeholder="Password" name="password" required="">
                        </div>
                        <div class="action-button">
                            <button class="btn-block" type="submit" name="sign-in">Sign-in</button> 
                        </div>
                    </form>
                </div>
                
            </div>
           <br>
            <a href="../index.php"><button class="btn btn-warning w-5">Home</button></a>

                <div class="copyright-box">
                    <div class="copyright">
                        <!--Do not remove Backlink from footer of the template. To remove it you can purchase the Backlink !-->
                        &copy; 2024 All right reserved. by <a href="http://www.themevault.net/" target="_blank"><strong>DSIMJU & LIBMJU</strong></a>
                    </div>
                </div>
            </div>
        </div>



</form>

</body>
</html>

