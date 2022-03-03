<?php 
	
	include("connection.php");

	$first_name = $last_name = $email = $gender = $address = "";

	$ID = $_GET['id'];

	if (isset($_GET['id'])) {

		$sql = "SELECT * FROM tb_test WHERE id = '$ID'";
		$result = mysqli_query($conn, $sql);

		if ($result->num_rows > 0) {
		  // output data of each row
		   while($row = mysqli_fetch_assoc($result)) {
			     $first_name = htmlspecialchars($row["first_name"]);
			     $last_name = htmlspecialchars($row["last_name"]);
			     $email = htmlspecialchars($row["email"]);
			     $gender = htmlspecialchars($row["gender"]);
			     $address = htmlspecialchars($row["address"]);
			}
		} else {
		  echo "0 results";
		}

		// mysqli_close($conn);
	}

	if (isset($_POST['submit'])) {
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$email = $_POST['email'];
		$gender = $_POST['gender'];
		$address = $_POST['address'];

		$sql = "UPDATE tb_test SET first_name = '$first_name', last_name = '$last_name', email = '$email', gender = '$gender', address = '$address'  WHERE id = '$ID'";

		if (mysqli_query($conn, $sql)) {
			header("Location: index.php?update=success");
		} else {
		  	echo "Error updating record: " . mysqli_error($conn);
		}
	}

	mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<title>Edit</title>
</head>
<body>

	<div class="container">
		<h3>EDIT</h3>
		<form action="" method="POST">
			<div class="mb-3">
			    <label for="first_name" class="form-label">First Name</label>
			    <input type="text" value="<?php echo $first_name; ?>" class="form-control" id="first_name" name="first_name">
			</div>
			<div class="mb-3">
			    <label for="last_name" class="form-label">Last Name</label>
			    <input type="text" value="<?php echo $last_name; ?>" class="form-control" id="last_name" name="last_name">
			</div>
			<div class="mb-3">
			    <label for="email" class="form-label">Email address</label>
			    <input type="email" value="<?php echo $email; ?>" class="form-control" id="email" name="email">
			</div>
			<div class="mb-3">
				 <label for="gender" class="form-label">Gender</label>
			    <input type="text" value="<?php echo $gender; ?>" class="form-control" id="gender" name="gender">
			</div>
			<div class="mb-3">
			    <label for="address" class="form-label">Address</label>
			    <input type="text" value="<?php echo $address; ?>" class="form-control" id="address" name="address">
			</div>
			<input type="submit" name="submit" value="Update" class="btn btn-primary"></input>
		</form>
	</div>
	
</body>
</html>