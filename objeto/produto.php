<?php
class Product{
  
    private $conn;
    private $table_name = "products";
 
    public $id;
    public $name;
    public $price;
    public $description;
   
    public $timestamp;
 
    public function __construct($db){
        $this->conn = $db;
    }

    function getTimestamp(){
        date_default_timezone_set('America/Sao_Paulo');
        $this->timestamp = date('Y-m-d H:i:s');
        // echo $this->timestamp;
    }
 
    function create(){
 
        $this->getTimestamp();
       
        $query = "INSERT INTO
                    " . $this->table_name . "
                  SET
                  name = ?, price = ?, description = ?, created = ?";
 
        $stmt = $this->conn->prepare($query);
 
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->timestamp=htmlspecialchars(strip_tags($this->timestamp));
 
        $stmt->bindParam(1, $this->name);
        $stmt->bindParam(2, $this->price);
        $stmt->bindParam(3, $this->description);
        $stmt->bindParam(4, $this->timestamp);
        
        
        // var_dump(expression)($this->name);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
 
    }

    

    function readAll($page, $from_record_num, $records_per_page){
 
        $query = "SELECT
                    id, name, description, price
                FROM
                    " . $this->table_name . "
                ORDER BY
                    name ASC ";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
     
        return $stmt;
    }

    function readOne(){
 
        $query = "SELECT
                    name, price, description
                FROM
                    " . $this->table_name . "
                WHERE
                    id = ?
                LIMIT
                    0,1";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
     
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
        $this->name = $row['name'];
        $this->price = $row['price'];
        $this->description = $row['description'];
       
    }

    function update(){
 
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    name = :name,
                    price = :price,
                    description = :description
                WHERE
                    id = :id";
     
        $stmt = $this->conn->prepare($query);
     
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->id=htmlspecialchars(strip_tags($this->id));
     
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    function delete(){
 
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
         
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
     
        if($result = $stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

}
?>