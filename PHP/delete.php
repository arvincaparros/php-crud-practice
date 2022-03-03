<?php 

	include("connection.php");

	if (isset($_GET['id'])) {
		$ID = $_GET['id'];

		$sql = "DELETE FROM tb_test WHERE id = '$ID'";


		if (mysqli_query($conn, $sql)) {
		  echo "Record deleted successfully";
		} else {
		  echo "Error deleting record: " . mysqli_error($conn);
		}

		mysqli_close($conn);

		header("Location: index.php?delete=success");

	} else {
		echo 'Not found';
	}
	

?>