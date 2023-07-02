<?php
class Pembelian{
  
  private $conn;
  private $table_name = "213_pembelian";
  
  public $id;
  public $id_mekanik;
  public $id_sparepart;
  public $qty;
  public $harga_jasa;
  public $tgl_beli;



  
  public function __construct($db){
    $this->conn = $db;
  }
  
  
 function insert(){
		
		
		$query = "insert into ".$this->table_name." values('',?,?,?,?,?,?)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id_mekanik);
		$stmt->bindParam(2, $this->id_sparepart);
		$stmt->bindParam(3, $this->qty);
		$stmt->bindParam(4, $this->harga_jasa);
		$stmt->bindParam(5, $this->tgl_beli);
		$stmt->bindParam(6, $this->status);

		
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		
	}
	
	
	
	function readAll(){

		$query = "SELECT * FROM 213_pembelian JOIN 213_mekanik ON 213_pembelian.id_mekanik=213_mekanik.id_mekanik JOIN 213_sparepart ON 213_pembelian.id_sparepart=213_sparepart.id_sparepart";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt;
	}
	function readmen(){

		$query = "select 213_pembelian.id_mekanik, count(*) from 213_pembelian inner join 213_mekanik on 213_pembelian.id_mekanik = 213_mekanik.id_mekanik group by 213_pembelian.id_mekanik";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt;
	}
	
	// used when filling up the update product form
	function readOne(){
    
    $query = "SELECT * FROM ".$this->table_name." WHERE id_pembelian=? LIMIT 0,1";

    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $this->id_pembelian = $row['id_pembelian'];
    $this->id_mekanik = $row['id_mekanik'];
    $this->id_sparepart = $row['id_sparepart'];
    $this->qty = $row['qty'];
    $this->harga_jasa = $row['harga_jasa'];
    $this->tgl_beli = $row['tgl_beli'];
    $this->status = $row['status'];

  }
  
	// update the product
function update(){

    $query = "UPDATE 
			" . $this->table_name . " 
        SET  
          id_mekanik = :id_mekanik,
          id_sparepart = :id_sparepart,
		  qty	 = :qty,
		  harga_jasa	 = :harga_jasa,
		  tgl_beli	 = :tgl_beli,
		  status	 = :status

	
    
        WHERE
          id_pembelian = :id";

    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(':id_mekanik', $this->id_mekanik);
	$stmt->bindParam(':id_sparepart', $this->id_sparepart);
	$stmt->bindParam(':qty', $this->qty);
	$stmt->bindParam(':harga_jasa', $this->harga_jasa);
	$stmt->bindParam(':tgl_beli', $this->tgl_beli);
	$stmt->bindParam(':status', $this->status);
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
	
		$query = "DELETE FROM " . $this->table_name . " WHERE id_pembelian = ?";
		
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);

		if($result = $stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	function countAll(){

		$query = "SELECT * FROM 213_pembelian JOIN 213_mekanik ON 213_pembelian.id_mekanik=213_mekanik.id_mekanik JOIN 213_sparepart ON 213_pembelian.id_sparepart=213_sparepart.id_sparepart";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt->rowCount();
	}
	function hapusell($ax){
	
		$query = "DELETE FROM " . $this->table_name . " WHERE id_pembelian in $ax";
		
		$stmt = $this->conn->prepare($query);

		if($result = $stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
}
?>