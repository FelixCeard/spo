var str = window.location.href;
var active = str;
var n = str.length;
let client_id = "94db9bed15c749be878fbd593526b0fb";
let client_secret = "4e50eab5ad7c49f59b1528381b594ba9";
let uri = "http://localhost/spotify";
//  window.localStorage
if(n < 255){
  var url = "https://accounts.spotify.com/authorize/?client_id="+client_id+"&response_type=token&redirect_uri="+uri+"&scope=user-read-private%20user-read-playback-state&state=34fFs29kd09"
  window.localStorage.setItem("time",$.now());
  window.location.replace(url);

}else{
  checkTime();
  var exploded = active.split("=");
  var explod = exploded[1].split("&");
  token = explod[0];
  var explod = exploded[2].split("&");
  var token_type = explod[0];
  var explod = exploded[3].split("&");
  var expire = explod[0];
  var explod = exploded[4].split("&");
  var state = explod[0];

  var base_url = "https://api.spotify.com";
  // var name = "Pink";
  // var id = "0k17h0D3J5VfsdmQ1iZtE9";
  // var artist = "/v1/artists/"+id;
  // Artist(name);
  // Artist_track("7oPftvlwr6VrsViSDV7fJY",token,token_type);
  // var devices_id = tokenDevices(token);
  // console.log(devices_id);
  // setVolume(50,devices_id,token);
}
