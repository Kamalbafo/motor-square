
$(document).ready(function(){
    $("#mainSearchBike").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#mainBikeTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });

    $("#mainSearchJob").on("keyup", function() {
      console.log("working....");
      var value = $(this).val().toLowerCase();
      $("#mainJobTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });



  });
