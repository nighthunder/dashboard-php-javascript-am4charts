var dataInicio;
var dataFim;
let anosCross1;
//ocultando dos anos inicialmente
for (let index = 2007; index <= 2020; index++){
    $("li.multiple." + index).hide();
}

// Preenchendo os selects dos indicadores com relação as areas escolhidas 
d3.csv("../explore/csv/data_dict.csv", function (error, dict) {
    
    $("select.area").change(function () {
        //limpando selects quando mudar area
        $('.indicador').find('option').remove();
        $('.indicador').append('<option value="" disabled selected>Indicador</option>');
        // $('.ano').find('option').remove();
        // $('.ano').append('<option value="" disabled selected>Ano</option>');
        $('#btn-rqa').attr('disabled','disabled');

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
        
        //populando select dos indicadores
        var fileNames = new Array();
        $.ajax({
            url: "../explore/csv/" + area,
            success: function(data){
                $(data).find("td > a").each(function(){
                    if(openFile($(this).attr("href"))){
                        var dataL = $(this)
                        fileNames.push($(this).attr("href"));
                        
                        var dictPos = dict.filter(function (i,n) {
                            if (dataL.attr("href").replace(/.csv/g, '').toUpperCase().includes(i.Nome)) {
                                return i.Nome;
                            }
                        })
                         
                        if($(this).attr("href").replace(/.csv/g, '').includes("mun")){
                            if (!dictPos[0]['Unidade']){
                                unidade = "";
                            }else{
                                unidade = " (" + dictPos[0]['Unidade'] + ")"; 
                            }

                            console.log("unidade", unidade);
                             
                            $('.indicador').append('<option value="'+ $(this).attr("href").replace(/.csv/g, '') +'">'+ dictPos[0]['Descricao'] +'</option>');
                            $('.indicador').append('<option value="" disabled="">'+ unidade + '</option>');
                        }

                    }           
                });
            }
        });
    });
    $("select.area1").change(function () {
        //limpando selects quando mudar area
        $('.indicador1').find('option').remove();
        $('.indicador1').append('<option value="" disabled selected>Indicador 1</option>');
        // $('.ano').find('option').remove();
        // $('.ano').append('<option value="" disabled selected>Ano</option>');
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
        //populando select dos indicadores
        var fileNames = new Array();
        $.ajax({
            url: "../explore/csv/" + area,
            success: function(data){
                $(data).find("td > a").each(function(){
                    if(openFile($(this).attr("href"))){
                        var dataL = $(this)
                        fileNames.push($(this).attr("href"));
                        var dictPos = dict.filter(function (i,n) {
                            if (dataL.attr("href").replace(/.csv/g, '').toUpperCase().includes(i.Nome)) {
                                return i.Nome;
                            }
                        })

                        if($(this).attr("href").replace(/.csv/g, '').includes("uf")){
                            if (!dictPos[0]['Unidade']){
                                unidade = "";
                            }else{
                                unidade = " (" + dictPos[0]['Unidade'] + ") "; 
                            }
                            $('.indicador1').append('<option value="'+ $(this).attr("href").replace(/.csv/g, '') +'">'+ dictPos[0]['Descricao'] + '</option>');
                            $('.indicador1').append('<option value="" disabled="">' + unidade + '</option>');
                        }
                    }           
                });
            }
        });

    });
    $("select.area2").change(function () {
        //limpando selects quando mudar area
        $('.indicador2').find('option').remove();
        $('.indicador2').append('<option value="" disabled selected>Indicador 2</option>');
        // $('.ano').find('option').remove();
        // $('.ano').append('<option value="" disabled selected>Ano</option>');
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
    
        //populando select dos indicadores
        var fileNames = new Array();
        var unidade;
        $.ajax({
            url: "../explore/csv/" + area,
            success: function(data){
                $(data).find("td > a").each(function(){
                    if(openFile($(this).attr("href"))){
                        var dataL = $(this)
                        fileNames.push($(this).attr("href"));
                        
                        var dictPos = dict.filter(function (i,n) {
                            if (dataL.attr("href").replace(/.csv/g, '').toUpperCase().includes(i.Nome)) {
                                return i.Nome;
                            }
                        })

                        if($(this).attr("href").replace(/.csv/g, '').includes("uf")){
                            if (!dictPos[0]['Unidade']){
                                unidade = "";
                            }else{
                                unidade = " (" + dictPos[0]['Unidade'] + ")"; 
                            }
                             
                            $('.indicador2').append('<option value="'+ $(this).attr("href").replace(/.csv/g, '') +'">'+ dictPos[0]['Descricao'] + '</option>');
                            $('.indicador2').append('<option value="" disabled="">'+ unidade + '</option>');
                        }
                    }           
                });
            }
        });
    });
    
    // Liberando botões rpa e rqa
    $("select.ano").change(function () {        

        if($( ".regiao" ).val().length != 0 && $( ".indicador1" ).val() && $( ".indicador1" ).val() && $( ".ano" ).val().length != 0){
            $('#btn-rpa').removeAttr('disabled');
        }
        if($( ".ano" ).val().length == 0){
            $('#btn-rpa').attr('disabled','disabled');
        }

    });

    $("select.regiao").change(function () {
        if($( ".regiao" ).val().length == 0){
            $('#btn-rpa').attr('disabled','disabled');
            $('#btn-rqa').attr('disabled','disabled');
        }
        if($( ".ano" ).val().length != 0 && $( ".indicador1" ).val() && $( ".indicador1" ).val() && $( ".regiao" ).val().length != 0){
            $('#btn-rpa').removeAttr('disabled');
        }
        if($( ".indicador" ).val() && $( ".territorio" ).val() && $( ".regiao" ).val().length != 0){
            $('#btn-rqa').removeAttr('disabled');
        }
    });
    $("select.indicador").change(function () {
        if($( ".regiao" ).val().length != 0 && $( ".territorio" ).val()){
            $('#btn-rqa').removeAttr('disabled');
        }
    });
    $("select.indicador1").change(function (){
        if($( ".ano" ).val().length != 0 && $( ".regiao" ).val().length != 0 && $( ".indicador2" ).val()){
            $('#btn-rpa').removeAttr('disabled');
        }
        if($( ".indicador2" ).val()){
            // let ind1 = $( ".indicador1" ).val().replace("dados_uf_atlas_", "").toUpperCase();
            // let ind2 = $( ".indicador2" ).val().replace("dados_uf_atlas_", "").toUpperCase();

            d3.csv("../explore/csv/" + $( ".area2" ).val() +"/" + $( ".indicador2" ).val()+ ".csv", function (error, data1) {
                d3.csv("../explore/csv/" + $( ".area1" ).val() +"/" + $( ".indicador1" ).val()+ ".csv", function (error, data2) {
                        function intersection(o1, o2) {
                            return Object.keys(o1).filter({}.hasOwnProperty.bind(o2));
                        }
                        let obj1 = data1[0];
                        let obj2 = data2[0];
                        delete obj1.AREA;
                        delete obj1.INDICADOR;
                        delete obj1.REGIAO;
                        delete obj1.COD_IBGE;
                        delete obj1.MICROREGIAO;
                        delete obj2.AREA;
                        delete obj2.INDICADOR;
                        delete obj2.REGIAO;
                        delete obj2.COD_IBGE;
                        delete obj2.MICROREGIAO;

                        let anosCross = intersection(obj1, obj2);
                        //console.log("anos cross", anosCross);
                        dataInicio = $(anosCross).first()[0];
                        dataFim = $(anosCross).last()[0];

                        // comparação intervalos de anos semelhantes    
                        for (let index = 2007; index <= 2020; index++){ 
                            // console.log("index", index, dataInicio, dataFim);
                            if (index == dataInicio || index == dataFim){
                                $("li.multiple." + index).show();
                            }else{
                                $("li.multiple." + index).hide();
                                $("li.multiple." + index + " input")[0].checked = false;
                            }
                        }
                });
            });
        }
    });
    
    $("select.indicador2").change(function () {
        if($( ".ano" ).val().length != 0 && $( ".regiao" ).val().length != 0 && $( ".indicador1" ).val()){
            $('#btn-rpa').removeAttr('disabled');
        }
        if($( ".indicador1" ).val()){
            // let ind1 = $( ".indicador1" ).val().replace("dados_uf_atlas_", "").toUpperCase();
            // let ind2 = $( ".indicador2" ).val().replace("dados_uf_atlas_", "").toUpperCase();

            d3.csv("../explore/csv/" + $( ".area1" ).val() +"/" + $( ".indicador1" ).val()+ ".csv", function (error, data1) {
                d3.csv("../explore/csv/" + $( ".area2" ).val() +"/" + $( ".indicador2" ).val()+ ".csv", function (error, data2) {
                        function intersection(o1, o2) {
                            return Object.keys(o1).filter({}.hasOwnProperty.bind(o2));
                        }
                        let obj1 = data1[0];
                        let obj2 = data2[0];
                        delete obj1.AREA;
                        delete obj1.INDICADOR;
                        delete obj1.REGIAO;
                        delete obj1.COD_IBGE;
                        delete obj1.MICROREGIAO;
                        delete obj2.AREA;
                        delete obj2.INDICADOR;
                        delete obj2.REGIAO;
                        delete obj2.COD_IBGE;
                        delete obj2.MICROREGIAO;

                        let anosCross = intersection(obj1, obj2);
                        //console.log("anosCross2", anosCross);
                        anosCross1 = anosCross;
                        dataInicio = $(anosCross).first()[0];
                        dataFim = $(anosCross).last()[0];
                        var showed = false;
                        for (let index = 2007; index <= 2020; index++){
                            $("li.multiple." + index).hide(); 
                            // $("select.ano").value(index).hide();
                            for( let i = 0; i < anosCross.length; i++){
                                if ( index == anosCross[i]){
                                    $("li.multiple." + index).show();
                                    // $("select.ano").value(index).show();
                                    showed = true;
                                }
                            }
                            // if (showed == false){
                            //     $("li.multiple." + index).remove();
                            //     // $("select.ano").value(index).remove();
                                
                            // }else{ showed = false; }
                            // console.log("index", index, dataInicio, dataFim);
                            // if (index == dataInicio || index == dataFim){
                            //     $("li.multiple." + index).show();
                            // }else{
                            //     $("li.multiple." + index).show();
                            //     $("li.multiple." + index + " input")[0].checked = false;
                            // }
                        }

                        // for (let index = 2007; index <= 2020; index++){
                        //     console.log("index", index, dataInicio, dataFim);
                        //     if (index == dataInicio || index == dataFim){
                        //         $("li.multiple." + index).show();
                        //     }else{
                        //         $("li.multiple." + index).show();
                        //         $("li.multiple." + index + " input")[0].checked = false;
                        //     }
                        // }
                });
            });
        }
    });
    $("select.territorio").change(function () {
        if($( ".regiao" ).val().length != 0 && $( ".indicador" ).val()){
            $('#btn-rqa').removeAttr('disabled');
        }
    });

});


$( "#btn-rpa" ).click(function() {
    //deletando antigo mapa
    // $(".ol-viewport").removeData();
    // $(".ol-viewport").remove();
    // $("#map_tooltip > svg").remove();

    // $("#canvas").clear();
    //valores dos selects
    var regiao = $( ".regiao" ).val()
    
    var area1 = $( ".area1" ).val()
    var indicador1 = $( ".indicador1" ).val()
    var label1 = $( ".indicador1 option:selected" ).text()
    var unidade1 = $( ".indicador1 option:selected" ).next().text();

    var area2 = $( ".area2" ).val()
    var indicador2 = $( ".indicador2" ).val()
    var label2 = $( ".indicador2 option:selected" ).text()
    var unidade2 = $( ".indicador2 option:selected" ).next().text();

    var anoIndicador = $(".ano").val(); 
    var anoIndicador1 = anoIndicador;
    if (JSON.stringify(anoIndicador) == JSON.stringify(["2007","2008","2009","2010","2011","2012","2013","2014","2015","2016","2017","2018","2019","2020"])){
        anoIndicador = anosCross1;
    }
    // var i = 0;
    // for (let index = 2007; index <= 2020; index++){
    //    if ( typeof anosCross1[index] === 'null' || typeof anosCross1[index] === 'undefined'){
    //         i = 1;
    //    }
    // }    
    // if (i == 0){
    //     anoIndicador = anosCross1;
    // }
    // console.log("anoscross1", anosCross1);
    // console.log("ANO indicador", anoIndicador);

    d3.csv("../explore/csv/" + area1 +"/" + indicador1+ ".csv", function (error, data1) {
        d3.csv("../explore/csv/" + area2 +"/" + indicador2+ ".csv", function (error, data2) {
            d3.csv("../explore/csv/data_dict.csv", function (error, dict) {
                graficoIndicadorIndicador(regiao, area1, indicador1, label1, unidade1, area2, indicador2, label2, unidade2, anoIndicador, data1, data2, dict);
                pearsonIndicadorIndicador(regiao, area1, indicador1, label1, area2, indicador2, label2, anoIndicador, data1, data2, dict);
            });

        });
    });

});

$( "#btn-rqa" ).click(function() {
    //deletando antigo mapa
    // $(".ol-viewport").removeData();
    // $(".ol-viewport").remove();
    // $("#map_tooltip > svg").remove();

    //valores dos selects
    var regiao = $( ".regiao" ).val()
    
    var territorio = $( ".territorio" ).val()
    var label2 = $( ".territorio option:selected" ).text()
    var unidade2 = $( ".territorio option:selected" ).next().text()
    
    var area = $( ".area" ).val()
    var indicador = $( ".indicador" ).val()
    var label1 = $( ".indicador option:selected" ).text()
    var unidade1 = $( ".indicador option:selected" ).next().text()

    d3.csv("../explore/csv/" + area +"/" + indicador+ ".csv", function (error, data) {
        d3.csv("../explore/csv/data_dict.csv", function (error, dict) {
            d3.csv("../explore/csv/quatro_amazonias_select/atlas_dados_4_territorios_municipio.csv", function (error, dict4Amazonias) {
                graficoQuatroAmazoniasIndicador(regiao, indicador, label1, unidade1, area, territorio, label2, unidade2, data, dict, dict4Amazonias);
                pearsonQuatroAmazoniasIndicador(regiao, indicador, label1, area, territorio, label2, data, dict, dict4Amazonias);
            });
        });
    });

});

// iniciando com dois indicadores selecionados
d3.csv("../explore/csv/economia/dados_uf_atlas_tx_ibge_pib_pc_uf.csv", function (error, data1) {

        d3.csv("../explore/csv/meio_ambiente/dados_uf_atlas_tx_inpe_desmatamento_uf.csv", function (error, data2) {
            d3.csv("../explore/csv/data_dict.csv", function (error, dict) {
                graficoIndicadorIndicador(["Amazonas", "Acre", "Amapá", "Roraima", "Rondônia", "Pará", "Maranhão", "Mato Grosso", "Tocantins"], 'area1', 'indicador1', "PIB", "(em R$ de 2018)", 'area2', 'indicador2', "Desmatamento acumulado","(ha)", ["2010","2011","2012",'2013','2014','2015','2016','2017','2018'], data1, data2, dict);
                pearsonIndicadorIndicador(["Amazonas", "Acre", "Amapá", "Roraima", "Rondônia", "Pará", "Maranhão", "Mato Grosso", "Tocantins"], 'area1', 'indicador1', "PIB per capita", 'area2', 'indicador2', "Desmatamento acumulado", ["2010","2011","2012",'2013','2014','2015','2016','2017','2018'], data1, data2, dict);
            });

        });
        //$("select.area1").val("meio_ambiente_1");

        //$("select.indicador1").val("dados_uf_atlas_tx_inpe_desmatamento_uf");
        // $("select.area1").val("economia");
        //$("select.indicador2").val("dados_uf_atlas_tx_ibge_pib_pc_uf");
    });
    

   

    setTimeout(function(){
        $("input[type='checkbox']").prop("checked", "true");
        $("input[type='checkbox']").prop("checked", "checked"); 
         $("li.multiple.2007").hide();
         $("li.multiple.2008").hide();
         $("li.multiple.2009").hide();
         $(".ms-parent.ano .ms-choice.form-control span").text("Todos selecionados");
         $(".ms-parent.regiao .ms-choice.form-control span").text("Todos selecionados");
         }
    , 1000);