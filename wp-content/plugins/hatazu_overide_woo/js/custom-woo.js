var e_frm = document.getElementsByClassName('product__options')[0];
console.log(e_frm);
var e_variation = e_frm.hasAttribute("data-product_variations");
if(e_variation){
	var datajson = e_frm.getAttribute("data-product_variations");
	var myArr = JSON.parse(datajson);
	console.log(myArr);
	var e_option = e_frm.getElementsByClassName('product__option');
	;
	for (var i = 0; i < e_option.length; i++) {
		//console.log(myArr[i]['attributes']);
		e_option[i].getElementsByTagName('input').addEventListener("click", function(){
  			console.log(this);
		});
	}
}
