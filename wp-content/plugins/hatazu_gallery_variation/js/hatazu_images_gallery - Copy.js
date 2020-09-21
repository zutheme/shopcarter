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
    var e_list_images = _e_parent.getElementsByClassName('list-images')[0];
    var str_json = e_list_images.value;
    var jlist = [];
    var order = 0;
    if (IsJsonString(str_json)) {
        jlist = JSON.parse(str_json);
        order = jlist.length;
    }
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
        e_sub_a.setAttribute("class", "delete tips");
        e_sub_a.innerHTML = "delete";
        e_sub_a.addEventListener('click', function(){
            delete_gallery_variation_product(e_sub_a,order,variation_id);
        });
        //e_sub_a.setAttribute("onclick", "delete_gallery_variation_product("+e_sub_a,order,variation_id+")");
        e_sub_li.appendChild(e_sub_a);
        e_sub_ul.appendChild(e_sub_li);
        e_li.appendChild(e_sub_ul);
        _e_gallery.appendChild(e_li);
        var obj = {};
        obj.url = media_attachment.url;
        obj.trash = false;
        jlist.push(obj);
        var str_json = JSON.stringify(jlist);
        e_list_images.value = str_json;
        init_sort();    
    });
    // Opens the media library frame.
    meta_image_frame.open();
}
function save_gallery_variation_product(element) {
    var load = document.getElementsByClassName("htz-popup-processing")[0];
    var result = load.getElementsByClassName("result")[0];
    load.style.display = "block";
    var _e_parent = element.parentElement.parentElement;
    var _list_image = _e_parent.getElementsByClassName("list-images")[0].value;
    var _variation_id = _e_parent.getElementsByClassName("hidden_variation_id")[0].value;
    var http = new XMLHttpRequest();
    var url = ajax_object.ajax_url+"?action=update_gallery";
    var _security = ajax_object.security;
    var params = JSON.stringify({variation_id:_variation_id, list_image:_list_image});
    http.open("POST", url, true);
    http.setRequestHeader("Accept", "application/json");
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.onreadystatechange = function() {
        if(http.readyState == 4 && http.status == 200) {
            var myArr = JSON.parse(this.responseText);
            console.log(myArr);
            load.style.display = "none";
        }
    }
    http.send(params);
}
function delete_gallery_variation_product(element,order,variation_id) {
    var _e_parent = element.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement;
    var e_list_images = _e_parent.getElementsByClassName('list-images')[0];
    var str_json = e_list_images.value;
    var jlist = JSON.parse(str_json);
    jlist[order]['trash'] = true;
    var copy_jlist = [];
    for (var i = 0; i < jlist.length; i++) {
        if(!jlist[i].trash){
            copy_jlist.push(jlist[i]);
        }
    }
    str_json = JSON.stringify(copy_jlist);
    e_list_images.value = str_json;
    var _e_parent_ul = element.parentElement.parentElement.parentElement.parentElement;
    var _eli = element.parentElement.parentElement.parentElement;
    _e_parent_ul.removeChild(_eli);
}