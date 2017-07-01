/**
 * Created by katan-hgmhub on 1/7/17.
 */


/**
 *
 */



/*
 function initHGMPlayer(){

 // Set object references
 playbtn = document.getElementById("playpausebtn");
 mutebtn = document.getElementById("mutebtn");
 seekslider = document.getElementById("seekslider")
 volumeslider = document.getElementById("volumeslider")
 curtimetext = document.getElementById("curtimetext");
 durtimetext = document.getElementById("durtimetext");
 songTitle = document.getElementById("songTitle");

 audio = new Audio();
 dir = "media/";
 playlist = "playlist/";
 WeekNumber = "Week38/";
 trakz = ['Money', 'Put It Down', 'Where You Are', 'vybebeatz+187freedl'];
 trak_index = 0;
 ext = '.mp3';

 if(checkCurrentUserEmail == ""){
 //audio = new Audio();
 audio.src = "";
 audio.loop = false;
 audio.play();
 audio.stop();
 }
 else if(checkCurrentUserEmail != "") {
 audio = new Audio();
 audio.src = dir+playlist+WeekNumber+trakz[0]+ext;
 audio.loop = false;
 audio.play();
 songTitle.innerHTML = trakz[trak_index]+" by Mr. Pup";

 // Add Event Handling
 playbtn.addEventListener("click", playPause);
 mutebtn.addEventListener("click", mute);
 seekslider.addEventListener("mousedown", function (event) {
 seeking = true;
 seek(event);
 });
 seekslider.addEventListener("mousemove", function (event) {
 seek(event);
 });
 seekslider.addEventListener("mouseup", function () {
 seeking = false;
 });
 volumeslider.addEventListener("mousemove", setvolume);

 audio.addEventListener("timeupdate", function () {
 seektimeupdate();
 });

 // Functions
 function playPause() {
 if (audio.paused) {
 audio.play();
 playbtn.style.background = "url('img/player/pause_button.png') no-repeat";
 } else {
 audio.pause();
 playbtn.style.background = "url('img/player/play_button.png') no-repeat";
 }
 }

 function mute() {
 if (audio.muted) {
 audio.muted = false;
 mutebtn.style.background = "url('img/player/mute_button.png') no-repeat";
 } else {
 audio.muted = true;
 mutebtn.style.background = "url('img/player/unmute_button.png') no-repeat";
 }
 }

 function seek(event) {
 if (seeking) {
 seekslider.value = event.clientX - seekslider.offsetLeft;
 seekto = audio.duration * (seekslider.value / 100);
 audio.currentTime = seekto;
 }
 }

 function setvolume() {
 audio.volume = volumeslider.value / 100;
 }

 function seektimeupdate() {

 var newtime = audio.currentTime * (100 / audio.duration);
 seekslider.value = newtime;

 var curmins = Math.floor(audio.currentTime / 60);
 var cursecs = Math.floor(audio.currentTime - curmins * 60);

 var durmins = Math.floor(audio.duration / 60);
 var dursecs = Math.floor(audio.duration - durmins * 60);

 if (cursecs < 10) {
 cursecs = "0"+cursecs;
 }
 if (curmins < 10) {
 curmins = "0"+curmins;
 }
 if (dursecs < 10) {
 dursecs = "0"+dursecs;
 }
 if (durmins < 10) {
 durmins = "0"+durmins;
 }
 curtimetext.innerHTML = curmins + ":" + cursecs;
 durtimetext.innerHTML = durmins + ":" + dursecs;

 console.log('This is the remaining time:' + durmins + ":" + dursecs);
 }

 /!* #### start next song request  #### *!/
 // 1. if source is equal to 0:05 get next song
 // 2. get next image
 // 3. slide artist image
 // 4. if new song or source does not load re load / re buffer after 0:03 seconds.

 // 1. Get current source time
 function checkCurrentTimeText (){
 var remainingTime = curtimetext.innerHTML;
 console.log('remainingTime');
 }
 }

 }
 window.addEventListener("load", initHGMPlayer);*/
