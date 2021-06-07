<?php

namespace app\models;
use PDO;
// require_once '../../config/config2.php';
// require_once '../functions/functions.php';

class M_Barchart{

    public $id; // altura do gráfico
    public $height; // altura do gráfico
    public $width; // largura do gráfico
    public $years; // array com todos os anos
    public $ini_year; // ano inicial do indicador
    public $end_year; // ano final do indicador
    public $chart; // id do indicador
    public $has_openings; // se tem aberturas
    public $openings; // aberturas
    public $openings_labels; // labels aberturas
    public $data; // valores
    public $series_colors; // cores das séries
    public $series; // id de cada série
    public $series_label; // nomes bonitos das séries
    public $stacked; // linhas ou de superfície ?
    public $tooltip_before; // caracter que aparece antes do valor em cada tooltip
    public $tooltip_after; // caracter que aparece depois do valor em cada tooltip
    public $clustered; // se é agrupado 
    public $up_lim; // limite superior de exibição do eixo y 
    public $pagina;

	public function __construct($pagina, $secao, $indicador,$height,$regiao, $area, $tabela,$unico){
        $this->db = new \PDO("mysql:dbname=".BANCO.";host=".SERVIDOR,USUARIO,SENHA);
        $this->years = [];
        $this->openings = [];
        $this->openings_labels = [];
        $this->data = [];
        $this->series = [];
        $this->years = [];
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
                // $this->ini_year = $row["INI"];
                // $this->end_year = $row["FIM"];
            }  
        }

        // aberturas
        $sql = "SELECT distinct(opening), opening_label, grouped FROM profile_chart_data WHERE chart  = '"
        .utf8_decode($this->chart)."'";
        // echo $sql;
        $qry = $this->db->query($sql);
        if ($qry){
            if ($qry->rowCount() > 1) { 
                $this->has_openings = true;
                $qry = $this->db->query($sql);
                foreach($qry as $row){
                    array_push($this->openings, $row["opening"]);
                    array_push($this->openings_labels, $row["opening_label"]);
                    if ($row["grouped"]){ $this->clustered = 1; }else{ $this->clustered = 0; }
                }
            } else{
                $this->has_openings = false;
                $this->clustered = 0;
            }    
        }
        // echo "has_opening:".$this->has_openings;
        // echo "<pre>";
        // var_dump($this->openings);
        // echo "</pre>";
        // var_dump($this->openings_labels);

        if (!$this->has_openings){ // se não tem abertura o eixo x é por anos
            // for($i=$this->ini_year;$i<=$this->end_year;$i++){
            //     array_push($this->years,$i);
            // }
            $sql = "SELECT distinct(data_year) FROM profile_chart_data WHERE `chart` = '" . utf8_decode($this->chart) . "' ";
            // echo $sql;
            $qry = $this->db->query($sql);
            $qry = $qry->fetchAll(PDO::FETCH_ASSOC);
            foreach ($qry as $row) {    
                array_push($this->years, $row["data_year"]);
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
                    $this->tooltip_before = $row["tooltip_before"];
                    $this->tooltip_after = $row["tooltip_after"];
                    
                }
            }    
        }else{ // se tem aberturas o eixo x 
            for($i=0;$i<sizeof($this->openings);$i++){
                $sql = "SELECT serie, serie_label, value, data_year, stacked, tooltip_before, tooltip_after FROM profile_chart_data WHERE `chart` = '" . utf8_decode($this->chart) . "' and opening = '" .utf8_decode($this->openings[$i]). "'";
                // echo $sql;
                $qry = $this->db->query($sql);
                $qry = $qry->fetchAll(PDO::FETCH_ASSOC);
                foreach ($qry as $row) {
                    // echo $this->years[$i]."_".$row["serie"];
                    $this->data[$i][$this->openings[$i]."_".$row["serie"]] = $row["value"]; 
                    $this->stacked = $row["stacked"];
                    $this->tooltip_before = $row["tooltip_before"];
                    $this->tooltip_after = $row["tooltip_after"];
                }
            }    
        }
        //else{ // clustered
            // $sql = "SELECT distinct(data_year) FROM profile_chart_data WHERE `chart` = '" . utf8_decode($this->chart) . "' ";
            // // echo $sql;
            // $qry = $this->db->query($sql);
            // $qry = $qry->fetchAll(PDO::FETCH_ASSOC);
            // foreach ($qry as $row) {    
            //     array_push($this->years, $row["data_year"]);
            // }   

            // for($i=0;$i<sizeof($this->years);$i++){
            //     for(j=0;$j<sizeof($this->openings);$j++){
               
            //         $sql = "SELECT serie, serie_label, value, data_year, stacked, tooltip_before, tooltip_after FROM profile_chart_data WHERE `chart` = '" . utf8_decode($this->chart) . "' 
            //         and opening = '" .utf8_decode($this->openings[$j]). "' and data_year  = '".$this->years[$i]."'";
            //         // echo $sql;
            //         $qry = $this->db->query($sql);
            //         $qry = $qry->fetchAll(PDO::FETCH_ASSOC);
            //         foreach ($qry as $row) {
            //             // echo $this->years[$i]."_".$row["serie"];
            //             $this->data[$i][$this->openings[$j]."_".$this->years[$i]] = $row["value"]; 
            //             $this->stacked = $row["stacked"];
            //             $this->tooltip_before = $row["tooltip_before"];
            //             $this->tooltip_after = $row["tooltip_after"];
            //         }
            //     }
            // }    

            
        // }
        
        // echo "stacked:".$this->stacked;
        // echo "clustered:".$this->clustered;

        // séries
        $sql = "SELECT DISTINCT(serie), serie_label, color, inf_lim, up_lim FROM profile_chart_data WHERE `chart` = '" . $this->chart . "'";
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
            $this->up_lim = $row["up_lim"];
            $this->inf_lim = $row["inf_lim"];
        }

        // echo "<pre>";
        // var_dump($this->data);
        // echo "</pre>";
        // echo "<pre>";
        // var_dump($this->series_colors);
        // echo "</pre>";
        // echo "<pre>";
        // var_dump($this->series_colors);
        // // echo "</pre>";
        // echo "limite inferior:".$this->inf_lim;
        // echo "limite inferior:".$this->up_lim;
        
        include("../app/views/graphics/barchart.php"); // view do gráfico
	}
}