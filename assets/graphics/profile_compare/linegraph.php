<?php 

include_once("../../../assets/linechart.css"); 

/*View dos gráficos de linha*/

$height = "260px";

if(isset($_GET["height"]))
  $height = $_GET["height"];

 $municipio_consulta_sql = $_SESSION['cod_ibge'];
    $stmt = $pdo->prepare("SELECT * FROM `indicador_educacao_tx_matr_creche_pop_0_a_3_anos` WHERE `cod_ibge` = '" . $municipio_consulta_sql . "'");
    $stmt->execute();
    $data = [];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        //print_r($row);
		$nome_municipio = $row['nome_municipio'];
		$tx['2009'] = $row['2009']; 
		$tx['2010'] = $row['2010']; 
		$tx['2011'] = $row['2011']; 
		$tx['2012'] = $row['2012']; 
		$tx['2013'] = $row['2013']; 
		$tx['2014'] = $row['2014']; 
		$tx['2015'] = $row['2015']; 
		$tx['2016'] = $row['2016']; 
		$tx['2017'] = $row['2017']; 
		$tx['2018'] = $row['2018']; 
		$tx['2019'] = $row['2019']; 
   }

   unset($stmt);

    $stmt = $pdo->prepare("SELECT * FROM `indicador_educacao_tx_matr_creche_pop_0_a_3_anos` WHERE `cod_ibge` = 123456");
    $stmt->execute();
    $data = [];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        //print_r($row);
    $tx_media['2009'] = $row['2009']; 
    $tx_media['2010'] = $row['2010']; 
    $tx_media['2011'] = $row['2011']; 
    $tx_media['2012'] = $row['2012']; 
    $tx_media['2013'] = $row['2013']; 
    $tx_media['2014'] = $row['2014']; 
    $tx_media['2015'] = $row['2015']; 
    $tx_media['2016'] = $row['2016']; 
    $tx_media['2017'] = $row['2017']; 
    $tx_media['2018'] = $row['2018']; 
    $tx_media['2019'] = $row['2019']; 
   }

   unset($stmt);
   $pdo = null;

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>grafico</title>

<!-- Styles -->
<style>
#chartdiv10 {
  width: 100%;
  height: <?php echo $height; ?>;
}

body {
	font-family: "Roboto Condensed";
	font-size: 1em;
	color: #575756;
}	
	
#nulldatawarningdiv {
  position: absolute;
  margin-top: -18px;
  height: 19px;
  background: -moz-linear-gradient(left, white 8%, rgb(240, 240, 240) 8% 100%);
  background: -webkit-linear-gradient(left, white 8%, rgb(240, 240, 240) 8% 100%);
  background: -linear-gradient(left, white 8%, rgb(240, 240, 240) 8% 100%);
  width: 661px;
  font-size: 13px;
  text-align: center;
  font-family: "Roboto Condensed";
  padding: 2px 1px 0px;
  letter-spacing: 0.01em;
  color:#777;
  height: 23px;
} 

#nulldatawarningdiv span {
  height: 19px;
  vertical-align: middle;
  margin: 5px;
  margin-top: 5px;
  display: inline-block;
  margin-top: 1px;
}
	
</style>
<!-- Chart code -->
<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv10", am4charts.XYChart);

chart.colors.list = [
  am4core.color("#F3BF5E"),
  am4core.color("#947738")
];

//adiciona simbolo percentual aos dados
chart.numberFormatter.numberFormat = "#'%'";	

<?php $isnulldata = false;	// variável usada para saber se precisa exibir msg geral de tem dado ausente ?>

// Add data
chart.data = [{
  "date": "2009"// necessario somente para exibir a escala apropriada
},{
  "date": "2009",
  <?php $isnulldata = am4chart_sparse_bd_column($tx['2009'],"taxaserie", false, $isnulldata); ?>
  <?php $isnulldata = am4chart_sparse_bd_column($tx_media['2009'],"media", true, $isnulldata);?>
},{
  "date": "2010",
  <?php $isnulldata = am4chart_sparse_bd_column($tx['2010'],"taxaserie", false, $isnulldata); ?>
  <?php $isnulldata = am4chart_sparse_bd_column($tx_media['2010'],"media", true, $isnulldata); ?>
},{
  "date": "2011",
  <?php $isnulldata = am4chart_sparse_bd_column($tx['2011'],"taxaserie", false, $isnulldata); ?>
  <?php $isnulldata = am4chart_sparse_bd_column($tx_media['2011'],"media", true, $isnulldata); ?>
},{
  "date": "2012",
  <?php $isnulldata = am4chart_sparse_bd_column($tx['2012'],"taxaserie", false, $isnulldata); ?>
  <?php $isnulldata = am4chart_sparse_bd_column($tx_media['2012'],"media", true, $isnulldata); ?>
},{
  "date": "2013",
  <?php $isnulldata = am4chart_sparse_bd_column($tx['2013'],"taxaserie", false, $isnulldata); ?>
  <?php $isnulldata = am4chart_sparse_bd_column($tx_media['2013'],"media", true, $isnulldata) ; ?>
},{
  "date": "2014",
  <?php $isnulldata = am4chart_sparse_bd_column($tx['2014'],"taxaserie", false, $isnulldata); ?>
  <?php $isnulldata = am4chart_sparse_bd_column($tx_media['2014'],"media", true, $isnulldata); ?>
},{
  "date": "2015",
  <?php $isnulldata = am4chart_sparse_bd_column($tx['2015'],"taxaserie", false, $isnulldata); ?>
  <?php $isnulldata = am4chart_sparse_bd_column($tx_media['2015'],"media", true, $isnulldata); ?>
},{
  "date": "2016",
  <?php $isnulldata = am4chart_sparse_bd_column($tx['2016'],"taxaserie", false, $isnulldata); ?>
  <?php $isnulldata = am4chart_sparse_bd_column($tx_media['2016'],"media", true, $isnulldata); ?>
},{
  "date": "2017",
  <?php $isnulldata = am4chart_sparse_bd_column($tx['2017'],"taxaserie", false, $isnulldata); ?>
  <?php $isnulldata = am4chart_sparse_bd_column($tx_media['2017'],"media", true, $isnulldata); ?>
}, {
  "date": "2018",
  <?php $isnulldata = am4chart_sparse_bd_column($tx['2018'],"taxaserie", false, $isnulldata); ?>
  <?php $isnulldata = am4chart_sparse_bd_column($tx_media['2018'],"media", true, $isnulldata); ?>
}, {
  "date": "2019",
  <?php $isnulldata = am4chart_sparse_bd_column($tx['2019'],"taxaserie", false, $isnulldata); ?>
  <?php $isnulldata = am4chart_sparse_bd_column($tx_media['2019'],"media", true, $isnulldata); ?>
}];


// Create axes
var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
dateAxis.renderer.grid.template.location = 0;
dateAxis.renderer.minGridDistance = 10;

var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.logarithmic = false;
valueAxis.renderer.minGridDistance = 20; //padrão do amcharts 20, com 15 exibe os decimais

valueAxis.renderer.labels.template.adapter.add("text", (label, target, key) => {
  if (target.dataItem && (target.dataItem.value > 100 )) {
    return "";
  } else {
    return label;
  }
});

// Axis tooltip Category
let axisTooltip = dateAxis.tooltip;
axisTooltip.background.fill = am4core.color("#575756");
axisTooltip.background.strokeWidth = 0;

// Axis tooltip Value
let axisTooltip2 = valueAxis.tooltip;
axisTooltip2.background.fill = am4core.color("#575756");
axisTooltip2.background.strokeWidth = 0;
axisTooltip2.dx = 5;
    
// Create series
var series = chart.series.push(new am4charts.LineSeries());
series.dataFields.valueY = "taxaserie";
series.dataFields.dateX = "date";
series.tensionX = 0.8;
series.strokeWidth = 6;
var bullet = series.bullets.push(new am4charts.CircleBullet());
bullet.circle.fill = am4core.color("#fff");
bullet.circle.strokeWidth = 3;
series.tooltipText = "{valueY}[/]";
    
//legenda desta serie
series.name = "<?php echo $nome_municipio; ?>";

var series2 = chart.series.push(new am4charts.LineSeries());
series2.dataFields.dateX = "date";
series2.dataFields.valueY = "media";
series2.tensionX = 0.8;
series2.strokeWidth = 3;
var bullet = series2.bullets.push(new am4charts.CircleBullet());
bullet.circle.fill = am4core.color("#fff");
bullet.circle.strokeWidth = 3;
series2.tooltipText = "{valueY}[/]";

//legenda desta serie
series2.name = "Média dos 100+";   

// descontinuidade
series.connect = false;
series2.connect = false;


// Add cursor
chart.cursor = new am4charts.XYCursor();
chart.cursor.fullWidthLineX = true;
chart.cursor.xAxis = dateAxis;
chart.cursor.lineX.strokeWidth = 0;
chart.cursor.lineX.fill = am4core.color("#000");
chart.cursor.lineX.fillOpacity = 0.1;

// legendas    
chart.legend = new am4charts.Legend();
series.hiddenInLegend = false;
series2.hiddenInLegend = false;

// padrão numérico brasileiro
chart.language.locale["_decimalSeparator"] = ",";
chart.language.locale["_thousandSeparator"] = ".";    
    
}); // end am4core.ready()

</script>

	
	
</head>

<body>
	<!-- HTML -->
   <div id="chartdiv10"></div>

  <?php if($isnulldata){ ?>
   <div id="nulldatawarningdiv" onload="">
      <img class="warning-icon" src="images/svg/warning.svg"/><span>O município não tem os dados completos no intervalo considerado.</span>  
    </div>
  <?php } ?>

</body>
</html>