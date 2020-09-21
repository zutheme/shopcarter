function fn_removeclass(element, name) {
  if(!element || !name) return false;
    var replace = name;
    var re = new RegExp(replace,"g");
    element.className = element.className.replace(re, "");
}
function fn_addclass(element, name) {
 if(!element || !name) return false;
  var arr;
  arr = element.className.split(" ");
  if (arr.indexOf(name) == -1) {
    element.className += " " + name;
  }
}
function hasClass(element, className) {
    return (' ' + element.className + ' ').indexOf(' ' + className+ ' ') > -1;
}
function upload_image(element) {
  var e_frm = element.parentElement;
  var e_download = document.getElementById("download");
  var _dataWidth = document.getElementById("dataWidth").value;
  var _dataHeight = document.getElementById("dataHeight").value;
  var e_image = document.getElementById("image");
  //console.log(_dataHeight,_dataWidth);
  if((_dataWidth > 3000)|| _dataHeight > 3000) {
    alert('allow < 3000px');
    return false;
  }
  var dataURL = e_download.value;
  var http = new XMLHttpRequest();
  var url = htz_config.ajax_url+"?action=htz_image_avatar&security="+htz_config.nonce;
  /*var params = "security="+_security+"&comment_post_ID="+_comment_post_ID;*/
  var params = JSON.stringify({file:dataURL });
  http.open("POST", url, true);
  http.setRequestHeader("Accept", "application/json");
  http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  var load = document.getElementsByClassName("htz-popup-processing")[0];
  var result = e_frm.getElementsByClassName("result")[0];
  load.style.display = "block";
  http.onreadystatechange = function() {
      if(http.readyState == 4 && http.status == 200) {
          var myArr = JSON.parse(this.responseText);
          //console.log(myArr[1]);
          e_image.setAttribute("src", myArr[1]);
          window.location.reload(false); 
          load.style.display = "none";
      }
  }
  http.send(params);
}
// var e_woo_content = document.getElementsByClassName("woocommerce-MyAccount-content")[0];
// if(e_woo_content){
//     fn_addclass(e_woo_content, 'col-12 col-lg-9 mt-4 mt-lg-0');
//     var e_woo_notices_wrapper = e_woo_content.getElementsByClassName("woocommerce-notices-wrapper")[0];
//     e_woo_content.removeChild(e_woo_notices_wrapper);
// }
/*function performClickByClass(element) {
  var eparent = element.parentElement;
  var elem = eparent.getElementsByClassName('file')[0];
   if(elem && document.createEvent) {
      var evt = document.createEvent("MouseEvents");
      evt.initEvent("click", true, false);
      elem.dispatchEvent(evt);
   }
}


function changefile(e){
  var filename = e.target.files[0];
  if(!jscheckfile(filename)){
    return false;
  }
}
function jscheckfile(_file) {
    var validExts = new Array(".jpg", ".png");
    var fileExt = _file.name;
    fileExt = fileExt.substring(fileExt.lastIndexOf('.'));
    if (validExts.indexOf(fileExt) < 0) {
      alert("File không hợp lệ, chỉ chấp nhận loại file " +
               validExts.toString() + " types.");
      return false;
    } else {
      var fs = _file.size;
      if(fs > 5000000){
        alert("dung lượng file không quá 5MB");
        return false;
      }
      return true;
    }
}
jQuery(document).ready(function(){
   $('body').on('change', '#file', function() {
      var e_process = document.getElementsByClassName("htz-popup-processing")[0];
      e_process.style.display = "block";
      var form_data = {};
      $('#file_form').find('input').each(function(){
              form_data[this.name] = $(this).val();
          });
      
      $('#file_form').ajaxForm({
          url: htz_config.ajax_url, 
          data: form_data,
          type: 'POST',
          contentType: 'json',
          success: function(response){
              var myArr = JSON.parse(response);
              console.log(myArr);
              e_process.style.display = "none";
          }
      });
   });
});*/