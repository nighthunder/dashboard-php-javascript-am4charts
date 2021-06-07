<?php

namespace app\models;
use PDO;
// require_once '../../config/config2.php';
// require_once '../functions/functions.php';
require_once '../app/model/graphics/M_Linechart.php';
require_once '../app/model/graphics/M_Barchart.php';
require_once '../app/model/graphics/M_Paretochart.php';
require_once '../app/model/graphics/M_Pyramidchart.php';
require_once '../app/model/graphics/M_Predchart.php';
require_once '../app/model/graphics/M_Radarchart.php';
use app\models\M_Linechart;
use app\models\M_Barchart;
use app\models\M_Paretochart;
use app\models\M_Radarchart;
use app\models\M_Pyramidchart;
use app\models\M_Predchart;

class M_Chart{

    // $indice é o qual o gráfico na ordem retornada
	public function __construct($pagina, $secao, $indicador,$height,$regiao, $area, $indice){
        $this->db = new \PDO("mysql:dbname=".BANCO.";host=".SERVIDOR,USUARIO,SENHA);
        $sql = "SELECT TABELA, SECAO FROM perfil_graficos_dicionario WHERE indicador = '" . utf8_decode($indicador) . "'
        and SECAO = '".utf8_decode($secao)."' and AREA = '".utf8_decode($area)."' and REGIAO = '".utf8_decode($regiao)."'";
        // echo $sql;
        $qry = $this->db->query($sql);
      
        if ($qry){
            $qry = $qry->fetchAll(PDO::FETCH_ASSOC);
            // echo "<pre>";
            // var_dump($qry);
            // echo "</pre>";
            $row = $qry[$indice];
            $unico = sizeof($qry) > 1 ? 0 : 1; // se o gráfico é o único do indicador naquela seção
            // foreach ($qry as $row) {
                // separar abas aqui dentro
                if ($secao === "evolucao"){
                    if ( $this->endsWith($row["TABELA"], "bar_line") ) {
                        new M_Paretochart($pagina, $secao, $indicador,$height,$regiao,$area, $row["TABELA"],$unico); 
                    } else if ( $this->endsWith($row["TABELA"], "_line") ){ 
                        new M_Linechart($pagina, $secao, $indicador,$height,$regiao,$area, $row["TABELA"],$unico); 
                    } else if ( $this->endsWith($row["TABELA"], "_bar") || $this->endsWith($row["TABELA"], "_bar_cat")){ 
                        new M_Barchart($pagina, $secao, $indicador,$height,$regiao,$area, $row["TABELA"], $unico); 
                    }else if ( $this->endsWith($row["TABELA"], "_radar") ){
                        new M_Radarchart($pagina, $secao, $indicador,$height,$regiao,$area, $row["TABELA"],$unico); 
                    }else 
                    if ( $this->endsWith($row["TABELA"], "_pyramid") ){
                        new M_Pyramidchart($pagina, $secao, $indicador,$height,$regiao,$area, $row["TABELA"],$unico); 
                    }  
                }else if ($secao === "cenarios"){
                    new M_Predchart($pagina, $secao, $indicador,"500px",$regiao,$area, $row["TABELA"],$unico); 
                }
            // }  
        }
	}

    function endsWith($string, $test) {
        $strlen = strlen($string);
        $testlen = strlen($test);
        if ($testlen > $strlen) return false;
        return substr_compare($string, $test, $strlen - $testlen, $testlen) === 0;
    }
}