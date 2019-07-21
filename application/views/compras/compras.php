<?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'aCliente')) { ?>
    <a href="<?php echo base_url(); ?>index.php/compras/adicionar" class="btn btn-success"><i class="icon-plus icon-white"></i> Nova Compra</a>    
<?php } ?>

<?php if (!$results) { ?>

    <div class="widget-box">
        <div class="widget-title">
            <span class="icon">
                <i class="icon-briefcase"></i>
            </span>
            <h5>Compras</h5>

        </div>

        <div class="widget-content nopadding">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Cod. Compras</th>
                        <th>Fornecedor</th>
                        <th>Data de emissão</th>
                        <th>Situação</th>
                        <th>Valor</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="5">Nenhuma Compra Cadastrada</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

<?php } else {
    ?>
    <div class="widget-box">
        <div class="widget-title">
            <span class="icon">
                <i class="icon-user"></i>
            </span>
            <h5>Compras</h5>

        </div>

        <div class="widget-content nopadding">


            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                        <th>Cod. Compras</th>
                        <th>Fornecedor</th>
                        <th>Data de emissão</th>
                        <th>Situação</th>
                        <th>Valor</th>
                        <th></th>
                    </tr>
                </thead>   
                <tbody>
                    <?php foreach ($results as $r) :
                        $dataEmissao = date(('d/m/Y'), strtotime($r->dataEmissao));
                        if ($r->dataEmissao != 0) {
                                $dataEmissao = date(('d/m/Y'), strtotime($r->dataEmissao));
                            } else {
                                $dataEmissao = "";
                            }
                            ?>
                        <tr>
                            <td><?= $r->idCompra; ?></td>
                            <td><?= $r->nomeFornecedor; ?></td>
                            <td><?= $dataEmissao; ?></td>
                            <td><?= $r->situacao; ?></td>
                            <td><?= 'R$:';$r->valorTotal; ?></td>
                            <td>
                                <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vCliente')) { ?>
                                <a href="<?php echo base_url('index.php/compras/visualizar/').$r->idCompra; ?> " style="margin-right: 1%" class="btn tip-top" title="Ver mais detalhes"><i class="icon-eye-open"></i></a>
                                    <?php
                                }
                                if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente')) {
                                    ?>
                                    <a href="<?php echo base_url('index.php/compras/editar/').$r->idCompra; ?>" style="margin-right: 1%" class="btn btn-info tip-top" title="Editar Cliente"><i class="icon-pencil icon-white"></i></a>
                                    <?php
                                }
                                if ($this->permission->checkPermission($this->session->userdata('permissao'), 'dCliente')) {
                                    ?>
                                    <a href="#modal-excluir" role="button" data-toggle="modal" compra="<?= $r->idCompra; ?>" style="margin-right: 1%" class="btn btn-danger tip-top" title="Excluir Cliente"><i class="icon-remove icon-white"></i></a>
                                <?php } ?>
                            </td>
                        </tr> 
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php } ?>




<!-- Modal -->
<div id="modal-excluir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form action="<?php echo base_url() ?>index.php/compras/excluir" method="post" >
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h5 id="myModalLabel">Excluir Comprae</h5>
        </div>
        <div class="modal-body">
            <input type="hidden" id="idCompra" name="id" value="" />
            <h5 style="text-align: center">Deseja realmente excluir esta compra?</h5>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
            <button class="btn btn-danger">Excluir</button>
        </div>
    </form>
</div>




<script type="text/javascript">
    $(document).ready(function () {
        $('.data-table').dataTable({
		"bJQueryUI": true,
		"sPaginationType": "full_numbers",
		"sDom": '<""l>t<"F"fp>',
                "order": [[ 0, "desc" ]],
                "oLanguage": {
                "sUrl": "<?= base_url('assets/js/dataTables/Portuguese-Brasil.json'); ?>"
                    }
                
	});
    });
</script>
<script type="text/javascript" src="<?= base_url('assets/js/jquery.dataTables110.min.js'); ?>"></script>


<script type="text/javascript">
    $(document).ready(function () {


        $(document).on('click', 'a', function (event) {

            var compra = $(this).attr('compra');
            $('#idCompra').val(compra);

        });

    });

</script>
