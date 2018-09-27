<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-user"></i>
                </span>
                <h5>Cadastro de Cliente</h5>
            </div>
            <div class="widget-content nopadding">
                <?php
                if ($custom_error != '') {
                    echo '<div class="alert alert-danger">' . $custom_error . '</div>';
                }
                ?>
                <form action="<?php echo current_url(); ?>" id="formCliente" method="post" class="form-horizontal" >
                    <div class="widget-box">
                        <div class="widget-title">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#tab1">Dados Pessoais</a></li>
                                <li><a data-toggle="tab" href="#tab2">Endereço</a></li>
                            </ul>
                        </div>
                        <div class="widget-content tab-content">
                            <div id="tab1" class="tab-pane active">
                                <div class="control-group">
                                    <label for="nomeCliente" class="control-label">Nome:<span class="required">*</span></label>
                                    <div class="controls">
                                        <input id="nomeCliente" class="span4" type="text" name="nomeCliente" autocomplete="off" value="<?php echo set_value('nomeCliente'); ?>"  />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="documento" class="control-label">CPF:</label>
                                    <div class="controls">
                                        <input id="documento" type="text" name="documento" data-mask="000.000.000-00" autocomplete="off" value="<?php echo set_value('documento'); ?>"  />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="telefone" class="control-label">Telefone:</label>
                                    <div class="controls">
                                        <input id="telefone" type="text" name="telefone" data-mask="(00)0000-0000" autocomplete="off" value="<?php echo set_value('telefone'); ?>"  />
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label for="celular" class="control-label">Celular:</label>
                                    <div class="controls">
                                        <input id="celular" type="text" name="celular" data-mask="(00)00000-0000" autocomplete="off" value="<?php echo set_value('celular'); ?>"  />
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label for="email" class="control-label">Email:</label>
                                    <div class="controls">
                                        <input id="email" class="span3" type="text" name="email" autocomplete="off" value="<?php echo set_value('email'); ?>"  />
                                    </div>
                                </div>
                            </div>
                            <div id="tab2" class="tab-pane">
                                <div class="control-group" class="control-label">
                                    <label for="cep" class="control-label">CEP:</label>
                                    <div class="controls">
                                        <input id="cep" type="text" name="cep" data-mask="00000-000" autocomplete="off" value="<?php echo set_value('cep'); ?>"  />
                                    </div>
                                </div>

                                
                                <div class="control-group" class="control-label">
                                    <label for="rua" class="control-label">Rua:</label>
                                    <div class="controls">
                                        <input id="rua" class="span4" type="text" name="rua" autocomplete="off" value="<?php echo set_value('rua'); ?>"  />
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label for="numero" class="control-label">Número:</label>
                                    <div class="controls">
                                        <input id="numero" type="text" name="numero" autocomplete="off" value="<?php echo set_value('numero'); ?>"  />
                                    </div>
                                </div>

                                <div class="control-group" class="control-label">
                                    <label for="bairro" class="control-label">Bairro:</label>
                                    <div class="controls">
                                        <input id="bairro" type="text" name="bairro" autocomplete="off" value="<?php echo set_value('bairro'); ?>"  />
                                    </div>
                                </div>

                                <div class="control-group" class="control-label">
                                    <label for="cidade" class="control-label">Cidade:</label>
                                    <div class="controls">
                                        <input id="cidade" type="text" name="cidade" autocomplete="off" value="<?php echo set_value('cidade'); ?>"  />
                                    </div>
                                </div>

                                <div class="control-group" class="control-label">
                                    <label for="estado" class="control-label">Estado:</label>
                                    <div class="controls">
                                        <input id="estado" class="span1" type="text" maxlength="2" name="estado" autocomplete="off" value="<?php echo set_value('estado'); ?>"  />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-actions">
                        <div class="span12">
                            <div class="span6 offset3">
                                <button type="submit" class="btn btn-success"><i class="icon-plus icon-white"></i> Adicionar</button>
                                <a href="<?php echo base_url() ?>index.php/clientes" id="" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="<?php echo base_url() ?>assets/js/jquery.validate.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery.mask.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#formCliente').validate({
            rules: {
                nomeCliente: {required: true}
//                  documento:{ required: true},
//                  telefone:{ required: true},
//                  email:{ required: true},
//                  rua:{ required: true},
//                  numero:{ required: true},
//                  bairro:{ required: true},
//                  cidade:{ required: true},
//                  estado:{ required: true},
//                  cep:{ required: true}
            },
            messages: {
                nomeCliente: {required: 'Campo Requerido.'},
                documento: {required: 'Campo Requerido.'},
                telefone: {required: 'Campo Requerido.'},
                email: {required: 'Campo Requerido.'},
                rua: {required: 'Campo Requerido.'},
                numero: {required: 'Campo Requerido.'},
                bairro: {required: 'Campo Requerido.'},
                cidade: {required: 'Campo Requerido.'},
                estado: {required: 'Campo Requerido.'},
                cep: {required: 'Campo Requerido.'}

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
    });
</script>
<script type="text/javascript" >

    $(document).ready(function () {

        function limpa_formulario_cep() {
            // Limpa valores do formulário de cep.
            $("#rua").val("");
            $("#bairro").val("");
            $("#cidade").val("");
            $("#estado").val("");
        }

        //Quando o campo cep perde o foco.
        $("#cep").blur(function () {

            //Nova variável "cep" somente com dígitos.
            var cep = $(this).val().replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if (validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    $("#rua").val("...");
                    $("#bairro").val("...");
                    $("#cidade").val("...");
                    $("#estado").val("...");

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#rua").val(dados.logradouro);
                            $("#bairro").val(dados.bairro);
                            $("#cidade").val(dados.localidade);
                            $("#estado").val(dados.uf);
                            document.getElementById("numero").focus();
                        } //end if.
                        else {
                            //CEP pesquisado não foi encontrado.
                            limpa_formulario_cep();
                            alert("CEP não encontrado.");
                        }
                    });
                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulario_cep();
                    alert("Formato de CEP inválido.");
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulario_cep();
            }
        });
    });

</script>
