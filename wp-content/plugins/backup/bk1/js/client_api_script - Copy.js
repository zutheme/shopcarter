
function basicAuth(key, secret) {
    let hash = btoa(key + ':' + secret);
    return "Basic " + hash;
}
function filter_product(_lst_filter) {
  var e_htz_popup_processing = document.getElementsByClassName("htz-popup-processing")[0];
  e_htz_popup_processing.style.display = "block";
  const _url_blog = htzwpApi.url_blog;
  let auth = basicAuth(htzwpApi.htzClientKey, htzwpApi.htzClientSecret);
  xhr = new XMLHttpRequest();
  var url = htzwpApi.url_blog + '/wp-json/wc/v3/products?'+_lst_filter;
  xhr.open("GET", url, true);
  xhr.setRequestHeader("Content-type", "application/json");
  xhr.setRequestHeader('Authorization', auth);
  xhr.setRequestHeader( 'X-WP-Nonce', htzwpApi.nonce );
  xhr.onreadystatechange = function () { 
      if (xhr.readyState == 4 && xhr.status == 200) {
          var data = JSON.parse(xhr.responseText);
          render_data(data);
          e_htz_popup_processing.style.display = "none";
      }
  }
  xhr.send();
}

function filter_product_sidebar(){
  var e_shop_layout_sidebar = document.getElementsByClassName("shop-layout__sidebar")[0];
  var _price_min = e_shop_layout_sidebar.getElementsByClassName("filter-price__min-value")[0].innerHTML;
  var _price_max = e_shop_layout_sidebar.getElementsByClassName("filter-price__max-value")[0].innerHTML;
 
  var obj = htzwpApi.arr_attribute;
  var _attribute_name, _attribute_term, _e_pa_attribute, lst_param = '';
  for (const [key, value] of Object.entries(obj)) {
    _attribute_name = 'pa_' + obj[key]['attribute_name'];
     _e_pa_attribute = e_shop_layout_sidebar.getElementsByClassName(_attribute_name);
     if(_e_pa_attribute.length > 0){
        _attribute_term = '';
        for (let j = 0; j < _e_pa_attribute.length; j++) {
          if(_e_pa_attribute[j].checked){
            _attribute_term += _e_pa_attribute[j].value + ',';
          }
        }
        _attribute_term = _attribute_term.replace(/,\s*$/, "");
        if(_attribute_term){
          lst_param += '&attribute='+_attribute_name+'&attribute_term='+_attribute_term;
        } 
    }
  }
  var list_filter = lst_param+'&min_price='+_price_min+'&max_price='+_price_max+'&per_page=50';
  console.log(list_filter);
  filter_product(list_filter);
  /*attribute=pa_brand&attribute_term=49,50&min_price=_price_min&max_price=_price_max*/
}

var e_shop_layout_content = document.getElementsByClassName("shop-layout__content")[0];
var e_products_view__list = e_shop_layout_content.getElementsByClassName("products-view__list")[0];
var e_products_list_body = e_products_view__list.getElementsByClassName("products-list__body")[0];
function render_data(data){
console.log(data);
var count_page = data.length;
var _html = '';
 for (const [key, value] of Object.entries(data)){
    console.log(key);
 _html += ' <div class="products-list__item">';
_html += '      <div class="product-card product-card--hidden-actions ">';
_html += '          <button class="product-card__quickview" type="button">';
_html += '              <svg width="16px" height="16px">';
_html += '                  <use xlink:href="'+ htzwpApi.tmp_dir +'/images/sprite.svg#quickview-16"></use>';
_html += '              </svg>';
_html += '              <span class="fake-svg-icon"></span>';
_html += '          </button>';
_html += '          <div class="product-card__badges-list">';
                      if(data[key]['on_sale']){
_html += '              <div class="product-card__badge product-card__badge--new">Sale</div>';
                      }
_html += '          </div>';
_html += '          <div class="product-card__image product-image">';
_html += '              <a href="'+data[key]['permalink']+'" class="product-image__body">';
_html += '                  <img class="product-image__img" src="'+data[key]['images'][0]['src']+'" alt="">';
_html += '              </a>';
_html += '          </div>';
_html += '          <div class="product-card__info">';
_html += '              <div class="product-card__name">';
_html += '                  <a href="'+data[key]['permalink']+'">'+data[key]['name']+'</a>';
_html += '              </div>';
_html += '              <div class="product-card__rating">';
_html += '                  <div class="product-card__rating-stars">';
_html += '                      <div class="rating">';
_html += '                          <div class="rating__body">';
                                      for (var i = 0; i < 5; i++) {
                                            if(i < data[key]['average_rating']){
                                            _html += '<svg class="rating__star rating__star--active" width="13px" height="12px">';
                                            _html += '  <g class="rating__fill">';
                                            _html += '      <use xlink:href="'+_tmp_dir+'/images/sprite.svg#star-normal"></use>';
                                            _html += '  </g>';
                                            _html += '  <g class="rating__stroke">';
                                            _html += '      <use xlink:href="'+_tmp_dir+'/images/sprite.svg#star-normal-stroke"></use>';
                                            _html += '  </g>';
                                            _html += '</svg>';
                                            _html += '<div class="rating__star rating__star--only-edge rating__star--active">';
                                            _html += '  <div class="rating__fill">';
                                            _html += '      <div class="fake-svg-icon"></div>';
                                            _html += '  </div>';
                                            _html += '  <div class="rating__stroke">';
                                            _html += '      <div class="fake-svg-icon"></div>';
                                            _html += '  </div>';
                                            _html += '</div>';
                                            }else{
                                            _html += '<svg class="rating__star" width="13px" height="12px">';
                                            _html += '  <g class="rating__fill">';
                                            _html += '      <use xlink:href="'+_tmp_dir+'/images/sprite.svg#star-normal"></use>';
                                            _html += '  </g>';
                                            _html += '  <g class="rating__stroke">';
                                            _html += '      <use xlink:href="'+_tmp_dir+'/images/sprite.svg#star-normal-stroke"></use>';
                                            _html += '  </g>';
                                            _html += '</svg>';
                                            _html += '<div class="rating__star rating__star--only-edge">';
                                            _html += '  <div class="rating__fill">';
                                            _html += '      <div class="fake-svg-icon"></div>';
                                            _html += '  </div>';
                                            _html += '  <div class="rating__stroke">';
                                            _html += '      <div class="fake-svg-icon"></div>';
                                            _html += '  </div>';
                                            _html += '</div>';
                                            }       
                                        }              
_html += '                          </div>';
_html += '                      </div>';
_html += '                  </div>';
_html += '                  <div class="product-card__rating-legend">'+ data[key]['rating_count'] +' Reviews</div>';
_html += '              </div>';
_html += '              <ul class="product-card__features-list">';
                      var obj_attribute = data[key]['attributes'];
                      for (const [key1, value1] of Object.entries(obj_attribute)){
                            _html += '<li>'+obj_attribute[key1]['name']+': '+ obj_attribute[key1]['options'] +'</li>';
                        }
_html += '              </ul>';
_html += '          </div>';
_html += '          <div class="product-card__actions">';
_html += '              <div class="product-card__availability">';
_html += '                  Availability: <span class="text-success">In Stock</span>';
_html += '              </div>';
_html += '              <div class="product-card__prices">';
_html += '                  '+data[key]['price_html'];
_html += '              </div>';

_html += '              <div class="product-card__buttons">';
_html += '                  <button type="button" onclick="add_product_ajax(this);" class="btn btn-primary product-card__addtocart" data-quantity="1" data-product_id="'+data[key]['id']+'" data-product_sku="">Add To Cart</button>';
_html += '                  <button type="button" onclick="add_product_ajax(this);" class="btn btn-secondary product-card__addtocart product-card__addtocart--list" data-quantity="1" data-product_id="'+data[key]['id']+'" data-product_sku="">Add To Cart</a>';
_html += '                  <button class="btn btn-light btn-svg-icon btn-svg-icon--fake-svg product-card__wishlist" type="button">';
_html += '                      <svg width="16px" height="16px">';
_html += '                          <use xlink:href="'+ htzwpApi.tmp_dir +'/images/sprite.svg#wishlist-16"></use>';
_html += '                      </svg>';
_html += '                      <span class="fake-svg-icon fake-svg-icon--wishlist-16"></span>';
_html += '                  </button>';
_html += '                  <button class="btn btn-light btn-svg-icon btn-svg-icon--fake-svg product-card__compare" type="button">';
_html += '                      <svg width="16px" height="16px">';
_html += '                          <use xlink:href="'+ htzwpApi.tmp_dir +'/images/sprite.svg#compare-16"></use>';
_html += '                      </svg>';
_html += '                      <span class="fake-svg-icon fake-svg-icon--compare-16"></span>';
_html += '                  </button>';
_html += '              </div>';
_html += '          </div>';
_html += '      </div>';
_html += '  </div>';
 }
 e_products_list_body.innerHTML = '';
 e_products_list_body.innerHTML = _html;
}
function add_product_ajax(element) {
  var _product_id = element.getAttribute("data-product_id");
  var _quantity = element.getAttribute("data-quantity");
  var _variation_id = 0;
  var e_htz_popup_processing = document.getElementsByClassName("htz-popup-processing")[0];
  var e_dropcart__body = document.getElementsByClassName("dropcart__body")[0];
  var e_nav_panel_indicators = document.getElementsByClassName("nav-panel__indicators")[0];
  var e_indicator__value = e_nav_panel_indicators.getElementsByClassName("item-cart")[0];
  e_htz_popup_processing.style.display = "block";
  const _url_blog = htzwpApi.url_blog;
  var _security = htzwpApi.nonce;
  xhr = new XMLHttpRequest();
  var url = htzwpApi.ajax_url+"?action=woocommerce_ajax_add_to_cart";
  var params = 'security='+_security+'&product_id='+_product_id+'&quantity='+_quantity+'&variation_id='+_variation_id;
  xhr.open("POST", url, true);
  xhr.setRequestHeader("Accept", "application/json");
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () { 
      if (xhr.readyState == 4 && xhr.status == 200) {
          var data = JSON.parse(xhr.responseText);
          console.log(data['fragments']['itemcart']);
          e_indicator__value.innerHTML = '';
          e_indicator__value.innerHTML = data['fragments']['itemcart'];
          e_dropcart__body.innerHTML = '';
          e_dropcart__body.innerHTML = data['fragments']['div.widget_shopping_cart_content'];
            
          e_htz_popup_processing.style.display = "none";
      }
  }
  xhr.send(params);
}
/*reach page*/
function countpage(_distant, obj){
  var count_item = obj.length;
  var quotient = Math.floor(count_item /_distant);
  var remainder = count_item % _distant;
  if(remainder > 0) {
    quotient = quotient + 1;
  }
  return quotient;
}
function reachpages(i,_distant){
  var maxpage = countpage(9,obj);
  if(  0 < i && i < maxpage ) {
    _lst_page = '',_result = '';
    for (var j = (i-1)*_distant; j < (i*_distant); j++) {
          //_lst_page += obj[j].page + ',';
      }
  }else if(i = maxpage){
    for (var t = (i-1)*_distant; t < obj.length; t++) {
          //_lst_page += obj[t].page + ',';
      }
  }
}