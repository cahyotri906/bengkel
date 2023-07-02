<?php
class Sparepart{
  
  private $conn;
  private $table_name = "213_sparepart";
  
  public $id;
  public $sparepart;
  public $stock;
  public $harga;



  
  public function __construct($db){
    $this->conn = $db;
  }
  
  
  function insert(){
    
    $query = "insert into ".$this->table_name." values('',?,?,?)";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->sparepart);
    $stmt->bindParam(2, $this->stock);
    $stmt->bindParam(3, $this->harga);



	
	
    
    if($stmt->execute()){
      return true;
    }
	else{
      return false;
    }
  
  }

  	function readAll(){

		$query = "SELECT * FROM ".$this->table_name." ORDER BY id_sparepart ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt;
	}
	
	function countAll(){

		$query = "SELECT * FROM ".$this->table_name;
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt->rowCount();
	}
  
  function readOne(){
    
    $query = "SELECT * FROM ".$this->table_name." WHERE id_sparepart=? LIMIT 0,1";

    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $this->id = $row['id_sparepart'];
    $this->sparepart = $row['sparepart'];
    $this->stock = $row['stock'];
    $this->harga = $row['harga'];

  }
  
  // update the product
  function update(){

    $query = "UPDATE 
			" . $this->table_name . " 
        SET  
          sparepart = :sparepart,
		  stock	 = :stock,
		  harga	 = :harga

	
    
        WHERE
          id_sparepart = :id";

    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(':sparepart', $this->sparepart);
	$stmt->bindParam(':stock', $this->stock);
	$stmt->bindParam(':harga', $this->harga);
    $stmt->bindParam(':id', $this->id);

    
    // execute the query
    if($stmt->execute()){
      return true;
    }else{
      return false;
    }
  }
  
  // delete the product
  function delete(){
  
    $query = "DELETE FROM " . $this->table_name . " WHERE id_sparepart = ?";
    
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id);

    if($result = $stmt->execute()){
      return true;
    }else{
      return false;
    }
  }
  function hapusell($ax){
  
    $query = "DELETE FROM " . $this->table_name . " WHERE id_sparepart in $ax";
    
    $stmt = $this->conn->prepare($query);

    if($result = $stmt->execute()){
      return true;
    }else{
      return false;
    }
  }
}
?>