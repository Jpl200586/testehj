<?php

#LACOS DE REPETIÇÃO
 
 #  WHILE, FOR, FOREACH

   while (true) {
    echo "Loop infinito <br>";
   } 
   for (;;) {
    echo "Loop infinito <br>";
   }    
   foreach (range(1, 10) as $contador) {
    echo "Contador: ", $contador, "<br>";
   }
   $contador = 0;
   while ($contador < 10) {      
    echo "Contador: ", $contador, "<br>";
    $contador++;
   }    
    echo "<hr>";
    for ($contador = 0; $contador < 10; $contador++) {
        echo "Contador: ", $contador, "<br>";
    }   

 #BREAK E CONTINUE

    for ($contador = 0; $contador < 10; $contador++) {
        if ($contador == 5) {
            break; # para a execução do laço
        }
        echo "Contador: ", $contador, "<br>";
    }    
    echo "<hr>";
    for ($contador = 0; $contador < 10; $contador++) {
        if ($contador == 5) {
            continue; # pula a execução do bloco
        }
        echo "Contador: ", $contador, "<br>";
    }

?>
