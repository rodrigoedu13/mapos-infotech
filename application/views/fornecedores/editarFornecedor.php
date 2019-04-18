<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-user"></i>
                </span>
                <h5>Editar Fornecedor</h5>
            </div>
            <div class="widget-content nopadding">
                <?php
                if ($custom_error != '') {
                    echo '<div class="alert alert-danger">' . $custom_error . '</div>';
                }
                ?>
                <form action="<?php echo current_url(); ?>" id="formFornecedor" method="post" class="form-horizontal" >

                    <div class="widget-box">
                        <div class="widget-title">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#tab1">Dados Gerais</a></li>
                                <li><a data-toggle="tab" href="#tab2">Endereço</a></li>
                            </ul>
                        </div>
                        <div class="widget-content tab-content">
                            <div id="tab1" class="tab-pane active">
                                <div class="control-group">
                                    <?php echo form_hidden('idFornecedor', $result->idFornecedor) ?>
                                    <label for="nomeCliente" class="control-label">Nome:<span class="required">*</span></label>
                                    <div class="controls">
                                        <input id="nomeFornecedor" class="span4" type="text" name="nomeFornecedor" autocomplete="off" value="<?php echo $result->nomeFornecedor; ?>"  />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="documento" class="control-label">CNPJ:</label>
                                    <div class="controls">
                                        <input id="cnpj" type="text" name="cnpj" data-mask="000.000.000-00" autocomplete="off" value="<?php echo $result->cnpj; ?>"  />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="telefone" class="control-label">Inscrição Estadual:</label>
                                    <div class="controls">
                                        <input id="inscricaoE"  class="span3" type="text" name="inscricaoE" autocomplete="off" value="<?php echo $result->inscricaoEstadual; ?>"  />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="telefone" class="control-label">Inscrição Municipal:</label>
                                    <div class="controls">
                                        <input id="inscricaoM"  class="span3" type="text" name="inscricaoM" autocomplete="off" value="<?php echo $result->inscricaoMunicipal; ?>"  />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="telefone" class="control-label">Responsavél:</label>
                                    <div class="controls">
                                        <input id="responsavel"  class="span4" type="text" name="responsavel" autocomplete="off" value="<?php echo $result->responsavel; ?>"  />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="telefone" class="control-label">Telefone:</label>
                                    <div class="controls">
                                        <input id="telefone" type="text" name="telefone" data-mask="(00)0000-0000" autocomplete="off" value="<?php echo $result->telefone; ?>"  />
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label for="celular" class="control-label">Celular:</label>
                                    <div class="controls">
                                        <input id="celular" type="text" name="celular" data-mask="(00)00000-0000" autocomplete="off" value="<?php echo $result->celular; ?>"  />
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label for="email" class="control-label">Email:</label>
                                    <div class="controls">
                                        <input id="email" class="span3" type="text" name="email" autocomplete="off" value="<?php echo $result->email; ?>"  />
                                    </div>
                                </div>
                            </div>
                            <div id="tab2" class="tab-pane">
                                <div class="control-group" class="control-label">
                                    <label for="cep" class="control-label">CEP:</label>
                                    <div class="controls">
                                        <input id="cep" type="text" name="cep" data-mask="00000-000" autocomplete="off" value="<?php echo $result->cep; ?>"  />
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label for="numero" class="control-label">Número:</label>
                                    <div class="controls">
                                        <input id="numero" type="text" name="numero" autocomplete="off"  value="<?php echo $result->numero; ?>"  />
                                    </div>
                                </div>

                                <div class="control-group" class="control-label">
                                    <label for="rua" class="control-label">Rua:</label>
                                    <div class="controls">
                                        <input id="rua" class="span4" type="text" name="rua" autocomplete="off" value="<?php echo $result->rua; ?>"  />
                                    </div>
                                </div>

                                <div class="control-group" class="control-label">
                                    <label for="bairro" class="control-label">Bairro:</label>
                                    <div class="controls">
                                        <input id="bairro" type="text" name="bairro" autocomplete="off" value="<?php echo $result->bairro; ?>"  />
                                    </div>
                                </div>

                                <div class="control-group" class="control-label">
                                    <label for="cidade" class="control-label">Cidade:</label>
                                    <div class="controls">
                                        <input id="cidade" type="text" name="cidade" autocomplete="off" value="<?php echo $result->cidade; ?>"  />
                                    </div>
                                </div>

                                <div class="control-group" class="control-label">
                                    <label for="estado" class="control-label">Estado:</label>
                                    <div class="controls">
                                        <input id="estado" class="span1" type="text" maxlength="2" name="estado" autocomplete="off" value="<?php echo $result->estado; ?>"  />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <div class="span12">
                            <div class="span6 offset3">
                                <button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Alterar</button>
                                <a href="<?php echo base_url() ?>index.php/fornecedores" id="" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
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
        $('#formFornecedor').validate({
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
