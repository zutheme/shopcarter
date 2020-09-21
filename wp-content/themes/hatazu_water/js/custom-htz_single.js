var e_departments = document.getElementsByClassName('departments')[0];
fn_removeclass(e_departments, 'departments--open departments--fixed');
var e_btn_expender = document.getElementsByClassName('widget-categories__expander');
if(e_btn_expender){
	var open = false;
	for (var i = 0; i < e_btn_expender.length; i++) {
		e_btn_expender[i].addEventListener("click", function(){
		var e_li = this.parentElement.parentElement;
			if(!open){
				fn_addclass(e_li,'widget-categories__item--open');
				open = true;
			}else{
				fn_removeclass(e_li,'widget-categories__item--open');
				open = false;
			}
		});
	}
}
