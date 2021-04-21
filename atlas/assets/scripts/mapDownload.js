function realizarDownloadMapa()
{
    const QUERY_CANVAS_MAPA = '#map';

    const ELEMENTO_MAPA = document.querySelector(QUERY_CANVAS_MAPA).parentNode.parentNode;

    let criarDownload = canvas => {        
        var link = document.createElement('a');
        link.download = 'mapaAmazonia.png';
        link.href = canvas.toDataURL();
        link.click();
    }

    html2canvas(ELEMENTO_MAPA, {width: 1700, height: 628, y: 414}).then(criarDownload);
}

function criarEventos()
{
    const QUERY_BOTAO_DOWNLOAD = '.mapDownloadButton';
    const ELEMENTO_BOTAO = document.querySelector(QUERY_BOTAO_DOWNLOAD);

    ELEMENTO_BOTAO.addEventListener('click',realizarDownloadMapa);
}

(() => {
    criarEventos();
})()