// JavaScript Document
$(document).ready(function ()
{
	
	$("html").css("width", screen.width);
	
	
	var d = new Date();
	var wkday = new Array(7);
	wkday[0] = "Monday";
	wkday[1] = "Tuesday";
	wkday[2] = "Wednesday";
	wkday[3] = "Thursday";
	wkday[4] = "Friday";
	wkday[5] = "Saturday";
	wkday[6] = "Sunday";
	
	document.getElementById("date").innerHTML= d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate() + " " + wkday[d.getDay()]; ;

//codes for image slides on page centre
	var tInterval;
	var direction = "right";
	var $sWrapper = $("#sWrapper");
	var $sImage = $sWrapper.find(".sImage");
//hide all images behind the first	
	$("#sWrapper > img:gt(0)").hide();
//write a function that cycles through images at desired interval

	function scrollRight ()
	{
		$("#sWrapper > img:first")
		.fadeOut(1000)
		.next()
		.fadeIn(1000)
		.end()
		.appendTo("#sWrapper");	
	}
	
	function scrollLeft ()
	{
		$("#sWrapper > img:first")
		.fadeOut(1000);
		$("#sWrapper > img:last")
		.fadeIn(1000);			
		$("#sWrapper").prepend($("#sWrapper > img:last"));
	}
	
	function startShowRight ()
	{
	  tInterval = setInterval 
	  (
		  function ()
		  {
		   	  scrollRight();
		  },
			  3000
	  );
	}
	
	function startShowLeft ()
	{
		tInterval = setInterval
		(
			function ()
			{
				scrollLeft();	
			},
			3000
		);
	}
//stop the slide	
	function stopShow ()
	{
		clearInterval(tInterval);	
	}
//initiate function on page load	
	startShowRight();
//mouse over the image to stop cycling, away to start again
	$("#sliderFrame").hover
	(
		function(ev)
		{
			stopShow();
		},
		function(ev)
		{
			if (direction == "right")
			{
				startShowRight();
			}
			if (direction == "left")
			{
				startShowLeft();
			}
			
		}
	);
//write functions for arrows on both side
	$("#rightArrow").click
	(
		function()
		{
			if ($sImage.is(":animated")) return;
			scrollRight();
			direction = "right";
		}
	);
	
	$("#leftArrow").click
	(
		function ()
		{
			if ($sImage.is(":animated")) return;
			scrollLeft();	
			direction = "left";		
		}
	);
	
	$("#history").hide();
	
	$("#historyTitle").click
	(
		function ()
		{
			$("#history").toggle();	
		}
	);

	$("#development").hide();
	
	$("#deveTitle").click
	(
		function ()
		{
			$("#development").toggle();	
		}
	);	
	
	$("#directors").hide();
	
	$("#directorsTitle").click
	(
		function ()
		{
			$("#directors").toggle();	
		}
	);	
	
		
	
	$("#newConToggle").click
	(
		function () 
		{
			$("#newContent").css("display","block");
			$('#neExButtonWrap').hide();
			$('#previewButton').show();
		}
	);


		
});