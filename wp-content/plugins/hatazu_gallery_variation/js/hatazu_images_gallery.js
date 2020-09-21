function IsJsonString(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}
function upload_variation_product(element){
    var meta_image_frame;
    var _e_parent = element.parentElement.parentElement;
    var _e_gallery = _e_parent.getElementsByClassName('ul-gallery')[0];
    var jlist = [];
    if ( meta_image_frame ) {
        meta_image_frame.open();
        return;
    }
    var _e_parent_variation_bnt = element.parentElement;
    var variation_id = _e_parent_variation_bnt.getElementsByClassName('hidden_variation_id')[0].value;
    variation_id = parseInt(variation_id);
    // Sets up the media library frame
    meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
        title: 'Add to Gallery',
        button: { text:  'Select' },
        library: { type: 'image' }
    });
    // Runs when an image is selected.
    meta_image_frame.on('select', function(){
        // Grabs the attachment selection and creates a JSON representation of the model.
        var media_attachment = meta_image_frame.state().get('selection').first().toJSON();
        var e_li = document.createElement("li");
        e_li.setAttribute("class", "image page_item");
        var e_img = document.createElement("img");
        e_img.setAttribute("src", media_attachment.url);
        e_li.appendChild(e_img);
        var e_sub_ul = document.createElement("ul");
        e_sub_ul.setAttribute("class", "actions");
        var e_sub_li = document.createElement("li");
        var e_sub_a = document.createElement("a");
        e_sub_a.setAttribute("href", "javascript:void(0)");
        e_sub_a.setAttribute("class", "delete");
        e_sub_a.innerHTML = "delete";
        e_sub_a.addEventListener('click', function(){
            delete_gallery_variation_product(e_sub_a);
        });
        e_sub_li.appendChild(e_sub_a);
        e_sub_ul.appendChild(e_sub_li);
        e_li.appendChild(e_sub_ul);
        _e_gallery.appendChild(e_li);
        init_sort();    
    });
    // Opens the media library frame.
    meta_image_frame.open();
}
function save_gallery_variation_product(element) {
    var load = document.getElementsByClassName("htz-popup-processing")[0];
    //var result = load.getElementsByClassName("result")[0];
    load.style.display = "block";
    var _e_parent = element.parentElement.parentElement;
    var _variation_id = _e_parent.getElementsByClassName("hidden_variation_id")[0].value;
    var _e_ul_gallery = _e_parent.getElementsByClassName("ul-gallery")[0];
    var _e_image = _e_ul_gallery.getElementsByTagName("img");
    var _lst_src = [];
    for (var i = 0; i < _e_image.length; i++) {
        _lst_src.push(_e_image[i].src);
    }
    _lst_src = JSON.stringify(_lst_src);
    var http = new XMLHttpRequest();
    var url = ajax_object.ajax_url+"?action=update_gallery";
    var _security = ajax_object.security;
    var params = JSON.stringify({variation_id:_variation_id, list_image:_lst_src});
    http.open("POST", url, true);
    http.setRequestHeader("Accept", "application/json");
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.onreadystatechange = function() {
        if(http.readyState == 4 && http.status == 200) {
            var myArr = JSON.parse(this.responseText);
            //console.log(myArr);
            load.style.display = "none";
        }
    }
    http.send(params);
}
function delete_gallery_variation_product(element) {   
    var _e_parent_ul = element.parentElement.parentElement.parentElement.parentElement;
    var _eli = element.parentElement.parentElement.parentElement;
    _e_parent_ul.removeChild(_eli);
}