<?php 
    header('Content-Type: application/json');
    header("Content-Security-Policy: default-src *; style-src 'self' 'unsafe-inline'; font-src 'self' data:; script-src 'self' 'unsafe-inline' 'unsafe-eval' stackexchange.com");
    header("Access-Control-Allow-Origin: *");

    $result = array();

    if( !isset($_GET['tipoGestao']) ) { $result['erro'] = 'Informe o tipo de gestão'; }
    else if( !isset($_GET['estado']) ) { $result['erro'] = 'Informe o estado'; }
    else if( !isset($_GET['ocupacao']) ) { $result['erro'] = 'Informe a ocupação'; }
     

    if(isset($result['erro'])) {http_response_code(500);}
    else {$result['msg'] = 'Sucesso!';}

    /**
     * 
     */

    echo json_encode($result);
?>