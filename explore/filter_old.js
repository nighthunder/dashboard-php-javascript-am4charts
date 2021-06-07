var dataInicio;
var dataFim;
let anosCross1;
//ocultando dos anos inicialmente
for (let index = 2007; index <= 2020; index++){
    $("li.multiple." + index).hide();
}

const VALORES_INICIAIS = {
    regiao: ["Amazonas", "Acre", "Amapá", "Roraima", "Rondônia", "Pará", "Maranhão", "Mato Grosso", "Tocantins"], 
    area1: 'area1', 
    indicador1: 'indicador1', 
    label1: "PIB", 
    unidade1: "(em R$ de 2018)", 
    area2: 'area2', 
    indicador2: 'indicador2', 
    label2: "Desmatamento acumulado",
    unidade2: "(ha)", 
    anoIndicador: ["2010","2011","2012",'2013','2014','2015','2016','2017','2018', '2019', '2020'],

    valoresCampos:
    {
        'area1': 'meio_ambiente',
        'indicador1': 'dados_uf_atlas_tx_inpe_desmatamento_uf',
        'area2': 'economia',
        'indicador2': 'dados_uf_atlas_tx_ibge_pib_constante_uf',
    }
};

// Preenchendo os selects dos indicadores com relação as areas escolhidas 
d3.csv("../explore/csv/data_dict.csv", function (error, dict) {
    $("select.area").change(function () {
        //limpando selects quando mudar area
        $('.indicador').find('option').remove();
        $('.indicador').append('<option value="" disabled selected>Indicador</option>');
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
                             
                            $('.indicador').append('<option value="'+ $(this).attr("href").replace(/.csv/g, '') +'">'+ dictPos[0]['Descricao'] +'</option>');
                            $('.indicador').append('<option value="" disabled="">'+ unidade + '</option>');
                        }

                    }           
                });
            }
        });
    });
    
    let mudarPrimeiraArea = () =>
    {        
        //limpando selects quando mudar area
        $('.indicador1').find('option').remove();
        $('.indicador1').append('<option value="" disabled selected>Indicador 1</option>');

        //pegando a regiao selecionada
        var area = $('.seletorArea.area1').children("option:selected").val() || VALORES_INICIAIS.valoresCampos.area1;

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
    }

    let mudarSegundaArea = () =>
    {
        //limpando selects quando mudar area
        $('.indicador2').find('option').remove();
        $('.indicador2').append('<option value="" disabled selected>Indicador 2</option>');

        //pegando a regiao selecionada
        var area = $('.seletorArea.area2').children("option:selected").val() || VALORES_INICIAIS.valoresCampos.area2;

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
        //console.log('---->', area);
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
                             console.log(dictPos[0])
                            $('.indicador2').append('<option value="'+ $(this).attr("href").replace(/.csv/g, '') +'">'+ dictPos[0]['Descricao'] + '</option>');
                            $('.indicador2').append('<option value="" disabled="">'+ unidade + '</option>');
                        }
                    }           
                });
            }
        });
    }

    let mudarAno = () => 
    {
        if($( ".regiao" ).val().length != 0 && $( ".indicador1" ).val() && $( ".indicador1" ).val() && $( ".ano" ).val().length != 0){
            $('#btn-rpa').removeAttr('disabled');
        }
        if($( ".ano" ).val().length == 0){
        }
    }

    let mudarRegiao = () =>
    {
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
    }

    let mudarIndicador1 = () => 
    {
        if($( ".ano" ).val().length != 0 && $( ".regiao" ).val().length != 0 && $( ".indicador2" ).val()){
            $('#btn-rpa').removeAttr('disabled');
        }
        if($( ".indicador2" ).val()){

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
                                $("li.multiple." + index).addClass('showCheckbox');
                            }else{
                                $("li.multiple." + index).hide();
                                $("li.multiple." + index).removeClass('showCheckbox');
                                $("li.multiple." + index + " input")[0].checked = false;
                            }
                        }
                });
            });
        }
    }

    let mudarIndicador2 = () => 
    {
        if($( ".ano" ).val().length != 0 && $( ".regiao" ).val().length != 0 && $( ".indicador1" ).val()){
        }
        if($( ".indicador1" ).val()){

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
                        anosCross1 = anosCross;
                        dataInicio = $(anosCross).first()[0];
                        dataFim = $(anosCross).last()[0];
                        var showed = false;
                        for (let index = 2007; index <= 2020; index++){
                            $("li.multiple." + index).hide(); 
                            $("li.multiple." + index).removeClass('showCheckbox');
                            for( let i = 0; i < anosCross.length; i++){
                                if ( index == anosCross[i]){
                                    $("li.multiple." + index).show();
                                    $("li.multiple." + index).addClass('showCheckbox');
                                    showed = true;
                                }
                            }
                        }
                });
            });
        }
    }

    $("select.area1").change(mudarPrimeiraArea);
    $("select.area2").change(mudarSegundaArea);
    
    // Liberando botões rpa e rqa
    $("select.ano").change(mudarAno);

    $("select.regiao").change(mudarRegiao);
    $("select.indicador").change(function () {
        if($( ".regiao" ).val().length != 0 && $( ".territorio" ).val()){
            $('#btn-rqa').removeAttr('disabled');
        }
    });
    $("select.indicador1").change(mudarIndicador1);
    
    $("select.indicador2").change(mudarIndicador2);
    $("select.territorio").change(function () {
        if($( ".regiao" ).val().length != 0 && $( ".indicador" ).val()){
            $('#btn-rqa').removeAttr('disabled');
        }
    });

});


$( "#btn-rpa" ).click(function() {   
    const VALORES_EXCLUSAO_SELECT = ['on', ]
    let metadadosCampos = [{nome: 'regiao', query: '.regiao', getValue: () => [...$('.regiao [type=checkbox]')].filter(e => e.checked)
                                                                               .filter(e => e.value.length > 0 && VALORES_EXCLUSAO_SELECT.indexOf(e.value) == -1)
                                                                               .map(e => e.value)},
    {nome: 'area1', query: '.area1', getValue: () => $('.area1').val()},
    {nome: 'indicador1', query: '.indicador1', getValue: () => $('.indicador1').val()},
    {nome: 'label1', query: '.indicador1 option:selected', getValue: () => $('.indicador1 option:selected').text()},
    {nome: 'unidade1', query: '.indicador1 option:selected', getValue: () => $(".indicador1 option:selected" ).next().text()},
    {nome: 'area2', query: '.area2', getValue: () => $( ".area2" ).val()},
    {nome: 'indicador2', query: '.indicador2', getValue: () => $(".indicador2" ).val()},
    {nome: 'label2', query: '.indicador2 option:selected', getValue: () => $(".indicador2 option:selected" ).text()},
    {nome: 'unidade2', query: '.indicador2 option:selected', getValue: () => $(".indicador2 option:selected" ).next().text()},
    {nome: 'anoIndicador', query: '.ano', getValue: () => [...$(".ano .showCheckbox [type=checkbox]")].filter(e => e.checked)
                                                            .filter(e => e.value.length > 0 && VALORES_EXCLUSAO_SELECT.indexOf(e.value) == -1)
                                                            .map(e => e.value)}]
    let campos = {};
    const CLASSE_CAMPO_INVALIDO = 'exploreInvalidInput';

    let camposPreenchidos = true;
    metadadosCampos.forEach(metadadosCampo => {
        campos[metadadosCampo.nome] = metadadosCampo.getValue();
        if(!campos[metadadosCampo.nome]) 
        {
            console.log($(metadadosCampo.query), metadadosCampo.query);
            $(metadadosCampo.query).addClass(CLASSE_CAMPO_INVALIDO);
            camposPreenchidos = false
        }
        else
        {
            $(metadadosCampo.query).removeClass(CLASSE_CAMPO_INVALIDO);
        }
    })

    if (JSON.stringify(campos['anoIndicador']) == JSON.stringify(["2007","2008","2009","2010","2011","2012","2013","2014","2015","2016","2017","2018","2019","2020"])){
     //   campos['anoIndicador'] = anosCross1;
    }

    if(!camposPreenchidos)
    {
        console.log('OOPLA');
        return;
    }

    console.log(campos['indicador1'], campos['indicador2']);
    d3.csv("../explore/csv/" + campos['area1'] +"/" + campos['indicador1']+ ".csv", function (error, data1) {
        d3.csv("../explore/csv/" + campos['area2'] +"/" + campos['indicador2']+ ".csv", function (error, data2) {
            d3.csv("../explore/csv/data_dict.csv", function (error, dict) {
                graficoIndicadorIndicador(campos['regiao'], campos['area1'], campos['indicador1'], campos['label1'], campos['unidade1'], campos['area2'], campos['indicador2'], campos['label2'], campos['unidade2'], campos['anoIndicador'], data1, data2, dict);
                pearsonIndicadorIndicador(campos['regiao'], campos['area1'], campos['indicador1'], campos['label1'], campos['area2'], campos['indicador2'], campos['label2'], campos['anoIndicador'], data2, data1, dict);
            });

        });
    });

});

$( "#btn-rqa" ).click(function() {

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
let {area1, indicador1, area2, indicador2} = VALORES_INICIAIS.valoresCampos;
d3.csv(`../explore/csv/economia/${indicador2}.csv`, function (error, data2) {
        d3.csv(`../explore/csv/meio_ambiente/${indicador1}.csv`, function (error, data1) {
            d3.csv("../explore/csv/data_dict.csv", function (error, dict) {


                $("li.multiple").removeClass('showCheckbox');
                for(let ano of VALORES_INICIAIS.anoIndicador)
                {
                    $("li.multiple." + ano).addClass('showCheckbox');
                }

                $(".seletorArea.area1").val(area1);
                $(".seletorArea.area1").trigger('change');

                $(".seletorArea.area2").val(area2);
                $(".seletorArea.area2").trigger('change');

                $('.seletorIndicador.indicador1').val(indicador1);
                $('.seletorIndicador.indicador1').trigger('change');
                $('.seletorIndicador.indicador2').val(indicador2);
                $('.seletorIndicador.indicador2').trigger('change');

                /*console.log(area1, indicador1, area2, indicador2, 
                    $('.seletorIndicador.indicador1'), 
                    $('.seletorIndicador.indicador2'));*/

                const CAMPOS_GRAFICO = ['regiao', 'area1', 'indicador1', 'label1', 'unidade1', 'area2', 'indicador2', 'label2', 'unidade2', 'anoIndicador'];
                const CAMPOS_PEARSON = ['regiao', 'area1', 'indicador1', 'label1', 'area2', 'indicador2', 'label2', 'anoIndicador'];
                graficoIndicadorIndicador(...CAMPOS_GRAFICO.map(c => VALORES_INICIAIS[c]), data1, data2, dict);
                pearsonIndicadorIndicador(...CAMPOS_PEARSON.map(c => VALORES_INICIAIS[c]), data1, data2, dict);
            }); 

        });
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