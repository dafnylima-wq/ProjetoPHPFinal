<?php
session_start();
include('conexao.php');


// --- Verifica se o ID foi passado ---
if (!isset($_GET['id'])) {
    $_SESSION['mensagem'] = "Aluno não encontrado!";
    header("Location: alunos.php");
    exit();
}

$id = intval($_GET['id']);

// --- Busca aluno pelo ID ---
$sql = "SELECT * FROM register WHERE id = $id";
$result = mysqli_query($conexao, $sql);
$aluno = mysqli_fetch_assoc($result);

if (!$aluno) {
    $_SESSION['mensagem'] = "Aluno não existe!";
    header("Location: alunos.php");
    exit();
}

// --- Função para exibir nome formal do curso ---
function nomeCurso($curso) {
    $cursos = [
        "adm" => "Administração",
        "info" => "Informática",
        "ads" => "Análise e Desenvolvimento de Sistemas",
        "contabilidade" => "Contabilidade",
        "enfermagem" => "Enfermagem"
    ];

    return $cursos[strtolower($curso)] ?? ucfirst($curso);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<title>Editar Aluno</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
  
</style>
</head>
<body>

<section class="h-100 mt-4">
    <div class="container h-100">
       <nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-custom">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Home</a>
        <a class="navbar-brand" href="telacadastro.php">Cadastro</a>
        <a class="navbar-brand" href="menu.php">Logout</a>
        <a class="navbar-brand" href="painel.php">Painel de Estatísticas</a>
        <a class="navbar-brand" href="alunos.php">Alunos</a>
    </div>
</nav>
        <div class="row justify-content-sm-center h-100">
            <div class="col-12 col-lg-10 col-xl-8">

                <div class="card shadow-lg">
                    <div class="card-body p-5">

                        <h1 class="fs-4 card-title mb-4">Editar Aluno</h1>

                        <!-- FORM DE EDIÇÃO -->
                        <form action="salvar_alteracoes.php" method="POST">

                            <input type="hidden" name="id" value="<?= $aluno['id'] ?>">

                            <div class="row g-3">

                                <div class="col-md-6">
                                    <label class="form-label">Nome Completo</label>
                                    <input type="text" class="form-control" name="nome" value="<?= $aluno['nome'] ?>" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Data de Nascimento</label>
                                    <input type="date" class="form-control" name="data_nasc" value="<?= $aluno['data_nasc'] ?>" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Rua</label>
                                    <input type="text" class="form-control" name="rua" value="<?= $aluno['rua'] ?>" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Número</label>
                                    <input type="text" class="form-control" name="numero_casa" value="<?= $aluno['numero_casa'] ?>" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Bairro</label>
                                    <input type="text" class="form-control" name="bairro" value="<?= $aluno['bairro'] ?>" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">CEP</label>
                                    <input type="text" class="form-control" name="cep" value="<?= $aluno['cep'] ?>" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Cidade</label>
                                    <input type="text" class="form-control" name="cidade" value="<?= $aluno['cidade'] ?>" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Nome do Responsável</label>
                                    <input type="text" class="form-control" name="responsavel" value="<?= $aluno['responsavel'] ?>" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Tipo Responsável</label>
                                    <select class="form-select" name="tipo_responsavel" required>
                                        <option <?= $aluno['tipo_responsavel'] == 'Mãe' ? 'selected' : '' ?>>Mãe</option>
                                        <option <?= $aluno['tipo_responsavel'] == 'Pai' ? 'selected' : '' ?>>Pai</option>
                                        <option <?= $aluno['tipo_responsavel'] == 'Avô/Avó' ? 'selected' : '' ?>>Avô/Avó</option>
                                        <option <?= $aluno['tipo_responsavel'] == 'Tio/Tia' ? 'selected' : '' ?>>Tio/Tia</option>
                                        <option <?= $aluno['tipo_responsavel'] == 'Outro' ? 'selected' : '' ?>>Outro</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Curso</label>
                                    <select class="form-select" name="curso" required>
                                        <?php
                                        $cursos = ['adm', 'info', 'ads', 'contabilidade', 'enfermagem'];
                                        foreach ($cursos as $c) {
                                            $selected = ($aluno['curso'] == $c) ? "selected" : "";
                                            echo "<option value='$c' $selected>".nomeCurso($c)."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Necessita Transporte?</label>
                                    <select class="form-select" name="necessita_transporte" required>
                                        <option <?= $aluno['necessita_transporte'] == 'Sim' ? 'selected' : '' ?>>Sim</option>
                                        <option <?= $aluno['necessita_transporte'] == 'Não' ? 'selected' : '' ?>>Não</option>
                                    </select>
                                </div>

                                <div class="col-md-12 d-flex justify-content-end mt-3">
                                    <button type="submit" class="btn btn-primary px-4">Salvar Alterações</button>
                                </div>

                            </div>
                        </form>
                        <!-- FORM TERMINA -->

                    </div>
                </div>
                    <div class="text-center mt-5 text-muted">
						Copyright &copy; 2025 &mdash; Your Company 
					</div>
            </div>
        </div>
    </div>
</section>

</body>
</html>
