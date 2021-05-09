<?php

namespace app\models;
use app\core\Model;
use PDO;

class M_Perfil{

	public $indicador;

	public function __construct(){

		$this->db = new \PDO("mysql:dbname=".BANCO.";host=".SERVIDOR,USUARIO,SENHA);
	}

	public function getStates(){ // Seleciona todos os recortes geográficos do consórcio

		$sql = "SELECT id,name FROM state ORDER by name ASC";
		//echo $sql;
		$qry = $this->db->query($sql);

		if (! ($qry == false)){
			$qry = $qry->fetchAll();
		}
		return $qry;
	}

	public function getBrazilStates(){ 

		$sql = "SELECT nome FROM states_br ORDER by nome ASC";
		//echo $sql;
		$qry = $this->db->query($sql);

		if (! ($qry == false)){
			$qry = $qry->fetchAll();
		}
		return $qry;
	}

	public function getActivities(){ 

		$sql = "SELECT DISTINCT(activity) from activities ORDER by activity ASC";
		//echo $sql;
		$qry = $this->db->query($sql);

		if (! ($qry == false)){
			$qry = $qry->fetchAll();
		}
		return $qry;
	}

	public function getArea(){ /* Dados do filtro da página */

		$sql = "SELECT distinct(AREA), SIGLA, REGIAO FROM perfil_graficos_dicionario";

		//echo "maoi".$sql;
		
		$qry = $this->db->query($sql);

		if (! ($qry == false)){
			$qry = $qry->fetchAll();
		}

		return $qry;
	}	

	public function getAreaRegiaoID($area, $regiao){

		$sql = "SET CHARACTER SET utf8 ;";

		//echo $sql;

		$qry2 = $this->db->query($sql);

		$sql = "SELECT id FROM filtro_consulta_cross_join where area = '".$area."' and regiao like '".$regiao."';";

		//echo "maoi".$sql;
		
		$qry = $this->db->query($sql);

		if (! ($qry == false)){
			$qry = $qry->fetchAll(PDO::FETCH_ASSOC);
			//echo "oi";
		}else{
			echo $query->error;
		}

		// echo "<pre>";
		// var_dump($qry);
		// echo "</pre>";

		return $qry[0]["id"];

	}

	public function getIndicador(){ /* Dados do filtro da página :  nome do indicador e código */

		$sql = "SELECT distinct(GRUPO), AREA, INDICADOR, TITULO, REGIAO, (SELECT id FROM filtro_consulta_cross_join as f where f.area = p.AREA and f.regiao = p.REGIAO ) AS id FROM perfil_graficos_dicionario as p where SECAO like '%evolucao%' ORDER by INDICADOR";

		//echo $sql."ilaou";
		
		$qry1 = $this->db->query($sql);

		if (! ($qry1 == false)){
			$qry1 = $qry1->fetchAll();
		}

		// echo "<pre>";
		// var_dump($qry1);
		// echo "</pre>";

		return $qry1;

	}	

	public function getIndicador2($regiao){ /* Pré-perfil */

		$sql = "SELECT distinct(GRUPO), AREA, INDICADOR, TITULO, REGIAO, (SELECT id FROM filtro_consulta_cross_join as f where f.area = p.AREA and f.regiao = p.REGIAO ) AS id FROM perfil_graficos_dicionario as p where SECAO like '%evolucao%' and REGIAO like '%".utf8_decode($regiao)."%'";

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

	public function getFiltroIndicador(){ /* Dados do filtro da página :  nome do indicador e código */

		$sql = "SELECT distinct(INDICADOR), GRUPO, AREA, INDICADOR, (SELECT id FROM filtro_consulta_cross_join as f where f.area = p.AREA and f.regiao = p.REGIAO ) AS id FROM perfil_graficos_dicionario as p where SECAO like '%cenarios%'";

		//echo $sql."ilaou";
		
		$qry1 = $this->db->query($sql);

		if (! ($qry1 == false)){
			$qry1 = $qry1->fetchAll();
		}

		// echo "<pre>";
		// var_dump($qry1);
		// echo "</pre>";

		return $qry1;

	}	

	public function getRecorteGeografico(){ /* Dados do filtro da página :  região geográfica */

		$sql = "SELECT distinct(REGIAO) FROM perfil_graficos_dicionario";

		//echo $sql;
		
		$qry = $this->db->query($sql);

		if (! ($qry == false)){
			$qry = $qry->fetchAll();
		}

		return $qry;

	}	
	public function getEvolucao($regiao,$area,$indicador){

		$indicador = explode("__", $indicador);

		$area = explode("__", $area);

		try{


			$sql = "Select arquivo, area, regiao FROM perfil_graficos_dicionario where INDICADOR = '".$indicador[0]."' and SIGLA = '".$area[0]."';";

			//echo $sql;
			
			$qry = $this->db->query($sql);

			if ($qry->rowCount() > 0) {
				while($row = $qry->fetchAll()) {
					//var_dump($row);
					//echo "oi";
				}	

			}

		}catch (PDOException $e){
    		echo $e->getMessage();
		}

		return $qry;	
	}

	public function getNomeIndicadorAtual($indicador,$regiao,$area){

		$indicador = explode("__", $indicador);
		$area = explode("__", $area);

		$sql = "SELECT GRUPO FROM perfil_graficos_dicionario where INDICADOR LIKE \"%".$indicador[0]."%\" and SECAO='evolucao' and regiao like '%".$regiao."%' and area like '%".$area[0]."%';";

		//echo $sql."oioioi";

		$qry1 = $this->db->query($sql);

		if (($qry1 == true)){
			$qry1 = $qry1->fetchAll();
		}

		return $qry1;
	}

	public function getTextoEvolucao($indicador){

	}

	public function getGraficosEvolucao($indicador,$regiao,$area){

		$indicador = explode("__", $indicador);

		$sql = "SET CHARACTER SET utf8 ;";

		//echo $sql;

		$qry2 = $this->db->query($sql);

		$sql = "SELECT distinct(SIGLA) FROM perfil_graficos_dicionario where REGIAO LIKE \"%".$regiao."%\" ;";
		//echo $sql;

		$qry1 = $this->db->query($sql);

		if (($qry1 == true)){
			$qry1 = $qry1->fetchAll();
		}

		// echo "<pre>";
		// // echo $qry1[0]["SIGLA"];
		// var_dump($qry1);

		//echo "</pre>";


		$sql = "SELECT arquivo, SIGLA, AREA, ATIVO, TITULO, FONTE, OBS FROM perfil_graficos_dicionario where INDICADOR = \"".$indicador[0]."\" and SECAO ='evolucao' and REGIAO = \"".$regiao."\"  ";

		//echo $sql;
		
		$qry = $this->db->query($sql);

		if (($qry == true)){
			$qry = $qry->fetchAll();
		}

		// echo "<pre>";
		// var_dump($qry);
		// echo "</pre>";

		$graphics = [];
		$i = 0;

		foreach($qry as $arquivo){
			$graphics[$i]["arquivo"] = $arquivo["arquivo"];
			$graphics[$i]["ativo"] =  $arquivo["ATIVO"];
			$graphics[$i]["titulo"] =  $arquivo["TITULO"];
			$graphics[$i]["fonte"] =  $arquivo["FONTE"];
			$graphics[$i]["OBS"] =  $arquivo["OBS"];
			$graphics[$i]["unico"] = 0;
			$i++;
			//echo( $arquivo["arquivo"] ). $arquivo["SIGLA"];
		}

		if ($i ==  1){
			$graphics[0]["unico"] = 1;
		}

		// echo "</pre>";
		// var_dump($graphics);
		// echo "<pre>";

		return $graphics;
	}

	public function getTextoIndicadorEvolucao($indicador,$regiao){

		$indicador = explode("__", $indicador);

		$sql = "SET CHARACTER SET utf8 ;";

		// echo $sql;

		$qry2 = $this->db->query($sql);

	 	$sql = "SELECT TEXTO FROM perfil_textos where indicador LIKE \"%".$indicador[0]."%\" and secao = 'evolucao' and REGIAO LIKE \"%".$regiao."%\";";

		//echo $sql;

		$qry1 = $this->db->query($sql);

		if (($qry1 == true)){
			$qry1 = $qry1->fetchAll();
		}

		//var_dump($qry1);

		return $qry1[0]["TEXTO"];
	}

	public function temTerritorializacao($indicador,$regiao){

		$sql = "SET CHARACTER SET utf8 ;";

		// echo $sql;

		$qry2 = $this->db->query($sql);

		$indicador = explode("__", $indicador);

		$sql = "SELECT arquivo FROM perfil_graficos_dicionario where INDICADOR like \"%".$indicador[0]."%\" and secao like '%territorializacao%' and TIPO like '%map%' and REGIAO LIKE \"%".$regiao."%\"  ";

		//echo $sql;

		$qry1 = $this->db->query($sql);

		if (($qry1 == true)){
			$qry1 = $qry1->fetchAll(PDO::FETCH_ASSOC);
		}

		return $qry1;

	}

	public function getTextoIndicadorTerritorializacao($indicador,$regiao){

		$indicador = explode("__", $indicador);

		$sql = "SET CHARACTER SET utf8 ;";

		//echo $sql;

		$qry2 = $this->db->query($sql);

	 	$sql = "SELECT TEXTO FROM perfil_textos where indicador LIKE \"%".$indicador[0]."%\" and secao = 'territorializacao' and REGIAO LIKE \"%".$regiao."%\";";

		//echo $sql;

		$qry1 = $this->db->query($sql);

		if (($qry1 == true)){
			$qry1 = $qry1->fetchAll();
		}

		//var_dump($qry1);

		return $qry1[0]["TEXTO"];
	}

	public function getMapaIndicadorTerritorializacao($indicador,$regiao){

		$indicador = explode("__", $indicador);

		$sql = "SET CHARACTER SET utf8 ;";

		// echo $sql;

		$qry2 = $this->db->query($sql);

		$sql = "SELECT arquivo, SIGLA, AREA, ATIVO, TITULO, FONTE FROM perfil_graficos_dicionario where INDICADOR = \"".$indicador[0]."\" and SECAO ='territorializacao' and TIPO ='map' and REGIAO LIKE \"%".$regiao."%\"  ";

		//echo $sql;
		
		$qry = $this->db->query($sql);

		if (($qry == true)){
			$qry = $qry->fetchAll();
		}

		//var_dump($qry);

		$graphics = [];
		$i = 0;


		foreach($qry as $arquivo){
			$graphics[$i]["arquivo"] = $arquivo["arquivo"];
			$graphics[$i]["ativo"] =  $arquivo["ATIVO"];
			$graphics[$i]["titulo"] =  $arquivo["TITULO"];
			$graphics[$i]["fonte"] =  $arquivo["FONTE"];
			$i++;
			//echo( $arquivo["arquivo"] ). $arquivo["SIGLA"];
		}

		//var_dump($graphics);

		return $graphics;

	}
	
	public function testeTerritorializacaoExiste($indicador,$regiao){

		$indicador = explode("__", $indicador);

		$sql = "SET CHARACTER SET utf8 ;";

		// echo $sql;

		$qry2 = $this->db->query($sql);

		$sql = "SELECT arquivo, SIGLA, AREA, ATIVO, TITULO, FONTE FROM perfil_graficos_dicionario where INDICADOR = \"".$indicador[0]."\" and SECAO ='territorializacao' and TIPO ='map' and REGIAO LIKE \"%".$regiao."%\"  ";

		//echo $sql;
		
		$qry = $this->db->query($sql);

		if (($qry == true)){
			$qry = $qry->fetchAll();
		}

		//var_dump($qry);

		if (empty($qry)){
			return null;
		}


	}

	public function getTabelaIndicadorTerritorializacao($indicador,$regiao){

		$indicador = explode("__", $indicador);

		$sql = "SET CHARACTER SET utf8 ;";

		// echo $sql;

		$qry2 = $this->db->query($sql);

		$sql = "SELECT arquivo, SIGLA, AREA, ATIVO, TITULO FROM perfil_graficos_dicionario where INDICADOR = \"".$indicador[0]."\" and SECAO ='territorializacao' and TIPO ='table' and REGIAO LIKE \"%".$regiao."%\"  ";

		//echo $sql;
		
		$qry = $this->db->query($sql);

		if (($qry == true)){
			$qry = $qry->fetchAll();
		}

		//var_dump($qry);

		$graphics = [];
		$i = 0;

		foreach($qry as $arquivo){
			$graphics[$i]["arquivo"] = $arquivo["arquivo"];
			$graphics[$i]["ativo"] =  $arquivo["ATIVO"];
			$graphics[$i]["titulo"] =  $arquivo["TITULO"];
			$i++;
			//echo( $arquivo["arquivo"] ). $arquivo["SIGLA"];
		}

		//var_dump($graphics);

		$data = [];

		foreach($graphics as $linha){
           	$nome_tabela = str_replace(".html","", $linha["arquivo"]);
            //echo $nome_tabela;
            
            $sql = "SELECT * from INFORMATION_SCHEMA.COLUMNS where table_name = '".$nome_tabela."'";

			//echo $sql;
			
			$qry = $this->db->query($sql);

			if (($qry == true)){
				$qry = $qry->fetchAll(PDO::FETCH_ASSOC);
			}

			// echo "<pre>";
			// var_dump($qry);
			// echo "</pre>";

			$nomes_colunas = [];
			$nomes_colunas1 = [];
			$i = 1;

			foreach ($qry as $info_column){
				//echo $info_column["COLUMN_NAME"];
				if ($info_column["COLUMN_NAME"] != "row_names"){

					array_push($nomes_colunas1,$info_column["COLUMN_NAME"]);

					if ($i != (sizeof($qry)-1) ){
						$info_column["COLUMN_NAME"] = "`".$info_column["COLUMN_NAME"]."`";
						array_push($nomes_colunas, $info_column["COLUMN_NAME"]);
					}else{	
						array_push($nomes_colunas, "`".$info_column["COLUMN_NAME"]."`");
					}
					$i++;
				}
			} 

			$nomes_string = "";

			$i = 0;
			foreach ($nomes_colunas as $non){
				if ($i != (sizeof($qry)-1) ){
					$nomes_string = $nomes_string.$non.",";
				}else{
					$nomes_string = $nomes_string.$non;
				}
				$i++;	
				
			}

			//var_dump($nomes_colunas);
			//echo $nomes_string;

            $sql = "SELECT ".$nomes_string." from ".$nome_tabela.";";

			//echo $sql;
			
			$qry = $this->db->query($sql);

			if (($qry == true)){
				$qry = $qry->fetchAll(PDO::FETCH_ASSOC);
			}

			// echo "<pre>";
			// var_dump($qry);	
			// echo "</pre>";	

			$data = [$nomes_colunas1, $qry];
        }    

       	return $data;

	}

	public function temDestaques($indicador){ // Será que tem?

		$indicador = explode("__", $indicador);

		$sql = "SELECT * from perfil_destaques_top1_".strtolower($indicador[0])." ;";

		//echo $sql;
		
		$qry = $this->db->query($sql);

		return $qry;

	}	

	public function temCenarios($indicador,$regiao){ // Será que tem?

		$indicador = explode("__", $indicador);

		$sql = "SELECT arquivo FROM perfil_graficos_dicionario where INDICADOR LIKE \"%".$indicador[0]."%\" and secao LIKE \"%cenarios%\" and REGIAO like \"%".$regiao."%\" ; ";

		//echo $sql;
		
		$qry = $this->db->query($sql);

		if (($qry == true)){
			$qry = $qry->fetchAll();
		}

		return $qry;

	}	
	
	public function getGraficosCenarios($indicador,$regiao,$area){

		$indicador = explode("__", $indicador);

		$sql = "SET CHARACTER SET utf8 ;";

		// echo $sql;

		$qry2 = $this->db->query($sql);

		$sql = "SELECT arquivo, SIGLA, AREA, ATIVO, TITULO, FONTE, OBS FROM perfil_graficos_dicionario where INDICADOR = \"".$indicador[0]."\" and SECAO LIKE \"%cenarios%\" and REGIAO = \"".$regiao."\" ; ";

		//echo $sql;
		
		$qry = $this->db->query($sql);

		if (($qry == true)){
			$qry = $qry->fetchAll(pdo::FETCH_ASSOC);
		}

		// echo "<pre>";
		// var_dump($qry);
		// echo "</pre>";

		$graphics = [];
		$i = 0;

		foreach($qry as $arquivo){
			$graphics[$i]["arquivo"] = $arquivo["arquivo"];
			$graphics[$i]["ativo"] =  $arquivo["ATIVO"];
			$graphics[$i]["titulo"] =  $arquivo["TITULO"];
			$graphics[$i]["fonte"] =  $arquivo["FONTE"];
			$graphics[$i]["OBS"] =  $arquivo["OBS"];
			$graphics[$i]["unico"] =  0;
			$i++;
			//echo( $arquivo["arquivo"] ). $arquivo["SIGLA"];
		}

		if ($i == 1){
			$graphics[0]["unico"] =  1;
		}

		// echo "<pre>";
		// var_dump($graphics);
		// echo "</pre>";

		return $graphics;
	}

	public function getDestaques($indicador){

		$indicador = explode("__", $indicador);

		$sql = "SET CHARACTER SET utf8 ;";

		// echo $sql;

		$qry2 = $this->db->query($sql);

		$sql = "SELECT * FROM perfil_destaques_top1_".strtolower($indicador[0]).";";

		//echo $sql;
		
		$qry = $this->db->query($sql);

		if (($qry == true)){
			$qry = $qry->fetchAll(PDO::FETCH_ASSOC);
		}

		// echo "<pre>";	

       	$graphics = [];
		$i = 0;

		foreach($qry as $arquivo){

			if ($arquivo["destaque_1"] == "1"){

				$graphics["destaque_1"]["estado"] = $arquivo["Estado"];
				$graphics["destaque_1"]["ano"] =  $arquivo["Ano"];
				$graphics["destaque_1"]["valor"] =  $arquivo["Valor"];

			}
			if ($arquivo["destaque_2"] == "1"){

				$graphics["destaque_2"]["estado"] = $arquivo["Estado"];
				$graphics["destaque_2"]["posicao"] =  $arquivo["Posição"];
				$graphics["destaque_2"]["periodo"] =  $arquivo["Período"];

			}	
			if ($arquivo["destaque_3"] == "1"){

				$graphics["destaque_3"]["estado"] = $arquivo["Estado"];
				$graphics["destaque_3"]["variacao"] =  $arquivo["Variação"];
				$graphics["destaque_3"]["periodo"] =  $arquivo["Período"];

			}	
		}

		// echo "<pre>";	
  //      	var_dump($graphics);
  //      	echo "</pre>";

       	return $graphics;
	}

	public function getDestaquesInterno($indicador,$tabela){

		$indicador = explode("__", $indicador);

		$sql = "SET CHARACTER SET utf8 ;";

		//echo $sql;

		$qry2 = $this->db->query($sql);

		$sql = "SELECT * FROM perfil_dest_rank_".$tabela."_".strtolower($indicador[0]).";";

		//echo $sql;
		
		$qry = $this->db->query($sql);

		if (($qry == true)){
			$qry = $qry->fetchAll(PDO::FETCH_ASSOC);
		}

		// echo "<pre>";	
  // 	    var_dump($qry);
  //       echo "</pre>";	

       	$graphics = [];
		$i = 0;

		foreach($qry as $arquivo){

			$graphics[$i]["estado"] = $arquivo["Estado"];

			if (!empty($arquivo["Variação"])){
				$graphics[$i]["variacao"] =  $arquivo["Variação"];
			}

			if (!empty($arquivo["Valor"])){
				$graphics[$i]["valor"] =  $arquivo["Valor"];
			}

			if (isset($arquivo["Avanço"])){
				$graphics[$i]["avanco"] =  $arquivo["Avanço"];
			}

			
			$graphics[$i]["posicao"] =  $arquivo["Posição"];

			$i++;
		}

		// echo "<pre>";	
  //      	var_dump($graphics);
  //      	echo "</pre>";

       	return $graphics;
	}

}