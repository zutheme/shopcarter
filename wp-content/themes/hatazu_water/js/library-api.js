function create_element_variproduct(_product_id) {
  var e_input_radio_label = document.getElementsByClassName('input-radio-label')[0];
  if(e_input_radio_label){
    var e_label_radio = e_input_radio_label.getElementsByTagName('label');
    for (var i = 0; i < e_label_radio.length; i++) {
      e_label_radio[i].getElementsByTagName('input')[0].addEventListener("click", function(){
        get_variations_by_id(_product_id,this.getAttribute("id_variation"))
      });
    }
  }
}
function get_variations_by_id(_product_id,_idvariation) {
  var e_htz_popup_processing = document.getElementsByClassName("htz-popup-processing")[0];
  var e_product__prices = document.getElementsByClassName("product__prices")[0];
  e_htz_popup_processing.style.display = "block";
  var e_product_image_gal = document.getElementsByClassName("product-image--location--gallery")[0];
  var e_ahref_gal = e_product_image_gal.getElementsByTagName("a")[0];
  var e_product_image__img = e_product_image_gal.getElementsByClassName("product-image__img")[0];
  var _url_blog = wpApiSettings.url_blog;
  let auth = basicAuth(wooClientKey, wooClientSecret);
  xhr = new XMLHttpRequest();
  var url = _url_blog + '/wp-json/wc/v3/products/' + _product_id + '/variations/'+_idvariation;
  //var url = 'http://localhost/water1/wp-json/wc/v3/products/16/variations';
  xhr.open("GET", url, true);
  xhr.setRequestHeader("Content-type", "application/json");
  xhr.setRequestHeader('Authorization', auth);
  xhr.setRequestHeader( 'X-WP-Nonce', wpApiSettings.nonce );
  xhr.onreadystatechange = function () { 
      if (xhr.readyState == 4 && xhr.status == 200) {
          var data = JSON.parse(xhr.responseText);
          e_ahref_gal.setAttribute("href", data['image']['src']);
          e_product_image__img.setAttribute("src", data['image']['src']);
          e_product__prices.innerHTML = '<span class="woocommerce-Price-currencySymbol">₫</span>'+data['price']+'</span>';
          /*console.log(data);*/
          e_htz_popup_processing.style.display = "none";
      }
  }
  xhr.send();
}
function curent_time() {
  var today = new Date();
  var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
  var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
  var dateTime = date+' '+time;
  return dateTime;
}
/**/
var e_ul_account_menu__links1 = document.getElementsByClassName("account-menu__links")[0];
var e_ul_account_menu__links2 = document.getElementsByClassName("account-menu__links")[1];
if(e_ul_account_menu__links2) {
  var x = e_ul_account_menu__links1.lastElementChild;
  e_ul_account_menu__links2.appendChild(x);
}

