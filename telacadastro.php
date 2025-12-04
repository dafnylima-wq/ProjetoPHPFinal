<?php
session_start();
include('conexao.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Cadastro</title>
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

<!-- NAVBAR PADRONIZADA -->
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
	<div class="container">

		<div class="row justify-content-center">
			<div class="col-12 col-lg-10 col-xl-8"><br><br>

				<div class="card shadow-lg">
					<div class="card-body p-5">

						<h1 class="fs-4 card-title fw-bold mb-4">Cadastro</h1>

						<!-- Mensagem -->
						<?php if(isset($_SESSION['mensagem'])): ?>
							<div class="alert alert-info alert-dismissible fade show" role="alert">
								<?= $_SESSION['mensagem']; ?>
								<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
							</div>
						<?php unset($_SESSION['mensagem']); endif; ?>

						<form action="register.php" method="POST">

							<div class="row g-3">

								<!-- COLUNA 1 -->
								<div class="col-md-6">

									<label class="mb-2 text-muted" for="nome">Nome Completo</label>
									<input id="nome" type="text" class="form-control" name="nome" required>

									<label class="mb-2 text-muted" for="data_nasc">Data de Nascimento</label>
									<input id="data_nasc" type="date" class="form-control" name="data_nasc" required>

									<label class="mb-2 text-muted" for="responsavel">Nome do Responsável</label>
									<input id="responsavel" type="text" class="form-control" name="responsavel" required>

									<label class="mb-2 text-muted">Tipo de Responsável</label>
									<select class="form-select" name="tipo_responsavel" required>
										<option value="" disabled selected>Selecione *</option>
										<option value="Pai">Pai</option>
										<option value="Mãe">Mãe</option>
										<option value="Tia/Tio">Tia/Tio</option>
										<option value="Irmão/Irmã">Irmão/Irmã</option>
										<option value="Outro">Outro</option>
									</select>

									<label class="mb-2 text-muted" for="curso">Curso</label>
									<select class="form-select" name="curso" required>
										<option value="" disabled selected>Selecione o curso *</option>
										<option value="ds">Desenvolvimento de Sistemas</option>
										<option value="info">Informática</option>
										<option value="adm">Administração</option>
										<option value="enfe">Enfermagem</option>
									</select>

								</div>

								<!-- COLUNA 2 -->
								<div class="col-md-6">

									<label class="mb-2 text-muted" for="rua">Nome da Rua</label>
									<input id="rua" type="text" class="form-control" name="rua" required>

									<label class="mb-2 text-muted" for="numero_casa">Nº da casa</label>
									<input id="numero_casa" type="number" class="form-control" name="numero_casa" required>

									<label class="mb-2 text-muted" for="bairro">Bairro</label>
									<input id="bairro" type="text" class="form-control" name="bairro" required>

									<label class="mb-2 text-muted" for="cep">CEP</label>
									<input id="cep" type="text" class="form-control" name="cep" required>

									<label class="mb-2 text-muted" for="cidade">Cidade</label>
									<input id="cidade" type="text" class="form-control" name="cidade" required>

									<label class="mb-2 text-muted" for="necessita_transporte">Necessita de transporte</label>
									<div class="form-check">
										<input class="form-check-input" type="radio" name="radioDefault" id="radioDefault1">
										<label class="form-check-label" for="radioDefault1">Sim</label>
									</div>
									<div class="form-check">
										<input class="form-check-input" type="radio" name="radioDefault" id="radioDefault2" checked>
										<label class="form-check-label" for="radioDefault2">Não</label>
									</div>

								</div>

							</div>

							<div class="align-items-center d-flex mt-4">
								<button type="submit" class="btn btn-primary ms-auto">Registrar</button>
							</div>

						</form>

					</div>
				</div>

				<div class="text-center mt-5 text-muted">
					Copyright © 2025 — Your Company
				</div>

			</div>
		</div>
	</div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
