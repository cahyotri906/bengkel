<?php
session_start();
if(!isset($_SESSION['nama_pengguna'])){
	echo "<script>location.href='login.php'</script>";
}
 
?>
<?php
 //KONEKSI
$host="localhost"; //isi dengan host anda. contoh "localhost"
$user="root"; //isi dengan username mysql anda. contoh "root"
$password=""; //isi dengan password mysql anda. jika tidak ada, biarkan kosong.
$database="bengkel";//isi nama database dengan tepat.
$konek = mysqli_connect($host,$user,$password,$database);
?>

<style type="text/css">
p{
	text-align:right;
	font-style:bold;
	font-size:12px
}
h4, h1, h5, h2{
	text-align:center;
	padding-top:inherit;
	
}
table {
   border-collapse:collapse;
   width:100%;
}
 
table, td, th {
   border:1px solid black;
}
 
tbody tr:nth-child(odd) {
   background-color: #ccc;
}
</style>
<h2>BENGKEL MOTOR</h2>
<h5>Jl, Cijati No.144 Desa Cijati, Kec. cijati  Cianjur 081572383160</h5>
<hr>

</tr>
</table>
<h4>LAPORAN SERVICE</h4>
<p align="left">Nama Kasir: <?php echo $_SESSION['nama_pengguna'] ?></p>
<p align="left">Tanggal: <?php date_default_timezone_set("Asia/Jakarta"); echo $date = date('Y-m-d |  H:i:s'); ?> </p>

<table >
<thead>
<tr>
<th>Nama Mekanik</td>
<th>Sparepart</td>
<th>Qty</td>
<th>Harga Sparepart</td>
<th>Harga Jasa</td>
<th>Total</td>
<th>Tanggal</td>


</tr>
</thead>
<?php 
$sql=mysqli_query($konek,"SELECT * FROM 213_pembelian JOIN 213_mekanik ON 213_pembelian.id_mekanik=213_mekanik.id_mekanik JOIN 213_sparepart ON 213_pembelian.id_sparepart=213_sparepart.id_sparepart ORDER BY id_pembelian ASC");
while($data=mysqli_fetch_array($sql)){
?>
<tbody><tr>
<td><?php echo $data['nama_mekanik']?></td>
<td><?php echo $data['sparepart']?></td>
<td><?php echo $data['qty']?></td>
<td>Rp. <?php echo number_format($data['harga'] , 0, ".",".")?></td>
<td>Rp. <?php echo number_format($data['harga_jasa'] , 0, ".",".")?></td>
<td>
Rp. <?php 
	$hs= $data['harga'];
	$qt= $data['qty'];
	$hj= $data['harga_jasa'];
	$tot = ($hs * $qt) + $hj;
	echo number_format("$tot", 0, ".",".");

			
			?>
</td>
<td><?php echo $data['tgl_beli']?></td>
</tr></tbody>
<?php
}
?>
</table>
	<script>
		window.print();
	</script>
