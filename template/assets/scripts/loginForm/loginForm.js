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

function validaFormularioLogin()
{ 
  const CLASSE_INPUT_INVALIDO = 'invalidInput';
  const VALORES = {};
  const CAMPOS_PREENCHIDOS = [...document.querySelectorAll('.loginFormField')]
                            .reduce((acc, field) => {
                              const CAMPO_PREENCHIDO = (field.value.length > 0);
                              if(!CAMPO_PREENCHIDO) field.classList.add(CLASSE_INPUT_INVALIDO);
                              else field.classList.remove(CLASSE_INPUT_INVALIDO);
                              VALORES[field.classList.item(0)] = field.value;
                              return acc & CAMPO_PREENCHIDO;
                            }, true);

  var emailRegexp = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/i;
  const CAMPO_EMAIL = document.querySelector('.loginFormFields .email')    
  const EMAIL_VALIDO = emailRegexp.test(CAMPO_EMAIL.value);

  if(!EMAIL_VALIDO) CAMPO_EMAIL.classList.add(CLASSE_INPUT_INVALIDO);
  else CAMPO_EMAIL.classList.remove(CLASSE_INPUT_INVALIDO);

  return CAMPOS_PREENCHIDOS && EMAIL_VALIDO ? VALORES: false;
}

function enviaFormularioLogin()
{
  let retornoValidacao = validaFormularioLogin();

  console.log("retorno",retornoValidacao);
  if(retornoValidacao)
  {
    // document.querySelector('.loginFormRequestResponse').textContent = 'Login realizado!';
    //setTimeout(fecharModalLogin, 3000);
    jQuery.noConflict();

    jQuery(document).ready(function($) {
      
      $.post("../app/controllers/logincontroller.php",retornoValidacao, function(data){
        if (data === "Usuário logado"){
          location.reload();
        }else{
          document.querySelector('.loginFormRequestResponse').textContent = data;
        }
      })
      .done({type:"POST",url:"../app/controllers/logincontroller.php", data: retornoValidacao}).done(function (data) {  })
      .fail(function (jqXHR, textStatus, errorThrown) {  });
     
    });  
  }
}

function criarInteracoesLogin()
{
    document.querySelector('.loginModalCloseIcon')
    .addEventListener('click', fecharModalLogin);

    document.querySelector('.loginFormSendButton')
    .addEventListener('click', enviaFormularioLogin);

    document.querySelector('.loginRecoverPass')
    .addEventListener('click', abreEnviarCodigoSegurancaEmail);

    document.querySelector('.loginRecoverPass')
    .addEventListener('click', fecharModalLogin);

    let botaoAbrirModal = document.querySelector('.openLoginDialog');

    botaoAbrirModal
    .addEventListener('click', abreModalLogin);

    let botaoAbrirModal2 = document.querySelector('.loginRecoverPass');

    botaoAbrirModal2
    .addEventListener('click', fecharModalLogin);

}

function abreRecuperarSenha(){
  document.querySelector(".recuperarSenhaModalWrapper").classList.remove('hiddenrecuperarSenhaModal');
  document.querySelector(".recuperarSenhaModal").classList.remove('hiddenrecuperarSenhaModal');
}

function abreEnviarCodigoSegurancaEmail(){
  document.querySelector(".codigoSegurancaModalWrapper").classList.remove('hiddencodigoSegurancaModal');
  document.querySelector(".codigoSegurancaModal").classList.remove('hiddencodigoSegurancaModal');
}

function criarGrupoDeCamposLogin(container, listaDeCampos)
{
  let fieldsGroup = document.createElement('section');
  fieldsGroup.classList.add('fieldsGroup');

  listaDeCampos.forEach(c => {
      let tituloCampo = document.createElement('h6');
      tituloCampo.textContent = c.title;
      tituloCampo.classList.add('loginFormFieldTitle');

      let campo = document.createElement('input');
      campo.setAttribute('type', c.type);
      campo.classList.add(c.class, 'loginFormField');

      fieldsGroup.appendChild(tituloCampo);
      fieldsGroup.appendChild(campo);
  });

  container.appendChild(fieldsGroup);
}

function criarCamposLogin()
{
  const CONTAINER = document.querySelector('.loginFormFields');
    let gruposDeCampos = {
      'contato': [{title: 'E-mail', class: 'email', type: 'email'}, {title: 'Senha', class: 'senha', type: 'password'}]
    }

    Object.keys(gruposDeCampos).forEach(g => criarGrupoDeCamposLogin(CONTAINER, gruposDeCampos[g]));
}

(() => {
  criarInteracoesLogin();
  criarCamposLogin();
})()