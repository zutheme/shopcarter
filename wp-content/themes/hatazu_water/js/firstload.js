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

function findelement(nameclass){
  var countdown = 20;
  var e_woocomerce = document.getElementsByClassName(nameclass)[0];
  if(!e_woocomerce){
    var x = setInterval(function() {
      e_woocomerce = document.getElementsByClassName(nameclass)[0];
      if(e_woocomerce){
        fn_addclass(e_woocomerce, 'container');
        clearInterval(x);
      }
      countdown = countdown - 1;
        if (countdown < 0) {
          clearInterval(x);
        }  
    }, 1);
  }else {
    fn_addclass(e_woocomerce, 'container');
  }
}
findelement('woocommerce');
function basicAuth(key, secret) {
    let hash = btoa(key + ':' + secret);
    return "Basic " + hash;
}