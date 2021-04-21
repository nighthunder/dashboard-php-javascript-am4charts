function filtroQuatroAmazonias(regiao, data, ultimoAno, dict4Amazonias, territorio) {

	var dataTotal = []
	
	for (let i = 0; i < regiao.length; i++) {
		let element = regiao[i];
		switch (element) {
			case "Amazonas":
				var dataAmazonas = []
				let dataLocalAmazonas = data.filter(function (i,n){
					return i.REGIAO == element;
				});
				for (let i = 0; i < dataLocalAmazonas.length; i++) {
					let elementLocal = dataLocalAmazonas[i];
					var munDataAmazonas = dict4Amazonias.filter(function(i,n){
						return i.NOME == elementLocal.MICROREGIAO && i.TERRITORIO == territorio;
					});
					dataAmazonas.push({
						'x': elementLocal[ultimoAno],
						'y': munDataAmazonas[0].PCT,
						'MICROREGIAO': elementLocal.MICROREGIAO,
						'REGIAO': elementLocal.REGIAO,
					})
				}
				dataTotal.push(dataAmazonas)
				continue;
			case "Acre":
				var dataAcre = []
				let dataLocalAcre = data.filter(function (i,n){
					return i.REGIAO == element;
				});
				for (let i = 0; i < dataLocalAcre.length; i++) {
					let elementLocal = dataLocalAcre[i];
					var munDataAcre = dict4Amazonias.filter(function(i,n){
						return i.NOME == elementLocal.MICROREGIAO && i.TERRITORIO == territorio;
					});
					dataAcre.push({
						'x': elementLocal[ultimoAno],
						'y': munDataAcre[0].PCT,
						'MICROREGIAO': elementLocal.MICROREGIAO,
						'REGIAO': elementLocal.REGIAO,
					})
				}
				dataTotal.push(dataAcre)
				continue;
			case "Amapá":
				var dataAmapa = []
				let dataLocalAmapa = data.filter(function (i,n){
					return i.REGIAO == element;
				});
				for (let i = 0; i < dataLocalAmapa.length; i++) {
					let elementLocal = dataLocalAmapa[i];
					var munDataAmapa = dict4Amazonias.filter(function(i,n){
						return i.NOME == elementLocal.MICROREGIAO && i.TERRITORIO == territorio;
					});
					dataAmapa.push({
						'x': elementLocal[ultimoAno],
						'y': munDataAmapa[0].PCT,
						'MICROREGIAO': elementLocal.MICROREGIAO,
						'REGIAO': elementLocal.REGIAO,
					})
				}
				dataTotal.push(dataAmapa)
				continue;
			case "Roraima":
				var dataRoraima = []
				let dataLocalRoraima = data.filter(function (i,n){
					return i.REGIAO == element;
				});
				for (let i = 0; i < dataLocalRoraima.length; i++) {
					let elementLocal = dataLocalRoraima[i];
					var munDataRoraima = dict4Amazonias.filter(function(i,n){
						return i.NOME == elementLocal.MICROREGIAO && i.TERRITORIO == territorio;
					});
					dataRoraima.push({
						'x': elementLocal[ultimoAno],
						'y': munDataRoraima[0].PCT,
						'MICROREGIAO': elementLocal.MICROREGIAO,
						'REGIAO': elementLocal.REGIAO,
					})
				}
				dataTotal.push(dataRoraima)
				continue;
			case "Rondônia":
				var dataRodonia = []
				let dataLocalRodonia = data.filter(function (i,n){
					return i.REGIAO == element;
				});
				for (let i = 0; i < dataLocalRodonia.length; i++) {
					let elementLocal = dataLocalRodonia[i];
					var munDataRondonia = dict4Amazonias.filter(function(i,n){
						return i.NOME == elementLocal.MICROREGIAO && i.TERRITORIO == territorio;
					});
					dataRodonia.push({
						'x': elementLocal[ultimoAno],
						'y': munDataRondonia[0].PCT,
						'MICROREGIAO': elementLocal.MICROREGIAO,
						'REGIAO': elementLocal.REGIAO,
					})
				}
				dataTotal.push(dataRodonia)
				continue;
			case "Pará":
				var dataPara = []
				let dataLocalPara = data.filter(function (i,n){
					return i.REGIAO == element;
				});
				for (let i = 0; i < dataLocalPara.length; i++) {
					let elementLocal = dataLocalPara[i];
					var munDataPara = dict4Amazonias.filter(function(i,n){
						return i.NOME == elementLocal.MICROREGIAO && i.TERRITORIO == territorio;
					});
					dataPara.push({
						'x': elementLocal[ultimoAno],
						'y': munDataPara[0].PCT,
						'MICROREGIAO': elementLocal.MICROREGIAO,
						'REGIAO': elementLocal.REGIAO,
					})
				}
				dataTotal.push(dataPara)
				continue;
			case "Maranhão":
				var dataMaranhao = []
				let dataLocalMaranhao = data.filter(function (i,n){
					return i.REGIAO == element;
				});
				for (let i = 0; i < dataLocalMaranhao.length; i++) {
					let elementLocal = dataLocalMaranhao[i];
					var munDataMaranhao = dict4Amazonias.filter(function(i,n){
						return i.NOME == elementLocal.MICROREGIAO && i.TERRITORIO == territorio;
					});
					dataMaranhao.push({
						'x': elementLocal[ultimoAno],
						'y': munDataMaranhao[0].PCT,
						'MICROREGIAO': elementLocal.MICROREGIAO,
						'REGIAO': elementLocal.REGIAO,
					})
				}
				dataTotal.push(dataMaranhao)
				continue;
			case "Mato Grosso":
				var dataMatoGrosso = []
				let dataLocalMatoGrosso = data.filter(function (i,n){
					return i.REGIAO == element;
				});
				for (let i = 0; i < dataLocalMatoGrosso.length; i++) {
					let elementLocal = dataLocalMatoGrosso[i];
					var munDataMatoGrosso = dict4Amazonias.filter(function(i,n){
						return i.NOME == elementLocal.MICROREGIAO && i.TERRITORIO == territorio;
					});
					dataMatoGrosso.push({
						'x': elementLocal[ultimoAno],
						'y': munDataMatoGrosso[0].PCT,
						'MICROREGIAO': elementLocal.MICROREGIAO,
						'REGIAO': elementLocal.REGIAO,
					})
				}
				dataTotal.push(dataMatoGrosso)
				continue;
			case "Tocantins":
				var dataTocantins = []
				let dataLocalTocantins = data.filter(function (i,n){
					return i.REGIAO == element;
				});
				for (let i = 0; i < dataLocalTocantins.length; i++) {
					let elementLocal = dataLocalTocantins[i];
					var munDataTocantins = dict4Amazonias.filter(function(i,n){
						return i.NOME == elementLocal.MICROREGIAO && i.TERRITORIO == territorio;
					});
					dataTocantins.push({
						'x': elementLocal[ultimoAno],
						'y': munDataTocantins[0].PCT,
						'MICROREGIAO': elementLocal.MICROREGIAO,
						'REGIAO': elementLocal.REGIAO,
					})
				}
				dataTotal.push(dataTocantins)
				continue;			
			default:
				continue;
		}
	}

	return dataTotal;
}	