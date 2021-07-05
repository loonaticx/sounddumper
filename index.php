<!DOCTYPE html>
<html>
<head>
<title>SOUND DUMPER</title>
  <script type="text/javascript" src="jquery-1.7.js"></script>
<style>
@font-face {
  font-family: userfont;
  src: url("font.ttf");
}

body {
  background-color: #222222;
  background-repeat: no-repeat;
  background-size: cover;
  background-position: top left;
  background-attachment: fixed;
  color: #dddddd;
  font-family: 'userfont', monospace;
  font-size: 20px;
  text-transform: uppercase;
  line-height:24px;
}

a {
  color: #dddddd;
}

#mainbox {
  width: 640px;
	margin-bottom:0px;
}

#audio {
  width: 632px;
  border: 2px solid rgba(255,255,255,0.2);
}

#playlist {
	margin:0px;
  width: 600px;
  text-align: left;
  background-color: rgba(15,15,15,0.7);
  padding: 16px;
  border: 2px solid rgba(255,255,255,0.2);
}

.active a {
  color: #00FFAA;
  text-decoration: none;
}

li a {
  color: #888888;
  padding: 0px;
  display: block;
  text-decoration: none;
}

li a:hover {
  color: #EEEEEE;
  text-decoration: none;
}

ul {
  list-style-type: none;
}
</style>
<script type='text/javascript'>
$(document).ready(function () {
  init();
	function init(){
		var current = 0;
		var audio = $('#audio');
		var playlist = $('#playlist');
		var tracks = playlist.find('li a');
		var len = tracks.length;
		audio[0].volume = 1;
		audio[0].play();
		playlist.on('click','a', function(e){
			e.preventDefault();
			link = $(this);
			current = link.parent().index();
			run(link, audio[0]);
});

audio[0].addEventListener('ended',function(e) {
  current++;
			if(current == len){
				current = 0;
				link = playlist.find('a')[0];
}

else {
  link = playlist.find('a')[current];
}

run($(link),audio[0]);
});
	}

function run(link, player) {
player.src = link.attr('href');
			par = link.parent();
			par.addClass('active').siblings().removeClass('active');
			player.load();
			player.play();
}
});
</script>
</head>
<center><br>
<div id="mainbox">
<audio id="audio" preload="auto" tabindex="0" controls="" >
</audio><br>
<ul id="playlist">
<?php
$files = glob("*.{mp3}", GLOB_BRACE);
for ($i=0; $i<count($files); $i++) {
$num = $files[$i];
	$prettynum = substr($num, 0, -4);
	echo '<li><a href="'.$num.'">'.$prettynum.'</a></li>';
}
?>
    </ul>
</div>
</center>
</body>
</html>