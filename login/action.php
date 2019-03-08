<?php
session_start();
include("database/db_conection.php");
$id1 = '';
$user_name1 = '';
$user_email1 = '';
$user_pass1 = '';
$update = false;

if(isset($_GET['del']))
{
		$delete_id=$_GET['del'];
	$delete_query="delete  from users WHERE id='$delete_id'";//delete query
	$run=mysqli_query($dbcon,$delete_query);
	if($run)
	{
	//javascript function to open in the same window
	   // echo "<script>window.open('view_users.php?deleted=user has been deleted','_self')</script>";
	   header("location: view_users.php?msg=deleted");
	}
}

elseif(isset($_POST['btnSubmit']))
{
	$user_name = $_POST['txtName'];
	$user_email = $_POST['txtEmail'];
	$user_pass = $_POST['txtPass'];
	if(empty($user_name) || empty($user_email) || empty($user_pass))
	{
		header("location: view_users.php?msg=emptytxt");
		exit();
	}


	$sqlcheck = mysqli_query($dbcon,"select * from users where user_email = '$user_email'"); //or die(error($sqlcheck)); 
	if(mysqli_num_rows($sqlcheck )>0){
		header("location: view_users.php?msg=dupplicate");
		exit();
	}
	else{
		$sql = "insert into users (user_name,user_email,user_pass) value ('$user_name','$user_email','$user_pass')";
		if(mysqli_query($dbcon,$sql)){
		 header("location: view_users.php?msg=added");
		}
	}
}
elseif (isset($_GET['edit']))
{
	$update = true;
	$id = $_GET['edit']; 
	$sqlcheck = mysqli_query($dbcon,"select * from users where id = '$id'");
	if(mysqli_num_rows($sqlcheck ) == 1){
		$row = mysqli_fetch_array($sqlcheck);
		$id1 = $row['id'];
		$user_name1 = $row['user_name'];
		$user_email1 = $row['user_email'];
		$user_pass1 = $row['user_pass'];

	} 

}
elseif(isset($_POST['btnUpdate']))
{
	$val1 = $_POST['id'];
	$val2 = $_POST['txtName'];
	$val3 = $_POST['txtEmail'];
	$val4 = $_POST['txtPass'];

	if(empty($val2) || empty($val3) || empty($val4))
	{
		header("location: view_users.php?msg=emptytxt");
		exit();
	}

	$sql = "update users set user_name = '$val2', user_email = '$val3', user_pass = '$val4 ' where id = '$val1'";
	if(mysqli_query($dbcon,$sql)){
		 header("location: view_users.php?msg=Updated");
	}

}


?>