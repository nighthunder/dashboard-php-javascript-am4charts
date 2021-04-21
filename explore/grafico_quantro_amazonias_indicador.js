function graficoQuatroAmazoniasIndicador (regiao, indicador, label1, unidade1, area, territorio, label2, unidade2, data, dict, dict4Amazonias){

	var indicadorSelecionado = indicador.replace("dados_mun_atlas_", "").toUpperCase();

	var indicadorData = dict.filter(function(i,n){
		return i.Nome == indicadorSelecionado;
	});

	var ultimoAno = indicadorData[0]['Fim'];

	var dataTotal = filtroQuatroAmazonias(regiao, data, ultimoAno, dict4Amazonias, territorio);

	console.log("dataTotal", dataTotal);
	console.log("data", data);

	$('#myChart').remove(); // this is my <canvas> element
	$("body > div.app-container > div.app-main > div.app-main__outer > div > div.tabs-animation > div > div.col-sm-12.col-lg-7 > div > div > div").append('<canvas id="myChart"><canvas>');

	var ctx = document.getElementById("myChart").getContext('2d');

	$("#myChart").height($("body > div.app-container > div.app-main > div.app-main__outer > div > div.tabs-animation > div > div.col-sm-12.col-lg-7 > div > div").height() - 40);

	var colors = ['#811548','#935C2A','#E94D21','#F7892F', '#F9BD5D', '#8D9191','#D1D1D1','#95D2D9','#3AC09A']

	var datasets = [];
	for (let i = 0; i < dataTotal.length; i++) {
		const element = dataTotal[i];
		console.log("dataTotal", dataTotal[i]);
		datasets.push({
			label: element[0].REGIAO,
			borderColor: colors[i],  
			backgroundColor: colors[i],
			data: element,
			pointRadius: 6,
		})
	}
	var scatterChartData = {
		datasets: datasets,
	};

	// End Defining data
	var options = {responsive: true, // Instruct chart js to respond nicely.
		maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height
	    pointHitDetectionRadius : 1,
		scales: {
			xAxes: [{
				display: true,
				scaleLabel: {
					display: true,
					fontFamily: 'Open Sans, sans-serif',
					fontColor: '#495057',
					fontStyle: "bold",
					fontSize: 14,
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
					fontSize: 14,
					labelString: ( label2 + " " + unidade2 ).toUpperCase(),
				},
			}],
		},
		tooltips: {
			callbacks: {
				title: function(tooltipItem, data) {
					// console.log("tooltipItemtitle, datatitle", tooltipItem, data);
					return data['datasets'][tooltipItem[0]['datasetIndex']]['data'][tooltipItem[0]['index']]['MICROREGIAO'];
				},
				label: function(tooltipItem, data) {
					// console.log("tooltipItemlabel, datalabel", tooltipItem, data);
					return 'X: ' + tooltipItem['label'];
					// return 'X: ' + data.datasets[tooltipItem.datasetIndex].label;
				},
				afterLabel: function(tooltipItem, data) {
					// console.log("tooltipItemafterLabel, dataafterLabel", tooltipItem, data);
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