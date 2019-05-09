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
                        <th>Ativo</th>
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
                        <th>Ativo</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results as $r) :
                        if ($r->ativo == 0){
                            $ativo = 'Sim';
                        }else{
                            $ativo = 'Não';
                        }
                        ?>
                        <tr>
                            <td><?= $r->idSituacao; ?></td>
                            <td style="background-color: <?= $r->cor; ?>; width: 5%;"></td>
                            <td><?= $ativo; ?></td>
                            <td>
                                    <?php
                                if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eProduto')) {
                                    ?>
                                    <a href="<?php echo base_url('index.php/situacao/editar/') . $r->idSituacao; ?>" style="margin-right: 1%" class="btn btn-info tip-top" title="Editar Marca"><i class="icon-pencil icon-white"></i></a>
                                    <?php
                                }
                                if ($this->permission->checkPermission($this->session->userdata('permissao'), 'dProduto')) {
                                    ?>
                                    <a href="#modal-excluir" role="button" data-toggle="modal" situacao="<?= $r->idSituacao; ?>" style="margin-right: 1%" class="btn btn-danger tip-top" title="Excluir Marca"><i class="icon-remove icon-white"></i></a>
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
    <form action="<?php echo base_url() ?>index.php/situacoes/excluir" method="post" >
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h5 id="myModalLabel">Excluir Marca</h5>
        </div>
        <div class="modal-body">
            <input type="hidden" id="idSituacao" name="id" value="" />
            <h5 style="text-align: center">Deseja realmente excluir esta Situacao?</h5>
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

            var situacao = $(this).attr('situacao');
            $('#idSituacao').val(situacao);

        });

    });

</script>