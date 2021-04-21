//Funcao principal para criar o mapa
function mapaQuatroAmazonias(regiao, indicador, ano, datum, titulo, dict, territorio, pct) {
    // Selecionando qual arquivo usar para o filtro das layers
    // var stringRegiao;
    // if (regiao == "amazoniaLegal"){
    //     stringRegiao = "estado";
    // }else{
    //     stringRegiao = "municipio";
    // }
    d3.csv("../atlas/csv/quatro_amazonias_select/"+ regiao +".csv", function (error, dictQuatroAmazonias) {
        // console.log("regiao, indicador, ano, datum", regiao, indicador, ano, datum);
        var municipiosSelecionadosPct = [];
        var municipiosSelecionadosPctCOD = [];
        dictQuatroAmazonias.forEach(function (i,n) {
            // console.log("i", i);
            pct.forEach(element => {
                // console.log("element", element);
                let valorPct = parseFloat(element);
                // console.log("valorPct", valorPct);
                let maxPct = (valorPct + 1) * 10;
                let minPct = valorPct * 10;
                // console.log("maxPct, minPct", maxPct, minPct);
                // console.log("i.PCT", i.PCT);
                if (parseFloat(i.PCT) >= minPct && parseFloat(i.PCT) <= maxPct && i.TERRITORIO == territorio){
                    // console.log("entrou");
                    // console.log("i", i);
                    municipiosSelecionadosPct.push(i);
                    municipiosSelecionadosPctCOD.push(i.COD)
                }
                // return (i.PCT >= minPct && i.PCT < maxPct);
            });
            // return municipiosSelecionadosPct;
        });
        // console.log("municipiosSelecionadosPct", municipiosSelecionadosPct);

        // console.log("municipiosSelecionados", municipiosSelecionados);
        $('#titulo').text(titulo +" - "+ ano);
        var url;
        var dataColor = [];
        var arrayAML = ['Amazonas', 'Acre', 'Tocantins', 'Roraima', 'Rondônia', 'Maranhão', 'Amapá', 'Pará', 'Mato Grosso'];

    
        //Coletando valores maximos e minimos do indicador e ano selecionado
        if(ano){
            for (let index = 0; index < datum.length; index++) {
                const element = datum[index];
                if(isNaN(element[ano]) || element[ano] == "NA"){
                    continue;
                }else{
                    var max = datum[index][ano];
                    var min = datum[index][ano];
                    break;
                }
            }
        
            datum.forEach(element => {
                // console.log("element", isNaN(element[ano]), element[ano] == "NA");
                if(regiao == "amazoniaLegal"){
                    if(arrayAML.includes(element.MICROREGIAO)){
                        if(!isNaN(element[ano]) || element[ano] != "NA"){
                            element[ano] = parseFloat(element[ano])
                            if(element[ano] <= min){
                                min = element[ano];
                            }
                            if(element[ano] >= max){
                                max = element[ano];
                            }
                        }
                    }
                }else{
                    if(!isNaN(element[ano]) || element[ano] != "NA"){
                        element[ano] = parseFloat(element[ano])
                        if(element[ano] <= min){
                            min = element[ano];
                        }
                        if(element[ano] >= max){
                            max = element[ano];
                        }
                    }
                }
            });
        }
    
        //Switch para georeferenciar zoom e localizacao da regiao escolhida
        switch (regiao) {
            case "amazoniaLegal":
                url = "./mapas/Politico_Administrativo/AL.json"
                var view = new ol.View({
                    // projection: projection,
                    center: ol.proj.fromLonLat([-58, -6]),
                    zoom: 4.7,
                });
                break;
            case "amazonas":
                url = "./mapas/Politico_Administrativo/AM.json"
                var view = new ol.View({
                    // projection: projection,
                    center: ol.proj.fromLonLat([-65, -4]),
                    zoom: 5.6,
                });
                break;
            case "acre":
                url = "./mapas/Politico_Administrativo/AC.json"
                var view = new ol.View({
                    // projection: projection,
                    center: ol.proj.fromLonLat([-70, -9]),
                    zoom: 6.6,
                });
                break;
            case "amapa":
                url = "./mapas/Politico_Administrativo/AP.json"
                var view = new ol.View({
                    // projection: projection,
                    center: ol.proj.fromLonLat([-52, 1.5]),
                    zoom: 6.6,
                });
                break;
            case "roraima":
                url = "./mapas/Politico_Administrativo/RR.json"
                var view = new ol.View({
                    // projection: projection,
                    center: ol.proj.fromLonLat([-61, 2]),
                    zoom: 6.5,
                });
                break;
            case "rondonia":
                url = "./mapas/Politico_Administrativo/RO.json"
                var view = new ol.View({
                    // projection: projection,
                    center: ol.proj.fromLonLat([-63, -11]),
                    zoom: 6.6,
                });
                break;
            case "para":
                url = "./mapas/Politico_Administrativo/PA.json"
                var view = new ol.View({
                    // projection: projection,
                    center: ol.proj.fromLonLat([-52, -4]),
                    zoom: 5.6,
                });
                break;
            case "matoGrosso":
                url = "./mapas/Politico_Administrativo/MT.json"
                var view = new ol.View({
                    // projection: projection,
                    center: ol.proj.fromLonLat([-56, -13]),
                    zoom: 5.7,
                });
                break;
            case "maranhao":
                url = "./mapas/Politico_Administrativo/MA.json"
                var view = new ol.View({
                    // projection: projection,
                    center: ol.proj.fromLonLat([-45, -6]),
                    zoom: 6,
                });
                break;
            case "tocantins":
                url = "./mapas/Politico_Administrativo/TO.json"
                var view = new ol.View({
                    // projection: projection,
                    center: ol.proj.fromLonLat([-48, -9.5]),
                    zoom: 6.1,
                });
                break;
        
            default:
                console.log("erro");
                break;
        }
    
        //Projecao Brasil de visualiacao (SIRGAS2000)
        var projection = new ol.proj.Projection({
            code: 'EPSG:4674',
        });
        
        //Contrução da Layer principal (MAPA) e adicinado layers de base
        var map = new ol.Map({
            target: 'map',
            layers: [
                new ol.layer.Group({
                    'title': 'Mapa Base',
                    layers: [
                        new ol.layer.Tile({
                            title: "OSM Maps",
                            type: "base",
                            visible: false,
                            source: new ol.source.OSM()
                        }),
                        new ol.layer.Tile({
                            title: "Bing Maps Road",
                            type: "base",
                            visible: false,
                            source: new ol.source.BingMaps({
                                key: 'AiAmN57Tfpo2eXbnihideUOBgZTCI3HFw_EEqn82QHMqPFYY_KLw7ScTtkmVs4KR',
                                imagerySet: 'road'
                            })
                        }),
                        new ol.layer.Tile({
                            title: "Bing Maps Aerial",
                            type: "base",
                            visible: false,
                            source: new ol.source.BingMaps({
                                key: 'AiAmN57Tfpo2eXbnihideUOBgZTCI3HFw_EEqn82QHMqPFYY_KLw7ScTtkmVs4KR',
                                imagerySet: 'aerial'
                            })
                        }),
                        new ol.layer.Tile({
                            title: "Em Branco",
                            type: "base",
                            visible: false,
                        }),
                        new ol.layer.Vector({
                            title: "Brasil",
                            type: "base",
                            visible: true,
                            source: new ol.source.Vector({
                                format: new ol.format.GeoJSON(),
                                url: "./mapas/Politico_Administrativo/BR.json"
                            }),
                            style: new ol.style.Style({
                                // fill: new ol.style.Fill({
                                //     color: 'lightgrey'
                                // }),
                                stroke: new ol.style.Stroke({
                                    color: '#979797',
                                })
                            })
                        }),
                    ]
                }),
            ],
            view: view
        });
                
        //Adicionando controle de escolha da Layer base
        layerSwitcher = new ol.control.LayerSwitcher({
            // tipLabel: 'Legenda' // Optional label for button
        });
        map.addControl(layerSwitcher);
        
        // Iniciando tooltips
        // map.tooltip = document.getElementById('map_tooltip');
        // map.overlay = new ol.Overlay({
        //     // element: map.tooltip,
        //     // offset: [10, 0],
        //     // positioning: 'bottom-left'
        // });
        // map.addOverlay(map.overlay);
    
        //array com UFs dos estados da AML
        // var arrayAML = ['AM', 'AC', 'TO', 'RR', 'RO', 'MA', 'AP', 'PA', 'MT']
    
        //Retorna a cor em relação a porcentagem do valor do indicador da layer
        function colorMap(ratio) {
            var color2 = 'E3C0D2';
            var color1 = '6B163D';
            // var ratio = 0.5;
    
            var hex = function(x) {
                x = x.toString(16);
                return (x.length == 1) ? '0' + x : x;
            };
    
            var r = Math.ceil(parseInt(color1.substring(0,2), 16) * ratio + parseInt(color2.substring(0,2), 16) * (1-ratio));
            var g = Math.ceil(parseInt(color1.substring(2,4), 16) * ratio + parseInt(color2.substring(2,4), 16) * (1-ratio));
            var b = Math.ceil(parseInt(color1.substring(4,6), 16) * ratio + parseInt(color2.substring(4,6), 16) * (1-ratio));
    
            var middle = hex(r) + hex(g) + hex(b);
            
            return middle;
    
        }
    
        //Calcula de 0 a 100% dado o range de valores do indicador selecionado
        function relative_percentage (score, max_score, min_score) {
            return ((score - min_score) * 100) / (max_score - min_score);
        }
        //Criando Layers do recorte escolhido
        var vectorLayer = new ol.layer.VectorImage({
            id: 'regiao',
            zIndex: 100,
            source: new ol.source.Vector({
                format: new ol.format.GeoJSON(),
                url: url
            }),
            style: function(feature){

                // if(feature)

            // console.log("feature", feature);

            if(regiao == "amazoniaLegal"){
                var obj = datum.filter(function (i,n) {
                    // console.log("i",i);
                    return i.COD_IBGE === feature.values_['CD_UF'];
                })    
            }else{
                var obj = datum.filter(function (i,n) {
                    // console.log("i",i);
                    return i.COD_IBGE === feature.values_["CD_MUN"];
                })
            }
            // console.log("obj", obj);
            if(obj.length != 0){
                if(isNaN(obj[0][ano]) && obj.length != 0){
                    var colorLayer2 = new ol.style.Style({
                        fill: new ol.style.Fill({
                            color: "white",
                        }),
                        stroke: new ol.style.Stroke({
                            color: 'white',
                            // width: 0.5,
                        }),
                    });
                    return new ol.style.Style({});
                    // return colorLayer2;
                }else{
                    var percent = relative_percentage(obj[0][ano], max, min);
                    // console.log("percent", percent);
    
                    if(isNaN(percent)){
                        var colorLayer = new ol.style.Style({
                            fill: new ol.style.Fill({
                                color: "#6B163D",
                            }),
                            stroke: new ol.style.Stroke({
                                color: 'white',
                                // width: 0.5,
                            }),
                        });
        
                        dataColor.push({
                            "color":"#6B163D",
                            "value":obj[0][ano]
                        }) 
                    }else{
                        var colorLayer = new ol.style.Style({
                                            fill: new ol.style.Fill({
                                                color: "#"+colorMap(percent/100)
                                            }),
                                            stroke: new ol.style.Stroke({
                                                color: 'white',
                                                // width: 0.5,
                                            }),
                                        });
                        
                        dataColor.push({
                            "color":"#"+colorMap(percent/100),
                            "value":obj[0][ano]
                        }) 
                    }
                    // console.log("colorMap(percent)", percent, colorMap(percent/100), "#"+colorMap(percent/100));
        
                    // return colorLayer;
                    if(municipiosSelecionadosPctCOD.includes(obj[0].COD_IBGE)){
                        // console.log("entrei");
                        return colorLayer;
                    }else{
                        return new ol.style.Style({});
                        // return colorLayer2;
    
                    }
                }
            }else{
                return new ol.style.Style({});
            }
                
                // // var municipiosSelecionados = dictQuatroAmazonias.filter(function (i,n) {
                // //     // console.log("i,n", i,n);
                // //     return i.COD === feature.values_["CD_MUN"];
                // // });
                // // console.log("dictQuatroAmazonias", dictQuatroAmazonias);
                // // console.log("feature", feature.values_["CD_MUN"]);
                // if(regiao == "amazoniaLegal"){
                //     var obj = datum.filter(function (i,n) {
                //         return i.COD_IBGE === feature.values_['CD_UF'];
                //     })    
                // }else{
                //     var obj = datum.filter(function (i,n) {
                //         return i.COD_IBGE === feature.values_["CD_MUN"];
                //     })
                // }
                // var percent = relative_percentage(obj[0][ano], max, min);
                // // console.log("colorMap(percent)", percent, colorMap(percent/100), "#"+colorMap(percent/100));
    
                // var colorLayer = new ol.style.Style({
                //                     fill: new ol.style.Fill({
                //                         color: "#"+colorMap(percent/100)
                //                     }),
                //                     stroke: new ol.style.Stroke({
                //                         color: 'white',
                //                         // width: 0.5,
                //                     }),
                //                 });

                // // var colorLayer2 = new ol.style.Style({
                // //     // fill: new ol.style.Fill({
                // //     //     color: 'lightgrey'
                // //     // }),
                // //     stroke: new ol.style.Stroke({
                // //         color: '#979797',
                // //     })
                // // })
                
                // dataColor.push({
                //     "color":"#"+colorMap(percent/100),
                //     "value":obj[0][ano]
                // })
                
                // // console.log("obj[0].COD_IBGE", obj[0].COD_IBGE, municipiosSelecionadosPctCOD);
                // if(municipiosSelecionadosPctCOD.includes(obj[0].COD_IBGE)){
                //     // console.log("entrei");
                //     return colorLayer;
                // }else{
                //     return 0;
                //     // return colorLayer2;

                // }
            },
        })
        map.addLayer(vectorLayer);
    
        // Recebe um evento e retorna a feature da camada mais alta
        // map.getFeatureByEvent = function (evt) {
        //     var pixel = evt.pixel;
        //     var topFeature = [];
        //     map.forEachFeatureAtPixel(pixel, function (feature, layer) {
        //         topFeature = feature.getProperties();
        //         console.log("topFeature", topFeature);
        
        //     });
        //     return topFeature;
        // };
        
        // map.on('pointermove', function (evt, layer) {
        //     var feature = map.getFeatureByEvent(evt);
        //     // console.log("feature", feature);
        //     // console.log("layer", layer);
        //     if(feature){
        //         if(regiao = "amazoniaLegal"){
        //             // console.log("feature", feature);
        //             map.overlay.setPosition(evt.coordinate);
        //             // $(map.tooltip).text(feature['NM_UF']+' - '+feature['SIGLA_UF']);
        //             let text = "CÓDIGO: "+feature['CD_GEOCUF']+ "\n" +
        //                         "ESTADO: "+feature['NM_ESTADO']+ "\n" +
        //                         "REGIÃO: "+feature['NM_REGIAO'];
    
        //             // console.log(text);
    
        //             $(map.tooltip).text(text);
        //             $(map.tooltip).show();
        //             this.getTargetElement().style.cursor = 'pointer';
    
        //         }else{
        //             // console.log("feature", feature);
        //             map.overlay.setPosition(evt.coordinate);
        //             // $(map.tooltip).text(feature['NM_UF']+' - '+feature['SIGLA_UF']);
        //             let text = "CD_GEOCODM: "+feature['CD_GEOCODM']+ "\n" +
        //                         "ID: "+feature['ID']+ "\n" +
        //                         "NM_MUNICIP: "+feature['NM_MUNICIP'];
    
        //             // console.log(text);
    
        //             $(map.tooltip).text(text);
        //             $(map.tooltip).show();
        //             this.getTargetElement().style.cursor = 'pointer';
        //         }
        //     }else{
        //         $(map.tooltip).hide();
        //         this.getTargetElement().style.cursor = '';
        //     }
        // });
    
        //hover tooltip
        var selected = null;
        var status = document.getElementById('status');
    
        var unidade = dict.filter(function (i,n) {
            // if(i.Nome == datum[0].INDICADOR){
            //     console.log("entrei");
            // }
            return i.Nome === datum[0].INDICADOR;
        })
        // console.log("datum", datum);
        // console.log("unidade", unidade);
    
        map.on('pointermove', function (e) {
    
            let featureLayer = map.forEachFeatureAtPixel(e.pixel, function (f) {
                selected = f;
                return true;
            });
            var hit = (featureLayer) ? true : false;
    
            if (selected) {
                let F = selected.getProperties()
                if(regiao == "amazoniaLegal"){
                    var obj = datum.filter(function (i,n) {
                        return i.COD_IBGE === F['CD_UF'];
                    })
                    var objPct = municipiosSelecionadosPct.filter(function (i,n){
                        // console.log("i", i);
                        return i.COD === F['CD_UF'];
                    })
                    // console.log("objPct", objPct);
                    if(obj.length != 0){
                        if(unidade[0].Unidade == "R$"){
                            if(hit && typeof(obj[0][ano]) != "undefined"){
                                var text = "<strong>Estado: "+F['NM_UF']+ " - "+F['SIGLA_UF'] +"</strong>" + " | " +
                                            "Indicador: " + obj[0][ano].toLocaleString("pt-BR", { style: "currency" , currency:"BRL"})+ " | " +
                                            territorio + ": " + objPct[0].PCT + " %";
                            }
                        }else{
                            if(hit && typeof(obj[0][ano]) != "undefined"){
                                var text = "<strong>Estado: "+F['NM_UF']+ " - "+F['SIGLA_UF'] +"</strong>" + " | " +
                                            "Indicador: " + obj[0][ano] + " " + unidade[0].Unidade+ " | " +
                                            territorio + ": " + objPct[0].PCT + " %";
                            }
                        }
                    }
    
                }else{
                    var obj = datum.filter(function (i,n) {
                        return i.COD_IBGE === F['CD_MUN'];
                    })
                    var objPct = municipiosSelecionadosPct.filter(function (i,n){
                        // console.log("i", i);
                        return i.COD === F['CD_MUN'];
                    })

                    if(obj.length != 0){
                        if(unidade[0].Unidade == "R$"){
                            if(hit && typeof(obj[0][ano]) != "undefined"){
                                var text = "<strong>Município: "+F['NM_MUN']+ " - "+F['SIGLA_UF']+ "</strong> | " +
                                        "Área (km²): "+F['AREA_KM2']+ " | " +
                                        "Indicador: " + obj[0][ano].toLocaleString("pt-BR", { style: "currency" , currency:"BRL"})+ " | " +
                                        territorio + ": " + objPct[0].PCT + " %";
                            }
                        }else{
                            if(hit && typeof(obj[0][ano]) != "undefined"){
                                var text = "<strong>Município: "+F['NM_MUN']+ " - "+F['SIGLA_UF']+ "</strong> | " +
                                        "Área (km²): "+F['AREA_KM2']+ " | " +
                                        "Indicador: " + obj[0][ano] + " " + unidade[0].Unidade+ " | " +
                                        territorio + ": " + objPct[0].PCT + " %";
                            }
                        }
                    }
                }
                if(typeof(text) != "undefined"){
                    status.innerHTML = text;
                }
                selected = null;
            } else {
                status.innerHTML = ' ';
            }
        });
        
        //hover do style
        var highlightStyle = new ol.style.Style({
            fill: new ol.style.Fill({
                color: '#6D0026',
            }),
            stroke: new ol.style.Stroke({
                color: 'white',
            }),
            
        });
        
        // Aplica o estilo da feature de acordo com o mouse
        var hoverInteraction = new ol.interaction.Select({
            condition: ol.events.condition.pointerMove,
            
            style: function(feature, layer){
                return highlightStyle;
            },
            layers: function (layer) {
                return layer.get('id') == 'regiao';
            },            
        });
        map.addInteraction(hoverInteraction);
        
        // var data = [{"color":"#000004","value":0},
        //             {"color":"#02020c","value":5},
        //             {"color":"#050417","value":10},
        //             {"color":"#0a0722","value":15},
        //             {"color":"#10092d","value":20},
        //             {"color":"#160b39","value":25},
        //             {"color":"#1e0c45","value":30},
        //             {"color":"#260c51","value":35},
        //             {"color":"#2f0a5b","value":40},
        //             {"color":"#380962","value":45},
        //             {"color":"#400a67","value":50},
        //             {"color":"#490b6a","value":55},
        //             {"color":"#510e6c","value":60},
        //             {"color":"#59106e","value":65},
        //             {"color":"#61136e","value":70},
        //             {"color":"#69166e","value":75},
        //             {"color":"#71196e","value":80},
        //             {"color":"#781c6d","value":85},
        //             {"color":"#801f6c","value":90},
        //             {"color":"#88226a","value":95},
        //             {"color":"#902568","value":100},
        //             {"color":"#982766","value":105},
        //             {"color":"#a02a63","value":110},
        //             {"color":"#a82e5f","value":115},
        //             {"color":"#b0315b","value":120},
        //             {"color":"#b73557","value":125},
        //             {"color":"#bf3952","value":130},
        //             {"color":"#c63d4d","value":135},
        //             {"color":"#cc4248","value":140},
        //             {"color":"#d34743","value":145},
        //             {"color":"#d94d3d","value":150},
        //             {"color":"#df5337","value":155},
        //             {"color":"#e45a31","value":160},
        //             {"color":"#e9612b","value":165},
        //             {"color":"#ed6925","value":170},
        //             {"color":"#f1711f","value":175},
        //             {"color":"#f47918","value":180},
        //             {"color":"#f78212","value":185},
        //             {"color":"#f98b0b","value":190},
        //             {"color":"#fa9407","value":195},
        //             {"color":"#fb9d07","value":200},
        //             {"color":"#fca60c","value":205},
        //             {"color":"#fcb014","value":210},
        //             {"color":"#fbba1f","value":215},
        //             {"color":"#fac42a","value":220},
        //             {"color":"#f8cd37","value":225},
        //             {"color":"#f6d746","value":230},
        //             {"color":"#f4e156","value":235},
        //             {"color":"#f2ea69","value":240},
        //             {"color":"#f2f27d","value":245},
        //             {"color":"#f5f992","value":250}];
    
        // console.log("data", data);
    
        
        setTimeout(() => {
    
            dataColor.sort(function (a, b) {
                return a.value - b.value;
            });
            var extent = d3.extent(dataColor, d => d.value);
            // console.log("extent", extent);
            // console.log(dataColor);
        
            
            var padding = 30;
            var width = 360;
            var innerWidth = width - (padding * 2);
            var barHeight = 10;
            var height = 32;
        
            var xScale = d3.scaleLinear()
                .range([0, innerWidth])
                .domain(extent);
        
            // var xTicks = dataColor.filter(f => f.value % 0.05 === 0).map(d => d.value);
            var minColor = dataColor[0]['value'];
            var maxColor = dataColor.pop()['value'];
            var variancia = (maxColor - minColor)/4
               
            var xTicks = [minColor, minColor + variancia, minColor + (variancia*2), minColor + (variancia*3), minColor + (variancia*4)];
            // console.log("xTicks", xTicks, minColor, maxColor);
        
            var xAxis = d3.axisBottom(xScale)
                .tickSize(barHeight * 2)
                .tickValues(xTicks)
                .tickFormat(d3.format(".3s"));
        
            var svg = d3.select("#map_tooltip").append("svg").attr("width", width).attr("height", height);
            var g = svg.append("g").attr("transform", "translate(" + padding + ", 0)");
        
            var defs = svg.append("defs");
            var linearGradient = defs.append("linearGradient").attr("id", "myGradient");
            linearGradient.selectAll("stop")
                .data(dataColor)
                .enter().append("stop")
                .attr("offset", d => ((d.value - extent[0]) / (extent[1] - extent[0]) * 100) + "%")
                .attr("stop-color", d => d.color);
        
            g.append("rect")
                .attr("width", innerWidth)
                .attr("height", barHeight)
                .style("fill", "url(#myGradient)");
        
            g.append("g")
                .call(xAxis)
                .select(".domain").remove();
        }, 650);
    
        $(".ol-zoom-in").text("");
        $(".ol-zoom-out").text("");

        setTimeout(() => {
            for (let index = 1; index < 6; index++) {
                let label = document.querySelector("#map_tooltip > svg > g > g > g:nth-child("+ index +") > text").textContent;
                if(label.includes("k")){
                    label = label.replace("k", " Mil");
                    document.querySelector("#map_tooltip > svg > g > g > g:nth-child("+ index +") > text").textContent = label;
                }else if(label.includes("M")){
                    label = label.replace("M", " Milhões");
                    document.querySelector("#map_tooltip > svg > g > g > g:nth-child("+ index +") > text").textContent = label;
                }else if(label.includes("G")){
                    label = label.replace("G", " Bilhões");
                    document.querySelector("#map_tooltip > svg > g > g > g:nth-child("+ index +") > text").textContent = label;
                }else if(label.includes("m")){
                    label = label.replace("m", "");
                    label = label/1000;
                    document.querySelector("#map_tooltip > svg > g > g > g:nth-child("+ index +") > text").textContent = label;
                }
            }
        }, 780);
    });    
}
