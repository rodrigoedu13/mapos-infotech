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
            <th>#</th>
            <th>Tipo</th>
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
            <th>#</th>
            <th>Tipo</th>
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
            
            if($r->baixado == 0){$status = 'Pendente';}else{ $status = 'Pago';};
            if($r->tipo == 'receita'){ $label = 'success'; $totalReceita += $r->valor;} else{$label = 'important'; $totalDespesa += $r->valor;}
            echo '<tr>'; 
            echo '<td>'.$r->idLancamentos.'</td>';
            echo '<td><span class="label label-'.$label.'">'.ucfirst($r->tipo).'</span></td>';
            echo '<td>'.$r->cliente_fornecedor.'</td>';
	    echo '<td>'.$r->descricao.'</td>';	
            echo '<td>'.$vencimento.'</td>';   
            echo '<td>'.$pagamento.'</td>';   
            echo '<td>'.$status.'</td>';
            echo '<td> R$ '.number_format($r->valor,2,',','.').'</td>';
            
            echo '<td>';
            if($this->permission->checkPermission($this->session->userdata('permissao'),'eLancamento')){
                echo '<a href="#modalEditar" style="margin-right: 1%" data-toggle="modal" role="button" idLancamento="'.$r->idLancamentos.'" descricao="'.$r->descricao.'" valor="'.$r->valor.'" vencimento="'.date('d/m/Y',strtotime($r->data_vencimento)).'" pagamento="'.date('d/m/Y', strtotime($r->data_pagamento)).'" baixado="'.$r->baixado.'" cliente="'.$r->cliente_fornecedor.'" formaPgto="'.$r->forma_pgto.'" tipo="'.$r->tipo.'" class="btn btn-info tip-top editar" title="Editar Lançamento"><i class="icon-pencil icon-white"></i></a>'; 
            }
            if($this->permission->checkPermission($this->session->userdata('permissao'),'dLancamento')){
                echo '<a href="#modalExcluir" data-toggle="modal" role="button" idLancamento="'.$r->idLancamentos.'" class="btn btn-danger tip-top excluir" title="Excluir Lançamento"><i class="icon-remove icon-white"></i></a>'; 
            }
                     
            echo '</td>';
            echo '</tr>';
        }?>
        <tr>
            
        </tr>
    </tbody>
    <tfoot>
    	<tr>
    		<td colspan="7" style="text-align: right; color: green"> <strong>Total Receitas:</strong></td>
    		<td colspan="2" style="text-align: left; color: green"><strong>R$ <?php echo number_format($totalReceita,2,',','.') ?></strong></td>
    	</tr>
    	<tr>
    		<td colspan="7" style="text-align: right; color: red"> <strong>Total Despesas:</strong></td>
    		<td colspan="2" style="text-align: left; color: red"><strong>R$ <?php echo number_format($totalDespesa,2,',','.') ?></strong></td>
    	</tr>
    	<tr>
    		<td colspan="7" style="text-align: right"> <strong>Saldo:</strong></td>
    		<td colspan="2" style="text-align: left;"><strong>R$ <?php echo number_format($totalReceita - $totalDespesa,2,',','.') ?></strong></td>
    	</tr>
    </tfoot>
</table>
</div>
</div>

</div>
	
<?php }?>



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


		$("#formReceita").validate({
          rules:{
             descricao: {required:true},
             cliente: {required:true},
             valor: {required:true},
             vencimento: {required:true}
      
          },
          messages:{
             descricao: {required: 'Campo Requerido.'},
             cliente: {required: 'Campo Requerido.'},
             valor: {required: 'Campo Requerido.'},
             vencimento: {required: 'Campo Requerido.'}
          }
    });



		$("#formDespesa").validate({
          rules:{
             descricao: {required:true},
             fornecedor: {required:true},
             valor: {required:true},
             vencimento: {required:true}
      
          },
          messages:{
             descricao: {required: 'Campo Requerido.'},
             fornecedor: {required: 'Campo Requerido.'},
             valor: {required: 'Campo Requerido.'},
             vencimento: {required: 'Campo Requerido.'}
          }
       	});
    

    $(document).on('click', '.excluir', function(event) {
      $("#idExcluir").val($(this).attr('idLancamento'));
    });


    $(document).on('click', '.editar', function(event) {
      $("#idEditar").val($(this).attr('idLancamento'));
      $("#descricaoEditar").val($(this).attr('descricao'));
      $("#fornecedorEditar").val($(this).attr('cliente'));
      $("#valorEditar").val($(this).attr('valor'));
      $("#vencimentoEditar").val($(this).attr('vencimento'));
      $("#pagamentoEditar").val($(this).attr('pagamento'));
      $("#formaPgtoEditar").val($(this).attr('formaPgto'));
      $("#tipoEditar").val($(this).attr('tipo'));
      $("#urlAtualEditar").val($(location).attr('href'));
      var baixado = $(this).attr('baixado');
      if(baixado == 1){
        $("#pagoEditar").attr('checked', true);
        $("#divPagamentoEditar").show();
      }
      else{
        $("#pagoEditar").attr('checked', false); 
        $("#divPagamentoEditar").hide();
      }
      

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


