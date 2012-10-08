<script>
$(function (){

	$('.dropdown-toggle').dropdown();

	$('.carousel').carousel({
	  interval: 2000
	});

	$('.icon a, .add-q-btn a').tooltip();

	$('.left-pane').affix();

});


$(function (){
	$('.socials .icon.share').hover(
		function (){
			$(this).children(':eq(1)').stop().fadeIn(150);
		},
		function(){
			$(this).children(':eq(1)').stop().fadeOut(150);
		}
	);

});

$(function (){
	$('.artist-name, .agent-name').hover(
		function (){
			$(this).children(':eq(1)').stop().fadeIn(150);
		},
		function(){
			$(this).children(':eq(1)').stop().fadeOut(50);
		}
	);
})

$(function (){
	$('.artist-detail .more').hover(
		function (){
			$(this).children('ul').stop().fadeIn(150);
		},
		function(){
			$(this).children('ul').stop().fadeOut(150);
		}
	);
})
</script>