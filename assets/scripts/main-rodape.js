function listenerBotaoEmailNewsletter()
{
    var email = document.querySelector('.textoCadastroEmail').value;

    var emailRegexp = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/i;

    var emailInputContainer = document.querySelector('.cadastroEmailInput');

    var containerMensagemRetorno = document.querySelector('.retornoCadastro');

    console.log(email, emailRegexp.test(email));

    if(!email || !emailRegexp.test(email))
    {
        emailInputContainer.classList.add('invalidEmailInput');
        containerMensagemRetorno.classList.remove('semRetorno');
        containerMensagemRetorno.textContent = 'Favor informe um email válido';
    }
    else
    {
        emailInputContainer.classList.remove('invalidEmailInput');
        var email = document.getElementById("email").value;
        var URL = `${window.location.protocol}//${window.location.host.split(':')[0]}/amazonia-legal/app/controllers/contactformcontroller.php?email=${email}`;

        var codigoSucesso = 200;

        fetch(URL, {method: 'post'})
        .then(res => res.status)
        .then(codigoResposta => {
            if(codigoResposta == codigoSucesso)
            {
              
                        emailInputContainer.classList.remove('invalidEmailInput');
            containerMensagemRetorno.classList.remove('semRetorno');
            containerMensagemRetorno.textContent = 'Email cadastrado com sucesso!';

            setTimeout(() => {
                 containerMensagemRetorno.classList.add('semRetorno');
            }, 3000);
                
            }
            else
            {
                emailInputContainer.classList.add('invalidEmailInput');
                containerMensagemRetorno.classList.remove('semRetorno');
                containerMensagemRetorno.textContent = 'Erro no envio';
            }
        });
    }
}

function mainRodape()
{
    document.querySelector('.envioCadastroEmail')
    .addEventListener('click',listenerBotaoEmailNewsletter);
}

(() => 
{
    mainRodape();
})()