<!-- </head>
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
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
// Themes end

/* Create chart instance */
var chart = am4core.create("chartdiv<?php echo $this->id; ?>", am4charts.RadarChart);

chart.responsive.enabled = true;

chart.colors.list = [
<?php
for($i=0;$i<sizeof($this->series_colors);$i++){
  if (strpos($this->series_colors[$i], "#") === 0){
    if ($i !== sizeof($this->series_colors)-1){
      echo "am4core.color('".$this->series_colors[$i]."'),";
    }else{
      echo "am4core.color('".$this->series_colors[$i]."')";
    }
  }
}
?>
];
<?php
// $isnulldata = false;
echo "chart.data = [";
    for($i=0;$i<sizeof($this->categories);$i++){
    // if ($i === 0){
    //   echo "{'date':'".$this->years[$i]."'},";
    // }else{
      echo "{'category':'".utf8_encode($this->categories_labels[$i])."',";
      for($j=0;$j<sizeof($this->series);$j++){
        if ($j !== sizeof($this->series)-1){
          if ($this->data[$i][$this->categories[$i]."_".$this->series[$j]]){
            echo "'".$this->series[$j]."':'".$this->data[$i][$this->categories[$i]."_".$this->series[$j]]."',";
          }else{
             echo "'dummy':'',";
          }
        }else{
          if ($this->data[$i][$this->categories[$i]."_".$this->series[$j]]){
            echo "'".$this->series[$j]."':'".$this->data[$i][$this->categories[$i]."_".$this->series[$j]]."'";
          }else{
             echo "'dummy':''";
          }
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
//adiciona tooltip formato especial
chart.numberFormatter.numberFormat = "<?php echo utf8_encode($this->tooltip_before); ?> #.### <?php echo utf8_encode($this->tooltip_after); ?>";	

/* Create axes */
var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "category";

var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.renderer.axisFills.template.fill = chart.colors.getIndex(2);
valueAxis.renderer.axisFills.template.fillOpacity = 0.05;

<?php 
// Create each series
  for($j=0;$j<sizeof($this->series);$j++){
    echo "var series".$j." = chart.series.push(new am4charts.RadarSeries());\n";
    echo "series".$j.".dataFields.valueY = '".$this->series[$j]."';\n";
    echo "series".$j.".dataFields.categoryX = 'category';\n";
    echo "series".$j.".tensionX = 0.8;\n";
    echo "series".$j.".strokeWidth = 6;\n";
    echo "series".$j.".strokeWidth = 6;\n";
    echo "series".$j.".name = '".utf8_encode($this->series_label[$j])."';\n";
    echo "series".$j.".tooltipText = '{valueY}[/]';\n";
    echo "series".$j.".hiddenInLegend = false;\n";
    echo "series".$j.".connect = false;\n";
  } 
?>

// Add cursor
chart.cursor = new am4charts.XYCursor();
chart.cursor.fullWidthLineX = true;
chart.cursor.xAxis = categoryAxis;

chart.cursor.lineX.strokeWidth = 0;
chart.cursor.lineX.fill = am4core.color("#000");
chart.cursor.lineX.fillOpacity = 0.1;

// legendas    
chart.legend = new am4charts.Legend();
chart.legend.position = "bottom";
chart.legend.valign = "middle";
chart.legend.contentAlign = "center";

// tranforma legenda padrão de retângulo para círculo
chart.legend.useDefaultMarker = true;
var marker = chart.legend.markers.template.children.getIndex(0);
marker.cornerRadius(24, 24, 24, 24);
marker.strokeWidth = 6;
marker.strokeOpacity = 1;
marker.stroke = am4core.color("#FFFFFF");

// padrão numérico brasileiro
chart.language.locale["_decimalSeparator"] = ",";
chart.language.locale["_thousandSeparator"] = ".";  

<?php if(verify_login()){ ?>

chart.exporting.menu = new am4core.ExportMenu();
chart.exporting.menu.items = [{
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
<?php  } ?>

}); // end am4core.ready()
</script>
<!-- </head>
<body> -->
	<!-- HTML -->
  <div class="chartdiv<?php echo $this->id; ?>"></div>
  <?php if(!verify_login()){ ?>
  <img class="btnexport" src="../assets/images/svg/Download.svg" onclick="" data-target="#alertaNaoCadastrado" data-toggle="modal">
  <?php } ?>
<!-- </body>
</html> -->