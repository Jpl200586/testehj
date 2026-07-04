<?php
function reverse_text(string $text): string
{
    return implode('', array_reverse(preg_split('//u', $text, -1, PREG_SPLIT_NO_EMPTY)));
}

function normalize(string $text): string
{
    $chars = preg_split('//u', mb_strtolower(trim($text), 'UTF-8'), -1, PREG_SPLIT_NO_EMPTY);
    sort($chars);
    return implode('', $chars);
}

function post(string $key): string
{
    return filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
}

function parse_float(string $value): float
{
    return (float) str_replace(',', '.', trim($value));
}

$programs = [
    'concat' => [
        'title' => 'Programa 1: Concatenar duas palavras',
        'fields' => [
            ['palavra1', 'Primeira palavra'],
            ['palavra2', 'Segunda palavra'],
        ],
        'handler' => fn(array $d) => $d['palavra1'] . $d['palavra2'],
    ],
    'letters' => [
        'title' => 'Programa 2: Mostrar cada letra',
        'fields' => [['palavra', 'Digite uma palavra']],
        'handler' => fn(array $d) => preg_split('//u', $d['palavra'], -1, PREG_SPLIT_NO_EMPTY) ?: [],
    ],
    'startsWithA' => [
        'title' => 'Programa 3: Verificar se começa com a letra "A"',
        'fields' => [['nome', 'Digite um nome']],
        'handler' => fn(array $d) => stripos($d['nome'], 'A') === 0 ? 'Sim' : 'Não',
    ],
    'palindrome' => [
        'title' => 'Programa 4: Verificar palíndromo',
        'fields' => [['palindrome', 'Digite uma palavra']],
        'handler' => fn(array $d) => (mb_strtolower($d['palindrome'], 'UTF-8') === reverse_text(mb_strtolower($d['palindrome'], 'UTF-8'))) ? 'É palíndromo' : 'Não é palíndromo',
    ],
    'anagram' => [
        'title' => 'Programa 5: Verificar anagrama',
        'fields' => [
            ['anagram1', 'Primeira palavra'],
            ['anagram2', 'Segunda palavra'],
        ],
        'handler' => fn(array $d) => normalize($d['anagram1']) === normalize($d['anagram2']) ? 'É anagrama' : 'Não é anagrama',
    ],
    'firstName' => [
        'title' => 'Programa 6: Mostrar primeiro nome',
        'fields' => [['nomeCompleto', 'Digite um nome completo']],
        'handler' => fn(array $d) => (($parts = preg_split('/\s+/', trim($d['nomeCompleto']), -1, PREG_SPLIT_NO_EMPTY)) ? $parts[0] : ''),
    ],
    'countSpaces' => [
        'title' => 'Programa 7: Contar espaços em branco',
        'fields' => [['espacosFrase', 'Digite uma frase']],
        'handler' => fn(array $d) => substr_count($d['espacosFrase'], ' '),
    ],
    'countVowels' => [
        'title' => 'Programa 8: Contar vogais',
        'fields' => [['vogaisPalavra', 'Digite uma palavra']],
        'handler' => fn(array $d) => preg_match_all('/[aeiouáàâãéèêíìîóòôõúùûAEIOUÁÀÂÃÉÈÊÍÌÎÓÒÔÕÚÙÛ]/u', $d['vogaisPalavra'], $m) ? count($m[0]) : 0,
    ],
    'lastNameFirst' => [
        'title' => 'Programa 9: Mostrar sobrenome (último nome)',
        'fields' => [['sobrenome', 'Digite um nome completo']],
        'handler' => fn(array $d) => (($parts = preg_split('/\s+/', trim($d['sobrenome']), -1, PREG_SPLIT_NO_EMPTY)) ? end($parts) : ''),
    ],
    'ageCheck' => [
        'title' => 'Programa 10: Verificar maioridade',
        'fields' => [['idadePessoa', 'Digite a idade']],
        'handler' => fn(array $d) => ((int) $d['idadePessoa'] >= 18 ? 'Maior de idade' : 'Menor de idade'),
    ],
    'compareNumbers' => [
        'title' => 'Programa 11: Comparar dois números',
        'fields' => [
            ['numero1', 'Primeiro número'],
            ['numero2', 'Segundo número'],
        ],
        'handler' => fn(array $d) => (parse_float($d['numero1']) === parse_float($d['numero2'])) ? 'Os números são iguais' : 'O maior número é: ' . max(parse_float($d['numero1']), parse_float($d['numero2'])),
    ],
    'maxOfThree' => [
        'title' => 'Programa 12: Mostrar o maior entre três números',
        'fields' => [
            ['numero1', 'Primeiro número'],
            ['numero2', 'Segundo número'],
            ['numero3', 'Terceiro número'],
        ],
        'handler' => fn(array $d) => 'O maior número é: ' . max(parse_float($d['numero1']), parse_float($d['numero2']), parse_float($d['numero3'])),
    ],
    'parityCheck' => [
        'title' => 'Programa 13: Verificar se é par, ímpar ou zero',
        'fields' => [['numero', 'Digite um número']],
        'handler' => fn(array $d) => (($n = (int) $d['numero']) === 0 ? 'Zero' : ($n % 2 === 0 ? 'É par' : 'É ímpar')),
    ],
    'signCheck' => [
        'title' => 'Programa 14: Verificar se é positivo, negativo ou zero',
        'fields' => [['numeroPosNegZero', 'Digite um número']],
        'handler' => fn(array $d) => ((($n = (int) $d['numeroPosNegZero']) > 0) ? 'Positivo' : (($n < 0) ? 'Negativo' : 'Zero')),
    ],
];

$action = post('action') ?: 'concat';

$values = fn(string $name): string => htmlspecialchars(post($name), ENT_QUOTES);

$input = [];
foreach ($programs[$action]['fields'] ?? [] as [$name]) {
    $input[$name] = post($name);
}

$result = '';
if (isset($programs[$action])) {
    $result = $programs[$action]['handler']($input);
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

    <?php foreach ($programs as $key => $program): ?>
        <section>
            <hr>
            <h2><?= $program['title'] ?></h2>
            <form method="post">
                <input type="hidden" name="action" value="<?= $key ?>">
                <?php foreach ($program['fields'] as [$name, $label]): ?>
                    <input name="<?= $name ?>" placeholder="<?= $label ?>" value="<?= $values($name) ?>">
                <?php endforeach; ?>
                <button>Calcular</button>
            </form>

            <?php if ($action === $key && $result !== ''): ?>
                <?php if (is_array($result)): ?>
                    <ul>
                        <?php foreach ($result as $item): ?>
                            <li><?= htmlspecialchars($item, ENT_QUOTES) ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p><strong><?= htmlspecialchars((string) $result, ENT_QUOTES) ?></strong></p>
                <?php endif; ?>
            <?php endif; ?>
        </section>
    <?php endforeach; ?>
</body>
</html>
