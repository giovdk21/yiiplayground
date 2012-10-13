
function RightMenu() {
	this.shown = true;

	this.hide = function(anim) {
		if (anim) {
			if (wait_anim) return;
			wait_anim =true;
			$("div.right_menu").fadeTo("slow", 0.4);
			$("div.right_menu").animate({
				right: "-160px"				
			}, {
				duration: 600,
				complete: function () { wait_anim =false; }
			});			
		}
		else {
			$("div.right_menu").css('opacity', 0.4);
			$("div.right_menu").css('right', '-160px');
		}
	}

	this.show = function(anim) {
		if (anim) {
			if (wait_anim) return;
			wait_anim =true;
			$("div.right_menu").animate({
				right: "0px"
			}, {
				duration: 100,
				complete: function () { wait_anim =false; }
			});
			$("div.right_menu").fadeTo("slow", 1);
		}
		else {
			$("div.right_menu").css('opacity', 1);
			$("div.right_menu").css('right', '0px');
		}
	}

	this.toggle = function() {		
		if (this.shown)
			this.hide(true);
		else
			this.show(true);
		this.shown = !this.shown;
	}

	this.setStartStatus = function(start_val) {
		this.setToggleLink(start_val);
		if (start_val) {
			this.show(false);
		} else {
			this.hide(false);
		}		
		this.shown =start_val;
	}

	this.setToggleLink = function(status) {
		$("#toggle_right_menu").text(!status ? '<<' : '>>');
		$("#toggle_right_menu").attr('title', !status ? 'Pin' : 'Hide');
	}

	this.selectItem = function(item) {
		$(item).closest('ul').children('li.selected').removeClass('selected');
		$(item).parent('li').toggleClass('selected');
	}

	this.init = function(obj) {
		jQuery("#toggle_right_menu").click(function(event) {
			event.preventDefault();
			obj.setToggleLink(!obj.shown);
			obj.toggle();
		});
		jQuery("div.right_menu").mouseenter(function(event) {
			if (obj.shown) return;
			obj.show(true);
		});
		jQuery("div.right_menu").mouseleave(function(event) {
			if (obj.shown) return; 			
			obj.hide(true);
		});
		jQuery("div.right_menu ul li a").click(function(event) {
			obj.selectItem(this);
		});
	}
}

var wait_anim =false;
var right_menu = new RightMenu();

jQuery(document).ready(function() {
	right_menu.init(right_menu);
});