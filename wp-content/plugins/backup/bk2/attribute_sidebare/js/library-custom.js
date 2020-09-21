const wooClientKey = 'ck_4884cc4eaa8d315117e3990bcf8c213e0a8a821a';
const wooClientSecret = 'cs_89f9a54eebf5885bceb89289aa912c382be4c488';
const _tmp_dir = wpApiSettings.tmp_dir;
const _url_blog = wpApiSettings.url_blog;
function basicAuth(key, secret) {
    let hash = btoa(key + ':' + secret);
    return "Basic " + hash;
}
//var e_megamenu__links_level_0 = document.getElementsByClassName("megamenu__links--level--0")[0];
//console.log(e_megamenu__links_level_0);
// for (var i = 0; i < e_item_has_children.length; i++) {
// 	e_item_has_children[i].addEventListener("mouseover", function(){
// 		console.log('hover');
// 	});
// }

