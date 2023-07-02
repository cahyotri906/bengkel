<?php
include_once 'header.php';
if($_POST){
	
	include_once 'includes/sparepart.inc.php';
	$eks = new Sparepart($db);

	$eks->sparepart = $_POST['sparepart'];
	$eks->stock = $_POST['stock'];
	$eks->harga = $_POST['harga'];

	
	if($eks->insert()){
?>
<script type="text/javascript">
window.onload=function(){
	showStickySuccessToast();
};
</script>
<?php
	}
	
	else{
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
			  <li><a href="sparepart.php"><span class="fa fa-cogs"></span> Sparepart</a></li>
			  <li class="active"><span class="fa fa-clone"></span> Tambah Data</li>
			</ol>
		  	<p style="margin-bottom:10px;">
		  		<strong style="font-size:18pt;"><span class="fa fa-cogs"></span> Tambah Data Sparepart</strong>
		  	</p>
		  	<div class="panel panel-default">
		<div class="panel-body">
			
			    <form method="post">
				  <div class="form-group">
				    <label for="sparepart">Nama Sparepart</label>
				    <input type="text" class="form-control" id="sparepart" name="sparepart" required>
				  </div>
				<div class="form-group">
				    <label for="stock">Stok</label>
				    <input type="text" class="form-control" id="stock" name="stock" required>
				  </div>
				<div class="form-group">
				    <label for="harga">Harga</label>
				    <input type="text" class="form-control" id="harga" name="harga" required>
				  </div>
				  </div>
				  <button type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Simpan</button>
				  <button type="button" onclick="location.href='sparepart.php'" class="btn btn-success"><span class="fa fa-history"></span> Kembali</button>
				</form>
				</div>
				</div>
			  
		  </div>
		</div>
		<?php
include_once 'footer.php';
?>