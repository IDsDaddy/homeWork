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
  
                    <div id="neExButtonWrap">
                    
                      <button type="button" id="newConToggle">Add New Content </button>                           
                      <button type="button" id="editConToggle">Edit Existing Content </button>
                      
                    </div>
                    
                    <div id="newContent">
                    
                        <form action="newcontent.php" method="post" enctype="multipart/form-data" id="uploadForm" name="newNewsCon">
                            
                                <div id="infoFields">
                                
                                    <p>Title: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="newTitle" size="50"/></p><span id="titleMissing"></span>
                                    
                                    <p>Location: &nbsp;&nbsp;<input type="text" name="newLocation" id="newLocation" size="42"/> n/a <input type="checkbox" name="noLocation" onchange="checkForLocation(this)"/></p><span id="locationMissing"></span>
                                    
                                    <p>Event Time: <input type="text" name="newTime" id="newTime" size="42"/> n/a <input type="checkbox" name="noTime" onchange="checkForTime(this)" /></p><span id="timeMissing"></span>
                                    
                                    <p>Main Content</p><span id="contentMissing"></span>
                                    
                                    <p><textarea name="mainContent" rows="20" cols="55" style="font-size:15px"></textarea></p>
                                    <p>Editor: <input type="text" name="editor" value="DanYang" /></p><span id="editorMissing"></span>
                                
                                </div>  
                                                            
                                <div id="imageBrowser">
                                
                                    Please Select the Images Associated with the Content.
                                    <div id="image_1">
    
                                        <input type="file" name="uploadImage[]" multiple="multiple" class="fileToUpload" onchange="browseButton(1)"/>
                                        <img id="preview_1" src="" height="200px" style="display:none"/>
                                        <span id='msg'></span>
                                        <button  type="button" id="deleteButton_1" style="display:none" onclick = "deleteButton(1)">Delete</button>
                                    
                                    </div>
                                    <button type="button" id="addNew" onclick="addImage()">Add More Image</button>
                                                                            
                                </div>
  
                        </form>
  
                    
                    </div>
                    
                    <div id="previewButton">
                         <button type="button" id="submitButton" onclick="sButton()">Preview New Content</button>
                    </div>
                    
                   
                
                    <div id="existingContent">
                    
                        <ul id = "exContentBody">
                            <?php
                                            
                                if(empty($_GET["currentpage"]))
                                {
                                    $currentPage = 1;
                                }
                                else {
                                    $currentPage = $_GET["currentpage"];
                                }	
                                
                                $displayLimit = 5;
                                
                                
                                
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
                                        $endPos = 5;
                                    }
                                    
                                    $sthNewsList = $dbh->prepare("SELECT *FROM articles ORDER BY id DESC LIMIT $startingPos, $endPos");
                                    
                                    $sthNewsList->execute();
                                    
                                    $theNewsList=$sthNewsList->fetchAll();

                                    foreach($theNewsList as $iNewsList)
                                    {
                                        echo "<li id = 'iNewsList'>";
                                                    
                                                    
                                        echo 		
                                                  	"<span ><a id='newsEditTitle' href='newsitem.php?id=".$iNewsList["id"]."'>".$iNewsList["title"]."<a/></span>
                                               

                                                <br>
                                                    <span id = 'newsListPub'>".$iNewsList["publisher"].", &nbsp;&nbsp; ".$iNewsList["mdate"]."</span>
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
  
  <!------------------------------form check scripts here  ------------------------------------------->
<script type="text/javascript">
   
    var fileCount = 1;
    
    var add = (function () {
  
        return function () {return fileCount++};
        
    })();
    var minus = (function () {
  
        return function () {return fileCount--};
        
    })();
    
    
    
    document.getElementById("newTime").disabled = false;
    document.forms['newNewsCon']['noTime'].checked = false;
    
    document.getElementById("newLocation").disabled = false;
    document.forms['newNewsCon']['noLocation'].checked = false;;
    
    
    function clearingForm (x) {
        
        $("#image_"+x).wrap("<form>").closest("form").get(0).reset();
        $("#image_"+x).unwrap();
    }
    
    clearingForm(1);
    
    function browseButton (x) { 
  
        var preview = $("#preview_"+x);
        
        var deleteImage = $("#deleteButton_"+x);
      
        var file = document.querySelector("#image_"+x+" > input").files[0];
        document.getElementById("errorMsg").innerHTML = "line 81 browseButton x is "+x;
        
        var reader = new FileReader();		  
       
                    
        if (file) {		
            reader.readAsDataURL(file);
                 
            reader.onloadend = function () {
                var fileType = file.type;
                
                
                if(fileType.match('image.*')){
                    
                    $(preview).attr("src", reader.result);
                    $(preview).css("display", "block"); 
                    $(deleteImage).css("display", "block");
  
                }
                else{
                    alert("the file you selected is not an image file.please upload image files only.")
  
                    clearingForm(x);
                    
                }
                  
            };
        
        }
        else {
            preview.src = "";	
        }	
  
    };
    
    function deleteButton (x) {
        
        var thisButton = $("#deleteButton_"+x);
                            
        var parentDiv = thisButton.parent();
  
        var parentId = parentDiv.attr("id");
        
        if(fileCount == 1){					
            clearingForm(1);	
            $("#preview_1").attr("src","");
            $("#preview_1").css("display","none");
            $(".deleteButton_1").css("display","none");
        }
        else
        {
            parentDiv.remove();	
                
            for (i = x; i<=fileCount; i++) {
            // loop through every diff
                var nthDiv = $("#uploadForm div:nth-of-type("+i+")");
                
                nthDiv.find("button").attr("id", "deleteButton_"+i);						
                nthDiv.attr("id", "image_"+i);
                nthDiv.find("img").attr("id", "preview_"+i);
                nthDiv.find("button").attr("onclick", "deleteButton("+i+")");		
                nthDiv.find("input").attr("onchange", "browseButton("+i+")");			
                
            }				
  
            minus();
        }
  
    };
  
    
    function addImage() {	
        
        add();
        
        newDivId = "image_"+fileCount;
        
        var newInput = '<div id='+newDivId+'><input type="file" name="uploadImage[]" multiple="multiple" class="fileToUpload" onchange="browseButton('+fileCount+')"/><img id="preview_'+fileCount+'" src="" height="200px" style="display:none"/><span id="msg"></span><button type="button" id="deleteButton_'+fileCount+'" onclick = "deleteButton('+fileCount+')" style="display:block">Delete</button></div>'
        
        $("#addNew").before(newInput);
        $(".deleteButton_1").css("display","block");
  
    };
    
    function sButton(){
        var fileValue = $(".fileToUpload").val();	
		document.getElementById('previewSubmit').disabled = false; 
        
        checkForm();
        if(checkForm()){
  // ------------delete empty input fields before uploading -------------------- //		
            document.getElementById("errorMsg").innerHTML = "submission success";
            $divCount = 1;
            $newCount = 0;;
            do {
                $currentDiv = $("#image_"+$divCount);
                $fileValue = $currentDiv.find("input").val();
                if ($fileValue == null || $fileValue == ""){
                    $currentDiv.remove();
                    $divCount++;
                    
                } 
                else{
  
                    $newCount++;
  
                    $currentDiv.attr("id", "image_"+$newCount);
                    $currentDiv.find("button").attr("id", "deleteButton_"+$newCount);						
                    $currentDiv.find("img").attr("id", "preview_"+$newCount);
                    $currentDiv.find("button").attr("onclick", "deleteButton("+$newCount+")");		
                    $currentDiv.find("input").attr("onchange", "browseButton("+$newCount+")");	
                    
                    $divCount++;
                }
            } while ($divCount<=fileCount);
            
            fileCount = $newCount;
  
  //------------------------enable submit here-----------------------------------------------				
                
  /* 					document.getElementById("uploadForm").submit();		
            document.getElementById('submitButton').disabled = true; */
  
  //-------------------------------------------------------------------------------------
            $("#pageDim, #previewWrap").animate({"opacity":"0.5"}, 300, "linear");
            $("#previewWrap").animate({"opacity":"1"}, 300, "linear");
            $("#pageDim, #previewWrap").css("display","block");
            
            $windowWidth = $(window).width();							
            $hMargin = ($windowWidth-1000)/2;
            
            $("#previewWrap").css("left",$hMargin);
            
            var title = document.forms['newNewsCon']['newTitle'].value;
            var content = document.forms['newNewsCon']['mainContent'].value;
            var location = document.forms['newNewsCon']['newLocation'].value;
            var eTime = document.forms['newNewsCon']['newTime'].value;
            var editor = document.forms['newNewsCon']['editor'].value
            
            var d = new Date();
            var m = d.getMonth()+1;
            var modTime = d.getFullYear()+"-"+m+"-"+d.getDate()+" "+d.getHours()+":"+d.getMinutes()+":"+d.getSeconds();
            
            document.getElementById('itemTitle').innerHTML=title;
            document.getElementById('itemAuthor').innerHTML=editor;
            document.getElementById('previewModDate').innerHTML=modTime;
            document.getElementById('itemEventDate').innerHTML=eTime;
            document.getElementById('itemLocation').innerHTML=location;
            document.getElementById('previewContent').innerHTML= content;
  
  
            var imageFileArray = [];
            
  //-------------------note that $newCount is number of selected images--------------------------					
            for (arrayCount=1; arrayCount<=$newCount; arrayCount++){
                
                imageFileArray.push(document.querySelector("#uploadForm > #imageBrowser > #image_"+arrayCount+" > input").files[0]);
            };
                            
  
            if (imageFileArray.length!=0){
                
                $mainImage = "show";
                
                $('#itemImages').css("display", "block");
                
                for ($i = 0; $i<imageFileArray.length; $i++){
                    
                    (function(imageFileArray){	
                        
                        var readThis = imageFileArray[$i];
                        
                        var reader = new FileReader();
                        
                        reader.onload = function(e){
                            
                            if($mainImage =="show"){
                                
                                $('#itemImageMain').attr('src', e.target.result);
                                
                                $mainImage = "dontShow";
                            }
            /*  ------------------ create divs for image tiles ----------------------				
                                    <div id='tempContain'>
                                        <img id='tempTile' src='' />
                                    </div> 
                --------------------- to be changed to -------------------------
                                    <div class='imageTileContain'>
                                        <img class='itemImageTile' src='' />
        </div>-----------------------------------------------------------------------------*/	
                            var createNewContain = document.createElement("div");
                            var createNewImg = document.createElement("img");
                            
                            createNewContain.setAttribute("id","tempContain");
                            createNewImg.setAttribute("id","tempTile");
                            
                            document.getElementById("tileOuterContain").appendChild(createNewContain);	
                            
                            document.getElementById("tempContain").appendChild(createNewImg);
                            
                            $containDiv = $('#tempContain');
                            $imageTile = $('#tempTile');
  
                            $imageTile.attr('src', e.target.result);
                            
                            $containDiv.removeAttr("id");
                            $containDiv.attr("class", "previewTileContain");
                            
                            $imageTile.removeAttr("id");
                            $imageTile.attr("class", "itemImageTile"); 
  
                        };
                        reader.readAsDataURL(imageFileArray);
                        
                        
                        
                    })(imageFileArray[$i]);
                }
  
            }
                
            else{
                $('#itemImages').css("display", "none");
  //						document.getElementById('itemImages').innerHTML = "array empty";
            }
                    
        }
  
        else
        {
            document.getElementById("errorMsg").innerHTML = "submission failed";	
        }
  //					document.getElementById("errorMsg").innerHTML = "file uploaded";			
  
    };
    
    $("#pageDim").click(function(){
        closePreview();
    });
    
    function closePreview(){
        $("#pageDim").animate({"opacity":"0"}, 300, "linear", 
            function(){					
                $("#pageDim, #previewWrap").css("display","none");
                document.getElementById("itemImageMain").innerHTML="";
                document.getElementById("tileOuterContain").innerHTML = "";
            }
        );
    };
    
    function checkForLocation(cb) {
        if(cb.checked==true){
            document.getElementById("newLocation").disabled = true;
            document.getElementById("newLocation").value="";
        }
        else
        {
            document.getElementById("newLocation").disabled = false;	
        }
    };
    
    function checkForTime(cb){
        if(cb.checked==true){
            document.getElementById("newTime").disabled = true;
            document.getElementById("newTime").value="";
        }
        else
        {
            document.getElementById("newTime").disabled = false;	
        }
    }
        
    function checkForm(){
            
        var title = document.forms['newNewsCon']['newTitle'].value;
        var content = document.forms['newNewsCon']['mainContent'].value;
        var location = document.forms['newNewsCon']['newLocation'].value;
        var eTime = document.forms['newNewsCon']['newTime'].value;
        var editor = document.forms['newNewsCon']['editor'].value;
        
        var titleVal = 0;
        
        if (title == null || title == "") 
        {    
            document.getElementById("titleMissing").innerHTML="title missing";
            titleVal = 0;										
        }
        else 
        {
            document.getElementById("titleMissing").innerHTML="";
            titleVal = 1;											
        }
        
        var locationVal = 0;
        var noLocation = 0;		
        
        if(document.forms['newNewsCon']['noLocation'].checked)
        {
            noLocation = 1;
        }	
        
        if(document.forms['newNewsCon']['noLocation'].unchecked)
        {
            noLocation = 0;
        }							
  
        if (location == null || location == "")
        {
            if (noLocation == 0) 
            {    											
                document.getElementById("locationMissing").innerHTML="location missing";
                locationVal = 0;										
            };
            if (noLocation == 1) 
            {    											
                document.getElementById("locationMissing").innerHTML="";
                locationVal = 1;										
            };
        }
        else 
        {
            document.getElementById("locationMissing").innerHTML="";
            locationVal = 1;											
        }
        
        var timeVal = 0;
        var noTime = 0;	
  
        if(document.forms['newNewsCon']['noTime'].checked)
        {
            noTime = 1;
        }	
        
        if(document.forms['newNewsCon']['noTime'].unchecked)
        {
            noTime = 0;
        }							
  
        if (eTime == null || eTime == "")
        {
            if (noTime == 0) 
            {    											
                document.getElementById("timeMissing").innerHTML="event time missing";
                timeVal = 0;										
            };
            if (noTime == 1) 
            {    											
                document.getElementById("timeMissing").innerHTML="";
                timeVal = 1;										
            };
        }
        else 
        {
            document.getElementById("timeMissing").innerHTML="";
            timeVal = 1;											
        }
        
        
        var contentVal = 0;
        
        if (content == null || content == "") 
        {    
            document.getElementById("contentMissing").innerHTML="content missing";
            contentVal = 0;										
        }
        else 
        {
            document.getElementById("contentMissing").innerHTML="";
            contentVal = 1;											
        }
        
        
        var editorVal = 0;
        if (editor == null || editor == "") 
        {    
            document.getElementById("editorMissing").innerHTML="editor missing";
            editorVal = 0;										
        }
        else 
        {
            document.getElementById("editorMissing").innerHTML="";
            editorVal = 1;											
        }
        
        if (titleVal == 0 || locationVal == 0 || timeVal == 0 || contentVal == 0) 
        {
            return false;
        }
        else
        {
            return true;
        }
                                    
    }
	
	function finalSubmit () {
		document.getElementById("uploadForm").submit();		
		document.getElementById('previewSubmit').disabled = true; 
	}	

</script>
<!------------------------------form check scripts here  ------------------------------------------->   
        
</html>      
