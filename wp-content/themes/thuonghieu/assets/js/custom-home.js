var _width_device = (window.innerWidth > 0) ? window.innerWidth : screen.width;
var e_why_choose = document.getElementsByClassName("why-choose")[0].getElementsByClassName("list-reasion")[0];
var e_more_detail = e_why_choose.getElementsByClassName("more-detail-mobile");
var e_item = e_why_choose.getElementsByClassName("item");
function closeallitem(){
	for (var i = 0; i < e_item.length; i++) {
		e_item[i].style.height = "50px";
		e_item[i].getElementsByClassName("desc")[0].style.display = "none";
		e_item[i].getElementsByClassName("list")[0].style.display = "none";
	}
}
if(_width_device < 768){
	openclose();
}else{
	closeallitem();
	openclose();
}
function openclose(){
	var e_des_right,e_open_des,open = false;
	for (var i = 0; i < e_more_detail.length; i++) {
		e_more_detail[i].addEventListener("click", function(){
			closeallitem();
			e_des_parent = this.parentElement.parentElement.parentElement;
			e_open_des = e_des_parent.getElementsByClassName("desc")[0];
			e_open_list = e_des_parent.getElementsByClassName("list")[0];
			if(e_open_des.style.display=='none'){
	  			e_open_des.style.display = "block";
	  			e_open_list.style.display = "block";
	  			e_des_parent.style.height = "210px"; 
	  			open = true;
			}else if(e_open_des.style.display==''||e_open_des.style.display=='block'){
				e_open_des.style.display = "none";
				e_open_list.style.display = "none";
	  			e_des_parent.style.height = "50px";
	  			open = false;
			}
		});
	}
}
var e_test_screen = document.getElementsByClassName("test-screen")[0];
//console.log(e_test_screen);
e_test_screen.addEventListener("click",function(){
	alert(_width_device);
});