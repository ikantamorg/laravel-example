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
});

$(function () {

	var $el = $('#content .left-pane .left-item.selected');

	$el.height($el.find('.tag-list').height() + 30);

	/*
	$('#content .left-pane .heading').click(function () {
		var $el = $(this).parent().parent();

		if($el.hasClass('selected'))
			return false;
		
		var height = $el.find('.tag-list').height() + 30 ;

		$el.siblings('.selected')
				.removeClass('selected')
				.find('.tag-list').animate({'opacity': 0}).end()
				.animate(
					{'height': '30px'}
				);

		$el.addClass('selected')
				.find('.tag-list').animate({'opacity': 1}).end()
				.animate({'height': height+10});
							
	});
	*/
});

$(function () {
	$('#content .left-pane .favorite-tag .fav').click(function () {
		var $el = $(this);

		if($el.hasClass('selected'))
			$el.removeClass('selected')
		else
			$el.siblings('.selected').removeClass('selected').end().addClass('selected')
	});
});

</script>