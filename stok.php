<style>
    .body
    {
    background: url(../images/back1.jpg);
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    width: 100%;
    height: 100%;
    background-position:center;
    }
</style>
<?php
include_once 'header2.php';
include_once 'includes/sparepart.inc.php';
$pro = new Sparepart($db);
$stmt = $pro->readAll();
$count = $pro->countAll();
if(isset($_POST['hapus-contengan'])){
    $imp = "('".implode("','",array_values($_POST['checkbox']))."')";
    $result = $pro->hapusell($imp);
    if($result){
            ?>
            <script type="text/javascript">
            window.onload=function(){
                showSuccessToast();
                setTimeout(function(){
                    window.location.reload(1);
                    history.go(0)
                    location.href = location.href
                }, 5000);
            };
            </script>
            <?php
    } else{
            ?>
            <script type="text/javascript">
            window.onload=function(){
                showErrorToast();
                setTimeout(function(){
                    window.location.reload(1);
                    history.go(0)
                    location.href = location.href
                }, 5000);
            };
            </script>
            <?php
    }
}
?>
<link href="css/body.css" rel="stylesheet">
<form method="post">
    <div class="row">
        <div class="col-md-6 text-left">
            <strong style="font-size:18pt;"><span class="fa fa-cogs"></span> Data Sparepart</strong>
        </div>
    </div>
    <br/>
    <table width="100%" class="table table-striped table-bordered" id="tabeldata">
        <thead>
            <tr>
                <th width="10px"><input type="checkbox" name="select-all" id="select-all" /></th>
                <th>Sparepart</th>
                <th>Stock</th>
                <th>Harga</th>
            </tr>
        </thead>
               <tbody>
    <?php
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    ?>
            <tr>
                <td style="vertical-align:middle;"><input type="checkbox" value="<?php echo $row['id_sparepart'] ?>" name="checkbox[]" /></td>
            <td style="vertical-align:middle;"><span class="blue"><?php echo $row['sparepart'] ?></span></td>
            <td style="vertical-align:middle;">
            <?php
            $sedia = $row['stock'];
            if($sedia == 0){
                echo"<font color='red'>Tidak Tersedia</font>";
            }else{
                echo "$sedia";
            }
            ?>
            </td>
            <td style="vertical-align:middle;">Rp. <?php echo number_format($row['harga'] , 0, ".",".") ?></td>
            </tr>
    <?php
    }
    ?>
        </tbody>
    </table>
    </form> 
</div>
</div>  

          
            <div id="chartContainer" style="height: 400px; width: 100%;"></div>
          <br/>
            
            
    


          <footer class="text-center">BENGKEL MOTOR By <a href="http://cahyotriatmojo070303.epizy.com/">MRNCTA</a> Copyright &copy; 2023</footer>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-1.11.3.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/highcharts.js"></script>
    <script src="js/exporting.js"></script>
    <script src="js/canvasjs.min.js"></script>
    
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.toastmessage.js"></script>
    <script>
    $(document).ready(function() {

        $('#tabeldata').DataTable();

    });
</script>
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