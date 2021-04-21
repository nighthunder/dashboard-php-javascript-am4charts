$(document).ready(function () {

    
    $(".ano").change( function(){
        const options = []

        document.querySelectorAll('.ano option').forEach((option) => {
            if (options.includes(option.value)) option.remove()
            else options.push(option.value)
        })
    });

    $( window ).resize(function() {
        var tamanhoSelect = $("body > div > div.app-main > div.app-main__outer > div > div.app-page-title > div > div > div > div.selects-header > select.regiao.form-control").width()
        // console.log(tamanhoSelect);
        $("body > div > div.app-main > div.app-main__outer > div > div.app-page-title > div > div > div > div.selects-header > div > div > div").width(tamanhoSelect);
    });

    //Consertando problemas no select de Proporção
    $("body > div > div.app-main > div.app-main__outer > div > div.app-page-title > div > div > div > div.selects-header > div > div > div > button").addClass("form-control");
    $("body > div > div.app-main > div.app-main__outer > div > div.app-page-title > div > div > div > div.selects-header > div > div > div > div > ul > li.ms-select-all > label > span").text("Selecionar Todos");
    $("body > div > div.app-main > div.app-main__outer > div > div.app-page-title > div > div > div > div.selects-header > div > div > div > div > ul > li.multiple.selected").css("display", "none");
    $("body > div > div.app-main > div.app-main__outer > div > div.app-page-title > div > div > div > div.selects-header > div > div > select").change(function () {
        if (document.querySelector("body > div > div.app-main > div.app-main__outer > div > div.app-page-title > div > div > div > div.selects-header > div > div > div > button > span").textContent == "All selected") {
            $("body > div > div.app-main > div.app-main__outer > div > div.app-page-title > div > div > div > div.selects-header > div > div > div > button > span").text("Todos");
        }
        if (document.querySelector("body > div > div.app-main > div.app-main__outer > div > div.app-page-title > div > div > div > div.selects-header > div > div > div > button > span").textContent.includes("Proporção,")) {
            tempNome = document.querySelector("body > div > div.app-main > div.app-main__outer > div > div.app-page-title > div > div > div > div.selects-header > div > div > div > button > span").textContent
            tempNome = tempNome.split("Proporção,");
            $("body > div > div.app-main > div.app-main__outer > div > div.app-page-title > div > div > div > div.selects-header > div > div > div > button > span").text(tempNome[1])
        }
    });
    
    $("select.regiao").change(function () {

        if(this.value != "amazoniaLegal"){
            // console.log("entreiiiiiiiiii");
            $("select.area option[value='infraestrutura']").hide();
            $("select.area option[value='institucional']").hide();
        }else if($("select.area option[value='infraestrutura']").hide() && $("select.area option[value='institucional']").hide()){
            $("select.area option[value='infraestrutura']").show();
            $("select.area option[value='institucional']").show();
        }

        //limpando selects quando mudar regiao
        $('.area').prop('selectedIndex',0);
        $('.indicador').find('option').remove();
        $('.indicador').append('<option value="" disabled selected>Indicadores</option>');
        $('.ano').find('option').remove();
        $('.ano').append('<option value="" disabled selected>Ano</option>');
        $('#btn-rpa').attr('disabled','disabled');
    });

    d3.csv("../atlas/csv/data_dict.csv", function (error, dict) {

        
        $("select.area").change(function () {
            

            //limpando selects quando mudar area
            $('.indicador').find('option').remove();
            $('.indicador').append('<option value="" disabled selected>Indicadores</option>');
            $('.ano').find('option').remove();
            $('.ano').append('<option value="" disabled selected>Ano</option>');
            $('#btn-rpa').attr('disabled','disabled');

            //pegando a regiao selecionada
            var area = $(this).children("option:selected").val();

            function openFile(file) {
                var extension = file.substr( (file.lastIndexOf('.') +1) );
                switch(extension) {
                    case 'csv':
                        return true;
                        break;
                    default:
                        return false;
                }
            };
        
            
            // console.log('$(".regiao").val()', $(".regiao").val());
            
            //populando select dos indicadores
            var fileNames = new Array();
            $.ajax({
                url: "../atlas/csv/" + area,
                success: function(data){
                    $(data).find("td > a").each(function(){
                        if(openFile($(this).attr("href"))){
                            var dataL = $(this)
                            // console.log($(this), dataL);
                            fileNames.push($(this).attr("href"));
                            
                            // console.log("data dict", dict);
                            var dictPos = dict.filter(function (i,n) {
                                // console.log(i.Nome, dataL.attr("href").replace(/.csv/g, ''));
                                if (dataL.attr("href").replace(/.csv/g, '').toUpperCase().includes(i.Nome)) {
                                    // console.log("i.Nome", i.Nome);
                                    return i.Nome;
                                  }
                                // return i.REGIAO === regiaoNomeCompleto;
                            })

                            // console.log("dictPos", dictPos);
                            if($(".regiao").val()){
                                if($(".regiao").val() == "amazoniaLegal"){
                                    if($(this).attr("href").replace(/.csv/g, '').includes("uf")){
                                        // $('.indicador').append('<option value="'+ $(this).attr("href").replace(/.csv/g, '') +'">'+ $(this).attr("href").replace(/.csv/g, '') +'</option>');
                                        $('.indicador').append('<option value="'+ $(this).attr("href").replace(/.csv/g, '') +'">'+ dictPos[0]['Descricao'] +'</option>');
                                    }
                                }else{
                                    if($(this).attr("href").replace(/.csv/g, '').includes("mun")){
                                        // $('.indicador').append('<option value="'+ $(this).attr("href").replace(/.csv/g, '') +'">'+ $(this).attr("href").replace(/.csv/g, '') +'</option>');
                                        $('.indicador').append('<option value="'+ $(this).attr("href").replace(/.csv/g, '') +'">'+ dictPos[0]['Descricao'] +'</option>');
                                    }
                                }
                            }

                        }           
                    });
                }
            });
                
            //populando select do ano
            $("select.indicador").change(function () {
                //limpando ano do indicador anterior
                $('.ano').find('option').remove();
                $('.ano').append('<option value="" disabled selected>Ano</option>');
                $('#btn-rpa').attr('disabled','disabled');

                //pegando valor do indicador escolhido
                var indicador = $(this).children("option:selected").val();
                d3.csv("../atlas/csv/" + area +"/" + indicador+ ".csv", function (error, data) {
                    var ano = data["columns"];

                    //verificando ano das colunas
                    function isNumeric(value) {
                        return /^\d+$/.test(value);
                    }
                    
                    ano.forEach(function (element, index) {
                        if (isNumeric(element)) {
                            $('.ano').append('<option value="'+ element +'">'+ element +'</option>');
                        }
                    });

                    const options = []
                    document.querySelectorAll('.ano option').forEach((option) => {
                        if (options.includes(option.value)) option.remove()
                        else options.push(option.value)
                    })
                    
                });
            });
            
            $("select.ano").change(function () {
                $('#btn-rpa').removeAttr('disabled');
            });

            $("select.pct").change(function () {
                $('#btn-rqa').removeAttr('disabled');
            });

        });

    });


    $( "#btn-rpa" ).click(function() {
        //deletando antigo mapa
        $(".ol-viewport").removeData();
        $(".ol-viewport").remove();
        $("#map_tooltip > svg").remove();

        //valores dos selects
        var regiao = $( ".regiao" ).val()
        var area = $( ".area" ).val()
        var indicador = $( ".indicador" ).val()
        var titulo = $( ".indicador option:selected" ).text()
        var anoIndicador = $( ".ano" ).val()

        d3.csv("../atlas/csv/" + area +"/" + indicador+ ".csv", function (error, data) {
            // console.log("data", data);
            var regiaoNomeCompleto

            //seleciona nome região
            switch ($(".regiao").val()) {
                case 'amazoniaLegal':
                    regiaoNomeCompleto = "Amazônia Legal";
                    break;
                case "amazonas":
                    regiaoNomeCompleto = "Amazonas";
                    break;
                case "acre":
                    regiaoNomeCompleto = "Acre";
                    break;
                case "amapa":
                    regiaoNomeCompleto = "Amapá";
                    break;
                case 'roraima':
                    regiaoNomeCompleto = "Roraima";
                    break;
                case 'rondonia':
                    regiaoNomeCompleto = "Rondônia";
                    break;
                case 'para':
                    regiaoNomeCompleto = "Pará";
                    break;
                case 'maranhao':
                    regiaoNomeCompleto = "Maranhão";
                    break;
                case 'matoGrosso':
                    regiaoNomeCompleto = "Mato Grosso";
                    break;
                case 'tocantins':
                    regiaoNomeCompleto = "Tocantins";
                    break;
                default:
                    regiaoNomeCompleto = "Amazônia Legal";
                    break;
            }

            var dataPos = data.filter(function (i,n) {
                // console.log(i,n);
                return i.REGIAO === regiaoNomeCompleto;
            })
            d3.csv("../atlas/csv/data_dict.csv", function (error, dict) {
                //chamada da funcao que constroi o mapa
                // console.log("dict antes", dict);
                mapaPoliticoAdministrativo(regiao, indicador, anoIndicador, dataPos, titulo, dict)
            });
        });

    });


    $( "#btn-rqa" ).click(function() {
        //deletando antigo mapa
        $(".ol-viewport").removeData();
        $(".ol-viewport").remove();
        $("#map_tooltip > svg").remove();

        //valores dos selects
        var regiao = $( ".regiao" ).val()
        var area = $( ".area" ).val()
        var indicador = $( ".indicador" ).val()
        var titulo = $( ".indicador option:selected" ).text()
        var anoIndicador = $( ".ano" ).val()
        var territorio = $( ".territorio" ).val()
        var pct = $( ".pct" ).val()

        // console.log("territorio, pct", territorio, pct);

        d3.csv("../atlas/csv/" + area +"/" + indicador+ ".csv", function (error, data) {
            // console.log("data", data);
            var regiaoNomeCompleto

            //seleciona nome região
            switch ($(".regiao").val()) {
                case 'amazoniaLegal':
                    regiaoNomeCompleto = "Amazônia Legal";
                    break;
                case "amazonas":
                    regiaoNomeCompleto = "Amazonas";
                    break;
                case "acre":
                    regiaoNomeCompleto = "Acre";
                    break;
                case "amapa":
                    regiaoNomeCompleto = "Amapá";
                    break;
                case 'roraima':
                    regiaoNomeCompleto = "Roraima";
                    break;
                case 'rondonia':
                    regiaoNomeCompleto = "Rondônia";
                    break;
                case 'para':
                    regiaoNomeCompleto = "Pará";
                    break;
                case 'maranhao':
                    regiaoNomeCompleto = "Maranhão";
                    break;
                case 'matoGrosso':
                    regiaoNomeCompleto = "Mato Grosso";
                    break;
                case 'tocantins':
                    regiaoNomeCompleto = "Tocantins";
                    break;
                default:
                    regiaoNomeCompleto = "Amazônia Legal";
                    break;
            }

            var dataPos = data.filter(function (i,n) {
                // console.log(i,n);
                return i.REGIAO === regiaoNomeCompleto;
            })
            d3.csv("../atlas/csv/data_dict.csv", function (error, dict) {
                //chamada da funcao que constroi o mapa
                // console.log("dict antes", dict);
                mapaQuatroAmazonias(regiao, indicador, anoIndicador, dataPos, titulo, dict, territorio, pct)
            });
        });

    });


    //Abrindo pasta e pegando arquivos apenas com exteção .csv

    //Contruindo gráfico a partir da escolha do select
    // $("select.indicador").change(function () {
    //     d3.select("svg").remove();
    //     var indicador = $(this).children("option:selected").val();
    //     graph(indicador)
    // });
});

// $("select.regiao").change(function () {
//     // d3.select("svg").remove();
//     $(".ol-viewport").remove();
//     var regiao = $(this).children("option:selected").val();
//     mapa(regiao);
// });

//inicializando o mapa com um indicador pre definido pela equipe
window.addEventListener("load", function(event) {

    d3.csv("../atlas/csv/" + "educacao" +"/" + "dados_uf_atlas_tx_inep_ideb_em_uf" + ".csv", function (error, data) {
        // console.log("data", data);

        var dataPos = data.filter(function (i,n) {
            return i.REGIAO === "Amazônia Legal";
        })
        d3.csv("../atlas/csv/data_dict.csv", function (error, dict) {
            //chamada da funcao que constroi o mapa
            // console.log("dict antes", dict);
            mapaPoliticoAdministrativo("amazoniaLegal", "dados_uf_atlas_tx_inep_ideb_em_uf", '2019', dataPos, "Ideb ensino médio - rede pública", dict)
        });
        // console.log("dataPos", dataPos);
    });

});
