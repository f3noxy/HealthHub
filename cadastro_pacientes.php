<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./html/style.css" rel="stylesheet">
    <title>Cadastro Pacientes</title>
</head>
<body>
    <?php 
        
        include("funcoes.php");

        $response = "";
        $loginResponse = "";

        session_start();

        if(!isset($_SESSION["email"])){

            header("Location: registrar.php?deslogado=true");
        
        }

        if(isset($_GET["login"])){

            $loginResponse = "Login realizado com sucesso!";

        }

        if($_SERVER["REQUEST_METHOD"] == "POST"){

            $dados = [$_POST["nome"], $_POST["idade"], $_POST["peso"], $_POST["altura"]];
            $dados[0] = htmlspecialchars(trim($dados[0]));

            if(estaVazio($dados) == false and validarValoresCadastro($dados[1], $dados[2], $dados[3]) != false){

                cadastrarArquivo($dados,"pacientes_cadastrados.txt");
                $response = "Cadastro realizado com sucesso!";

            }
            else if (estaVazio($dados) == true){

                $response = "Erro - Preencha todos os campos do formulário.";

            }
            else if(validarValoresCadastro($dados[1], $dados[2], $dados[3]) == false){

                $response = "Erro - Preencha o formulário com os dados requisitados.";

            }
            
        
        }
    
    ?>
    <div class="container-login">
        <div class="content-box">
            <div class="form-box">
                <?php include_once "./html/header.html"?>
                <h2>CADRASTAR PACIENTE</h2>
                <form action="cadastro_pacientes.php" method="post">
                    <div class="input-box">
                        <span>Digite o nome</span>
                        <input type="text" name="nome" placeholder="nome" required><br><br>
                    </div>

                    <div class="input-box">
                        <span>Digite a idade</span>
                        <input type="number" name="idade" placeholder="idade" required><br><br>
                    </div>

                    <div class="input-box">
                        <span>Digite o peso</span>
                        <input type="number" name="peso" step="0.01" placeholder="peso" required><br><br>
                    </div>

                    <div class="input-box">
                        <span>Digite a altura</span>
                        <input type="number" name="altura" step="0.01" placeholder="altura" required><br><br>
                    </div>

                    <div class="input-box">
                        <button>Cadastrar</button>
                    </div>
                </form>
                <p class="response"><?=$response?></p>
                <p class="response"><?=$loginResponse?></p>
            </div>
        </div>
        <div class="img-box">
            <img src="img/unipe.webp">
        </div>
    </div>
    <?php include_once "./html/footer.html"?>
</body>
</html>