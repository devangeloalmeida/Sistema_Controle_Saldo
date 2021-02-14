<?php
include ('../data/config.php');
$conta = date('Ymd').'-'.date('H.i.s');
$_SESSION['id_cliente']=$_GET['1'];
?>
 
<div class="container">
<div class="modal-content">

  <div class="modal-header">
        <h4 class="modal-title">EXCLUIR USUÁRIO</h4>
        <?php 
        $sql_item=$db->prepare("SELECT * FROM usuarios WHERE id_usuario=:id_usuario ");
        $sql_item->bindParam(':id_usuario', $_GET['1']);
        $sql_item->execute();
        $dados_item = $sql_item->fetchAll(PDO::FETCH_ASSOC);
        foreach ($dados_item as $item) {                    
            echo '<b>'.$item['nome'].'</b>';

            $sql_i=$db->prepare("SELECT * FROM contas WHERE id_cliente=:id_usuario ");
            $sql_i->bindParam(':id_usuario', $_GET['1']);
            $sql_i->execute();
            $dados_i = $sql_i->fetchAll(PDO::FETCH_ASSOC);
            foreach ($dados_i as $i) {                    
               /*pega saldo*/
               $saldo = $i['saldo'];
               if ($saldo > 0){?>
                      <div class="alert alert-danger">
                        <strong>Conta com saldo!</strong> Este cliente possui conta com saldo positivo.
                      </div>
                  <?php
               }
            }
        }
        ?>
  </div>

  <form action="contas/excluir_conta3.php" method="post" >

  <div class="modal-body">
        <div class="col-md-12">
        
          <div class="form-group">
          <label>Excluir usuário? Uma vez confirmado não será possível recuperar.</label>      
          </div>
        
        </div>
  </div><!-- modal body-->
 
<button type="submit" class="btn btn-primary btn-round btn-sm ">CONFIRMAR EXCLUIR </button></div>
    <input type="hidden" name="id_cliente" value="<?php echo $_GET['1']; ?>">   

    <div class="modal-footer">        
        <button type="button" class="btn btn-danger btn-round btn-sm " data-dismiss="modal">CANCELAR</button>
        
    </div>


  </form>
</div>
</div>