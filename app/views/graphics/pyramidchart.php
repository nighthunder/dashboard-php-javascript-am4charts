<!-- <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
<script src="//www.amcharts.com/lib/4/lang/pt_BR.js"></script> -->
<style>
<?php echo ".chartdiv".$this->id; ?> {
  width: 100%;
  height: <?php echo $this->height; ?>;
}
.amcharts-amexport-icon{
  cursor: pointer;
}
.amcharts-amexport-item-level-0 > .amcharts-amexport-icon{
  padding: 0px;
}
.legenddiv2{
  height: 30px;
  width: 210px;
  text-align: left;
  margin-left: 24%;
  clear: left;
  float: left;
  margin-top: -10px;
  display: none;
}
.legenddiv21{
  height: 30px;
}
.btnexport{
  position: absolute;
  top: 100px;
  right: 35px;
  <?php if ($pagina === "compare") { echo "top: 200px;"; echo "right: 20px;";  }?>  
  padding: 1em 2em;
  opacity: 1  !important;
  width: 30px;
  min-height: 30px;
  border-radius: 3px;
  padding: 0px;
  margin: 1px 1px 0px 0px;
  color: rgb(0, 0, 0);
  transition: all 100ms ease-in-out 0s, opacity 0.5s ease 0.5s;
  background-color: rgb(217, 217, 217);
  border: 0px;
  padding-bottom: 0px;
  cursor: pointer;
}
.btnexport:active{
  padding-bottom: 0;
  opacity: 1;
}
.btnexport:hover{
  background: rgb(163, 163, 163) none repeat scroll 0% 0%;
  color: rgb(0, 0, 0);
  opacity: 0.9;
  padding-bottom: 0px;
}
</style>
<!-- Chart code -->
<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// am4core.options.autoDispose = true;

// Themes end
am4core.options.autoSetClassName = true; // classes no svg
var mainContainer = am4core.create("<?php echo "chartdiv".$this->id; ?>", am4core.Container);
mainContainer.width = am4core.percent(100);
mainContainer.height = am4core.percent(100);
mainContainer.layout = "horizontal";

<?php
echo "var data = [";
  for($i=0;$i<sizeof($this->categories);$i++){
    // if ($i === 0){
    //   echo "{'date':'".$this->years[$i]."'},";
    // }else{
      echo "{'category':'".utf8_encode($this->categories_labels[$i])."',";
      for($j=0;$j<sizeof($this->series);$j++){
        if ($j !== sizeof($this->series)-1){
          echo "'".$this->series[$j]."':'".$this->data[$i][$this->series[$j]]."',";
        }else{
        echo "'".$this->series[$j]."':'".$this->data[$i][$this->series[$j]]."'";
        }
      }
      if ($i ===  sizeof($this->categories)-1){
        echo "}";
      }else{
        echo "},";
      } 
    // }
  }
echo "];";
?>

// var data = [{'category':'0-4','0F':'2.9','0M':'3.1','6F':'3.7','6M':'3.9'},
// {'category':'05-09','0F':'3.1','0M':'3.2','6F':'4','6M':'4.2'},{'category':'10-14','0F':'3.2','0M':'3.4','6F':'4.5','6M':'4.5'},
// {'category':'15-19','0F':'3.6','0M':'3.7','6F':'4.5','6M':'4.8'},
// {'category':'20-24','0F':'3.7','0M':'3.7','6F':'4.2','6M':'4.4'},{'category':'25-29','0F':'3.7','0M':'3.5','6F':'4','6M':'3.8'},
// {'category':'30-34','0F':'4','0M':'3.7','6F':'4.1','6M':'3.9'},{'category':'35-39','0F':'4.2','0M':'3.9','6F':'4.1','6M':'3.6'},
// {'category':'40-44','0F':'3.8','0M':'3.5','6F':'3.6','6M':'3.3'},{'category':'45-49','0F':'3.5','0M':'3.1','6F':'3','6M':'2.8'},
// {'category':'50-54','0F':'3.6','0M':'3.2','6F':'2.7','6M':'2.6'},{'category':'55-59','0F':'3.2','0M':'2.8','6F':'2.4','6M':'2.2'},
// {'category':'60-64','0F':'2.8','0M':'2.3','6F':'2','6M':'1.7'},{'category':'65-69','0F':'2.2','0M':'1.7','6F':'1.4','6M':'1.4'},
// {'category':'70-74','0F':'1.6','0M':'1.3','6F':'1','6M':'1'},{'category':'75-79','0F':'1.1','0M':'0.8','6F':'0.7','6M':'0.6'},
// {'category':'80-84','0F':'0.8','0M':'0.5','6F':'0.4','6M':'0.4'},
// {'category':'85-89','0F':'0.4','0M':'0.3','6F':'0.2','6M':'0.2'},{'category':'90+','0F':'0.2','0M':'0.1','6F':'0.1','6M':'0.1'}];

// var data = [{'category':'0-4','0F':'2.9','0M':'3.1','6F':'3.7','6M':'3.9'},
// {'category':'05-09','0F':'3.1','0M':'3.2','6F':'4','6M':'4.2'}];
// Create each chart
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
maleValueAxis.numberFormatter.numberFormat = "#.# %'";

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
maleSeries.columns.template.tooltipText = "Homens, \n {categoryY}: \n{valueX.formatNumber('#.#')}%";
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

// var data2 = JSON.parse(JSON.stringify(data));

// console.log("data2", data2);

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
femaleSeries.columns.template.tooltipText = "Mulheres, \n{categoryY}:\n {valueX.formatNumber('#.#')}%";
femaleSeries.name = lugar;
// femaleSeries.columns.template.tooltipY = 0;
// femaleSeries.columns.template.tooltipX = 200;

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


<?php 
// Create each series
  for($j=0;$j<sizeof($this->series);$j++){
    if (strpos($this->series[$j],'F')){ // série feminina
?>      
      createFemaleSeries(<?php echo "'".$this->series[$j]."','".utf8_encode($this->series_label[$j])."','".$this->series_colors[$j]."'" ?>);
<?php    }else{ ?>
      createMaleSeries(<?php echo "'".$this->series[$j]."','".utf8_encode($this->series_label[$j])."','".$this->series_colors[$j]."'" ?>);
<?php    }
  } 
?>

// padrão numérico brasileiro
// maleChart.language.locale["_decimalSeparator"] = ",";
// maleChart.language.locale["_thousandSeparator"] = ".";
// femaleChart.language.locale["_decimalSeparator"] = ",";
// femaleChart.language.locale["_thousandSeparator"] = ".";

let legendContainer = am4core.create("legenddiv2", am4core.Container);
legendContainer.width = am4core.percent(100);
legendContainer.height = am4core.percent(100);

let legendContainer2 = am4core.create("legenddiv21", am4core.Container);
legendContainer2.width = am4core.percent(100);
legendContainer2.height = am4core.percent(100);

// maleChart.legend.parent = legendContainer;
maleChart.legend.parent = legendContainer;
femaleChart.legend.parent = legendContainer2;

<?php if(verify_login()){ ?>

maleChart.exporting.menu = new am4core.ExportMenu();
chart.exporting.extraSprites.push({
  "sprite": legendContainer,
  "position": "bottom",
  "marginTop": 20
});
maleChart.exporting.menu.items = [{
  "label": "...",
  "menu": [
    { "type": "png", "label": "PNG", "options": { "quality": 1 } },
    { "type": "json", "label": "JSON", "options": { "indent": 2, "useTimestamps": true } },
    { "label": "JPG", "type": "jpg" },
    { "label": "CSV", "type": "csv" },
    { "type": "xlsx", "label": "XLSX" }
  ]
}];
chart.exporting.menu.items[0].icon = "../assets/images/svg/Download.svg";
<?php } ?>
  
}); // end am4core.ready()
</script>
  <div class='<?php echo "chartdiv".$this->id; ?>'></div>
  <div id="legenddiv2" class="legenddiv2"></div>
  <div id="legenddiv21" class="legenddiv21"></div>
  <?php if(!verify_login()){ ?>
  <img class="btnexport" src="../assets/images/svg/Download.svg" onclick="" data-target="#alertaNaoCadastrado" data-toggle="modal">
  <!-- <input type="button" class="btnexport" value="..." onclick="" data-target="#alertaNaoCadastrado" data-toggle="modal" /> -->
  <?php } ?>
 
