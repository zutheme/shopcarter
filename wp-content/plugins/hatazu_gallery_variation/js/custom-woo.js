var _e_product_gallery = document.getElementsByClassName("product__gallery")[0];
var _e_product__prices = document.getElementsByClassName("product__prices")[0];
var e_frm = document.getElementsByClassName('product__options')[0];
var e_variation = e_frm.hasAttribute("data-product_variations");
if(e_variation){
	var e_option = e_frm.getElementsByClassName('product__option');
	for (var i = 0; i < e_option.length; i++) {
		var e_input = e_option[i].getElementsByTagName('input');
		for (var j = 0; j < e_input.length; j++) {
			if(e_input[j].getAttribute("type") == 'radio'){
				e_input[j].addEventListener("click", function(){
				   search_attribute(this.getAttribute("variation_id"));
				});
			}
		}
	}
}
function search_attribute( _variation_id){
	
	if(!e_variation) return false;
	var datajson = e_frm.getAttribute("data-product_variations");
	var myArr = JSON.parse(datajson);
	console.log(myArr);
	var item;
	for (var i = 0; i < myArr.length; i++) {
		  if(myArr[i]['variation_id'] == _variation_id){
		  	var _full_src = myArr[i]['image']['full_src'];
		  	var _price_html = myArr[i]['price_html'];
		  	var _obj_gallery;
		  	if(myArr[i]['gallery']){
		  		_obj_gallery = JSON.parse(myArr[i]['gallery']); 
		  	}
		  	var htmlString = show_feature_product(_full_src, _obj_gallery, _price_html);
		  	var objhtml = createElementFromHTML(htmlString);
		  	_e_product__prices.innerHTML = _price_html;
		  	_e_product_gallery.innerHTML = '';
		  	_e_product_gallery.appendChild(objhtml);
		  	init_gallery(); 
		  }
	}
}
function show_feature_product(_full_src, _obj_gallery, _price_html){
	
	var feature = '', gallery_carousel ='',html='';
	feature += '<div class="product-image product-image--location--gallery">';
    feature += ' <a href="'+ _full_src +'" data-width="700" data-height="700" class="product-image__body" target="_blank"><img class="product-image__img" src="'+ _full_src +'" alt=""></a></div>';
    gallery_carousel += '<a href="'+ _full_src +'" class="product-image product-gallery__carousel-item">';
    gallery_carousel += '<div class="product-image__body"><img class="product-image__img product-gallery__carousel-image" src="'+ _full_src +'" alt="">';
    gallery_carousel +='</div></a>';
    if(_obj_gallery){
		for (let [key, value] of Object.entries(_obj_gallery)) {
		   feature += '<div class="product-image product-image--location--gallery">';
           feature +='<a href="'+value+'" data-width="700" data-height="700" class="product-image__body" target="_blank"><img class="product-image__img" src="'+value+'" alt=""></a></div>';

            gallery_carousel += '<a href="'+value+'" class="product-image product-gallery__carousel-item">';
            gallery_carousel += '<div class="product-image__body"><img class="product-image__img product-gallery__carousel-image" src="'+value+'" alt=""></div></a>';
		}
    		
    }
    html ='<div class="product-gallery__featured">';
	html +='<button class="product-gallery__zoom">';
	html +='<svg width="24px" height="24px"><use xlink:href="'+wpApiSettings.tmp_dir+'/images/sprite.svg#zoom-in-24"></use></svg></button>';
	html +='<div class="owl-carousel" id="product-image">';
	html += feature;
	html +='</div></div>';

	html +='<div class="product-gallery__carousel">';
	html +='<div class="owl-carousel" id="product-carousel">';
	html += gallery_carousel;
	html +='</div></div>';
	return html;
}
function createElementFromHTML(htmlString) {
  var div = document.createElement('div');
  div.setAttribute("class", "product-gallery");
  div.innerHTML = htmlString.trim();

  // Change this to div.childNodes to support multiple top-level nodes
  return div; 
}
function isJson(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}
function isEmpty(obj) {
  for(var prop in obj) {
    if(obj.hasOwnProperty(prop)) {
      return false;
    }
  }

  return JSON.stringify(obj) === JSON.stringify({});
}