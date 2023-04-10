jQuery(document).ready(function($) {
	"use strict";
	////////////////////////////////////product-carousel
	$(function() {
	  var owl = $("#product-carousel");
	  owl.owlCarousel({
		items : 4,
		autoPlay: 5000,
		goToFirstSpeed : 3000,
		pagination: false
	  });
	  
	  // Custom Navigation Events
		  $(".next").click(function(){
			owl.trigger('owl.next');
		  })
		  $(".prev").click(function(){
			owl.trigger('owl.prev');
		  })
	});
	
	////////////////////////////////////home-slider
	$(function() {
 
	  var sync1 = $("#sync1");
	  var sync2 = $("#sync2");
	 
	  sync1.owlCarousel({
		singleItem : true,
		slideSpeed : 1000,
		navigation:true,
		autoPlay: 5000,
		navigationText: [
		  "<i class='sprv'></i>",
		  "<i class='snxt'></i>"
		  ],
		pagination:false,
		afterAction : syncPosition,
		responsiveRefreshRate : 200,
	  });
	  
	  sync2.owlCarousel({
		items : 5,
		pagination:false,
		responsiveRefreshRate : 100,
		afterInit : function(el){
		  el.find(".owl-item").eq(0).addClass("synced");
		}
	  });
	  
	  function syncPosition(el){
		var current = this.currentItem;
		$("#sync2")
		  .find(".owl-item")
		  .removeClass("synced")
		  .eq(current)
		  .addClass("synced")
		if($("#sync2").data("owlCarousel") !== undefined){
		  center(current)
		}
	  }
	 
	  $("#sync2").on("click", ".owl-item", function(e){
		e.preventDefault();
		var number = $(this).data("owlItem");
		sync1.trigger("owl.goTo",number);
	  });
	 
	  function center(number){
		var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
		var num = number;
		var found = false;
		for(var i in sync2visible){
		  if(num === sync2visible[i]){
			var found = true;
		  }
		}
	 
		if(found===false){
		  if(num>sync2visible[sync2visible.length-1]){
			sync2.trigger("owl.goTo", num - sync2visible.length+2)
		  }else{
			if(num - 1 === -1){
			  num = 0;
			}
			sync2.trigger("owl.goTo", num);
		  }
		} else if(num === sync2visible[sync2visible.length-1]){
		  sync2.trigger("owl.goTo", sync2visible[1])
		} else if(num === sync2visible[0]){
		  sync2.trigger("owl.goTo", num-1)
		}
		
	  }
	 
	});
	
	////////////////////////////////////home-slider
	$(function() {
		$("#srch").click(function() {
		  $('.srchwrap').toggle('fast', function() {
		  });
		});
	});
	$(function() {
		$("#reg").click(function() {
		  $('.regwrap').toggle('fast', function() {
		  });
		});
	});
	$(function() {
		$("#popcart").click(function() {
		  $('.popcart').toggle('fast', function() {
		  });
		});
	});
	
	////////////////////////////////////map
	$(function() { 
		demo.add(function() {
			$('#map_canvas').gmap({'center': '57.7973333,12.0502107', 'zoom': 10, 'disableDefaultUI':true, 'callback': function() {
				var self = this;
				self.addMarker({'position': this.get('map').getCenter() }).click(function() {
				self.openInfoWindow({ 'content': 'Hello World!' }, this);
				});	
			}});
		}).load();
	});
	
	$(function() {
		$('#myTab a').click(function (e) {
		  e.preventDefault()
		  $(this).tab('show')
		});
	});
	
	
	$(function() {
		$('.fancybox').fancybox();
	});
	
	$(function() {
		$.fn.raty.defaults.path = 'js/rate/images';
		$('#default').raty();
		$('#score').raty({ readOnly: true, score: 3 });
	});

});