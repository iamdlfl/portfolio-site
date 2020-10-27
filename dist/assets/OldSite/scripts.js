
      var hidden = true;
      var projectsshowing = false;
      var medivshowing = false;

      $("#mediv").draggable();

      $( function() {
        $("#mepic").draggable();
      });

      $( function() {
        $("#projectdiv").draggable();
      });

      $("#me").click(function() {
        if (!medivshowing) {
          $("#mediv").fadeIn();
          medivshowing = true;
        } else {
          $("#mediv").fadeOut();
          medivshowing = false;
        }
      });

      $("#project").click(function() {
        if (!projectsshowing) {
          $("#projectdiv").fadeIn();
          projectsshowing = true;
        } else {
          $("#projectdiv").fadeOut();
          projectsshowing = false;
        }
      });


      $(".sidebar").hover(function() {
        if ($(".sidebarcell").css("left") == "-145px") {
          hidden = true;
        }
        if (hidden == true) {
          $(".sidebarcell").animate({left:"0px"}, 150, function() {
            hidden = false;
          });
        }
      });


      $(".sidebar").mouseleave(function() {
        if ($(".sidebarcell").css("left") == "0px") {
          hidden = false;
        }
        if (hidden == false) {
          $(".sidebarcell").animate({left:"-145px"}, 100, function() {
            hidden = true;
          });
        }
      });

      $("body").mouseleave(function() {
        if ($(".sidebarcell").css("left") == "0px") {
          hidden = false;
        }
        if (hidden == false) {
          $(".sidebarcell").animate({left:"-145px"}, 100, function() {
            hidden = true;
          });
        }
      });
