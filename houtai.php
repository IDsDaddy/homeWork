<?php

     require("dbConnTest.php");  

     $dbh = dbConnTest();
	 
	 session_start();
	 
	 $_SESSION['newArticle'] ="ready";
	 $_SESSION['houtaiAccess'] = "ready";
	
 ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="js/home.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<title>中英文化交流学会后台</title>
</head>

        <body>
            <div class="container">
            
            <div class="main">
                <div class="header">
                    
                    <div class="nav">
                        

                        
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
                
                	<div id = 'houtaiBody'>
                
                        <div id = 'welcomeNotes'>
                    
                        <p>欢迎来到网站管理。您所在的位置是英文网站的管理界面，如果您需要管理网站的中文版，请点击右上角的中文标志。</p>
                        <p>Welcome to the web content manager. This is for the management of the Englsih version of the website only. Should you wish to manage the Chinese version, please click oin the Chinese logo on the top right corner.</p>
                        </div>
                        
                        <div id = 'selectionPanels'>
                            
                            <p>请选择需要编辑的板块</p>
                            <p>please choose from the following content catagories to beginning editing.</p>
                    
                    		<ul class="panelWrapper">
                            	
   								<a href="scrap.php"><li class="panelBody"><p class="panelContent">News</p><p class="panelContent">活动</p></li></a>
                                <a href="#"><li class="panelBody"><p class="panelContent">Publications</p><p class="panelContent">发表文章</p></li></a>
                                
                            </ul>
                            
                            <p>更新协会的介绍及联系方式。</p>
                        	<p>Update society introduction and contact details</p>
                            
                            <ul class="panelWrapper">

                                <a href="#"><li class="panelBody"><p class="panelContent">Intro & Contact Details</p><p class="panelContent">介绍及联系方式</p></li></a>
                                
                            </ul>
                            
                        </div>                     
                    
                    </div>
                    
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
