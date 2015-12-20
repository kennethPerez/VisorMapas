var panimage1; // register arbitrary variable
jQuery(function($){
	panimage1 = new imagepanner({
		wrapper: $('#pcontainer1'), // jQuery selector to image container
		imgpos: [100, 300], // initial image position- x, y
		maxlevel: 4 // maximum zoom level
	})
})