<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>
<script>


        $(function() {
            $('#marcas').change(function(){
                $('#modelos').attr('disabled','disabled');
                $('#modelos').html("<option>Carregando...</option>");
                var id_marcas = $('#marcas').val();
            $.post("<?php echo base_url(); ?>index.php/os/buscaModelosbyMarcas", {
                id_marcas: id_marcas
            }, function (data) {
                //console.log(data);
                 $('#modelos').html(data);
                 $('#modelos').removeAttr('disabled')
            });
        });
        });

</script>
<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-tags"></i>
                </span>
                <h5>Cadastro de OS</h5>
            </div>
            <div class="widget-content nopadding">


                <div class="span12" id="divProdutosServicos" style=" margin-left: 0">
                    <ul class="nav nav-tabs">
                        <li class="active" id="tabDetalhes"><a href="#tab1" data-toggle="tab"><i class="icon-list-alt"></i> Detalhes da OS</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1">

                            <div class="span12" id="divCadastrarOs">
                                <?php if ($custom_error == true) { ?>
                                    <div class="span12 alert alert-danger" id="divInfo" style="padding: 1%;">Dados incompletos, verifique os campos com asterisco ou se selecionou corretamente cliente e responsável.</div>
                                <?php } ?>
                                <form action="<?php echo current_url(); ?>" method="post" autocomplete="off" id="formOs">

                                    <div class="span12" style="padding: 1%">
                                        <div class="span6">
                                            <label for="cliente" class="control-label">Cliente<span class="required">*</span></label>
                                            <input id="cliente" class="span12" type="text" name="cliente" value=""  />
                                            <input id="clientes_id" class="span12" type="hidden" name="clientes_id" value=""  />
                                        </div>
                                        <div class="span6">
                                            <label for="tecnico" class="control-label">Técnico / Responsável<span class="required">*</span></label>
                                            <input id="tecnico" class="span12" type="text" name="tecnico" value=""  />
                                            <input id="usuarios_id" class="span12" type="hidden" name="usuarios_id" value=""  />
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    <div class="span12" style="padding: 1%; margin-left: 0">
                                        <div class="span3" >
                                            <label for="status">Situação<span class="required">*</span></label>
                                            <?php 
                                            $js = array(
                                                'class' => 'span12'
                                            );
                                            $options = array('0' => 'Selecione a situação') + $situacao;
                                            echo form_dropdown($name = 'status', $options,'',$js); ?>
                                        </div>
<!--                                        <div class="span3">
                                            <label for="status">Status<span class="required">*</span></label>
                                            <select class="span12" name="status" id="status" value="">
                                                <option value="Orçamento">Orçamento</option>
                                                <option value="Aberto">Aberto</option>
                                                <option value="Em Andamento">Em Andamento</option>
                                                <option value="Finalizado">Finalizado</option>
                                                <option value="Cancelado">Cancelado</option>
                                            </select>
                                        </div>-->
                                        <div class="span3">
                                            <label for="dataInicial">Data Inicial<span class="required">*</span></label>
                                            <input id="dataInicial" class="span12 datepicker" type="text" name="dataInicial" value="<?php echo date('d/m/Y'); ?>"  />
                                        </div>
                                        <div class="span3">
                                            <label for="dataFinal">Data Final</label>
                                            <input id="dataFinal" class="span12 datepicker" type="text" name="dataFinal"/>
                                        </div>

                                        <div class="span3">
                                            <label for="garantia">Garantia</label>
                                            <select class="span12" name="garantia" id="garantia" value="">
                                                <option value="" selected>Selecione</option>
                                                <option value="30">30 Dias</option>
                                                <option value="60">60 Dias</option>
                                                <option value="90">90 Dias</option>
                                                <option value="180">6 meses</option>
                                                <option value="360">1 ano</option>
                                            </select>
                                        </div>
                                    </div>
                            </div>

                            <div class="span12" style="padding: 1%; margin-left: 0">

                                <div class="span3">
                                    <label for="Equipamento">Equipamento<span class="required">*</span></label>
                                    <?php 
                                    $js = array(
                                            'class' => 'span12'
                                        );
                                    $options = array ('0' => 'Selecione o equipamento') + $equipamentos;
                                    echo form_dropdown($name = 'equipamento', $options,'',$js); ?>
                                </div>
                                <div class="span3">
                                    <label for="Marca">Marca<span class="required">*</span></label>
                                    <div >
                                        <?php
                                        $js = array(
                                            'id' => 'marcas',
                                            'class' => 'span12'
                                        );
                                        $options = array ('0' => 'Selecione uma Marca') + $marcas;
                                        echo form_dropdown('marca', $options, 0, $js);
                                        ?>
                                    </div>
                                </div>
                                <div class="span3">
                                    <label for="modelo">Modelo<span class="required">*</span></label>
                                    <select name="modelo" id="modelos" disabled>
                                        <option>Selecione a Marca</option>
                                    </select>
                                </div>
                                <div class="span3">
                                    <label for="serie">Nº Serie</label>
                                    <input id="serie" type="text" class="span12" name="serie" />
                                </div>


                            </div>

                            <div class="span12" style="padding: 1%; margin-left: 0">

                                <div class="span6">
                                    <label for="descricaoProduto">Descrição Produto/Serviço</label>
                                    <textarea class="span12" name="descricaoProduto" id="descricaoProduto" cols="30" rows="5"></textarea>
                                </div>
                                <div class="span6">
                                    <label for="defeito">Defeito</label>
                                    <textarea class="span12" name="defeito" id="defeito" cols="30" rows="5"></textarea>
                                </div>

                            </div>
                            <div class="span12" style="padding: 1%; margin-left: 0">
                                <div class="span6">
                                    <label for="observacoes">Observações</label>
                                    <textarea class="span12" name="observacoes" id="observacoes" cols="30" rows="5"></textarea>
                                </div>
                                <div class="span6">
                                    <label for="laudoTecnico">Laudo Técnico</label>
                                    <textarea class="span12" name="laudoTecnico" id="laudoTecnico" cols="30" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="span12" style="padding: 1%; margin-left: 0">
                                <div class="span6 offset3" style="text-align: center">
                                    <button class="btn btn-success" id="btnContinuar"><i class="icon-share-alt icon-white"></i> Continuar</button>
                                    <a href="<?php echo base_url() ?>index.php/os" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
                                </div>
                            </div>
                            </form>
                        </div>

                    </div>

                </div>

            </div>


            .

        </div>

    </div>
</div>
</div>



<script type="text/javascript">
    $(document).ready(function () {

        


        $("#cliente").autocomplete({
            source: "<?php echo base_url(); ?>index.php/os/autoCompleteCliente",
            minLength: 1,
            select: function (event, ui) {

                $("#clientes_id").val(ui.item.id);


            }
        });

        $("#tecnico").autocomplete({
            source: "<?php echo base_url(); ?>index.php/os/autoCompleteUsuario",
            minLength: 1,
            select: function (event, ui) {

                $("#usuarios_id").val(ui.item.id);


            }
        });




        $("#formOs").validate({
            rules: {
                cliente: {required: true},
                tecnico: {required: true},
                dataInicial: {required: true}
            },
            messages: {
                cliente: {required: 'Campo Requerido.'},
                tecnico: {required: 'Campo Requerido.'},
                dataInicial: {required: 'Campo Requerido.'}
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

        $(".datepicker").datepicker({dateFormat: 'dd/mm/yy'});

    });

</script>

