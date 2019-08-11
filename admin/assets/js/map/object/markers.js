var Markers = function(){
  this.datas = [];

  this.add = function(marker){
    this.datas.push(marker);
  }

  this.setToMap = function(map){
    console.log("setToMap "+this.datas.length);
    for (var i = 0; i < this.datas.length; i++) {
      this.datas[i].setMap(map);
    }
  }
}
