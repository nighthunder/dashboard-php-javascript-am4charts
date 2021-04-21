<?php

namespace app\models;

use app\core\Model;
use PDO;

class M_Destaques{

	public $indicador;

	public function __construct(){

		$this->db = new \PDO("mysql:dbname=".BANCO.";host=".SERVIDOR,USUARIO,SENHA);
	}

	/* Número do grupo é o número da coluna na página 1... 6 colunas*/
	public function getDestaques($regiao, $area, $numero_grupo){ // Seleciona todos os recortes geográficos

		//$sql = "SELECT AREA, INDICADOR, INDICADOR_NOME, GRUPO_ID FROM destaques_grupos WHERE GRUPO_ID = ".$numero_grupo." and REGIAO like '%".$regiao."%' and AREA like '%".$area."%';";

		$sql = "SELECT AREA, INDICADOR, INDICADOR_NOME, GRUPO_ID, REGIAO FROM destaques_grupos WHERE AREA like '%".utf8_decode($area)."%' and REGIAO like '%".utf8_decode($regiao)."%' and GRUPO_ID = ".$numero_grupo.";";

		//echo $sql;
		
		$qry = $this->db->query($sql);

		if (! ($qry == false)){
			$qry = $qry->fetchAll(PDO::FETCH_ASSOC);
		}

		// echo "<pre>";
		// var_dump($qry);
		// echo "</pre>";

		if (!empty($qry)){

		}

		return $qry;
	}

	/* Para gerar os links dos indicadores para a página de perfil, obtem o número do id do grupo formado pela área e pela região do indicador no filtro. */
	public function getIDCombinacaoAreaRegiao($area, $regiao){ 

		$sql = "SELECT id FROM filtro_consulta_cross_join where area like '%".utf8_decode($area)."%' and regiao like '%".utf8_decode($regiao)."%';";

		//echo $sql."ilaou";
		
		$qry1 = $this->db->query($sql);

		if (! ($qry1 == false)){
			$qry1 = $qry1->fetchAll(PDO::FETCH_ASSOC);
		}

		// echo "<pre>";
		// var_dump($qry1);
		// echo "</pre>";

		return $qry1;

	}	

	/* Número do grupo é o número da coluna na página 1... 6 colunas*/
	public function getTodosDestaques($regiao,$grupo_id,$color){ // Seleciona todos os recortes geográficos

		$areas = ["Educação", "Saúde","Infraestrutura","Segurança","Desenvolvimento Social","Economia","Ciência e Tecnologia","Saneamento","Meio Ambiente","Institucional"];
	
		foreach ($areas as $a){

	        if (!empty($this->getDestaques($regiao,$a,$grupo_id))){

				$destaque = $this->getDestaques($regiao,$a,$grupo_id);

	            $vez = 1;

	            $d1 = $this->getIDCombinacaoAreaRegiao($a,$regiao);

	            echo "<div class=\"setas seta-".$color."\"></div>";

	            $areas1 = [];

	            foreach ($destaque as $d){

	            	if ($vez == 1){    	
	                    echo "<div class=\"mb-3 card card-desafio card-area card-indicadores bo-".$color."-fraco\">
	                          <div class=\"card-header bg-".$color."-fraco\">
	                          <img class=\"area-icone\" src=\"../assets/images/destaques/area-".removeAcentosEspacosPoeCaixaBaixa($d["AREA"]).".svg\"/>
	                           <h6>".utf8_encode($d["AREA"])."</h6></div> ";
	                    echo "<div class=\"card-body\"><ul class=\"ul-card\">";
	                    $vez++; 
	                }
	                                          
	               	echo "<a class='link-indicador' href='../dashboard/perfil.php?regiao=".utf8_encode($d["REGIAO"])."&area=".utf8_encode($d["AREA"])."__".$d1[0]["id"]."&indicador=".utf8_encode($d["INDICADOR_NOME"])."__".$d1[0]["id"]."'><li>".utf8_encode($d["INDICADOR"])."</li></a>";                  
	           	}

	            echo  "</ul></div></div>";
	        }    
	                                     
		}	

	}	




}