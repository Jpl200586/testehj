
<?php
    echo "Hello, World!";

    // esse código não será lido pelo php ou # e pode ser usado para escrever comentários de uma linha
    /*
    esse código não será lido pelo php
    e pode ser usado para escrever comentários
    de várias linhas
    */
    # Variáveis em PHP = $

 
    # string -> "%aconjunto de caracteres"
    $nome = "João";
    echo "Olá, $nome!"; // saída: Olá, João!   
    # integer -> "%um número inteiro"
    $idade = 30;   
    # float -> "%um número decimal"
     $altura = 1.75;
    # boolean -> "%um valor lógico (verdadeiro ou falso)"
    $estuda = true;
    echo "Idade: $idade anos"; // saída: Idade: 30 anos
    echo "Altura: $altura metros"; // saída: Altura: 1.75 metros
    echo "Estuda: " . ($estuda ? "Sim" : "Não"); // saída: Estuda: Sim
    var_dump($nome); // string(4) "João"
    var_dump($idade); // int(30)   
    var_dump($altura); // float(1.75)
    var_dump($estuda); // bool(true)
    echo "O nome do usuário é $nome, ele tem $idade anos, mede $altura metros e estuda: " . ($estuda ? "Sim" : "Não");
    
?>





