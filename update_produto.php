<?php
	$page_title = "Atualizar Produto";
	include_once "parts/header.php";

	echo "<div class='right-button-margin'>";
        echo "<a href='index.php' class='btn btn-default pull-left'> <i class='fa fa-reply'></i> Voltar</a>";
    echo "</div>";



	$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: perdeu ID.');
	 
	include_once 'config/database.php';
	include_once 'objeto/produto.php';
	 
	$database = new Database();
	$db = $database->getConnection();
	 
	$product = new Product($db);
	 
	$product->id = $id;
	 
	$product->readOne();
?>

<form action='update_produto.php?id=<?php echo $id; ?>' method='post'>
 
    <table class='table table-hover table-responsive table-bordered'>
 
        <tr>
            <td>Nome</td>
            <td><input type='text' name='name' value='<?php echo $product->name; ?>' class='form-control' /></td>
        </tr>
 
        <tr>
            <td>Preço</td>
            <td><input type='text' name='price' value='<?php echo $product->price; ?>' class='form-control' /></td>
        </tr>
 
        <tr>
            <td>Discrição</td>
            <td><textarea name='description' class='form-control'><?php echo $product->description; ?></textarea></td>
        </tr>
 
 
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-success btn-block">Atualizar</button>
            </td>
        </tr>
 
    </table>
</form>

<?php 
	
if($_POST){
     
    $product->name = $_POST['name'];
    $product->price = $_POST['price'];
    $product->description = $_POST['description'];
     
    if($product->update()){
        echo "<div class=\"alert alert-success alert-dismissable\">";
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
            echo "Produto Atualizado com sucesso.";
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
            echo "Não é possivel atualizar o produto.";
        echo "</div>";
    }
}


	include_once "parts/footer.php";
?>


