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
      var optionsArea = $('#opt_area > optgroup > option');
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
      var optarea_original = $('#opt_area').clone(); // salva uma cópia 

      function feedTheFilters(){ // alimenta os filtros a cada recarregamento da página

        var url_path = window.location;
        var url_parts = String(url_path).split("?");
        var url_parts1 = String(url_parts[1]).split("&");
        var url_parts2 = String(url_parts1[0]).split("=");
        var regiao = decodeURIComponent(url_parts2[1]);
        regiao = regiao.replace("+"," ");
        console.log("regiao: "+ decodeURIComponent(regiao));
        var url_parts11 = String(url_parts1[1]).split("=");
        area = decodeURIComponent(url_parts11[1]);
        area = area.replace("+"," ");
        area = area.replace("+"," ");
        console.log("área: "+ area);
        $('#opt_area optgroup option').unwrap();
        $('#opt_area') 
          .children()
          .filter(function(){
              return $(this).data('region') !== regiao;
        })
          .hide();

        $('#opt_area').each(function() { // ordena o select
          var optgroup = this;
          $( 'option', this ).sort(function(a,b) {
           return $(a).text() > $(b).text();
          }).appendTo(optgroup);
        });

        $('#opt_area').prepend("<option data-region='"+decodeURIComponent(regiao)+"' value='todas'>Todas as áreas</option>");
        $('#opt_regiao').val(decodeURIComponent(regiao));
        $('#opt_regiao').val(regiao).prop('selected', true);
        $('#opt_area').val(decodeURIComponent(area));
        $('#opt_area').val(area).prop('selected', true);
        $('#opt_regiao option[value="Amazônia Legal"]').hide();
        $('#opt_area option[value="Demografia"]').hide();
        $('#opt_regiao').prepend('<option value="Amazônia Legal">Amazônia Legal</option>');
        console.log("primeiro?"+String(url_parts1[3]));

     }   

      feedTheFilters(); // alimenta os selects via get da página quando carrega
       
  		$("#opt_regiao").on("change",function(){

          $('#opt_area').html(optarea_original.html());
          selectedVal = this.value;
          console.log("opt_regiao: " + selectedVal);
          $(this).attr('selected','selected');
          $('#opt_area optgroup option').unwrap();
          $('#opt_area')
          .children()
          .filter(function(){
              return $(this).data('region') !== selectedVal;
          })
          .hide();

          console.log("opt_area: " + selectedVal); 

          if ($('#opt_area optgroup option[value="todas"]').length == 0){
              $('#opt_area optgroup[label="'+decodeURIComponent(selectedVal)+'"]').prepend("<option value='todas'>Todas as áreas</option>");
          }    

          $("#opt_area").each(function() {
            var optgroup = this;
            $( 'option', this ).sort(function(a,b) {
             return $(a).text() > $(b).text();
            }).appendTo(optgroup);
          }); 

          $('#opt_area').prepend("<option data-region='"+selectedVal+"' value='todas'>Todas as áreas</option>");
          $('#opt_area').val("todas").attr('selected','selected');
          $('#opt_area option[value="Demografia"]').hide();
      });
      
      $(".app-container").addClass("closed-sidebar");

      if(window.innerWidth >= 768 && window.innerWidth < 1367){
        console.log(window.innerWidth+"window");
        $(".app-container").addClass("closed-sidebar");
      }

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