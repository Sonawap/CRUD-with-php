<?php 
	include 'connect.php';

	// initialize variables
	$name = "";
	$age = "";
	$address = "";
	$username = "";
	$id = 0;
	$update = false;
	$dateposted = date('Y-m-d');
	//For Insert
	if (isset($_POST['save'])) {
		$name = $_POST['name'];
		$age = $_POST['age'];
		$username = $_POST['username'];
		$address = $_POST['address'];

		//specifying the supported file extension
		$validextensions=["jpeg","jpg","png","PNG","JPG"];
		$ext=explode('.',basename($_FILES['file']['name']));
		//explode file name from dot(.)
		$file_extension=end($ext);
		//generate Name for the video;
		$imageName=$name.rand(100000,900000).".".$file_extension;
		$target_path=$imageName;
		$filesize= 5000000;

		if(($_FILES['file']['size'] <= $filesize) and in_array($file_extension,$validextensions)) {
			$imageName=$name.rand(100000,900000).".".$file_extension;
			$destination = 'images'."/".$imageName;
			$temp_file = $_FILES['file']['tmp_name'];
			if(move_uploaded_file($temp_file,$destination)){
				mysqli_query($con, "INSERT INTO crudtable (name, age, username, address,photo, dateposted) VALUES ('$name', '$age','$username','$address','$imageName','$dateposted')"); 
				header("Location: index.php?success=Profile Has been created");
			}
		}else{
			header("Location: index.php?error=Invalid Image format or file too large");
		}
	}

		//For Update
	if (isset($_POST['update'])) {
		$id = $_POST['id'];
		$name = $_POST['name'];
		$age = $_POST['age'];
		$username = $_POST['username'];
		$address = $_POST['address'];

		//specifying the supported file extension
		$validextensions=["jpeg","jpg","png","PNG","JPG"];
		$ext=explode('.',basename($_FILES['file']['name']));
		//explode file name from dot(.)
		$file_extension=end($ext);
		//generate Name for the video;
		$imageName=$name.rand(100000,900000).".".$file_extension;
		$target_path=$imageName;
		$filesize= 5000000;

		if(($_FILES['file']['size'] <= $filesize) and in_array($file_extension,$validextensions)) {
			$imageName=$name.rand(100000,900000).".".$file_extension;
			$destination = 'images'."/".$imageName;
			$temp_file = $_FILES['file']['tmp_name'];
			if(move_uploaded_file($temp_file,$destination)){
				mysqli_query($con, "UPDATE crudtable SET name='$name', age='$age', username='$username', address='$address', dateposted='$dateposted', photo='$imageName' WHERE id=$id"); 
				header("Location: index.php?success=Profile Has been Updated");
			}
		}else{
			header("Location: index.php?error=Invalid Image format or file too large");
		}

	}
	//For Delete
if (isset($_GET['del'])) {
	$id = $_GET['del'];
	mysqli_query($con, "DELETE FROM crudtable WHERE id=$id");
	header('location: index.php');
}


?>