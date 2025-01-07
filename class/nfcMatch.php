<?php 
    class NfcMatch {
        private $conn;
        private $table_db = 'nfc_match';

        public $fname;
        public $lname;
        public $id_card;
        public $nfc;
        public $nfc_cf;
       

    public function __construct($db){
        $this->conn = $db;
    }

    public function set_fname($fname){
        $this->fname = $fname;
    }

    public function set_lname($lname){
        $this->lname = $lname;
    }

    public function set_idCard($id_card){
        $this->id_card = $id_card;
    }

    public function set_nfc($nfc){
        $this->nfc = $nfc;
    }

    public function set_nfcConfirm($nfc_cf){
        $this->nfc_cf = $nfc_cf;
    }


    
    public function CheckNFCvsID(){
        if ($this->nfc == $this->id_card || $this->nfc_cf == $this->id_card){
           return false;
        }
        return true;
    } 
       
    public function NFCMatch(){
        if ($this->nfc !== $this->nfc_cf){
            return false;
        }
        return true;
    }

    public function validateUserInput(){
        if (!$this->NFCMatch()){
            return false;
        }
        return true;
    }


    public function CheckNFC(){
        $query = "SELECT id FROM {$this->table_db} WHERE nfc = :nfc  LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nfc", $this->nfc);
        $stmt->execute();

        if ($stmt->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }
public function CreateNFC(){
if (!$this->validateUserInput() || $this->CheckNFC() || !$this->CheckNFCvsID()){
return false;
}
$query ="INSERT INTO {$this->table_db} 
(fname, lname, id_card, nfc, nfc_cf, `create_at`, `update_at`, `status`)  
VALUES (:fname, :lname, :id_card, :nfc, :nfc_cf, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, 'wait')" ;
$stmt = $this->conn->prepare($query);
$this->fname = htmlspecialchars(strip_tags($this->fname));
$this->lname = htmlspecialchars(strip_tags($this->lname));
$this->id_card = htmlspecialchars(strip_tags($this->id_card));
$this->nfc = htmlspecialchars(strip_tags($this->nfc));
$this->nfc_cf = htmlspecialchars(strip_tags($this->nfc_cf));

$stmt->bindParam(":fname", $this->fname);
$stmt->bindParam(":lname", $this->lname);
$stmt->bindParam(":id_card", $this->id_card);
$stmt->bindParam(":nfc", $this->nfc);
$stmt->bindParam(":nfc_cf", $this->nfc_cf);

// if ($stmt->execute()){

//     if ($this->nfc != '-' && $this->nfc_cf != '-') {
//         //  AhWyoU0fhG6Nj5QPw36Hnw7E0MhtPu3BTywpNYsM2yg token
//         $sToken = "AhWyoU0fhG6Nj5QPw36Hnw7E0MhtPu3BTywpNYsM2yg";
//         $sMessage = "\r\n";
//         $sMessage .= "ID No./Passport No. : " . $this->id_card . "\r\n";
//         $sMessage .= "ชื่อ-นามสกุล: " . $this->fname . " " . $this->lname . " \r\n";
//         $sMessage .= "RFID: " . $this->nfc . " \r\n";
//         $sMessage .= "ยืนยัน RFID: " . $this->nfc_cf . " \r\n";
//     } else {
//         //  AhWyoU0fhG6Nj5QPw36Hnw7E0MhtPu3BTywpNYsM2yg token
//         $sToken = "AhWyoU0fhG6Nj5QPw36Hnw7E0MhtPu3BTywpNYsM2yg";
//         $sMessage = "\r\n";
//         $sMessage .= "ID No./Passport No. : " . $this->id_card . "\r\n";
//         $sMessage .= "ชื่อ-นามสกุล: " . $this->fname . " " . $this->lname . " \r\n";
//         $sMessage .= "ไม่มีบัตรขอใช้งานผ่าน MJU Mobile\r\n";
//     }


//     $chOne = curl_init();
//     curl_setopt($chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
//     curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0);
//     curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0);
//     curl_setopt($chOne, CURLOPT_POST, 1);
//     curl_setopt($chOne, CURLOPT_POSTFIELDS, "message=" . $sMessage);
//     $headers = array('Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer ' . $sToken . '',);
//     curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
//     curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);
//     $result = curl_exec($chOne);

//     //Result error 
//     if (curl_error($chOne)) {
//         echo 'error:' . curl_error($chOne);
//     } else {
//         $result_ = json_decode($result, true);
//         // echo "status : " . $result_['status'];
//         // echo "message : " . $result_['message'];
//     }
//     curl_close($chOne);
//     return true;
// }else{
//     return false;
// }

}


    
    
    }

    



    
?>
