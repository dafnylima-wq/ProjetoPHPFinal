<?php
include('conexao.php');

$result = mysqli_query($conexao, "SELECT DISTINCT curso FROM register");

echo "<h2>Valores reais na coluna 'curso'</h2>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<pre>";
    var_dump($row['curso']);
    echo "</pre>";
}
