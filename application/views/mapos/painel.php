<!-- [if lt IE 9]><script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>js/dist/excanvas.min.js"></script><![endif]-->

<link rel="stylesheet" type="text/css" href="<?= base_url('assets/js/dist/jquery.jqplot.min.css'); ?>" />



<!--Action boxes -->
<div class="container-fluid">
    <div class="quick-actions_homepage">
        <ul class="quick-actions">
            <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vCliente')) { ?>
                <li class="bg_lb">
                    <span class="label label-success"><?= $this->db->count_all('clientes') ?></span>
                    <a href="<?= site_url('clientes') ?>"> <i class="icon-group"></i> Clientes</a>
                </li>

            <?php } ?>
            <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vProduto')) { ?>
                <li class="bg_lg">
                    <span class="label label-success"><?= $this->db->count_all('produtos') ?></span>
                    <a href="<?= site_url('produtos') ?>"> <i class="icon-barcode"></i> Produtos</a>
                </li>
            <?php } ?>
            <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vServico')) { ?>
                <li class="bg_ly">
                    <span class="label label-success"><?= $this->db->count_all('servicos') ?></span>
                    <a href="<?= site_url('servicos') ?>"> <i class="icon-wrench"></i> Serviços</a> </li>
            <?php } ?>
            <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vOs')) { ?>
                <li class="bg_lo">
                    <span class="label label-success"><?= $this->db->count_all('os') ?></span>
                    <a href="<?= site_url('os') ?>"> <i class="icon-tags"></i> OS</a> </li>
            <?php } ?>
            <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vVenda')) { ?>
                <li class="bg_ls">
                    <span class="label label-success"><?= $this->db->count_all('vendas') ?></span>
                    <a href="<?= site_url('vendas') ?>"><i class="icon-shopping-cart"></i> Vendas</a></li>
            <?php } ?>        
            <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vLancamento')) { ?>
                <li class="bg_lh">
                    <span class="label label-success"><?= $this->db->count_all('lancamentos') ?></span>
                    <a href="<?= site_url('financeiro/lancamentos') ?>"><i class="icon icon-money"></i>Financeiro</a></li>
            <?php } ?>
        </ul>
    </div>
    <div class="quick-actions_homepage" style="text-align:left">
        <a class="btn btn-info" href="<?= site_url('clientes/adicionar') ?>">Novo Cliente</a>
        <a class="btn btn-success" href="<?= site_url('produtos/adicionar') ?>">Novo Produto</a>
        <a class="btn btn-warning" href="<?= site_url('servicos/adicionar') ?>">Novo Serviço</a>
        <a class="btn btn-danger" href="<?= site_url('os/adicionar') ?>">Nova OS</a>
        <a class="btn btn-primary" href="<?= site_url('vendas/adicionar') ?>">Nova Venda</a>

    </div>
</div>
<!--End-Action boxes-->



<div class="row-fluid" style="margin-top: 0">
    <div class="span12" style="margin-left: 0">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon"><i class="icon-signal"></i></span>
                <h5>Ordens de Serviço Em Aberto</h5>

            </div>
            <div class="widget-content nopadding" style="height: auto;">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>#Protocolo</th>
                            <th>Cliente</th>
                            <th>Data Inicial</th>
                            <th>Situação</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($ordens as $o) :
                            $dataInicial = date(('d/m/Y'), strtotime($o->dataInicial));
                            ?>
                            <tr>
                                <td><?= $o->idOs; ?></td>
                                <td><?= $o->nomeCliente; ?></td>
                                <td><?= $dataInicial; ?></td>
                                <td><span class="badge" style="background-color: #8A9B0F; border-color: #8A9B0F"><?= $o->status; ?></span></td>
                                <td>
                                    <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eOs')) {
                                        ?>
                                        <a href="<?php echo base_url('index.php/os/editar/') . $o->idOs; ?>" style="margin-right: 1%" class="btn btn-info tip-top" title="Editar Cliente"><i class="icon-pencil icon-white"></i></a>
                                    <?php }
                                    ?>
                                </td>
                            </tr> 
<?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="span12" style="margin-left: 0">
        <div class="widget-box">
            <div class="widget-title"><span class="icon"><i class="icon-signal"></i></span><h5>Ordens de Serviço Orçamento</h5></div>
            <div class="widget-content nopadding" style="height: auto;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#Protocolo</th>
                            <th>Cliente</th>
                            <th>Data Inicial</th>
                            <th>Situação</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($orcamento != null) {
                            foreach ($orcamento as $or) {
                                $dataInicial = date(('d/m/Y'), strtotime($or->dataInicial));
                                echo '<tr>';
                                echo '<td>' . $or->idOs . '</td>';
                                echo '<td>' . $or->nomeCliente . '</td>';
                                echo '<td>' . $dataInicial . '</td>';
                                echo '<td><span class="badge" style="background-color:#CDB380; border-color:#CDB380;">' . $or->status . '</span></td>';
                                echo '<td>';
                                if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eOs')) {
                                    echo '<a href="' . site_url('os/editar/' . $or->idOs) . '" class="btn btn-info"> <i class="icon-pencil" ></i> </a>  ';
                                }
                                echo '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="3">Nenhuma Ordem de serviço com orçamento.</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<div class="row-fluid" style="margin-top: 0">
    <div class="span6">
        <div class="widget-box">
            <div class="widget-title" ><span class="icon"><i class="icon-signal"></i></span><h5>Produtos Com Estoque Mínimo</h5></div>
            <div class="widget-content" style="height: auto;">
                <table class="table table-bordered data-table-estoque">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Produto</th>
                            <th>Preço de Venda</th>
                            <th>Estoque</th>
                            <th>Estoque Mínimo</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($produtos as $p) :
                            ?>
                            <tr>
                                <td><?= $p->idProdutos; ?></td>
                                <td><?= $p->descricao; ?></td>
                                <td><?= $p->precoVenda; ?></td>
                                <td><?= $p->estoque; ?></td>
                                <td><?= $p->estoqueMinimo; ?></td>
                                <td>
                                    <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eProduto')) {
                                        ?>
                                        <a href="<?php echo base_url('index.php/produtos/editar/') . $p->idProdutos; ?>" style="margin-right: 1%" class="btn btn-info tip-top" title="Editar Cliente"><i class="icon-pencil icon-white"></i></a>
                                    <?php }
                                    ?>
                                </td>
                            </tr> 
<?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="span6">
        <div class="widget-box">
            <div class="widget-title" ><span class="icon"><i class="icon-signal"></i></span><h5>Produtos em Estoque</h5></div>
            <div class="widget-content" style="height: auto;">
                <table class="table table-bordered data-table-estoque">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Produto</th>
                            <th>Preço de Venda</th>
                            <th>Estoque</th>
                            <th>Estoque Mínimo</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($produtosEstoque as $pe) :
                            ?>
                            <tr>
                                <td><?= $pe->idProdutos; ?></td>
                                <td><?= $pe->descricao; ?></td>
                                <td><?= $pe->precoVenda; ?></td>
                                <td><?= $pe->estoque; ?></td>
                                <td><?= $pe->estoqueMinimo; ?></td>
                                <td>
                                    <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eProduto')) {
                                        ?>
                                        <a href="<?php echo base_url('index.php/produtos/editar/') . $pe->idProdutos; ?>" style="margin-right: 1%" class="btn btn-info tip-top" title="Editar Cliente"><i class="icon-pencil icon-white"></i></a>
                                    <?php }
                                    ?>
                                </td>
                            </tr> 
<?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row-fluid" style="margin-top: 0;">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title"><span class="icon"><i class="icon-signal"></i></span><h5>Balanço Mensal: <?php echo date('Y') ?></h5></div>
            <div class="widget-content">
                <div class="row-fluid">
                    <div class="span12">
                        <div id="chart-vendas-mes1" style=""></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row-fluid" style="margin-top: 0;">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title"><span class="icon"><i class="icon-signal"></i></span><h5>Balanço Mensal: <?php echo date('Y') ?></h5></div>
            <div class="widget-content">
                <div class="row-fluid">
                    <div class="span12">
                        <div id="chart-vendas-mes" style=""></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if ($estatisticas_financeiro != null) {
    if ($estatisticas_financeiro->total_receita != null || $estatisticas_financeiro->total_despesa != null || $estatisticas_financeiro->total_receita_pendente != null || $estatisticas_financeiro->total_despesa_pendente != null) {
        ?>
        <div class="row-fluid" style="margin-top: 0">

            <div class="span4">

                <div class="widget-box">
                    <div class="widget-title"><span class="icon"><i class="icon-signal"></i></span><h5>Estatísticas financeiras - Realizado</h5></div>
                    <div class="widget-content">
                        <div class="row-fluid">
                            <div class="span12">
                                <div id="chart-financeiro" style=""></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="span4">

                <div class="widget-box">
                    <div class="widget-title"><span class="icon"><i class="icon-signal"></i></span><h5>Estatísticas financeiras - Pendente</h5></div>
                    <div class="widget-content">
                        <div class="row-fluid">
                            <div class="span12">
                                <div id="chart-financeiro2" style=""></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <div class="span4">

                <div class="widget-box">
                    <div class="widget-title"><span class="icon"><i class="icon-signal"></i></span><h5>Total em caixa / Previsto</h5></div>
                    <div class="widget-content">
                        <div class="row-fluid">
                            <div class="span12">
                                <div id="chart-financeiro-caixa" style=""></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <?php
    }
}
?>

<?php if ($os != null) { ?>
    <div class="row-fluid" style="margin-top: 0">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title"><span class="icon"><i class="icon-signal"></i></span><h5>Estatísticas de OS</h5></div>
                <div class="widget-content">
                    <div class="row-fluid">
                        <div class="span12">
                            <div id="chart-os" style=""></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('.data-table').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "sDom": '<""l>t<"F"fp>',
            "oLanguage": {
                "sUrl": "<?= base_url('assets/js/dataTables/Portuguese-Brasil.json'); ?>"
            }
        });
    });
    $(document).ready(function () {
        $('.data-table-estoque').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "sDom": '<""l>t<"F"fp>',
            "ordering": false,
            "searching": false,
            "lengthChange": false,
            "oLanguage": {
                "sUrl": "<?= base_url('assets/js/dataTables/Portuguese-Brasil.json'); ?>"
            }
        });
    });
</script>
<script language="javascript" type="text/javascript" src="<?= base_url('assets/js/dist/jquery.jqplot.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dist/plugins/jqplot.pieRenderer.min.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dist/plugins/jqplot.donutRenderer.min.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dist/plugins/jqplot.barRenderer.min.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dist/plugins/jqplot.pointLabels.min.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dist/plugins/jqplot.categoryAxisRenderer.min.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/jquery.dataTables110.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/highchart/highcharts.js') ?>"></script>


<script type="text/javascript">
    $(function () {
        var myChart = Highcharts.chart('chart-vendas-mes1', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Balanço Mensal'
            },
            xAxis: {
                categories: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro']
            },
            yAxis: {
                title: {
                    text: 'Reais',
                    format: 'R$: {value}'
                }
            },
            tooltip: {
                valueDecimals: 2,
                valuePrefix: 'R$: '
                
                
            },
            plotOptions: {
        series: {
            dataLabels: {
                enabled: true,
                format: 'R$: {y}',
                
                
            }
        }
    },
             credits: {
        enabled: false
    },
            series: [{
                    name: 'Valor',
                    negativeColor: '#FF0000',
                    data: [<?php echo ($vendas_mes->VALOR_JAN_REC - $vendas_mes->VALOR_JAN_DES); ?>,
<?php echo ($vendas_mes->VALOR_FEV_REC - $vendas_mes->VALOR_FEV_DES); ?>,
<?php echo ($vendas_mes->VALOR_MAR_REC - $vendas_mes->VALOR_MAR_DES); ?>,
<?php echo ($vendas_mes->VALOR_ABR_REC - $vendas_mes->VALOR_ABR_DES); ?>,
<?php echo ($vendas_mes->VALOR_MAI_REC - $vendas_mes->VALOR_MAI_DES); ?>,
<?php echo ($vendas_mes->VALOR_JUN_REC - $vendas_mes->VALOR_JUN_DES); ?>,
<?php echo ($vendas_mes->VALOR_JUL_REC - $vendas_mes->VALOR_JUL_DES); ?>,
<?php echo ($vendas_mes->VALOR_AGO_REC - $vendas_mes->VALOR_AGO_DES); ?>,
<?php echo ($vendas_mes->VALOR_SET_REC - $vendas_mes->VALOR_SET_DES); ?>,
<?php echo ($vendas_mes->VALOR_OUT_REC - $vendas_mes->VALOR_OUT_DES); ?>,
<?php echo ($vendas_mes->VALOR_NOV_REC - $vendas_mes->VALOR_NOV_DES); ?>,
<?php echo ($vendas_mes->VALOR_DEZ_REC - $vendas_mes->VALOR_DEZ_DES); ?>]
                }]
        });
    });

</script>

<script type="text/javascript">
    $(document).ready(function () {
        $.jqplot.config.enablePlugins = true;
        var s1 = [<?php echo ($vendas_mes->VALOR_JAN_REC - $vendas_mes->VALOR_JAN_DES); ?>,
<?php echo ($vendas_mes->VALOR_FEV_REC - $vendas_mes->VALOR_FEV_DES); ?>,
<?php echo ($vendas_mes->VALOR_MAR_REC - $vendas_mes->VALOR_MAR_DES); ?>,
<?php echo ($vendas_mes->VALOR_ABR_REC - $vendas_mes->VALOR_ABR_DES); ?>,
<?php echo ($vendas_mes->VALOR_MAI_REC - $vendas_mes->VALOR_MAI_DES); ?>,
<?php echo ($vendas_mes->VALOR_JUN_REC - $vendas_mes->VALOR_JUN_DES); ?>,
<?php echo ($vendas_mes->VALOR_JUL_REC - $vendas_mes->VALOR_JUL_DES); ?>,
<?php echo ($vendas_mes->VALOR_AGO_REC - $vendas_mes->VALOR_AGO_DES); ?>,
<?php echo ($vendas_mes->VALOR_SET_REC - $vendas_mes->VALOR_SET_DES); ?>,
<?php echo ($vendas_mes->VALOR_OUT_REC - $vendas_mes->VALOR_OUT_DES); ?>,
<?php echo ($vendas_mes->VALOR_NOV_REC - $vendas_mes->VALOR_NOV_DES); ?>,
<?php echo ($vendas_mes->VALOR_DEZ_REC - $vendas_mes->VALOR_DEZ_DES); ?>
        ];
        var ticks = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];

        var plot5 = $.jqplot('chart-vendas-mes', [s1], {
            // Only animate if we're not using excanvas (not in IE 7 or IE 8)..
            animate: !$.jqplot.use_excanvas,
            seriesDefaults: {
                renderer: $.jqplot.BarRenderer,
                rendererOptions: {fillToZero: true},
                pointLabels: {show: true}
            },
            axes: {
                xaxis: {
                    renderer: $.jqplot.CategoryAxisRenderer,
                    ticks: ticks
                },
                yaxis: {
                    tickOptions: {
                        formatString: "R$ %'.2f"
                    },
                    rendererOptions: {
                        forceTickAt0: true
                    }
                }

            },
            highlighter: {show: false}
        });

        $('#chart-vendas-mes').bind('jqplotDataClick',
                function (ev, seriesIndex, pointIndex, data) {
                    $('#info1').html('series: ' + seriesIndex + ', point: ' + pointIndex + ', data: ' + data);
                }
        );
    });
</script>



<?php if ($os != null) { ?>
    <script type="text/javascript">

        $(document).ready(function () {
            var data = [
    <?php
    foreach ($os as $o) {
        echo "['" . $o->status . "', " . $o->total . "],";
    }
    ?>

            ];
            var plot1 = jQuery.jqplot('chart-os', [data],
                    {
                        seriesDefaults: {
                            // Make this a pie chart.
                            renderer: jQuery.jqplot.PieRenderer,
                            rendererOptions: {
                                // Put data labels on the pie slices.
                                // By default, labels show the percentage of the slice.
                                showDataLabels: true
                            }
                        },
                        legend: {show: true, location: 'e'}
                    }
            );

        });

    </script>

<?php } ?>



<?php
if (isset($estatisticas_financeiro) && $estatisticas_financeiro != null) {
    if ($estatisticas_financeiro->total_receita != null || $estatisticas_financeiro->total_despesa != null || $estatisticas_financeiro->total_receita_pendente != null || $estatisticas_financeiro->total_despesa_pendente != null) {
        ?>
        <script type="text/javascript">

            $(document).ready(function () {

                var data2 = [['Total Receitas',<?php echo ($estatisticas_financeiro->total_receita != null ) ? $estatisticas_financeiro->total_receita : '0.00'; ?>], ['Total Despesas', <?php echo ($estatisticas_financeiro->total_despesa != null ) ? $estatisticas_financeiro->total_despesa : '0.00'; ?>]];
                var plot2 = jQuery.jqplot('chart-financeiro', [data2],
                        {

                            seriesColors: ["#9ACD32", "#FF8C00", "#EAA228", "#579575", "#839557", "#958c12", "#953579", "#4b5de4", "#d8b83f", "#ff5800", "#0085cc"],
                            seriesDefaults: {
                                // Make this a pie chart.
                                renderer: jQuery.jqplot.PieRenderer,
                                rendererOptions: {
                                    // Put data labels on the pie slices.
                                    // By default, labels show the percentage of the slice.
                                    dataLabels: 'value',
                                    showDataLabels: true
                                }
                            },
                            legend: {show: true, location: 'e'}
                        }
                );


                var data3 = [['Total Receitas',<?php echo ($estatisticas_financeiro->total_receita_pendente != null ) ? $estatisticas_financeiro->total_receita_pendente : '0.00'; ?>], ['Total Despesas', <?php echo ($estatisticas_financeiro->total_despesa_pendente != null ) ? $estatisticas_financeiro->total_despesa_pendente : '0.00'; ?>]];
                var plot3 = jQuery.jqplot('chart-financeiro2', [data3],
                        {

                            seriesColors: ["#90EE90", "#FF0000", "#EAA228", "#579575", "#839557", "#958c12", "#953579", "#4b5de4", "#d8b83f", "#ff5800", "#0085cc"],
                            seriesDefaults: {
                                // Make this a pie chart.
                                renderer: jQuery.jqplot.PieRenderer,
                                rendererOptions: {
                                    // Put data labels on the pie slices.
                                    // By default, labels show the percentage of the slice.
                                    dataLabels: 'value',
                                    showDataLabels: true
                                }
                            },
                            legend: {show: true, location: 'e'}
                        }

                );


                var data4 = [['Total em Caixa',<?php echo ($estatisticas_financeiro->total_receita - $estatisticas_financeiro->total_despesa); ?>], ['Total a Entrar', <?php echo ($estatisticas_financeiro->total_receita_pendente - $estatisticas_financeiro->total_despesa_pendente); ?>]];
                var plot4 = jQuery.jqplot('chart-financeiro-caixa', [data4],
                        {

                            seriesColors: ["#839557", "#d8b83f", "#d8b83f", "#ff5800", "#0085cc"],
                            seriesDefaults: {
                                // Make this a pie chart.
                                renderer: jQuery.jqplot.PieRenderer,
                                rendererOptions: {
                                    // Put data labels on the pie slices.
                                    // By default, labels show the percentage of the slice.
                                    dataLabels: 'value',
                                    showDataLabels: true
                                }
                            },
                            legend: {show: true, location: 'e'}
                        }

                );


            });

        </script>

        <?php
    }
}
?>
