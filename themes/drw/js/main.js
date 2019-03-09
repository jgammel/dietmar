$(document).ready(function(){
  $('#clothesline-wrapper').slick({
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

  $('p.preview-text a.read-more').bind("click", function(){
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
	  //windowHeight = windowHeight.toString() + "px";
	  $.get(obj.attr('href'), function(data){
		  var the_lightbox = "<div id=\"lightbox\"></div>";
		  var exit_button = "<div id=\"lightbox-exit\"><span>X</span></div>";
		  var html_start = data.indexOf("<div id=\"primary\" class=\"content-area\">");
		  var html_end = data.indexOf("</div><!-- #primary -->");
		  var html = data.substring(html_start, html_end);
		  $("body").append(the_lightbox);//create lightbox
		  $("#lightbox").html(html);//add data to lightbox
		  //$('#lightbox').css("height", windowHeight);
		  slickify();  
		  $("#lightbox").animate({
			  opacity: 1,
		  }, 500 , function(){
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
	  });
  }
  
  function ClosePortfolioLightbox(){
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
  }
  function unslickify(){
	  $('#portfolio-slider').slick('unslick');
	  $('ul.image-gallery').slick('unslick');
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
	  }).children('.timeline-ball').css('background', '#000000');
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
	  $('body').addClass("scrollaway");
	  $(this).addClass("expanded");
	  event.stopImmediatePropagation()
  });
  
  $('#content').bind("mouseenter", function(event){
	  $('body').removeClass("scrollaway");
	  $('#colophon').removeClass("expanded");
	  event.stopImmediatePropagation()
  })
});
	