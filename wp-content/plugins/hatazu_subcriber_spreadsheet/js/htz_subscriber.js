function validateEmail(email) {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}
var countfind = 10;
var exist_e_newsletter_form = setInterval(function() {
  var e_widget_newsletter__form = document.getElementsByClassName("widget-newsletter__form")[0];
   	  if(e_widget_newsletter__form) {
          callbtn(e_widget_newsletter__form);
          clearInterval(exist_e_newsletter_form);
      }else if(countfind > 0){
      	/*console.log(countfind);*/
      	 countfind = countfind -1;
      }else{
      	clearInterval(exist_e_newsletter_form);
      }  
   }, 100);
function callbtn(e_widget_newsletter__form){
	if(e_widget_newsletter__form){
		var _email = e_widget_newsletter__form.getElementsByClassName("email")[0];
		var _btn_subscriber = e_widget_newsletter__form.getElementsByClassName("btn-subscriber")[0];
		_btn_subscriber.addEventListener("click", function(){
			if(validateEmail(_email.value)){
				addcontactmailchimp(e_widget_newsletter__form,_email.value)
			}else{
				alert('invalid email');
				return false;
			}
		});
	}
}
function addcontactmailchimp(e_widget_newsletter__form,_email){
  var e_htz_popup_processing = document.getElementsByClassName("loading")[0];
  var e_htz_message = document.getElementsByClassName("message")[0];
  e_htz_popup_processing.style.display = "block";
  var _security = htz_config.nonce;
  var xhr = new XMLHttpRequest();
  var url = htz_config.ajax_url+"?action=send_mail_on_new_post";
  var params = 'security='+_security+'&email='+_email;
  xhr.open("POST", url, true);
  xhr.setRequestHeader("Accept", "application/json");
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () { 
      if (xhr.readyState == 4 && xhr.status == 200) {
          var data = JSON.parse(xhr.responseText);
          console.log(data);
          if(data===200){
          	e_htz_message.innerHTML = 'Thank You For Subscribing!';
          }else{
          	e_htz_message.innerHTML = 'Please try again';
          }
          e_htz_popup_processing.style.display = "none";
          setTimeout(function(){
          	e_widget_newsletter__form.getElementsByClassName("email")[0].value = '';
          	e_htz_message.innerHTML = '';
          },6000);
      }
  }
  xhr.send(params);
}
