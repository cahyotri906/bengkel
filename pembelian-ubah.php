<?php
include_once 'header.php';
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

include_once 'includes/pembelian.inc.php';
$eks = new Pembelian($db);

$eks->id = $id;

$eks->readOne();

if($_POST){

	$eks->id_mekanik = $_POST['id_mekanik'];
	$eks->id_sparepart = $_POST['id_sparepart'];
	$eks->qty = $_POST['qty'];
	$eks->harga_jasa = $_POST['harga_jasa'];
	$eks->tgl_beli = $_POST['tgl_beli'];
	$eks->status = $_POST['status'];



	
	if($eks->update()){
		echo "<script>location.href='pembelian.php'</script>";
	} else{
?>
<script type="text/javascript">
window.onload=function(){
	showStickyErrorToast();
};
</script>
<?php
	}
}
?>
		<div class="row">

		  <div class="col-xs-12 col-sm-12 col-md-2">
			<?php
			include_once 'sidebar.php';
			?>
		  </div>
		  <div class="col-xs-12 col-sm-12 col-md-10">
		  <ol class="breadcrumb">
			  <li><a href="home.php"><span class="fa fa-home"></span> Beranda</a></li>
			  <li><a href="pembelian.php"><span class="fa fa-wrench"></span> Data Service</a></li>
			  <li class="active"><span class="fa fa-pencil"></span> Ubah Data</li>
			</ol>
		  	<p style="margin-bottom:10px;">
		  		<strong style="font-size:18pt;"><span class="fa fa-pencil"></span> Ubah Data Service</strong>
		  	</p>
		  	<div class="panel panel-default">
		<div class="panel-body">
			
			    <form method="post">
			    	
				  <div class="form-group">
				    <label for="nama_mekanik">Nama Mekanik</label>
				    <select class="form-control" id="id_mekanik" name="id_mekanik">
					<?php
					$conn = mysqli_connect("localhost","root","","bengkel");
					$i=0; 
					$result = mysqli_query($conn,"SELECT * FROM 213_mekanik");
					while($row = mysqli_fetch_array($result)) {
					?>
					<option value="<?=$row["id_mekanik"];?>"><?=$row["nama_mekanik"];?></option>
					<?php
					$i++;
					}
					?>
					</select>
				  </div>
				  <div class="form-group">
				    <label for="id_sparepart">Sparepart</label>
				    <select class="form-control" id="id_sparepart" name="id_sparepart">
					<?php
					$conn = mysqli_connect("localhost","root","","bengkel");
					$i=0;
					$result = mysqli_query($conn,"SELECT * FROM 213_sparepart where stock > 0 ");
					while($row = mysqli_fetch_array($result)) {
					?>
					
					<option value="<?=$row["id_sparepart"];?>"><?=$row["sparepart"];?></option>
					<?php
					$i++;
					}
					?>
					</select>
				  </div>
				  <div class="form-group">
				    <label for="qty">Jumlah (qty)</label>
				    <input type="number" class="form-control" id="qty" name="qty" value="<?php echo $eks->qty; ?>">
				  </div>
				  <div class="form-group">
				    <label for="tgl_beli">Tanggal Services</label>
				    <input type="text" class="form-control" id="tgl_beli" name="tgl_beli" value="<?php echo $eks->tgl_beli; ?>">
				  </div>
				  <div class="form-group">
				    <label for="harga_jasa">Harga</label>
				    <input type="text" class="form-control" id="harga_jasa" name="harga_jasa" value="<?php echo $eks->harga_jasa; ?>">
				  </div>
				  <div class="form-group">
				    <label for="status">Status</label>
				    <select type="text" class="form-control" id="status" name="status" value="<?php echo $eks->status; ?>">
				    	<option>Proses</option>
				    	<option>Selsai</option>
				    </select>
				  </div>
				
				  <button type="submit" class="btn btn-warning"><span class="fa fa-edit"></span> Ubah</button>
				  <button type="button" onclick="location.href='pembelian.php'" class="btn btn-success"><span class="fa fa-history"></span> Kembali</button>
				</form>
			  
		  </div></div></div>
		  <div class="col-xs-12 col-sm-12 col-md-2">
		  </div>
		</div>
		<?php
include_once 'footer.php';
?>