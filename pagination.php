<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>pagination</title>
</head>

<body>

<?php

	$newArray = array();
	
	for ($i=1; $i<51; $i++)
	{
		array_push($newArray,$i);
	}
	
	echo implode(" ", $newArray);
	
	echo $newArray[10];
	
	if(empty($_GET["currentPage"]))
	{
		$currentPage = 1;
	}
	else {
		$currentPage = $_GET["currentPage"];
	}
	
	echo " <br>ccurrent page is   " . $currentPage;
	$startingPos = ($currentPage-1)*20;
	echo " <br>starting pos is  " . $startingPos;
	
	
	
	$listLimit = 20;
	
	$endPos = $listLimit*$currentPage;
	
	if ($endPos>=50)
	{
		$endPos=50;	
	}
	for ($startingPos; $startingPos<$endPos; $startingPos++)
	{
		echo "<br>".$newArray[$startingPos];
	}
	
	$totalPage = ceil(50/$listLimit);
	
	echo "<br>";
	for ($pageLink=1; $pageLink<=$totalPage; $pageLink++)
	{
		echo "<a href='pagination.php?currentPage=".$pageLink."'>".$pageLink."</a>      ";
	}
	
	
	
	echo "<br><br><br><br><br>";
	
	require("dbConnTest.php");  

    $dbh = dbConnTest();
	
	try{
		
		$sth=$dbh->prepare("SELECT * FROM articles ORDER BY id DESC LIMIT 3,3");
		$sth->execute();
		
		$tRow = $sth->rowCount();
		
		echo "number of rows selected from database is ".$tRow;
		
		$news = $sth->fetchAll();
		
		foreach ($news as $iNews)
		{
			echo "<br>title: ".$iNews["title"]."<br>location: ".$iNews["location"]."<br>".$iNews["body"];	
		}
		
	}
	catch (PDOException $e)
	{
		echo $e->getMessage();
	}
	
?>

</body>
</html>