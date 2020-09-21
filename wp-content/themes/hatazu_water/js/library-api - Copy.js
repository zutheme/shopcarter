
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
  //var e_prices = e_product__prices.getElementsByClassName("woocommerce-Price-amount")[0];
  //console.log(e_prices);
  e_htz_popup_processing.style.display = "block";
  var e_product_image_gal = document.getElementsByClassName("product-image--location--gallery")[0];
  var e_ahref_gal = e_product_image_gal.getElementsByTagName("a")[0];
  var e_product_image__img = e_product_image_gal.getElementsByClassName("product-image__img")[0];
  const _url_blog = wpApiSettings.url_blog;
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
          console.log(data);
          e_htz_popup_processing.style.display = "none";
      }
  }
  //var data = JSON.stringify({"email":"tomb@raider.com","name":"LaraCroft"});
  xhr.send();
}
function curent_time() {
  var today = new Date();
  var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
  var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
  var dateTime = date+' '+time;
  return dateTime;
}
/*function get_variations(argument) {
  /wp-json/wc/v3/products/<product_id>/variations
}*/
/*var wooClientKey = 'ck_4884cc4eaa8d315117e3990bcf8c213e0a8a821a';
var wooClientSecret = 'cs_89f9a54eebf5885bceb89289aa912c382be4c488';
var wooUrl = 'http://localhost/water1/wp-json/wc/v3/products/22';

function basicAuth(key, secret) {
    let hash = btoa(key + ':' + secret);
    return "Basic " + hash;
}

let auth = basicAuth(wooClientKey, wooClientSecret);
  function getData(url) {
      jQuery.ajax({
          url: url,
          method: 'GET',
          beforeSend: function (req) {
              req.setRequestHeader('Authorization', auth);
          }
      })
          .done(function (data) {
              console.log(data);
              return data;
          });
  }

getData(wooUrl);
xhr = new XMLHttpRequest();
var url = "url";
xhr.open("POST", url, true);
xhr.setRequestHeader("Content-type", "application/json");
xhr.onreadystatechange = function () { 
    if (xhr.readyState == 4 && xhr.status == 200) {
        var json = JSON.parse(xhr.responseText);
        console.log(json.email + ", " + json.name)
    }
}
var data = JSON.stringify({"email":"tomb@raider.com","name":"LaraCroft"});
xhr.send(data);*/