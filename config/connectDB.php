<?php 
class Database {
    private $host = "localhost";
    private $db = "oop_crud_app";
    private $username ="";
    private $password ="";

    private $charset = "utf8";
    public $conn;

    public function getConnection(){
        $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->db.";charset=".$this->charset.";", $this->username, $this->password);
            // echo "[Success] -> Connect successfuly ";
        }catch(PDOException $e){
            echo "[Error] -> ".$e->getMessage();
        }
        return $this->conn;
    }

}
?>
