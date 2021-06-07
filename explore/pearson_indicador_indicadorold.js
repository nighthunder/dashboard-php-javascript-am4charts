function pearsonIndicadorIndicador(regiao, area1, indicador1, label1, area2, indicador2, label2, anoIndicador, data1, data2, dict){

    //console.log("regiao, area1, indicador1, label1, area2, indicador2, label2, data1, data2, dict", regiao, area1, indicador1, label1, area2, indicador2, label2, anoIndicador, data1, data2, dict);
    // console.log("data1", data1);
    // console.log("data2", data2);
    // console.log("anoIndicador", anoIndicador);
    // console.log("regiao", regiao);

    var arrayX = [];
    var arrayY = [];
    for (let i = 0; i < regiao.length; i++) {
    	let element = regiao[i];
    	for (let j = 0; j < anoIndicador.length; j++) {
					let element2 = anoIndicador[j];
				let auxX = (data1 || []).filter(function(i,n){
					return i.MICROREGIAO == element;
				});
				let auxY = (data2 || []).filter(function(i,n){
					return i.MICROREGIAO == element;
				});

				//console.log("element2", element2);
				const X = parseFloat((auxX[0] || [])[element2]);
				const Y = parseFloat((auxY[0] || [])[element2])
				arrayX.push(isNaN(X) ? 0 : X);
				arrayY.push(isNaN(Y) ? 0 : Y);

    	}
    }		

	// var arrayx = "";
	// var arrayy = "";

	// for(i=0;i<arrayX.length;i++){
	// 	arrayx = arrayx + "," +  arrayX[i];
	// 	arrayy = arrayy + "," +  arrayY[i];
	// }

	// console.log("arrayx", arrayx);
	// console.log("arrayy", arrayy);
   
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

	function financial(x) {
		return Number.parseFloat(x).toFixed(2);
	}

	function notePearson(){
		// var pearson = toFixed(getPearsonCorrelation(arrayX,arrayY),2);
		var pearson = getPearsonCorrelation(arrayX,arrayY);
		//console.log("Pearson", pearson);

		if (isNaN(pearson)){
			pearson = "-";

			// if ($(".indicador").text() === $(".indicador"))
		}else if(financial(pearson.toString()) == "-0.00" || financial(pearson.toString()) == "0.00"){
			pearson = "0";
		}else{
			pearson = financial(pearson);
		}
		
		$('#coefi-person').html("");
		$('#coefi-person').html(pearson.toString().replace(".",","));

		param1 = "";
		ind1 = document.querySelector(".indicador1 option:checked").textContent.replace('Indicador 1', '');
		ind2 = document.querySelector(".indicador2 option:checked").textContent.replace('Indicador 2', '');
		// console.log("indicador1", ind1);
		// console.log("indicador2", ind2);
		param2 = "";
		
		if( pearson > 0.5){ 
			param1 = "Há";param2 = "positiva";
			notePearson = param1+" uma relação "+param2+" de <b>"+pearson.toString().replace(".",",")+"</b> entre <b>"+ind1+"</b> e <b>"+ind2+
			"</b>, considerando as observações selecionadas e apresentadas no gráfico.";
		}
		else if ( pearson < -0.5){  
			param1 = "Há";param2 = "negativa";
			notePearson = param1+" uma relação "+param2+" de <b>"+pearson.toString().replace(".",",")+"</b> entre <b>"+ind1+"</b> e <b>"+ind2+
			"</b>, considerando as observações selecionadas e apresentadas no gráfico.";
		}
		else{ 
			param1 = "Não há";param2 = "significativa"; 
			notePearson = param1+" uma relação "+param2+" entre <b>"+ind1+"</b> e <b>"+ind2+
			"</b>, considerando as observações selecionadas e apresentadas no gráfico.";
		}

		$('#notePearson').html("");
		$('#notePearson').html("<p class='note text-center'>"+notePearson+"</p><br/>");
	}

	notePearson();		

};