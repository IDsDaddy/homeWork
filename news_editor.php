<?php

     require("dbConnTest.php");  

     $dbh = dbConnTest();
	
 ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="js/jquery.min.js"></script>
<script src="js/home.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<title>中英文化交流学会后台</title>
        
<script>
		
	

</script>
        
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
            
                <p>欢迎来到最新动态栏的管理界面。请选择编辑已上传的内容或添加新动态。如果您需要管理网站的中文版，请点击右上角的中文标志。</p>
                <p>Welcome to the news manager. Please choose to edit existing content or add new content. If you wish to manage the chinese version of this website, please click on the Chinese logo on the top right corner.</p>
                </div>
  
                
                <div id="editingArea">
  
                    <div id="existingContent">
                    
                        <table id = "exContentBody" border="2">
                        
                        	<tr id="tableTitle"><td style="padding-left:10px">Title</td><td style="padding-left:5px">Author</td><td style="padding-left:5px">Last Modified</td><td style="width:50px; padding-left:15px">Edit</td><td style="width:65px; padding-left:10px">Delete</td></tr>
                            <?php
                                            
                                if(empty($_GET["currentpage"]))
                                {
                                    $currentPage = 1;
                                }
                                else {
                                    $currentPage = $_GET["currentpage"];
                                }	
                                
                                $displayLimit = 10;
                                
                                
                                
                                $sthAll = $dbh->prepare("SELECT id FROM articles");
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
                                        $endPos = 10;
                                    }
                                    
                                    $sthNewsList = $dbh->prepare("SELECT *FROM articles ORDER BY id DESC LIMIT $startingPos, $endPos");
                                    
                                    $sthNewsList->execute();
                                    
                                    $theNewsList=$sthNewsList->fetchAll();

                                    foreach($theNewsList as $iNewsList)
                                    {
                                        echo "<tr class = 'editorRow'>";                                                   
                                                    
                                        echo 		
                                                  	"<td class='editorTitle' ><span style='cursor:pointer' onclick='newsPreview(".$iNewsList["id"].")'>".$iNewsList["title"]."</span></td>                                               

                                                    <td class = 'editorPublisher'>".$iNewsList["publisher"]." </td>
													
													<td class='editorModeDate'>".$iNewsList["mdate"]."</td>
													
													<td id='editorEdit' style='padding-left:20px;'><span style='cursor:pointer'><img src='/jsImages/editButton.gif'/></span></td>
													
													<td id='editorDelete' style='padding-left:28px'><span style='cursor:pointer'><img src='/jsImages/deleteButton.png'/></span></td>
                                              </tr>
                                              
                                            ";	
                                    }
						?>
                        </table>
                        
                        <?php		  
                                    echo "
                                            <div id='editorPagination'>
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
                         						     
                        
                    </div>
                    
                    
                    <div id = "errorMsg"></div>
                    
                    <div id = "errorMsg2"></div>     
                
                </div>
  
            </div> <!--houtaiBody div-->
            
        </div>  <!--body div-->
    
          
    </div> <!--main div-->
    </div> <!--container div-->
  
    <div id="pageDim"></div>
    
    <div id="previewWrap">
        <div id="previewContain">
  
            <p id="itemTitle"> get some here</p>
            <p id="itemAuthor"></p><span id="previewModDate"></span>
            <p id="itemEventDate"></p>
            <p id="itemLocation"></p>
            
            <div id="itemBody">
              
              <div id="itemImages">
              
                  <div id="itemImageMainContain">
                      <img id ="itemImageMain" src="">
                  </div>
            
                  <div id="tileOuterContain">
                  
                  </div>
              
              </div>
              <div id="previewContent"></div>
              
            </div> 
    
        </div>  
        
        <div id="previewSubmitWrap">
            <button id="previewSubmit" onclick="finalSubmit()">Submit</button>
        </div> 
                    
    </div>  
           
    <div class="footer">
    
        <span class="fSpan">SCUCE London Birmingham Manchester  2014 </span>
        <span class="fSpan">subscribe us</span>
        <span class="fSpan">email us</span>
    
    </div>  <!--footer div-->
  
</body>
  
<script>



function newsPreview (x) {
	
	<?php

 		$findNews = $dbh->prepare("SELECT * FROM articles WHERE id = "+x); 
 		$findNews->execute();
		$newsTitle = $findNews["title"] ;
	?>
	
	$("#pageDim, #previewWrap").animate({"opacity":"0.5"}, 300, "linear");
	$("#previewWrap").animate({"opacity":"1"}, 300, "linear");
	$("#pageDim, #previewWrap").css("display","block");
	document.getElementById("itemTitle").innerHTML = <?php echo $newsTitle;?>;
	
	
};

function closePreview() {
	$("#pageDim").animate({"opacity":"0"}, 300, "linear", 
		function(){					
			$("#pageDim, #previewWrap").css("display","none");
			document.getElementById("itemImageMain").innerHTML="";
			document.getElementById("tileOuterContain").innerHTML = "";
		}
	);
}

$("#pageDim").click(function(){
	closePreview();
});


</script>

<!------------------------------form check scripts here  ------------------------------------------->   
        
</html>      
