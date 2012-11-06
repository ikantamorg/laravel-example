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

/**Player**/


// Function to Play or Pause the palyer

$(function (){
	$('#player .play').toggle(
		function (){
			$(this).addClass('pause');
		},
		function(){
			$(this).removeClass('pause');
		}
	);
});

//---------------------------------------------------------------------------------------------------




// Function to determine the behaviour of the play button on every song in the play-list

$(function (){
	$('.play-song, .play-video').click(function (){
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
	
	
	$('.song-play-btn, .video-play-btn').click(function (){
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



	// TO REMOVE THE SONG FROM THE PLAYLIST

	$('#playlist .list-item .close').click(function (){
		$(this).parent().slideUp();
	});


	// TO CLEAR ALL THE SONGS FROM THE PALY-LIST

	$('.playlist .clear').click(function (){
		$(this).parent().siblings().find('.list-item').hide();
	});
});

//---------------------------------------------------------------------------------------------------



// TO COLLAPSE AND EXPAND THE VIDEO AND PLAYLIST WINDOW

$(function (){
	$('#player .control .video').click(function () {
		var $el = $(this).parent().parent().parent().find('.frame.video');
		
		if($el.height() > 0) {
			$el.animate({top:'12px', height:'0px'}, 300);
			$el.find('.screen').animate({height:'0px'}, 300);
		} else {
			$el.animate({top:'-339px', height:'350px'}, 300);
			$el.find('.screen').animate({height:'315px'}, 300);
		}
	});



	$('#player .frame.video .collapse').click(
		function(){
			$(this).parent().parent().animate({top:'12px', height:'0px'}, 300);
			$(this).parent().siblings().animate({height:'0px'}, 300);

		}
	);



	$('#player .control .playlist').click(function () {
		var $el = $(this).parent().parent().parent().find('.frame.playlist');

		if($el.height() > 0) {
			$el.animate({top:'12px', height:'0px'}, 300);
			$el.find('.screen').animate({height:'0px'}, 300);
		} else {
			$el.animate({top:'-339px', height:'350px'}, 300);
			$el.find('.screen').animate({height:'315px'}, 300);
		}
	});



	$('#player .frame.playlist .collapse').click(
		function(){
			$(this).parent().parent().animate({top:'12px', height:'0px'}, 300);
			$(this).parent().siblings().animate({height:'0px'}, 300);

		}
	);
});

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