<?php
ob_start();
session_start();
unset($_SESSION["tipo"]);

session_destroy();

echo "<meta http-equiv=refresh content='0;URL=index.php'>";    
exit; // Redireciona o visitansenha

?>