function Source() {
	this.shown = null;
	this.hide = function(animate) {
			$("#hide_source_toggle a").html('Show source code');

			if (animate)
				$("div.source_box").fadeOut();
			else
				$("div.source_box").hide();

			this.shown = false;
	}

	this.show = function(animate) {
			$("#hide_source_toggle a").html('Hide source code');

			if (animate)
				$("div.source_box").slideDown('slow');
			else
				$("div.source_box").show();

			this.shown = true;
	}

	this.toggle = function() {
		if (this.shown)
			this.hide(true);
		else
			this.show(true);
	}
}
source = new Source();

function askDbResetConfirm() {
	return confirm('Do you want to continue? This will reset your database to factory defaults.');
}


function loadMoreInfo() {
	return $('#more_info_content').html();
}


jQuery(document).ready(function() {
	jQuery("#hide_source_toggle a").click(function(event) {
		event.preventDefault();
		source.toggle();
	});


	$('#more_topic_info_link').popover({
		placement: 'bottom',
		title: 'More information',
		content: loadMoreInfo
	});
});