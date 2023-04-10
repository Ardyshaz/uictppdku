<?php
	// include database connection
	include 'config/themes.php';
if($_POST){
	// include database connection
	include 'config/database.php';
	try{
		// insert query
		$query = "INSERT INTO user_info SET nama=:nama, jawatan=:jawatan, gred=:gred, No_KP=:No_KP, No_Telefon=:No_Telefon, sektor=:sektor, unit=:unit, model_pc=:model_pc, model_laptop=:model_laptop, model_printer=:model_printer, catatan=:catatan, created=:created";
		// prepare query for execution
		$stmt = $con->prepare($query);
		// posted values
		$nama=htmlspecialchars(strip_tags($_POST['nama']));
		$jawatan=htmlspecialchars(strip_tags($_POST['jawatan']));
		$gred=htmlspecialchars(strip_tags($_POST['gred']));
		$No_KP=htmlspecialchars(strip_tags($_POST['No_KP']));
		$No_Telefon=htmlspecialchars(strip_tags($_POST['No_Telefon']));
		$sektor=htmlspecialchars(strip_tags($_POST['sektor']));
		$unit=htmlspecialchars(strip_tags($_POST['unit']));
		$model_pc=htmlspecialchars(strip_tags($_POST['model_pc']));
		$model_laptop=htmlspecialchars(strip_tags($_POST['model_laptop']));
		$model_printer=htmlspecialchars(strip_tags($_POST['model_printer']));
		$catatan=htmlspecialchars(strip_tags($_POST['catatan']));
		// bind the parameters
		$stmt->bindParam(':nama', $nama);
		$stmt->bindParam(':jawatan', $jawatan);
		$stmt->bindParam(':gred', $gred);
		$stmt->bindParam(':No_KP', $No_KP);
		$stmt->bindParam(':No_Telefon', $No_Telefon);
		$stmt->bindParam(':sektor', $sektor);
		$stmt->bindParam(':unit', $unit);
		$stmt->bindParam(':model_pc', $model_pc);
		$stmt->bindParam(':model_laptop', $model_laptop);
		$stmt->bindParam(':model_printer', $model_printer);
		$stmt->bindParam(':catatan', $catatan);
		// specify when this record was inserted to the database
		$created=date('Y-m-d H:i:s');
		$stmt->bindParam(':created', $created);
		// Execute the query
		if($stmt->execute()){
			echo "<div class='alert alert-success'>Record was saved.</div>";
		}else{
			echo "<div class='alert alert-danger'>Unable to save record.</div>";
		}
	}
	// show error
	catch(PDOException $exception){
		die('ERROR: ' . $exception->getMessage());
	}
}
?>
<!-- html form here where the product information will be entered -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
	<table class='table table-hover table-responsive table-bordered'>
		<tr>
			<td>Nama</td>
			<td><input type='text' name='nama' class='form-control' /></td>
		</tr>
		<tr>
			<td>Jawatan</td>
			<td><textarea name='jawatan' class='form-control'></textarea></td>
		</tr>
		<tr>
			<td>Gred</td>
			<td><input type='text' name='gred' class='form-control' /></td>
		</tr>
        <tr>
			<td>No K/P</td>
			<td><input type='text' name='No_KP' class='form-control' /></td>
		</tr>
		<tr>
			<td>No Telefon</td>
			<td><textarea name='No_Telefon' class='form-control'></textarea></td>
		</tr>
		<tr>
			<td>Sektor</td>
			<td><input type='text' name='sektor' class='form-control' /></td>
		</tr>
        <tr>
			<td>Unit</td>
			<td><input type='text' name='unit' class='form-control' /></td>
		</tr>
		<tr>
			<td>Model PC</td>
			<td><textarea name='model_pc' class='form-control'></textarea></td>
		</tr>
		<tr>
			<td>Model Laptop</td>
			<td><input type='text' name='model_laptop' class='form-control' /></td>
		</tr>
        <tr>
			<td>Model Printer</td>
			<td><input type='text' name='model_printer' class='form-control' /></td>
		</tr>
		<tr>
			<td>Catatan</td>
			<td><textarea name='catatan' class='form-control'></textarea></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<input type='submit' value='Save' class='btn btn-primary' />
				<a href='index.php' class='btn btn-danger'>Back to read products</a>
			</td>
		</tr>
	</table>
</form>
    </div> <!-- end .container -->
?>