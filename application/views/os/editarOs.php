
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>
<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-tags"></i>
                </span>
                <h5>Editar OS</h5>
            </div>
            <div class="widget-content nopadding">


                <div class="span12" id="divProdutosServicos" style=" margin-left: 0">
                    <ul class="nav nav-tabs">
                        <li class="active" id="tabDetalhes"><a href="#tab1" data-toggle="tab"><i class="icon-list-alt"></i> Detalhes da OS</a></li>
                        <li id="tabProdutos"><a href="#tab2" data-toggle="tab"><i class="icon-barcode"></i> Produtos</a></li>
                        <li id="tabServicos"><a href="#tab3" data-toggle="tab"><i class="icon-wrench"></i> Serviços</a></li>
                        <li id="tabAnexos"><a href="#tab4" data-toggle="tab"><i class="icon-folder-open"></i> Anexos</a></li>
                        <li id="tabTotal"><a href="#tab5" data-toggle="tab"><i class="icon-shopping-cart"></i> Total</a></li>
                        <li id="tabPagamento"><a href="#tab6" data-toggle="tab"><i class="icon-money"></i> Pagamento</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1">

                            <div class="span12" id="divCadastrarOs">

                                <form action="<?php echo current_url(); ?>" method="post" autocomplete="off" id="formOs">
                                    <?php echo form_hidden('idOs', $result->idOs) ?>

                                    <div class="span12" style="padding: 1%; margin-left: 0">
                                        <h3>#Nº OS: <?php echo $result->idOs ?></h3>

                                        <div class="span6 control-group" style="margin-left: 0">
                                            <label for="cliente">Cliente<span class="required">*</span></label>
                                            <input id="cliente" class="span12" type="text" name="cliente" value="<?php echo $result->nomeCliente ?>"  />
                                            <input id="clientes_id" class="span12" type="hidden" name="clientes_id" value="<?php echo $result->clientes_id ?>"  />
                                            <input id="valorTotal" type="hidden" name="valorTotal" value=""  />
                                        </div>
                                        <div class="span6 control-group">
                                            <label for="tecnico">Técnico / Responsável<span class="required">*</span></label>
                                            <input id="tecnico" class="span12" type="text" name="tecnico" value="<?php echo $result->nome ?>"  />
                                            <input id="usuarios_id" class="span12" type="hidden" name="usuarios_id" value="<?php echo $result->usuarios_id ?>"  />
                                        </div>
                                    </div>
                                    <div class="span12" style="padding: 1%; margin-left: 0">
                                        <div class="span3 control-group">
                                            <label for="status">Status<span class="required">*</span></label>
                                            <select class="span12" name="status" id="status" value="">
                                                <option <?php
                                    if ($result->status == 'Orçamento') {
                                        echo 'selected';
                                    }
                                    ?> value="Orçamento">Orçamento</option>
                                                <option <?php
                                                if ($result->status == 'Aberto') {
                                                    echo 'selected';
                                                }
                                    ?> value="Aberto">Aberto</option>
                                                <option <?php
                                                if ($result->status == 'Faturado') {
                                                    echo 'selected';
                                                }
                                    ?> value="Faturado">Faturado</option>
                                                <option <?php
                                                if ($result->status == 'Em Andamento') {
                                                    echo 'selected';
                                                }
                                    ?> value="Em Andamento">Em Andamento</option>
                                                <option <?php
                                                if ($result->status == 'Finalizado') {
                                                    echo 'selected';
                                                }
                                    ?> value="Finalizado">Finalizado</option>
                                                <option <?php
                                                if ($result->status == 'Cancelado') {
                                                    echo 'selected';
                                                }
                                    ?> value="Cancelado">Cancelado</option>
                                            </select>
                                        </div>
                                        <div class="span2 control-group">
                                            <label for="dataInicial">Data Inicial<span class="required">*</span></label>
                                            <input id="dataInicial" class="span12 datepicker" type="text" name="dataInicial" value="<?php echo date('d/m/Y', strtotime($result->dataInicial)); ?>"  />
                                        </div>
                                        <div class="span2 ">
                                            <label for="dataFinal">Data Final</label>
                                            <input id="dataFinal" class="span12 datepicker" type="text" name="dataFinal" value="<?php
                                                if ($result->dataFinal == 0) {
                                                    echo '';
                                                } else {
                                                    echo date('d/m/Y', strtotime($result->dataFinal));
                                                }
                                    ?>"  />
                                        </div>

                                        <div class="span3">
                                            <label for="garantia">Garantia</label>
                                            <select id="garantia" name="garantia">
                                                <option value="30" <?= ($result->garantia == 30) ? 'selected' : '' ?>>30 dias</option>
                                                <option value="60" <?= ($result->garantia == 60) ? 'selected' : '' ?>>60 dias</option>
                                                <option value="90" <?= ($result->garantia == 90) ? 'selected' : '' ?>>90 dias</option>
                                                <option value="180" <?= ($result->garantia == 180) ? 'selected' : '' ?>>6 meses</option>
                                                <option value="360" <?= ($result->garantia == 360) ? 'selected' : '' ?>>1 ano</option>
                                            </select> 
                                        </div>

                                    </div>

                                    <div class="span12" style="padding: 1%; margin-left: 0">

                                        <div class="span3">
                                            <label for="equipamento">Equipamento<span class="required">*</span></label>
                                            <?php
                                            $js = array(
                                                'id' => 'equipamento',
                                                'class' => 'span12'
                                            );
                                            $options = array($result->idEquipamentos => $result->equipamento) + $equipamentos;
                                            echo form_dropdown('equipamento', $options, 0, $js);
                                            ?>
                                        </div>
                                        <div class="span3">
                                            <label for="marca">Marca<span class="required">*</span></label>
                                            <?php
                                            $js = array(
                                                'id' => 'marcas',
                                                'class' => 'span12'
                                            );
                                            $options = array($result->idMarcas => $result->marca) + $marcas;
                                            echo form_dropdown('marca', $options, 0, $js);
                                            ?>

                                        </div>                                        
                                        <div class="span3">
                                            <label for="modelo">Modelo<span class="required">*</span></label>
                                            <select name="modelo" id="modelos" class="span12">
                                                <option value="<?php echo $result->idModelos ?>"><?php echo $result->modelos ?></option>
                                            </select>
                                        </div>
                                        <div class="span3">
                                            <label for="serie">Nº de Série</label>
                                            <input id="serie" type="text" class="span12" name="serie" value="<?php echo $result->nr_serie ?>"  />

                                        </div>


                                    </div> 


                                    <div class="span12" style="padding: 1%; margin-left: 0">

                                        <div class="span6">
                                            <label for="descricaoProduto">Descrição Produto/Serviço</label>
                                            <textarea class="span12" name="descricaoProduto" id="descricaoProduto" cols="30" rows="5"><?php echo $result->descricaoProduto ?></textarea>
                                        </div>
                                        <div class="span6">
                                            <label for="defeito">Defeito</label>
                                            <textarea class="span12" name="defeito" id="defeito" cols="30" rows="5"><?php echo $result->defeito ?></textarea>
                                        </div>

                                    </div>
                                    <div class="span12" style="padding: 1%; margin-left: 0">
                                        <div class="span6">
                                            <label for="observacoes">Observações</label>
                                            <textarea class="span12" name="observacoes" id="observacoes" cols="30" rows="5"><?php echo $result->observacoes ?></textarea>
                                        </div>
                                        <div class="span6">
                                            <label for="laudoTecnico">Laudo Técnico</label>
                                            <textarea class="span12" name="laudoTecnico" id="laudoTecnico" cols="30" rows="5"><?php echo $result->laudoTecnico ?></textarea>
                                        </div>
                                    </div>
                                    <div class="span12" style="padding: 1%; margin-left: 0">
                                        <div class="span6 offset3" style="text-align: center">
                                            <?php // if ($result->faturado == 0) {  ?>
<!--                                                <a href="#modal-faturar" id="btn-faturar" role="button" data-toggle="modal" class="btn btn-success"><i class="icon-file"></i> Faturar</a>-->
                                            <?php // }  ?>
                                            <button class="btn btn-primary" id="btnContinuar"><i class="icon-white icon-ok"></i> Alterar</button>
                                            <a href="<?php echo base_url() ?>index.php/os/visualizar/<?php echo $result->idOs; ?>" class="btn btn-inverse"><i class="icon-eye-open"></i> Visualizar OS</a>
                                            <a href="<?php echo base_url() ?>index.php/os" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>


                        <!--Produtos-->
                        <div class="tab-pane" id="tab2">
                            <div class="span12" style="padding: 1%; margin-left: 0">
                                <div class="span12 well" style="padding: 1%; margin-left: 0">
                                    <form id="formProdutos" action="" method="post">
                                        <div class="span6 control-group">
                                            <input type="hidden" name="idProduto" id="idProduto" />
                                            <input type="hidden" name="idOsProduto" id="idOsProduto" value="<?php echo $result->idOs ?>" />
                                            <input type="hidden" name="estoque" id="estoque" value=""/>
                                            <input type="hidden" name="preco" id="preco" value=""/>
                                            <label for="">Produto</label>
                                            <input type="text" class="span12" name="produto" id="produto" placeholder="Digite o nome do produto" />
                                        </div>
                                        <div class="span2 control-group">
                                            <label for="">Quantidade</label>
                                            <input type="text" placeholder="Quantidade" id="quantidade" name="quantidade" class="span12" />
                                        </div>
                                        <div class="span2">
                                            <label for="desconto">Desconto</label>
                                            <input type="text" placeholder="0.00" id="desconto" name="desconto" class="span12 money"/>
                                        </div>
                                        <div class="span2">
                                            <label for="">&nbsp;</label>
                                            <button class="btn btn-success span12" id="btnAdicionarProduto"><i class="icon-white icon-plus"></i> Adicionar</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="span12" id="divProdutos" style="margin-left: 0">
                                    <table class="table table-bordered" id="tblProdutos">
                                        <thead>
                                            <tr>
                                                <th>Produto</th>
                                                <th>Quantidade</th>
                                                <th>Valor Unit.</th>
                                                <th>Desconto</th>
                                                <th>Subtotal</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $totalProduto = 0;
                                            $descontoTotalProduto = 0;
                                            $precoVendaProduto = 0;
                                            $subTotalProduto = 0;
                                            foreach ($produtos as $p) {

                                                $descontoTotalProduto += $p->desconto;
                                                $precoVendaProduto += $p->precoVenda * $p->quantidade;
                                                $totalProduto += $p->subTotal;
                                                $subTotalProduto += $p->subTotal - $p->desconto;
                                                $subTotalProdutoItem = $p->subTotal - $p->desconto;
                                                echo '<tr>';
                                                echo '<td>' . $p->descricao . '</td>';
                                                echo '<td>' . $p->quantidade . '</td>';
                                                echo '<td>R$: ' . number_format($p->precoVenda, 2, ',', '.') . '</td>';
                                                echo '<td>R$: ' . number_format($p->desconto, 2, ',', '.') . '</td>';
                                                echo '<td>R$: ' . number_format($subTotalProdutoItem, 2, ',', '.') . '</td>';
                                                echo '<td><a href="" idAcao="' . $p->idProdutos_os . '" prodAcao="' . $p->idProdutos . '" quantAcao="' . $p->quantidade . '" title="Excluir Produto" class="btn btn-danger"><i class="icon-remove icon-white"></i></a></td>';
                                                echo '</tr>';
                                            }
                                            ?>

                                            <tr>
                                                <td colspan="4" style="text-align: right"><strong>Total:</br>Desconto:</br>Subtotal:</strong></td>
                                                <td><strong>R$: <?php echo number_format($totalProduto, 2, ',', '.'); ?></br><p class="text-error" style="margin: 0 0 0px;">R$: -<?php echo number_format($descontoTotalProduto, 2, ',', '.'); ?></p><p class="text-success" style="margin: 0 0 0px;">R$: <?php echo number_format($subTotalProduto, 2, ',', '.'); ?></p><input type="hidden" id="total-venda" value="<?php echo number_format($totalProduto, 2); ?>"></strong></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!--Serviços-->
                        <div class="tab-pane" id="tab3">
                            <div class="span12" style="padding: 1%; margin-left: 0">
                                <div class="span12 well" style="padding: 1%; margin-left: 0">
                                    <form id="formServicos" action="" method="post">
                                        <div class="span8 control-group">
                                            <input type="hidden" name="idServico" id="idServico" />
                                            <input type="hidden" name="idOsServico" id="idOsServico" value="<?php echo $result->idOs ?>" />
                                            <input type="hidden" name="precoServico" id="precoServico" value=""/>
                                            <label for="">Serviço</label>
                                            <input type="text" class="span12" name="servico" id="servico" placeholder="Digite o nome do serviço" />
                                        </div>
                                        <div class="span2">
                                            <label for="desconto">Desconto</label>
                                            <input type="text" placeholder="0.00" id="descontoS" name="desconto" class="span12 money" />
                                        </div>
                                        <div class="span2">
                                            <label for="">&nbsp;</label>
                                            <button class="btn btn-success span12"><i class="icon-white icon-plus"></i> Adicionar</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="span12" id="divServicos" style="margin-left: 0">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Serviço</th>
                                                <th>Valor</th>
                                                <th>Desconto</th>
                                                <th>Subtotal</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $total = 0;
                                            $descontoTotalServico = 0;
                                            $subTotalServico = 0;
                                            foreach ($servicos as $s) {
                                                $descontoTotalServico += $s->desconto;
                                                $preco = $s->subTotal;
                                                $total = $total + $preco;
                                                $subTotalServico += $s->subTotal - $s->desconto;
                                                $subTotalServicoItem = $s->subTotal - $s->desconto;
                                                echo '<tr>';
                                                echo '<td>' . $s->nome . '</td>';
                                                echo '<td>R$ ' . number_format($s->subTotal, 2, ',', '.') . '</td>';
                                                echo '<td>R$ ' . number_format($s->desconto, 2, ',', '.') . '</td>';
                                                echo '<td>R$ ' . number_format($subTotalServicoItem, 2, ',', '.') . '</td>';
                                                echo '<td><span idAcao="' . $s->idServicos_os . '" title="Excluir Serviço" class="btn btn-danger"><i class="icon-remove icon-white"></i></span></td>';
                                                echo '</tr>';
                                            }
                                            ?>

                                            <tr>
                                                <td colspan="3" style="text-align: right"><strong>Total:</br>Desconto:</br>Subtotal:</strong></td>
                                                <td><strong>R$: <?php echo number_format($total, 2, ',', '.'); ?></br><p class="text-error" style="margin: 0 0 0px;">R$: -<?php echo number_format($descontoTotalServico, 2, ',', '.'); ?></p><p class="text-success" style="margin: 0 0 0px;">R$: <?php echo number_format($subTotalServico, 2, ',', '.'); ?></p><input type="hidden" id="total-venda" value="<?php echo number_format($totalProduto, 2); ?>"></strong></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>


                        <!--Anexos-->
                        <div class="tab-pane" id="tab4">
                            <div class="span12" style="padding: 1%; margin-left: 0">
                                <div class="span12 well" style="padding: 1%; margin-left: 0" id="form-anexos">
                                    <form id="formAnexos" enctype="multipart/form-data" action="javascript:;" accept-charset="utf-8"s method="post">
                                        <div class="span10">

                                            <input type="hidden" name="idOsServico" id="idOsServico" value="<?php echo $result->idOs ?>" />
                                            <label for="">Anexo</label>
                                            <input type="file" class="span12" name="userfile[]" multiple="multiple" size="20" />
                                        </div>
                                        <div class="span2">
                                            <label for="">.</label>
                                            <button class="btn btn-success span12"><i class="icon-white icon-plus"></i> Anexar</button>
                                        </div>
                                    </form>
                                </div>

                                <div class="span12" id="divAnexos" style="margin-left: 0">
                                    <?php
                                    $cont = 1;
                                    $flag = 5;
                                    foreach ($anexos as $a) {

                                        if ($a->thumb == null) {
                                            $thumb = base_url() . 'assets/img/icon-file.png';
                                            $link = base_url() . 'assets/img/icon-file.png';
                                        } else {
                                            $thumb = base_url() . 'assets/anexos/thumbs/' . $a->thumb;
                                            $link = $a->url . $a->anexo;
                                        }

                                        if ($cont == $flag) {
                                            echo '<div style="margin-left: 0" class="span3"><a href="#modal-anexo" imagem="' . $a->idAnexos . '" link="' . $link . '" role="button" class="btn anexo" data-toggle="modal"><img src="' . $thumb . '" alt=""></a></div>';
                                            $flag += 4;
                                        } else {
                                            echo '<div class="span3"><a href="#modal-anexo" imagem="' . $a->idAnexos . '" link="' . $link . '" role="button" class="btn anexo" data-toggle="modal"><img src="' . $thumb . '" alt=""></a></div>';
                                        }
                                        $cont ++;
                                    }
                                    ?>
                                </div>

                            </div>
                        </div>

                        <!-- Total da OS -->
                        <div class="tab-pane" id="tab5">
                            <div class="span12" style="padding: 1%; margin-left: 0">
                                <div class="span12 well" id="divTotal" style="padding: 1%; margin-left: 0">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Mão de Obra</th>
                                                <th>Peças</th>
                                                <th>Descontos</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?php echo 'R$: ' . number_format($total, 2, ',', '.'); ?></td>
                                                <td><?php echo 'R$: ' . number_format($totalProduto, 2, ',', '.'); ?></td>
                                                <td><?php echo 'R$: ' . number_format($descontoTotalProduto + $descontoTotalServico, 2, ',', '.'); ?></td>
                                                <td><?php echo 'R$: ' . number_format($total + $totalProduto - ($descontoTotalProduto + $descontoTotalServico), 2, ',', '.'); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>

                        <!-- Pagamento -->
                        <div class="tab-pane" id="tab6">
                            <div class="span12" style="padding: 1%; margin-left: 0">
                                <form id="formFaturar" action="" method="post">
                                    <input type="hidden" id="tipo" name="tipo" value="receita" /> 
                                    <input type="hidden" name="clientes_id" id="clientes_id" value="<?php echo $result->clientes_id ?>">
                                    <input type="hidden" name="os_id" id="os_id" value="<?php echo $result->idOs; ?>">
                                    <input type="hidden" name="descricao" id="descricao" value="Fatura de O.S - #<?php echo $result->idOs;?>">
                                    <input type="hidden" name="cliente" id="cliente" value="<?php echo $result->nomeCliente;?>">
                                    <?php if ($result->faturado == 0){?>
                                    <div class="span12 well" style="padding: 1%; margin-left: 0">

                                        <input type="radio" name="pagamento" id="avista"/>À vista
                                        <input type="radio" name="pagamento" id="parcelado" />Parcelado

                                    </div>

                                    <div class="span12 hidden" id="Vavista" style="padding: 1%; margin-left: 0">
                                        <div class="span2 control-group">
                                            <label for="dataVencimento">Vencimento<span class="required">*</span></label>
                                            <input id="vencimento" class="span12 datepicker" type="text" name="vencimento" value="<?php echo date('d/m/Y'); ?>"  />
                                        </div>
                                        <div class="span2 control-group">
                                            <label for="valor">Valor<span class="required">*</span></label>
                                            <input id="valor" class="span12 money" type="text" name="valor" value="<?php echo number_format($total + $totalProduto - ($descontoTotalProduto + $descontoTotalServico), 2, '.', '.'); ?>"  />
                                        </div>
                                        <div class="span3">
                                            <label for="formaPgto">Forma de Pagamento</label>
                                            <select name="formaPgto" id="formaPgto" class="span12">
                                                <option value="Dinheiro">Dinheiro</option>
                                                <option value="Cartão de Crédito">Cartão de Crédito</option>
                                                <option value="Cheque">Cheque</option>
                                                <option value="Boleto">Boleto</option>
                                                <option value="Depósito">Depósito</option>
                                                <option value="Débito">Débito</option>        
                                            </select> 
                                        </div>
                                    </div>
                                    <div class="span12 hidden" id="Vparcelado" style="padding: 1%; margin-left: 0">
                                        <div class="span3">
                                            <label for="qtParcela">Qnt. Parcelas</label>
                                            <select name="qtparcela" id="qtparcela" class="span12">
                                                <option selected="" value="">Selecione uma parcela</option>
                                                <option value="1">1 vez</option>
                                                <option value="2">2 vezes</option>
                                                <option value="3">3 vezes</option>
                                                <option value="4">4 vezes</option>
                                                <option value="5">5 vezes</option>
                                                <option value="6">6 vezes</option>
                                                <option value="7">7 vezes</option>
                                                <option value="8">8 vezes</option>
                                                <option value="9">9 vezes</option>
                                                <option value="10">10 vezes</option>
                                                <option value="11">11 vezes</option>
                                                <option value="12">12 vezes</option>

                                            </select> 
                                        </div>
<!--                                        <div class="span2">
                                            <label for="">&nbsp;</label>
                                            <button class="btn btn-primary"><i class="icon-white icon-refresh"></i> Gerar Parcelas</button>
                                        </div>-->
                                    </div>
                                    <div class="span12" style="padding: 1%; margin-left: 0">
                                        <div class="span6" id="resultado"></div>
                                        
                                    </div>
                                    <div class="span2 hidden" id="btnFat" style="padding: 1%; margin-left: 0">
                                        <label for="">&nbsp;</label>
                                        
                                        <button class="btn btn-success"><i class="icon-white icon-money"></i> Faturar</button>
                                       
                                    </div>
                                     <?php }elseif ($result->faturado == 1){?>
                                    <div class="alert alert-info"><strong>OS faturada!<a href="#"> <ins>Visualizar Fatura</ins></a></strong>
                                    </div>
                                    <?php } ?>
                                </form>
                            </div>
                        </div>





                    </div>

                </div>


                &nbsp;

            </div>

        </div>
    </div>
</div>





<!-- Modal visualizar anexo -->
<div id="modal-anexo" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Visualizar Anexo</h3>
    </div>
    <div class="modal-body">
        <div class="span12" id="div-visualizar-anexo" style="text-align: center">
            <div class='progress progress-info progress-striped active'><div class='bar' style='width: 100%'></div></div>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>
        <a href="" id-imagem="" class="btn btn-inverse" id="download">Download</a>
        <a href="" link="" class="btn btn-danger" id="excluir-anexo">Excluir Anexo</a>
    </div>
</div>





<!-- Modal Faturar-->
<div id="modal-faturar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form id="formFaturar" action="<?php echo current_url() ?>" method="post">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Faturar Venda</h3>
        </div>
        <div class="modal-body">

            <div class="span12 alert alert-info" style="margin-left: 0"> Obrigatório o preenchimento dos campos com asterisco.</div>
            <div class="span12 control-group" style="margin-left: 0"> 
                <label for="descricao">Descrição</label>
                <input class="span12" id="descricao" type="text" name="descricao" value="Fatura de Venda - #<?php echo $result->idOs; ?> "  />

            </div>  
            <div class="span12" style="margin-left: 0"> 
                <div class="span12" style="margin-left: 0"> 
                    <label for="cliente">Cliente*</label>
                    <input class="span12" id="cliente" type="text" name="cliente" value="<?php echo $result->nomeCliente ?>" />
                    <input type="hidden" name="clientes_id" id="clientes_id" value="<?php echo $result->clientes_id ?>">
                    <input type="hidden" name="os_id" id="os_id" value="<?php echo $result->idOs; ?>">
                </div>


            </div>
            <div class="span12" style="margin-left: 0"> 
                <div class="span4" style="margin-left: 0">  
                    <label for="valor">Valor*</label>
                    <input type="hidden" id="tipo" name="tipo" value="receita" /> 
                    <input class="span12 money" id="valor" type="text" name="valor" value="<?php echo number_format($total, 2, ',', '.'); ?> "  />
                </div>
                <div class="span4" >
                    <label for="vencimento">Data Vencimento*</label>
                    <input class="span12 datepicker" id="vencimento" type="text" autocomplete="off" name="vencimento"  />
                </div>

            </div>

            <div class="span12" style="margin-left: 0"> 
                <div class="span4" style="margin-left: 0">
                    <label for="recebido">Recebido?</label>
                    &nbsp &nbsp &nbsp &nbsp <input  id="recebido" type="checkbox"  name="recebido" value="1" /> 
                </div>
                <div id="divRecebimento" class="span8" style=" display: none">
                    <div class="span6">
                        <label for="recebimento">Data Recebimento</label>
                        <input class="span12 datepicker" id="recebimento" type="text" autocomplete="off" name="recebimento" /> 
                    </div>
                    <div class="span6">
                        <label for="formaPgto">Forma Pgto</label>
                        <select name="formaPgto" id="formaPgto" class="span12">
                            <option value="Dinheiro">Dinheiro</option>
                            <option value="Cartão de Crédito">Cartão de Crédito</option>
                            <option value="Cheque">Cheque</option>
                            <option value="Boleto">Boleto</option>
                            <option value="Depósito">Depósito</option>
                            <option value="Débito">Débito</option>        
                        </select> 
                    </div>

                </div>


            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true" id="btn-cancelar-faturar">Cancelar</button>
                <button class="btn btn-primary">Faturar</button>
            </div>
    </form>
</div>



<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>
<script src="<?php echo base_url(); ?>assets/js/maskmoney.js"></script>
<script type="text/javascript">
    $(document).ready(function () {

        $(function () {
            $('#marcas').change(function () {
                $('#modelos').html("<option>Carregando...</option>");
                var id_marcas = $('#marcas').val();
                $.post("<?php echo base_url(); ?>index.php/os/buscaModelosbyMarcas", {
                    id_marcas: id_marcas
                }, function (data) {
                    $('#modelos').html(data);
                });
            });
        });
        
        $(function () {
            $('#qtparcela').change(function () {
                $('#resultado').html("<div class='progress progress-info progress-striped active'><div class='bar' style='width: 100%'></div></div>");
                var valor = $('#valor').val();
                var vencimento = $('#vencimento').val();
                var qtparcela = $('#qtparcela').val();
                $.post("<?php echo base_url(); ?>index.php/os/geraParcela", {
                    valor: valor,
                    vencimento: vencimento,
                    qtparcela: qtparcela
                }, function (data) {
                    $('#resultado').html(data);
                });
            });
        });

        $(".money").maskMoney();

        $('#recebido').click(function (event) {
            var flag = $(this).is(':checked');
            if (flag == true) {
                $('#divRecebimento').show();
            } else {
                $('#divRecebimento').hide();
            }
        });

        $(document).on('click', '#btn-faturar', function (event) {
            event.preventDefault();
            valor = $('#total-venda').val();
            total_servico = $('#total-servico').val();
            valor = valor.replace(',', '');
            total_servico = total_servico.replace(',', '');
            total_servico = parseFloat(total_servico);
            valor = parseFloat(valor);
            $('#valor').val(valor + total_servico);
        });

        $("#formFaturar").validate({
            rules: {
                descricao: {required: true},
                cliente: {required: true},
                valor: {required: true},
                vencimento: {required: true}

            },
            messages: {
                descricao: {required: 'Campo Requerido.'},
                cliente: {required: 'Campo Requerido.'},
                valor: {required: 'Campo Requerido.'},
                vencimento: {required: 'Campo Requerido.'}
            },
            submitHandler: function (form) {
                var dados = $(form).serialize();
                $('#btn-cancelar-faturar').trigger('click');
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>index.php/os/faturar",
                    data: dados,
                    dataType: 'json',
                    success: function (data)
                    {
                        if (data.result == true) {

                            window.location.reload(true);
                        } else {
                            alert('Ocorreu um erro ao tentar faturar OS.');
                            $('#progress-fatura').hide();
                        }
                    }
                });

                return false;
            }
        });

        $("#produto").autocomplete({
            source: "<?php echo base_url(); ?>index.php/os/autoCompleteProduto",
            minLength: 2,
            select: function (event, ui) {

                $("#idProduto").val(ui.item.id);
                $("#estoque").val(ui.item.estoque);
                $("#preco").val(ui.item.preco);
                $("#quantidade").focus();


            }
        });

        $("#servico").autocomplete({
            source: "<?php echo base_url(); ?>index.php/os/autoCompleteServico",
            minLength: 2,
            select: function (event, ui) {

                $("#idServico").val(ui.item.id);
                $("#precoServico").val(ui.item.preco);


            }
        });


        $("#cliente").autocomplete({
            source: "<?php echo base_url(); ?>index.php/os/autoCompleteCliente",
            minLength: 2,
            select: function (event, ui) {

                $("#clientes_id").val(ui.item.id);


            }
        });

        $("#tecnico").autocomplete({
            source: "<?php echo base_url(); ?>index.php/os/autoCompleteUsuario",
            minLength: 2,
            select: function (event, ui) {

                $("#usuarios_id").val(ui.item.id);


            }
        });




        $("#formOs").validate({
            rules: {
                cliente: {required: true},
                tecnico: {required: true},
                dataInicial: {required: true},
                equipamento: {required: true},
                marcas: {required: true},
                modelos: {required: true}

            },
            messages: {
                cliente: {required: 'Campo Requerido.'},
                tecnico: {required: 'Campo Requerido.'},
                dataInicial: {required: 'Campo Requerido.'},
                equipamento: {required: 'Campo Requerido.'},
                marcas: {required: 'Campo Requerido.'},
                modelos: {required: 'Campo Requerido.'}
            },

            errorClass: "help-inline",
            errorElement: "span",
            highlight: function (element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            }
        });




        $("#formProdutos").validate({
            rules: {
                produto: {required: true},
                quantidade: {required: true}
            },
            messages: {
                quantidade: {required: 'Insira a quantidade'},
                produto: {required: 'Insira um produto'}
            },
            errorClass: "help-inline",
            errorElement: "span",
            highlight: function (element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            },
            submitHandler: function (form) {
                var quantidade = parseInt($("#quantidade").val());
                var estoque = parseInt($("#estoque").val());
                if (estoque < quantidade) {
                    alert('Você não possui estoque suficiente.');
                } else {
                    var dados = $(form).serialize();
                    $("#divProdutos").html("<div class='progress progress-info progress-striped active'><div class='bar' style='width: 100%'></div></div>");
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>index.php/os/adicionarProduto",
                        data: dados,
                        dataType: 'json',
                        success: function (data)
                        {
                            if (data.result == true) {
                                $("#divProdutos").load("<?php echo current_url(); ?> #divProdutos");
                                $("#divTotal").load("<?php echo current_url(); ?> #divTotal");
                                $("#quantidade").val('');
                                $("#produto").val('').focus();
                                $("#desconto").val('');
                            } else {
                                alert('Ocorreu um erro ao tentar adicionar produto.');
                            }
                        }
                    });

                    return false;
                }

            }

        });

        $("#formServicos").validate({
            rules: {
                servico: {required: true}
            },
            messages: {
                servico: {required: 'Insira um serviço'}
            },
            errorClass: "help-inline",
            errorElement: "span",
            highlight: function (element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            },
            submitHandler: function (form) {
                var dados = $(form).serialize();

                $("#divServicos").html("<div class='progress progress-info progress-striped active'><div class='bar' style='width: 100%'></div></div>");
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>index.php/os/adicionarServico",
                    data: dados,
                    dataType: 'json',
                    success: function (data)
                    {
                        if (data.result == true) {
                            $("#divServicos").load("<?php echo current_url(); ?> #divServicos");
                            $("#divTotal").load("<?php echo current_url(); ?> #divTotal");
                            $("#servico").val('').focus();
                            $("#descontoS").val('');
                        } else {
                            alert('Ocorreu um erro ao tentar adicionar serviço.');
                        }
                    }
                });

                return false;
            }

        });


        $("#formAnexos").validate({

            submitHandler: function (form) {
                //var dados = $( form ).serialize();
                var dados = new FormData(form);
                $("#form-anexos").hide('1000');
                $("#divAnexos").html("<div class='progress progress-info progress-striped active'><div class='bar' style='width: 100%'></div></div>");
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>index.php/os/anexar",
                    data: dados,
                    mimeType: "multipart/form-data",
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: 'json',
                    success: function (data)
                    {
                        if (data.result == true) {
                            $("#divAnexos").load("<?php echo current_url(); ?> #divAnexos");
                            $("#userfile").val('');

                        } else {
                            $("#divAnexos").html('<div class="alert fade in"><button type="button" class="close" data-dismiss="alert">×</button><strong>Atenção!</strong> ' + data.mensagem + '</div>');
                        }
                    },
                    error: function () {
                        $("#divAnexos").html('<div class="alert alert-danger fade in"><button type="button" class="close" data-dismiss="alert">×</button><strong>Atenção!</strong> Ocorreu um erro. Verifique se você anexou o(s) arquivo(s).</div>');
                    }

                });

                $("#form-anexos").show('1000');
                return false;
            }

        });

        $(document).on('click', 'a', function (event) {
            var idProduto = $(this).attr('idAcao');
            var quantidade = $(this).attr('quantAcao');
            var produto = $(this).attr('prodAcao');
            if ((idProduto % 1) == 0) {
                $("#divProdutos").html("<div class='progress progress-info progress-striped active'><div class='bar' style='width: 100%'></div></div>");
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>index.php/os/excluirProduto",
                    data: "idProduto=" + idProduto + "&quantidade=" + quantidade + "&produto=" + produto,
                    dataType: 'json',
                    success: function (data)
                    {
                        if (data.result == true) {
                            $("#divProdutos").load("<?php echo current_url(); ?> #divProdutos");

                        } else {
                            alert('Ocorreu um erro ao tentar excluir produto.');
                        }
                    }
                });
                return false;
            }

        });



        $(document).on('click', 'span', function (event) {
            var idServico = $(this).attr('idAcao');
            if ((idServico % 1) == 0) {
                $("#divServicos").html("<div class='progress progress-info progress-striped active'><div class='bar' style='width: 100%'></div></div>");
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>index.php/os/excluirServico",
                    data: "idServico=" + idServico,
                    dataType: 'json',
                    success: function (data)
                    {
                        if (data.result == true) {
                            $("#divServicos").load("<?php echo current_url(); ?> #divServicos");

                        } else {
                            alert('Ocorreu um erro ao tentar excluir serviço.');
                        }
                    }
                });
                return false;
            }

        });


        $(document).on('click', '.anexo', function (event) {
            event.preventDefault();
            var link = $(this).attr('link');
            var id = $(this).attr('imagem');
            var url = '<?php echo base_url(); ?>index.php/os/excluirAnexo/';
            $("#div-visualizar-anexo").html('<img src="' + link + '" alt="">');
            $("#excluir-anexo").attr('link', url + id);

            $("#download").attr('href', "<?php echo base_url(); ?>index.php/os/downloadanexo/" + id);

        });

        $(document).on('click', '#excluir-anexo', function (event) {
            event.preventDefault();

            var link = $(this).attr('link');
            $('#modal-anexo').modal('hide');
            $("#divAnexos").html("<div class='progress progress-info progress-striped active'><div class='bar' style='width: 100%'></div></div>");

            $.ajax({
                type: "POST",
                url: link,
                dataType: 'json',
                success: function (data)
                {
                    if (data.result == true) {
                        $("#divAnexos").load("<?php echo current_url(); ?> #divAnexos");
                    } else {
                        alert(data.mensagem);
                    }
                }
            });
        });



        $(".datepicker").datepicker({dateFormat: 'dd/mm/yy'});


        $('#avista').on('change', function () {
            if ($(this).is(':checked')) {
                $('#Vavista').removeClass('hidden');
                $('#Vparcelado').addClass('hidden');
                $('#btnFat').removeClass('hidden');
            }
        });

        $('#parcelado').on('change', function () {
            if ($(this).is(':checked')) {
                $('#Vavista').removeClass('hidden');
                $('#Vparcelado').removeClass('hidden');
                $('#btnFat').removeClass('hidden');
                
            }
        });



    });

</script>




