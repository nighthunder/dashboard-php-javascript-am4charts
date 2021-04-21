function abreModalCadastro()
{    
  document.querySelector(".registerModalWrapper").classList.remove('hiddenRegisterModal');
  document.querySelector(".registerModal").classList.remove('hiddenRegisterModal');
}

function fecharModalCadastro()
{
  document.querySelector(".registerModalWrapper").classList.add('hiddenRegisterModal');
  document.querySelector(".registerModal").classList.add('hiddenRegisterModal');
}

function validaFormularioCadastro()
{ 
  const CLASSE_INPUT_INVALIDO = 'invalidInput';
  const VALORES = {};
  const CAMPOS_PREENCHIDOS = [...document.querySelectorAll('.required')]
                            .reduce((acc, field) => {
                              const CAMPO_PREENCHIDO = (field.value.length > 0);
                              if(!CAMPO_PREENCHIDO) field.classList.add(CLASSE_INPUT_INVALIDO);
                              else field.classList.remove(CLASSE_INPUT_INVALIDO);
                              VALORES[field.classList.item(0)] = field.value;
                              return acc & CAMPO_PREENCHIDO;
                            }, true);


 console.log("valores", VALORES);    

  const CAMPO_SENHA = document.querySelector('.registerFormFields .senha'), CAMPO_CONFIRMACAO_SENHA = document.querySelector('.registerFormFields .confirmaSenha');
  const CAMPO_POLITICA_PRIVACIDADE = document.querySelector('.politicaPrivacidade .registerFormField ').checked;

  const SENHAS_IGUAIS = CAMPO_SENHA.value === CAMPO_CONFIRMACAO_SENHA.value &&  CAMPO_SENHA.value.length > 0;
  if(!SENHAS_IGUAIS) [CAMPO_SENHA, CAMPO_CONFIRMACAO_SENHA].forEach(c => c.classList.add(CLASSE_INPUT_INVALIDO));
  else [CAMPO_SENHA, CAMPO_CONFIRMACAO_SENHA].forEach(c => c.classList.remove(CLASSE_INPUT_INVALIDO));

  // var emailRegexp = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/i;
  // var emailRegexp = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
  // const CAMPO_EMAIL = document.querySelector('.registerFormFields .email')    
  // const EMAIL_VALIDO = emailRegexp.test(CAMPO_EMAIL.value);
  // if(!EMAIL_VALIDO) CAMPO_EMAIL.classList.add(CLASSE_INPUT_INVALIDO);
  // else CAMPO_EMAIL.classList.remove(CLASSE_INPUT_INVALIDO);
  EMAIL_VALIDO = true;

  // Incluir campos que não são requeridos 
  if (!document.querySelector('.politicaEmail .registerFormField').checked){ VALORES["politicaEmail"] = "N" }else{
    VALORES["politicaEmail"] = "S"; 
  }
  if (typeof VALORES["instituicao"] === 'undefined'){ VALORES["instituicao"] = ""; }
  if (typeof VALORES["cargo"] === 'undefined'){ VALORES["cargo"] = ""; }

  if (!CAMPOS_PREENCHIDOS) {document.querySelector('.registerFormRequestResponse').textContent = "Preencha os campos"; }
  else if (!SENHAS_IGUAIS) {document.querySelector('.registerFormRequestResponse').textContent = "As senhas não são iguais"; }
  else if (!CAMPO_POLITICA_PRIVACIDADE) {document.querySelector('.registerFormRequestResponse').textContent = "Marque a política de privacidade"; }

  return CAMPOS_PREENCHIDOS && SENHAS_IGUAIS && EMAIL_VALIDO && CAMPO_POLITICA_PRIVACIDADE ? VALORES: false;
}

function enviaFormularioCadastro()
{
  let retornoValidacao = validaFormularioCadastro();
  console.log("retornovalidacao", retornoValidacao) ;
  if(retornoValidacao)
  {
      console.log("retornovalidacao", retornoValidacao) ;
      jQuery.noConflict();

      jQuery(document).ready(function($) {
        
        $.post("../app/controllers/subscriptioncontroller.php",retornoValidacao, function( data){
          if (data === "Usuário criado"){
            location.reload();
          }else{
            document.querySelector('.registerFormRequestResponse').textContent = data;
          }
        })
        .done({type:"POST",url:"../app/controllers/subscriptioncontroller.php", data: retornoValidacao}).done(function (data) {  })
        .fail(function (jqXHR, textStatus, errorThrown) {  });
       
      });  
      //document.querySelector('.registerFormRequestResponse').textContent = 'Cadastro realizado!';
      // setTimeout(fecharModalCadastro, 3000);
  }
}

function criarInteracoesCadastro()
{
    document.querySelector('.registerModalCloseIcon')
    .addEventListener('click', fecharModalCadastro);

    document.querySelector('.registerFormSendButton')
    .addEventListener('click', enviaFormularioCadastro);

    let botaoAbrirModal = document.querySelector('.openRegisterDialog');

    botaoAbrirModal
    .addEventListener('click', abreModalCadastro);
}

function criarGrupoDeCamposCadastro(container, listaDeCampos)
{
  let fieldsGroup = document.createElement('section');
  fieldsGroup.classList.add('fieldsGroup');

  listaDeCampos.forEach(c => {
      let tituloCampo = document.createElement('h6');
      tituloCampo.textContent = c.title;
      tituloCampo.classList.add('registerFormFieldTitle');
      tituloCampo.classList.add(c.type);

      if (c.type !== "select"){
        let campo = document.createElement('input');
        campo.setAttribute('type', c.type);
        campo.classList.add(c.class, 'registerFormField');
        if (c.required === "yes"){ campo.classList.add(c.class, 'required'); }

        if (c.type === "checkbox"){
          let container = document.createElement('div');
          container.classList.add(c.class);
          container.appendChild(campo);
          
          if (c.class === "politicaPrivacidade" ){
            let privacidadeLink =  document.createElement('a');
            privacidadeLink.title = "Ver o link completo";
            privacidadeLink.href = "../assets/pdf/LGPD.pdf";
            privacidadeLink.setAttribute("target", "_blank");
            privacidadeLink.classList.add("registerFormFieldTitle", c.type);
            privacidadeLink.appendChild(tituloCampo);
            container.appendChild(privacidadeLink);
            fieldsGroup.appendChild(container);
          }else{
            container.appendChild(tituloCampo);
            fieldsGroup.appendChild(container);
          }
        }else{
          fieldsGroup.appendChild(tituloCampo);
          fieldsGroup.appendChild(campo);
          
        }   
      }else{
        let campo = document.createElement('select');
        campo.classList.add(c.class, 'registerFormField');
        if (c.required === "yes"){ campo.classList.add(c.class, 'required'); }

        c.options.forEach( d =>{
          let option = document.createElement('option');
          option.value = option.textContent = d;
          campo.appendChild( option );
        });

        fieldsGroup.appendChild(tituloCampo);
        fieldsGroup.appendChild(campo);
      }

  });

  container.appendChild(fieldsGroup);
}

function criarCamposCadastro()
{
  const CONTAINER = document.querySelector('.registerFormFields');

    let atividades = [
      'Academia', 'Agropecuária', 'Comércio',  'Gestão pública', 'Indústria', 'Serviços', 'Terceiro setor',
    ];

    let estados = [
      'Acre', 'Alagoas', 'Amapá', 'Amazonas', 'Bahia', 'Ceará', 'Distrito Federal', 'Espírito Santo', 'Goiás',
      'Maranhão', 'Mato Grosso', 'Mato Grosso do Sul', 'Minas Gerais', 'Pará', 'Paraíba', ' Paraná', 'Pernambuco',
      'Piauí', 'Rio de Janeiro', 'Rio Grande do Norte', 'Rio Grande do Sul', 'Rondônia', 'Roraima', 'Santa Catarina',
      'São Paulo', 'Sergipe', 'Tocantins'
    ];
    
    let gruposDeCampos = {
      'contato': [{title: 'Nome Completo', class: 'nomeCompleto', type: 'text', required: 'yes'}, {title: 'E-mail', class: 'email', type: 'email', required: 'yes'},],
      'instituicao': [{title: 'Atividade', class: 'atividade', type: 'select', options: atividades, required: 'yes'}, {title: 'Instituição', class: 'instituicao', type: 'text', required: 'no'}, {title: 'Cargo', class: 'cargo', type: 'text', required: 'no'}],
      'cidade': [{title: 'Estado', class: 'estado', type: 'select', options: estados, required: 'yes'}, {title: 'Município', class: 'municipio', type: 'text', required: 'yes'},],
      'senha': [{title: 'Senha', class: 'senha', type: 'password', required: 'yes'}, {title: 'Confirmar Senha', class: 'confirmaSenha', type: 'password', required: 'yes'},{title: 'Aceito receber novidades por e-mail', class: 'politicaEmail', type: 'checkbox', required: 'no'},{title: 'Concordo com a política de Privacidade', class: 'politicaPrivacidade', type: 'checkbox', required: 'yes'}],
    }

 

    Object.keys(gruposDeCampos).forEach(g => criarGrupoDeCamposCadastro(CONTAINER, gruposDeCampos[g]));
}

(() => {
  criarInteracoesCadastro();
  criarCamposCadastro();
})()