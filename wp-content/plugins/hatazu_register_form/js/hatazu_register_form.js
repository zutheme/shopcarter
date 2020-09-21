function upload_image() {
  var e_frm = element.parentElement.parentElement.parentElement;
  var _e_security = e_frm.getElementsByClassName("my-special-string")[0];
  var _cmt_content = _e_cmt_content.value;
 
  var http = new XMLHttpRequest();
  var url = ajax_object.ajax_url+"?action=file_upload";
  /*var params = "security="+_security+"&comment_post_ID="+_comment_post_ID;*/
  var params = JSON.stringify({file:gbdataURL });
  http.open("POST", url, true);
  //http.setRequestHeader("X-CSRF-TOKEN", _csrf_token);
  http.setRequestHeader("Accept", "application/json");
  http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  var load = e_frm.getElementsByClassName("loading")[0];
  var result = e_frm.getElementsByClassName("result")[0];
  load.style.display = "block";
  http.onreadystatechange = function() {
      if(http.readyState == 4 && http.status == 200) {
          var myArr = JSON.parse(this.responseText);
          console.log(myArr);
          //load.style.display = "none";
      }
  }
  http.send(params);
}
