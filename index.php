<?php
	$page_title = "Listar Produtos";
	include_once "parts/header.php";


	echo "<div class='right-button-margin'>";
    echo "<a href='criar_produto.php' class='btn btn-primary pull-right'><i class='fa fa-plus'></i> Criar Produtos</a>";
	echo "</div>";
	

 
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
 
    $records_per_page = 3;

    $from_record_num = ($records_per_page * $page) - $records_per_page;


	include_once 'config/database.php';
	include_once 'objeto/produto.php';
	 
	
	$database = new Database();
	$db = $database->getConnection();
	 
	$product = new Product($db);
	 
	
	$stmt = $product->readAll($page, $from_record_num, $records_per_page);
	$num = $stmt->rowCount();
	 
	
	if($num>0){
	 
	    echo "<table class='table table-hover table-responsive table-bordered'>";
	        echo "<tr>";
	            echo "<th>Produto</th>";
	            echo "<th>Preço</th>";
	            echo "<th>Discrição</th>";
	            echo "<th>Acção</th>";
	        echo "</tr>";
	 
	        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	 
	            extract($row);
	 
	            echo "<tr>";
	                echo "<td>{$name}</td>";
	                echo "<td>{$price}</td>";
	                echo "<td>{$description}</td>";
	                echo "<td>";
						    echo "<a href='update_produto.php?id={$id}' class='btn btn-info left-margin'><i class='fa fa-edit'></i> Editar</a>";
						    echo "<a delete-id='{$id}' class='btn btn-danger delete-object'><i class='fa fa-trash'></i> deletar</a>";
					echo "</td>";
	 
	            echo "</tr>";
	 
	        }
	 
	    echo "</table>";
	
	}
	
	else{
	    echo "<div>Nenhum produto encontrado.</div>";
	}
?>

	<script>
		$(document).on('click', '.delete-object', function(){
		         
		    var id = $(this).attr('delete-id');
		    var q = confirm("Tens certeza que deseja remover esse produto?");
		     
		    if (q == true){
		 
		        $.post('delete_produto.php', {
		            object_id: id
		        }, function(data){
		            location.reload();
		        }).fail(function() {
		            alert('Não foi possivel deletar o produto.');
		        });
		 
		    }
		         
		    return false;
		});
	</script>

<?php 
	include_once "parts/footer.php";
?>

 