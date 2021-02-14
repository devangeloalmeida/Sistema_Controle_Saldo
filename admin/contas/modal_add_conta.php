<?php
  include ('../data/config.php');
  $conta = date('Ymd').'-'.date('H.i.s');
  $_SESSION['id_cliente']=$_GET['1'];
?>

  
<div class="container">
<div class="modal-content">

  <div class="modal-header">
        <h3 class="modal-title">ADICIONAR CONTA</h3>
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

  <form action="contas/gravar_.php" method="post" >

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
              <label>Valor do aporte R$</label>
              <input type="number" name="valor_aporte" class="form-control" placeholder="Valor do aporte">
            </div>
            </div>
        
            <div class="col-md-6">
            <div class="form-group">
              <label>Data do aporte </label>
              <input type="date" name="data_aporte" class="form-control" placeholder="data do aporte">
            </div>
            </div>
        </div>
           
        <div class="col-md-12">
            <div class="col-md-6">
            <div class="form-group">
               <label>Indicado por </label>                                      
               <select class="form-control" name="id_usuario" >
                      <option value="">Selecionar</option>
                      <?php            
                      //$sql_item = $db->prepare("SELECT * FROM usuarios");
                      $admin='ADMIN';                 
                      $sql_item=$db->prepare("SELECT * FROM usuarios WHERE tipo_usuario!=:tipo ORDER BY id_usuario DESC ");
                      $sql_item->bindParam(':tipo', $admin);
                      $sql_item->execute();
                      $dados_item = $sql_item->fetchAll(PDO::FETCH_ASSOC);
                      foreach ($dados_item as $item) { ?>
                          <option value="<?php echo $item['id_usuario'];?>"> <?php echo utf8_encode($item['nome']);?> </option>
                      <?php }?>                    
                </select>               
            </div>
            </div>

            <div class="col-md-6">
            <div class="form-group">
              <label>Comissão em percentual %</label>
              <input type="number" name="comissao" class="form-control" placeholder="Comissão %">
            </div>
            </div>

            <div class="col-md-6">
            <div class="form-group">
              <label>Rentabilidade</label>
              <input type="number" name="rentabilidade" class="form-control" placeholder="Rentabilidade">
            </div>
            </div>

            <div class="col-md-6">
            <div class="form-group">
              <label>Tipo remuneração</label>
              <select class="form-control" name="tipo_remunerado">
                <option value="Remuneracao Total"> Remuneração Total</option>
                <option value="Remuneracao Total"> Remuneração Divisão</option>
              </select>
            </div>
            </div>
        </div>     
  </div>
  </div><!-- modal body-->
 
    <input type="hidden" name="id_cliente" value="<?php echo $_GET['1']; ?>">   

    <div class="modal-footer">
         
        <button type="button" class="btn btn-danger btn-round btn-sm " data-dismiss="modal">CANCELAR</button>
        <button type="submit" class="btn btn-primary btn-round btn-sm ">ENVIAR</button></div>
    </div>


  </form>
</div>
</div>