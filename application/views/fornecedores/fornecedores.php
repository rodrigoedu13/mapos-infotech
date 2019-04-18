<?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'aCliente')) { ?>
    <a href="<?php echo base_url(); ?>index.php/fornecedores/adicionar" class="btn btn-success"><i class="icon-plus icon-white"></i> Adicionar Fornecedor</a>    
<?php } ?>

<?php if (!$results) { ?>

    <div class="widget-box">
        <div class="widget-title">
            <span class="icon">
                <i class="icon-user"></i>
            </span>
            <h5>Fornecedores</h5>

        </div>

        <div class="widget-content nopadding">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome Fantasia</th>
                        <th>CNPJ</th>
                        <th>Telefone</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="5">Nenhum Fornecedor Cadastrado</td>
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
            <h5>Clientes</h5>

        </div>

        <div class="widget-content nopadding">


            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>CNPJ</th>
                        <th>Telefone</th>
                        <th></th>
                    </tr>
                </thead>   
                <tbody>
                    <?php foreach ($results as $r) :
                        ?>
                        <tr>
                            <td><?= $r->idFornecedor; ?></td>
                            <td><?= $r->nomeFornecedor; ?></td>
                            <td><?= $r->cnpj; ?></td>
                            <td><?= $r->telefone; ?></td>
                            <td>
                                <?php 
                                if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente')) {
                                    ?>
                                    <a href="<?php echo base_url('index.php/fornecedores/editar/').$r->idFornecedor; ?>" style="margin-right: 1%" class="btn btn-info tip-top" title="Editar Cliente"><i class="icon-pencil icon-white"></i></a>
                                    <?php
                                }
                                if ($this->permission->checkPermission($this->session->userdata('permissao'), 'dCliente')) {
                                    ?>
                                    <a href="#modal-excluir" role="button" data-toggle="modal" fornecedor="<?= $r->idFornecedor; ?>" style="margin-right: 1%" class="btn btn-danger tip-top" title="Excluir Cliente"><i class="icon-remove icon-white"></i></a>
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
    <form action="<?php echo base_url() ?>index.php/fornecedores/excluir" method="post" >
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h5 id="myModalLabel">Excluir Cliente</h5>
        </div>
        <div class="modal-body">
            <input type="hidden" id="idFornecedor" name="id" value="" />
            <h5 style="text-align: center">Deseja realmente excluir este fornecedor?</h5>
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

            var cliente = $(this).attr('fornecedor');
            $('#idFornecedor').val(cliente);

        });

    });

</script>
