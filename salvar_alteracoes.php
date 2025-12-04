<?php
session_start();
include('conexao.php');

$id = $_POST['id'];

$nome = $_POST['nome'];
$data_nasc = $_POST['data_nasc'];
$rua = $_POST['rua'];
$responsavel = $_POST['responsavel'];
$numero_casa = $_POST['numero_casa'];
$bairro = $_POST['bairro'];
$cep = $_POST['cep'];
$curso = $_POST['curso'];
$tipo_responsavel = $_POST['tipo_responsavel'];
$cidade = $_POST['cidade'];
$necessita_transporte = $_POST['necessita_transporte'];



$sql = "UPDATE register SET 
        nome='$nome',
        data_nasc='$data_nasc',
        rua='$rua',
        responsavel='$responsavel',
        numero_casa='$numero_casa',
        bairro='$bairro',
        cep='$cep',
        curso='$curso',
        tipo_responsavel='$tipo_responsavel',
        cidade='$cidade',
        necessita_transporte='$necessita_transporte'
        
        WHERE id = $id";

if (mysqli_query($conexao, $sql)) {
    $_SESSION['mensagem'] = "Atualizado com sucesso!";
    header("Location: alunos.php");
} else {
    $_SESSION['mensagem'] = "Erro ao atualizar!";
    header("Location: editar.php?id=$id");
}