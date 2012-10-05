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
</script>