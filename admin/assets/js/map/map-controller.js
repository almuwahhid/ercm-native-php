function setUserLocToMap(lat, lng){
  markers.add(
    new Marker().inisialisasiLokasiSaya(new Lokasiku().setData(lat, lng))
  );
  markers.setToMap(map);
}

function ambilSemuaWisata(){
  $.ajax({
    method: "POST",
    beforeSend: function() {
      console.log(my_location);
    },
    url: "backend/wisata.php",
    data: {

    }, error: function(jqXHR, exception) {
            if (jqXHR.status === 0) {
                alert('Not connect.\n Verify Network.');
            } else if (jqXHR.status == 404) {
                alert('Requested page not found. [404]');
            } else if (jqXHR.status == 500) {
                alert('Internal Server Error [500].');
            } else if (exception === 'parsererror') {
                alert('Requested JSON parse failed.');
            } else if (exception === 'timeout') {
                alert('Time out error.');
            } else if (exception === 'abort') {
                alert('Ajax request aborted.');
            } else {
                alert('Uncaught Error.\n' + jqXHR.responseText);
            }
        }
  }).done(function(result) {
    console.log(result);

    var wisatas = JSON.parse(result);
    for (var i = 0; i < wisatas.length; i++) {
      console.log(wisatas[i]);
      markers.add(
        new Marker().inisialisasiWisata(new WisataBantul().setDataFromJson(wisatas[i]))
      );
    }
    markers.setToMap(map);
  });
}

function buatJalur(id_tujuan){
  this.datas;
  $.ajax({
    method: "POST",
    beforeSend: function() {
      console.log(my_location);
    },
    url: "backend/service.php",
    data: {
      'id_tujuan' : id_tujuan,
      'lokasiku'  : JSON.stringify(my_location)
    }, error: function(jqXHR, exception) {
            if (jqXHR.status === 0) {
                alert('Not connect.\n Verify Network.');
            } else if (jqXHR.status == 404) {
                alert('Requested page not found. [404]');
            } else if (jqXHR.status == 500) {
                alert('Internal Server Error [500].');
            } else if (exception === 'parsererror') {
                alert('Requested JSON parse failed.');
            } else if (exception === 'timeout') {
                alert('Time out error.');
            } else if (exception === 'abort') {
                alert('Ajax request aborted.');
            } else {
                alert('Uncaught Error.\n' + jqXHR.responseText);
            }
        }
  }).done(function(result) {
    console.log(result);

    markers.add(
      new Marker().inisialisasiWisata(new WisataBantul().setDataFromJson(JSON.parse(result).tujuan))
    );
    markers.setToMap(map);
    $("#jarak").html("Jarak : "+JSON.parse(result).jarak.toFixed(2)+" km");
    buatRute(JSON.parse(result).jalur);
  });
}

function tampilkanListWisata(page){
  $.ajax({
    method: "POST",
    beforeSend: function() {
      $("#loading").show();
      $("#loadmore").hide();
    },
    url: "backend/wisatalist.php",
    data: {
      'page' : page
    }, error: function(jqXHR, exception) {
      $("#loading").hide();
            if (jqXHR.status === 0) {
                alert('Not connect.\n Verify Network.');
            } else if (jqXHR.status == 404) {
                alert('Requested page not found. [404]');
            } else if (jqXHR.status == 500) {
                alert('Internal Server Error [500].');
            } else if (exception === 'parsererror') {
                alert('Requested JSON parse failed.');
            } else if (exception === 'timeout') {
                alert('Time out error.');
            } else if (exception === 'abort') {
                alert('Ajax request aborted.');
            } else {
                alert('Uncaught Error.\n' + jqXHR.responseText);
            }
        }
  }).done(function(result) {
    console.log(result);
    $("#loading").hide();

    var wisatas = JSON.parse(result).wisata;
    var code = JSON.parse(result).code;
    if(code==200){
      $("#loadmore").show();
      for (var i = 0; i < wisatas.length; i++) {
        $("#listwisata").append(rowWisata(wisatas[i]));
      }
    }
  });
}

function buatRute(pth){
  if(polyline != '') polyline.setMap(null);
  var polyOptions = {
			path: makeAPath(pth),
			geodesic: true,
			strokeColor: 'rgb(46, 156, 34)',
			strokeOpacity: 1.0,
			strokeWeight: 3,
		};
		polyline = new google.maps.Polyline(polyOptions);
		polyline.setMap(map);
}

function makeAPath(pth){
  var paths = [];
  for(var i=0; i<pth.length; i++){
			paths.push({"lat": parseFloat(pth[i][0]),"lng": parseFloat(pth[i][1])});
		}
  return paths;
}

function rowWisata(wisata){
  return '<tr class="pointer" onclick="toDetailWisata(\'detail.php?id='+wisata.id_wisata+'\')">'+
    '<td>'+
      '<div class="row">'+
      '</div>'+
      wisata.nama_wisata+
    '</td>'+
    '<td>'+
      wisata.alamat_wisata+
    '</td>'+
    '<td>'+
        '<div style="margin-right:10px" class="m-r-10 centerVertical"><img src="photos/'+wisata.foto+'" alt="'+wisata.foto+'" class="rounded" width="50"></div>'+
    '</td>'+
  '</tr>';
}
