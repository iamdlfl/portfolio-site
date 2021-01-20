$(".tabs").tabs();
$(".resizable").resizable();

$(document).ready(function() {
  $.ajax("opencvproject.txt").done(function(data) {
    $("#tab2").text(data);
  }).fail(function() {
    alert("Could not get data");
  });
});
$(document).ready(function() {
  $.ajax("movie_functions.txt").done(function(data) {
    $("#tab5").text(data);
  }).fail(function() {
    alert("Could not get data");
  });
});
$(document).ready(function() {
  $.ajax("logon.txt").done(function(data) {
    $("#tab4").text(data);
  }).fail(function() {
    alert("Could not get data");
  });
});
