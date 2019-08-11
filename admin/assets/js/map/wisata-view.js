$('document').ready(function() {
  init_map(false);
  var p = 1;
  tampilkanListWisata(p);

  // $(window).scroll(function() {
  //   if($(window).scrollTop() + $(window).height() == $(document).height()) {
  //     p++;
  //     tampilkanListWisata(p);
  //   }
  // });

  $("#btn_loadmore").click(function(){
    p++;
    tampilkanListWisata(p);
  });

});
