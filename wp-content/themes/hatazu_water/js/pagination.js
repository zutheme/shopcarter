function hasClass(element, className) {
    return (' ' + element.className + ' ').indexOf(' ' + className+ ' ') > -1;
}
var e_products_view__pagination = document.getElementsByClassName("products-view__pagination")[0];
if(e_products_view__pagination){
	var ul_page = e_products_view__pagination.getElementsByTagName("ul")[0];
	fn_addclass(ul_page, "pagination justify-content-center");
	var li_page = e_products_view__pagination.getElementsByTagName("li");
	for (var i = 0; i < li_page.length; i++) {
		fn_addclass(li_page[i], "page-item");
	}
	var a_page = e_products_view__pagination.getElementsByTagName("a");
	for (var i = 0; i < a_page.length; i++) {
		fn_addclass(a_page[i], "page-link");
		if(hasClass(a_page[i], 'prev')||hasClass(a_page[i], 'next')){
			fn_addclass(a_page[i], "page-link--with-arrow");
		}
	}
	var a_span = e_products_view__pagination.getElementsByTagName("span");
	for (var j = 0; j < a_span.length; j++) {
		if(hasClass(a_span[j], 'current')){
			fn_addclass(a_span[j], "page-link");
			fn_addclass(a_span[j].parentElement, "active");
		}
	}
}
var e_post_view__pagination = document.getElementsByClassName("posts-view__pagination")[0];
if(e_post_view__pagination){
	var ul_page = e_post_view__pagination.getElementsByTagName("ul")[0];
	fn_addclass(ul_page, "pagination justify-content-center");
	var li_page = e_post_view__pagination.getElementsByTagName("li");
	for (var i = 0; i < li_page.length; i++) {
		fn_addclass(li_page[i], "page-item");
	}
	var a_page = e_post_view__pagination.getElementsByTagName("a");
	for (var i = 0; i < a_page.length; i++) {
		fn_addclass(a_page[i], "page-link");
		if(hasClass(a_page[i], 'prev')||hasClass(a_page[i], 'next')){
			fn_addclass(a_page[i], "page-link--with-arrow");
		}
	}
	var a_span = e_post_view__pagination.getElementsByTagName("span");
	for (var j = 0; j < a_span.length; j++) {
		if(hasClass(a_span[j], 'current')){
			fn_addclass(a_span[j], "page-link");
			fn_addclass(a_span[j].parentElement, "active");
		}
	}
}
