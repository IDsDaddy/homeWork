 <?php

     require("dbConnTest.php");  

     $dbh = dbConnTest();

     if ($dbh)
     {
      	try{  
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
		}
		 
        ?>

        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
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
                    
                        <section id = "newsMain">
        
							<div id = "newsTitle">
                            	
                                Publications
                            
                            	<span id = "updatedOn">
                                	<?php
										try {
										$sthLatestPub = $dbh->prepare("SELECT modDate FROM publications ORDER BY modDate DESC LIMIT 0,1");
										$sthLatestPub->execute();
										$latestModDate = $sthLatestPub->fetch(PDO::FETCH_ASSOC);
										
										$updatedOn = $latestModDate["modDate"];
										
										echo "Last Updated On ".$updatedOn;
										
										}
										
										catch(PDOException $e1)
										{
											echo $e1->getMessage();
										}
										
									?>
                                </span>
                            
                            </div>
                            <ul id = "newsBody">
                            	<?php
												
									if(empty($_GET["currentpage"]))
									{
										$currentPage = 1;
									}
									else {
										$currentPage = $_GET["currentpage"];
									}	
									
									$displayLimit = 5;
									
									
									
									$sthAll = $dbh->prepare("SELECT id FROM publications");
									$sthAll->execute();
									
									$totalRow = $sthAll->rowCount();
									
									$totalPage = ceil($totalRow/$displayLimit);
									
									if ($currentPage<=$totalPage)
									{
										$startingPos = ($currentPage-1)*$displayLimit;
										if (($currentPage*$displayLimit)>$totalRow)
										{
											$endPos = $totalRow-$startingPos;
										}
										else
										{
											$endPos = 5;
										}
										
										$sthPubList = $dbh->prepare("SELECT *FROM publications ORDER BY id DESC LIMIT $startingPos, $endPos");
										
										$sthPubList->execute();
										
										$thePubList=$sthPubList->fetchAll();
	
										foreach($thePubList as $iPubList)
										{
											echo "<li id = 'iNewsList'>";
																											
											echo 		
												"	
													<span ><a id='newsListTitle' href='pubitem.php?id=".$iPubList["id"]."'>".$iPubList["title"]."<a/></span><span id='pubListAuthor'>-&nbsp;&nbsp;&nbsp;".$iPubList['author']."</span>
													<br><br>
														<p id='pubListBody'><a style='color:#333;' href='newsitem.php?id=".$iPubList["id"]."'>&nbsp;&nbsp;- ".substr($iPubList["body"],0,121)."...</a>													<br>
														<span id = 'newsListPub'>".$iPubList["publisher"].", &nbsp;&nbsp; ".$iPubList["pubDate"]."</span>
												  <br>
												  </li>
												  
												";	
										}
										
										echo "<br>
												<div id='pagination'>
												";
										
										if ($currentPage>5)
										{	
											echo "<a class='pageLink' href='news.php?currentpage=1'>1</a>";
											echo "<span class='skippedLink'>...</span>";
											for ($prevPageLink=$currentPage-3; $prevPageLink<$currentPage; $prevPageLink++)
											{
												echo "<a class='pageLink' href='news.php?currentpage=".$prevPageLink."'>".$prevPageLink."</a>";	
											}
										}
										else
										{
											for ($prevPageLink=1; $prevPageLink<$currentPage; $prevPageLink++)
											{
												echo "<a class='pageLink' href='news.php?currentpage=".$prevPageLink."'>".$prevPageLink."</a>";		
											}
										}
										
										if ($totalPage>$currentPage+4)
										{
											for ($nextPageLink=$currentPage; $nextPageLink<$currentPage+4; $nextPageLink++)
											{
												echo "<a class='pageLink' href='news.php?currentpage=".$nextPageLink."'>".$nextPageLink."</a>";		
											}
											echo "<span class='skippedLink'>...</span>";
											echo "<a class='pageLink' href='news.php?currentpage=".$totalPage."'>".$totalPage."</a>";	
										}
										else
										{
											for ($nextPageLink=$currentPage; $nextPageLink<=$totalPage; $nextPageLink++)
											{
												echo "<a class='pageLink' href='news.php?currentpage=".$nextPageLink."'>".$nextPageLink."</a>";	
											}
										}
										
										echo "</div>";
									}
									else
									{
										echo "Server Error. Please Contact Your Administratior!";
									}
									

									
                            	?>
                            </ul>

                        </section>
                        
                        
                    
                    </div>
                    
                    <div class="rightbody">
                    
                   <!-- navigation bars was here-->
                    
                      
                      <div class="newsList">
                        
                        <div class="listTitle">
                            <!--<img src="jsImages/news.png" class="listTitle" />-->
                            <a href="#" class="listTitleFont">NEWS</a>
                        </div>
                        
                        <ul class = "listContain">
                        
						 <?php 
                         
                              foreach($recentNews as $content)
                              {
                                  $timeStamp = strtotime($content["mdate"]);
                                  $date = date("d-m-Y", $timeStamp);
                                  echo 
                                  '<li class="listLink"><a href="#">
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

        </body>
        </html>      

        <?php  
     } 

     else
     {
        echo "Server Error. Please Contact System Administrator!";
     }

?>



