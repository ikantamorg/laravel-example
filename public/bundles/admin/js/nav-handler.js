$(function () {

	var $mainNav = $('#main-nav'),
		$navHeaders = $mainNav.find('li.nav-header')
	;

	var findNavList = function ($header) {
		return $header.next();
	};

	var toggleNavList = function ($header, $navList) {
		if($header.hasClass('selected'))
			return hideList($header, $navList);
		
		var $curHeader = $(_.chain($navHeaders).find(function (header) {
			return $(header).hasClass('selected');
		}).value());
		var $curNavList = findNavList($curHeader);
		
		hideList($curHeader, $curNavList);
		showList($header, $navList);
	};

	var showList = function ($header, $navList) {
		$header.addClass('selected');
		$navList.slideDown();
	};

	var hideList = function ($header, $navList) {
		$header.removeClass('selected');
		$navList.slideUp();
	};

	_.chain($navHeaders).each(function (header) {
		var $header = $(header);
		var $navList = $header.next();
		
		if($header.hasClass('active') )
			$navList.show();
		
		$header.click(function (ev) {
			toggleNavList($header, $navList);
		});
	});

});