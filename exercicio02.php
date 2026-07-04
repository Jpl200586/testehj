<?php
function reverse_text(string $text): string {
    return implode('', array_reverse(preg_split('//u', $text, -1, PREG_SPLIT_NO_EMPTY)));
}

if (php_sapi_name() === 'cli') {
    $op = readline("Escolha uma opção (1 = concatenar, 2 = mostrar letras, 3 = verifica se começa com A, 4 = checar palíndromo, 5 = verificar anagrama, 6 = mostrar primeiro nome, 7 = contar espaços, 8 = contar vogais, 9 = mostrar sobrenome, 10 = verificar maioridade, 11 = mostrar maior número, 12 = mostrar maior entre três números, 13 = par/ímpar/zero, 14 = positivo/negativo/zero): ");
    if (trim($op) === '1') {
        $p1 = readline('Digite a primeira palavra: ');
        $p2 = readline('Digite a segunda palavra: ');
        echo 'A palavra resultante é: ' . $p1 . $p2 . "\n";
    } elseif (trim($op) === '2') {
        $palavra = readline('Digite uma palavra: ');
        foreach (preg_split('//u', $palavra, -1, PREG_SPLIT_NO_EMPTY) as $letra) {
            echo $letra . "\n";
        }
    } elseif (trim($op) === '3') {
        $nome = readline('Digite um nome: ');
        echo (stripos($nome, 'A') === 0 ? 'Começa com A' : 'Não começa com A') . "\n";
    } elseif (trim($op) === '4') {
        $palindrome = readline('Digite uma palavra: ');
        $texto = mb_strtolower($palindrome, 'UTF-8');
        echo ($texto === reverse_text($texto) ? 'É palíndromo' : 'Não é palíndromo') . "\n";
    } elseif (trim($op) === '5') {
        $a1 = readline('Digite a primeira palavra: ');
        $a2 = readline('Digite a segunda palavra: ');
        $normalize = function(string $text): string {
            $text = mb_strtolower($text, 'UTF-8');
            $chars = preg_split('//u', $text, -1, PREG_SPLIT_NO_EMPTY);
            sort($chars);
            return implode('', $chars);
        };
        echo ($normalize($a1) === $normalize($a2) ? 'É anagrama' : 'Não é anagrama') . "\n";
    } elseif (trim($op) === '6') {
        $nomeCompleto = readline('Digite um nome completo: ');
        $partes = preg_split('/\s+/', trim($nomeCompleto));
        echo (count($partes) ? $partes[0] : '') . "\n";
    } elseif (trim($op) === '7') {
        $fraseEspacos = readline('Digite uma frase: ');
        echo substr_count($fraseEspacos, ' ') . "\n";
    } elseif (trim($op) === '8') {
        $vogais = readline('Digite uma palavra: ');
        preg_match_all('/[aeiouáàâãéèêíìîóòôõúùûAEIOUÁÀÂÃÉÈÊÍÌÎÓÒÔÕÚÙÛ]/u', $vogais, $matches);
        echo count($matches[0]) . "\n";
    } elseif (trim($op) === '9') {
        $nomeCompleto = readline('Digite um nome completo: ');
        $partes = preg_split('/\s+/', trim($nomeCompleto));
        echo (count($partes) ? end($partes) : '') . "\n";
    } elseif (trim($op) === '10') {
        $idade = readline('Digite a idade: ');
        $idade = (int) trim($idade);
        echo ($idade >= 18 ? 'Maior de idade' : 'Menor de idade') . "\n";
    } elseif (trim($op) === '11') {
        $n1 = readline('Digite o primeiro número: ');
        $n2 = readline('Digite o segundo número: ');
        $n1 = (float) str_replace(',', '.', trim($n1));
        $n2 = (float) str_replace(',', '.', trim($n2));
        if ($n1 === $n2) {
            echo "Os números são iguais\n";
        } else {
            echo 'O maior número é: ' . ($n1 > $n2 ? $n1 : $n2) . "\n";
        }
    } elseif (trim($op) === '12') {
        $n1 = readline('Digite o primeiro número: ');
        $n2 = readline('Digite o segundo número: ');
        $n3 = readline('Digite o terceiro número: ');
        $n1 = (float) str_replace(',', '.', trim($n1));
        $n2 = (float) str_replace(',', '.', trim($n2));
        $n3 = (float) str_replace(',', '.', trim($n3));
        $maior = max($n1, $n2, $n3);
        echo 'O maior número é: ' . $maior . "\n";
    } elseif (trim($op) === '13') {
        $numero = readline('Digite um número: ');
        $numero = (int) trim($numero);
        if ($numero === 0) {
            echo "Zero\n";
        } else {
            echo ($numero % 2 === 0 ? 'É par' : 'É ímpar') . "\n";
        }
    } elseif (trim($op) === '14') {
        $numero = readline('Digite um número: ');
        $numero = (int) trim($numero);
        if ($numero > 0) {
            echo "Positivo\n";
        } elseif ($numero < 0) {
            echo "Negativo\n";
        } else {
            echo "Zero\n";
        }
    } else {
        echo "Opção inválida. Execute novamente com uma opção entre 1 e 14.\n";
    }
    exit;
}

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_SPECIAL_CHARS) ?? 'concat';
$p1 = filter_input(INPUT_GET, 'palavra1', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
$p2 = filter_input(INPUT_GET, 'palavra2', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
$palavra = filter_input(INPUT_GET, 'palavra', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
$nome = filter_input(INPUT_GET, 'nome', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
$palindrome = filter_input(INPUT_GET, 'palindrome', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
$anagram1 = filter_input(INPUT_GET, 'anagram1', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
$anagram2 = filter_input(INPUT_GET, 'anagram2', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
$nomeCompleto = filter_input(INPUT_GET, 'nomeCompleto', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
$espacosFrase = filter_input(INPUT_GET, 'espacosFrase', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
$vogaisPalavra = filter_input(INPUT_GET, 'vogaisPalavra', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
$sobrenome = filter_input(INPUT_GET, 'sobrenome', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
$idadePessoa = filter_input(INPUT_GET, 'idadePessoa', FILTER_SANITIZE_NUMBER_INT) ?? '';
$numero = filter_input(INPUT_GET, 'numero', FILTER_SANITIZE_NUMBER_INT) ?? '';
$numeroPosNegZero = filter_input(INPUT_GET, 'numeroPosNegZero', FILTER_SANITIZE_NUMBER_INT) ?? '';
$numero1 = filter_input(INPUT_GET, 'numero1', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) ?? '';
$numero2 = filter_input(INPUT_GET, 'numero2', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) ?? '';
$numero3 = filter_input(INPUT_GET, 'numero3', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) ?? '';

$resultConcat = $action === 'concat' && $p1 !== '' && $p2 !== '' ? $p1 . $p2 : '';
$letras = $action === 'letters' && $palavra !== '' ? preg_split('//u', $palavra, -1, PREG_SPLIT_NO_EMPTY) : [];
$resultStartsWithA = $action === 'startsWithA' && $nome !== '' ? (stripos($nome, 'A') === 0 ? 'Sim' : 'Não') : '';
$resultPalindrome = $action === 'palindrome' && $palindrome !== '' ? ((mb_strtolower($palindrome, 'UTF-8') === reverse_text(mb_strtolower($palindrome, 'UTF-8'))) ? 'É palíndromo' : 'Não é palíndromo') : '';
$resultAnagram = '';
if ($action === 'anagram' && $anagram1 !== '' && $anagram2 !== '') {
    $normalize = function(string $text): string {
        $text = mb_strtolower($text, 'UTF-8');
        $chars = preg_split('//u', $text, -1, PREG_SPLIT_NO_EMPTY);
        sort($chars);
        return implode('', $chars);
    };
    $resultAnagram = $normalize($anagram1) === $normalize($anagram2) ? 'É anagrama' : 'Não é anagrama';
}
$resultFirstName = '';
if ($action === 'firstName' && $nomeCompleto !== '') {
    $partes = preg_split('/\s+/', trim($nomeCompleto));
    $resultFirstName = count($partes) ? $partes[0] : '';
}
$resultLastName = '';
if ($action === 'lastNameFirst' && $sobrenome !== '') {
    $partes = preg_split('/\s+/', trim($sobrenome));
    $resultLastName = count($partes) ? end($partes) : '';
}
$resultSpaces = '';
if ($action === 'countSpaces' && $espacosFrase !== '') {
    $resultSpaces = substr_count($espacosFrase, ' ');
}
$resultVowels = '';
if ($action === 'countVowels' && $vogaisPalavra !== '') {
    preg_match_all('/[aeiouáàâãéèêíìîóòôõúùûAEIOUÁÀÂÃÉÈÊÍÌÎÓÒÔÕÚÙÛ]/u', $vogaisPalavra, $matches);
    $resultVowels = count($matches[0]);
}
$resultAge = '';
if ($action === 'ageCheck' && $idadePessoa !== '') {
    $idade = (int) $idadePessoa;
    $resultAge = $idade >= 18 ? 'Maior de idade' : 'Menor de idade';
}
$resultGreaterNumber = '';
if ($action === 'compareNumbers' && $numero1 !== '' && $numero2 !== '') {
    $n1 = (float) str_replace(',', '.', $numero1);
    $n2 = (float) str_replace(',', '.', $numero2);
    if ($n1 === $n2) {
        $resultGreaterNumber = 'Os números são iguais';
    } else {
        $resultGreaterNumber = 'O maior número é: ' . ($n1 > $n2 ? $n1 : $n2);
    }
}
$resultMaxOfThree = '';
if ($action === 'maxOfThree' && $numero1 !== '' && $numero2 !== '' && $numero3 !== '') {
    $n1 = (float) str_replace(',', '.', $numero1);
    $n2 = (float) str_replace(',', '.', $numero2);
    $n3 = (float) str_replace(',', '.', $numero3);
    $resultMaxOfThree = 'O maior número é: ' . max($n1, $n2, $n3);
}
$resultParity = '';
if ($action === 'parityCheck' && $numero !== '') {
    $n = (int) $numero;
    if ($n === 0) {
        $resultParity = 'Zero';
    } else {
        $resultParity = $n % 2 === 0 ? 'É par' : 'É ímpar';
    }
}
$resultSign = '';
if ($action === 'signCheck' && $numeroPosNegZero !== '') {
    $n = (int) $numeroPosNegZero;
    if ($n > 0) {
        $resultSign = 'Positivo';
    } elseif ($n < 0) {
        $resultSign = 'Negativo';
    } else {
        $resultSign = 'Zero';
    }
}
?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Exercícios 02</title>
</head>
<body>
    <h1>Exercícios 02</h1>

    <section>
        <hr>
        <h2>Programa 1: Concatenar duas palavras</h2>
        <form method="get">
            <input type="hidden" name="action" value="concat">
            <input name="palavra1" placeholder="Primeira palavra" value="<?= htmlspecialchars($p1, ENT_QUOTES) ?>">
            <input name="palavra2" placeholder="Segunda palavra" value="<?= htmlspecialchars($p2, ENT_QUOTES) ?>">
            <button>Concatenar</button>
        </form>
        <?= $resultConcat ? '<p>A palavra resultante é: <strong>' . htmlspecialchars($resultConcat, ENT_QUOTES) . '</strong></p>' : '' ?>
    </section>

    <section>
        <hr>
        <h2>Programa 2: Mostrar cada letra</h2>
        <form method="get">
            <input type="hidden" name="action" value="letters">
            <input name="palavra" placeholder="Digite uma palavra" value="<?= htmlspecialchars($palavra, ENT_QUOTES) ?>">
            <button>Mostrar letras</button>
        </form>
        <?php if ($letras): ?>
            <ul>
                <?php foreach ($letras as $letra): ?>
                    <li><?= htmlspecialchars($letra, ENT_QUOTES) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </section>

    <section>
        <hr>
        <h2>Programa 3: Verificar se começa com a letra "A"</h2>
        <form method="get">
            <input type="hidden" name="action" value="startsWithA">
            <input name="nome" placeholder="Digite um nome" value="<?= htmlspecialchars($nome, ENT_QUOTES) ?>">
            <button>Verificar</button>
        </form>
        <?= $resultStartsWithA !== '' ? '<p>Começa com A? <strong>' . htmlspecialchars($resultStartsWithA, ENT_QUOTES) . '</strong></p>' : '' ?>
    </section>

    <section>
        <hr>
        <h2>Programa 4: Verificar palíndromo</h2>
        <form method="get">
            <input type="hidden" name="action" value="palindrome">
            <input name="palindrome" placeholder="Digite uma palavra" value="<?= htmlspecialchars($palindrome, ENT_QUOTES) ?>">
            <button>Verificar</button>
        </form>
        <?= $resultPalindrome !== '' ? '<p><strong>' . htmlspecialchars($resultPalindrome, ENT_QUOTES) . '</strong></p>' : '' ?>
    </section>

    <section>
        <hr>
        <h2>Programa 5: Verificar anagrama</h2>
        <form method="get">
            <input type="hidden" name="action" value="anagram">
            <input name="anagram1" placeholder="Primeira palavra" value="<?= htmlspecialchars($anagram1, ENT_QUOTES) ?>">
            <input name="anagram2" placeholder="Segunda palavra" value="<?= htmlspecialchars($anagram2, ENT_QUOTES) ?>">
            <button>Verificar</button>
        </form>
        <?= $resultAnagram !== '' ? '<p><strong>' . htmlspecialchars($resultAnagram, ENT_QUOTES) . '</strong></p>' : '' ?>
    </section>

    <section>
        <hr>
        <h2>Programa 6: Mostrar primeiro nome</h2>
        <form method="get">
            <input type="hidden" name="action" value="firstName">
            <input name="nomeCompleto" placeholder="Digite um nome completo" value="<?= htmlspecialchars($nomeCompleto, ENT_QUOTES) ?>">
            <button>Mostrar</button>
        </form>
        <?= $resultFirstName !== '' ? '<p>Primeiro nome: <strong>' . htmlspecialchars($resultFirstName, ENT_QUOTES) . '</strong></p>' : '' ?>
    </section>

    <section>
        <hr>
        <h2>Programa 9: Mostrar sobrenome (último nome)</h2>
        <form method="get">
            <input type="hidden" name="action" value="lastNameFirst">
            <input name="sobrenome" placeholder="Digite um nome completo" value="<?= htmlspecialchars($sobrenome, ENT_QUOTES) ?>">
            <button>Mostrar sobrenome</button>
        </form>
        <?= $resultLastName !== '' ? '<p>Sobrenome: <strong>' . htmlspecialchars($resultLastName, ENT_QUOTES) . '</strong></p>' : '' ?>
    </section>

    <section>
        <hr>
        <h2>Programa 7: Contar espaços em branco</h2>
        <form method="get">
            <input type="hidden" name="action" value="countSpaces">
            <input name="espacosFrase" placeholder="Digite uma frase" value="<?= htmlspecialchars($espacosFrase, ENT_QUOTES) ?>">
            <button>Contar</button>
        </form>
        <?= $resultSpaces !== '' ? '<p>Quantidade de espaços: <strong>' . htmlspecialchars($resultSpaces, ENT_QUOTES) . '</strong></p>' : '' ?>
    </section>

    <section>
        <hr>
        <h2>Programa 8: Contar vogais</h2>
        <form method="get">
            <input type="hidden" name="action" value="countVowels">
            <input name="vogaisPalavra" placeholder="Digite uma palavra" value="<?= htmlspecialchars($vogaisPalavra, ENT_QUOTES) ?>">
            <button>Contar</button>
        </form>
        <?= $resultVowels !== '' ? '<p>Quantidade de vogais: <strong>' . htmlspecialchars($resultVowels, ENT_QUOTES) . '</strong></p>' : '' ?>
    </section>

    <section>
        <hr>
        <h2>Programa 10: Verificar maioridade</h2>
        <form method="get">
            <input type="hidden" name="action" value="ageCheck">
            <input name="idadePessoa" placeholder="Digite a idade" value="<?= htmlspecialchars($idadePessoa, ENT_QUOTES) ?>">
            <button>Verificar</button>
        </form>
        <?= $resultAge !== '' ? '<p>Resultado: <strong>' . htmlspecialchars($resultAge, ENT_QUOTES) . '</strong></p>' : '' ?>
    </section>

    <section>
        <hr>
        <h2>Programa 11: Comparar dois números</h2>
        <form method="get">
            <input type="hidden" name="action" value="compareNumbers">
            <input name="numero1" placeholder="Primeiro número" value="<?= htmlspecialchars($numero1, ENT_QUOTES) ?>">
            <input name="numero2" placeholder="Segundo número" value="<?= htmlspecialchars($numero2, ENT_QUOTES) ?>">
            <button>Comparar</button>
        </form>
        <?= $resultGreaterNumber !== '' ? '<p><strong>' . htmlspecialchars($resultGreaterNumber, ENT_QUOTES) . '</strong></p>' : '' ?>
    </section>

    <section>
        <hr>
        <h2>Programa 12: Mostrar o maior entre três números</h2>
        <form method="get">
            <input type="hidden" name="action" value="maxOfThree">
            <input name="numero1" placeholder="Primeiro número" value="<?= htmlspecialchars($numero1, ENT_QUOTES) ?>">
            <input name="numero2" placeholder="Segundo número" value="<?= htmlspecialchars($numero2, ENT_QUOTES) ?>">
            <input name="numero3" placeholder="Terceiro número" value="<?= htmlspecialchars($numero3, ENT_QUOTES) ?>">
            <button>Verificar</button>
        </form>
        <?= $resultMaxOfThree !== '' ? '<p><strong>' . htmlspecialchars($resultMaxOfThree, ENT_QUOTES) . '</strong></p>' : '' ?>
    </section>

    <section>
        <hr>
        <h2>Programa 13: Verificar se é par, ímpar ou zero</h2>
        <form method="get">
            <input type="hidden" name="action" value="parityCheck">
            <input name="numero" placeholder="Digite um número" value="<?= htmlspecialchars($numero, ENT_QUOTES) ?>">
            <button>Verificar</button>
        </form>
        <?= $resultParity !== '' ? '<p><strong>' . htmlspecialchars($resultParity, ENT_QUOTES) . '</strong></p>' : '' ?>
    </section>

    <section>
        <hr>
        <h2>Programa 14: Verificar se é positivo, negativo ou zero</h2>
        <form method="get">
            <input type="hidden" name="action" value="signCheck">
            <input name="numeroPosNegZero" placeholder="Digite um número" value="<?= htmlspecialchars($numeroPosNegZero, ENT_QUOTES) ?>">
            <button>Verificar</button>
        </form>
        <?= $resultSign !== '' ? '<p><strong>' . htmlspecialchars($resultSign, ENT_QUOTES) . '</strong></p>' : '' ?>
    </section>
</body>
</html>
