// function fn_addclass(element, name) {
//  if(!element || !name) return false;
//   var arr;
//   arr = element.className.split(" ");
//   if (arr.indexOf(name) == -1) {
//     element.className += " " + name;
//   }
// }
// function fn_removeclass(element, name) {
// 	if(!element || !name) return false;
//    	var replace = name;
// 	var re = new RegExp(replace,"g");
//   	element.className = element.className.replace(re, "");
// }
var e_payment_methods__list = document.getElementsByClassName('payment-methods__list')[0];
var e_radio_input = e_payment_methods__list.getElementsByClassName("input-radio__input");

for (var i = 0; i < e_radio_input.length; i++) {
	e_radio_input[i].addEventListener("click", function(){
		RemoveAllClassActive();
		var e_parent = this.parentElement.parentElement.parentElement.parentElement;
	  	fn_addclass(e_parent, 'payment-methods__item--active');
	  	e_parent.getElementsByClassName('payment-methods__item-container')[0].style.display = 'block';
	});
}
function RemoveAllClassActive(){
	var elist_active = e_payment_methods__list.getElementsByClassName('payment-methods__item--active')[0];
	if(elist_active){
		fn_removeclass(elist_active, 'payment-methods__item--active');
		elist_active.getElementsByClassName('payment-methods__item-container')[0].style.display = 'none';
	}
}
//var e_woo_notices_wrap = document.getElementsByClassName('woocommerce-notices-wrapper')[0];
//e_woo_notices_wrap.style.display = 'none';
var e_checkout = document.getElementsByClassName('checkout')[0];
var e_woocommerce_form_login = e_checkout.getElementsByClassName('checkout-login')[0];
var e_showlogin = e_checkout.getElementsByClassName('showlogin')[0];
if(e_showlogin){
	var toogle = false;
	e_showlogin.addEventListener("click",function(){
		if(toogle){
			e_woocommerce_form_login.style.display = 'none';
			toogle = false;
		}else{
			e_woocommerce_form_login.style.display = 'block';
			toogle = true;
		}
	});
}

// var e_close = document.getElementsByClassName('close')[0];
// e_close.addEventListener("click",function(){
// 	e_woocommerce_form_login.style.display = 'none';
// });
