var initloadyoutube = false;
var index_play = 0;
var _play_ready = false;
var _api_ready = false;
//var playsingle = [];
//var playlist = ['zEpoO4x_LZ8'];
var player;
var _width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
var _height = (window.innerHeight > 0) ? window.innerHeight : screen.height;
var maxHeightvideo = 500;
if(_width > _height && _width > 1024) {
  maxHeightvideo = _height*0.8;
}else{
  maxHeightvideo = _width*0.8;
}
if(_width < 768){
  maxHeightvideo = 360;
}else{
  maxHeightvideo = 400;
}
if(!initloadyoutube){
  inityoutube();
  initloadyoutube = true;
}
//2. This code loads the IFrame Player API code asynchronously.
function inityoutube(){
      var tag = document.createElement('script');

      tag.src = "https://www.youtube.com/iframe_api";

      var firstScriptTag = document.getElementsByTagName('script')[0];

      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      // 3. This function creates an <iframe> (and YouTube player)

      //    after the API code downloads.   
       //var playlist = [];
       window.onYouTubeIframeAPIReady = function(events) {
        player = new YT.Player('player', {

          height: maxHeightvideo,

          width: '100%',

          //playerVars: { 'autoplay': 1, 'controls': 0 },

          playerVars: {

            autoplay: 1,

            color: 'white', 

            rel: 0,

            controls:1,

            playinline: 1,

            fs: 0,
            
            showinfo: 0,

            playlist: playsingle.join(','),

          },

          events: {

            'onReady': onPlayerReady

            //'onStateChange': onPlayerStateChanges

          }

        });
       }
      
}
      var previousIndex = 0;

      
      // 4. The API will call this function when the video player is ready.

      function onPlayerReady(event) {

        //event.target.playVideo();
        _play_ready = true;
        index_play = 0;

      }

      // 5. The API calls this function when the player's state changes.

      //    The function indicates that when playing a video (state=1),

      //    the player should play for six seconds and then stop.

      var done = false;

      function onPlayerStateChanges(event) {

        if (event.data == YT.PlayerState.PLAYING && !done) {

          //setTimeout(stopVideo, 100);

          //stopVideo();

          done = true;

        }

      }

      function onPlayerStateChange(event) {

        if (event.data == YT.PlayerState.PLAYING && !done) {

          setTimeout(stopVideo, 6000);

          done = true;

        }

        if(event.data == -1 || event.data == 0) {

                    // get current video index

                    var index = player.getPlaylistIndex();

                    var le = player.getPlaylist().length-1;

                    // update when playlists do not match

                    if(player.getPlaylist().length != playlist.length) {

                        // update playlist and start playing at the proper index

                        player.loadPlaylist(playlist, previousIndex+1);

                    }

                    /*

                    keep track of the last index we got

                    if videos are added while the last playlist item is playing,

                    the next index will be zero and skip the new videos

                    to make sure we play the proper video, we use "last index + 1"

                    */

                    //console.log(player.getPlaylist().length+","+playlist.length);

                    previousIndex = index;

                }

    }

    function stopVideo() {

        player.stopVideo();

    }

    function pauseVideo(){

     	player.pauseVideo();

    }

 

    function play_index(index) {

        player.playVideoAt(index);        

    }

 //var _player = document.getElementById("player");
 var element = document.getElementById("video-container");
 var _stateplay = 0;
 var rect,height=0;
 function scrollplay(){
        if(index_play < 0 ){
            return false;
        }    
        rect = element.getBoundingClientRect();
        if(_play_ready){
            _stateplay = player.getPlayerState();
            //console.log(_stateplay);
        }
        height = window.innerHeight+200;
        if(rect.top < 0 || rect.bottom > height && initloadyoutube){
          //e_bgimg.style.display = "none";
          if(_stateplay == 1){
              pauseVideo();
              //console.log('pause');
           }
        }else if( _stateplay == 2 || _stateplay == 5 && initloadyoutube ){
                  play_index(index_play);
        }  
}

window.addEventListener("scroll", scrollplay,false);     

Element.prototype.hasClass = function(className) {

    return this.className && new RegExp("(^|\\s)" + className + "(\\s|$)").test(this.className);

};



      