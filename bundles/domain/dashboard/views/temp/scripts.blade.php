<script>
$(function (){

	$('.dropdown-toggle').dropdown();

	$('.icon a, .add-q-btn a').tooltip();

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

//---------------------------------------------------------------------------------------------------




// Function to determine the behaviour of the play button on every song in the play-list
/*
$(function (){
	$('#player .play-song, #player .play-video').click(function (){
		var $playBtn = $(this),
			$listItem = $playBtn.parent();

		if($listItem.hasClass('current')){
			if($listItem.hasClass('playing'))
				$listItem.removeClass('playing');
			else
				$listItem.addClass('playing ');
		} else{
			$listItem.siblings('.current').removeClass('current').removeClass('playing').end().addClass('current')
			.addClass('playing');
		}
	});
	
	
	$('#player .song-play-btn, #player .video-play-btn').click(function (){
		var $playBtn = $(this),
			$listItem = $playBtn.parent().parent()
		;	

		if($listItem.hasClass('current')){
			if($listItem.hasClass('playing'))
				$listItem.removeClass('playing');
			else
				$listItem.addClass('playing ');
		} else{
			$listItem.siblings('.current').removeClass('current').removeClass('playing').end().addClass('current')
			.addClass('playing');
		}
	});

*/
/*

	// TO REMOVE THE SONG FROM THE PLAYLIST

	$('#playlist .list-item .close').click(function (){
		$(this).parent().slideUp();
	});


	// TO CLEAR ALL THE SONGS FROM THE PALY-LIST

	$('.playlist .clear').click(function (){
		$(this).parent().siblings().find('.list-item').hide();
	});
});
*/

//---------------------------------------------------------------------------------------------------



// TO COLLAPSE AND EXPAND THE VIDEO AND PLAYLIST WINDOW


//---------------------------------------------------------------------------------------------------


$(function (){
	$('.settings .edit').click(function (){
		var $edit = $(this),
			$setItem = $edit.parent().parent(),
			$selectedItem = $setItem.siblings('.selected');
		;

		$selectedItem.length > 0 && $selectedItem.removeClass('selected').find('.hidden-data').hide().end().find('.data').show();
			
		$setItem.addClass('selected').find('.data').hide().end().find('.hidden-data').show();

	});
});

</script>