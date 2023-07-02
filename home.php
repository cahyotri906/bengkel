<?php
include_once 'header.php';
include_once 'includes/pembelian.inc.php';
$pro = new Pembelian($db);
$stmt = $pro->readmen();
$stmt2 = $pro->countAll();
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
			
		  </ol>
			<div id="chartContainer" style="height: 400px; width: 100%;"></div>
		  <br/>
			
			<!--DATA LOG ADMIN-->
			<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Info Admin</h3>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-md-6">

                        <table class="table">
                            <tbody>
                            <tr>
                                <th>Username</th>
                                <th>:</th>
                                <td><?php echo $_SESSION["username"]?></td>
                            </tr>
                            <tr>
                                <th>Nama Lengkap</th>
                                <th>:</th>
                                <td><?php echo $_SESSION["nama_pengguna"] ?></td>
                            </tr>
                            
                            </tbody>
                        </table>

                    </div>
                    <div class="col-md-6">


                        <table class="table">
                            <tbody>
                            <tr>
                                <th>Last Login</th>
                                <th>:</th>
                                <td><?php echo date('d-m-Y'); ?></td>
                            </tr>
                            <tr>
                                <th>IP Address</th>
                                <th>:</th>
                                <td><?php echo $_SERVER["REMOTE_ADDR"]; ?></td>
                            </tr>
                            <tr>
                                <th>Server</th>
                                <th>:</th>
                                <td><?php echo $_SERVER['SERVER_NAME']; ?></td>
                            </tr>
                            <tr>
                                <th>Browser</th>
                                <th>:</th>
                                <td><?php echo $_SERVER["HTTP_USER_AGENT"]; ?></td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </div>
				
			
		</div>
		</div>
		
		<footer class="text-center">BENGKEL MOTOR By <a href="http://cahyotriatmojo070303.epizy.com/">MRNCTA</a> Copyright &copy; 2023</footer>
	</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-1.11.3.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	<script src="js/highcharts.js"></script>
	<script src="js/exporting.js"></script>
	<script src="js/canvasjs.min.js"></script>
	<script type="text/javascript">
		window.onload = function () {
			var chart = new CanvasJS.Chart("chartContainer", {
				title: {
					text: "Data Service"
				},
				data: [{
					type: "column",
					dataPoints: [
					<?php 
					$conn = mysql_connect("localhost","root","");
					mysql_select_db("bengkel",$conn); 
					
						$query=mysql_query("SELECT * FROM 213_mekanik ");					
						while($row=mysql_fetch_assoc($query)){
							 $id     = $row['id_mekanik']; $inama     = $row['nama_mekanik'];
							 
							 
							 $data = mysql_fetch_array(mysql_query("SELECT count(id_mekanik) as jumlah FROM 213_pembelian where id_mekanik='$id'"));
							 $jumlah = $data['jumlah'];
							 
							 ?>
						{ y: <?php echo $jumlah ?>, label: "<?php echo "$inama"; ?>" },
						<?php } ?>
					]
				}]
			});
			chart.render();
		}
	</script>
	</body>
</html>