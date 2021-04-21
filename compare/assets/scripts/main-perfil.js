  jQuery.noConflict();

  function salvarCookie(chave, valor, duracaoEmDias)
  {
    var dataExpiracao = '';

    if(duracaoEmDias)
    {
      var dataAtual = new Date();

      var HORAS_EM_UM_DIA = 24, MINUTOS_EM_UMA_HORA = 60, SEGUNDOS_EM_UM_MINUTO = 60, MILISSEGUNDOS_EM_UM_SEGUNDO = 1000;
      dataAtual.setTime(dataAtual.getTime() + (duracaoEmDias*HORAS_EM_UM_DIA*MINUTOS_EM_UMA_HORA*SEGUNDOS_EM_UM_MINUTO*MILISSEGUNDOS_EM_UM_SEGUNDO));

      dataExpiracao = `; expires=${dataAtual.toUTCString()}`;
    }

    document.cookie = `${chave}=${(valor || '')}${dataExpiracao}; path=/`;
  }

  function recuperarCookie(chave)
  {
    var cookies = document.cookie.split(';');

    for(var i = 0; i < cookies.length; i++)
    {
      var cookie = cookies[i];

      var textoLimpo = cookie.trim();

      if(textoLimpo.indexOf(chave) == 0) return textoLimpo.substring(chave.length+1, textoLimpo.length);
    }

    return null;
  }

  function criaModalContato()
  {
    var chaveCookie = 'MODAL_EXIBIDO';
    if(!recuperarCookie(chaveCookie))
    {
      salvarCookie(chaveCookie, true);
      document.querySelector(".surveyModalWrapper").classList.remove('hiddenSurveyModal');
      document.querySelector(".surveyModal").classList.remove('hiddenSurveyModal');
    }
  }

  function fecharModalContato()
  {
    document.querySelector(".surveyModalWrapper").classList.add('hiddenSurveyModal');
    document.querySelector(".surveyModal").classList.add('hiddenSurveyModal');
  }

  function botaoGestaoPublica(event)
  {
      if(!event.target.classList.contains('inactiveButton'))
      {
        document.querySelector('.sendButton').classList.remove('hiddenButton');
        document.querySelector('.surveyModalPublicManagement').classList.add('activeSection');
        document.querySelector('.surveyModalPublicManagement').classList.remove('hiddenSection');
        document.querySelector('.surveyModalPrivateManagement').classList.add('hiddenSection');
        document.querySelector('.surveyModalPrivateManagement').classList.remove('activeSection');
        document.querySelector('.negateButton').classList.add('inactiveButton');
      } 
  }

  function botaoGestaoPrivada(event)
  {
    if(!event.target.classList.contains('inactiveButton'))
    {
      document.querySelector('.sendButton').classList.remove('hiddenButton');
      document.querySelector('.surveyModalPublicManagement').classList.add('hiddenSection');
      document.querySelector('.surveyModalPublicManagement').classList.remove('activeSection');
      document.querySelector('.surveyModalPrivateManagement').classList.remove('hiddenSection');
      document.querySelector('.surveyModalPrivateManagement').classList.add('activeSection');
      document.querySelector('.confirmButton').classList.add('inactiveButton');
    }
  }

  function mostrarOpcoes(event)
  {
    var container = event.target.parentNode;
    container.parentNode.querySelector('.options').classList.remove('hiddenOptions');
    container.querySelector('.hideOptions').classList.remove('hiddenIcon');
    event.target.classList.add('hiddenIcon');
  }

  function esconderOpcoes(event)
  {
    var container = event.target.parentNode;
    container.parentNode.querySelector('.options').classList.add('hiddenOptions');
    container.querySelector('.showOptions').classList.remove('hiddenIcon');
    event.target.classList.add('hiddenIcon');
  }

  function selecionaOpcao(event) 
  {
    var elemento = event.target;
    if (elemento.checked) 
    {
      var stringBusca = "input[type=checkbox][name='" + elemento.getAttribute("name") + "']";
      
      [...document.querySelectorAll(stringBusca)].forEach(el => el.checked = false);
      elemento.checked = true;
      elemento.parentNode.parentNode.parentNode.querySelector('.sectionValue').innerText = elemento.parentNode.innerText.trim();
    } 
    else 
    {
      elemento.checked = false;
    }

  }

  function coletaDadosFormulario()
  {
    /**
     * TODO: deixar genérico para um número indefinido de secções
     */

    var seccao = document.querySelector('.activeSection');
    
    var ehSeccaoGestaoPublica = ([...seccao.classList].filter(c => c === 'surveyModalPublicManagement').length > 0);

    var seccaoOcupacao = seccao.querySelector('.occupationSelect');
    var seccaoEstado = seccao.querySelector('.stateSelect');

    var ocupacao = [...seccaoOcupacao.querySelectorAll('[type=checkbox]')].filter(o => o.checked)[0];
    var estado = [...seccaoEstado.querySelectorAll('[type=checkbox]')].filter(o => o.checked)[0];

    ocupacao = ocupacao ? ocupacao.value : undefined;
    estado = estado ? estado.value : undefined;    

    if(!estado) seccaoEstado.classList.add('invalidInput');
    else seccaoEstado.classList.remove('invalidInput');
    if(!ocupacao) seccaoOcupacao.classList.add('invalidInput');
    else seccaoOcupacao.classList.remove('invalidInput');

    var tipoGestao = ehSeccaoGestaoPublica ? 'publica' : 'privada';

    return {tipoGestao, ocupacao, estado};
  }

  function enviarFormulario()
  {
    var {tipoGestao, ocupacao, estado} = coletaDadosFormulario();

    if(tipoGestao && ocupacao && estado)
    {
      var URL = `${window.location.protocol}//${window.location.host.split(':')[0]}/amazonia-legal/app/controllers/contactmodalcontroller.php?tipogestao=${tipoGestao}&ocupacao=${ocupacao}&estado=${estado}`;
 
      var codigoSucesso = 200;

      fetch(URL, {method: 'post'})
      .then(res => res.status)
      .then(statusCode => {
        var mensagemResposta = 'Erro no envio!';
        if(statusCode == codigoSucesso)
        {
          mensagemResposta = 'Enviado. Obrigado por responder!';

          setTimeout(fecharModalContato, 2000);
        }
        var containerMensagem = document.querySelector('.requestResponse');
        containerMensagem.classList.remove('hiddenResponse');
        containerMensagem.textContent = mensagemResposta;
      });
    }
  }

   jQuery(document).ready(function($) {

     	var optLabel;
      var optgroupsArea = $('#opt_area > optgroup');
     	var optgroupsIndicador = $('#opt_indicador > optgroup');
      var optoptionsIndicador = $('#opt_indicador > optgroup > option');
      var optoptionsArea = $('#opt_area > optgroup > option');
      var optregiao_original = $('#opt_regiao').clone();
      var optindicador_original = $('#opt_indicador').clone();  
      var optarea_original = $('#opt_area').clone();
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

      function feedTheFilters(){ // alimenta os filtros a cada recarregamento da página
        var url_path = window.location;
        var url_parts = String(url_path).split("?");
        var url_parts1 = String(url_parts[1]).split("&");
        var url_parts2 = String(url_parts1[0]).split("=");
        var regiao = decodeURIComponent(url_parts2[1]);
        console.log("regiao: "+ decodeURIComponent(url_parts2[1]) );
        var url_parts11 = String(url_parts1[1]).split("=");
        console.log("segunda regiao: "+ decodeURIComponent(url_parts11[1]) );
        $('#opt_area').html(optoptionsArea.filter('[data-region$="'+regiao+'"]'));
        var area = decodeURIComponent(url_parts11[1])
        $('#opt_indicador').html(optgroupsIndicador.filter('[label="'+area+'"]'));
        var url_parts12 = String(url_parts1[2]).split("=");
        console.log("área: "+ decodeURIComponent(url_parts12[1]));
        var url_parts12_1 = String(url_parts12).split("__");
        console.log("group_id: "+ decodeURIComponent(url_parts12_1[1]) );
        var url_parts13_1 = String(url_parts1[3]).split("=");
        console.log("indicador: "+ url_parts13_1[1]);

        $('#opt_indicador').html(optoptionsIndicador.filter('[value$="'+"__"+decodeURIComponent(url_parts12_1[1])+'"]'));
        $("#opt_regiao option[value^='Amazônia Legal']").remove();
        $("#opt_regiao2 option[value^='Amazônia Legal']").remove();
        $('#opt_regiao').val(regiao);
        $('#opt_regiao2').val(decodeURIComponent(url_parts11[1]));
        
        $("#opt_area").html($("#opt_area option").sort(function (a, b) {
          return a.text == b.text ? 0 : a.text < b.text ? -1 : 1
        }))

        $("#opt_indicador").html($("#opt_indicador option").sort(function (a, b) {
          return a.text == b.text ? 0 : a.text < b.text ? -1 : 1
        }))

        $('#opt_indicador').val(decodeURIComponent(url_parts13_1[1]));
        $('#opt_indicador').val(decodeURIComponent(url_parts13_1[1])).prop('selected', true);
        $('#opt_area').val(decodeURIComponent(url_parts12[1])).prop('selected', true);
        $('#opt_area').val(decodeURIComponent(url_parts12[1]));
        console.log("primeiro?"+String(url_parts1[3]));

     }   

      feedTheFilters(); // alimenta os selects via get da página quando carrega
    
      function getAreaRegiaoID(area, regiao){
          var area = area.split("_");
          var dat0 = getCsv("../assets/csv/filtro_consulta_cross_join.csv",
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
            document.getElementById("opt_area").value = area + "__" + data[0].id;
             document.getElementById("group_id").value = data[0].id;   
          });
      };

  		$("#opt_regiao").on("change",function(){

  			  $('#opt_indicador').html(optindicador_original.html());
          $('#opt_area').html(optarea_original.html());
          selectedVal = this.value;
          console.log("opt_regiao: " + selectedVal);
          $(this).attr('selected','selected');
          //$('#opt_area').html(optgroupsArea.filter('[label="'+selectedVal+'"]'));
          $('#opt_area').html(optoptionsArea.filter('[data-region$="'+selectedVal+'"]'));
          console.log("opt_area: " + selectedVal); 
          getAreaRegiaoID(String($("#opt_area").val()),String(this.value)); 

          $("#opt_area").html($("#opt_area option").sort(function (a, b) {
            return a.text == b.text ? 0 : a.text < b.text ? -1 : 1
          }))

          setTimeout(function(){ 
            console.log("group_id: " +document.getElementById("group_id").value); 
            console.log("group_id: " +$("input[name^='group_id']").val()); 
            console.log("group_id: " +$("#group_id").val()); 
            $('#opt_indicador').html(optoptionsIndicador.filter('[value$="'+"__"+$("input[name^='group_id'").val()+'"]'));

          }, 60);

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
            $('#opt_indicador').html(optoptionsIndicador.filter('[value$="'+"__"+$("input[name^='group_id'").val()+'"]'));

          }, 50);
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

      setTimeout(criaModalContato, 500);

      $('.confirmButton').click(botaoGestaoPublica);
      $('.negateButton').click(botaoGestaoPrivada);

      $('.surveyModal input:checkbox').prop("checked", false);

      $(".surveyModalCloseIcon").click(fecharModalContato);
      $(".sendButton").click(enviarFormulario);
      $(".surveyModalDisplayIcon").click(mostrarOpcoes);
      $('.hideOptions').click(esconderOpcoes);
      $('.showOptions').click(mostrarOpcoes);
      $('.option').click(selecionaOpcao);
	 });       