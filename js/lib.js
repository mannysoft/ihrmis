
function adminOpenMenu(obj_li_to_open, css_open_class) {

	obj_li_to_open.className = css_open_class;
}

function adminCloseMenu(obj_li_to_close, css_close_class) {
	
	obj_li_to_close.className = css_close_class;
}

function switchToDrowpdown(id_menu, id_menu_2, css_menu_dropdown_class) {
	
	var prev_fun = window.onload;
	if(prev_fun != undefined) {
		
		window.onload = function() {
			prev_fun();
			var obj_menu = document.getElementById(id_menu);
			if(obj_menu) obj_menu.className = css_menu_dropdown_class;
			
			obj_menu = document.getElementById(id_menu_2);
			if(obj_menu) obj_menu.className = css_menu_dropdown_class;
		}
	} else {
		
		window.onload = function () {
		
			var obj_menu = document.getElementById(id_menu);
			if(obj_menu) obj_menu.className = css_menu_dropdown_class;
			
			obj_menu = document.getElementById(id_menu_2);
			if(obj_menu) obj_menu.className = css_menu_dropdown_class;
		}
	}		
}
/*
function set_dropdown_menu(main_menu, css_menu_open, css_menu_close) {

	var ul_list = document.getElementById(main_menu);
	ul_list..onmouseover = "adminOpenMenu("+ul_list.", '"+css_menu_open+"')";
	ul_list..onfocus = "adminOpenMenu(ul_list., css_menu_open)";
	ul_list..onmouseout = "adminCloseMenu(ul_list., css_menu_close)";
	ul_list..onblur = "adminCloseMenu(ul_list., css_menu_close)";

}
*/