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
                     <?php echo form_hidden('idSituacao',$result->idSituacao); ?>
                    <div class="control-group">
                        <label for="situacao" class="control-label">Nome<span class="required">*</span></label>
                        <div class="controls">
                            <input id="situacao" type="text" name="situacao" value="<?php echo $result->idSituacao; ?>"  />
                        </div>
                    </div>

                     <div class="control-group">
                        <label for="cor" class="control-label">Cor<span class="required">*</span></label>
                        <div class="controls">
                            <div data-color-format="hex" data-color="<?php echo $result->cor; ?>"  class="input-append color colorpicker">
                                <input  id="cor" name="cor" type="text" value="<?php echo $result->cor; ?>" class="span11">
                                <span class="add-on"><i style="background-color: #000000"></i></span> 
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                    <label for="ativo" class="control-label">Situação<span class="required">*</span></label>
                    <div class="controls">
                        <select id="ativo" name="ativo">
                            <option value="0" <?=($result->ativo == 0)?'selected':''?>>Ativo</option>
                            <option value="1" <?=($result->ativo == 1)?'selected':''?>>Inativo</option>
                        </select>                        
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
        
        $('.colorpicker').colorpicker();

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



