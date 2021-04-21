  jQuery.noConflict();

   jQuery(document).ready(function($) {

      var e=document.querySelectorAll('option')
      e.forEach(x=>{
      if(x.textContent.length>70)
      x.textContent=x.textContent.substring(0,70)+'...';
      })

      $(".app-container").addClass("closed-sidebar");

	 });       