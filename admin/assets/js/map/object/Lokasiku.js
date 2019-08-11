var Lokasiku = function(){
  this.lat = 0.0;
  this.lng = 0.0;
  this.nama = "Lokasi Saya";
  this.content = "";

  this.setData = function(lat, lng){
    this.lat = lat;
    this.lng = lng;
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
}
