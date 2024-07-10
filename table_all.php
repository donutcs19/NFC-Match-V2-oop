<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once('config/cdn.php');?>
    <link rel="icon" type="image/png" href="config/favicon/favicon-32x32.png">
    <title>Table Matc RFID</title>
   
</head>
<body style="font-family:'Courier New', Courier, monospace";> 
<?php require_once('bootstrap/nav.php')?>
<div class="container">

<?php 
require_once('config/connectDB.php');
require_once('class/TableData.php');
$connectDB = new Database();
$db = $connectDB->getConnection();
$dataTable = new TableData($db);
$data_sh_table = $dataTable->FDataTable();
?>

    <h3 class="mt-3">Table Matc RFID</h3>
    <hr>
<table id="db_table" class="display" style="text-align: center;">
    <thead>
        
            <th>ID</th>
            <th>ID_card</th>
            <th>ชื่อ-นามสกุล</th>
            <th>RFID (NFC)</th>
            <th>Confirm RFID (NFC)</th>
            <th>เวลาส่งข้อมูล</th>
            <th>เวลาอัปเดทสถานะ</th>
            <th>สถานะดำเนินการ</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($data_sh_table as $row) {?>
        <tr>
            <td><?php echo $row['id'];?></td>
            <td><?php echo $row['id_card'];?></td>
            <td><?php echo $row['fname'];?>  <?php echo $row['lname'];?></td>
            <td><?php echo $row['nfc'];?></td>
            <td><?php echo $row['nfc_cf'];?></td>
            <td><?php echo $row['create_at'];?></td>
            <td><?php echo $row['update_at'];?></td>
            <td> <?php if ($row['status'] == 'wait'){?>
                <font color="red">รอดำเนินการ</font>
                <?php }else if ( $row['status'] == 'success'){ ?>
                <font color="green">ดำเนินการเรียบร้อย</font>
               <?php }else{ ?> <font color="red">[Error]!!!</font> <?php }?></td>
        </tr>
        <?php } ?>
        
    </tbody>
</table>
</div>
</body>
<?php require_once('config/script.php')?>
</html>