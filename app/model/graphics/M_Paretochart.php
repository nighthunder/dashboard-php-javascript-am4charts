<?php

namespace app\models;
use PDO;
// require_once '../../config/config2.php';
// require_once '../functions/functions.php';

class M_Paretochart{

    public $id; // altura do gráfico
    public $height; // altura do gráfico
    public $width; // largura do gráfico
    public $years; // array com todos os anos (intervalos de 1 ano)
    public $ini_year; // ano inicial do indicador
    public $end_year; // ano final do indicador
    public $chart; // id do indicador
    public $data; // valores
    public $series_colors; // cores das séries
    public $series_types; // se é uma série do tipo bar ou line 
    public $series_tooltip_before; // tooltip de cada série
    public $series_tooltip_after; // tooltip de cada série
    public $series; // id de cada série
    public $series_label; // nomes bonitos das séries
    public $stacked; // linhas ou de superfície
    public $pagina;

	public function __construct($pagina, $secao, $indicador,$height,$regiao, $area, $tabela,$unico){
        $this->years = [];
        $this->openings = [];
        $this->data = [];
        $this->series = [];
        $this->series_label = [];
        $this->series_colors = [];
        $this->series_types = [];
        $this->series_tooltip_before = [];
        $this->series_tooltip_after = [];
        $this->height = $height;
        $this->id = rand() ;
        $this->pagina = $pagina;
        $this->db = new \PDO("mysql:dbname=".BANCO.";host=".SERVIDOR,USUARIO,SENHA);
        $sql = "SELECT TABELA, INI, FIM FROM perfil_graficos_dicionario WHERE indicador = '" . utf8_decode($indicador) . "'
        and SECAO = '".utf8_decode($secao)."' and AREA = '".utf8_decode($area)."' and REGIAO = '".utf8_decode($regiao)."' and TABELA  = '"
        .utf8_decode($tabela)."'";
        // echo $sql;
        // echo "<pre>";
        // var_dump($this->data);
        // echo "</pre>";
        $qry = $this->db->query($sql);
        if ($qry){
            $qry = $qry->fetchAll(PDO::FETCH_ASSOC);
            // echo "<pre>";
            // var_dump($qry);
            // echo "</pre>";
            foreach ($qry as $row) {
                $this->chart = $row["TABELA"];
                $this->ini_year = $row["INI"];
                $this->end_year = $row["FIM"];
            }  
        }
        for($i=$this->ini_year;$i<=$this->end_year;$i++){
           array_push($this->years,$i);
        }
       
        for($i=0;$i<sizeof($this->years);$i++){
            $sql = "SELECT serie, serie_label, value, data_year, stacked, tooltip_before, tooltip_after FROM profile_chart_data WHERE `chart` = '" . utf8_decode($this->chart) . "' and data_year = '" .utf8_decode($this->years[$i]). "'";
            // echo $sql;
            $qry = $this->db->query($sql);
            $qry = $qry->fetchAll(PDO::FETCH_ASSOC);
            foreach ($qry as $row) {
                // echo $this->years[$i]."_".$row["serie"];
                $this->data[$i][$this->years[$i]."_".$row["serie"]] = $row["value"]; 
                $this->stacked = $row["stacked"];
                array_push($this->series_tooltip_before,$row["tooltip_before"]);
                array_push($this->series_tooltip_after,$row["tooltip_after"]);
                
            }
        }    
        // echo "stacked:".$this->stacked;

        $sql = "SELECT DISTINCT(serie), serie_label, color, serie_type FROM profile_chart_data WHERE `chart` = '" . $this->chart . "'";
        // echo $sql;
        $qry = $this->db->query($sql);
        $qry = $qry->fetchAll(PDO::FETCH_ASSOC);
        // echo "<pre>";
        // var_dump($qry);
        // echo "</pre>";
        foreach ($qry as $row) {
            array_push($this->series,$row["serie"]);
            array_push($this->series_label,$row["serie_label"]);
            array_push($this->series_colors,$row["color"]);
            array_push($this->series_types,$row["serie_type"]);
        }

        // echo "<pre>";
        // var_dump($this->data);
        // echo "</pre>";
        // echo "<pre>";
        // var_dump($this->series_colors);
        // echo "</pre>";
        // echo "<iframe src="">";
        include ("../app/views/graphics/paretochart.php"); // view do gráfico
	}
}