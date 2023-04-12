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
                        <h1 class="display-5 fw-bold">Aset ICT Di Meja Pegawai</h1>
                        <p class="fs-4">Senarai Maklumat Pegawai dan Aset ICT</p>
                        <a class="btn btn-primary btn-lg" href="#!">Call to action</a>
                    </div>
                </div>
            </div>
        </header>
        <div class="container">
  <h2>Filterable Table</h2>
  <p>Type something in the input field to search the table for first names, last names or emails:</p>  
  <input class="form-control" id="myInput" type="text" placeholder="Search..">
  <br>   
  <script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable th").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
        <!-- Page Content-->
        <section class="pt-4">
            <div class="container px-lg-5">
                <!-- Page Features-->
                <?php
// include database connection
include 'config/database.php';
// PAGINATION VARIABLES
// page is the current page, if there's nothing set, default is page 1
$page = isset($_GET['page']) ? $_GET['page'] : 1;
// set records or rows of data per page
$records_per_page = 5;
// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;
$action = isset($_GET['action']) ? $_GET['action'] : "";
// if it was redirected from delete.php
if($action=='deleted'){
	echo "<div class='alert alert-success'>Record was deleted.</div>";
}
// select all data
// select data for current page
$query = "SELECT id, nama, jawatan, gred, No_KP, No_Telefon, sektor, unit, model_pc, model_laptop, model_printer, catatan FROM user_info ORDER BY id DESC
	LIMIT :from_record_num, :records_per_page";
$stmt = $con->prepare($query);
$stmt->bindParam(":from_record_num", $from_record_num, PDO::PARAM_INT);
$stmt->bindParam(":records_per_page", $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// this is how to get number of rows returned
$num = $stmt->rowCount();
// link to create record form
    echo "<a href='create.php' class='btn btn-primary m-b-1em'>Daftar Pegawai/Aset Baru</a>";
//check if more than 0 record found
    if($num>0){
	//start table
    echo "<table class='table table-hover table-responsive-sm table-bordered table-sm table-striped'>";
//creating our table heading
    echo 
        "<tr>
	        <th>ID</th>
	        <th>Nama</th>
	        <th>Jawatan</th>
	        <th>Gred</th>
	        <th>No KP</th>
	        <th>No Telefon</th>
	        <th>Sektor</th>
	        <th>Unit</th>
	        <th>Model PC</th>
	        <th>Model Laptop</th>
	        <th>Model Printer</th>
	        <th>Catatan</th>
            <th>Operasi</th>
        </tr>";
// retrieve our table contents
// fetch() is faster than fetchAll()
// http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	// extract row
	// this will make $row['firstname'] to
	// just $firstname only
	extract($row);
	// creating new table row per record
	echo "<tr>
		    <td>{$id}</td>
		    <td>{$nama}</td>
		    <td>{$jawatan}</td>
		    <td>{$gred}</td>
		    <td>{$No_KP}</td>
		    <td>{$No_Telefon}</td>
		    <td>{$sektor}</td>
		    <td>{$unit}</td>
		    <td>{$model_pc}</td>
		    <td>{$model_laptop}</td>
		    <td>{$model_printer}</td>
		    <td>{$catatan}</td>
		    <td>";
			    // read one record
		        echo "<a href='read_one.php?id={$id}' class='btn btn-info m-r-1em'>Read</a>";
			    // we will use this links on next part of this post
	    	    echo "<a href='update.php?id={$id}' class='btn btn-primary m-r-1em'>Edit</a>";
			    // we will use this links on next part of this post
	    	    echo "<a href='#' onclick='delete_user({$id});'  class='btn btn-danger'>Delete</a>"; 
                echo "</td>";
	echo "</tr>";
}
// end table

echo "</table>";
// PAGINATION
// count total number of rows
$query = "SELECT COUNT(*) as total_rows FROM user_info";
$stmt = $con->prepare($query);
// execute query
$stmt->execute();
// get total rows
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$total_rows = $row['total_rows'];
// paginate records
$page_url="aset_ict.php?";
include_once "paging.php";
}
// if no records found
else{
	echo "<div class='alert alert-danger'>No records found.</div>";
}
?>
    <!-- alert will be here -->
    <!-- table will be here -->
	
</div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <script type='text/javascript'>
// confirm record deletion
function delete_user( id ){
	var answer = confirm('Are you sure to delete?');
	if (answer){
		// if user clicked ok,
		// pass the id to delete.php and execute the delete query
		window.location = 'delete.php?id=' + id;
	}
}
</script>
    </body>
</html>
