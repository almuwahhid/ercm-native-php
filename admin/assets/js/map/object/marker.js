var Marker = function(map, location, content, title){
  this.map = map;
  this.title = title;
  this.content = content;
  this.location = location;

  if(this.content === "null")
    this.map.setCenter(this.location);

  this.inisialisasiWisata = function(wisata){
    console.log("Loc "+wisata.getLocation().lat);
    var marker = new google.maps.Marker({
      position : wisata.getLocation(),
      content : wisata,
      icon : "images/wisata-marker.png",
      title : wisata.nama,
      map : null
    });

    marker.addListener('click', function() {
      this.map.setZoom(12);
      info_window = new google.maps.InfoWindow({
        content: konten_wisata(marker),
      });
      info_window.open(this.map, marker);
    });
    return marker;
  }

  this.inisialisasiLokasiSaya = function(lokasiku){
    var marker = new google.maps.Marker({
      position : lokasiku.getLocation(),
      content : lokasiku.content,
      icon : "images/my-marker.png",
      title : lokasiku.nama,
      map : null
    });

    marker.addListener('click', function() {
      this.map.setZoom(12);
      this.map.setCenter(marker.getPosition());
      info_window = new google.maps.InfoWindow({
        content: '<div class="tengah-text" style="width:50px;height:30px">Saya</div>',
      });
      info_window.open(this.map, marker);
    });
    return marker;
  }

  function konten_wisata(marker){
      konten =
      '<div style="width:250px;min-height:177px">'+
      '<div class="w-100">'+

      '<div class="w-100" style="text-align:center">'+
      marker.title+
      // '<a href="detail.php?id='+marker.content+'" id="btn-rute" style="color:white" class="btn btn-danger" onclick="">Detail</a>'+
      '</div>'+

      '<div class="col-md-12" style="margin-top:10px" id="gbr">'+
        '<div style="width:230px" class="centerHorizontal"><img src="photos/'+marker.content.foto+'" alt="'+marker.title
        +'" class="rounded" width="230"></div>'
      '</div>'+

      '</div>'+
      '</div>';
      return konten;
    }

    return this.marker;
}
