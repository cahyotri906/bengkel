<?php
include_once 'header.php';
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

include_once 'includes/sparepart.inc.php';
$eks = new Sparepart($db);

$eks->id = $id;

$eks->readOne();

if($_POST){

	$eks->sparepart = $_POST['sparepart'];
	$eks->stock = $_POST['stock'];
	$eks->harga = $_POST['harga'];



	
	if($eks->update()){
		echo "<script>location.href='sparepart.php'</script>";
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
			  <li><a href="sparepart.php"><span class="fa fa-gears"></span> Data Sparepart</a></li>
			  <li class="active"><span class="fa fa-pencil"></span> Ubah Data</li>
			</ol>
		  	<p style="margin-bottom:10px;">
		  		<strong style="font-size:18pt;"><span class="fa fa-pencil"></span> Ubah Data Sparepart</strong>
		  	</p>
		  	<div class="panel panel-default">
		<div class="panel-body">
			
			    <form method="post">
			    	
				  <div class="form-group">
				    <label for="sparepart">Sparepart</label>
				    <input type="text" class="form-control" id="sparepart" name="sparepart" value="<?php echo $eks->sparepart; ?>">
				  </div>
				  <div class="form-group">
				    <label for="stock">Stok</label>
				    <input type="text" class="form-control" id="stock" name="stock" value="<?php echo $eks->stock; ?>">
				  </div>
				  <div class="form-group">
				    <label for="harga">Harga</label>
				    <input type="text" class="form-control" id="harga" name="harga" value="<?php echo $eks->harga; ?>">
				  </div>
				
				  <button type="submit" class="btn btn-warning"><span class="fa fa-edit"></span> Ubah</button>
				  <button type="button" onclick="location.href='sparepart.php'" class="btn btn-success"><span class="fa fa-history"></span> Kembali</button>
				</form>
			  
		  </div></div></div>
		  <div class="col-xs-12 col-sm-12 col-md-2">
		  </div>
		</div>
		<?php
include_once 'footer.php';
?>