$(document).ready(function(){
  $('#clothesline-wrapper').slick({
    infinite:false,
    slidesToShow: 5,
	slidesToScroll: 1,
	arrows: true,
	responsive: [
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
  
  $('ul.image-gallery').slick({
	  slidesToShow: 5,
	  slidesToScroll: 1,
	  asNavFor: '#portfolio-slider',
	  infinite: false,
	  dots: false,
	  centerMode: true,
	  focusOnSelect: true,
  });

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
	  $.get(obj.attr('href'), function(data){
		  var the_lightbox = "<div id=\"lightbox\"></div>";
		  var exit_button = "<div id=\"lightbox-exit\"><span>X</span></div>";
		  var html_start = data.indexOf("<div id=\"primary\" class=\"content-area\">");
		  var html_end = data.indexOf("</div><!-- #primary -->");
		  var html = data.substring(html_start, html_end);
		  $("body").append(the_lightbox);//create lightbox
		  $("#lightbox").html(html);//add data to lightbox  
		  $("#lightbox").animate({
			  opacity: 1,
		  }, 500 , function(){
			$("#lightbox").append(exit_button);// create exit button
			$('#lightbox-exit').bind("click", function(e){
				  $(this).remove(); //destroy exit button
				 ClosePortfolioLightbox(); 
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
	  });
  }

});
	