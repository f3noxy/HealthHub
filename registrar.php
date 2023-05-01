<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./html/style.css" rel="stylesheet">
    <title>Registrar</title>
</head>
<body>
    <?php

        include("funcoes.php");

        $response = "";
        $deslogadoResponse = "";

        if(isset($_GET["deslogado"])){
            $deslogadoResponse = "Erro - por favor faça o cadastro ou login para acessar o sistema.";
        }

        if($_SERVER["REQUEST_METHOD"] == "POST"){

            $dados = [$_POST["email"], htmlspecialchars(trim($_POST["senha"]))];
            $senhaRepetida = htmlspecialchars(trim($_POST["senhaRepetida"]));

            if(estaVazio($dados) == false and validarValoresLogin($dados[0]) != false and $dados[1] == $senhaRepetida){

                $dadosLogin = [];
                $validation = 0;
                $fluxo = fopen("usuarios_registrados.txt", "r");

                while(!feof($fluxo)){
                    $dadosLogin[0] = fgets($fluxo);
                    $dadosLogin[1] = fgets($fluxo);
        
                    if(strcasecmp($dadosLogin[0], $dados[0])-1 == 0){
                        $validation++;
                    }

                }

                
                fclose($fluxo);

                if($validation > 0){

                    $response = "Erro - email já cadastrado.";

                }
                else{

                    cadastrarArquivo($dados,"usuarios_registrados.txt");
                    $response = "Registro realizado com sucesso!";

                }

            }
            else if($dados[1] != $senhaRepetida){

                $response = "Erro - as senhas digitas são diferentes, por favor digite senhas iguais.";

            }
            else if (estaVazio($dados) == true){

                $response = "Erro - Preencha todos os campos do formulário.";

            }
            else if(validarValoresLogin($dados[0]) == false){

                $response = "Erro - Preencha os campos de registro com os dados pedidos.";

            }

        }
    ?>
    
    <div class="container-login">
        <div class="content-box">
            <div class="form-box">
                <h2>Registro</h2>
                <form action="registrar.php" method="post">
                    <div class="input-box">
                        <input type="email" name="email" placeholder="@mail.com" required> <br><br>
                    </div>
                    <div class="input-box">
                        <input type="password" name="senha" placeholder="senha" required> <br><br>
                    </div>
                    <div class="input-box">
                        <input type="password" name="senhaRepetida" placeholder="senha" required> <br><br>
                    </div>
                    <div class="input-box">
                        <button>Registrar</button><br><br><br>
                    </div>
                    <div class="input-box">
                        <p>Já possui uma conta? <a href="http://localhost/Projeto/login.php">Login</a></p>
                    </div>
                </form>
                <p class="response"><?=$response?></p>
                <p class="response"><?=$deslogadoResponse?></p>
            </div>
        </div>
        <div class="img-box">
            <img src="img/unipe.webp">
        </div>
    </div>
    <?php include_once "./html/footer.html"?>
</body>
</html>