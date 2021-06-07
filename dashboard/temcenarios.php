
                                <div class="card-hover-shadow-2x mb-3 card">
                                    <div class="card-header-tab card-header">
                                        <div class="card-header-title font-size-lg font-weight-normal">Projeções</div>
                                        <div class="btn-actions-pane-right text-capitalize actions-icon-btn">
                                            
                                        </div>
                                    </div>
                                      <div class="card-body">
                                            <?php 
                                                
                                                $graficos_cenarios = $perfil->getGraficosCenarios($_GET["indicador"],$_GET["regiao"], $_GET["area"]);

                                            ?>    
                                            <?php 
                                                $vez = 0;
                                                foreach($graficos_cenarios as $grafico){
                                                    if ($vez == 0 and $grafico["unico"] != 1){
                                                        echo  "<div class=\"card-header\""."><ul class=\"nav nav-justified\">"; 
                                                        $vez = 1;
                                                    }
                                                } 
                                            ?>        

                                            <?php
                                                $i = 0;
                                                foreach($graficos_cenarios as $grafico){

                                                  
                                                   if ($grafico["ativo"] == "1" and $grafico["unico"] !=1){
                                                        echo "<li class=\"nav-item active\">";     
                                                        echo "<a data-toggle=\"tab\" href=\"#tab-eg8-0\" class=\"nav-link active\">".$grafico["titulo"]."</a></li>";
                                                   } else if ( $grafico["unico"] !=1 ){
                                                        echo "<li class=\"nav-item\">"; 
                                                        echo "<a data-toggle=\"tab\" href=\"#tab-eg8-".$i."\" class=\"nav-link\">".$grafico["titulo"]."</a></li>";
                                                        
                                                   }
                                                   $i++;

                                                }

                                                ?>
                                                </ul>
                                            <?php    
                                                $vez = 0;
                                                foreach($graficos_cenarios as $grafico){
                                                    if ($vez == 0 and $grafico["unico"] != 1){
                                                        echo  "</ul></div>"; 
                                                        $vez = 1;
                                                    }
                                                }       
                                            ?>  
                                            <div class="card-body col-lg-8 offset-2">
                                                <div class="tab-content" id="content-tab-eg8">
                                            <?php        
                                                //var_dump($graficos_evolucao);
                                                $indice = 0;
                                                foreach($graficos_cenarios as $grafico){
                                                    //echo "oi";
                                                    //require_once '../assets/plots/'.$grafico["arquivo"];
                                                    //$pieces = explode(".", $grafico["arquivo"]);
                                                    // include_once '../assets/plots/'.$pieces[0].".php";
                                                    
                                                    if ($grafico["ativo"] == "1"){
                                                         echo "<div class=\"tab-pane active\" id=\"tab-eg8-0\" role=\"tabpanel\">";
                                                     }else{
                                                        echo "<div class=\"tab-pane\" id=\"tab-eg8-".$indice."\" role=\"tabpanel\">";
                                                        
                                                     }
                                                     $i++;
                                                    //var_dump($grafico);
                                                    $secao = "cenarios";
                                                    // echo "indice:".$indice;
                                                    include("../app/controllers/graphicgenerator.php");
                                                    $indice++;
                                                    
                                                    // echo "<iframe width=\"100%\" height=\"450\" src=\"../assets/plots/".$grafico["arquivo"]."\" frameborder=\"0\" allowfullscreen></iframe>";
                                                    echo "<p class='fonte'>".$grafico["fonte"].$grafico["OBS"]."</p>";
                                                    echo "</div>";

                                                } 
                                            ?>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                        