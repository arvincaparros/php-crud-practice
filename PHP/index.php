<?php
	
	include("connection.php");

	$first_name = $last_name = $email = $gender = $address = "";
	$alert = "";

	if (isset($_GET['pageno'])) {
        $pageno = $_GET['pageno'];
    } else {
        $pageno = 1;
    }

    $no_of_records_per_page = 15;
    $offset = ($pageno-1) * $no_of_records_per_page;

 	$total_pages_sql = "SELECT COUNT(*) FROM tb_test";
    $result = mysqli_query($conn, $total_pages_sql);
    $total_rows = mysqli_fetch_array($result)[0];
    $total_pages = ceil($total_rows / $no_of_records_per_page);

	$sql = "SELECT * FROM tb_test ORDER BY first_name ASC LIMIT $offset, $no_of_records_per_page";
	$result_data = mysqli_query($conn, $sql);

	// if (mysqli_num_rows($result) > 0) {
	  // output data of each row
	 
	// } else {
	//   echo "0 results";
	// }

	include('insert.php');
	

	if (isset($_GET['insert']) == "success") {
		 $alert = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
					Record inserted successfully!
					<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
				</div>";
	}

	if (isset($_GET['delete']) == 'success') {
		$alert = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
					Record deleted successfully!
					<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
				</div>";
	}

	if (isset($_GET['update']) == 'success') {
		$alert = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
					Record updated successfully!
					<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
				</div>";
	}

	// Search
	include('search.php');

	mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<!-- FontAwesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>Home</title>
</head>
<body>
	<div class="container pt-4">
		<?php date_default_timezone_set("Asia/Manila");
		echo Date("h:i:s a"); ?>
		<!-- Alert -->
		<?php echo $alert; ?>
		<!--  -->

		<div class="d-flex justify-content-end align-items-center pb-4">
			<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add</button>
		</div>

		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Add data</h5>
		        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		      </div>
		      <form action="" method="POST">
			      <div class="modal-body">
			        
			        	<label for="firstName" class="form-label">First Name</label>
			        	<input type="text" name="first_name" id="firstName" class="form-control mb-2" placeholder="Enter first name">

			        	<label for="lastName" class="form-label">Last Name</label>
			        	<input type="text" name="last_name" id="lastName" class="form-control mb-2" placeholder="Enter last name">

			        	<label for="email" class="form-label">Email</label>
			        	<input type="text" name="email" id="email" class="form-control mb-2" placeholder="Enter email">

			        	<label for="gender" class="form-label">Gender</label>
			        	<input type="text" name="gender" id="gender" class="form-control mb-2" placeholder="Enter first name">

			        	<label for="address" class="form-label">Address</label>
			        	<input type="text" name="address" id="address" class="form-control mb-2" placeholder="Enter address">

			        	<label for="image-file" class="form-label">Upload image</label>
			        	<input type="file" name="image-file" id="image-file" class="form-control mb-2" placeholder="Enter address">
			        
			      </div>
			      <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				        <input type="submit" name="submit" value="Submit" class="btn btn-primary">			      
			      </div>
		      </form>
		    </div>
		  </div>
		</div>

		<!-- Search -->
		<form action="" method="POST" class="form">
			<div class="col-4 d-flex gap-2">
				<input type="text" class="form-control" name="search_field" placeholder="Search">
				<input type="submit" name="search" value="Search" class="btn btn-secondary">
			</div>
		</form>
		<!--  -->
		


		<table class="table">
			<thead>
				<tr>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Email</th>
					<th>Gender</th>
					<th>Address</th>
					<th></th>
					<th></th>
				</tr>
			</thead>

			<tbody>
				<?php if (mysqli_num_rows($result) > 0) { 


					while($row = mysqli_fetch_assoc($result_data)) { ?>
		  				<tr>
							<td><?php echo htmlspecialchars($row["first_name"]); ?></td>
							<td><?php echo htmlspecialchars($row["last_name"]); ?></td>
							<td><?php echo htmlspecialchars($row["email"]); ?></td>
							<td><?php echo htmlspecialchars($row["gender"]); ?></td>
							<td><?php echo htmlspecialchars($row["address"]); ?></td>
							<td>
								<a href="edit.php?id=<?php echo htmlspecialchars($row['id']) ?>" class="btn btn-success">
									<i class="fa fa-edit"></i>
								</a>
							</td>
							<td>
								<!-- Button trigger modal -->
								<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
								  <i class="fa fa-trash"></i>
								</button>


								<!-- Modal -->
								<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								  <div class="modal-dialog">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
								        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								      </div>
								      <div class="modal-body">
								        Are you sure you want to delete this item?
								      </div>
								      <div class="modal-footer">
								      	<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
								        <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">
										  Delete
										</a>
								      </div>
								    </div>
								  </div>
								</div>

							</td>
						</tr>
						
					<?php }

				} else {
				  echo "Data not found";
				} ?>
			</tbody>
		</table>

		<!-- Pagination -->
		<nav aria-label="Page navigation example">
		    <ul class="pagination" >
		        <li class="page-item">
		        	<a class="page-link" href="?pageno=1">First</a>
		        </li>
		        <li class="page-item <?php if($pageno <= 1){ echo 'disabled'; } ?>">
		            <a class="page-link" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
		        </li>
		        <li class="page-item <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
		            <a class="page-link" href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
		        </li>
		        <li class="page-item">
		        	<a class="page-link" href="?pageno=<?php echo $total_pages; ?>">Last</a>
		        </li>
		    </ul>
		</nav>
		<!--  -->

		<a href="chart.php" class="btn btn-secondary">Chart</a>
	</div>
	
	<!-- Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

	<script src="script.js"></script>
</body>
</html>