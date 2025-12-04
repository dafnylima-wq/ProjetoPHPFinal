<?php
session_start();
include('conexao.php');

// ===================================
// ========= PADRONIZAÇÃO ============
// ===================================

// Mapa de equivalência para padronizar cursos
$mapaPadraoCurso = [
    "adm" => "Administração",
    "administração" => "Administração",
    "administracao" => "Administração",

    "informática" => "Informática",
    "informatica" => "Informática",

    "enfermagem" => "Enfermagem",

    "desenvolvimento de sistemas" => "Desenvolvimento de Sistemas",
    "ds" => "Desenvolvimento de Sistemas"
];

// Função para padronizar texto
function normalizar($str){
    return strtolower(trim($str));
}

// Função para contar alunos por curso padronizado
function getQtdPorCurso($conexao, $cursoNome) {
    $cursoNome = normalizar($cursoNome);
    $query = mysqli_query(
        $conexao,
        "SELECT COUNT(*) AS total 
         FROM register 
         WHERE LOWER(TRIM(curso)) = '$cursoNome'"
    );
    return mysqli_fetch_assoc($query)['total'] ?? 0;
}

// ===================================
// ======= GRÁFICO DE CURSOS =========
// ===================================

$cursosQuery = mysqli_query(
    $conexao, 
    "SELECT curso, COUNT(*) AS total FROM register GROUP BY curso"
);

$cursoTemp = [];

while($row = mysqli_fetch_assoc($cursosQuery)){
    $key = normalizar($row["curso"]);
    $cursoPadrao = $mapaPadraoCurso[$key] ?? $row["curso"];

    if(!isset($cursoTemp[$cursoPadrao])){
        $cursoTemp[$cursoPadrao] = 0;
    }
    $cursoTemp[$cursoPadrao] += $row["total"];
}

$cursos = array_keys($cursoTemp);
$cursosQtd = array_values($cursoTemp);

// ===================================
// ========== CARDS ==================
// ===================================

$qtdDS   = getQtdPorCurso($conexao, 'Desenvolvimento de Sistemas');
$qtdINFO = getQtdPorCurso($conexao, 'Informática');
$qtdADM  = getQtdPorCurso($conexao, 'Administração');
$qtdENFE = getQtdPorCurso($conexao, 'Enfermagem');

$qtdAlunos = mysqli_fetch_assoc(
    mysqli_query($conexao, "SELECT COUNT(*) AS total FROM register")
)['total'];

// ===================================
// ======= OUTROS GRÁFICOS ===========
// ===================================

// Cidade
$cidadeQuery = mysqli_query($conexao, 
    "SELECT cidade, COUNT(*) AS total FROM register GROUP BY cidade ORDER BY total DESC"
);
$cidades = $cidadesQtd = [];
while($row = mysqli_fetch_assoc($cidadeQuery)){
    $cidades[] = $row["cidade"];
    $cidadesQtd[] = $row["total"];
}

// Responsável
$responsavelQuery = mysqli_query($conexao, 
    "SELECT tipo_responsavel, COUNT(*) AS total FROM register GROUP BY tipo_responsavel"
);
$responsavel = $responsavelQtd = [];
while($row = mysqli_fetch_assoc($responsavelQuery)){
    $responsavel[] = $row["tipo_responsavel"];
    $responsavelQtd[] = $row["total"];
}

// Bairro (top 10)
$bairroQuery = mysqli_query($conexao, 
    "SELECT bairro, COUNT(*) AS total FROM register GROUP BY bairro ORDER BY total DESC LIMIT 10"
);
$bairros = $bairrosQtd = [];
while($row = mysqli_fetch_assoc($bairroQuery)){
    $bairros[] = $row["bairro"];
    $bairrosQtd[] = $row["total"];
}

// Transporte
$transporteQuery = mysqli_query($conexao, 
    "SELECT necessita_transporte, COUNT(*) AS total FROM register GROUP BY necessita_transporte"
);
$transporteLabels = $transporteQtd = [];
while($row = mysqli_fetch_assoc($transporteQuery)){
    $transporteLabels[] = ($row["necessita_transporte"] == 1) ? "Sim" : "Não";
    $transporteQtd[] = $row["total"];
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Painel de Alunos</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
body{ background:#f5f7fb; }
.card-dashboard{ background:white; padding:20px; border-radius:10px; box-shadow:0 4px 10px rgba(0,0,0,0.1); margin-bottom:20px; }
.titulo-card{ font-size:16px; font-weight:600; }
.valor-card{ font-size:35px; font-weight:bold; color:#007bff; }
.card-ds .valor-card{ color:#28a745; }
.card-info .valor-card{ color:#ffc107; }
.card-adm .valor-card{ color:#dc3545; }
.card-enfe .valor-card{ color:#17a2b8; }
canvas{ height:250px !important; }

.navbar-custom {
    background-color: rgba(33, 37, 41, 1) !important;
}
.navbar-custom .navbar-brand {
    color: white !important;
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

<div class="container mt-4">

    <!-- CARDS -->
    <div class="row text-center g-4 justify-content-center">
        <div class="col-md-2"><div class="card-dashboard"><div class="titulo-card">Total de Alunos</div><div class="valor-card"><?= $qtdAlunos ?></div></div></div>
        <div class="col-md-2"><div class="card-dashboard card-ds"><div class="titulo-card">Desenvolvimento de Sistemas</div><div class="valor-card"><?= $qtdDS ?></div></div></div>
        <div class="col-md-2"><div class="card-dashboard card-info"><div class="titulo-card">Informática</div><div class="valor-card"><?= $qtdINFO ?></div></div></div>
        <div class="col-md-2"><div class="card-dashboard card-adm"><div class="titulo-card">Administração</div><div class="valor-card"><?= $qtdADM ?></div></div></div>
        <div class="col-md-2"><div class="card-dashboard card-enfe"><div class="titulo-card">Enfermagem</div><div class="valor-card"><?= $qtdENFE ?></div></div></div>
    </div>

    <hr>

    <!-- GRÁFICOS LINHA 1 -->
    <div class="row text-center g-4">
        <div class="col-md-3"><div class="card-dashboard"><div class="titulo-card">Distribuição de Cursos</div><canvas id="graficoCurso"></canvas></div></div>
        <div class="col-md-3"><div class="card-dashboard"><div class="titulo-card">Tipo de Responsável</div><canvas id="graficoResponsavel"></canvas></div></div>
        <div class="col-md-6"><div class="card-dashboard"><div class="titulo-card">Alunos por Cidade</div><canvas id="graficoCidade"></canvas></div></div>
    </div>

    <!-- GRÁFICOS LINHA 2 -->
    <div class="row text-center g-4">
        <div class="col-md-6"><div class="card-dashboard"><div class="titulo-card">Alunos por Bairro (Top 10)</div><canvas id="graficoBairro"></canvas></div></div>
        <div class="col-md-6"><div class="card-dashboard"><div class="titulo-card">Necessita Transporte</div><canvas id="graficoTransporte"></canvas></div></div>
    </div>
</div>

<script>
const newColors = ['#28a745','#ffc107','#dc3545','#17a2b8','#6f42c1','#fd7e14','#007bff','#e83e8c'];

new Chart(document.getElementById('graficoCurso'), {
    type:'pie',
    data:{ labels: <?= json_encode($cursos) ?>, datasets:[{ data: <?= json_encode($cursosQtd) ?>, backgroundColor:newColors }] },
    options:{ responsive:true, maintainAspectRatio:false }
});

new Chart(document.getElementById('graficoResponsavel'), {
    type:'doughnut',
    data:{ labels: <?= json_encode($responsavel) ?>, datasets:[{ data: <?= json_encode($responsavelQtd) ?>, backgroundColor:newColors.slice(0,3) }]},
    options:{ responsive:true, maintainAspectRatio:false }
});

new Chart(document.getElementById('graficoCidade'), {
    type:'bar',
    data:{ labels: <?= json_encode($cidades) ?>, datasets:[{ label:"Alunos", data: <?= json_encode($cidadesQtd) ?>, backgroundColor:'#007bff' }]},
    options:{ responsive:true, maintainAspectRatio:false, scales:{y:{beginAtZero:true}}, plugins:{legend:{display:false}} }
});

new Chart(document.getElementById('graficoBairro'), {
    type:'bar',
    data:{ labels: <?= json_encode($bairros) ?>, datasets:[{ label:"Alunos", data: <?= json_encode($bairrosQtd) ?>, backgroundColor:'#28a745' }]},
    options:{ responsive:true, maintainAspectRatio:false, scales:{y:{beginAtZero:true},x:{ticks:{autoSkip:false,maxRotation:45,minRotation:45}}}, plugins:{legend:{display:false}} }
});

new Chart(document.getElementById('graficoTransporte'), {
    type:'doughnut',
    data:{ labels: <?= json_encode($transporteLabels) ?>, datasets:[{ data: <?= json_encode($transporteQtd) ?>, backgroundColor:['#17a2b8','#ffc107'] }]},
    options:{ responsive:true, maintainAspectRatio:false, plugins:{legend:{position:'right'}} }
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
