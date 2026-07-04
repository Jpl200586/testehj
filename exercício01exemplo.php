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
Mural atualizado
Programador BackEnd
Qualificação
Próximas atividades
Nenhuma atividade para a próxima semana!

Postada por Diego Paiani
Diego Paiani
Criado em: 13:2213:22
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

Postada por Diego Paiani
Diego Paiani
Criado em: 3 de jun.3 de jun.
1. Linguagem Interpretada
2. Código Embutido em HTML
3. Código Aberto (Open Source)
4. Multiplataforma
5. Suporte a Diversos Bancos de Dados
6. Linguagem Orientada a Objetos
7. Tipagem Dinâmica
8. Grande Quantidade de Frameworks
9. Facilidade de Aprendizagem
10. Ampla Utilização na Web

1994    Criação do PHP por Rasmus Lerdorf
1995    Lançamento do PHP/FI
1998    Lançamento do PHP 3
2000    Lançamento do PHP 4 e da Zend Engine
2004    Lançamento do PHP 5 com forte suporte a POO
2015    Lançamento do PHP 7 com grande ganho de desempenho
2020    Lançamento do PHP 8 com JIT e novos recursos
book
Material: "Aula 04 - Tecnologia da informação"
Diego Paiani postou um novo material: Aula 04 - Tecnologia da informação
Criado em: 2 de jun.2 de jun.
book
Material: "Aula 03 - Tecnologia da informação"
Diego Paiani postou um novo material: Aula 03 - Tecnologia da informação
Criado em: 2 de jun.2 de jun.
<?php
######## exercicio 1 ########
echo "<h3>Atividade 1</h3>";

    echo '<form method="post">';
    echo '<input type="number" name="num1"><br><br>';
    echo '<input type="number" name="num2"><br><br>';
    echo '<input type="submit" value="Calcular">';
    echo '</form>';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $num1 = $_POST["num1"];
        $num2 = $_POST["num2"];

        echo "<p>Resultados:<p>";

        echo "Soma: " . ($num1 + $num2) . "<br>";
        echo "Subtração: " . ($num1 - $num2) . "<br>";
        echo "Multiplicação: " . ($num1 * $num2) . "<br>";

        if ($num2 != 0) {
            echo "Divisão: " . ($num1 / $num2) . "<br>";
        } else {
            echo "Divisão: Não é possível dividir por zero.<br>";
        }
    }

    ####### exercicio 2 ########
    echo "<hr><h3>Atividade 2</h3>";
    
    $num3 = 8;
    $num4 = 6;

    $media = ($num3 + $num4) / 2;

    echo "Média = " . $media;

    echo "<hr>";
    echo "<h3>Atividade 3</h3>";
    ####### atividade 3 ########
    
    echo '<form method="post">';
    echo '<input type="number" name="nota1"><br><br>';
    echo '<input type="number" name="nota2"><br><br>';
    echo '<input type="number" name="nota3"><br><br>';
    echo '<input type="submit" value="Calcular">';
    echo '</form>';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nota1 = $_POST["nota1"];
        $nota2 = $_POST["nota2"];
        $nota3 = $_POST["nota3"];

        $media = ($nota1 + $nota2 + $nota3) / 3;

        echo "Média das notas = " . $media;
    }

    ####### atividade 4 #########
    echo "<hr>";
    echo "<h3>Atividade 4</h3>";

    $peso = 75;
    $altura = 1.75;

    $imc = $peso / ($altura * $altura);

    echo "IMC = " . number_format($imc, 2);

    ####### atividade 5 ########
    echo "<hr>";
    echo "<h3>Atividade 5</h3>";
    $raio = 5;

    $perimetro = 2 * pi() * $raio;

    echo "Perímetro = " . number_format($perimetro, 2);

    ####### atividade 6 ########
    echo "<hr>";
    echo "<h3>Atividade 6</h3>";

    $raio = 5;

    $area = pi() * pow($raio, 2);

    echo "Área = " . number_format($area, 2);

    ####### atividade 7 ########
    echo "<hr>";
    echo "<h3>Atividade 7</h3>";
    $a = 1;
    $b = -5;
    $c = 6;

    $delta = ($b * $b) - (4 * $a * $c);

    if ($delta < 0) {
        echo "Não existem raízes reais.";
    } else {
        $x1 = (-$b + sqrt($delta)) / (2 * $a);
        $x2 = (-$b - sqrt($delta)) / (2 * $a);

        echo "Delta = $delta <br>";
        echo "X1 = $x1 <br>";
        echo "X2 = $x2";
    }

    ####### atividade 8 ########
    echo "<hr>";
    echo "<h3>Atividade 8</h3>";
    $largura = 5;
    $comprimento = 8;

    $perimetro = 2 * ($largura + $comprimento);
    $area = $largura * $comprimento;

    echo "Perímetro = $perimetro <br>";
    echo "Área = $area";

    ####### atividade 9 ########
    echo "<hr>";
    echo "<h3>Atividade 9</h3>";

    $a = 5;
    $b = 6;
    $c = 7;
    $h = 4;

    $perimetro = $a + $b + $c;
    $area = ($b * $h) / 2;

    echo "Perímetro = $perimetro <br>";
    echo "Área = $area";

    echo "<hr>";
    echo "<h3>Atividade 10</h3>";

?>


Solucao01.php
Exibindo Solucao01.php…
