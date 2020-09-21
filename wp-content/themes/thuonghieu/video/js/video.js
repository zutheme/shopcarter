var device_width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
var e_video_home = document.getElementsByClassName("bannerHome")[0];
var e_banner_home = document.getElementById("bannerHome");
var e_video_container = e_video_home.getElementsByClassName("video-background")[0];
var e_cover_image = e_video_home.getElementsByClassName("cover-image")[0];
var created_video = false;

var mouse_in = false;
var mediaPlayer;
var init_video = false;
var played = false;
var context;
var btn_play,btn_mute;
var fnvideo = "no call";
var e_box_link, test_video;
var context;
var _width_video = e_video_home.offsetWidth;
var _height_video = e_video_home.offsetHeight;
if(device_width < 768){
	_height_video = _width_video*0.59;
	e_banner_home.style.height = _height_video*2+"px";
	e_cover_image.src = bgvideo_mobile;
}else{
	_height_video = _height_video+80;
}
function create_init_video(){
	mediaPlayer = document.createElement('video');
	mediaPlayer.src = video_home;
	mediaPlayer.controls = false;
	mediaPlayer.muted = true;
	mediaPlayer.setAttribute('playsinline', "true");
    mediaPlayer.setAttribute('class', "video-media");
	mediaPlayer.width = _width_video;
	mediaPlayer.height = _height_video;
	e_video_container.appendChild(mediaPlayer);
	btn_mute = document.createElement('button');
	btn_mute.type="button";
	btn_mute.setAttribute('class', "btn-mute btn-mute-on");
	btn_mute.onclick = muteonoff;
	btn_mute.innerHTML = "&nbsp;&nbsp;";
	e_video_container.appendChild(btn_mute);
	//btn_play = document.createElement('button');
	//btn_play.type="button";
	//btn_play.setAttribute('class', "btn-control btn-play");
	//btn_play.onclick = eventbtnplay;
	//btn_play.innerHTML = "&nbsp;&nbsp;";
	//e_video_container.appendChild(btn_play);
	init_video = true;
}
function eventbtnplay(){
	btn_play.style.display = "none";
	mediaPlayer.play();
}
function muteonoff(){
	var ebtn = e_video_container.getElementsByClassName("btn-mute")[0];
	if(mediaPlayer.muted){
		ebtn.className = ebtn.className.replace(/\bbtn-mute-on\b/g, "");
		  var arr = ebtn.className.split(" ");
		  var name = "btn-mute-off";
		  if (arr.indexOf(name) == -1) {
		    ebtn.className += " " + name;
		  }
		mediaPlayer.muted = false;
	}else{
		ebtn.className = ebtn.className.replace(/\bbtn-mute-off\b/g, "");
		  var arr = ebtn.className.split(" ");
		  var name = "btn-mute-on";
		  if (arr.indexOf(name) == -1) {
		    ebtn.className += " " + name;
		  }
		mediaPlayer.muted = true;
	}
}
var e_cover = e_video_container.getElementsByClassName("cover-image")[0];
e_video_home.addEventListener("mouseover", mouseOver);
function mouseOver(){
	if(!mouse_in){
		e_cover.style.display = "none";
		create_init_video();
		mediaPlayer.play();
		mouse_in = true;
	}
}
e_video_home.addEventListener("mouseover", mouseOver);


var e_cover_overlay = e_video_home.getElementsByClassName("cover-overlay")[0];
e_cover_overlay.addEventListener('touchstart', function onFirstTouch() {
  if(!init_video){
  	create_init_video();
  	mediaPlayer.play();
  	//console.log(mediaPlayer.readyState);
  	e_cover.style.display = "none";
  }
  e_video_home.removeEventListener('touchstart', onFirstTouch, false);
}, false);

Object.defineProperty(HTMLMediaElement.prototype, 'playing', {
    get: function(){
        return !!(this.currentTime > 0 && !this.paused && !this.ended && this.readyState > 2);
    }
});
var e_copy = e_cover_overlay.getElementsByClassName("copy")[0];
function elementScroll(){
        var rect = e_video_home.getBoundingClientRect();
        //console.log(rect.top, rect.right, rect.bottom, rect.left);
        if(rect.top > 90) {
        	if(!init_video){
			  	create_init_video();
			  	e_cover.style.display = "none";
		 	}
        } 
        if(init_video){
		 	var height = window.innerHeight;
	        if(rect.bottom < height/3){
	        	mediaPlayer.pause();
	        }else{
	        	if(!mediaPlayer.playing && mediaPlayer.muted){
	        		mediaPlayer.play();
	        		if(device_width < 768){
	        			e_copy.style.top = "2%";
	        		}	
	        	}else {
	        		mediaPlayer.play();
	        		if(device_width < 768){
	        			mediaPlayer.muted = false;
	        		}
	        	}
	        }
		 }
}
window.addEventListener("scroll", elementScroll,false);
if(mediaPlayer){
	mediaPlayer.addEventListener('ended',myHandler,false);
}
function myHandler(e) {
    e_cover.style.display = "block";
}

 