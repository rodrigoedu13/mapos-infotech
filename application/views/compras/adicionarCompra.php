<link rel="stylesheet" href="<?php echo base_url();?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>
<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-align-justify"></i>
                </span>
                <h5>Adicionar compra</h5>
            </div>
            <div class="widget-content nopadding">
              <?php if ($custom_error == true) {
                  echo '<div class="alert alert-danger">' . $custom_error . '</div>';?>
                                    <!--<div class="span12 alert alert-danger" id="divInfo" style="padding: 1%;">Dados incompletos, verifique os campos com asterisco ou se selecionou corretamente o fornecedor.</div>-->
                                <?php } ?>
                <form action="<?php echo current_url(); ?>" id="formCompra" method="post" >
                    <div class="span12" style="padding: 1%">
                        <div class="span4">
                            <label for="fornecedor" class="control-label">Fornecedor:<span class="required">*</span></label>
                            <div class="control-group">
                                <input id="fornecedor" class="span12" type="text" name="fornecedor" value=""  />
                                <input id="fornecedor_id" class="span12" type="hidden" name="fornecedor_id" value=""  />
                            </div>
                        </div>
                        <div class="span2">
                            <label for="dtEmissao" class="control-label">Data de Emissão:<span class="required">*</span></label>
                            <div class="control-group">
                                <input id="dtEmissao" class="span12 datepicker" type="text" name="dtEmissao"  />
                            </div>
                        </div>
                        <div class="span2">
                            <label for="situacao" class="control-label">Situacao:</label>
                            <select name="situacao"  class="span12" id="situacao" disabled>
                                <option value="0">Em aberto</option>
                                <option value="1">Em andamento</option>	
                                <option value="2">Confirmado</option>	
                                <option value="3">Cancelado</option>	
                            </select>
                        </div>
                        <div class="span2">
                            <label for="nfe" class="control-label">Nº NF-e:</label>
                            <div class="control-group">
                                <input id="nfe" class="span12" type="text" name="nfe"  />
                            </div>
                        </div>
                    <div class="span12" style="margin-left: 0">
                            <div class="span6">
                                <button type="submit" class="btn btn-success"><i class="icon-share-alt icon-white"></i> Continuar</button>
                                <a href="<?php echo base_url() ?>index.php/compras" id="" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
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

        $('#formCompra').validate({
            rules :{
                  fornecedor: { required: true},
                  dtEmissao: { required: true}
            },
            messages:{
                  fornecedor: { required: 'Campo Requerido.'},
                  dtEmissao: { required: 'Campo Requerido.'}
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
           
    });
</script>



