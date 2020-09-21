let data;
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
          data = JSON.parse(xhr.responseText);
          render_data(data,1,9);
          quick_nav(9);
          _quickview();
          e_htz_popup_processing.style.display = "none";
      }
  }
  xhr.send();
}
var e_btn_filter = document.getElementsByClassName("btn-filter")[0];
e_btn_filter.addEventListener("click",function(){
  filter_product_sidebar();
});
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
  filter_product(list_filter);
  /*attribute=pa_brand&attribute_term=49,50&min_price=_price_min&max_price=_price_max*/
}

var e_shop_layout_content = document.getElementsByClassName("shop-layout__content")[0];
var e_products_view__list = e_shop_layout_content.getElementsByClassName("products-view__list")[0];
var e_products_list_body = e_products_view__list.getElementsByClassName("products-list__body")[0];
function create_list_pages( _maxpage, _i, _distant ){
  var e_products_view_pagination= document.getElementsByClassName("products-view__pagination")[0];
  var arr_result = distant_active(_distant,_i,_maxpage);
  var len_arr = arr_result.length;
  if(len_arr > 1){
      var e_ul = '<ul class="page-numbers pagination justify-content-center">';
      for (var k = 0; k < len_arr; k++) {
        var next = arr_result[k] + 1;
        var prev = arr_result[k] - 1;
        if(prev > 0 && k===0){
           e_ul += '<li class="page-item">';
           e_ul += ' <a class="quick-nav page-link page-link--with-arrow" href="javascript:void(0) aria-label="Previous" numpage='+prev+'>';
           e_ul += '       <svg class="page-link__arrow page-link__arrow--left" aria-hidden="true" width="8px" height="13px">';
           e_ul += '           <use xlink:href="'+htzwpApi.tmp_dir+'/images/sprite.svg#arrow-rounded-left-8x13"></use>';
           e_ul += '       </svg>';
           e_ul += '    </a>';
           e_ul += '</li>';
        }
        if(arr_result[k]===_i){
          e_ul += '<li class="page-item active"><a class="quick-nav page-link curent" numpage='+arr_result[k]+' href="javascript:void(0)">' + arr_result[k] + '</a></li>';
        }else{
          e_ul += '<li class="page-item"><a class="quick-nav page-link" numpage='+arr_result[k]+' href="javascript:void(0)">' + arr_result[k] + '</a></li>';
        }
        //console.log(next,_maxpage,k,(len_arr - 1));
        if(next < (_maxpage + 1) && k === (len_arr - 1)){
          e_ul += '<li class="page-item"><a class="quick-nav page-link--with-arrow" href="javascript:void(0)" aria-label="Next" numpage='+next+'>';
          e_ul += '<svg class="page-link__arrow page-link__arrow--right" aria-hidden="true" width="8px" height="13px">';
          e_ul += '<use xlink:href="'+htzwpApi.tmp_dir+'/images/sprite.svg#arrow-rounded-right-8x13"></use></svg></a></li>';
        }
      }
     e_ul +='</ul>';
     e_products_view_pagination.innerHTML = '';
     e_products_view_pagination.innerHTML = e_ul;
  }else{
    if(e_products_view_pagination){
      e_products_view_pagination.innerHTML ='';
    }
    
  }
}
function quick_nav(_distant){
  var e_quick_nav = document.getElementsByClassName("quick-nav");
  var _maxpage = countpage(_distant, data);
  if(e_quick_nav){
    for (var i = 0; i < e_quick_nav.length; i++) {
        e_quick_nav[i].addEventListener("click", function(){
              rm_active();
              fn_addclass(this, 'curent');
              fn_addclass(this.parentElement, 'active');
              var _cur_pos = parseInt(this.getAttribute('numpage'));
              distant_active(_distant,_cur_pos,_maxpage);
              render_data(data,_cur_pos,_distant);
              quick_nav(_distant);
              _quickview();
        });
    }
  } 
}
function distant_active(_distant,_cur_pos,_maxpage){
  var e_quick_nav= document.getElementsByClassName("quick-nav");
  var mid_dist =  Math.floor(_distant / 2);
  var arr_result = [];
  /*right to left*/
  var min = _cur_pos - mid_dist;
  var max = _cur_pos + mid_dist;
  if(min < 1) {
    min = 1;
    max = _distant;
  }
  if(max > _maxpage){
    max = _maxpage;
    min = (_maxpage - _distant)+1;
    if(min < 1) {
      min = 1;
    }
  }
  for (var i = min; i < (max+1); i++) {
     arr_result.push(i);
  }
  return arr_result;
}
function rm_active(){
  var e_quick_nav= document.getElementsByClassName("quick-nav");
  if(e_quick_nav){
    for (var j = 0; j < e_quick_nav.length; j++) {
          if(hasClass(e_quick_nav[j], 'curent')){
              fn_removeclass(e_quick_nav[j], 'curent');
              var e_parent = e_quick_nav[j].parentElement;
              fn_removeclass(e_parent, 'active');
          }
    }
  } 
}
function render_data(data,i,_distant){
  var maxpage = countpage(_distant,data);
  create_list_pages(maxpage,i,_distant);
  var _html = '', max_length = 0;
  if( 0 < i && i < maxpage ) {
      max_length = (i*_distant);
  }else if( i = maxpage ){
      max_length = data.length;
  }else {
      return false;
  }
for (var j = (i-1)*_distant; j < max_length; j++) {
   _html += ' <div class="products-list__item">';
  _html += '      <div class="product-card product-card--hidden-actions ">';
  _html += '          <button class="product-card__quickview" type="button" data-product_id="'+data[j]['id']+'">';
  _html += '              <svg width="16px" height="16px">';
  _html += '                  <use xlink:href="'+ htzwpApi.tmp_dir +'/images/sprite.svg#quickview-16"></use>';
  _html += '              </svg>';
  _html += '              <span class="fake-svg-icon"></span>';
  _html += '          </button>';
  _html += '          <div class="product-card__badges-list">';
                      if(data[j]['on_sale']){
  _html += '              <div class="product-card__badge product-card__badge--new">Sale</div>';
                      }
  _html += '          </div>';
  _html += '          <div class="product-card__image product-image">';
  _html += '              <a href="'+data[j]['permalink']+'" class="product-image__body">';
  _html += '                  <img class="product-image__img" src="'+data[j]['images'][0]['src']+'" alt="">';
  _html += '              </a>';
  _html += '          </div>';
  _html += '          <div class="product-card__info">';
  _html += '              <div class="product-card__name">';
  _html += '                  <a href="'+data[j]['permalink']+'">'+data[j]['name']+'</a>';
  _html += '              </div>';
  _html += '              <div class="product-card__rating">';
  _html += '                  <div class="product-card__rating-stars">';
  _html += '                      <div class="rating">';
  _html += '                          <div class="rating__body">';
                                      for (var i = 0; i < 5; i++) {
                                            if(i < data[j]['average_rating']){
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
_html += '                  <div class="product-card__rating-legend">'+ data[j]['rating_count'] +' Reviews</div>';
_html += '              </div>';
_html += '              <ul class="product-card__features-list">';
                      var obj_attribute = data[j]['attributes'];
                      for (const [j1, value1] of Object.entries(obj_attribute)){
                            _html += '<li>'+obj_attribute[j1]['name']+': '+ obj_attribute[j1]['options'] +'</li>';
                        }
_html += '              </ul>';
_html += '          </div>';
_html += '          <div class="product-card__actions">';
_html += '              <div class="product-card__availability">';
_html += '                  Availability: <span class="text-success">In Stock</span>';
_html += '              </div>';
_html += '              <div class="product-card__prices">';
_html += '                  '+data[j]['price_html'];
_html += '              </div>';

_html += '              <div class="product-card__buttons">';
_html += '                  <button type="button" onclick="add_product_ajax(this);" class="btn btn-primary product-card__addtocart" data-quantity="1" data-product_id="'+data[j]['id']+'" data-product_sku="">Add To Cart</button>';
_html += '                  <button type="button" onclick="add_product_ajax(this);" class="btn btn-secondary product-card__addtocart product-card__addtocart--list" data-quantity="1" data-product_id="'+data[j]['id']+'" data-product_sku="">Add To Cart</a>';
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
