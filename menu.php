<?php
session_start();
include('conexao.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Menu</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.navbar-custom {
    background-color: #212529 !important;
}
.navbar-custom .navbar-brand {
    color: #fff !important;
    margin-right: 15px;
    font-weight: 500;
}
.navbar-custom .navbar-brand:hover {
    color: #dcdcdc !important;
}
</style>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-custom">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Home</a>
        <a class="navbar-brand" href="telacadastro.php">Cadastro</a>
        <a class="navbar-brand" href="painel.php">Painel de Estatísticas</a>
        <a class="navbar-brand" href="alunos.php">Alunos</a>
        <a class="navbar-brand" href="menu.php">Login</a>
		<div class="d-flex ms-auto">
            <a href="logout.php" class="btn btn-outline-light">Sair</a>
        </div>
    </div>
</nav>

<section class="h-100">
<div class="container h-100">
    <!-- resto do seu código -->
			</nav>

			<div class="row justify-content-sm-center h-100">
				<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9"><br><br>
					<br><div class="card shadow-lg">
						<div class="card-body p-5">
							<h1 class="fs-4 card-title fw-bold mb-4">Registrar</h1>
							<!-- Mensagem de cadastro início -->
							 <?php 
							 	if(isset($_SESSION['mensagem'])):
							 ?>
							 <div class="alert alert-info alert-dismissible fade show" role="alert">
								<?= $_SESSION['mensagem']; ?>
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							 </div>
							 <?php 
							 	unset($_SESSION['mensagem']); //limpa a mensagem após exibir
								endif;
							 ?>

							<!-- Mensagem de cadastro final -->
							<form action="cadastro.php" method="POST" class="needs-validation" novalidate="" autocomplete="off">
								<div class="mb-3">
									<label class="mb-2 text-muted" for="name">Name</label>
									<input id="name" type="text" class="form-control" name="nome" value="" required autofocus>
									<div class="invalid-feedback">
										Name is required	
									</div>
								</div>

								<div class="mb-3">
									<label class="mb-2 text-muted" for="email">E-Mail Address</label>
									<input id="email" type="email" class="form-control" name="email" value="" required>
								</div>

								<div class="mb-3">
									<label class="mb-2 text-muted" for="password">Password</label>
									<input id="" type="password" class="form-control" name="senha" required>
								</div>

								<p class="form-text text-muted mb-3">
									By registering you agree with our terms and condition.
								</p>

								<div class="align-items-center d-flex">
									<button type="submit" class="btn btn-primary ms-auto">
										Register	
									</button>
								</div>
							</form>
						</div>
						<div class="card-footer py-3 border-0">
							<div class="text-center">
								Already have an account? <a href="index.php" class="text-dark">Login</a>
							</div>
						</div>
					</div>
					<div class="text-center mt-5 text-muted">
						Copyright &copy; 2025 &mdash; Your Company 
					</div>
				</div>
			</div>
		</div>
	</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
