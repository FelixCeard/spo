function sleep(ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}
function add(id){
  url = "https://api.spotify.com/v1/tracks/"+id;
  $.getJSON({
    url : url,
    type : "GET",
    headers : {"Authorization" : token_type+" "+token},
    success :function(data){
      console.log(data);
      var track = JSON.stringify(data);
      window.localStorage.setItem("single",track);
    }

  })
  sleep(250).then(() => {
    $.getJSON({
      url : url,
      type : "GET",
      headers : {"Authorization" : token_type+" "+token},
      success :function(data){
        var track = JSON.stringify(data);
        window.localStorage.setItem("single",track);
      }
    })
  })

  console.log(window.localStorage.getItem("single"));



}
function getDate(id) {
  var url = "https://api.spotify.com/v1/albums/"+id;
  $.getJSON({
    url : url,
    type : "GET",
    headers : {"Authorization" : token_type+" "+token},
    success :function(data){
      var album = JSON.stringify(data);
      window.localStorage.setItem("album",album);
    }
  });
  var album = window.localStorage.getItem("album");
  album = JSON.parse(album);
  var date = album.release_date;
  var string = "";
  for (var i = 0; i < 4; i++) {
    string = string + date[i];
  }
  return string;
}
function clear(){
  $("#output").empty();
  $("#track").empty();
}
function checkTime() {
  let old = window.localStorage.getItem("time");
  if(old + 3600 < $.now()){
    window.location.replace("http://localhost/spotify");
  }
}
function Artist(gg) {
  var search = "/v1/search/?type=artist&q="+gg;
  var response = $.getJSON({
    url : base_url+search,
    type : "GET",
    headers : {"Authorization" : token_type+" "+token},
    success :function(data){
      var artuist = JSON.stringify(data);
      window.localStorage.setItem("Artist",artuist);
    }
  });
  setTimeout(function()
  {


      var json_r = JSON.parse(window.localStorage.getItem("Artist"));
      var response_spot = json_r;
      if(response_spot == undefined){
        document.write("please wait, we will redirect you to the good url");
        sleep(250).then(() => {
          url = "http://127.0.0.1.xip.io/spotify?#"+token+"&token_type=Bearer&expires_in=3600&state="+state;
          window.location.replace(url);
        })
        // alert("please refresh to make the page work properly");

      }
      var all = response_spot.artists.total;
      var limit = response_spot.artists.limit;
      var artists = response_spot.artists.items;
      for (var i = 0; i < all; i++) {

        if (i > limit-1) {
          console.log("reached limit of "+limit);
          break;
        }else {
          name = response_spot.artists.items[i]["name"];
          id = response_spot.artists.items[i]["id"];
          image = response_spot.artists.items[i]["images"];
          if(image.length != 0){
            image = image["0"]["url"];
            // height = response_spot.artists.items[i]["images"]["0"]["height"];
            // width = response_spot.artists.items[i]["images"]["0"]["width"];
            $("#output").append("<img class=\"artists\" id=\""+id+"\" class=\"img\" height=\"250px\" width=\"250px\" src=\""+image+"\">"+name+"<br>");
          }else {
            $("#output").append(name+"<br>");
          }
        }
      }

  }, 0);
}

function Artist_track(id) {
  var url = "https://api.spotify.com/v1/artists/"+id+"/top-tracks?country=DE";
  var requersts = $.getJSON({
    url : url,
    type : "GET",
    headers : {"Authorization" : token_type+" "+token},
    success: function (data) {
      var retur = data;
      console.log(data);
      window.localStorage.setItem("track",JSON.stringify(data));
    }
  });
    var requests = JSON.parse(window.localStorage.getItem("track"));
    var json_r = requests.tracks;
    for (var i = 0; i < json_r.length; i++) {
      var name = json_r[i]["name"];
      var artistN = json_r[i]["artists"]["0"]["name"];
      var artistI = json_r[i]["artists"]["0"]["id"];
      var image_url = json_r[i]["album"]["images"][0]["url"];
      var id = json_r[i].album.id;
      var track_id = json_r[i].id;
      $("#tracks").append("<img class=\"album\" id=\""+ id +"\" src=\""+ image_url+"\">"+artistN+": "+name+"<button id=\""+track_id+"\">add</button><br>");
    }

  return requersts;
}

function tokenDevices(token){
  var url = "https://api.spotify.com/v1/me/player/devices";
  var req = $.getJSON({
    url : url,
    type : "GET",
    headers : {"Authorization" : "Bearer " + token},
    success: function (data) {
      var retur = data.devices["0"].id;
      window.localStorage.setItem("data",data.devices["0"].id);
    }
  });
  return((window.localStorage.getItem("data")));
}
function setVolume(value,device_id,token){
  var url = "https://api.spotify.com/v1/me/player/volume?volume_percent="+value+"&device_id="+device_id;
  $.ajax({
    url : url,
    type : "PUT",
    headers : {"Authorization" : "Bearer " + token}
  })
}
