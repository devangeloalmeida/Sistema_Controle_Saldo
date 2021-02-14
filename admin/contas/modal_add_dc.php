<?php
  include ('../data/config.php');
  $conta = date('Ymd').'-'.date('H.i.s');
  $_SESSION['id_cliente']=$_GET['1'];
  $_SESSION['numero_conta']=$_GET['2'];
?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
<script src="../js/jquery.maskMoney.js" type="text/javascript"></script>

  
<div class="container">
<div class="modal-content">

  <div class="modal-header">
        <h3 class="modal-title">ADICIONAR DÉBITO/CRÉDITO</h3>
        <?php 

        $sql_item=$db->prepare("SELECT * FROM usuarios WHERE id_usuario=:id_usuario ");
        $sql_item->bindParam(':id_usuario', $_GET['1']);
        $sql_item->execute();
        $dados_item = $sql_item->fetchAll(PDO::FETCH_ASSOC);
        foreach ($dados_item as $item) {                    
          echo '<b>'.$item['nome'].'</b>';
        }
        ?>
  </div>

  <form action="contas/gravar_dc.php" method="post" >

  <div class="modal-body">
    
        <div class="col-md-12">
        <div class="col-md-6">
          <div class="form-group">
          <label>´Número de conta</label>      
          <input readonly type="text" class="form-control" name="conta" value="<?php echo $conta;?>">           
          </div>
        </div>  
        </div>
  <hr>  

  <div class="row">   
        <div class="col-md-12">

            <div class="col-md-6">
            <div class="form-group">
              <label>Tipo </label>                                      
               <select class="form-control" name="tipo_debito_credito" required>
                      <option value="">Selecionar</option>
                      <option value="SAQUE">Saque</option>
                      <option value="DEPOSITO">Depósito adicional</option>
               </select>
            </div>
            </div>
        
            <div class="col-md-6">
            <div class="form-group">
              <label>Valor R$</label>
              <input type="text" id="valor_aporte" class="form-control" placeholder="Valor do aporte">
            </div>
            </div>
        
            <div class="col-md-6">
            <div class="form-group">
              <label>Data do aporte </label>
              <input type="date" name="data_aporte" class="form-control" placeholder="data do aporte">
            </div>
            </div>
            </div>
           
        
        </div>     
  </div>
  </div><!-- modal body-->
 
    <input type="hidden" name="id_cliente" value="<?php echo $_GET['1']; ?>">   
    <input type="hidden" name="numero_conta" value="<?php echo $_GET['2']; ?>">

    <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-round btn-sm " data-dismiss="modal">CANCELAR</button>
        <button type="submit" class="btn btn-primary btn-round btn-sm ">ENVIAR</button></div>
    </div>


  </form>
</div>
</div>

<script type="text/javascript">
    $("#valor_aporte").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
</script>
