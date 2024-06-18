<?php 
class UserLogin {

    private $conn;
    private $table_db = 'users';

    public $username;
    public $password;

    public function __construct($db){
        $this->conn = $db;
    }

    public function setUsername($username){
        $this->username = $username;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function CheckUser(){
        $query = "SELECT id FROM {$this->table_db} WHERE username = :username LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $this->username);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            return true;
        }else{
            return false;
        }
    }

    public function verifyPassword() {
        $query = "SELECT id, password FROM {$this->table_db} WHERE username = :username LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $this->username);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $hashPassword = $row['password'];

            if (password_verify($this->password ,$hashPassword))
            {
                $_SESSION['userid'] = $row['id'];
                header("Location: ../admin/table_admin.php");
            } else {
                return false; // Passwords do not match
            }
        } 
        return false; // email not found
    }

    public function userData($userid) {
        $id = $userid;
        $query = "SELECT * FROM {$this->table_db} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user;
        } else {
            return false;
        }
    }
    public function logOut() {
        session_start();
        unset($_SESSION['user_id']);
        // session_destroy();
        header("Location: ../table_all.php");
        exit;
    }
    
}
?>