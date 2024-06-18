<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php require_once('config/cdn.php');?>
<link rel="icon" type="image/png" href="config/favicon/favicon-32x32.png">
    <title>Match NFC</title>
</head>
<body style="font-family: 'Courier New', Courier, monospace;">

<?php 
require_once('config/connectDB.php');
require_once('class/nfcMatch.php');
require_once('class/Alert.php');
require_once('bootstrap/nav.php');

$connectDB = new Database();
$db = $connectDB->getConnection();
$match = new NfcMatch($db);
$alert = new Alert();

$alert->swal_welcome('Welcome Admin : LIBMJU','info');

if (isset($_POST['submit'])){
    $match->set_fname($_POST['fname']);
    $match->set_lname($_POST['lname']);
    $match->set_idCard($_POST['id_card']);
    $match->set_nfc($_POST['nfc']);
    $match->set_nfcConfirm($_POST['nfc_cf']);

    if(!$match->NFCMatch()){
        $alert->display('เลข NFC ไม่ตรงกัน!!!','danger');
        $alert->swal_alert('เลข NFC ไม่ตรงกัน!!!','error');
    }

    if($match->CheckNFC()){
        $alert->display('มีเลข NFC อยู่ในระบบแล้ว','danger');
        $alert->swal_alert('มีเลข NFC อยู่ในระบบแล้ว','error');
    }

    if ($match->CreateNFC()){
        $alert->display("เพิ่มข้อมูลสำเร็จ <a href='table_all.php'>คลิกเพื่อดูข้อมูล</a>", "success");
        $alert->swal_alert("เพิ่มข้อมูลสำเร็จ","success");

        
    }
}

?>


<div class="container w-50 mt-3 p-3">
    
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST" class="was-validated">
        <div class="mb-3 mt-3">
            <label for="fname" class="form-label">ชื่อ : </label>
            <input type="text" class="form-control" name="fname" id="fname"  required>
            <div class="invalid-feedback">กรุณากรอกชื่อ</div>
        </div>
        <div class="mb-3">
            <label for="lname" class="form-label">นามสกุล : </label>
            <input type="text" class="form-control" name="lname" id="lname" required>
            <div class="invalid-feedback">กรุณากรอกนามสกุล</div>
        </div>
        <div class="mb-3">
            <label for="id_card" class="form-label">เลขบัตรประชาชน/พาสปอร์ต : </label>
            <input type="text" class="form-control" name="id_card" id="id_card" required>
            <div class="invalid-feedback">กรุณากรอกเลขบัตรประชาชน/พาสปอร์ต</div>
        </div>
        <div class="mb-3">
            <label for="nfc" class="form-label"> NFC (RFID) : </label>
            <input type="text" class="form-control" name="nfc" id="nfc"  required>
            <div class="invalid-feedback">กรุณากรอกเลข RFID (NFC) <br> ***กรณีใช้งาน MJU Mobile app, กรุณากรอกเครื่องหมาย -</div>
        </div>
        <div class="mb-3">
            <label for="nfc_cf" class="form-label"> ยืนยันเลข NFC (RFID) : </label>
            <input type="text" class="form-control" name="nfc_cf" id="nfc_cf"  required>
            <div class="invalid-feedback">กรุณายืนยันเลข RFID (NFC) <br> ***กรณีใช้งาน MJU Mobile app, กรุณากรอกเครื่องหมาย -</div>
        </div>
     
<hr>
            <input type="submit" name="submit"  value="บันทึกข้อมูล" class="btn btn-outline-primary w-100 ">
            </form>
            </div>


</body>
<?php require_once('config/script.php');?>

</html>