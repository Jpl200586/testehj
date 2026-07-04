<?php
# estrutura de repeticao do while

/* 
while(condicao){
    #bloco
}

do{
    # bloco
}while(conficao);
*/

$contador = 1;

do {
    echo $contador . "<br>";
    $contador++;
}while($contador <= 5);

$count = 10;

do {
    echo $count . "<br>";
    echo "Executou";
    $count++;
}while($count <= 5);

# exemplo tabuada com do while
echo "<br>";
$num = 7;
$i = 1;

do{
    echo "$num X $i = " . ($num * $i) . "<br>";
    $i++;
}while($i <= 10);

# Menu simples
$opcao = 0;

do{
    echo "1 - Cadastro<br>";
    echo "2 - Cadastro<br>";
    echo "3 - Cadastro<br>";

    $opcao++;
}while($opcao < 3);

echo "Programa encerrado";
echo "<br>";
# Testando as palavras reservadas contiue e break
for($i = 1; $i <= 6; $i++){
    if($i % 2 !== 0)
        continue;
    echo "Número par encontrado: $i <br>";
}
?>