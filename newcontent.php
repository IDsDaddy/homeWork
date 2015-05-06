<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="js/jquery.min.js"></script>
<title>无标题文档</title>
</head>

<body>
<?php

	$extCheck = array ("jpg", "jpeg", "png", "gif", "bmp");
	
	if(isset($_POST) and $_SERVER['REQUEST_METHOD']=="POST") {
		
		$fieldError = 0;
		
		if(isset($_POST['newTitle'])){
			$newTitle = $_POST['newTitle'];
		}
		else{
			$newTitle = NULL;
			$fieldError = 1;	
		}
		
		if(isset($_POST['newLocation'])){
			$newLocation = $_POST['newLocation'];
		}
		else{
			$newLocation = NULL;	
		}
		
		if(isset($_POST['mainContent'])){
			$newContent = $_POST['mainContent'];
		}
		else{
			$newContent = NULL;	
			$fieldError = 1;
		}
		
		if(isset($_POST['editor'])){
			$editor = $_POST['editor']; 
		}
		else{
			$editor = NULL;	
			$fieldError = 1;
		}
		
		if(isset($_POST['newTime'])){
			$newTime = $_POST['newTime'];
		}
		else{
			$newTime = NULL;	
		}
		
		echo "article title is ".$newTitle;
		
		if ($fieldError===0){
			require("dbConnTest.php");  
			$dbh = dbConnTest();
			
			echo "second step ok";
			
			if($dbh){
				echo "third  step ok";
				$sthNewContent = $dbh->prepare("INSERT INTO articles(title, location, body, publisher, eventDate) VALUES(?,?,?,?,?)");
				/* ---------------------execute insertion new data here----------------------- */
//				$sthNewContent->execute(array($newTitle, $newLocation, $newContent, $editor, $newTime));
				/* ---------------------execute insertion new data here----------------------- */
				
				$newContentId = $dbh->lastInsertId();
				
				/* ------------upload multiple images------------ */
				if(isset($_FILES['uploadImage'])){
					
					echo "fourth step ok";
					
					foreach ($_FILES['uploadImage']['tmp_name'] as $key => $tmp_name){
						
						if ($_FILES['uploadImage']['error'][$key] === UPLOAD_ERR_OK){
							
							$fileError = 0;
						
							$fileSerSide = $_FILES['uploadImage']['tmp_name'][$key];
							echo $fileSerSide."<br>";	
							
							$fileBasename = basename($_FILES['uploadImage']['name'][$key]);
							$fileExtension = pathinfo($fileBasename, PATHINFO_EXTENSION);
							
							$fileCliSide = 'upload/'.$fileBasename;
							echo $fileCliSide."<br>";
							
							$allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
							$detectedTypes = exif_imagetype($fileSerSide);
							
							if(!in_array($detectedTypes, $allowedTypes)){
								$fileError = 1;
								echo $fileBasename." is not an image";
							}
							
							$repeatedName = 1;
							do {
								if(file_exists($fileCliSide)){
								   $fileNameOnly = pathinfo($fileBasename, PATHINFO_FILENAME);
								   $fileCliSide = 'upload/'.$fileNameOnly.'_'.rand().'.'.$fileExtension;
								   
								   echo $fileCliSide.'<br>';
								}
								else{
								  $repeatedName = 0;  
								}
							} while ($repeatedName != 0);
							
							$keyPlus = $key+1;
							
		/* 					
		
		
							if(move_uploaded_file($fileSerSide,$fileCliSide)){
								echo "file uploaded.";
							} */
							
		//					  $sthNewImage = $dbh->prepare("INSERT INTO imagelib(itemId, imageURL, imageId) VALUES(?, ?, ?)");
		//					  $sthNewImage->execute(array($newContentId, $fileCliSide,$keyPlus));
							echo "itemId: ".$newContentId.", imageURL: ".$fileCliSide.", imageId: ".$keyPlus;
						}
						else {
							echo "upload error";	
						}
						
						
					}
				}
				/* ----------------------------------------------------- */
			}
			else{
				echo "insertion failed.";	
			}
			
			
			
		}
		
		else {
			echo "retrieving fiels failded";		
		}
		
	}
	
	else
	{
		echo "post is not set.";
	}


?>







</body>
</html>