<?php 
function get_row($table,$row, $id, $equal){
	global $con;
	$query=mysqli_query($con,"select $row from $table where $id='$equal'");
	$rw=mysqli_fetch_array($query);
	$value=$rw[$row];
	return $value;
}

function isAdmin () {
	$rolId = $_SESSION['rolId'] ?? null;
	return $rolId == 2;
}

function redirectIfIsNotAdmin () {
	if (!isAdmin()) {
		header('Location: index.php');
		exit;
	}
}

function redirectIfAuthenticated () {
	if($_SESSION['user_id'] ?? null) {
		header('Location: index.php');
		exit;
	}
}

function redirectIfIsNotAuthenticated () {
	if(!($_SESSION['user_id'] ?? null)) {
		header('Location: login.php');
		exit;
	}
}

?>