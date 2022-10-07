if (isset($_POST['submit'])) {
	require_once 'dbcon.php'; // datbase connection
	
	if (is_uploaded_file($_FILES['filename']['tmp_name'])) {
		echo "<h1>" . "File ". $_FILES['filename']['name'] ." Uploaded successfully." . "</h1>";
		echo "<h2>Displaying contents:</h2>";
		readfile($_FILES['filename']['tmp_name']);
	}

	//Import uploaded file to Database
	$handle = fopen($_FILES['filename']['tmp_name'], "r");

	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		mysqli_query($mysqli,"INSERT into voters (id,first_name,last_name,email,gender,ip_address) values('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]')");
		
		}

	fclose($handle);

	echo "<script type='text/javascript'>alert('Successfully imported Users CSV file!');</script>";

}
