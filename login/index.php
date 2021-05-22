<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Login</title>
	<meta charset="utf-8">
	<link rel="icon" href="../img/favicon.png" type="image/png">
	<link rel="stylesheet" href="../css/estilo.css">
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">

</head>

	<body background="../img/bgLivros.png" class="fundo">
		<?php 
			session_start();
			if (isset($_SESSION['usuario'])){
				if (empty($_SESSION['usuario'])){
					echo "<div class=\"erro\">".$_SESSION['aviso']."</div>";
					unset($_SESSION['aviso']);
				}
			} else if (isset($_SESSION['aviso'])){
				echo "<div class=\"erro\">".$_SESSION['aviso']."</div>";
				unset($_SESSION['aviso']);
			}
			session_unset();
			session_destroy();
		?>
		<div class="container">
			<h1 class="text-white text-center mt-4">SISTEMA LIBIM</h1>
			<hr class="text-white mb-5">
			<div class="row align-items-center">
			<form action="verificar_login.php" method="post" style="width: 70%;">
				<h2 class="text-white">Login</h1>
					<div class="row">
						<div class="col-lg-10 offset-lg-1">
							<label for="">Usuário</label>
							<input type="text" name="txtusuario" placeholder="Usuário" required autocomplete="off">					
						</div>
					</div>
					<div class="row">
						<div class="col-lg-10 offset-lg-1">
							<label for="">Senha</label>
							<input type="password" name="txtsenha" placeholder="Senha" required>
						</div>
					</div>
					<div class="row mt-3">
						<div class="col-lg-4 offset-lg-4">
							<input class="btn btn-primary" type="submit" name="" value="ENTRAR">
						</div>
					</div>
			</form>
			</div>
		</div>
	</body>
</html>