<?php
include 'config/themes.php';
include 'config/database.php';
?>
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
	   <?php
// check if form was submitted
if($_POST){
   try{
	   // write update query
	   // in this case, it seemed like we have so many fields to pass and
	   // it is better to label them and not use question marks
	   $query = "UPDATE user_info
					   SET id = :id, nama=:nama, jawatan=:jawatan, gred=:gred, No_KP=:No_KP, No_Telefon=:No_Telefon, sektor=:sektor, unit=:unit, model_pc=:model_pc, model_laptop=:model_laptop, model_printer=:model_printer, catatan=:catatan
					   WHERE id = :id";
	   // prepare query for excecution
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
	   // $id=htmlspecialchars(strip_tags($_POST['id']));
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
	   $stmt->bindParam(':id', $id);
	   // Execute the query
	   if($stmt->execute()){
		   echo "<div class='alert alert-success'>Record was updated.</div>";
	   }else{
		   echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
	   }
   }
   // show errors
   catch(PDOException $exception){
	   die('ERROR: ' . $exception->getMessage());
   }
}
?>
<!--we have our html form here where new record information can be updated-->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
   <table class='table table-hover table-responsive table-bordered'>
	   <tr>
		   <td>Nama</td>
		   <td><input type='text' name='nama' value="<?php echo htmlspecialchars($nama, ENT_QUOTES);  ?>" class='form-control' /></td>
	   </tr>
	   <tr>
		   <td>Jawatan</td>
		   <td><textarea name='jawatan' class='form-control'><?php echo htmlspecialchars($jawatan, ENT_QUOTES);  ?></textarea></td>
	   </tr>
	   <tr>
		   <td>Gred</td>
		   <td><input type='text' name='gred' value="<?php echo htmlspecialchars($gred, ENT_QUOTES);  ?>" class='form-control' /></td>
	   </tr>
	   <tr>
		   <td>No K/P</td>
		   <td><input type='text' name='No_KP' value="<?php echo htmlspecialchars($No_KP, ENT_QUOTES);  ?>" class='form-control' /></td>
	   </tr>
	   <tr>
		   <td>No Telefon</td>
		   <td><textarea name='No_Telefon' class='form-control'><?php echo htmlspecialchars($No_Telefon, ENT_QUOTES);  ?></textarea></td>
	   </tr>
	   <tr>
		   <td>Sektor</td>
		   <td><input type='text' name='sektor' value="<?php echo htmlspecialchars($sektor, ENT_QUOTES);  ?>" class='form-control' /></td>
	   </tr>
	   <tr>
		   <td>Unit</td>
		   <td><input type='text' name='unit' value="<?php echo htmlspecialchars($unit, ENT_QUOTES);  ?>" class='form-control' /></td>
	   </tr>
	   <tr>
		   <td>Model PC</td>
		   <td><textarea name='model_pc' class='form-control'><?php echo htmlspecialchars($model_pc, ENT_QUOTES);  ?></textarea></td>
	   </tr>
	   <tr>
		   <td>Model Laptop</td>
		   <td><input type='text' name='model_laptop' value="<?php echo htmlspecialchars($model_laptop, ENT_QUOTES);  ?>" class='form-control' /></td>
	   </tr>
	   <tr>
		   <td>Model Printer</td>
		   <td><textarea name='model_printer' class='form-control'><?php echo htmlspecialchars($model_printer, ENT_QUOTES);  ?></textarea></td>
	   </tr>
	   <tr>
		   <td>Catatan</td>
		   <td><input type='text' name='catatan' value="<?php echo htmlspecialchars($catatan, ENT_QUOTES);  ?>" class='form-control' /></td>
	   </tr>
	   <tr>
		   <td></td>
		   <td>
			   <input type='submit' value='Save Changes' class='btn btn-primary' />
			   <a href='aset_ict.php' class='btn btn-danger'>Back to read products</a>
		   </td>
	   </tr>
   </table>
</form>
   </div> <!-- end .container -->