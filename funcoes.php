<?php

    function cadastrarArquivo($dados ,string $arquivo){
        $fluxo;

        if(file_exists("$arquivo")){
            $fluxo = fopen("$arquivo", "a");
            fwrite($fluxo, "\n");
        }
        else{
            $fluxo = fopen("$arquivo", "w");
        }

        for($i = 0; $i < count($dados); $i++){
            fwrite($fluxo, "$dados[$i]");
            if($i != count($dados)-1){
                fwrite($fluxo, "\n");
            }
        }

        fclose($fluxo);

    }

    function estaVazio($dados){
        $error = 0;
        foreach($dados as $dado){
            if($dado == ""){
                $error++;
            }
        }
        if($error > 0){
            return true;
        }
        else{
            return false;
        }
    }

    function validarValoresCadastro($input1, $input2, $input3){
        if(!filter_var($input1, FILTER_VALIDATE_INT)){
            return false;
        }
        else if(!filter_var($input2, FILTER_VALIDATE_FLOAT)){
            return false;
        }
        else if(!filter_var($input3, FILTER_VALIDATE_FLOAT)){
            return false;
        }
        else{
            return true;
        }
    }
    
    function validarValoresLogin($input1){
        if(!filter_var($input1, FILTER_VALIDATE_EMAIL)){
            return false;
        }
        else{
            return true;
        }
    }

?>