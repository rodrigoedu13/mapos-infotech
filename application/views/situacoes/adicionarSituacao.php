<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-align-justify"></i>
                </span>
                <h5>Cadastro de Situação</h5>
            </div>
            <div class="widget-content nopadding">
               <?php
                if ($custom_error != '') {
                    echo '<div class="alert alert-danger">' . $custom_error . '</div>';
                }
                ?>
                <form action="<?php echo current_url(); ?>" id="formMarca" method="post" class="form-horizontal" >
                     <div class="control-group">
                        <label for="situacao" class="control-label">Nome<span class="required">*</span></label>
                        <div class="controls">
                            <input id="situacao" type="text" name="situacao" value="<?php echo set_value('situacao'); ?>"  />
                        </div>
                    </div>

                     <div class="control-group">
                        <label for="cor" class="control-label">Cor<span class="required">*</span></label>
                        <div class="controls">
                            <div data-color-format="hex" data-color="#000000"  class="input-append color colorpicker">
                                <input  id="cor" type="text" value="#000000" class="span11">
                                <span class="add-on"><i style="background-color: #000000"></i></span> 
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="span12">
                            <div class="span6 offset3">
                                <button type="submit" class="btn btn-success"><i class="icon-plus icon-white"></i> Adicionar</button>
                                <a href="<?php echo base_url() ?>index.php/situacoes" id="" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
                            </div>
                        </div>
                    </div>

                    
                </form>
            </div>

         </div>
     </div>
</div>

<script src="<?php echo base_url();?>assets/js/jquery.validate.js"></script>
<script src="<?php echo base_url();?>assets/js/maskmoney.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap-colorpicker.js"></script>


<script type="text/javascript">
    $(document).ready(function(){
        $(".money").maskMoney();

        $('#formMarca').validate({
            rules :{
                  situacao: { required: true},
                  cor: { required: true}
            },
            messages:{
                  situacao: { required: 'Campo Requerido.'},
                  cor: { required: 'Campo Requerido.'}
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
    });
</script>



