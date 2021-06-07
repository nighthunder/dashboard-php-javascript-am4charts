
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);

// Themes end
am4core.options.autoSetClassName = true; // classes no svg
var mainContainer = am4core.create("chartdiv937567506", am4core.Container);
mainContainer.width = am4core.percent(100);
mainContainer.height = am4core.percent(100);
mainContainer.layout = "horizontal";

// Create chart instance
var chart = am4core.create("chartdiv937567506", am4charts.XYChart);

chart.colors.list = [
am4core.color('#3AC09A'),am4core.color('#3AC09A'),am4core.color('#811548'),am4core.color('#811548')];
var data = [{'category':'0-4','0F':'2.9','0M':'3.1','6F':'3.7','6M':'3.9'},{'category':'10-14','0F':'3.2','0M':'3.4','6F':'4.5','6M':'4.5'},{'category':'15-19','0F':'3.6','0M':'3.7','6F':'4.5','6M':'4.8'},{'category':'20-24','0F':'3.7','0M':'3.7','6F':'4.2','6M':'4.4'},{'category':'25-29','0F':'3.7','0M':'3.5','6F':'4','6M':'3.8'},{'category':'30-34','0F':'4','0M':'3.7','6F':'4.1','6M':'3.9'},{'category':'35-39','0F':'4.2','0M':'3.9','6F':'4.1','6M':'3.6'},{'category':'40-44','0F':'3.8','0M':'3.5','6F':'3.6','6M':'3.3'},{'category':'45-49','0F':'3.5','0M':'3.1','6F':'3','6M':'2.8'},{'category':'5-9','0F':'3.1','0M':'3.2','6F':'4','6M':'4.2'},{'category':'50-54','0F':'3.6','0M':'3.2','6F':'2.7','6M':'2.6'},{'category':'55-59','0F':'3.2','0M':'2.8','6F':'2.4','6M':'2.2'},{'category':'60-64','0F':'2.8','0M':'2.3','6F':'2','6M':'1.7'},{'category':'65-69','0F':'2.2','0M':'1.7','6F':'1.4','6M':'1.4'},{'category':'70-74','0F':'1.6','0M':'1.3','6F':'1','6M':'1'},{'category':'75-79','0F':'1.1','0M':'0.8','6F':'0.7','6M':'0.6'},{'category':'80-84','0F':'0.8','0M':'0.5','6F':'0.4','6M':'0.4'},{'category':'85-89','0F':'0.4','0M':'0.3','6F':'0.2','6M':'0.2'},{'category':'90+','0F':'0.2','0M':'0.1','6F':'0.1','6M':'0.1'}];// Create each chart
var maleChart = mainContainer.createChild(am4charts.XYChart);
maleChart.responsive.enabled = true;
maleChart.responsive.useDefault = true; // responsividade

maleChart.paddingRight = 0;
maleChart.data = JSON.parse(JSON.stringify(data));
maleChart.legend = new am4charts.Legend();
maleChart.legend.valueLabels.template.text = "{valueX}";
maleChart.legend.maxWidth = 50;
maleChart.legend.labels.template.truncate = false;
maleChart.legend.labels.template.wrap = true;

// tranforma legenda padrão de retângulo para círculo
maleChart.legend.useDefaultMarker = true;
var marker = maleChart.legend.markers.template.children.getIndex(0);
marker.cornerRadius(24, 24, 24, 24);
marker.strokeWidth = 6;
marker.strokeOpacity = 1;
marker.stroke = am4core.color("#FFFFFF");

var leftContainer = maleChart.chartContainer.createChild(am4core.Container);
leftContainer.layout = "absolute";
leftContainer.toBack();
leftContainer.paddingBottom = 5;
leftContainer.width = am4core.percent(100);

var homemTitle = leftContainer.createChild(am4core.Label);
homemTitle.text = "Homem";
homemTitle.align = "right";
homemTitle.paddingRight = 20;

// Create axes
var maleCategoryAxis = maleChart.yAxes.push(new am4charts.CategoryAxis());
maleCategoryAxis.renderer.grid.template.disabled = true;
maleCategoryAxis.dataFields.category = "category";
maleCategoryAxis.renderer.grid.template.location = 0;
maleCategoryAxis.renderer.grid.template.disabled = true;
// maleCategoryAxis.renderer.inversed = true;
maleCategoryAxis.renderer.minGridDistance = 5;

// remove o eixo de category
maleCategoryAxis.renderer.labels.template.adapter.add("text", (label, target, key) => {
    return "";
});


var maleValueAxis = maleChart.xAxes.push(new am4charts.ValueAxis());
maleValueAxis.renderer.grid.template.disabled = true;
maleValueAxis.renderer.inversed = true;
maleValueAxis.min = 0;
maleValueAxis.max = 10;
maleValueAxis.strictMinMax = true;

// maleValueAxis.title.text = "Homens";

maleValueAxis.numberFormatter = new am4core.NumberFormatter();
maleValueAxis.numberFormatter.numberFormat = "#.#'%'";

// Create series
function createMaleSeries(campo, lugar, cor, hiddenInLegend){
var maleSeries = maleChart.series.push(new am4charts.ColumnSeries());
maleSeries.dataFields.valueX = campo;
maleSeries.dataFields.valueXShow = "percent";
maleSeries.calculatePercent = true;
maleSeries.fill = am4core.color(cor);
maleSeries.stroke = maleSeries.fill;
maleSeries.dataFields.categoryY = "category";
maleSeries.interpolationDuration = 1000;
maleSeries.columns.template.tooltipText = "Homens, \n {categoryY}: \n{valueX.percent.formatNumber('#.#')}%";
maleSeries.name = lugar;

// Series Tooltip color
maleSeries.tooltip.autoTextColor = false;
maleSeries.tooltip.label.fill = am4core.color("#FFFFFF");
maleSeries.tooltip.label.stroke = am4core.color("#FFFFFF");
maleSeries.tooltip.strokeWidth = 1;
maleSeries.columns.template.tooltipY = 0;
maleSeries.columns.template.tooltipX = -18;

//maleSeries.sequencedInterpolation = true;
if (hiddenInLegend) {
    maleSeries.hiddenInLegend = true;
  }
}

// Female

var femaleChart = mainContainer.createChild(am4charts.XYChart);

femaleChart.paddingLeft = 0;
femaleChart.data = JSON.parse(JSON.stringify(data));
femaleChart.legend = new am4charts.Legend();
femaleChart.legend.valueLabels.template.text = "{valueX}";
femaleChart.legend.maxWidth = 50;
femaleChart.legend.labels.template.truncate = false;
femaleChart.legend.labels.template.wrap = true;

// tranforma legenda padrão de retângulo para círculo
femaleChart.legend.useDefaultMarker = true;
var marker = femaleChart.legend.markers.template.children.getIndex(0);
marker.cornerRadius(12, 12, 12, 12);
marker.strokeWidth = 6;
marker.strokeOpacity = 1;
marker.stroke = am4core.color("#FFFFFF");

var rightContainer = femaleChart.chartContainer.createChild(am4core.Container);
rightContainer.layout = "absolute";
rightContainer.toBack();
rightContainer.paddingBottom = 5;
rightContainer.width = am4core.percent(100);

var mulherTitle = rightContainer.createChild(am4core.Label);
mulherTitle.text = "Mulher";
mulherTitle.align = "left";
mulherTitle.paddingLeft = 20;

// Create axes
var femaleCategoryAxis = femaleChart.yAxes.push(new am4charts.CategoryAxis());
femaleCategoryAxis.renderer.grid.template.disabled = true;
femaleCategoryAxis.renderer.opposite = true;
femaleCategoryAxis.dataFields.category = "category";
femaleCategoryAxis.renderer.grid.template.location = 0;
femaleCategoryAxis.renderer.minGridDistance = 5;

var femaleValueAxis = femaleChart.xAxes.push(new am4charts.ValueAxis());
femaleValueAxis.renderer.grid.template.disabled = true;
femaleValueAxis.min = 0;
femaleValueAxis.max = 10;
femaleValueAxis.strictMinMax = true;
femaleValueAxis.numberFormatter = new am4core.NumberFormatter();
femaleValueAxis.numberFormatter.numberFormat = "#.#'%'";
femaleValueAxis.renderer.minLabelPosition = 0.01;

// remove o eixo de category
femaleCategoryAxis.renderer.labels.template.adapter.add("text", (label, target, key) => {
    return "";
});

// Create series
function createFemaleSeries(campo, lugar, cor, hiddenInLegend){
var femaleSeries = femaleChart.series.push(new am4charts.ColumnSeries());
femaleSeries.dataFields.valueX = campo;
femaleSeries.dataFields.valueXShow = "percent";
femaleSeries.calculatePercent = true;
femaleSeries.fill = am4core.color(cor);
femaleSeries.stroke = femaleSeries.fill;
femaleSeries.dataFields.categoryY = "category";
femaleSeries.interpolationDuration = 1000;
femaleSeries.columns.template.tooltipText = "Mulheres, \n{categoryY}:\n {valueX.percent.formatNumber('#.#')}%";
femaleSeries.name = lugar;
femaleSeries.columns.template.tooltipY = 0;
femaleSeries.columns.template.tooltipX = 200;

// Series Tooltip color
femaleSeries.tooltip.autoTextColor = false;
femaleSeries.tooltip.label.fill = am4core.color("#FFFFFF");
femaleSeries.tooltip.label.stroke = am4core.color("#FFFFFF");
femaleSeries.tooltip.strokeWidth = 1;

// femaleSeries.sequencedInterpolation = true;
if (hiddenInLegend) {
    femaleSeries.hiddenInLegend = true;
  }
}


      
      createFemaleSeries('0F','Brasil*','#3AC09A');
      createMaleSeries('0M','Brasil*','#3AC09A');
      
      createFemaleSeries('6F','Amaz�nia Legal','#811548');
      createMaleSeries('6M','Amaz�nia Legal','#811548');

// var series1 = createMaleSeries("homem_ribeira", "Vale do Ribeira", "#4AAE4E");
// var series2 = createMaleSeries("homem_sp", "São Paulo", "#F8AE42", true);
// var series3 = createFemaleSeries("mulher_ribeira", "Vale do Ribeira", "#4AAE4E", true);
// var series4 = createFemaleSeries("mulher_sp", "São Paulo", "#F8AE42");

// padrão numérico brasileiro
maleChart.language.locale["_decimalSeparator"] = ",";
maleChart.language.locale["_thousandSeparator"] = ".";
femaleChart.language.locale["_decimalSeparator"] = ",";
femaleChart.language.locale["_thousandSeparator"] = ".";

let legendContainer = am4core.create("legenddiv2", am4core.Container);
legendContainer.width = am4core.percent(100);
legendContainer.height = am4core.percent(100);

let legendContainer2 = am4core.create("legenddiv21", am4core.Container);
legendContainer2.width = am4core.percent(100);
legendContainer2.height = am4core.percent(100);

maleChart.legend.parent = legendContainer;
femaleChart.legend.parent = legendContainer2;

// //adiciona tooltip formato especial
// chart.numberFormatter.numberFormat = "#%";	

// // Add cursor
// chart.cursor = new am4charts.XYCursor();
// chart.cursor.fullWidthLineX = true;
// chart.cursor.lineX.strokeWidth = 0;
// chart.cursor.lineX.fill = am4core.color("#000");
// chart.cursor.lineX.fillOpacity = 0.1;

// // legendas    
// chart.legend = new am4charts.Legend();

// // padrão numérico brasileiro
// chart.language.locale["_decimalSeparator"] = ",";
// chart.language.locale["_thousandSeparator"] = ".";    
    
}); // end am4core.ready()
