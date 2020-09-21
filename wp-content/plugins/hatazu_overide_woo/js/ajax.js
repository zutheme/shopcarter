var e_btn_register = document.getElementsByClassName('btn-register');
if (typeof(e_btn_register) != 'undefined' && e_btn_register != null){
  for (var i = 0; i < e_btn_register.length; i++) {
    e_btn_register[i].addEventListener("click",regform);
  }
}

var e_consultant = document.getElementsByClassName("consultant");
for (var i = 0; i < e_consultant.length; i++) {
	e_consultant[i].addEventListener("click", function(){
	  send_contact();
	});
}
function send_contact(){
	e_modal_consult.style.display = "block";
}
function find_form(element){
  //var eparent = element.parentElement;
  var eparent = element;
  var frm = eparent.getElementsByTagName("form")[0];
  while(!frm){
    eparent = eparent.parentElement;
    frm = eparent.getElementsByTagName("form")[0];
  }
  //setTimeout(function(){ return frm; },10000);
  return frm;
}

var e_modal_consultant_form = document.getElementsByClassName("modal-consultant-form")[0];
var e_modal_consult = e_modal_consultant_form.getElementsByClassName("modal-consult")[0];
var e_close = e_modal_consultant_form.getElementsByClassName("close")[0];
e_close.addEventListener("click", function(){
	  e_modal_consult.style.display = "none";
	});
var e_htz_popup_processing = document.getElementsByClassName("htz-popup-processing")[0];

function regform(){
	if(!e_btn_register) return false;
	findform(this,sendmessage);
}
function sendmessage(e_frm){
	if(!e_frm) { return false; }
	var e_popup_processing = document.getElementsByClassName('htz-popup-processing')[0];
	var eloading = e_popup_processing.getElementsByClassName('loading')[0];
	var e_processing = e_popup_processing.getElementsByClassName('processing')[0];
	var e_result = e_popup_processing.getElementsByClassName('result')[0];
	eloading.style.display = "block";
	var e_name = e_frm.getElementsByClassName("your-name")[0];
	var e_phone = e_frm.getElementsByClassName("your-phone")[0];
	var e_email = e_frm.getElementsByClassName("your-email")[0];
	var e_address = e_frm.getElementsByClassName("your-address")[0];
	var e_message = e_frm.getElementsByClassName("your-message")[0];
	var _name = e_name.value;
	var _phone = e_phone.value;
	var _email = e_email.value;
	var _address = e_address.value;
	var _message = e_message.value;
	if(!_name) {
		alert('Vui lòng nhập họ tên');
		return false;
	}
	if(!_phone) {
		alert('Vui lòng nhập số điện thoại');
		return false;
	}
	var http = new XMLHttpRequest();
	var url = MyAjax.ajaxurl+'?action=send_contact';
	var params = JSON.stringify({name:_name, phone:_phone,email:_email,address:_address,message:_message});
	
	http.open("POST", url, true);
	//Send the proper header information along with the request
	/*http.setRequestHeader("Content-Type", "application/json");*/ 
	e_htz_popup_processing.style.display = "block";
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	http.onreadystatechange = function() {
	      if(http.readyState == 4 && http.status == 200) {
	           var myArr = JSON.parse(this.responseText);
	           eloading.style.display = "none";
	           e_modal_consult.style.display = "none"; 
	           e_processing.style.backgroundColor = "rgba(1,65,109,1)";    
	           Object.keys(myArr).forEach(function(key) {      
	            if(key=='success'){
	               e_result.innerHTML = myArr.result;  
	                setTimeout(function(){
	                e_htz_popup_processing.style.display = "none";
	                  e_result.innerHTML = "";
	                },6000);       
	            }else if(key=='error'){
	              e_result.innerHTML = myArr.error;
	            }
	          });     
	      }
	  }
	  http.send(params);
}
function findform(element,callback){
  //var eparent = element.parentElement;
  var eparent = element;
  var countdown = 10;
  //console.log(eparent);
  var frm = eparent.getElementsByTagName("form")[0];
  if(!frm){
  	var x = setInterval(function() {
	  	eparent = eparent.parentElement;
		frm = eparent.getElementsByTagName("form")[0];
	  	if(frm){
	  		clearInterval(x);
	  		callback(frm);
	  	 	return frm;
	  	}
	  	countdown = countdown - 1;
	      if (countdown < 0) {
	      	clearInterval(x);
	      	callback(frm);
	      }  
	  }, 10);
  }else{
  	callback(frm);
  }
}


var tooggle = false;

var _e_panel_quick = document.getElementById("box-link");



window.addEventListener("scroll", quicklink,false);

var _e_quick_link = document.getElementById("box-link");

 //console.log(_e_quick_link);

function quicklink(){ 

   var top = window.pageYOffset; 

        //var top = document.documentElement.scrollTop;     

   if(top > 100){        
          _e_quick_link.style.display = "block";
          _e_quick_link.style.position = "fixed";
           _e_quick_link.style.right = "0px";
            _e_quick_link.style.top = "30%";

        }else{       

             _e_quick_link.style.display = "none";

        }

}