<?php

	$page_title = "Criar Produto";
	include_once "parts/header.php";

    echo "<div class='right-button-margin'>";
        echo "<a href='index.php' class='btn btn-default pull-left'> <i class='fa fa-reply'></i> Voltar</a>";
    echo "</div>";



	include_once 'config/database.php';
	 
	$database = new Database();
	$db = $database->getConnection();


    if($_POST){
            
        include_once 'objeto/produto.php';
        $product = new Product($db);
     
        $product->name = $_POST['name'];
        $product->price = $_POST['price'];
        $product->description = $_POST['description'];

        if($product->create()){
            echo "<div class=\"alert alert-success alert-dismissable\">";
                echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
                echo "Produto criado com sucesso.";
            echo "</div>";
            echo "<script>
                jQuery(document).ready(function($) {
                    setTimeout(function() {
                        window.location.href = 'http://localhost/crud_produtos/index.php'
                    }, 2000);
                });
             </script>";
        }
     
        else{
            echo "<div class=\"alert alert-danger alert-dismissable\">";
                echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
                echo "Não foi possivel criar o produto.";
            echo "</div>";
        }
    }

?>

<form action='criar_produto.php' method='post'>
 
    <table class='table table-hover table-responsive table-bordered'>
 
        <tr>
            <td>Nome</td>
            <td><input type='text' name='name' class='form-control' /></td>
        </tr>
 
        <tr>
            <td>Preço</td>
            <td><input type='text' name='price' class='form-control' /></td>
        </tr>
 
        <tr>
            <td>Descrição</td>
            <td><textarea name='description' class='form-control'></textarea></td>
        </tr>
 
        
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary btn-block">Criar</button>
            </td>
        </tr>
 
    </table>
</form>



<?php include_once "parts/footer.php"; ?>

