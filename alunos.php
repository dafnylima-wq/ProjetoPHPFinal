<?php
session_start();
include('conexao.php');

// -------------------------------
// NORMALIZAÇÃO + MAPA DE CURSOS
// -------------------------------
function normalizar($txt) {
    return strtolower(trim($txt));
}

$mapaCursos = [
    "adm" => "Administração",
    "administração" => "Administração",
    "administracao" => "Administração",

    "informática" => "Informática",
    "informatica" => "Informática",

    "ds" => "Desenvolvimento de Sistemas",
    "desenvolvimento de sistemas" => "Desenvolvimento de Sistemas",

    "enfermagem" => "Enfermagem"
];

// Função para mostrar nome correto
function nomeCurso($curso) {
    global $mapaCursos;
    $key = normalizar($curso);
    return $mapaCursos[$key] ?? ucfirst($curso);
}

// -------------------------------
//   BUSCA E FILTROS
// -------------------------------
$busca = $_GET['buscar'] ?? "";
$filtro_curso = $_GET['curso'] ?? "";
$filtro_cidade = $_GET['cidade'] ?? "";

// Consulta principal
$sql = "SELECT id, nome, cidade, curso FROM register WHERE 1=1";

if ($busca !== "") {
    $buscaSQL = mysqli_real_escape_string($conexao, $busca);
    $sql .= " AND (nome LIKE '%$buscaSQL%' OR cidade LIKE '%$buscaSQL%' OR curso LIKE '%$buscaSQL%')";
}

if ($filtro_curso !== "") {
    $filtroSQL = mysqli_real_escape_string($conexao, $filtro_curso);
    $sql .= " AND LOWER(TRIM(curso)) = LOWER(TRIM('$filtroSQL'))";
}

if ($filtro_cidade !== "") {
    $cidSQL = mysqli_real_escape_string($conexao, $filtro_cidade);
    $sql .= " AND cidade = '$cidSQL'";
}

$result = mysqli_query($conexao, $sql);
if (!$result) die("Erro SQL: " . mysqli_error($conexao));

// -------------------------------
//   POPULAR FILTRO DE CURSO
// -------------------------------
$cursosResult = mysqli_query($conexao, "SELECT DISTINCT curso FROM register");
$cursosFiltrados = [];

while($c = mysqli_fetch_assoc($cursosResult)){
    $cursoNormal = nomeCurso($c['curso']);
    $cursosFiltrados[$cursoNormal] = $c['curso']; // valor real do banco
}
ksort($cursosFiltrados);

// Cidade
$cidadesResult = mysqli_query($conexao, "SELECT DISTINCT cidade FROM register ORDER BY cidade");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Lista de Alunos</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body { background: #f5f7fb; }
h2 { text-align:center; margin: 30px 0; font-weight:700; }

.navbar-custom {
    background-color: rgba(33, 37, 41, 1)!important; 
}
.navbar-custom .navbar-brand {
    color: white !important;
}

.btn-azul {
    background-color: #007bff;
    color: white;
}
.btn-azul:hover {
    background-color: #0062cc;
    color: white;
}
</style>

</head>
<body>

<!-- NAVBAR UNIFICADA -->
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

<div class="container mt-4">
    <h2>Lista de Alunos</h2>

    <!-- FORMULÁRIO DE BUSCA E FILTRO -->
    <form method="GET" class="row g-2 mb-3">
        
        <div class="col-md-4">
            <input type="text" name="buscar" class="form-control"
                   placeholder="Buscar aluno..."
                   value="<?= htmlspecialchars($busca) ?>">
        </div>

        <div class="col-md-3">
            <select name="curso" class="form-select">
                <option value="">Filtrar por curso</option>

                <?php foreach ($cursosFiltrados as $nomeExibicao => $valorBanco): ?>
                    <option value="<?= $valorBanco ?>"
                        <?= ($filtro_curso == $valorBanco) ? "selected" : "" ?>>
                        <?= $nomeExibicao ?>
                    </option>
                <?php endforeach; ?>

            </select>
        </div>

        <div class="col-md-3">
            <select name="cidade" class="form-select">
                <option value="">Filtrar por cidade</option>

                <?php while($cid = mysqli_fetch_assoc($cidadesResult)): ?>
                    <option value="<?= $cid['cidade'] ?>"
                        <?= ($filtro_cidade == $cid['cidade']) ? "selected" : "" ?>>
                        <?= ucfirst($cid['cidade']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="col-md-2 d-flex gap-2">
            <button class="btn btn-primary w-50">Buscar</button>
            <a href="alunos.php" class="btn btn-secondary w-50">Limpar</a>
        </div>

    </form>

    <!-- TABELA DE ALUNOS -->
    <?php if(mysqli_num_rows($result) > 0): ?>
    <table class="table table-bordered text-center">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Cidade</th>
                <th>Curso</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            <?php while($aluno = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $aluno['id'] ?></td>
                <td><?= $aluno['nome'] ?></td>
                <td><?= ucfirst($aluno['cidade']) ?></td>
                <td><?= nomeCurso($aluno['curso']) ?></td>
                <td>
                    <a href="editar.php?id=<?= $aluno['id'] ?>" class="btn btn-azul btn-sm">Editar</a>
                    <a href="excluir.php?id=<?= $aluno['id'] ?>" class="btn btn-danger btn-sm">Excluir</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <?php else: ?>
        <div class="alert alert-warning text-center">Nenhum aluno encontrado.</div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
