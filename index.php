<?php
    session_start();
    if(isset($_GET['limpar'])){
		unset($_SESSION['buy']);
	}

?>
<?php 

	$camisas = array(
		['name' => 'camisa 01', 'image' => 'uploads/tb-img-01.jpg', 'price' => '55.9'],
		['name' => 'camisa 02', 'image' => 'uploads/tb-img-02.jpg', 'price' => '45.9'],
		['name' => 'camisa 03', 'image' => 'uploads/tb-img-03.jpg', 'price' => '65']
    );
        
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Loja Virtual</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
  <body>

  <nav class="navbar navbar-light bg-danger">
	  <div class="container">
	    <a class="navbar-brand" href="#">
	      <img src="images/marketplace.png" alt="" width="50" height="50" class="d-inline-block align-text-top">
	    </a>
	  </div>
	</nav>
    
    <div class="card-group text-center  container">
        <?php foreach ($camisas as $key => $value):?>
  <div class="card">
    <img src="<?=$value['image']?>" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title"><?=$value['name']?></h5>
      <p class="card-text"><?=$value['price']?></p>
      <a href="?comprar=<?php echo $key ?>" class="btn btn-warning">COMPRAR</a>
    </div>
  </div>
  <?php endforeach; ?>
  <div class="container">
  <h2>Carrinho: </h2>
	  	<?php 
	  		if(isset($_GET['comprar'])){
	  			$idCamisa = (int) $_GET['comprar'];
                  if(isset($camisas[$idCamisa])){
                    if(isset($_SESSION['buy'][$idCamisa])){
                        $_SESSION['buy'][$idCamisa]['quant']++;
                    }else{
                        $_SESSION['buy'][$idCamisa] = array('quant'=>1, 'name'=>$camisas[$idCamisa]['name'], 'price'=>$camisas[$idCamisa]['price']);
                    }
                    echo '<script>alert("Camisa adicionada no carrinho")</script>';
                }else{
                    die("O Produto não está mais no estoque");
                }
	  		}
              if(isset($_SESSION['buy'])){
              foreach ($_SESSION['buy'] as $key => $value){
                echo '<p>Nome: '.$value['name'].'| Quant.:'.$value['quant'].' | Valor: R$'.(floatval($value['price']) * intval($value['quant'])).': ';
                } 
                echo "<br>";
	        }else{
		        echo "O carrinho está vazio!";
                }
                        
	  	?>
        <p><a href="?limpar" class="btn btn-secondary">LIMPAR CARRINHO</a></p>
        <?php
            $total = [
                'quants' => 0,
                'prices' => 0
             ];
 if(isset($_SESSION['buy']))
     foreach ($_SESSION['buy'] as $key) {
         $total['quants'] = $total['quants'] + $key['quant']; 
         $total['prices'] = $total['prices'] + $key['price'] * $key['quant']; 
     }
 echo $total['quants']  . ' produtos  por R$ ' . $total['prices'];
 
        ?>

	  </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>