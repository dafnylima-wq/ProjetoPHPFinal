<?php
session_start();
include('conexao.php');

// Verificação dos campos obrigatórios
$required = [
    'nome','data_nasc','rua','responsavel','numero_casa',
    'bairro','cep','curso','tipo_responsavel','cidade', 'necessita_transporte', 'id'
];

foreach ($required as $campo) {
    if (!isset($_POST[$campo]) || trim($_POST[$campo]) == '') {
        $_SESSION['mensagem'] = "Preencha todos os campos!";
        header('Location: telacadastro.php');
        exit();
    }
}

// Sanitização
$nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
$data_nasc = mysqli_real_escape_string($conexao, trim($_POST['data_nasc']));
$rua = mysqli_real_escape_string($conexao, trim($_POST['rua']));
$responsavel = mysqli_real_escape_string($conexao, trim($_POST['responsavel']));
$numero_casa = mysqli_real_escape_string($conexao, trim($_POST['numero_casa']));
$bairro = mysqli_real_escape_string($conexao, trim($_POST['bairro']));
$cep = mysqli_real_escape_string($conexao, trim($_POST['cep']));
$curso = mysqli_real_escape_string($conexao, trim($_POST['curso']));
$tipo_responsavel = mysqli_real_escape_string($conexao, trim($_POST['tipo_responsavel']));
$cidade = mysqli_real_escape_string($conexao, trim($_POST['cidade']));
$necessita_transporte = mysqli_real_escape_string($conexao, trim($_POST['necessita_transporte']));
$id = mysqli_real_escape_string($conexao, trim($_POST['id']));


// Query de INSERT
$sql = "INSERT INTO register 
(nome, data_nasc, rua, responsavel, numero_casa, bairro, cep, curso, tipo_responsavel, cidade, necessita_transporte, id) 
VALUES 
('$nome', '$data_nasc', '$rua', '$responsavel', '$numero_casa', '$bairro', '$cep', '$curso', '$tipo_responsavel', '$cidade', '$necessita_transporte', '$id')";

if (mysqli_query($conexao, $sql)) {
    $_SESSION['mensagem'] = "Cadastro realizado com sucesso!";
    header('Location: painel.php');
    exit();
} else {
    $_SESSION['mensagem'] = "Erro ao cadastrar: " . mysqli_error($conexao);
    header('Location: telacadastro.php');
    exit();
}
?>
