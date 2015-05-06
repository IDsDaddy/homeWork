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
			 
			 $totalRow = intval($latestNews['id']);
			 $startingId = 1;
			 
			 if ($totalRow > 4)
			 {
				 $startingId = $totalRow - 4;
			 }
		   
			$sth2 = $dbh->prepare("SELECT * FROM articles WHERE id>=$startingId ORDER BY id DESC");	
			$sth2->execute();
			
			$recentNews = $sth2->fetchAll();
			
			
			/*fetch result from the publications table   */  		
			$sth3 = $dbh->prepare("SELECT * FROM publications ORDER BY id DESC LIMIT 0,1");
			$sth3->execute();
			
			$latestPubs = $sth3->fetch(PDO::FETCH_ASSOC);
			$latestPubBody = $latestPubs['body'];
			
			$pubBodyLength = strlen($latestPubBody);
			
			$latestPubBody = substr($latestPubBody, 0, 280);
			
			$totalRow3 = intval($latestPubs['id']);
			
			$startingId3 = 1;
			if ($totalRow3 > 4)
			{
				$startingId3 = $totalRow3 - 4;
			}
			
			$sth4 = $dbh->prepare("SELECT * FROM publications WHERE id>=$startingId3 ORDER BY id DESC");
			$sth4->execute();
			
			$recentPubs = $sth4->fetchAll();
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
                            <li class="nav_bar"><a href="#" class="myButton">publications</a></li>
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
                    
                        <section id = "intro">
                             <div id = "introTitle"> 结志同道合之人，促中英文化交流。</div>
                             
                             <img src="jsImages/e63_3.jpg" />
                             
                             <div id = "introBody" >
                             	
                                <p>
                                	&nbsp;&nbsp;&nbsp;&nbsp;中英文化交流学会（The Society for China-UK Cultural Exchange，缩写SCUCE）旨在促进中英文化交流，致力于在英国推广和介绍中国文化，以便让更多的英国人了解中国文化；同时也向华侨、华人和国人介绍英国的文化。<br /><br />
									&nbsp;&nbsp;&nbsp;&nbsp;学会的口号是："结志同道合之人，促中英文化交流。" <br /><br />
                                </p>
                                
                                <p class = "introExpand">
                                	<span id = "historyTitle">* 学会介绍 *</span><br /><br />
                                	<span id = "history">
                                    &nbsp;&nbsp;&nbsp;&nbsp;本会于2011年8月14日成立于伦敦，在约30名创始会员中，有在英国从事自然科学与社会科学的学者，有音乐、美术、舞蹈、影视等方面的艺术人才，也有从事教育、医务、技术、工商、金融等行业的人士。<br /><br />
                                        
&nbsp;&nbsp;&nbsp;&nbsp;学会成立以来，举办和参与了以下一些活动：<br /><br />

&nbsp;&nbsp;&nbsp;&nbsp;2011年9月主办在剑桥大学举行的英国华侨华人学者"首届两岸三地纪念辛亥革命100周年学术论坛"（报道见人民网http://www.022net.com/2011/9-7/512973173081266.html;会长刘建一的主旨发言见中国社会科学院近代史所网 http://jds.cass.cn/Item/21578.aspx）。同年，会员在《人民日报》、《英中时报》和《华闻周刊》及国内学术网站发表了关于辛亥革命以及旅英学人和辛亥革命的系列文章。<br /><br />

&nbsp;&nbsp;&nbsp;&nbsp;学会不定期举办文化沙龙活动，请在英国、大陆和其他国家的学者讲演。2012年春曾请安徽大学王天根教授演讲"鸦片战争"，夏请美国波士顿大学曹天予教授演讲"科学哲学"。<br /><br />

&nbsp;&nbsp;&nbsp;&nbsp;为配合纪念中英建交40周年，2012年学会在英国各华文报刊发表了《英国人在中国》和《中国人在英国》的系列文章，分别介绍了多位早年来华的英国外交家、传教士、学者等和到英国的著名中国人。<br /><br />

&nbsp;&nbsp;&nbsp;&nbsp;是年秋，本会与中部华人会和伯明翰学联联合举办了《月是故乡明》大型中秋晚会，请了多位专业音乐、舞蹈人士演出，英国各大华报均有报导（另见http://www.66van.com/newshome/html/59/n-63659.html；http://news.powerapple.com/chinese/2012/10/12/799938.html）。<br /><br />

&nbsp;&nbsp;&nbsp;&nbsp;2013年，学会继续发表《英国人在中国》系列文章，并拟将英国教授写的专著The Chinese in Britain翻译为中文。在征得原作者同意后，我会会员卜毅已准备着手翻译；后因国内出版社不愿出版不赚钱的学术著作才作罢。本会还参与《欧洲时报》有关海峡两岸等话题的征文，并发表文章。<br /><br />

&nbsp;&nbsp;&nbsp;&nbsp;2月，本会会员高灵的作品入选参加"'再生长'——首届旅英艺术家双年展"，并在伦敦的其他画廊展出。<br /><br />

&nbsp;&nbsp;&nbsp;&nbsp;4月13日，本会会员王蓓蓓在伦敦主演普契尼歌剧《修女安洁丽卡》，一些会员应邀前去观看。会长刘建一撰写了报道在《英中时报》发表。<br /><br />

&nbsp;&nbsp;&nbsp;&nbsp;2013年5月18-19日，会员张楠、赵小军、刘建一将自己的水墨画、现代剪纸作品在一次英国的大型活动中参展义卖，并为英国人写中文姓名（活动十分有趣，见视频http://my.tv.sohu.com/user/detail/78159436.shtml），另有六位会员参往观赏和协助。义卖所得一部分捐给英国研制墨水之父的故居（现已为博物馆），其余用于学会经费。<br /><br />

&nbsp;&nbsp;&nbsp;&nbsp;5月26日，本会有七位会员参加了在伦敦举行的赈灾（雅安地震）义演，其中来自伯明翰的张予宁和来自曼城的高维嘉担任了领唱和独唱，付雪娇钢琴伴奏。<br /><br />

&nbsp;&nbsp;&nbsp;&nbsp;2014年6月18日和20日，会员王蓓蓓在意大利歌剧团来英演出的歌剧《蝴蝶夫人》中饰演女主角。多位会员前往观看。刘会长的报道发表于《英中时报》。<br /><br />

&nbsp;&nbsp;&nbsp;&nbsp;同年6-7月，北京大学教授（曾任北京市文联副主席）段宝林应本会之邀来英国进行学术访问，参访几所大学及研究所，并于7月1日在本会和英国中华传统文化研究院合办的讲座上以"中华龙与和合文化"为题进行讲演。(各报报道，并见英侨网http://www.ukjs.net/article/北大教授侨领齐话民俗-旅英华人华侨共促交流、中新网http://www.chinanews.com/hr/2014/07-11/6376887.shtml)。<br /><br />

&nbsp;&nbsp;&nbsp;&nbsp;夏，我会辑录了300余首抗战诗词，策划在英国各地举办抗战诗歌朗诵演唱会。朗诵演唱会于9月在伦敦（20日与北京同乡会合作）、伯明翰（1日与中部华人会合作）及曼城（5日由曼城分会主办）分头举行。几位会员谢汉森、李丹阳等为此次活动撰写了诗词。新四军研究会发来贺函，会长、陈毅之子特为伦敦场演出写来两首诗词。人民日报首记者及其他报社亲临报道，发稿后被各大网站转载，并在中国国际广播电台报道，在国内外造成一定影响。<br /><br />
								</span>
                                    
                                </p>
                                
                                 <p class = "introExpand">
                                	<span id = "deveTitle">* 最新动态 *</span><br /><br />
                                    <span id = "development">
                                    &nbsp;&nbsp;&nbsp;&nbsp;学会自2012年始，致力于推动于2015年在英国首演《黄河大合唱》。为此，数度参与合唱主体——伦敦华人爱乐合唱团和曼城同心合唱团的活动；会长刘建一应请为"伦敦华人爱乐合唱团"题写团名。为促成演出事，学会在国内外聘请了多次指挥过《黄河大合唱》的原中央乐团团长严良堃和指挥过国内外多个乐团的著名指挥邵恩先生及冼星海的女儿冼妮娜担任顾问，并要来国家交响乐团《黄河大合唱》的管弦乐总谱、单、双钢琴谱。本会还请几位在抗战时期指挥或演唱过《黄河大合唱》的老人题词鼓励，并与在英国和中国的各方联络、交涉积极促成此事。<br /><br />
                                    
&nbsp;&nbsp;&nbsp;&nbsp;近年来我会陆续吸收了约30位新会员，使会员总数增加至约60人，其中有不少在一些方面很有造诣和专长。我会吸收会员不局限于一地，着眼于全英范围。现曼城已有分会，高维嘉副会长兼分会长。凡为本会会员，均可介绍新会员加入本会，但需报请正、副会长同意并备案。<br /><br />                            
                                    </span>
                                </p>
                                
                                <p class = "introExpand">
                                	<span id = "directorsTitle">* 学会创始人 *</span><br /><br />
                                    <span id = "directors">
                                    &nbsp;&nbsp;&nbsp;&nbsp;中英文化交流学会创始人及会长，刘建一博士，于何时何时如何如何，又于何时何时如何如何。<br /><br />   
                                    
                                    &nbsp;&nbsp;&nbsp;&nbsp;中英文化交流学会创始人及副会长，李丹阳博士，于何时何时如何如何，又于何时何时如何如。<br /><br />   
                                    </span>
                                </p>
                                
							 </div>


                             
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



