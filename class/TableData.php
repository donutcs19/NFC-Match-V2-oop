<?php 
        class TableData{
            private $conn;
            private $table_db = 'nfc_match';

            private $id_edit;

            public function __construct($db){
                $this->conn = $db;   
            }

            public function set_edit($id_edit){
                $this->id_edit = $id_edit;
            }

            public function FDataTable(){
                $query = "SELECT * FROM {$this->table_db} ";
                $stmt = $this->conn->prepare($query);
                $stmt->execute();

                if ($stmt->rowCount() > 0){
                    $dataTable = $stmt->fetchALL();
                    return $dataTable;
                }else{
                    return false;
                }
            }

            public function edit_status(){
                $query = "UPDATE {$this->table_db} SET status = 'success', update_date = CURRENT_TIMESTAMP() WHERE id= $this->id_edit"; 
                $stmt = $this->conn->prepare($query);

                if ($stmt->execute()){
                return true;
                }else{
                return false;
                }
            }

        }

       
?>