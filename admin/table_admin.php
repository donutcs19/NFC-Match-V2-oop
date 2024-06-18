<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once('../config/cdn.php');?>
    <link rel="icon" type="image/png" href="../config/favicon/favicon-32x32.png">
    <title>Admin Table</title>
</head>
<body style="font-family:'Courier New', Courier, monospace";> 
<?php include_once('bootstrap/nav.php')?>
<div class="container w-100">

<?php 
include_once('../class/UserLogin.php');
include_once('../config/connectDB.php');
include_once('../class/TableData.php');
include_once('../class/Alert.php');

if(!isset($_SESSION['userid'])){
    header("Location: ../login/login.php");
}


$connectDB = new Database();
$db = $connectDB->getConnection();
$user = new UserLogin($db);
$dataTable = new TableData($db);
$data_sh_table = $dataTable->FDataTable();
$alert = new Alert();

if(isset($_SESSION['userid'])){
    $userid = $_SESSION['userid'];
    $userData = $user->userData($userid);
    $admin = $userData['username'];
    $alert->swal_welcome('Welcome Admin : ' .$admin,'info');
    
}

if (isset($_GET['ID'])){
 $dataTable ->set_edit($_GET['ID']);

 if($dataTable->edit_status()){
    $alert->display("Status Success","success");
    $alert->swal_alert("Status Success","success");
    header("refresh:2; url=table_admin.php");
 }else{
    $alert->display("Not change status","danger");
    $alert->swal_alert("Not  change status","error");
 }
}
?>

    <h3 class="mt-3">Welcome Admin : <?php echo $userData['username'] ?></h3>
    <hr>
<table id="db_table" class="display" style="text-align: center;">
    <thead>
        <tr>
            <th>ID</th>
            <th>ชื่อ-นามสกุล</th>
            <th>รหัสบัตรประชาชน</th>
            <th>RFID (NFC)</th>
            <th>Confirm RFID (NFC)</th>
            <th>เวลาส่งข้อมูล</th>
            <th>เวลาอัปเดทสถานะ</th>
            <th>สถานะดำเนินการ</th>
            <th>Update</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($data_sh_table as $row) {?>
        <tr>
            <td><?php echo $row['id'];?></td>
            <td><?php echo $row['firstname'];?>  <?php echo $row['lastname'];?></td>
            <td><?php echo $row['id_card'];?></td>
            <td><?php echo $row['rfid'];?></td>
            <td><?php echo $row['c_rfid'];?></td>
            <td><?php echo $row['create_at'];?></td>
            <td><?php echo $row['update_date'];?></td>
            <td> <?php if ($row['status'] == 'wait'){?>
                <font color="red">รอดำเนินการ</font>
                <?php }else if ( $row['status'] == 'success'){ ?>
                <font color="green">ดำเนินการเรียบร้อย</font>
               <?php }else{ ?> <font color="red">[Error]!!!</font> <?php }?></td>
            <td><a href="table_admin.php?ID=<?php echo $row['id'];?>"><button class="btn btn-outline-warning" onclick="confirm('แก้ไขสภานะ ID : <?php echo $row['id'];?> ??')" name="edit"><i class="fa fa-pencil-square" aria-hidden="true"></i></button></a></td>
               
        </tr>
        <?php } ?>
        
    </tbody>
</table>
</div>
</body>
<?php include_once('../config/script.php')?>
</html>