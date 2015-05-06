 <?php

     require("dbConnTest.php");  

     $dbh = dbConnTest();
	 
	 class idException extends Exception
	 {		
		public function redirectToHome ()
		{
			echo "this page is not available. you will be redirected to the home page in 5 seconds...";
			header( "refresh:5; url=home.php" );
			exit;
		}
		 
	 }
	 
	 try
	 {
		 if (empty($_GET["id"]))
		 {
			throw new idException();
		 }
		 
	 }
	 catch(idException $e)
	 {
		 echo $e->redirectToHome();
	 }
	 
	 

	 if ($dbh)
	 {
		try{  
			$itemID = $_GET["id"];  
			/*fetch result from the articles table   */        
			$sthNews = $dbh->prepare("SELECT * FROM articles ORDER BY id DESC LIMIT 0, 5");
			$sthNews->execute();

			$recentNews = $sthNews->fetchAll();
			
			
			/*fetch result from the publications table   */  		
			
			$sthPubs = $dbh->prepare("SELECT * FROM publications ORDER BY id DESC LIMIT 0,5");
			$sthPubs->execute();
			
			$recentPubs = $sthPubs->fetchAll();
			
			

		}
		
		catch(PDOException $e)
		{
			echo $e->getMessage();
			exit;
		}
		 
		?>

		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<script src="js/jquery.min.js"></script>
		<script src="js/home.js" type="text/javascript"></script>
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<title>中英文化交流学会</title>
		</head>

		<script type="text/javascript">
			
		</script> 

		<body>
			<div class="container">
			
			<div class="main">
				<div class="header">
					
					<div class="nav">
						
						<ul id="navContain">
							
							<li class="nav_bar"><a href="home.php" class="myButton">&nbsp;&nbsp;&nbsp;&nbsp;home&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
							<li class="nav_bar"><a href="aboutus.php" class="myButton">&nbsp;&nbsp;about us&nbsp;&nbsp;</a></li>
							<li class="nav_bar"><a href="news.php" class="myButton">&nbsp;&nbsp;&nbsp;&nbsp;news&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
							<li class="nav_bar"><a href="publications.php" class="myButton">publications</a></li>
							<li class="nav_bar"><a href="#" class="myButton">contact us</a></li>
							
						</ul>
						
					</div> 
					
					<div class="logo">       
						<img id = "titleImage" src="jsImages/SCUCE 4.jpg" />    
					</div>
					
					<div class = "topright">
						<p id="date"></p>
						
						<p style="margin-bottom:0px">
							<span class="language">English</span>
							<span class="language">Chinese</span>
						</p>
						
						<p style="margin-top:0px">
							<span class="flag"><a href="home.php"><img src="jsImages/uk.png" /></a></span>
							<span class="flag"><a href="home_cn.php"><img src="jsImages/cn.png" /></a></span>
						</p>
					</div>
		  
				</div>  <!--header div --> 

				<div class="body">
				
					<div class="leftbody">
					
						<section id = "itemMain">
						
							<?php
							
								$sthItem = $dbh->prepare("SELECT * FROM articles WHERE id=$itemID");
								
								$sthItem->execute();
								
								$newsItem = $sthItem->fetch(PDO::FETCH_ASSOC);
								
								$newsItemTitle = $newsItem["title"];
								$newsItemAuthor = $newsItem["publisher"];
								$newsItemMDate = $newsItem["mdate"];
								$newsItemEDate = $newsItem["eventDate"];
								$newsItemLocation = $newsItem["location"];
								
							?>
							<p id="itemTitle"><?php echo $newsItemTitle;?></p>
                            
							<p id="itemAuthor">Author: <?php echo $newsItemAuthor;?>&nbsp;&nbsp;&nbsp;<?php echo $newsItemMDate;?></p>
							
							<p id="itemEventDate">Event Date: <?php echo $newsItemEDate;?></p>
							
							<p id="itemLocation">Event Location: <?php echo $newsItemLocation;?></p>
							
							<div id="itemBody">
							
								<div id = "itemImages">
								
								<?php					
									
									$sthItemImage = $dbh->prepare("SELECT imageURL FROM imagelib WHERE itemId = $itemID AND imageId = 1");
									
									$sthItemImage->execute();
									
									$mainImage = $sthItemImage->fetch(PDO::FETCH_ASSOC);
									
									$sthItemAllImages = $dbh->prepare("SELECT imageURL FROM imagelib WHERE itemId = $itemID");
									
									$sthItemAllImages->execute();
									
									$allImages = $sthItemAllImages->fetchAll(); 
									
								?>
								
									<div id="itemImageMainContain">
										<a href="#"><img id = "itemImageMain" src="<?php echo $mainImage["imageURL"]?>"/></a>
									</div>
									
									<div id="tileOuterContain">
									
									<?php
									
										foreach ($allImages as $iAllImages)
										{
											echo "
											<div class='imageTileContain'>
											<a href='#'><img class='itemImageTile' src='".$iAllImages['imageURL']."' /></a>
											</div>
											";
										}
									
									?>
									
																				<div class='imageTileContain'>
											<a href='#'><img class='itemImageTile' src='jsImages/tall.jpg' /></a>
											</div>
									</div>
									
								</div>
								
								<script type="text/javascript">
								
								$(document).ready(function()
								{
									$("#itemImageMain").click(function()
									{
										$mainURL = $("#itemImageMain").attr("src");
										$("#imagePopup").attr("src", $mainURL);
										
										var image = new Image();
										image.src = $mainURL;
	
										$imageWidth = image.naturalWidth;
										if ($imageWidth>1500)
										{
											$imageWidth=1500;
										}
										
										$windowWidth = $(window).width();
										
										$hMargin = ($windowWidth-$imageWidth)/2;
										
										$("#pageDim").animate({"opacity":"0.5"},300, "linear");
										$("#imagePopupContain").animate({"opacity":"1"}, 300, "linear");
										$("#pageDim").css({"display":"block"});
										$("#imagePopupContain").css({"display":"block","left":$hMargin});
										
									});
									
									$("#imagePopupContain").click(function()
									{								
										closeBox();
									});
									
									$("#pageDim").click(function()
									{
										closeBox();
									});
									
									function closeBox()
									{
										$("#pageDim, #imagePopupContain").animate({"opacity":"0"},300, "linear", function()
										{
											$("#pageDim, #imagePopupContain").css({"display":"none"});
											$("#imagePopup").attr("src", "");
										});
										
									}
									
									$(".itemImageTile").click(function()
									{
										$tileURL = $(this).attr("src");
										$("#itemImageMain").attr("src",$tileURL);
									});
									
								
								});

								
								</script>

								
								<?php	
								

									$newsBody = $newsItem["body"];
									
									$newLine = "\r\n";
									$newsBody = str_ireplace($newLine, "<br>&nbsp;&nbsp;", $newsBody); 
									
									echo "&nbsp;&nbsp;".$newsBody;
								
								?>
							
							</div>
		
							
						</section>
						
						
					
					</div>
					
					<div class="rightbody">
					
				   <!-- navigation bars was here-->
					
					  
					  <div class="newsList">
						
						<div class="listTitle">
							<!--<img src="jsImages/news.png" class="listTitle" />-->
							<a href="news.php" class="listTitleFont">NEWS</a>
						</div>
						
						<ul class = "listContain">
						
						 <?php 
						 
							  foreach($recentNews as $content)
							  {
								  $timeStamp = strtotime($content["mdate"]);
								  $date = date("d-m-Y", $timeStamp);
								  echo 
								  '<li class="listLink"><a href="newsitem.php?id='.$content["id"].'">
									  <span class="listDate">'.$date.' - </span><span class="listContent">'.$content["title"].'</span>
								  </a></li>';
							  }
  
						 ?>
						 
						 </ul>
					
					  </div>
					  
					  <div class="pubList">
						
						<div class="listTitle">
							<a href="publications.php" class="listTitleFont">PUBLICATIONS</a>
						</div>
						
						<ul class = "listContain">
						
						<?php

							foreach($recentPubs as $content3)
							{
								$timeStamp3 = strtotime($content3['pubDate']);
								$date3 = date('d-m-Y', $timeStamp3);
								echo 
								'<li class="listLink"><a href="#">
									<span class="listDate">'.$date3.' - </span><span class="listContent">'.$content3["title"].'</span><span class="listPub"> - '.$content3["publisher"].'</span>
								</a></li>';
								
							}								
				
						?>

						</ul>                
						
					  </div>
					
					</div>  <!--rightbody div-->
				
				</div>  <!--body div-->
			
				 
			</div> <!--main div-->
			</div> <!--container div-->
			
			<div class="footer">
			
				<span class="fSpan">SCUCE London Birmingham Manchester  2014 </span>
				<span class="fSpan">subscribe us</span>
				<span class="fSpan">email us</span>
			
			</div>  <!--footer div-->
			
			
			<div id = "pageDim"></div>
			
			<div id = "imagePopupContain"><img id="imagePopup" /><div id = "imageDescription"></div></div>

		</body>
		</html>      

		<?php  
	 } 

	 else
	 {
		echo "Server Error. Please Contact System Administrator!";
	 }



?>



