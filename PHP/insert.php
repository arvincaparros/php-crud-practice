<?php  

if (isset($_POST['submit'])) {

		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$email = $_POST['email'];
		$gender = $_POST['gender'];
		$address = $_POST['address'];

		if ($first_name == "" || $last_name == "" || $email == "" || $gender == "" || $address == "") {
			
			$alert = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
					All fields are required
					<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
				</div>";
		} else {

			$sql = "INSERT INTO tb_test (first_name, last_name, email, gender, address) VALUES ('$first_name', '$last_name', '$email', '$gender
				', '$address')";

			if (mysqli_query($conn, $sql)) {

				header("Location: index.php?insert=success");
				
			} else {
			  echo "Error deleting record: " . mysqli_error($conn);
			}


		}
	}

?>