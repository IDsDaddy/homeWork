<?php

	 require("dbConnTest.php");  
  
	 $dbh = dbConnTest();
  
	 if ($dbh)
	 {
		try{  
			/*fetch result from the articles table   */                  
			 $sth1 = $dbh->prepare("SELECT * FROM articles ORDER BY id DESC LIMIT 0,1");
			 $sth1->execute();
			 $latestNews=$sth1->fetch(PDO::FETCH_ASSOC);
			 
			$sthNews = $dbh->prepare("SELECT * FROM articles ORDER BY id DESC LIMIT 0, 5");
			$sthNews->execute();
  
			$recentNews = $sthNews->fetchAll();
			
			
			/*fetch result from the publications table   */  		
			$sth3 = $dbh->prepare("SELECT * FROM publications ORDER BY id DESC LIMIT 0,1");
			$sth3->execute();
			$latestPubs = $sth3->fetch(PDO::FETCH_ASSOC);
			
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
<script src="js/jquery.min.js"></script>
<script src="js/home.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<title>中英文化交流学会</title>

<script>
		
	$("html").css("width", screen.width);

</script>

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
                    
                        <section id = "sliderFrame">
                             
                             <div id = "sWrapper">
                                <img src="jsImages/e63_1.jpg" class="sImage" />
                                <img src="jsImages/e63_2.jpg" class="sImage" />
                                <img src="jsImages/e63_3.jpg" class="sImage" />
                                <img src="jsImages/tall.jpg" class="sImage" />
                             </div>
                             
                             <div id = "aWrapper">
                                <img src="jsImages/grey-left.png" id="leftArrow" />
                                <img src="jsImages/grey-right.png" id="rightArrow" />
                             </div>
                             
                        </section>
                        
                        <div id = "extracts">
                        
                            <div id = "eNews">
                                <a href="#"><p class="eCategory"> Latest News</p></a>
                                <p class="eTitle">
                                	<?php              
										echo $latestNews["title"];
									?>
                                </p>
                                <p class="eInfo">
                                	<?php
										if (!empty($latestNews["eventDate"]))
										{
											$eTime = strtotime ($latestNews["eventDate"]);
											$eDate = date("d-m-Y", $eTime);
											echo "Event Date: ".$eDate;
										}
										else
										{
											$eTime = strtotime ($latestNews["mdate"]);
											$eDate = date("d-m-Y", $eTime);
											echo "Edited on ".$eDate;
										}

									?>
                                </p>
                                <p class="eInfo">
                                    <?php
										if (!empty($latestNews["location"]))
										{
											echo $latestNews["location"];
										}
									?>
                                </p>
                                <div class="eContent">
                                    <?php
									
										echo 
										'&nbsp &nbsp '.substr($latestNews["body"],0,281).'.... <a href="#">read more</a>';
									
									?>
                                    
                                    
                                </div>
                            </div>
                            
                            <div id = "ePublications">
                                
                                <a href="#"><p class="eCategory">Recent Publications</p></a>
                                <p class="eTitle">
                                    <?php
										echo $latestPubs['title'];
									?>
                                </p>
                                <p class="eInfo">
                                    Author: <?php echo $latestPubs['author']; ?>
                                </p>
                                <p class="eInfo">
                                    Published by: <?php echo $latestPubs['publisher']; ?>
                                </p>

                                <div class="eContent">
                                    &nbsp &nbsp  <?php echo substr($latestPubs["body"],0,281); ?> ... <a href="#">read more</a>
                                </div>

                            </div>  
                        
                        </div>
                    
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
                            <a href="#" class="listTitleFont">PUBLICATIONS</a>
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



