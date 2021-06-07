<?php

namespace app\models;
use PDO;
// require_once '../../config/config2.php';
// require_once '../functions/functions.php';

class M_Pyramidchart{

    public $id; // altura do gráfico
    public $height; // altura do gráfico
    public $width; // largura do gráfico
    public $years; // array com todos os anos (intervalos de 1 ano)
    public $ini_year; // ano inicial do indicador
    public $end_year; // ano final do indicador
    public $chart; // id do indicador
    public $openings; // aberturas
    public $openings_labels; // labels aberturas
    public $categories; // eixo y personalizado
    public $categories_labels; // labels eixo y personalizado
    public $data; // valores
    public $series_colors; // cores das séries
    public $series; // id de cada série
    public $series_label; // nomes bonitos das séries
    public $stacked; // linhas ou de superfície ?
    public $tooltip_before; // caracter que aparece antes do valor em cada tooltip
    public $tooltip_after; // caracter que aparece depois do valor em cada tooltip
    public $pagina;

	public function __construct($pagina, $secao, $indicador,$height,$regiao, $area, $tabela, $unico){
        $this->db = new \PDO("mysql:dbname=".BANCO.";host=".SERVIDOR,USUARIO,SENHA);
        $this->years = [];
        $this->openings = [];
        $this->categories = [];
        $this->openings_labels = [];
        $this->categories_labels = [];
        $this->data = [];
        $this->series = [];
        $this->series_label = [];
        $this->series_colors = [];
        $this->height = $height;
        $this->id = rand() ;
        $this->pagina = $pagina;
        // seleciona a linha correta no dicionário
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

        // aberturas
        $sql = "SELECT distinct(opening), opening_label FROM profile_chart_data WHERE chart  = '"
        .utf8_decode($this->chart)."'";
        // echo $sql;
        $qry = $this->db->query($sql);
        if ($qry){
            
            foreach($qry as $row){
                array_push($this->openings, $row["opening"]);
                array_push($this->openings_labels, $row["opening_label"]);
            } 
        }

        // categorias 
        $sql = "SELECT distinct(category), category_label FROM profile_chart_data WHERE chart  = '"
        .utf8_decode($this->chart)."'";
        // echo $sql;
        $qry = $this->db->query($sql);
        if ($qry){
            foreach($qry as $row){
                array_push($this->categories, $row["category"]);
                array_push($this->categories_labels, $row["category_label"]);
            } 
        }   
        // echo "<pre>";
        // var_dump($this->categories);
        // echo "</pre>"; 
        // echo "<pre>";
        // var_dump($this->categories_label);
        // echo "</pre>"; 

        for($i=0;$i<sizeof($this->categories);$i++){
            $sql = "SELECT serie, serie_label, value, data_year, stacked, tooltip_before, tooltip_after 
             FROM profile_chart_data WHERE `chart` = '" . utf8_decode($this->chart) . "' and category = '" .utf8_decode($this->categories[$i]). "'";
            // echo $sql;
            $qry = $this->db->query($sql);
            $qry = $qry->fetchAll(PDO::FETCH_ASSOC);
            foreach ($qry as $row) {
                // echo $this->years[$i]."_".$row["serie"];
                $this->data[$i][$row["serie"]] = $row["value"]; 
                $this->stacked = $row["stacked"];
                $this->tooltip_before = $row["tooltip_before"];
                $this->tooltip_after = $row["tooltip_after"];
            }
        }    
    
        // séries
        $sql = "SELECT DISTINCT(serie), serie_label, color FROM profile_chart_data WHERE `chart` = '" . $this->chart . "'";
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
        }

        // echo "<pre>";
        // var_dump($this->data);
        // echo "</pre>";
        // echo "<pre>";
        // var_dump($this->series_colors);
        // echo "</pre>";
        include("../app/views/graphics/pyramidchart.php"); // view do gráfico
	}
}