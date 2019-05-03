<?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'aProduto')) { ?>
    <a href="<?php echo base_url(); ?>index.php/situacoes/adicionar" class="btn btn-success"><i class="icon-plus icon-white"></i> Adicionar Situação</a>
<?php } ?>

<?php if (!$results) { ?>
    <div class="widget-box">
        <div class="widget-title">
            <span class="icon">
                <i class="icon-barcode"></i>
            </span>
            <h5>Situações</h5>

        </div>

        <div class="widget-content nopadding">


            <table class="table table-bordered ">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Cor</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td colspan="5">Nenhuma Situação Cadastrada</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

<?php } else { ?>

    <div class="widget-box">
        <div class="widget-title">
            <span class="icon">
                <i class="icon-barcode"></i>
            </span>
            <h5>Situações</h5>

        </div>

        <div class="widget-content nopadding">


            <table class="table table-bordered data-table">
                <thead>
                    <tr style="backgroud-color: #2D335B">
                        <th>Nome</th>
                        <th>Cor</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results as $r) :
                        $dataCadastro = date(('d/m/Y'),strtotime($r->cadastro));
                        if ($r->situacao == 0){
                            $situacao = 'Ativo';
                        }elseif ($r->situacao == 1){
                            $situacao = 'Inativo';
                        }
                        ?>
                        <tr>
                            <td><?= $r->idMarcas; ?></td>
                            <td><?= $r->marca; ?></td>
                            <td><?= $dataCadastro; ?></td>
                            <td><?= $situacao; ?></td>
                            <td>
                                    <?php
                                if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eProduto')) {
                                    ?>
                                    <a href="<?php echo base_url('index.php/marcas/editar/') . $r->idMarcas; ?>" style="margin-right: 1%" class="btn btn-info tip-top" title="Editar Marca"><i class="icon-pencil icon-white"></i></a>
                                    <?php
                                }
                                if ($this->permission->checkPermission($this->session->userdata('permissao'), 'dProduto')) {
                                    ?>
                                    <a href="#modal-excluir" role="button" data-toggle="modal" marca="<?= $r->idMarcas; ?>" style="margin-right: 1%" class="btn btn-danger tip-top" title="Excluir Marca"><i class="icon-remove icon-white"></i></a>
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
    <form action="<?php echo base_url() ?>index.php/marcas/excluir" method="post" >
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h5 id="myModalLabel">Excluir Marca</h5>
        </div>
        <div class="modal-body">
            <input type="hidden" id="idMarcas" name="id" value="" />
            <h5 style="text-align: center">Deseja realmente excluir esta marca?</h5>
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

            var marca = $(this).attr('marca');
            $('#idMarcas').val(marca);

        });

    });

</script>