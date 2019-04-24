<link rel="stylesheet" href="<?php echo base_url();?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>
<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-align-justify"></i>
                </span>
                <h5>Cadastro de Contas a Pagar</h5>
            </div>
            <div class="widget-content nopadding">
               <?php
                if ($custom_error != '') {
                    echo '<div class="alert alert-danger">' . $custom_error . '</div>';
                }
                ?>
                <form action="<?php echo current_url(); ?>" id="formPagamento" method="post" >
                    <div class="span12" style="padding: 1%">
                        <div class="span6">
                            <label for="dsPagamento" class="control-label">Descrição do Pagamento:<span class="required">*</span></label>
                            <div class="control-group">
                            <input id="dsPagamento" class="span12" type="text" name="dsPagamento" value=""  />
                            </div>
                        </div>
                        <div class="span6">
                            <label for="fornecedor" class="control-label">Fornecedor:<span class="required">*</span></label>
                            <div class="control-group">
                            <input id="fornecedor" class="span12" type="text" name="fornecedor" value=""  />
                            <input id="fornecedor_id" class="span12" type="hidden" name="fornecedor_id" value=""  />
                            </div>
                        </div>
                    </div>
                    <div class="span12" style="padding: 1%; margin-left: 0">
                        <div class="span2">
                            <label for="dtVencimento" class="control-label">Data de Vencimento:<span class="required">*</span></label>
                            <div class="control-group">
                            <input id="dtVencimento" class="span12 datepicker" type="text" name="dtVencimento"  />
                        </div>
                        </div>
                        <div class="span2">
                            <label for="valor" class="control-label">Valor:<span class="required">*</span></label>
                            <div class="control-group">
                            <input id="valor" class="span12" type="text" name="valor" value=""  />
                        </div>
                        </div>
                        <div class="span2">
                            <label for="pago" class="control-label">Pagamento quitado:</label>
                            <select name="pago"  class="span12" id="baixado">
		    			<option value="0">Não</option>
		    			<option value="1">Sim</option>			
		    		</select>
                        </div>
                        <div class="span2">
                            <label for="dtPagamento" class="control-label">Data de Pagamento:</label>
                            <input id="dtPagamento" class="span12 datepicker" type="text" name="dtPagamento" disabled=""  />
                            
                        </div>
                        <div class="span3">
		    		<label for="formaPgto">Forma de Pagamento</label>
		    		<select name="formaPgto"  class="span12">
		    			<option value="Dinheiro">Dinheiro</option>
		    			<option value="Cartão de Crédito">Cartão de Crédito</option>
		    			<option value="Cheque">Cheque</option>
		    			<option value="Boleto">Boleto</option>
		    			<option value="Depósito">Depósito</option>
		    			<option value="Débito">Débito</option>  			
		    		</select>
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
           
           $("#baixado").change(function(){
               
               if($("#baixado").val() == '1'){
                   $("#dtPagamento").attr('disabled',false);
               }else{
                   $("#dtPagamento").attr('disabled',true);
                   $("#dtPagamento").val("");
               }
           });
    });
</script>



