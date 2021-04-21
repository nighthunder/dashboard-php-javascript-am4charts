
function graficoIndicadorIndicador(regiao, area1, indicador1, label1, unidade1, area2, indicador2, label2, unidade2, anoIndicador, data1, data2, dict){
	
	// console.log("anoindicador", anoIndicador); // anos de intersecção entre os indicadores
	let data1Pos = (data1 || []).filter(function (i,n) { // dados do primeiro indicador
		return regiao.includes(i.MICROREGIAO) ;
	})
	let data2Pos = (data2 || []).filter(function (i,n) { // dados do segundo indicador
		return regiao.includes(i.MICROREGIAO) ;
	})

	var datum1 = []; // cada array é um série no gráfico
	var datum2 = [];
	var datum3 = [];
	var datum4 = [];
	var datum5 = [];
	var datum6 = [];
	var datum7 = [];
	var datum8 = [];
	var datum9 = [];
	var datum10 = [];
	var datum11 = [];
	var datumTotal = [];

	var point = [];
	for (let i = 0; i < data1Pos.length; i++) {
		var element1 = data1Pos[i];
		var element2 = data2Pos[i];
		// console.log("element1", element1);
		// console.log("element2", element2);
		for (let j = 0; j < anoIndicador.length; j++) { 
			var elementAno = anoIndicador[j];
			if(j == 0){
				point.push(anoIndicador[j]);
				datum1.push({
					'x': element1[elementAno],
					'y': element2[elementAno],
					'regiao': element2.MICROREGIAO
				})

			}else if (j == 1){
				point.push(anoIndicador[j]);
				datum2.push({
					'x': element1[elementAno],
					'y': element2[elementAno],
					'regiao': element2.MICROREGIAO

				})
			}else if (j == 2){
				point.push(anoIndicador[j]);
				datum3.push({
					'x': element1[elementAno],
					'y': element2[elementAno],
					'regiao': element2.MICROREGIAO

				})
			}else if (j == 3){
				point.push(anoIndicador[j]);
				datum4.push({
					'x': element1[elementAno],
					'y': element2[elementAno],
					'regiao': element1.MICROREGIAO

				})
			}else if (j == 4){
				point.push(anoIndicador[j]);
				datum5.push({
					'x': element1[elementAno],
					'y': element2[elementAno],
					'regiao': element1.MICROREGIAO

				})
			}else if (j == 5){
				point.push(anoIndicador[j]);
				datum6.push({
					'x': element1[elementAno],
					'y': element2[elementAno],
					'regiao': element1.MICROREGIAO

				})
			}else if (j == 6){
				point.push(anoIndicador[j]);
				datum7.push({
					'x': element1[elementAno],
					'y': element2[elementAno],
					'regiao': element1.MICROREGIAO

				})
			}else if (j == 7){
				point.push(anoIndicador[j]);
				datum8.push({
					'x': element1[elementAno],
					'y': element2[elementAno],
					'regiao': element1.MICROREGIAO

				})
			}else if (j == 8){
				point.push(anoIndicador[j]);
				datum9.push({
					'x': element1[elementAno],
					'y': element2[elementAno],
					'regiao': element1.MICROREGIAO

				})
			}else if (j == 9){
				point.push(anoIndicador[j]);
				datum10.push({
					'x': element1[elementAno],
					'y': element2[elementAno],
					'regiao': element1.MICROREGIAO

				})
			}else if (j == 10){
				point.push(anoIndicador[j]);
				datum11.push({
					'x': element1[elementAno],
					'y': element2[elementAno],
					'regiao': element1.MICROREGIAO

				})
			}
			// datumTotal.push(new Array(new Object ({
			// 	'x': element1[elementAno],
			// 	'y': element2[elementAno],
			// 	'regiao': element2.MICROREGIAO

			//  })));
		}
	}

	datumTotal.push(datum1,datum2,datum3, datum4, datum5,datum6,datum7,datum8,datum9,datum10, datum11);
	// console.log("point", point);
	 console.log("datumTotal", datumTotal);
	
	$('#myChart').remove(); // this is my <canvas> element
	$("body > div.app-container > div.app-main > div.app-main__outer > div > div.tabs-animation > div > div.col-sm-12.col-lg-7 > div > div > div").append('<canvas id="myChart"><canvas>');

	var ctx = document.getElementById("myChart").getContext('2d');

	$("#myChart").height($("body > div.app-container > div.app-main > div.app-main__outer > div > div.tabs-animation > div > div.col-sm-12.col-lg-7 > div > div").height() - 40);

	// var	chartColors = {
	// 	red: 'rgb(255, 99, 132)',
	// 	orange: 'rgb(255, 159, 64)',
	// 	yellow: 'rgb(255, 205, 86)',
	// 	green: 'rgb(75, 192, 192)',
	// 	blue: 'rgb(54, 162, 235)',
	// 	purple: 'rgb(153, 102, 255)',
	// 	grey: 'rgb(201, 203, 207)',

	// 	acai: '#811548',
	// 	verdeClaro: '#3AC09A',
	// 	// acai: '#3AC09A',

	// };

	var colors = ['#811548','#3AC09A','#F7892F','#F9BD5D','#E94D21', '#95D2D9', '#D1D1D1', '#8D9191','#935C2A']

	var datasets = [];

	for (let i = 0; i < anoIndicador.length; i++) {
		const element = anoIndicador[i];
		datasets.push({
			label: element,
			borderColor: colors[i],  
			backgroundColor: colors[i],
			data: datumTotal[i],
			pointRadius: 6,
		})
	}
	//console.log("datasets", datasets);
	var scatterChartData = {
		datasets: datasets,
	};

	// var scatterChartData = {
	// 	datasets: [
	// 		{
	// 			label: anoIndicador[0],
	// 			borderColor: chartColors.acai,  
	// 			backgroundColor: chartColors.acai,
	// 			data: datum1,
	// 			pointRadius: 6,
	// 		}, 
	// 		{
	// 			label: anoIndicador[1],
	// 			borderColor: chartColors.verdeClaro,  
	// 			backgroundColor: chartColors.verdeClaro,
	// 			data: datum2,
	// 			pointRadius: 6,
	// 		}
	// 	]
	// };
	// End Defining data
	var options = {responsive: true, // Instruct chart js to respond nicely.
		maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height 
		scales: {
			xAxes: [{
				display: true,
				scaleLabel: {
					display: true,
					fontFamily: 'Open Sans, sans-serif',
					fontColor: '#495057',
					fontStyle: "bold",
					fontSize: 12, 
					labelString: ( label1 + " " + unidade1 ).toUpperCase(),
				},
            }],
            yAxes: [{
				display: true,
				scaleLabel: {
					display: true,
					fontFamily: 'Open Sans, sans-serif',
					fontColor: '#495057',
					fontStyle: "bold",
					fontSize: 12,
					labelString: ( label2 + " " + unidade2 ).toUpperCase(),
				},
			}],
		},
		tooltips: {
			callbacks: {
				title: function(tooltipItem, data) {
					return data['datasets'][0]['data'][tooltipItem[0]['index']]['regiao'];
				},
				label: function(tooltipItem, data) {
					return 'X: ' + tooltipItem['label'];
				},
				afterLabel: function(tooltipItem, data) {
					return 'Y: ' + tooltipItem['value'];
				}
			},
			titleFontFamily: 'Open Sans, sans-serif',
			backgroundColor: '#F5F5F5',
			titleFontSize: 16,
			titleFontColor: '#6B163D',
			bodyFontColor: '#000',
			bodyFontSize: 14,
			displayColors: false
		},
		legend: {
			display: true,
			fontFamily: 'Open Sans, sans-serif',
			position: "right",
			labels: {
				usePointStyle: true,
				boxWidth: 6,
				padding: 25,
				usePointStyle: true,
				fontSize: 11
			},

        }
	};

	// End Defining data
	var myChart = new Chart(ctx, {
		type: 'scatter',
		data: scatterChartData,
		options: options
	});

};
