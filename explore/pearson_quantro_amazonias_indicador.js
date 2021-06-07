function pearsonQuatroAmazoniasIndicador(regiao, indicador, label1, area, territorio, label2, data, dict, dict4Amazonias){

	var indicadorSelecionado = indicador.replace("dados_mun_atlas_", "").toUpperCase();

	var indicadorData = dict.filter(function(i,n){
		return i.Nome == indicadorSelecionado;
	});

	var ultimoAno = indicadorData[0]['Fim'];

	var dataTotal = filtroQuatroAmazonias(regiao, data, ultimoAno, dict4Amazonias, territorio);

    var arrayX = [];
    var arrayY = [];

    for (let i = 0; i < dataTotal.length; i++) {
    	let element = dataTotal[i];
    	for (let j = 0; j < element.length; j++) {
    		let elementAtual = element[j];
    		if (isNaN(elementAtual["y"]) || isNaN(elementAtual["x"])){
    			//console.log("é nan");
    		}else{
    			//console.log("nanan");
    			arrayX.push(parseFloat(elementAtual["x"]));
    			arrayY.push(parseFloat(elementAtual["y"]));
    		}

    	}
    }	

	// console.log("arrayX", arrayX);
	// console.log("arrayY", arrayY);
   
    function getPearsonCorrelation(x, y) {
	    var shortestArrayLength = 0;
	     
	    if(x.length == y.length) {
	        shortestArrayLength = x.length;
	    } else if(x.length > y.length) {
	        shortestArrayLength = y.length;
	        console.error('x has more items in it, the last ' + (x.length - shortestArrayLength) + ' item(s) will be ignored');
	    } else {
	        shortestArrayLength = x.length;
	        console.error('y has more items in it, the last ' + (y.length - shortestArrayLength) + ' item(s) will be ignored');
	    }
	  
	    var xy = [];
	    var x2 = [];
	    var y2 = [];
	  
	    for(var i=0; i<shortestArrayLength; i++) {
	        xy.push(x[i] * y[i]);
	        x2.push(x[i] * x[i]);
	        y2.push(y[i] * y[i]);
	    }
	  
	    var sum_x = 0;
	    var sum_y = 0;
	    var sum_xy = 0;
	    var sum_x2 = 0;
	    var sum_y2 = 0;
	  
	    for(var i=0; i< shortestArrayLength; i++) {
	        sum_x += x[i];
	        sum_y += y[i];
	        sum_xy += xy[i];
	        sum_x2 += x2[i];
	        sum_y2 += y2[i];
	    }
	  
	    var step1 = (shortestArrayLength * sum_xy) - (sum_x * sum_y);
	    var step2 = (shortestArrayLength * sum_x2) - (sum_x * sum_x);
	    var step3 = (shortestArrayLength * sum_y2) - (sum_y * sum_y);
	    var step4 = Math.sqrt(step2 * step3);
	    var answer = step1 / step4;
	  
	    return answer;
	}

	function toFixed(num, fixed) { // truncate
	    var re = new RegExp('^-?\\d+(?:\.\\d{0,' + (fixed || -1) + '})?');
	    return num.toString().match(re)[0];
	}

	function notePearson(){

		var pearson = getPearsonCorrelation(arrayX,arrayY);

		if (isNaN(pearson)){
			pearson = "-";
		}else if(toFixed(pearson,2) == "-0.00" || toFixed(pearson,2) == "0.00"){
			pearson = "0";
		}else{
			pearson = toFixed(pearson,2);
		}
		//console.log("pearson", pearson);
		$('#coefi-person').html("");
		$('#coefi-person').html(pearson.toString().replace(".",","));

		param1 = "";
		ind1 = document.querySelector(".indicador option:checked").textContent.replace('Indicador 1', '');
		territorio = document.querySelector(".territorio option:checked").textContent.replace('Indicador 2', '');
		// console.log("indicador1", ind1);
		// console.log("indicador2", ind2);
		param2 = "";	

		if( parseFloat(pearson) > 0.5){ 
			param1 = "Há";param2 = "positiva";
			notePearson = param1+" uma relação "+param2+" de <b>"+pearson.toString().replace(".",",")+"</b> entre <b>"+ind1+"</b> e o percentual da área do município classificada como <b>"+territorio+
			"</b>, considerando as observações selecionadas e apresentadas no gráfico.";
		}
		else if ( parseFloat(pearson) < -0.5){  
			param1 = "Há";param2 = "negativa";
			notePearson = param1+" uma relação "+param2+" de <b>"+pearson.toString().replace(".",",")+"</b> entre <b>"+ind1+"</b> e o percentual da área do município classificada como <b>"+territorio+
			"</b>, considerando as observações selecionadas e apresentadas no gráfico.";
		}
		else{ 
			param1 = "Não há";param2 = "significativa"; 
			notePearson = param1+" uma relação "+param2+" entre <b>"+ind1+"</b> e o percentual da área do município classificada como <b>"+territorio+
			"</b>, considerando as observações selecionadas e apresentadas no gráfico.";
		}

		$('#notePearson').html("");
		$('#notePearson').html(""+notePearson+"<br/>");
	}

	notePearson();	

};