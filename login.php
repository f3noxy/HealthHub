<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./html/style.css" rel="stylesheet">
    <title>Login</title>
</head>
<body>
    <?php

        include("funcoes.php");

        $response = "";
        $logoutResponse = "";

        if(isset($_GET["logout"])){
            $logoutResponse = "Logout realizado com sucesso.";
        }

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $dados = [$_POST["email"], $_POST["senha"]];
            $dados[1] = htmlspecialchars(trim($dados[1]));

            if(estaVazio($dados) == false and validarValoresLogin($dados[0]) != false){

                $dadosLogin = [];
                $validation = 0;
                $fluxo = fopen("usuarios_registrados.txt", "r");

                while(!feof($fluxo)){
                    $dadosLogin[0] = fgets($fluxo);
                    $dadosLogin[1] = fgets($fluxo);
        
                    if(strcasecmp($dadosLogin[0], $dados[0])-1 == 0 and $dadosLogin[1] == $dados[1]){
                        $validation++;
                    }

                }
                
                fclose($fluxo);

                if($validation > 0){
                    session_start();

                    $_SESSION["email"] = $dados[0];
                    header("Location: cadastro_pacientes.php?login=true");

                }
                else{
                    
                    $response = "Erro - email ou senha inválidos.";

                }

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
        <div class="img-box">
            <img src="img/unipe.webp">
        </div>
        <div class="content-box">
            <div class="form-box">
                <h2>Login</h2>
                <form action="login.php" method="post">
                    <div class="input-box">
                        <input type="email" name="email" id="email" placeholder="@mail.com" required>
                    </div>
                    <div class="input-box">
                        <input type="password" name="senha" id="senha" placeholder="senha" required> <br><br>
                    </div>
                    <div class="input-box">
                        <button>Login</button> <br><br>
                    </div>
                    <div class="input-box">
                        <p>Não tem uma conta? <a href="http://localhost/Projeto/registrar.php">Inscrever-se</a></p>
                    </div>
                </form>
                <p class="response"><?=$response?></p>
                <p class="response"><?=$logoutResponse?></p>
                <?php include_once "./html/footer.html"?>
            </div>
        </div>
    </div>
</body>
</html>