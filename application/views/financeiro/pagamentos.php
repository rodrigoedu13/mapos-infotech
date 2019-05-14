<link rel="stylesheet" href="<?php echo base_url();?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>

<?php $situacao = $this->input->get('situacao');
	  $periodo = $this->input->get('periodo');	
 ?>

<style type="text/css">
	
	label.error{
		color: #b94a48;
	}

	input.error{
    border-color: #b94a48;
  }
  input.valid{
    border-color: #5bb75b;
  }


</style>


<?php if($this->permission->checkPermission($this->session->userdata('permissao'),'aLancamento')){ ?>
  <div class="span2" style="margin-left: 0">  
      <a href="<?php echo base_url()?>index.php/financeiro/adicionarPagamento" class="btn btn-danger"><i class="icon-plus icon-white"></i> Pagamento</a>
  </div>
<?php } ?>

<div class="span10" style="margin-left: 0">
    <form action="<?php echo current_url(); ?>" method="get" >
        <div class="span4" style="margin-left: 0">
            <label>Cliente/Fornecedor </label>
            <input type="text" class="span12" name="cliforn">
        </div>
        <div class="span3" >
            <label>Período <i class="icon-info-sign tip-top" title="Lançamentos com vencimento no período."></i></label>
            <select name="periodo" class="span12">
                <option value="dia">Hoje</option>
                <option value="semana" <?php if ($periodo == 'semana') {
          echo 'selected';
      } ?>>Esta Semana</option>
                <option value="mes" <?php if ($periodo == 'mes') {
          echo 'selected';
      } ?>>Este Mês</option>
                <option value="ano" <?php if ($periodo == 'ano') {
          echo 'selected';
      } ?>>Este Ano</option>
                <option value="todos" <?php if ($periodo == 'todos') {
          echo 'selected';
      } ?>>Todos</option>
            </select>
        </div>
        <div class="span3">
            <label>Situação <i class="icon-info-sign tip-top" title="Lançamentos com situação específica ou todos."></i></label>
            <select name="situacao" class="span12">
                <option value="todos">Todos</option>
                <option value="previsto" <?php if ($situacao == 'previsto') {
          echo 'selected';
      } ?>>Previsto</option>
                <option value="atrasado" <?php if ($situacao == 'atrasado') {
          echo 'selected';
      } ?>>Atrasado</option>
                <option value="realizado" <?php if ($situacao == 'realizado') {
        echo 'selected';
    } ?>>Realizado</option>
                <option value="pendente" <?php if ($situacao == 'pendente') {
        echo 'selected';
    } ?>>Pendente</option>
            </select>
        </div>
        <div class="span2" >
            &nbsp
            <button type="submit" class="span12 btn btn-primary">Filtrar</button>
        </div>

    </form>
</div>
	

<div class="span12" style="margin-left: 0;">

<?php

if(!$results){?>
	<div class="widget-box">
     <div class="widget-title">
        <span class="icon">
            <i class="icon-tags"></i>
         </span>
        <h5>Lançamentos de Contas a pagar</h5>

     </div>

<div class="widget-content nopadding">


<table class="table table-bordered ">
    <thead>
        <tr style="backgroud-color: #2D335B">
            <th>Código</th>
            
            <th>Cliente / Fornecedor</th>
            <th>Descrição</th>
	    <th>Vencimento</th>
	    <th>Pagamento</th>
            <th>Status</th>
            <th>Valor</th>
            <th></th>
        </tr>
    </thead>
    <tbody>

        <tr>
            <td colspan="6">Nenhuma lançamento encontrado</td>
        </tr>
    </tbody>
</table>
</div>
</div>
<?php } else{?>


<div class="widget-box">
     <div class="widget-title">
        <span class="icon">
            <i class="icon-tags"></i>
         </span>
        <h5>Lançamentos de Contas a pagar</h5>

     </div>

<div class="widget-content nopadding">


<table class="table table-bordered " id="divLancamentos">
    <thead>
        <tr style="backgroud-color: #2D335B">
            <th>Código</th>
           
            <th>Cliente / Fornecedor</th>
            <th>Descrição</th>
	    <th>Vencimento</th>
	    <th>Pagamento</th>
            <th>Status</th>
            <th>Valor</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $totalReceita = 0;
        $totalDespesa = 0;
        $saldo = 0;
        foreach ($results as $r) {
            if ($r->data_vencimento == 0){
                $vencimento = '';
            }else{
                $vencimento = date(('d/m/Y'),strtotime($r->data_vencimento));
            }
            if ($r->data_pagamento == 0){
                $pagamento = '';
            }else{
                $pagamento = date(('d/m/Y'),strtotime($r->data_pagamento));
            }
            if ($r->cliente_fornecedor != null){
                $fornecedor = $r->cliente_fornecedor;
            }else{
                $fornecedor = $r->nomeFornecedor;
            }
            
            if($r->baixado == 0 and $r->data_vencimento >= date('Y-m-d')){$status = 'Em aberto'; $slabel = 'default';}elseif($r->baixado == 1){ $status = 'Pago';$slabel = 'success';}elseif($r->baixado == 0 and $r->data_vencimento < date('Y-m-d')){$status = 'Atrasado';$slabel = 'important';};
            if($r->tipo == 'despesa'){$totalDespesa += $r->valor;}
            echo '<tr>'; 
            echo '<td>'.$r->idLancamentos.'</td>';
            
            echo '<td>'.$fornecedor.'</td>';
	    echo '<td>'.$r->descricao.'</td>';	
            echo '<td>'.$vencimento.'</td>';   
            echo '<td>'.$pagamento.'</td>';   
            echo '<td><span class="badge badge-'.$slabel.'">'.ucfirst($status).'</span></td>';
            echo '<td> R$ '.number_format($r->valor,2,',','.').'</td>';
            
            echo '<td>';
            if($this->permission->checkPermission($this->session->userdata('permissao'),'eLancamento')){
                echo '<a href=" ' . base_url('index.php/pagamentos/editar/') . $r->idLancamentos. '" style="margin-right: 1%" role="button" class="btn btn-mini btn-info tip-top" title="Editar Pagamento"><i class="icon-pencil icon-white"></i></a>'; 
            }
            if($this->permission->checkPermission($this->session->userdata('permissao'),'dLancamento')){
                echo '<a href="#modalExcluir" data-toggle="modal" role="button" idLancamento="'.$r->idLancamentos.'" class="btn btn-danger tip-top btn-mini" title="Excluir Lançamento"><i class="icon-remove icon-white"></i></a>'; 
            }
            
            echo '<div class="btn-group" style="margin-left: 1%">
              <button data-toggle="dropdown" class="btn btn-mini btn-success dropdown-toggle"><span class="caret"></span></button>
              <ul class="dropdown-menu pull-right">';
            if ($r->baixado == 0){
               echo ' <li><a href="#modalConfPagamento" data-toggle="modal" role="button" class="confirmar" idLancamento="'.$r->idLancamentos.'" valor="'. $r->valor.'" dtPagamento="'.$pagamento.'" formaPgto="'.$r->forma_pgto.'"><i class="icon-ok"></i>Confirmar Pagamento</a></li>';
            }else{
                echo '<li><a href="#modalCancPagamento" data-toggle="modal" role="button" class="cancelar" idLancamento="'.$r->idLancamentos.'" valor="'. $r->valor.'" dtPagamento="'.$pagamento.'" formaPgto="'.$r->forma_pgto.'"><i class="icon-remove"></i>Cancelar pagamento</a></li>';
            }
             echo '   <li><a href="#"><i class="icon-print"></i>Imprimir</a></li>
                
              </ul>
            </div> ';                    
            echo '</td>';
            echo '</tr>';
        }?>
        <tr>
            
        </tr>
    </tbody>
</table>
</div>
</div>

</div>
	
<?php }?>

<!-- Modal confirmar Pagamento -->
<div id="modalConfPagamento" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form id="formConfPagamento" action="<?php echo base_url() ?>index.php/financeiro/ConfirmarPagamento" method="post">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Confirmar Pagamento</h3>
  </div>
  <div class="modal-body">
      <div class="span12 alert alert-info" style="margin-left: 0"> Obrigatório o preenchimento dos campos com asterisco.</div>

      <div class="span12" style="margin-left: 0"> 
        <div class="span4" style="margin-left: 0">  
            <label for="valor">Valor<span class="required">*</span></label>
          <input type="hidden"  id="idConf" name="id" value="" /> 
          <input id="urlAtual" type="hidden" name="urlAtual" value=""  />
          <input class="span12 money"  type="text" name="valor" id="valorConf" />
        </div>
        <div class="span4" >
          <label for="pagamento">Data de Pagamento<span class="required">*</span></label>
          <input class="span12 datepicker"  type="text" name="pagamento" autocomplete="off" id="dtPagamentoConf" />
        </div>
        <div class="span4">
          <label for="formaPgto">Forma de Pagamento<span class="required">*</span></label>
          <select name="formaPgto" id="formaPgto"  class="span12">
              <option value="Dinheiro">Dinheiro</option>
              <option value="Cartão de Crédito">Cartão de Crédito</option>
              <option value="Cheque">Cheque</option>
              <option value="Boleto">Boleto</option>
              <option value="Depósito">Depósito</option>
              <option value="Débito">Débito</option>  			
          </select>
        </div>
        
        
      </div>

  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true" id="btnCancelarEditar">Cancelar</button>
    <button class="btn btn-primary">Confirmar</button>
  </div>
  </form>
</div>

<!-- Modal cancelar Pagamento -->
<div id="modalCancPagamento" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form id="formConcPagamento" action="<?php echo base_url() ?>index.php/financeiro/cancelarPagamento" method="post">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Concelar Pagamento</h3>
  </div>
  <div class="modal-body">
      

      <div class="span12" style="margin-left: 0"> 
          <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Valor</th>
                  <th>Data do pagamento</th>
                  <th>Forma de Pagamento</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                    <td><p id="valorConf"></p></td>
                  <td>as</td>
                  <td>Win 95+</td>
                </tr>

              </tbody>
            </table>

      </div>

  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true" id="btnCancelarEditar">Cancelar</button>
    <button class="btn btn-primary">Confirmar</button>
  </div>
  </form>
</div>



<!-- Modal Excluir lançamento-->
<div id="modalExcluir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">MapOS - Excluir Lançamento</h3>
  </div>
  <div class="modal-body">
    <h5 style="text-align: center">Deseja realmente excluir esse lançamento?</h5>
    <input name="id" id="idExcluir" type="hidden" value="" />
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true" id="btnCancelExcluir">Cancelar</button>
    <button class="btn btn-danger" id="btnExcluir">Excluir Lançamento</button>
  </div>
</div>





<script src="<?php echo base_url()?>assets/js/jquery.validate.js"></script>
<script src="<?php echo base_url();?>assets/js/maskmoney.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {

		$(".money").maskMoney();

		$('#pago').click(function(event) {
			var flag = $(this).is(':checked');
			if(flag == true){
				$('#divPagamento').show();
			}
			else{
				$('#divPagamento').hide();
			}
		});


		$('#recebido').click(function(event) {
			var flag = $(this).is(':checked');
			if(flag == true){
				$('#divRecebimento').show();
			}
			else{
				$('#divRecebimento').hide();
			}
		});

    $('#pagoEditar').click(function(event) {
      var flag = $(this).is(':checked');
      if(flag == true){
        $('#divPagamentoEditar').show();
      }
      else{
        $('#divPagamentoEditar').hide();
      }
    });


		$("#formConfPagamento").validate({
          rules:{
             valorConf: {required:true},
             dtVencimentoConf: {required:true},
             formaPgto: {required:true}
      
          },
          messages:{
             valorConf: {required: 'Campo Requerido.'},
             dtVencimentoConf: {required: 'Campo Requerido.'},
             formaPgto: {required: 'Campo Requerido.'}
          }
    });

    

    $(document).on('click', '.excluir', function(event) {
      $("#idExcluir").val($(this).attr('idLancamento'));
    });


    $(document).on('click', '.confirmar', function(event) {
      $("#idConf").val($(this).attr('idLancamento'));
      $("#valorConf").val($(this).attr('valor'));
      $("#dtPagamentoConf").val($(this).attr('dtPagamento'));
      $("#formaPgto").val($(this).attr('formaPgto')); 
      $("#urlAtual").val($(location).attr('href'));
      

    });
    
    $(document).on('click', '.cancelar', function(event) {
      $("#idConf").val($(this).attr('idLancamento'));
      $("#valorConf").val($(this).attr('valor'));
      $("#dtPagamentoConf").val($(this).attr('dtPagamento'));
      $("#formaPgto").val($(this).attr('formaPgto')); 
      $("#urlAtual").val($(location).attr('href'));
      

    });

    $(document).on('click', '#btnExcluir', function(event) {
        var id = $("#idExcluir").val();
    
        $.ajax({
          type: "POST",
          url: "<?php echo base_url();?>index.php/financeiro/excluirLancamento",
          data: "id="+id,
          dataType: 'json',
          success: function(data)
          {
            if(data.result == true){
                $("#btnCancelExcluir").trigger('click');
                $("#divLancamentos").html('<div class="progress progress-striped active"><div class="bar" style="width: 100%;"></div></div>');
                $("#divLancamentos").load( $(location).attr('href')+" #divLancamentos" );
                
            }
            else{
                $("#btnCancelExcluir").trigger('click');
                alert('Ocorreu um erro ao tentar excluir produto.');
            }
          }
        });
        return false;
    });
 
    $(".datepicker" ).datepicker({ dateFormat: 'dd/mm/yy' });

	});

</script>


