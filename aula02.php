<?php
    # cuidado ao criar varaveis vazias
    $nome = "Renato";
    #$nome = " ";
    echo $nome;
    # define a variavel como global (essa cariavel pode ser acessada que qualquer lugar do codigo)
    $GLOBALS['nome'] = "Renato";
    echo $GLOBALS['nome'];

    # cria constantes (Não podem ser modificadas)
    const novonome = "Renato";
    define($nome, "Renato");

    /************************
     * Operadores matemáticos
    ************************
    Adição -> +
    Subtração -> -
    Divisão -> /
    Multiplação -> *
    Resto de divisão -> %
    Exponenciação -> **

    */
    echo "<hr>";
    $a = 10;
    $b = 5;

    echo "Valor:", $a;
    echo "<hr>";
    echo "Valor:", $b;

    # soma
    $c = $a + $b;
    echo "<hr>";
    echo "Resultado:", $c;

    # subtração
    $c = $a - $b;
    echo "<hr>";
    echo "Resultado:", $c;
     
    # multiplicação
    $c = $a * $b;
    echo "<hr>";
    echo "Resultado:", $c;

    # divisao
    $c = $a / $b;
    echo "<hr>";
    echo "Resultado:", $c;
    echo "<hr>";

    # Arrays indexado
    # Os arrays são coleções de dados ou estruturas de dados
    $Nomes = ["Diego", "Vitor", "Leonardo", "Joao", "Joarez"];

    echo $Nomes[2];
    echo "<hr>";

    $Numeros = [1200, 1550, 1253, 91234];
    echo $Numeros[3];
    echo "<hr>";

    # Arrays associativos
    $Pessoas = [
        "Nome" => "João",
        "Idade" => 30,
        "Cidade" => "São Paulo"    
    ];
    echo "<br>" . $Pessoas["Nome"];

    # Estrururas de condição - IF - ELSE
    $idade = 18;

    ####### testando varias condições #####
    if($idade >= 18){
        echo "<br>" . "Maior de idade";
    }
    if($idade == 18){
        echo "<br>" . "Voce tem a mesma idade";
    }
    if($idade <= 16){
        echo "<br>" . "Voce e um adolecente";
    }
    ###### testando no maximo duas true ou false ########
    if($idade >= 18){
        # se retornar verdadeiro executa esse bloco
        echo "<hr>" . "Você é maior de idade";
    }
    else{
        # se retornar verdadeiro executa esse bloco
        echo "<hr>" . "Você é menor de idade";
    }
    ######## testando varias condições usando elseif #######
    # quando queremos varias condições
    echo "<hr>";
    $Nota = 7.5;

    if($Nota >= 9){
        Echo "Excelente";
    }

    elseif($Nota >= 7){
        echo "Aprovado";
    }

    elseif($Nota >= 5){
        echo "Recuperação";
    }

    else{
        echo "Reprovado";
    }

    # usando swith para validar varias condições
    $dia = 6;
    echo "<hr>";
    switch ($dia) {
        case 1: # bloco que é executado conforme a variavel
            echo "Domingo";
            break;  # para a execução

        case 2:
            echo "Segunda-feira";
            break;

        case 3:
            echo "Terça-feira";
            break;  
       
        # 1. Sera executado sempre se não haver break
        # 2. Se o valor estiver fora dos case
        default:    
            echo "Dia invalido";
    }  
   
    $usuario = "admin";
    $senha = "1234";

    echo "<hr>";

    if($usuario == "admin"){
        if($senha == "1234"){
            echo "Bem vindo";
        }else{
            echo "Senha errada";
        }
    }else{
        echo "Usuario errado";
    }

    echo "<hr>";
    # logica ou - um numero somado com ele mesmo e ele mesmo
    # ou
    if($usuario == "admin" || $senha == "1234"){
        echo "Bem vindo";
    }else{
        echo "Usuario ou senha errado";
    }
    # logica ou - um numero multiplicado por zero e zero
    # and
    echo "<hr>";
    if($usuario == "admin" && $senha == "1234"){
        echo "Bem vindo";
    }else{
        echo "Usuario ou senha errado";
    }
   
    echo "<hr>";
    # negação
    $Interruptor = true;
    echo $Interruptor;
   
    # porta logica not
    echo !($Interruptor);

?>
