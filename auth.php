<?php
	
$session_token = isset($_SESSION['session_token']) ? $_SESSION['session_token'] : '';
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';

if ( $session_token == '' || $username == '' )
{
	readfile('templates/login.html');
	exit;
}
else
{
	$q = "SELECT * FROM users WHERE session_token = '" . mysqli_real_escape_string($db, $session_token) . "'";
	$result = mysqli_query($db, $q) or die(mysqli_error($db));
	
	if ( $result )
	{
		$row = mysqli_fetch_assoc($result);
		
		if ( $row['username'] == $username )
		{
			echo "<a href=\"logout.php\">Log out</a>";
			echo "<p><hr>";
		}
		else
		{
			readfile('templates/login.html');
			exit;
		}
	}
	else
	{
		readfile('templates/login.html');
		exit;
	}
}