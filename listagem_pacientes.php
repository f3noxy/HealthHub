<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./html/style.css" rel="stylesheet">
    <title>Listagem Pacientes</title>
</head>
<body>
    <?php

        session_start();

        if(!isset($_SESSION["email"])){

            header("Location: registrar.php?deslogado=true");
        
        }

    ?>
    <?php include_once "./html/header.html"?>
    <br><br>
    <table>
        <tr>
            <th>Nome</th>
            <th>Idade</th>
            <th>Peso</th>
            <th>Altura</th>
            <th>IMC</th>
        </tr>
        <?php
            $fluxo = fopen("pacientes_cadastrados.txt", "r");
            while(!feof($fluxo)){
                $nome = fgets($fluxo);
                $idade = (int) fgets($fluxo);
                $peso = (float) fgets($fluxo);
                $altura = (float) fgets($fluxo);
                $imc = $peso/($altura*$altura);
                $imc = number_format($imc, 2);
            ?>
            <tr>
                <td><?= $nome ?></td>
                <td><?= $idade ?></td>
                <td><?= $peso ?></td>
                <td><?= $altura ?></td>
                <td><?= $imc ?></td>
            </tr>
        <?php }
            fclose($fluxo);
        ?>
    </table>
    <?php include_once "./html/footer.html"?>
</body>
</html>