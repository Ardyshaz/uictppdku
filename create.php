<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Unit ICT PPDKU</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container px-lg-5">
            <a class="navbar-brand" href="index.php">UNIT ICT PPDKU</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="py-5">
            <div class="container px-lg-5">
                <div class="p-4 p-lg-5 bg-light rounded-3 text-center">
                    <div class="m-4 m-lg-5">
                        <h1 class="display-5 fw-bold">Daftar Baru</h1>
                        <p class="fs-4">Maklumat Pengguna dan Maklumat Aset ICT</p>
                        <a class="btn btn-primary btn-lg" href="#!">Call to action</a>
                    </div>
                </div>
            </div>
        </header>
        <div class="container">
        <!-- Page Content-->
        <section class="pt-4">
            <div class="container px-lg-5">
                <!-- Page Features-->
              
    <!-- alert will be here -->
    <!-- table will be here -->
	
</div>
            </div>
        </section>
        
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>

<?php
	
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
				<a href='aset_ict.php' class='btn btn-danger'>Back to read products</a>
			</td>
		</tr>
	</table>
</form>
    </div> <!-- end .container -->
?>

<!-- Footer-->
<footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p></div>
        </footer>