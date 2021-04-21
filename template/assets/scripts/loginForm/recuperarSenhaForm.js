function abreModalRecuperarSenha()
{    
  document.querySelector(".recuperarSenhaModalWrapper").classList.remove('recuperarSenhaModal');
  document.querySelector(".recuperarSenhaModal").classList.remove('recuperarSenhaModal');
}

function fecharModalRecuperarSenha()
{
  document.querySelector(".recuperarSenhaModalWrapper").classList.add('hiddenrecuperarSenhaModal');
  document.querySelector(".recuperarSenhaModal").classList.add('hiddenrecuperarSenhaModal');
}

function abreModalLogin()
{    
  document.querySelector(".loginModalWrapper").classList.remove('hiddenLoginModal');
  document.querySelector(".loginModal").classList.remove('hiddenLoginModal');
}

function validaFormularioRecuperarSenha()
{ 
    const CLASSE_INPUT_INVALIDO = 'invalidInput';
    const VALORES = {};
    const CAMPOS_PREENCHIDOS = [...document.querySelectorAll('.recuperarSenhaFormField')]
                              .reduce((acc, field) => {
                                const CAMPO_PREENCHIDO = (field.value.length > 0);
                                if(!CAMPO_PREENCHIDO) field.classList.add(CLASSE_INPUT_INVALIDO);
                                else field.classList.remove(CLASSE_INPUT_INVALIDO);
                                VALORES[field.classList.item(0)] = field.value;
                                return acc & CAMPO_PREENCHIDO;
                              }, true);
  
  
   console.log("valores", VALORES);    
  
    const CAMPO_SENHA = document.querySelector('.recuperarSenhaFormFields .senha'), CAMPO_CONFIRMACAO_SENHA = document.querySelector('.recuperarSenhaFormFields .confirmaSenha');
  
    const SENHAS_IGUAIS = CAMPO_SENHA.value === CAMPO_CONFIRMACAO_SENHA.value &&  CAMPO_SENHA.value.length > 0;
    if(!SENHAS_IGUAIS) [CAMPO_SENHA, CAMPO_CONFIRMACAO_SENHA].forEach(c => c.classList.add(CLASSE_INPUT_INVALIDO));
    else [CAMPO_SENHA, CAMPO_CONFIRMACAO_SENHA].forEach(c => c.classList.remove(CLASSE_INPUT_INVALIDO));
  
    // var emailRegexp = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/i;
    // var emailRegexp = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    // const CAMPO_EMAIL = document.querySelector('.recuperarSenhaFormFields .email')    
    // const EMAIL_VALIDO = emailRegexp.test(CAMPO_EMAIL.value);
    // if(!EMAIL_VALIDO) CAMPO_EMAIL.classList.add(CLASSE_INPUT_INVALIDO);
    // else CAMPO_EMAIL.classList.remove(CLASSE_INPUT_INVALIDO);
    EMAIL_VALIDO = true;
  
    // Incluir campos que não são requeridos 
      if (!CAMPOS_PREENCHIDOS) {document.querySelector('.recuperarSenhaFormRequestResponse').textContent = "Preencha os campos"; }
    else if (!SENHAS_IGUAIS) {document.querySelector('.recuperarSenhaFormRequestResponse').textContent = "As senhas não são iguais"; }
  
    return CAMPOS_PREENCHIDOS && SENHAS_IGUAIS && EMAIL_VALIDO ? VALORES: false;
}

function enviaFormularioRecuperarSenha()
{
  let retornoValidacao = validaFormularioRecuperarSenha();

  console.log("retorno",retornoValidacao);
  if(retornoValidacao)
  {
    console.log("retorno",retornoValidacao);
    // document.querySelector('.recuperarSenhaFormRequestResponse').textContent = 'Login realizado!';
    //setTimeout(fecharModalLogin, 3000);
    jQuery.noConflict();

    jQuery(document).ready(function($) {
      
      $.get("../app/controllers/recuperarsenhacontroller.php",retornoValidacao, function( data){
        // if (data === "Senha alterada com sucesso"){
        //   //location.reload();
        // }else{
          
        // }
        document.querySelector('.recuperarSenhaFormRequestResponse').textContent = data;
      })
      .done({type:"GET",url:"../app/controllers/recuperarsenhacontroller.php", data: retornoValidacao}).done(function (data) {  })
      .fail(function (jqXHR, textStatus, errorThrown) {  });
      
     
    });  
  }
}

function criarInteracoesRecuperarSenha()
{
    document.querySelector('.recuperarSenhaModalCloseIcon')
    .addEventListener('click', fecharModalRecuperarSenha);

    document.querySelector('.recuperarSenhaFormSendButton')
    .addEventListener('click', enviaFormularioRecuperarSenha);

    document.querySelector('.linkLogin')
    .addEventListener('click', fecharModalRecuperarSenha);

    document.querySelector('.linkLogin')
    .addEventListener('click', abreModalLogin);
}

function criarGrupoDeCamposRecuperarSenha(container, listaDeCampos)
{
  let fieldsGroup = document.createElement('section');
  fieldsGroup.classList.add('fieldsGroup');

  listaDeCampos.forEach(c => {
      let tituloCampo = document.createElement('h6');
      tituloCampo.textContent = c.title;
      tituloCampo.classList.add('recuperarSenhaFormFieldTitle');

      let campo = document.createElement('input');
      campo.setAttribute('type', c.type);
      campo.classList.add(c.class, 'recuperarSenhaFormField');

      fieldsGroup.appendChild(tituloCampo);
      fieldsGroup.appendChild(campo);
  });

  container.appendChild(fieldsGroup);
}

function criarCamposRecuperarSenha()
{
  const CONTAINER = document.querySelector('.recuperarSenhaFormFields');
    let gruposDeCampos = {
      'contato': [{title: 'E-mail', class: 'email', type: 'email'}, {title: 'Código de segurança', class: 'code', type: 'text'}, {title: 'Senha', class: 'senha', type: 'password'}, {title: 'Confirmar Senha', class: 'confirmaSenha', type: 'password'}]
    }

    Object.keys(gruposDeCampos).forEach(g => criarGrupoDeCamposRecuperarSenha(CONTAINER, gruposDeCampos[g]));
}

(() => {
  criarInteracoesRecuperarSenha();
  criarCamposRecuperarSenha();
})()