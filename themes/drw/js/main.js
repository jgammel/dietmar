$(document).ready(function(){
  $('#clothesline-wrapper--XXXDEPRECATED').slick({
    infinite:false,
    slidesToShow: 6,
	slidesToScroll: 1,
	arrows: true,
	variableWidth: true,
	responsive: [
	{
      breakpoint: 1500,
      settings: {
        slidesToShow: 5,
        slidesToScroll: 1,
        infinite: false,
        dots: false
      }
    },	
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1,
        infinite: false,
        dots: false
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
      }
    },
    {
      breakpoint: 450,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
  });
  
  $('#clothesline-wrapper').masonry({
	  itemSelector: '.clothesline-item',
	  gutter: 10,
	  horizontalOrder: true,
	  //columnWidth: 150,
  });
  
  $('#portfolio-slider').slick({
	infinite: false,
	slidesToShow: 1,
	slidesToScroll: 1,
	arrows: true,
	adaptiveHeight: true,
	centerMode: false,
  });
  
  if( $('ul.image-gallery').children().length > 1){
	  $('ul.image-gallery').slick({
		  slidesToShow: 5,
		  slidesToScroll: 1,
		  asNavFor: '#portfolio-slider',
		  infinite: false,
		  dots: false,
		  arrows: false,
		  centerMode: false,
		  focusOnSelect: true,
		  adaptiveHeight: false,
	  });
	  $('ul.image-gallery').css("visibility","visible");
  }
  else{
	  $('ul.image-gallery').addClass("visually-hidden");
  }

  $('p.preview-text a.read-more, a.read-less').bind("click", function(){
	  ShowHideContent();
  });

  
  function ShowHideContent(){
	  if($('.hide-the-content').length > 0){
		  $('.hide-the-content').addClass("show-the-content");
		  $('.hide-the-content').removeClass("hide-the-content");
		  $('p.preview-text a.read-more').html("Less");
	  }
	  else{
		  $('.show-the-content').addClass("hide-the-content");
		  $('.show-the-content').removeClass("show-the-content");
		  $('p.preview-text a.read-more').html("More");
	  }
  }
  
  $('.clothesline-item > a').bind("click", function(e){
	  //open portfolio item in a lightbox
	  e.preventDefault();
	  OpenPortfolioLightbox($(this));
  });
  
  
  function OpenPortfolioLightbox(obj){
	  var windowHeight = $(document).height();
	  var offsetY = window.pageYOffset;
	  //windowHeight = windowHeight.toString() + "px";
	  $.get(obj.attr('href'), function(data){
		  var the_lightbox = "<div id=\"lightbox\"></div>";
		  var exit_button = "<div id=\"lightbox-exit\"><span>x</span></div>";
		  var html_start = data.indexOf("<div id=\"primary\" class=\"content-area\">");
		  var html_end = data.indexOf("</div><!-- #primary -->");
		  var html = data.substring(html_start, html_end);
		  $("body").append(the_lightbox);//create lightbox
		  $("#lightbox").html(html);//add data to lightbox
		  $('#lightbox').css({
            'margin-top': offsetY + 'px'
       	  });
		  $('body').css({
            'position': 'fixed',
            'top': -offsetY + 'px'
          });
		  slickify();  
		  $("#lightbox").animate({
			  opacity: 1,
		  }, 500 , function(){
			$("#lightbox").append(exit_button);// create exit button
			$('#lightbox-exit').bind("click", function(e){
				  $(this).remove(); //destroy exit button
				 ClosePortfolioLightbox(offsetY); 
			  });
		   $('#lightbox .post-navigation-next a, #lightbox .post-navigation-prev a').bind("click", function(e){
				  //open portfolio item in a lightbox
				  e.preventDefault();
				  ClosePortfolioLightboxAndOpenNew($(this)); 
			  });
		  }); 
	  });
  }
  
  function ClosePortfolioLightbox(scrollY){
	  $('body').css({
            'position': '',
            'top' : '',
      });
	  $(window).scrollTop(scrollY);
	  $("#lightbox").animate({
		  opacity: 0,
	  }, 500 , function(){
		$("#lightbox").remove(); //destroy lightbox
		$('#lightbox-exit').unbind("click");
		unslickify();
	  });
  }
  
  function ClosePortfolioLightboxAndOpenNew(obj){
	  unslickify();
	  $.get(obj.attr('href'), function(data){
		  var exit_button = "<div id=\"lightbox-exit\"><span>X</span></div>";
		  var html_start = data.indexOf("<div id=\"primary\" class=\"content-area\">");
		  var html_end = data.indexOf("</div><!-- #primary -->");
		  var html = data.substring(html_start, html_end);
		  $("#lightbox").html(html);//add data to lightbox
		  slickify();
		  $("#lightbox").append(exit_button);// create exit button
		  $('#lightbox-exit').bind("click", function(e){
			  $(this).remove(); //destroy exit button
			 ClosePortfolioLightbox(); 
		  });
		  $('#lightbox .post-navigation-next a, #lightbox .post-navigation-prev a').bind("click", function(e){
			  //open portfolio item in a lightbox
			  e.preventDefault();
			  ClosePortfolioLightboxAndOpenNew($(this)); 
		  });
	  });
  }
  
  function slickify(){
	$('#portfolio-slider').slick({
		infinite: false,
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: true,
		adaptiveHeight: false,
		centerMode: false,
		lazyLoad: 'ondemand',
	});
	if( $('ul.image-gallery').children().length > 1){
	  $('ul.image-gallery').slick({
		  slidesToShow: 5,
		  slidesToScroll: 1,
		  asNavFor: '#portfolio-slider',
		  infinite: false,
		  dots: false,
		  arrows: false,
		  centerMode: false,
		  focusOnSelect: true,
		  adaptiveHeight: false,
	  });
	  
	  $('ul.image-gallery').css("visibility","visible");
	}
	else{
		$('ul.image-gallery').addClass("visually-hidden");
	}
  }
  function unslickify(){
	  $('#portfolio-slider').slick('unslick');
	  if( $('ul.image-gallery').children().length > 1){
	  	$('ul.image-gallery').slick('unslick');
	  }
  }
  
  
  function genreSortify(dataName){
	  var timelineData = $('.timeline-data');
	  var timelineDot = timelineData.children('.timeline-ball');
	  if(dataName === "all"){
		  timelineDot.removeAttr( 'style' );
		  return;
	  }
	  if(dataName === "filters"){
		  $('#timeline-sort-bar').toggleClass("filters-open");
		  return;
	  }
	  timelineDot.removeAttr( 'style' );
	  timelineData.filter(function(){
		 return $(this).attr('data-name').match(dataName); 
	  }).children('.timeline-ball').css('background', '#d2232a');
  }
  
  $('#timeline-sort-bar .sort-button').bind("click", function(e){
	  var dataName = $(this).attr("data-name");
	  $(this).siblings().removeClass("selected");
	  $(this).addClass("selected");
	  genreSortify(dataName);
  });
  
  $('.timeline-ball').on("mouseenter mouseleave", function(event){
	  $(this).siblings('.hover-box').fadeToggle(200, function(){
		  //translateX to position of the ball
	  });
  });
  
  $('#colophon').bind("mouseenter", function(event){
	  //$('body').addClass("scrollaway");
	  $(this).addClass("expanded");
	  translateFooter($(this));
	  event.stopImmediatePropagation();
  });
  
  function translateFooter(footer){
	  var height = footer.outerHeight();
	  var heightArray = [];
	  var timelineItemContainer = footer.find('.timeline-item-container');
	  for(var i=0; i < timelineItemContainer.length; i++){
		  heightArray.push($(timelineItemContainer[i]).height());
	  }
	  var timelineItemHeight = (Math.max.apply(Math, heightArray));
	  var windowHeight = $( window ).height();
	  //height = -(height + timelineItemHeight);
	  height = -((windowHeight - height) - 80);

	  //translateY the footer by negative height
	  footer.css("transform","translateY("+height+"px)");
  }
  
  $('#colophon').bind("mouseleave", function(event){
	  //$('body').removeClass("scrollaway");
	  $('#colophon').removeClass("expanded");
	  $('#colophon').css("transform","");
	  event.stopImmediatePropagation()
  })
  
  if($('#colophon').length > 0){
	  $('#colophon').hide();
	  var timelineWidth = $( window ).width();
	  if(timelineWidth > 1480){ //length of timeline up to the 2010s
		var emptySpace = timelineWidth - 1480; //how much blank space in the timeline?
		var extraDecades = Math.ceil(emptySpace/200); //how many extra decades to add to fill the empty space?
		var i;
		var y = 20;
		for (i = 1; i <= extraDecades; i++) { 
		  var string ="<div class=\"decade\">";
		  var string = string + "<div class=\"timeline-zero-year\"><p>20</p><div class=\"timeline-segment\"></div><strong>"+y+"</strong></div>";
		  var segment = "<div class=\"timeline-segment\"></div>";
		  var halfSegment = "<div class=\"timeline-segment half\"></div>";
		  var s = 1;
		    while(s < 10){
				if (s == 5){
					string = string + halfSegment;
				}
				else{
					string = string + segment;
				}
				s++;
			}
		  string = string + "</div>";
		  $( ".infinity" ).append(string);//append extra decades into .decade.infinity
		  y += 10;
		}
	  }
	  if (timelineWidth >= 600){ //only show footer on desktop
	  	$('#colophon').show("slow");
	  }
  }

});
	