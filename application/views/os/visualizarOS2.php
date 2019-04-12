<?php $totalServico = 0;
$totalProdutos = 0;
?>
<?php $operador = $this->session->userdata('nome'); ?>
<?php
$color = "default";
$status = $result->status;

if ($status == "Orçamento") {
    $color = "inverse";
} else if ($status == "Aprovado") {
    $color = "success";
} else if ($status == "Em Andamento") {
    $color = "info";
} else if ($status == "Finalizado") {
    $color = "info";
} else if ($status == "Faturado") {
    $color = "success";
} else if ($status == "Aguardando Peça") {
    $color = "warning";
} else if ($status == "Aguardando Cliente") {
    $color = "default";
} else if ($status == "Cancelado") {
    $color = "important";
} else if ($status == "Aberto") {
    $color = "success";
} else {
    $color = "default";
}
?>
<input id="sendOsId" type="hidden" name="sendOsId" value="<?php echo $result->idOs ?>"  />
<input id="sendEmailCliente" type="hidden" name="sendEmailCliente" value="<?php echo $result->email ?>"  />
<input id="sendNomeCliente" type="hidden" name="sendNomeCliente" value="<?php echo $result->nomeCliente ?>"  />
<input id="urlAtual" type="hidden" name="urlAtual" value="<?php echo current_url() ?>"  />

<div class="row-fluid" style="margin-top: 0">
    <div class="span12">
        <div class="widget-box">

            <div class="widget-title">
                <span class=<?php echo '"icon label label-' . $color . '"' ?> style="padding-bottom: 13px; margin-top: 0;"><?php echo $status ?></span>
                <h5>Ordem de Serviço</h5>
                <div class="buttons">
                    <?php
                    if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eOs')) {
                        echo '<a title="Icon Title" class="btn btn-mini btn-info" href="' . base_url() . 'index.php/os/editar/' . $result->idOs . '"><i class="icon-pencil icon-white"></i> Editar</a>';
                    }
                    ?>
                    <a id="imprimir2" title="Imprimir" class="btn btn-mini btn-inverse" href=""><i class="icon-print icon-white"></i> Imprimir</a>
                </div>
            </div>


            <div class="widget-content" id="printOs2">
                <!-- OS PRINT - FRENTE -->
                <page size="A4">
                    <!-- via loja -->
                    <page size="A2" id="osLoja">
                        <div class="invoice-content">
                            <div class="invoice-head" style="margin-bottom: 0">
                                <table class="table table-bordered" style="margin-bottom: 10px;">
                                    <tbody>
                                        <tr>
                                            <td style="width: 15%; font-size: 18px; text-align: center; vertical-align: middle;">#<?php echo $result->idOs ?></td>
                                            <td style="width: 30%; font-size: 18px; text-align: center; vertical-align: middle; padding: 2px;"><span class="linkCliente" style="cursor: pointer;"><?php echo $result->nomeCliente ?></span> - <?php
                                                if ($result->celular != "") {
                                                    echo $result->celular;
                                                } else {
                                                    echo $result->telefone;
                                                }
                                                ?></td>
                                            <td style="width: 25%; font-size: 18px; text-align: center; vertical-align: middle; padding: 2px;">Entrada <?php echo date('d/m/Y', strtotime($result->dataInicial)); ?> - Previsão <?php
                                                if ($result->dataFinal == 0) {
                                                    echo '';
                                                } else {
                                                    echo date('d/m/Y', strtotime($result->dataFinal));
                                                }
                                                ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="table" style="margin-bottom: 0">
                                    <tbody>
<?php if ($emitente == null) { ?>        
                                            <tr>
                                                <td colspan="3" class="alert">Você precisa configurar os dados do emitente. >>><a href="<?php echo base_url(); ?>index.php/mapos/emitente">Configurar</a><<<</td>
                                            </tr>
                                                    <?php } else { ?>
                                            <tr>
                                                <td style="width: 100px; padding: 8px;"><img src=" <?php echo $emitente[0]->url_logo; ?> "></td>
                                                <td style="line-height: 17px;"> <span style="font-size: 24px; "> <?php echo $emitente[0]->nome; ?></span> </br><span style="font-size: 12px;"><?php echo $emitente[0]->rua . ', ' . $emitente[0]->numero . ', ' . $emitente[0]->bairro . ' - ' . $emitente[0]->cidade . ' - ' . $emitente[0]->uf; ?> </br> <?php
                                                    if ($emitente[0]->telefone != "") {
                                                        echo "Fone: ";
                                                        echo $emitente[0]->telefone;
                                                    }
                                                    ?></br> E-mail: <?php echo $emitente[0]->email; ?> </span></td>
                                                <td style="width: 18%; text-align: center"><span style="font-size: 16px">#Nº OS: <?php echo $result->idOs ?></span></br><span style="font-size: 14px">Emissão: <?php echo date('d/m/Y') ?></span><?php
                                                    if ($result->garantia == 'selecione') {
                                                        echo '';
                                                    } else
                                                        echo "</br><span style='font-size: 14px'>Garantia: " . $result->garantia . "</span>"
                                                        ?></td>
                                            </tr>
                                            <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                            <hr style="margin-top: 0; margin-bottom: 10px;">
                            <table class="table table-bordered" >
                                <tr>
                                    <th style="font-size: 16px;">Equipamento</th>
                                    <td><span style="font-size: 14px;">
<?php
if ($result->equipamento == 'selecione') {
    echo '';
} else
    echo $result->equipamento
    ?> 
                                <?php
                                if ($result->marca == 'selecione') {
                                    echo '';
                                } else
                                    echo $result->marca
                                    ?> 
                                            - <?php echo $result->modelos ?> 
                                            - Nro. Série: <?php echo $result->nr_serie ?>
                                        </span></td>
                                </tr>
                            </table>

                            <table class="table">
<?php if ($result->defeito != null) { ?>
                                    <hr style="margin: 0">
                                    <span style="font-size: 12px;"><strong>Defeito relatado:</strong> <?php echo $result->defeito ?></span>
<?php } ?>

                            <?php if ($result->descricaoProduto != null) { ?>
                                    <hr style="margin: 0">
                                    <span style="font-size: 12px;"><strong>Descrição do serviço:</strong> <?php echo $result->descricaoProduto ?></span>
<?php } ?>

<?php if ($result->laudoTecnico != null) { ?>
                                    <hr style="margin: 0">
                                    <span style="font-size: 12px;"><strong>Laudo Técnico:</strong> <?php echo $result->laudoTecnico ?></span>
<?php } ?>

<?php if ($result->observacoes != null) { ?>
                                    <hr style="margin: 0">
                                    <span style="font-size: 12px;"><strong>Observações:</strong> <?php echo $result->observacoes ?></span>
<?php } ?>
                                <hr style="margin: 0">
                            </table>

                                    <?php if ($produtos != null) { ?>
                                <br />
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 3%;">#</th>
                                            <th style="text-align: left; font-size:12px;">Descrição do Produto</th>
                                            <th style="width: 5%; text-align: right;">Quantidade</th>
                                            <th style="width: 10%; text-align: right;">Valor do Produto</th>
                                            <th style="width: 10%; text-align: right;">Desconto</th>
                                            <th style="width: 10%; text-align: right;">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $totalProduto = 0;
                                        $descontoTotalProduto = 0;
                                        $precoVendaProduto = 0;
                                        $subTotalProduto = 0;
                                        $count = 0;
                                        foreach ($produtos as $p) {

                                            $count += 1;
                                            $descontoTotalProduto += $p->desconto;
                                            $precoVendaProduto += $p->precoVenda * $p->quantidade;
                                            $totalProduto += $p->subTotal;
                                            $subTotalProduto += $p->subTotal - $p->desconto;
                                            $subTotalProdutoItem = $p->subTotal - $p->desconto;
                                            echo '<tr>';
                                            echo '<td>' . $count . '</td>';
                                            echo '<td><i class="icon-caret-right"></i> &nbsp' . $p->descricao . '</td>';
                                            echo '<td style="text-align: right;">' . $p->quantidade . '</td>';
                                            echo '<td style="text-align: right;">R$: ' . number_format($p->precoVenda, 2, ',', '.') . '</td>';
                                            echo '<td style="text-align: right;">R$: ' . number_format($p->desconto, 2, ',', '.') . '</td>';
                                            echo '<td style="text-align: right;">R$: ' . number_format($subTotalProdutoItem, 2, ',', '.') . '</td>';
                                            echo '</tr>';
                                        }
                                        ?>

                                        <tr>
                                            <td colspan="5" style="text-align: right"><span style="font-size: 12px;"><strong>Total:</strong></span></td>
                                            <td style="font-size: 12px; text-align: right;"><span><strong>R$ <?php echo number_format($subTotalProduto, 2, ',', '.'); ?></strong></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                                    <?php } ?>

                                    <?php if ($servicos != null) { ?>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 3%;">#</th>
                                            <th  style="text-align: left; font-size:12px;">Descrição do Serviço</th>
                                            <th style="width: 10%; text-align: right;">Valor do serviço</th>
                                            <th style="width: 10%; text-align: right;">Desconto</th>
                                            <th style="width: 10%; text-align: right;">Subtotal</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $total = 0;
                                        $descontoTotalServico = 0;
                                        $subTotalServico = 0;
                                        $count = 0;
                                        foreach ($servicos as $s) {
                                            $count += 1;
                                            $descontoTotalServico += $s->desconto;
                                            $preco = $s->subTotal;
                                            $total = $total + $preco;
                                            $subTotalServico += $s->subTotal - $s->desconto;
                                            $subTotalServicoItem = $s->subTotal - $s->desconto;
                                            echo '<tr>';
                                            echo '<td>' . $count . '</td>';
                                            echo '<td><i class="icon-caret-right"></i> &nbsp' . $s->nome . '</td>';
                                            echo '<td style="text-align: right;">R$ ' . number_format($s->subTotal, 2, ',', '.') . '</td>';
                                            echo '<td style="text-align: right;">R$ ' . number_format($s->desconto, 2, ',', '.') . '</td>';
                                            echo '<td style="text-align: right;">R$ ' . number_format($subTotalServicoItem, 2, ',', '.') . '</td>';
                                            echo '</tr>';
                                        }
                                        ?>

                                        <tr>

                                        <tr>
                                            <td colspan="4" style="text-align: right"><span style="font-size: 12px;"><strong>Total:</strong></span></td>
                                            <td style="font-size: 12px; text-align: right;"><span><strong>R$ <?php echo number_format($subTotalServico, 2, ',', '.'); ?></strong></span></td>
                                        </tr>
                                    </tbody>
                                </table>
<?php } ?>
                            <table class="table table-bordered" style="margin-bottom: 0;">
                                
                                <tr>
                                    <td colspan="4" style="text-align: right;"><span style="font-size: 16px;"><strong>Total da O.S:</strong></span></td>
                                    <td style="font-size: 16px; text-align: right; width: 10%;"><span><strong>R$ <?php echo number_format($subTotalServico+$subTotalProduto, 2, ',', '.'); ?></strong></span></td>
                                </tr>
                               
                            </table>

                            <table class="table" style="margin-bottom: 0;">
                                <br>
                                <tr>
                                    <td style="width: 50%; padding: 0 5px 0 0; text-align: center; border-top: 0;">
                                        <hr style="border-width: 2px; margin-bottom: 5px;">
                                        <span style="font-size: 10px;"><strong><?php echo $result->nome ?></strong></span>
                                    </td>
                                    <td style="width: 50%; padding: 0 0 0 5px; text-align: center; border-top: 0;">
                                        <hr style="border-width: 2px; margin-bottom: 5px;">
                                        <span style="font-size: 10px;"><strong><?php echo $result->nomeCliente ?></strong></span>
                                    </td>
                                </tr>
                            </table>
                            <div>
                                <p style="font-size: 10px; line-height: 12px;"><small><b>Obs:</b>&nbsp;PAGAMENTO: Somente em dinheiro. ORÇAMENTO: Em caso de desistência após a realização do diagnóstico será cobrado a taxa de R$ 50,00. CUSTÓDIA: Na ausência de comunicação por um prazo superior à 30 dias os equipamentos serão enviados para nosso depósito sendo necessário agendar data para a retirada dos mesmos.</small></p>
                            </div>
                        </div><!-- invoice-content -->
                    </page>

                    <!-- via cliente -->

                </page>
            </div><!-- widget-content - printOs2 end-->

        </div><!-- class="widget-box" -->
    </div><!-- class="span12" -->
</div><!-- class="row-fluid" -->

<script type="text/javascript">
    $(document).ready(function () {

        $("#imprimir").click(function (e) {
            e.preventDefault();
            PrintElem('#printOs');
        })
        $("#imprimir2").click(function (e) {
            e.preventDefault();
            PrintElem('#printOs2');
        })

        function PrintElem(elem)
        {
            var html = $(elem).html();
            setTimeout(Popup, 100, html);
        }

        function Popup(data)
        {
            var mywindow = window.open('', '<?php echo $emitente[0]->nome; ?>', 'height=600,width=800');
            mywindow.document.write('<html><head><title><?php echo $emitente[0]->nome; ?> - OS: #<?php echo $result->idOs ?> </title>');
            mywindow.document.write("<link rel='stylesheet' href='<?php echo base_url(); ?>assets/css/bootstrap.min.css' />");
            mywindow.document.write("<link rel='stylesheet' href='<?php echo base_url(); ?>assets/css/bootstrap-responsive.min.css' />");
            mywindow.document.write("<link rel='stylesheet' href='<?php echo base_url(); ?>assets/css/matrix-style.css' />");
            mywindow.document.write("<link rel='stylesheet' href='<?php echo base_url(); ?>assets/css/matrix-media.css' />");
            mywindow.document.write("<link rel='stylesheet' href='<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css' />");
            mywindow.document.write("<link rel='stylesheet' href='<?php echo base_url(); ?>assets/css/ui-print.css' media='print' />");
            mywindow.document.write("</head><body style='background-color: white;'>");
            mywindow.document.write(data);
            mywindow.document.write("</body></html>");
            setTimeout(delayPrint, 1000, mywindow);
        }

        function delayPrint(mywindow) {
            mywindow.print();
            mywindow.close();
            return true;
        }

    });
</script>