<?php
	// include database connection
	include 'config/themes, navbar, script.php';
	include 'config/database.php';
?>
  <!-- container -->
  <div class="container">
        <div class="page-header">
            <h1>Read Product</h1>
        </div>
        <?php
// get passed parameter value, in this case, the record ID
// isset() is a PHP function used to verify if a value is there or not
$id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
//include database connection
include 'config/database.php';
// read current record's data
try {
	// prepare select query
	$query = "SELECT id, nama, jawatan, gred, No_KP, No_Telefon, sektor, unit, model_pc, model_laptop, model_printer, catatan FROM user_info WHERE id = ? LIMIT 0,1";
	$stmt = $con->prepare( $query );
	// this is the first question mark
	$stmt->bindParam(1, $id);
	// execute our query
	$stmt->execute();
	// store retrieved row to a variable
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	// values to fill up our form
	$nama = $row['nama'];
	$jawatan = $row['jawatan'];
	$gred = $row['gred'];
	$No_KP = $row['No_KP'];
	$No_Telefon = $row['No_Telefon'];
	$sektor = $row['sektor'];
	$unit = $row['unit'];
	$model_pc = $row['model_pc'];
	$model_laptop = $row['model_laptop'];
	$model_printer = $row['model_printer'];
	$catatan = $row['catatan'];
	
}
// show error
catch(PDOException $exception){
	die('ERROR: ' . $exception->getMessage());
}
?>
       <!--we have our html table here where the record will be displayed-->
<table class='table table-hover table-responsive table-bordered'>
	<tr>
		<td>Nama</td>
		<td><?php echo htmlspecialchars($nama, ENT_QUOTES);  ?></td>
	</tr>
	<tr>
		<td>Jawatan</td>
		<td><?php echo htmlspecialchars($jawatan, ENT_QUOTES);  ?></td>
	</tr>
	<tr>
		<td>Gred</td>
		<td><?php echo htmlspecialchars($gred, ENT_QUOTES);		?></td>
	</tr>
	<tr>
		<td>No K/P</td>
		<td><?php echo htmlspecialchars($No_KP, ENT_QUOTES);  ?></td>
	</tr>
	<tr>
		<td>No Telefon</td>
		<td><?php echo htmlspecialchars($No_Telefon, ENT_QUOTES);  ?></td>
	</tr>
	<tr>
		<td>Unit</td>
		<td><?php echo htmlspecialchars($unit, ENT_QUOTES);  ?></td>
	</tr>
	<tr>
		<td>Model PC</td>
		<td><?php echo htmlspecialchars($model_pc, ENT_QUOTES);  ?></td>
	</tr>
	<tr>
		<td>Model Laptop</td>
		<td><?php echo htmlspecialchars($model_laptop, ENT_QUOTES);		?></td>
	</tr>
	<tr>
		<td>Model Printer</td>
		<td><?php echo htmlspecialchars($model_printer, ENT_QUOTES);  ?></td>
	</tr>
	<tr>
		<td>Catatan</td>
		<td><?php echo htmlspecialchars($catatan, ENT_QUOTES);  ?></td>
	</tr>
	<tr>
		<td></td>
		<td>
			<a href='aset_ict.php' class='btn btn-danger'>Back to read products</a>
		</td>
	</tr>
</table>
	</div> <!-- end .container -->
	<?php
	// include database connection
	include 'config/footer.php';
	include 'config/database.php';
?>