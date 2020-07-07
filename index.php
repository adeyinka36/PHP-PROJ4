<?php 

session_start();
if(isset($_GET["start"])&&_GET["start"]=="start"){
	$_GET["start"]=null;
	header("Location:play.php");
	
}
?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<title>Phrase Hunter</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="css/styles.css" rel="stylesheet">
		<link href="css/animate.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	</head>

	<body>
		<div class="main-container">
		   <?php if(isset($_SESSION["result"])){
			$result=$_SESSION["result"];
			   echo"<h1>$result</h1>";
		   }
		   session_destroy();
		   
		   ?>
			<h2 class="header">Phrase Hunter</h2>
            <form action="play.php">
                <input id="btn__reset" type="submit" value="start" name="start"/>
            </form>
		</div>
     
	</body>
</html>
