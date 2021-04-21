  // jQuery.noConflict();

   jQuery(document).ready(function($) {

     	var optLabel;

     	var optgroupsArea = $('#opt_area > optgroup');
      var optoptionsArea = $('#opt_area > optgroup option');
     	var optgroupsIndicador = $('#opt_indicador > optgroup');
      var optoptionsIndicador = $('#opt_indicador > optgroup > option');

      var e=document.querySelectorAll('option')
      e.forEach(x=>{
      if(x.textContent.length>70)
      x.textContent=x.textContent.substring(0,70)+'...';
      })

      document.querySelectorAll('a[href^="#"]').forEach(anchor => {
          anchor.addEventListener('click', function (e) {
                e.preventDefault();

                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
          });
      });

     	var optregiao_original = $('#opt_regiao').clone(); // salva uma cópia 
     	var optindicador_original = $('#opt_indicador').clone(); // salva uma cópia 
      var optarea_original = $('#opt_area').clone(); // salva uma cópia 

      function feedTheFilters(){ // alimenta os filtros a cada envio
        var url_path = window.location;

        var url_parts = String(url_path).split("?");

        var url_parts1 = String(url_parts[1]).split("&");

        var url_parts2 = String(url_parts1[0]).split("=");

        var regiao = decodeURIComponent(url_parts2[1]);

        console.log("regiao: "+ decodeURIComponent(url_parts2[1]) );

        var url_parts11 = String(url_parts1[1]).split("=");

        console.log("area: "+ decodeURIComponent(url_parts11[1]) );

        $('#opt_area').html(optgroupsArea.filter('[label="'+regiao+'"]'));

        var area = decodeURIComponent(url_parts11[1])

        $('#opt_indicador').html(optgroupsIndicador.filter('[label="'+area+'"]'));

        var url_parts12 = String(url_parts1[2]).split("=");

        console.log("indicador: "+ decodeURIComponent(url_parts12[1]));

        var url_parts12_1 = String(url_parts12).split("__");

        console.log("group_id: "+ decodeURIComponent(url_parts12_1[1]) );
        console.log("group_id: "+ area);

        $('#opt_indicador').html(optoptionsIndicador.filter('[value$="'+"__"+decodeURIComponent(url_parts12_1[1])+'"]'));

        //if (typeof(url_parts1[3]) === "undefined"){
         
        //$('#opt_area').val(decodeURIComponent(url_parts11[1])).prop('selected', true);
        $('#opt_regiao').val(regiao);
        $('#opt_indicador').val(url_parts12[1]).prop('selected', true);
        $('#opt_indicador').val(decodeURIComponent(url_parts12[1]));
        $('#opt_area').val(area);
        
        // var opt_area =  $('#opt_area').clone();

        // //opt_area.find("optgroup").remove();
        // optoptionsArea.each(function()
        // {
        //     opt_area.append($(this));
        // });

        // $('#opt_area').html(opt_area.html());

        if (url_parts1[3] === String("primeiro")){ // se é a primeiro acesso a página
          console.log("primeiro?"+String(url_parts1[3]));
          $("#opt_regiao option[value*='Recorte'").prop('selected', true);
          $("#opt_area optgroup option[value*='Área'").prop('selected', true);
          var o = new Option("Indicador", "Indicador");
          /// jquerify the DOM object 'o' so we can use the html method
          $(o).html("Indicador").attr('disabled','disabled');
          $("#opt_indicador").prepend(o);
          $("#opt_indicador option:first-child").prop('selected', true);
          $("#opt_indicador optgroup option[value*='Indicador'").prop('selected', true);

        }  
     }   

      feedTheFilters(); // alimenta os selects via get da página quando carrega

     	// $('#opt_area').html(optgroupsIndicador.filter('[label="Amazônia Legal"]'));
      // optLabel = optgroupsIndicador.filter('[label="Amazônia Legal"]');
      // optLabel.children('option:eq(0)').prop('selected', true);
      // optLabel.children('option:eq(1)').prop('selected', true);
      
      function getAreaRegiaoID(area, regiao){
          var area = area.split("_");
          var dat0 = getCsv("http://localhost/amazonia-legal//assets/csv/filtro_consulta_cross_join.csv",
                            area[0], regiao); 
      }    

      function getCsv(filepath, area, regiao) {

          $('#grupo_id').val("50");
          var data;
          d3.csv(filepath, function (error, dict){
            console.log("file", filepath);
            console.log("area", area);
            console.log("regiao", regiao);
            console.log("dict", dict);
            data = dict.filter(function (i,n){
              //console.log("i", i); 
              return (i.area == area && i.regiao == regiao) ;  
              
            });  
            //console.log("data", data[0].id);
             document.getElementById("group_id").value = data[0].id; 
               
          });
 
      };


  		$("#opt_regiao").on("change",function(){

  			  $('#opt_indicador').html(optindicador_original.html());
          selectedVal = this.value;

          console.log("opt_regiao: " + selectedVal);

          $(this).attr('selected','selected');

          $('#opt_area').html(optgroupsArea.filter('[label="'+selectedVal+'"]'));

          console.log("opt_area: " + selectedVal); 

          getAreaRegiaoID(String($("#opt_area").val()),String(this.value)); 

          setTimeout(function(){ 

          console.log("group_id: " +document.getElementById("group_id").value); 
          console.log("group_id: " +$("input[name^='group_id']").val()); 
          console.log("group_id: " +$("#group_id").val()); 

          //$('#opt_indicador').html(optoptionsIndicador.filter('[value$="'+"__"+$("input[name='group_id'").val()+'"]'));

          }, 60);

          $(this).children("option:first-child").remove();

        
          //filterIndicadorRegiao(this.value);
      });

  		$("#opt_area").on("change",function(){

  			 
          selectedVal = this.value;

          console.log("opt_area: " + selectedVal);

          console.log("opt_rigion: " + String($('#opt_regiao').val().toLowerCase()));

           
          getAreaRegiaoID(String($(this).val()),String($("#opt_regiao").val())); 

          setTimeout(function(){ 

            console.log("group_id: " +document.getElementById("group_id").value); 
            console.log("group_id: " +$("input[name^='group_id']").val()); 
            console.log("group_id: " +$("#group_id").val()); 

            $('#opt_indicador').html(optindicador_original.html());

            $('#opt_indicador').html(optoptionsIndicador.filter('[value$="'+"__"+$("input[name='group_id'").val()+'"]'));

            }, 60);

       
      });

      $(".card-body2").hide();

      $(".fas.fa-angle-down").click(function(){
          $(this).parent().find(".card-body.card-body2").toggle("slow", function(){
            $(this).toggleClass("opened");
          });

      });


      // Solução para o problema dos gráficos do Plotly que expremem a lgenda quando estão em abas

      $("a.nav-link").on("click",function(){ // esse é o link de uma aba

        var $id_grafico_atual = $(this).attr("href").slice(1);

        var $pai = $('#'+$id_grafico_atual).parent().clone();

        $('#'+$id_grafico_atual).parent().html($pai);

        console.log($id_grafico_atual+"sad2");
        console.log($(this).attr("href")+"sad3");
     
      });  

      $(".app-container").addClass("closed-sidebar");
	 });       