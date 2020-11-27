<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title> Login</title>
	<meta charset="utf-8">
	<link rel="icon" href="../img/favicon.png" type="image/png">
	<link rel="stylesheet" href="../css/estilo.css">
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
			<form class= "login-box" action="verificar_login.php" method="post">
				<h1 class="titulo-login">Login</h1>
						<i class="fa fa-user" aria-hidden="true"></i>
						<input class="textbox" type="text" name="txtusuario" placeholder="Usuário" required autocomplete="off">
					
					
						<i class="fa fa-lock" aria-hidden="true"></i>
						<input class="textbox" type="password" name="txtsenha" placeholder="Senha" required>
				<br><br>
					<input class="botaoEnviar" type="submit" name="" value="ENTRAR">
				</form>
		

		
	</body>
</html>