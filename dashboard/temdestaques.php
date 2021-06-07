                                <div class="card-hover-shadow-2x mb-3 card">
                                    <div class="card-header-tab card-header">
                                        <div class="card-header-title font-size-lg font-weight-normal">Destaques positivos </div>
                                        <div class="btn-actions-pane-right actions-icon-btn">
                                            <?php if (verify_login()){ ?>
                                            <a class="text-right float-right" href="#" onclick="javascript: download3Resources('<?php echo $_GET['indicador'].'_DESTAQUES';?>','destaques','csv_destaques_externo1','csv_destaques_externo2','csv_destaques_externo3')" download>
                                                <img class="" src="../assets/images/svg/Download.svg"/>
                                            </a>
                                            <?php }else {?>
                                                <img src="../assets/images/svg/Download.svg" style="float:right;" onclick="" data-target="#alertaNaoCadastrado" class="float:right" data-toggle="modal"/>
                                            <?php } ?>
                                        </div>
                                    </div>
                                     <div class="card-body text-center card-body-destaques" >
                                        <?php 
                                                
                                            $data_destaques = $perfil->getDestaques($_GET["indicador"]);

                                        ?>    
                                        <input type="hidden" value="<?php echo array_to_csv_download($data_destaques["destaque_1"],";",3); ?>" id="csv_destaques_externo1"></input>  
                                        <input type="hidden" value="<?php echo array_to_csv_download($data_destaques["destaque_2"],";",3); ?>" id="csv_destaques_externo2"></input> 
                                        <input type="hidden" value="<?php echo array_to_csv_download($data_destaques["destaque_3"],";",3); ?>" id="csv_destaques_externo3"></input>    
                                    <div class="mb-1 card card-destaque text-white bg-green">
                                        <div class="card-header">Melhor indicador do último ano 
                                            <button type="button" class="btn mr-2 mb-2 btn-primary btn-search" data-toggle="modal" data-target="#exampleModalLongAno">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                        <div class="row row-especial-2">
                                            <div class="card-body destaque-texto"><?php echo $data_destaques["destaque_1"]["estado"]; ?><div class="sub-destaque">UF</div></div>
                                            
                                            <div class="card-body destaque-texto"><?php echo $data_destaques["destaque_1"]["valor"]; ?><div class="sub-destaque">Valor</div></div>
                                            <div class="card-body destaque-texto"><?php echo $data_destaques["destaque_1"]["ano"]; ?><div class="sub-destaque">Ano</div></div>
                                        </div>    
                                        <div class="card-footer"></div>
                                    </div>

                                    <div class="mb-1 card card-destaque text-white bg-orange">
                                        <div class="card-header">Melhor variação no ranking <button type="button" class="btn mr-2 mb-2 btn-primary btn-search" data-toggle="modal" data-target="#exampleModalLongRanking">
                                                <i class="fas fa-search"></i>
                                            </button></div>
                                        <div class="row row-especial-2">    
                                            <div class="card-body destaque-texto"><?php echo $data_destaques["destaque_2"]["estado"]; ?><div class="sub-destaque">UF</div></div>
                                            <div class="card-body destaque-texto">
                                                <div class="">
                                                <?php if (intval($data_destaques["destaque_2"]["posicao"]) > 0 ) { 
                                                        echo "<i class=\"fas fa-long-arrow-alt-up\" style=\"font-size: 20px;\"></i>&nbsp";   
                                                      }else if (intval($data_destaques["destaque_2"]["posicao"]) < 0 ){
                                                        echo "<i class=\"fas fa-long-arrow-alt-down\" style=\"font-size: 20px;\"></i>&nbsp";   
                                                      }

                                                ?>
                                                <?php echo abs($data_destaques["destaque_2"]["posicao"]); ?></div>
                                                <div class="sub-destaque">Posição</div>
                                           </div>
                                            <div class="card-body destaque-texto"><?php echo $data_destaques["destaque_2"]["periodo"]; ?><div class="sub-destaque">Período</div></div>
                                        </div>
                                        <div class="card-footer"></div>
                                    </div>
                                    <div class="mb-1 card card-destaque text-white bg-bordo">
                                        <div class="card-header ">Melhor variação no indicador <button type="button" class="btn mr-2 mb-2 btn-primary btn-search" data-toggle="modal" data-target="#exampleModalLongIndicador">
                                                <i class="fas fa-search"></i>
                                            </button></div>
                                        <div class="row row-especial-2">    
                                            <div class="card-body destaque-texto"><?php echo $data_destaques["destaque_3"]["estado"]; ?><div class="sub-destaque">UF</div></div>
                                            <div class="card-body destaque-texto"><?php echo $data_destaques["destaque_3"]["variacao"]; ?><div class="sub-destaque">Variação
                                            </div></div>
                                            <div class="card-body destaque-texto"><?php echo $data_destaques["destaque_3"]["periodo"]; ?><div class="sub-destaque">Período</div></div>
                                        </div>
                                        <div class="card-footer"></div>
                                    </div>
                                    </div>
                                </div>