                                 <div class="card-hover-shadow-2x mb-3 card">
                                    <div class="card-header-tab card-header">
                                        <div class="card-header-title font-size-lg font-weight-normal">
                                            Territorialização do indicador na região <?php echo $regiao; ?>
                                        </div>
                                        <script type="text/javascript">
                                            function getFile(filepath) {
                                              var data;
                                              d3.html(filepath, function (d){
                                                console.log("file", d.children);
                                                //console.log("file", d.innerHTML);
                                                console.log("type", typeof(d));
                                                downloadResources(d);
                                              });
                                            };
                                           
                                            function downloadResources(nome_arquivo){
                                                  var zip = new JSZip();
                                                  zip.file("leiame.txt", "PLATAFORMA AMAZONIA LEGAL : LEIA-ME \n\n\nOs CSVs gerados seguem o padrão de codificação UTF-8 sem BOM. Para conseguir abrir no Excel sem problemas nos caracteres dos textos abra um editor de textos, como notepad ou sublime e altere a codificação para UTF-8 com BOM. \n ================================================== \nNo Notepad++ no meu Formatar selecione a opção \"Codificação UTF-8\" ou \"Codificação UTF-8 BOM\" e salve seu arquivo. Pronto estará preparado para ser aberto normalmente no excel.");
                                                  zip.file("tabela_territorializacao.csv", document.getElementById("csv_territorializacao").value);
                                                  //var img = zip.folder("images");
                                                  //img.file("smile.gif", imgData, {base64: true});
                                                  zip.generateAsync({type:"blob"})
                                                  .then(function(content) {
                                                      // see FileSaver.js
                                                      saveAs(content, nome_arquivo+".zip");
                                                   });
                                             }
                                       </script>
                                        <div class="btn-actions-pane-right text-capitalize actions-icon-btn">
                                            <a class="text-right float-right" href="#" onclick="javascript: downloadResources('<?php echo $_GET['indicador'].'_TERRITORIALIZACAO';?>')" download>
                                                <img class="" src="../assets/images/svg/Download.svg"/>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h4 class="texto"><?php    
                                            echo $perfil->getTextoIndicadorTerritorializacao($_GET["indicador"],$regiao);
                                        ?></h4>
                                        <?php 
                                            $tabela_territorializacao = $perfil->getTabelaIndicadorTerritorializacao($_GET["indicador"], $regiao);
                                        ?>
                                        <input type="hidden" value="<?php echo array_to_csv_download($tabela_territorializacao,4); ?>" id="csv_territorializacao"></input>  
                                        <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered text-center">
                                            <thead>
                                                <tr>
                                                <?php    
                                                $primeiro = 1;
                                                foreach ($tabela_territorializacao[0] as $linha){
                                                    if ($primeiro == 1){
                                                        echo "<th class=\"td-wd-30 text-left\">".$linha."</th>";
                                                        $primeiro = 0;
                                                    }else{
                                                        echo "<th class=\"td-wd-15\">".$linha."</th>";
                                                    }
                                                }   
                                                ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                           <?php 
                                                $linha = 0;
                                                foreach ($tabela_territorializacao as $linha){
                                                    $linha++;
                                                    // echo "<pre>";
                                                    // var_dump($linha);
                                                    // echo "</pre>";
                                                    if ($linha != 1){
                                                        $i = 0;
                                                        foreach ($linha as $coluna){
                                                            echo "<tr>";
                                                            $vez = 1;
                                                            $j = 0;
                                                            foreach ($coluna as $coluna1){
                                                                if ($vez == 1 and $i != sizeof($linha)-1){
                                                                    echo "<td class=\"text-left\">".$coluna1."</td>";
                                                                    $vez++;
                                                                }else if ($i == sizeof($linha)-1 and $j == 0){
                                                                    echo "<th class=\"text-left td-wd-20 td-total\">".$coluna1."</th>"; 
                                                                }else{
                                                                     echo "<td>".$coluna1."</td>";
                                                                }
                                                                $j++;
                                                            }
                                                            $i++;
                                                            echo "</tr>";
                                                        } 
                                                    }
                                                }    
                                            ?>
                                            </tfoot>
                                        </table>
                                        <?php 
                                            $graficos_territorializacao = $perfil->getMapaIndicadorTerritorializacao($_GET["indicador"], $regiao);
                                            //var_dump($graficos_territorializacao);
                                        ?>    
                                        <div class="card-body">
                                                <div class="tab-content">
                                            <?php        
                                                //var_dump($graficos_evolucao);
                                                foreach($graficos_territorializacao as $grafico){
                                                    //echo "oi";
                                                    //require_once '../assets/plots/'.$grafico["arquivo"];
                                                    //$pieces = explode(".", $grafico["arquivo"]);
                                                    // include_once '../assets/plots/'.$pieces[0].".php";
                                                    $i = 1;
                                                    if ($grafico["ativo"] == "1"){
                                                         echo "<div class=\"tab-pane active\" id=\"tab-eg7-0\" role=\"tabpanel\">";
                                                    }else{
                                                        echo "<div class=\"tab-pane\" id=\"tab-eg7-".$i."\" role=\"tabpanel\">";
                                                        $i++;
                                                    }
                                                    //var_dump($grafico);
                                                    echo "<iframe width=\"100%\" height=\"450\" src=\"../assets/plots/".$grafico["arquivo"]."\" frameborder=\"0\" allowfullscreen></iframe>";
                                                    echo "<p class='fonte'>".$grafico["fonte"].$grafico["OBS"]."</p>";
                                                    echo "</div>";
                                                } 
                                            ?>
                                                </div>
                                            </div>
                                    </div>
                                </div>
