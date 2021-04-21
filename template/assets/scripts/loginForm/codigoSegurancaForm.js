function abreModalcodigoSeguranca()
{    
  document.querySelector(".codigoSegurancaModalWrapper").classList.remove('codigoSegurancaModal');
  document.querySelector(".codigoSegurancaModal").classList.remove('codigoSegurancaModal');
}

function fecharModalcodigoSeguranca()
{
  document.querySelector(".codigoSegurancaModalWrapper").classList.add('hiddencodigoSegurancaModal');
  document.querySelector(".codigoSegurancaModal").classList.add('hiddencodigoSegurancaModal');
}

function abreModalLogin()
{    
  document.querySelector(".loginModalWrapper").classList.remove('hiddenLoginModal');
  document.querySelector(".loginModal").classList.remove('hiddenLoginModal');
}

function fecharModalLogin()
{
  document.querySelector(".loginModalWrapper").classList.add('hiddenLoginModal');
  document.querySelector(".loginModal").classList.add('hiddenLoginModal');
}


function abreModalRecuperarSenha()
{    
  document.querySelector(".recuperarSenhaModalWrapper").classList.remove('hiddenrecuperarSenhaModal');
  document.querySelector(".recuperarSenhaModal").classList.remove('hiddenrecuperarSenhaModal');
}

function fecharModalRecuperarSenha()
{
  document.querySelector(".recuperarSenhaModalWrapper").classList.add('hiddenrecuperarSenhaModal');
  document.querySelector(".recuperarSenhaModal").classList.add('hiddenrecuperarSenhaModal');
}

function validaFormulariocodigoSeguranca()
{ 
    const CLASSE_INPUT_INVALIDO = 'invalidInput';
    const VALORES = {};
    const CAMPOS_PREENCHIDOS = [...document.querySelectorAll('.codigoSegurancaFormField')]
                              .reduce((acc, field) => {
                                const CAMPO_PREENCHIDO = (field.value.length > 0);
                                if(!CAMPO_PREENCHIDO) field.classList.add(CLASSE_INPUT_INVALIDO);
                                else field.classList.remove(CLASSE_INPUT_INVALIDO);
                                VALORES[field.classList.item(0)] = field.value;
                                return acc & CAMPO_PREENCHIDO;
                              }, true);
  
  
   console.log("valores", VALORES);    
    
    return CAMPOS_PREENCHIDOS ? VALORES: false;
}

function enviaFormulariocodigoSeguranca()
{
  let retornoValidacao = validaFormulariocodigoSeguranca();

  console.log("retorno",retornoValidacao);
  if(retornoValidacao)
  {
    console.log("retorno",retornoValidacao);
    // document.querySelector('.codigoSegurancaFormRequestResponse').textContent = 'Login realizado!';
    //setTimeout(fecharModalLogin, 3000);
    jQuery.noConflict();

    jQuery(document).ready(function($) {
      
      $.get("../app/controllers/enviacodeemail.php",retornoValidacao, function( data){
        if (data === "Código de segurança enviado por email"){
          //location.reload();
          document.querySelector('.codigoSegurancaFormRequestResponse').textContent = data;
          //fecharModalcodigoSeguranca(); 
          // fecharModalLogin(); 
          //abreModalRecuperarSenha();
          setTimeout(function(){ fecharModalcodigoSeguranca(); abreModalRecuperarSenha(); }, 2000);
        }else{
          document.querySelector('.codigoSegurancaFormRequestResponse').textContent = data;
        }
        
      })
      .done({type:"GET",url:"../app/controllers/enviacodeemail.php", data: retornoValidacao}).done(function (data) {  })
      .fail(function (jqXHR, textStatus, errorThrown) {  });
      
     
    });  
  }
}

function criarInteracoescodigoSeguranca()
{
    document.querySelector('.codigoSegurancaModalCloseIcon')
    .addEventListener('click', fecharModalcodigoSeguranca);

    document.querySelector('.codigoSegurancaFormSendButton')
    .addEventListener('click', enviaFormulariocodigoSeguranca);

    document.querySelector('.voltarLogin')
    .addEventListener('click', fecharModalcodigoSeguranca);

    document.querySelector('.voltarLogin')
    .addEventListener('click', abreModalLogin);
}

function criarGrupoDeCamposcodigoSeguranca(container, listaDeCampos)
{
  let fieldsGroup = document.createElement('section');
  fieldsGroup.classList.add('fieldsGroup');

  listaDeCampos.forEach(c => {
      let tituloCampo = document.createElement('h6');
      tituloCampo.textContent = c.title;
      tituloCampo.classList.add('codigoSegurancaFormFieldTitle');

      let campo = document.createElement('input');
      campo.setAttribute('type', c.type);
      campo.classList.add(c.class, 'codigoSegurancaFormField');

      fieldsGroup.appendChild(tituloCampo);
      fieldsGroup.appendChild(campo);
  });

  container.appendChild(fieldsGroup);
}

function criarCamposcodigoSeguranca()
{
  const CONTAINER = document.querySelector('.codigoSegurancaFormFields');
    let gruposDeCampos = {
      'contato': [{title: 'E-mail', class: 'email', type: 'email'}]
    }

    Object.keys(gruposDeCampos).forEach(g => criarGrupoDeCamposcodigoSeguranca(CONTAINER, gruposDeCampos[g]));
}

(() => {
  criarInteracoescodigoSeguranca();
  criarCamposcodigoSeguranca();
})()