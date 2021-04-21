  jQuery.noConflict();

   jQuery(document).ready(function($) {

	    $(".app-container").addClass("closed-sidebar");

	    var url_path = window.location;
        var url_parts = String(url_path).split("?");

        if (url_parts[1] == "updated"){ $("#text-sucess1").html("Dados atualizados com sucesso.");}

      document.querySelectorAll('a[href^="#"]').forEach(anchor => {
          anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
          });
      });  

      if (document.querySelector('.form-check-input').value = "S"){
        $(this).attr("checked", "checked");
      }
 	});       