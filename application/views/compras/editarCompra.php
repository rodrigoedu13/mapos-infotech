<link rel="stylesheet" href="<?php echo base_url();?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>
<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-align-justify"></i>
                </span>
                <h5>Editar compra</h5>
            </div>
            <div class="widget-content nopadding">
              <?php if ($custom_error == true) { ?>
                                    <div class="span12 alert alert-danger" id="divInfo" style="padding: 1%;">Dados incompletos, verifique os campos com asterisco ou se selecionou corretamente cliente e responsável.</div>
                                <?php } ?>
                <form action="<?php echo current_url(); ?>" id="formCompra" method="post" >
                    
                    <div class="span12" style="padding: 1%">
                        <div class="span4">
                            <label for="fornecedor" class="control-label">Fornecedor:<span class="required">*</span></label>
                            <div class="control-group">
                                <input id="fornecedor" class="span12" type="text" name="fornecedor" value="<?=$result->nomeFornecedor;?>"  />
                                <input id="fornecedor_id" class="span12" type="hidden" name="fornecedor_id" value="<?=$result->fornecedor_id;?>"  />
                                <input type="hidden" name="idCompra" value="<?= $result->idCompra;?>"/>
                            </div>
                        </div>
                        <div class="span2">
                            <label for="dtEmissao" class="control-label">Data de Emissão:<span class="required">*</span></label>
                            <div class="control-group">
                                <input id="dtEmissao" class="span12 datepicker" type="text" name="dtEmissao" value="<?php
                                                if ($result->dataEmissao == 0) {
                                                    echo '';
                                                } else {
                                                    echo date('d/m/Y', strtotime($result->dataEmissao));
                                                }
                                    ?>" required  />
                            </div>
                        </div>
                        <div class="span2">
                            <label for="situacao" class="control-label">Situacao:</label>
                            <select name="situacao"  class="span12" id="situacao">
                                <option value="0" <?= ($result->situacao == 30) ? 'selected' : '' ?>>Em aberto</option>
                                <option value="1" <?= ($result->situacao == 60) ? 'selected' : '' ?>>Em andamento</option>
                                <option value="2" <?= ($result->situacao == 90) ? 'selected' : '' ?>>Confirmado</option>
                                <option value="3" <?= ($result->situacao == 180) ? 'selected' : '' ?>>Cancelado</option>
                            </select>
                        </div>
                        <div class="span2">
                            <label for="nfe" class="control-label">Nº NF-e:</label>
                            <div class="control-group">
                                <input id="nfe" class="span12" type="text" name="nfe" value="<?=$result->nrNfe;?>"  />
                            </div>
                        </div>
                        
                        
                    <div class="span12" style=" margin-left: 0">
                                <div class="span12 well" style="padding: 1%; margin-left: 0">
                                    <form id="formProdutos" action="" method="post">
                                        <div class="span6 control-group">
                                            <input type="hidden" name="idProduto" id="idProduto" />
                                            <input type="hidden" name="idOsProduto" id="idCompraProduto" value="<?php echo $result->idCompra ?>" />
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
                                                echo '<td><a href="" idAcao="' . $p->idProduto_compras . '" prodAcao="' . $p->idProdutos . '" quantAcao="' . $p->quantidade . '" title="Excluir Produto" class="btn btn-danger"><i class="icon-remove icon-white"></i></a></td>';
                                                echo '</tr>';
                                            }
                                            ?>

                                            <tr>
                                                <td colspan="4" style="text-align: right"><strong>Total:</br>Desconto:</br>Subtotal:</strong></td>
                                                <td><strong>R$: <?php echo number_format($totalProduto, 2, ',', '.'); ?></br><p class="text-error" style="margin: 0 0 0px;">R$: -<?php echo number_format($descontoTotalProduto, 2, ',', '.'); ?></p><p class="text-success" style="margin: 0 0 0px;">R$: <?php echo number_format($subTotalProduto, 2, ',', '.'); ?></p><input type="hidden" id="total-venda" value="<?php echo number_format($subTotalProduto, 2); ?>"></strong></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                    
                    <div class="span12" style="padding: 1%; margin-left: 0">
                            <div class="span6">
                                <button type="submit" class="btn btn-success"><i class="icon-plus icon-white"></i> Adicionar</button>
                                <a href="<?php echo base_url() ?>index.php/financeiro/pagamentos" id="" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
                            </div>
                        </div>
                    

                    
                </form>
            </div>
            &nbsp;
         </div>
     </div>
</div>

<script src="<?php echo base_url()?>assets/js/jquery.validate.js"></script>
<script src="<?php echo base_url();?>assets/js/maskmoney.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".money").maskMoney();

        $('#formPagamento').validate({
            rules :{
                  dsPagamento: { required: true},
                  fornecedor: { required: true},
                  dtVencimento: { required: true},
                  valor: { required: true}
            },
            messages:{
                  dsPagamento: { required: 'Campo Requerido.'},
                  fornecedor: { required: 'Campo Requerido.'},
                  dtVencimento: { required: 'Campo Requerido.'},
                  valor: { required: 'Campo Requerido.'}
            },

            errorClass: "help-inline",
            errorElement: "span",
            highlight:function(element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            }
           });
           
           $("#fornecedor").autocomplete({
            source: "<?php echo base_url(); ?>index.php/fornecedores/autoCompleteFornecedor",
            minLength: 1,
            select: function (event, ui) {

                $("#fornecedor_id").val(ui.item.id);


            }
        });
           
           $(".datepicker" ).datepicker({ dateFormat: 'dd/mm/yy' });
           
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
                        url: "<?php echo base_url(); ?>index.php/compras/adicionarProduto",
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
    });
</script>



