var WisataBantul = function(){
  this.lat = 0.0;
  this.lng = 0.0;
  this.alamat_wisata = "";
  this.nama = "";
  this.id_wisata = "";
  this.foto = "";

  this.setDataFromJson = function(json){
    this.id_wisata = json.id_wisata;
    this.lat = json.lat;
    this.lng = json.lng;
    this.alamat_wisata = json.alamat_wisata;
    this.nama = json.nama_wisata;
    this.foto = json.foto;
    return this;
  }

  this.getLat = function(){
    return this.lat;
  }

  this.setLat = function(lt){
    this.lat = lt;
  }

  this.getLng = function(){
    return this.lng;
  }

  this.setLng = function(ln){
    this.lng = ln;
  }

  this.getLocation = function(){
    return JSON.parse('{"lat": '+this.lat+', "lng": '+this.lng+'}');
  }

  this.setNama = function(nama) { this.nama = nama; }
  this.getNama = function() { return this.nama; }
  this.setAlamat = function(alamat) { this.alamat_wisata = alamat; }
  this.getAlamat = function() { return this.alamat_wisata; }
  this.setId = function(id) { this.id_wisata = id; }
  this.getId = function() { return this.id; }
}
