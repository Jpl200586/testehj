Pular para o conteúdo principal
Google Sala de Aula
Sala de Aula
Programador BackEnd
Qualificação
Início
Agenda
Minhas inscrições
Pendentes
P
Programador BackEnd
Qualificação
Turmas arquivadas
Configurações
Mural
Atividades
Pessoas
Programador BackEnd Qualificação – Sala de Aula
Programador BackEnd
Qualificação
Próximas atividades
Nenhuma atividade para a próxima semana!

Postada por Diego Paiani
Diego Paiani
Criado em: 15:3415:34
Exemplos criados na aula do dia 15/06
aula05.php
PHP


Postada por Diego Paiani
Diego Paiani
Criado em: 11 de jun.11 de jun.
Exercicios de strings e condicionais

16. Crie um programa que leia duas palavras e as concatene, exibindo a palavra resultante.
17. Faça um programa que receba uma palavra e exiba cada letra separadamente.
18. Crie um programa que receba uma frase e substitua todas as letras "a" por "e".
19. Escreva um programa que receba um nome e verifique se o mesmo começa com a letra "A".
20. Faça um programa que leia uma palavra e verifique se a mesma é palíndromo (se pode ser lida da mesma forma de trás para frente).
21. Crie um programa que leia duas palavras e verifique se a segunda palavra é um anagrama da primeira.
22. Escreva um programa que receba um nome completo e exiba somente o primeiro nome.
23. Faça um programa que receba uma frase e exiba a quantidade de espaços em branco presentes na mesma.
24. Crie um programa que leia uma palavra e exiba a quantidade de vogais presentes na mesma.
25. Escreva um programa que receba um nome completo e exiba o sobrenome (último nome) primeiro.
26. Faça um programa que solicite a idade de uma pessoa e exiba se ela é maior de idade ou não.
27. Faça um programa que leia dois números e informe qual é o maior.
28. Escreva um programa que solicite três números ao usuário e exiba o maior deles.
29. Faça um programa que leia um número e informe se ele é par ou ímpar.
30. Faça um programa que leia um número e informe se ele é positivo, negativo ou zero.

Postada por Diego Paiani
Diego Paiani
Criado em: 11 de jun.11 de jun.
Funções de arrays
aula04.php
PHP


Postada por Diego Paiani
Diego Paiani
Criado em: 11 de jun.11 de jun.
Solução dos exercicios da lista 01
Solucao01.php
PHP


Postada por Diego Paiani
Diego Paiani
Criado em: 9 de jun.9 de jun.
1.introdução e história
2.instalação
3.comentarios
4.variaveis
5.escopo de variaveis
6.echo e print
7.tipos de dados
8.strings
9.numbers
10.casting
11.math
12.constantes
13.operadores
14.condicionais - if - else - elseif
15.switch
17.laços de repetição - foreach - for - do...while - while - break - continue
18.funções
19.arrays
20.superglobais
21.expressões regulares(busca)
22.funções de data e hora
23.manipulação de arquivos
24.cookies
25.sessão
26.filtros
27.funções de retorno
28.json
29.exceções
30.poo classes e objetos
31.construtor e destrutor
32.modificadores de acesso -> public, protected, private
33.herança e polimorfismo
34.constantes de classes
35.constantes mágicas
36.classes abstratas

Postada por Diego Paiani
Diego Paiani
Criado em: 9 de jun.9 de jun.
arquivo da ultima aula do PHP
aula03.php
PHP


Postada por Diego Paiani
Diego Paiani
Criado em: 9 de jun.9 de jun.
1. Escreva um programa que solicite ao usuário dois números e exiba a soma, subtração, multiplicação e divisão entre eles.
2. Escreva um programa que calcule a média aritmética de dois números.
3. Crie um programa que calcule e exiba a média aritmética de três notas informadas pelo usuário.
5. Escreva um programa que calcule o IMC de um indivíduo, utilizando a fórmula IMC = peso / altura²
6. Crie um programa que calcule e exiba o perímetro de um círculo, solicitando o raio ao usuário.
7. Escreva um programa que calcule a área de um círculo a partir do raio, utilizando a fórmula A = πr²
8. Escreva um programa que calcule a equação de segundo grau (ax² + bx + c = 0) utilizando as fórmulas de Bhaskara.
9. Escreva um programa que calcule o perímetro e a área de um retângulo, utilizando as fórmulas P = 2(l + c) e A = lc, onde l é a largura e c é o comprimento.
10. Escreva um programa que calcule o perímetro e a área de um triângulo, utilizando as fórmulas P = a + b + c e A = (b * h) / 2, onde a, b e c são os lados do triângulo e h é a altura relativa ao lado b.

Postada por Diego Paiani
Diego Paiani
Criado em: 8 de jun.8 de jun.
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

Postada por Diego Paiani
Diego Paiani
Criado em: 3 de jun.3 de jun.
Codigo da primeira aula de php
aula02.php
PHP

aula01.php
PHP


Postada por Diego Paiani
Diego Paiani
Criado em: 3 de jun.3 de jun.
https://drive.google.com/drive/folders/1GklaN3dM4gHPyQl3ncswhadoAPeCXLBP?usp=sharing
Mural
<?php
# CONTINUANDO COM AS FUNÇÕES
# criando funcoes anonimas

# funcao tradicional
function Somar($a, $b){
    return $a + $b;
}
echo Somar(10, 20);

# funcao anonima - ela e salva dentro de uma variavel, bloco deve ser encerrado com ;
$somar = function($a, $b){
    return $a + $b;
};
echo "<br>";
echo $somar(10,20);
echo "<br>";
# callback - uma funcao chama outra(s) - significa que a funcao aguarda a execucao da proxima

$numeros = [1,2,3,4,5];

$Resultado = array_map(function ($numero) {return $numero * 2;}, $numeros);

foreach($Resultado as $item){
    echo $item;
}
echo "<br>";

# outro exemplo de callback
function executar($callback) {
    $callback();
}

$mensagem = function() {
    echo "Olá, mundo!";
};

executar($mensagem); # a funcao executar recebe uma funcao como parametro
echo "<br>";

# RECURSIVIDADE - funcao que ela mesma 
# recursividade em funções - a funcao chama a si mesma como um loop de repeticao
function contagemRegressiva($numero){
    if ($numero == 0) {
        return;
    }

    echo $numero . "<br>";

    contagemRegressiva($numero - 1);
}

contagemRegressiva(5);
echo "<br>";

# Funcao flexa -> arrow function
$somar = fn($a, $b) => $a + $b;

# usando variavais dentro do escopo da funcao (apenas para funcoes anonimas)
$taxa = 0.10;

$calculaPreco = function($preco) use ($taxa){
    return $preco + ($preco * $taxa);
};

# swith - case
$dia = "4";

switch($dia){
    case 1:
        echo "Domingo";
        break;

    case 2:
        echo "Segunda";
        break;

    case 3:
        echo "terça";
        break;

    case 4:
        echo "quarta";
        break;

    default:
        echo "Dia inválido";
}
echo "<br>";

# usando a biblioteca math
$dia = "2";

$resultado = match($dia){
    1 => "Domingo",
    2 => "Segunda",
    3 => "Terca",
    4 => "Quarta",
    default => "Dia inválido"
};
echo "<br>";
echo $resultado;
# o math tem segurança maior com os tipos de dados

# operador ??
# checa se nao e nullo
echo "<br>";
$nome = null;

echo $nome ?? "Visitante";

# outras formas de fazer a mesma coisa
echo "<br>";
$variavel = null;

if ($variavel === null) {
    echo "E nulo";
}else{
    echo "Nao e nulo";
}

# verifica se uma variavel existe e possui o valor nulo
echo "<br>";
if(is_null($variavel)){
    echo "E nulo";
}

# verifica se uma variavel existe e nao possui i valor null
echo "<br>";
if(isset($_POST['nome'])){
    $nome = $_POST['nome'];
}else{
    $nome = "Usuario nao informado";
}
echo $nome;

$valor = null;
echo "<br>";
var_dump(is_null($valor)); # true
echo "<br>";
var_dump(isset($valor));

# superglobais - sao variaveis especiais do PHP que podem
# ser acessadas em qualquer lugar do codigo sem precisar usar uma
# global

/**
 * $_GET - Recebe os dados pela url
 * $_POST
 * $_REQUEST
 * $_SERVER
 * $_FILES
 * $_COOKIE
 * $_SESSION
 * $_ENV
 * $_GLOBALS
 */


# passa os dados pela url
echo "<br>";
echo $_GET['nome'];
echo "<br>";
echo $_GET['idade'];

# passa os dados pelo protocolo http
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    echo "<br>";
    echo "Nome: " . $_POST['nome'];
    echo "<br>";
    echo "Idade: " . $_POST['idade'];
    echo "<br>";
}

?>
<form method="POST">
    Nome:
    <input type="text" name="nome">
    Idade:
    <input type="text" name="idade">
    <br><br>
    <input type="submit">
</form>
aula05.php
Exibindo aula05.php…