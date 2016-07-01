<?php

if($_POST){
 
    include_once 'config/database.php';
    include_once 'objeto/produto.php';
 
    $database = new Database();
    $db = $database->getConnection();
 
    $product = new Product($db);
      
    $product->id = $_POST['object_id'];
  
    if($product->delete()){
        echo "deletado com sucesso.";
    }
    else{
        echo "Não foi possivel efetuar operação.";
    }
}
?>