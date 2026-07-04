<?php

#Funções no php
    
function exibirMensagem($mensagem) {
    echo $mensagem . "<br>";
}

exibirMensagem("Olá, mundo!");
exibirMensagem("Esta é uma mensagem de teste.");

#chamada de função dentro de outra função com mais de um parâmetro
function calcularSoma($a, $b) {
    return $a + $b;
}   
function exibirSoma($num1, $num2) {
    $soma = calcularSoma($num1, $num2);
    echo "A soma de $num1 e $num2 é: $soma <br>";
}
exibirSoma(5, 10);
exibirSoma(3, 7);
#estruturas de repetição dentro de funções
function exibirContagem($limite) {
    for ($i = 1; $i <= $limite; $i++) {
        echo "Contagem: $i <br>";
    }
}
exibirContagem(5);
exibirContagem(10);

array_sum([1, 2, 3, 4, 5]); #soma os elementos do array
array_product([1, 2, 3, 4, 5]); #multiplica os elementos do array
array_merge([1, 2], [3, 4]); #combina os elementos de dois ou mais arrays
array_diff([1, 2, 3], [2, 3, 4]); #retorna os elementos do primeiro array que não estão presentes nos outros arrays
array_intersect([1, 2, 3], [2, 3, 4]); #retorna os elementos comuns entre os arrays     
array_map('strtoupper', ['a', 'b', 'c']); #aplica a função strtoupper a cada elemento do array
array_filter([1, 2, 3, 4, 5], function($num) { return $num % 2 === 0; }); #filtra os elementos do array usando uma função de callback
array_reduce([1, 2, 3, 4, 5], function($carry, $num) { return $carry + $num; }, 0); #reduz o array a um único valor usando uma função de callback       
array_key_exists('chave', ['chave' => 'valor']); #verifica se uma chave existe em um array
array_search('valor', ['chave' => 'valor']); #procura um valor em um array e retorna a chave correspondente
array_slice([1, 2, 3, 4, 5], 1, 3); #extrai uma parte do array
array_splice([1, 2, 3, 4, 5], 2, 1, [6, 7]); #remove elementos do array e os substitui por outros
array_unique([1, 2, 2, 3, 4, 4, 5]); #remove valores duplicados de um array
array_values(['a' => 1, 'b' => 2, 'c' => 3]); #retorna os valores de um array, reindexando as chaves
array_keys(['a' => 1, 'b' => 2, 'c' => 3]); #retorna as chaves de um array
array_push($array, $valor); #adiciona um ou mais elementos ao final do array
array_pop($array); #remove o último elemento do array
array_shift($array); #remove o primeiro elemento do array
array_unshift($array, $valor); #adiciona um ou mais elementos no início do array
array_reverse([1, 2, 3, 4, 5]); #inverte a ordem dos elementos do array
array_rand([1, 2, 3, 4, 5], 2); #retorna uma ou mais chaves aleatórias de um array
array_count_values([1, 2, 2, 3, 4, 4, 5]); #conta a frequência de cada valor em um array
sort([3, 1, 4, 2, 5]); #ordena os elementos do array em ordem crescente
rsort([3, 1, 4, 2, 5]); #ordena os elementos do array em ordem decrescente
asort(['b' => 2, 'a' => 1, 'c' => 3]); #ordena os elementos do array mantendo a associação entre chaves e valores
arsort(['b' => 2, 'a' => 1, 'c' => 3]); #ordena os elementos do array em ordem decrescente mantendo a associação entre chaves e valores
ksort(['b' => 2, 'a' => 1, 'c' => 3]); #ordena os elementos do array pelas chaves em ordem crescente
krsort(['b' => 2, 'a' => 1, 'c' => 3]); #ordena os elementos do array pelas chaves em ordem decrescente 
    

