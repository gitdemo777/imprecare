function Navmagicline() {

	var $el, leftPos, newWidth,
		$mainNav = $("#top-menu");
	$("#magic-line").remove();
	$mainNav.append("<li id='magic-line'></li>");
	var $magicLine = $("#magic-line");
	
	$magicLine
		.width($("#top-menu .active").width())
		.height($("#top-menu .active").height())
		.css("left", $("#top-menu .active a").position().left)
		.data("origLeft", $magicLine.position().left)
		.data("origWidth", $magicLine.width());
		
	$("#top-menu li a").hover(function() {
		$el = $(this);
		leftPos = $el.position().left;
		newWidth = $el.parent().width();
		$magicLine.stop().animate({
			left: leftPos,
			width: newWidth
		});
	}, function() {
		$magicLine.stop().animate({
			left: $magicLine.data("origLeft"),
			width: $magicLine.data("origWidth")
		});    
	});
}



function Tabmagicline() {
	var $el, leftPos, newWidth,
		$mainNav = $("#fetured-nav");
	$("#magic-line2").remove();
	$mainNav.append("<li id='magic-line2'></li>");
	var $magicLineq = $("#magic-line2");
	
	$magicLineq
		.width($("#fetured-nav .current-iem").width())
		.height($("#fetured-nav .current-iem").height())
		.css("left", $(".current-iem a").position().left)
		.data("origLeft", $magicLineq.position().left)
		.data("origWidth", $magicLineq.width());
		
	$("#fetured-nav li a").hover(function() {
		$el = $(this);
		leftPos = $el.position().left;
		newWidth = $el.parent().width();
		$magicLineq.stop().animate({
			left: leftPos,
			width: newWidth
		});
	}, function() {
		$magicLineq.stop().animate({
			left: $magicLineq.data("origLeft"),
			width: $magicLineq.data("origWidth")
		});    
	});
}

