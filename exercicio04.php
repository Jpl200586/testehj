<?php
// Lê e sanitiza um valor enviado pelo formulário.
function post(string $key): string { return filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS) ?? ''; }

// Converte um texto em inteiro, aceitando espaços extras.
function inum(string $value): int { return (int) trim($value); }

// Converte um texto em número decimal, aceitando vírgula decimal.
function fnum(string $value): float { return (float) str_replace(',', '.', trim($value)); }

// Escapa qualquer saída antes de mostrar no HTML.
function esc($value): string { return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8'); }

// Divide uma string em itens usando espaços, vírgulas, ponto e vírgula ou quebras de linha.
function split_values(string $text): array
{
    $text = trim($text);
    if ($text === '') {
        return [];
    }

    return preg_split('/[\s,;]+/u', $text, -1, PREG_SPLIT_NO_EMPTY) ?: [];
}

// Converte um texto em vetor de inteiros.
function parse_int_list(string $text): array
{
    return array_map('intval', split_values($text));
}

// Converte um texto em vetor de strings, preservando frases e removendo linhas vazias.
function parse_lines(string $text): array
{
    $lines = preg_split('/\R/u', trim($text)) ?: [];
    return array_values(array_filter(array_map('trim', $lines), fn($line) => $line !== ''));
}

// Lê uma matriz onde cada linha do textarea representa uma linha da matriz.
function parse_matrix(string $text): array
{
    $rows = [];
    foreach (parse_lines($text) as $line) {
        $rows[] = array_map('intval', split_values($line));
    }
    return $rows;
}

// Verifica se todas as linhas da matriz possuem o mesmo tamanho.
function is_rectangular_matrix(array $matrix): bool
{
    if ($matrix === []) {
        return false;
    }

    $cols = count($matrix[0]);
    if ($cols === 0) {
        return false;
    }

    foreach ($matrix as $row) {
        if (count($row) !== $cols) {
            return false;
        }
    }

    return true;
}

// Formata uma matriz em linhas legíveis para exibição em lista.
function format_matrix_lines(array $matrix): array
{
    return array_map(fn($row) => '[ ' . implode(', ', $row) . ' ]', $matrix);
}

// Testa se um número é primo verificando divisores de 2 até a raiz quadrada dele.
function is_prime_number(int $number): bool
{
    if ($number < 2) {
        return false;
    }

    for ($divisor = 2; $divisor * $divisor <= $number; $divisor++) {
        if ($number % $divisor === 0) {
            return false;
        }
    }

    return true;
}

// Retorna todos os primos menores que o limite informado.
function primes_less_than(int $limit): array
{
    $primes = [];
    for ($number = 2; $number < $limit; $number++) {
        if (is_prime_number($number)) {
            $primes[] = $number;
        }
    }
    return $primes;
}

// Gera os primeiros N números primos.
function first_n_primes(int $count): array
{
    $primes = [];
    $number = 2;

    while (count($primes) < $count) {
        if (is_prime_number($number)) {
            $primes[] = $number;
        }
        $number++;
    }

    return $primes;
}

// Monta a sequência de Fibonacci até um valor máximo.
function fibonacci_until(int $limit): array
{
    if ($limit < 0) {
        return [];
    }

    $sequence = [0];
    if ($limit === 0) {
        return $sequence;
    }

    $sequence[] = 1;
    while (true) {
        $next = $sequence[count($sequence) - 1] + $sequence[count($sequence) - 2];
        if ($next > $limit) {
            break;
        }
        $sequence[] = $next;
    }

    return $sequence;
}

// Calcula o MDC pelo algoritmo de Euclides iterativo.
function gcd_value(int $a, int $b): int
{
    $a = abs($a);
    $b = abs($b);

    while ($b !== 0) {
        $rest = $a % $b;
        $a = $b;
        $b = $rest;
    }

    return $a;
}

// Calcula o MMC usando a relação mdc(a,b) * mmc(a,b) = a * b.
function lcm_value(int $a, int $b): int
{
    if ($a === 0 || $b === 0) {
        return 0;
    }

    return (int) abs(($a * $b) / gcd_value($a, $b));
}

// Inverte string com suporte a acentuação.
function reverse_text(string $text): string
{
    $chars = preg_split('//u', $text, -1, PREG_SPLIT_NO_EMPTY) ?: [];
    return implode('', array_reverse($chars));
}

// Remove acentos, espaços e pontuação para comparar palavras/frases.
function normalize_text(string $text): string
{
    $text = mb_strtolower($text, 'UTF-8');
    $map = [
        'á' => 'a', 'à' => 'a', 'ã' => 'a', 'â' => 'a', 'ä' => 'a',
        'é' => 'e', 'è' => 'e', 'ê' => 'e', 'ë' => 'e',
        'í' => 'i', 'ì' => 'i', 'î' => 'i', 'ï' => 'i',
        'ó' => 'o', 'ò' => 'o', 'õ' => 'o', 'ô' => 'o', 'ö' => 'o',
        'ú' => 'u', 'ù' => 'u', 'û' => 'u', 'ü' => 'u',
        'ç' => 'c',
    ];
    $text = strtr($text, $map);
    return preg_replace('/[^a-z0-9]/u', '', $text) ?? '';
}

// Calcula o determinante de uma matriz 3x3 pela regra de Sarrus.
function determinant_3x3(array $matrix): int
{
    return ($matrix[0][0] * $matrix[1][1] * $matrix[2][2])
        + ($matrix[0][1] * $matrix[1][2] * $matrix[2][0])
        + ($matrix[0][2] * $matrix[1][0] * $matrix[2][1])
        - ($matrix[0][2] * $matrix[1][1] * $matrix[2][0])
        - ($matrix[0][0] * $matrix[1][2] * $matrix[2][1])
        - ($matrix[0][1] * $matrix[1][0] * $matrix[2][2]);
}

// Gera uma matriz com números aleatórios em um intervalo simples.
function random_matrix(int $rows, int $cols, int $min = 0, int $max = 9): array
{
    $matrix = [];
    for ($row = 0; $row < $rows; $row++) {
        $line = [];
        for ($col = 0; $col < $cols; $col++) {
            $line[] = random_int($min, $max);
        }
        $matrix[] = $line;
    }
    return $matrix;
}

// Retorna a transposta de uma matriz retangular.
function transpose_matrix(array $matrix): array
{
    $transposed = [];
    $rows = count($matrix);
    $cols = count($matrix[0]);

    for ($col = 0; $col < $cols; $col++) {
        $line = [];
        for ($row = 0; $row < $rows; $row++) {
            $line[] = $matrix[$row][$col];
        }
        $transposed[] = $line;
    }

    return $transposed;
}

// Soma duas matrizes de mesmo tamanho.
function add_matrices(array $a, array $b): array
{
    $result = [];
    for ($row = 0; $row < count($a); $row++) {
        $line = [];
        for ($col = 0; $col < count($a[$row]); $col++) {
            $line[] = $a[$row][$col] + $b[$row][$col];
        }
        $result[] = $line;
    }
    return $result;
}

// Multiplica duas matrizes compatíveis.
function multiply_matrices(array $a, array $b): array
{
    $result = [];
    $aRows = count($a);
    $aCols = count($a[0]);
    $bCols = count($b[0]);

    for ($row = 0; $row < $aRows; $row++) {
        $line = [];
        for ($col = 0; $col < $bCols; $col++) {
            $sum = 0;
            for ($index = 0; $index < $aCols; $index++) {
                $sum += $a[$row][$index] * $b[$index][$col];
            }
            $line[] = $sum;
        }
        $result[] = $line;
    }

    return $result;
}

// Conta quantas minas existem ao redor de uma posição.
function count_neighbor_mines(array $matrix, int $row, int $col): int
{
    $count = 0;
    for ($dr = -1; $dr <= 1; $dr++) {
        for ($dc = -1; $dc <= 1; $dc++) {
            if ($dr === 0 && $dc === 0) {
                continue;
            }

            $nr = $row + $dr;
            $nc = $col + $dc;
            if (isset($matrix[$nr][$nc]) && $matrix[$nr][$nc] === 1) {
                $count++;
            }
        }
    }

    return $count;
}

// Monta o tabuleiro de dicas do campo minado.
function minesweeper_hints(array $matrix): array
{
    $result = [];
    for ($row = 0; $row < count($matrix); $row++) {
        $line = [];
        for ($col = 0; $col < count($matrix[$row]); $col++) {
            $line[] = count_neighbor_mines($matrix, $row, $col);
        }
        $result[] = $line;
    }
    return $result;
}

// Função recursiva clássica do fatorial.
function factorial_recursive(int $number): int
{
    if ($number <= 1) {
        return 1;
    }

    return $number * factorial_recursive($number - 1);
}

// Testa primalidade de forma recursiva, tentando divisor por divisor.
function is_prime_recursive(int $number, int $divisor = 2): bool
{
    if ($number < 2) {
        return false;
    }
    if ($divisor * $divisor > $number) {
        return true;
    }
    if ($number % $divisor === 0) {
        return false;
    }
    return is_prime_recursive($number, $divisor + 1);
}

// Soma recursivamente os dígitos de um número.
function sum_digits_recursive(int $number): int
{
    $number = abs($number);
    if ($number < 10) {
        return $number;
    }
    return ($number % 10) + sum_digits_recursive((int) ($number / 10));
}

// Potência recursiva multiplicando a base pelo resultado da chamada menor.
function power_recursive(int $base, int $exponent): int
{
    if ($exponent === 0) {
        return 1;
    }
    return $base * power_recursive($base, $exponent - 1);
}

// MDC recursivo pelo algoritmo de Euclides.
function gcd_recursive(int $a, int $b): int
{
    $a = abs($a);
    $b = abs($b);
    if ($b === 0) {
        return $a;
    }
    return gcd_recursive($b, $a % $b);
}

// Inverte um vetor de caracteres de maneira recursiva.
function reverse_chars_recursive(array $chars): string
{
    if ($chars === []) {
        return '';
    }

    $last = array_pop($chars);
    return $last . reverse_chars_recursive($chars);
}

// Inverte uma string usando a função recursiva auxiliar.
function reverse_string_recursive(string $text): string
{
    return reverse_chars_recursive(preg_split('//u', $text, -1, PREG_SPLIT_NO_EMPTY) ?: []);
}

// Encontra recursivamente o menor valor de um vetor.
function min_recursive(array $values): int
{
    if (count($values) === 1) {
        return $values[0];
    }

    $first = array_shift($values);
    $minRest = min_recursive($values);
    return $first < $minRest ? $first : $minRest;
}

// Testa palíndromo recursivamente comparando extremos.
function palindrome_recursive(string $text): bool
{
    $text = normalize_text($text);
    $length = strlen($text);

    if ($length <= 1) {
        return true;
    }
    if ($text[0] !== $text[$length - 1]) {
        return false;
    }

    return palindrome_recursive(substr($text, 1, $length - 2));
}

// Soma recursivamente os elementos de um vetor.
function sum_array_recursive(array $values): int
{
    if ($values === []) {
        return 0;
    }

    $first = array_shift($values);
    return $first + sum_array_recursive($values);
}

// Catálogo dos exercícios. Cada item define título, campos e a regra de resolução.
$programs = [
    // 52) Soma os números de 1 até N acumulando em um laço for.
    '52' => [
        'title' => '52: Soma de 1 até N',
        'fields' => [['name' => 'n', 'label' => 'Número N', 'type' => 'number', 'min' => '1']],
        'handler' => function ($d) {
            $n = inum($d['n']);
            $sum = 0;
            for ($i = 1; $i <= $n; $i++) {
                $sum += $i;
            }
            return "A soma de 1 até {$n} é {$sum}.";
        },
    ],
    // 53) Percorre apenas os números pares de 1 até 100 e soma todos eles.
    '53' => [
        'title' => '53: Soma dos pares de 1 a 100',
        'fields' => [],
        'handler' => function ($d) {
            $sum = 0;
            for ($i = 2; $i <= 100; $i += 2) {
                $sum += $i;
            }
            return "A soma dos números pares de 1 a 100 é {$sum}.";
        },
    ],
    // 54) Multiplica a base por ela mesma várias vezes para simular potência.
    '54' => [
        'title' => '54: Potência com laço',
        'fields' => [
            ['name' => 'base', 'label' => 'Base', 'type' => 'number'],
            ['name' => 'expoente', 'label' => 'Expoente', 'type' => 'number', 'min' => '0'],
        ],
        'handler' => function ($d) {
            $base = inum($d['base']);
            $exponent = inum($d['expoente']);
            $result = 1;
            for ($i = 0; $i < $exponent; $i++) {
                $result *= $base;
            }
            return "{$base} elevado a {$exponent} é {$result}.";
        },
    ],
    // 55) Usa a verificação de primalidade para dizer se N é primo.
    '55' => [
        'title' => '55: Número primo ou não',
        'fields' => [['name' => 'n', 'label' => 'Número N', 'type' => 'number']],
        'handler' => fn($d) => is_prime_number(inum($d['n'])) ? 'O número informado é primo.' : 'O número informado não é primo.',
    ],
    // 56) Lista todos os primos menores que N.
    '56' => [
        'title' => '56: Primos menores que N',
        'fields' => [['name' => 'n', 'label' => 'Número limite N', 'type' => 'number', 'min' => '2']],
        'handler' => function ($d) {
            $n = inum($d['n']);
            $primes = primes_less_than($n);
            return $primes === [] ? ["Não existem primos menores que {$n}."] : array_merge(["Primos menores que {$n}:"], array_map('strval', $primes));
        },
    ],
    // 57) Gera a quantidade de primos pedida pelo usuário.
    '57' => [
        'title' => '57: Primeiros N números primos',
        'fields' => [['name' => 'n', 'label' => 'Quantidade N', 'type' => 'number', 'min' => '1']],
        'handler' => function ($d) {
            $n = inum($d['n']);
            return array_merge(["Os primeiros {$n} números primos são:"], array_map('strval', first_n_primes($n)));
        },
    ],
    // 58) Repete a ideia do exercício anterior para fixação.
    '58' => [
        'title' => '58: Primeiros N números primos (revisão)',
        'fields' => [['name' => 'n', 'label' => 'Quantidade N', 'type' => 'number', 'min' => '1']],
        'handler' => function ($d) {
            $n = inum($d['n']);
            return array_merge(["Revisão: os primeiros {$n} números primos são:"], array_map('strval', first_n_primes($n)));
        },
    ],
    // 59) Mostra os inteiros estritamente entre A e B, respeitando a ordem crescente.
    '59' => [
        'title' => '59: Números entre A e B',
        'fields' => [
            ['name' => 'a', 'label' => 'Número A', 'type' => 'number'],
            ['name' => 'b', 'label' => 'Número B', 'type' => 'number'],
        ],
        'handler' => function ($d) {
            $a = inum($d['a']);
            $b = inum($d['b']);
            $start = min($a, $b) + 1;
            $end = max($a, $b) - 1;
            if ($start > $end) {
                return 'Não há números inteiros entre os valores informados.';
            }
            return array_merge(["Números entre {$a} e {$b}:"], array_map('strval', range($start, $end)));
        },
    ],
    // 60) Soma os positivos até encontrar o primeiro número negativo na sequência.
    '60' => [
        'title' => '60: Soma positivos até número negativo',
        'fields' => [[
            'name' => 'sequencia',
            'label' => 'Números separados por espaço, vírgula ou linha',
            'type' => 'textarea',
            'rows' => '5',
            'placeholder' => '10 5 3 -1 9',
        ]],
        'handler' => function ($d) {
            $values = parse_int_list($d['sequencia']);
            $sum = 0;
            foreach ($values as $value) {
                if ($value < 0) {
                    break;
                }
                $sum += $value;
            }
            return "A soma dos números positivos lidos antes do primeiro negativo é {$sum}.";
        },
    ],
    // 61) Monta a sequência de Fibonacci até o valor limite informado.
    '61' => [
        'title' => '61: Fibonacci até N',
        'fields' => [['name' => 'n', 'label' => 'Limite N', 'type' => 'number', 'min' => '0']],
        'handler' => function ($d) {
            $n = inum($d['n']);
            return array_merge(["Sequência de Fibonacci até {$n}:"], array_map('strval', fibonacci_until($n)));
        },
    ],
    // 62) Calcula a média dos valores lidos até encontrar zero.
    '62' => [
        'title' => '62: Média até digitar zero',
        'fields' => [[
            'name' => 'sequencia',
            'label' => 'Números separados por espaço, vírgula ou linha',
            'type' => 'textarea',
            'rows' => '5',
            'placeholder' => '8 4 6 0 9',
        ]],
        'handler' => function ($d) {
            $values = parse_int_list($d['sequencia']);
            $sum = 0;
            $count = 0;
            foreach ($values as $value) {
                if ($value === 0) {
                    break;
                }
                $sum += $value;
                $count++;
            }
            return $count === 0 ? 'Nenhum número válido foi informado antes do zero.' : 'A média dos números lidos antes do zero é ' . number_format($sum / $count, 2, ',', '.') . '.';
        },
    ],
    // 64) Conta as vogais da frase uma a uma.
    '64' => [
        'title' => '64: Quantidade de vogais',
        'fields' => [['name' => 'frase', 'label' => 'Frase', 'type' => 'text']],
        'handler' => function ($d) {
            preg_match_all('/[aeiouáàãâéêíóôõú]/iu', $d['frase'], $matches);
            return 'A frase possui ' . count($matches[0]) . ' vogais.';
        },
    ],
    // 65) Inverte a frase preservando caracteres acentuados.
    '65' => [
        'title' => '65: Frase ao contrário',
        'fields' => [['name' => 'frase', 'label' => 'Frase', 'type' => 'text']],
        'handler' => fn($d) => 'Frase invertida: ' . reverse_text($d['frase']),
    ],
    // 66) Compara a frase normalizada com ela mesma invertida para descobrir palíndromo.
    '66' => [
        'title' => '66: Palíndromo',
        'fields' => [['name' => 'frase', 'label' => 'Palavra ou frase', 'type' => 'text']],
        'handler' => function ($d) {
            $normalized = normalize_text($d['frase']);
            return $normalized !== '' && $normalized === reverse_text($normalized) ? 'A sequência informada é um palíndromo.' : 'A sequência informada não é um palíndromo.';
        },
    ],
    // 67) Procura todos os divisores de um número percorrendo de 1 até N.
    '67' => [
        'title' => '67: Divisores de um número',
        'fields' => [['name' => 'n', 'label' => 'Número N', 'type' => 'number']],
        'handler' => function ($d) {
            $n = abs(inum($d['n']));
            if ($n === 0) {
                return 'O número 0 possui infinitos divisores.';
            }
            $divisors = [];
            for ($i = 1; $i <= $n; $i++) {
                if ($n % $i === 0) {
                    $divisors[] = $i;
                }
            }
            return array_merge(["Divisores de {$n}:"], array_map('strval', $divisors));
        },
    ],
    // 68) Calcula o MMC usando o MDC dos dois números.
    '68' => [
        'title' => '68: MMC entre dois números',
        'fields' => [
            ['name' => 'a', 'label' => 'Número A', 'type' => 'number'],
            ['name' => 'b', 'label' => 'Número B', 'type' => 'number'],
        ],
        'handler' => function ($d) {
            $a = inum($d['a']);
            $b = inum($d['b']);
            return "O MMC entre {$a} e {$b} é " . lcm_value($a, $b) . '.';
        },
    ],
    // 71) Soma todos os elementos de um vetor informado pelo usuário.
    '71' => [
        'title' => '71: Soma dos elementos do vetor',
        'fields' => [['name' => 'vetor', 'label' => 'Vetor de inteiros', 'type' => 'textarea', 'rows' => '4', 'placeholder' => '1 2 3 4 5']],
        'handler' => function ($d) {
            $values = parse_int_list($d['vetor']);
            return 'A soma dos elementos do vetor é ' . array_sum($values) . '.';
        },
    ],
    // 72) Usa max para encontrar o maior valor do vetor.
    '72' => [
        'title' => '72: Maior elemento do vetor',
        'fields' => [['name' => 'vetor', 'label' => 'Vetor de inteiros', 'type' => 'textarea', 'rows' => '4', 'placeholder' => '7 3 10 2']],
        'handler' => function ($d) {
            $values = parse_int_list($d['vetor']);
            return $values === [] ? 'Informe pelo menos um número.' : 'O maior elemento do vetor é ' . max($values) . '.';
        },
    ],
    // 73) Calcula a média aritmética dos elementos do vetor.
    '73' => [
        'title' => '73: Média do vetor',
        'fields' => [['name' => 'vetor', 'label' => 'Vetor de inteiros', 'type' => 'textarea', 'rows' => '4', 'placeholder' => '5 10 15']],
        'handler' => function ($d) {
            $values = parse_int_list($d['vetor']);
            return $values === [] ? 'Informe pelo menos um número.' : 'A média do vetor é ' . number_format(array_sum($values) / count($values), 2, ',', '.') . '.';
        },
    ],
    // 74) Soma posição por posição dois vetores de mesmo tamanho.
    '74' => [
        'title' => '74: Soma de dois vetores',
        'fields' => [
            ['name' => 'vetor_a', 'label' => 'Vetor A', 'type' => 'textarea', 'rows' => '3', 'placeholder' => '1 2 3'],
            ['name' => 'vetor_b', 'label' => 'Vetor B', 'type' => 'textarea', 'rows' => '3', 'placeholder' => '4 5 6'],
        ],
        'handler' => function ($d) {
            $a = parse_int_list($d['vetor_a']);
            $b = parse_int_list($d['vetor_b']);
            if (count($a) !== count($b)) {
                return 'Os vetores precisam ter o mesmo tamanho.';
            }
            $result = [];
            for ($i = 0; $i < count($a); $i++) {
                $result[] = $a[$i] + $b[$i];
            }
            return ['Vetor resultante: [ ' . implode(', ', $result) . ' ]'];
        },
    ],
    // 75) Compara cada elemento com o próximo para verificar ordem crescente.
    '75' => [
        'title' => '75: Vetor em ordem crescente?',
        'fields' => [['name' => 'vetor', 'label' => 'Vetor de inteiros', 'type' => 'textarea', 'rows' => '4', 'placeholder' => '1 2 3 8']],
        'handler' => function ($d) {
            $values = parse_int_list($d['vetor']);
            for ($i = 0; $i < count($values) - 1; $i++) {
                if ($values[$i] > $values[$i + 1]) {
                    return 'O vetor não está em ordem crescente.';
                }
            }
            return 'O vetor está em ordem crescente.';
        },
    ],
    // 76) Inverte a ordem dos elementos do vetor.
    '76' => [
        'title' => '76: Vetor em ordem inversa',
        'fields' => [['name' => 'vetor', 'label' => 'Vetor de inteiros', 'type' => 'textarea', 'rows' => '4', 'placeholder' => '9 8 7 6']],
        'handler' => function ($d) {
            $values = array_reverse(parse_int_list($d['vetor']));
            return ['Vetor invertido: [ ' . implode(', ', $values) . ' ]'];
        },
    ],
    // 77) Ordena e pega o penúltimo valor distinto como segundo maior.
    '77' => [
        'title' => '77: Segundo maior elemento',
        'fields' => [['name' => 'vetor', 'label' => 'Vetor de inteiros', 'type' => 'textarea', 'rows' => '4', 'placeholder' => '4 8 1 8 6']],
        'handler' => function ($d) {
            $values = array_values(array_unique(parse_int_list($d['vetor'])));
            rsort($values);
            return count($values) < 2 ? 'É preciso informar pelo menos dois valores distintos.' : 'O segundo maior elemento é ' . $values[1] . '.';
        },
    ],
    // 78) Conta quantas vezes um valor aparece no vetor.
    '78' => [
        'title' => '78: Quantas vezes um número aparece',
        'fields' => [
            ['name' => 'vetor', 'label' => 'Vetor de inteiros', 'type' => 'textarea', 'rows' => '4', 'placeholder' => '2 5 2 7 2'],
            ['name' => 'procurado', 'label' => 'Número procurado', 'type' => 'number'],
        ],
        'handler' => function ($d) {
            $values = parse_int_list($d['vetor']);
            $target = inum($d['procurado']);
            $count = 0;
            foreach ($values as $value) {
                if ($value === $target) {
                    $count++;
                }
            }
            return "O número {$target} aparece {$count} vez(es) no vetor.";
        },
    ],
    // 79) Multiplica posição por posição dois vetores de mesmo tamanho.
    '79' => [
        'title' => '79: Multiplicação entre vetores',
        'fields' => [
            ['name' => 'vetor_a', 'label' => 'Vetor A', 'type' => 'textarea', 'rows' => '3', 'placeholder' => '1 2 3'],
            ['name' => 'vetor_b', 'label' => 'Vetor B', 'type' => 'textarea', 'rows' => '3', 'placeholder' => '4 5 6'],
        ],
        'handler' => function ($d) {
            $a = parse_int_list($d['vetor_a']);
            $b = parse_int_list($d['vetor_b']);
            if (count($a) !== count($b)) {
                return 'Os vetores precisam ter o mesmo tamanho.';
            }
            $result = [];
            for ($i = 0; $i < count($a); $i++) {
                $result[] = $a[$i] * $b[$i];
            }
            return ['Vetor resultante: [ ' . implode(', ', $result) . ' ]'];
        },
    ],
    // 80) Verifica se todos os elementos do vetor são pares.
    '80' => [
        'title' => '80: Todos os elementos são pares?',
        'fields' => [['name' => 'vetor', 'label' => 'Vetor de inteiros', 'type' => 'textarea', 'rows' => '4', 'placeholder' => '2 4 6 8']],
        'handler' => function ($d) {
            foreach (parse_int_list($d['vetor']) as $value) {
                if ($value % 2 !== 0) {
                    return 'Nem todos os elementos do vetor são pares.';
                }
            }
            return 'Todos os elementos do vetor são pares.';
        },
    ],
    // 81) Soma os elementos da diagonal principal de uma matriz 3x3.
    '81' => [
        'title' => '81: Soma da diagonal principal 3x3',
        'fields' => [[
            'name' => 'matriz',
            'label' => 'Matriz 3x3 (uma linha por linha)',
            'type' => 'textarea',
            'rows' => '4',
            'placeholder' => "1 2 3\n4 5 6\n7 8 9",
        ]],
        'handler' => function ($d) {
            $matrix = parse_matrix($d['matriz']);
            if (count($matrix) !== 3 || !is_rectangular_matrix($matrix) || count($matrix[0]) !== 3) {
                return 'Informe uma matriz 3x3 válida.';
            }
            $sum = $matrix[0][0] + $matrix[1][1] + $matrix[2][2];
            return "A soma da diagonal principal é {$sum}.";
        },
    ],
    // 82) Gera uma matriz 4x4 aleatória e exibe sua transposta.
    '82' => [
        'title' => '82: Matriz transposta 4x4 aleatória',
        'fields' => [],
        'handler' => function ($d) {
            $matrix = random_matrix(4, 4, 0, 9);
            $transposed = transpose_matrix($matrix);
            return array_merge(['Matriz original:'], format_matrix_lines($matrix), ['Transposta:'], format_matrix_lines($transposed));
        },
    ],
    // 83) Soma duas matrizes 2x2 informadas pelo usuário.
    '83' => [
        'title' => '83: Soma de duas matrizes 2x2',
        'fields' => [
            ['name' => 'matriz_a', 'label' => 'Matriz A 2x2', 'type' => 'textarea', 'rows' => '3', 'placeholder' => "1 2\n3 4"],
            ['name' => 'matriz_b', 'label' => 'Matriz B 2x2', 'type' => 'textarea', 'rows' => '3', 'placeholder' => "5 6\n7 8"],
        ],
        'handler' => function ($d) {
            $a = parse_matrix($d['matriz_a']);
            $b = parse_matrix($d['matriz_b']);
            if (count($a) !== 2 || count($b) !== 2 || !is_rectangular_matrix($a) || !is_rectangular_matrix($b) || count($a[0]) !== 2 || count($b[0]) !== 2) {
                return 'Informe duas matrizes 2x2 válidas.';
            }
            return array_merge(['Matriz soma:'], format_matrix_lines(add_matrices($a, $b)));
        },
    ],
    // 84) Procura o maior valor de uma matriz 5x5 e guarda sua posição.
    '84' => [
        'title' => '84: Maior valor de uma matriz 5x5',
        'fields' => [[
            'name' => 'matriz',
            'label' => 'Matriz 5x5',
            'type' => 'textarea',
            'rows' => '6',
            'placeholder' => "1 2 3 4 5\n6 7 8 9 10\n11 12 13 14 15\n16 17 18 19 20\n21 22 23 24 25",
        ]],
        'handler' => function ($d) {
            $matrix = parse_matrix($d['matriz']);
            if (count($matrix) !== 5 || !is_rectangular_matrix($matrix) || count($matrix[0]) !== 5) {
                return 'Informe uma matriz 5x5 válida.';
            }
            $max = $matrix[0][0];
            $position = [0, 0];
            for ($row = 0; $row < 5; $row++) {
                for ($col = 0; $col < 5; $col++) {
                    if ($matrix[$row][$col] > $max) {
                        $max = $matrix[$row][$col];
                        $position = [$row, $col];
                    }
                }
            }
            return "O maior valor é {$max} e está na posição [{$position[0]}, {$position[1]}].";
        },
    ],
    // 85) Soma os elementos cuja soma dos índices é par e calcula a média.
    '85' => [
        'title' => '85: Média das posições com soma de índices par',
        'fields' => [['name' => 'matriz', 'label' => 'Matriz 3x3', 'type' => 'textarea', 'rows' => '4', 'placeholder' => "1 2 3\n4 5 6\n7 8 9"]],
        'handler' => function ($d) {
            $matrix = parse_matrix($d['matriz']);
            if (count($matrix) !== 3 || !is_rectangular_matrix($matrix) || count($matrix[0]) !== 3) {
                return 'Informe uma matriz 3x3 válida.';
            }
            $sum = 0;
            $count = 0;
            for ($row = 0; $row < 3; $row++) {
                for ($col = 0; $col < 3; $col++) {
                    if ((($row + $col) % 2) === 0) {
                        $sum += $matrix[$row][$col];
                        $count++;
                    }
                }
            }
            return 'A média das posições com soma de índices par é ' . number_format($sum / $count, 2, ',', '.') . '.';
        },
    ],
    // 86) Gera uma matriz 4x4 e calcula somas de linhas e colunas.
    '86' => [
        'title' => '86: Soma de linhas e colunas da matriz 4x4',
        'fields' => [],
        'handler' => function ($d) {
            $matrix = random_matrix(4, 4, 0, 9);
            $lines = ['Matriz gerada:'];
            foreach (format_matrix_lines($matrix) as $line) {
                $lines[] = $line;
            }
            for ($row = 0; $row < 4; $row++) {
                $lines[] = 'Soma da linha ' . ($row + 1) . ': ' . array_sum($matrix[$row]);
            }
            for ($col = 0; $col < 4; $col++) {
                $sum = 0;
                for ($row = 0; $row < 4; $row++) {
                    $sum += $matrix[$row][$col];
                }
                $lines[] = 'Soma da coluna ' . ($col + 1) . ': ' . $sum;
            }
            return $lines;
        },
    ],
    // 87) Calcula o determinante de uma matriz 3x3.
    '87' => [
        'title' => '87: Determinante de matriz 3x3',
        'fields' => [['name' => 'matriz', 'label' => 'Matriz 3x3', 'type' => 'textarea', 'rows' => '4', 'placeholder' => "1 2 3\n0 1 4\n5 6 0"]],
        'handler' => function ($d) {
            $matrix = parse_matrix($d['matriz']);
            if (count($matrix) !== 3 || !is_rectangular_matrix($matrix) || count($matrix[0]) !== 3) {
                return 'Informe uma matriz 3x3 válida.';
            }
            return 'O determinante da matriz é ' . determinant_3x3($matrix) . '.';
        },
    ],
    // 88) Verifica compatibilidade e multiplica as matrizes quando possível.
    '88' => [
        'title' => '88: Multiplicação entre matrizes',
        'fields' => [
            ['name' => 'matriz_a', 'label' => 'Matriz A', 'type' => 'textarea', 'rows' => '5', 'placeholder' => "1 2\n3 4"],
            ['name' => 'matriz_b', 'label' => 'Matriz B', 'type' => 'textarea', 'rows' => '5', 'placeholder' => "5 6\n7 8"],
        ],
        'handler' => function ($d) {
            $a = parse_matrix($d['matriz_a']);
            $b = parse_matrix($d['matriz_b']);
            if (!is_rectangular_matrix($a) || !is_rectangular_matrix($b)) {
                return 'Informe matrizes válidas.';
            }
            if (count($a[0]) !== count($b)) {
                return 'Não é possível multiplicar: o número de colunas da matriz A deve ser igual ao número de linhas da matriz B.';
            }
            return array_merge(['Matriz resultante:'], format_matrix_lines(multiply_matrices($a, $b)));
        },
    ],
    // 89) Verifica se todos os elementos fora da diagonal principal são zero.
    '89' => [
        'title' => '89: Matriz diagonal 4x4?',
        'fields' => [['name' => 'matriz', 'label' => 'Matriz 4x4', 'type' => 'textarea', 'rows' => '5', 'placeholder' => "1 0 0 0\n0 2 0 0\n0 0 3 0\n0 0 0 4"]],
        'handler' => function ($d) {
            $matrix = parse_matrix($d['matriz']);
            if (count($matrix) !== 4 || !is_rectangular_matrix($matrix) || count($matrix[0]) !== 4) {
                return 'Informe uma matriz 4x4 válida.';
            }
            for ($row = 0; $row < 4; $row++) {
                for ($col = 0; $col < 4; $col++) {
                    if ($row !== $col && $matrix[$row][$col] !== 0) {
                        return 'A matriz não é diagonal.';
                    }
                }
            }
            return 'A matriz é diagonal.';
        },
    ],
    // 90) Para cada posição, conta as minas existentes nas casas vizinhas.
    '90' => [
        'title' => '90: Campo minado',
        'fields' => [['name' => 'matriz', 'label' => 'Matriz de minas (0 e 1)', 'type' => 'textarea', 'rows' => '5', 'placeholder' => "0 1 0\n1 0 0\n0 0 1"]],
        'handler' => function ($d) {
            $matrix = parse_matrix($d['matriz']);
            if (!is_rectangular_matrix($matrix)) {
                return 'Informe uma matriz válida.';
            }
            return array_merge(['Matriz de pistas:'], format_matrix_lines(minesweeper_hints($matrix)));
        },
    ],
    // 91) Calcula fatorial usando recursão.
    '91' => [
        'title' => '91: Fatorial recursivo',
        'fields' => [['name' => 'n', 'label' => 'Número N', 'type' => 'number', 'min' => '0']],
        'handler' => function ($d) {
            $n = inum($d['n']);
            return "O fatorial de {$n} é " . factorial_recursive($n) . '.';
        },
    ],
    // 93) Verifica primalidade por recursão.
    '93' => [
        'title' => '93: Primo recursivo',
        'fields' => [['name' => 'n', 'label' => 'Número N', 'type' => 'number']],
        'handler' => fn($d) => is_prime_recursive(inum($d['n'])) ? 'O número informado é primo.' : 'O número informado não é primo.',
    ],
    // 94) Soma recursivamente os dígitos de um número.
    '94' => [
        'title' => '94: Soma dos dígitos recursiva',
        'fields' => [['name' => 'n', 'label' => 'Número inteiro', 'type' => 'number']],
        'handler' => function ($d) {
            $n = inum($d['n']);
            return "A soma dos dígitos de {$n} é " . sum_digits_recursive($n) . '.';
        },
    ],
    // 95) Calcula potência usando recursão.
    '95' => [
        'title' => '95: Potência recursiva',
        'fields' => [
            ['name' => 'base', 'label' => 'Base', 'type' => 'number'],
            ['name' => 'expoente', 'label' => 'Expoente', 'type' => 'number', 'min' => '0'],
        ],
        'handler' => function ($d) {
            $base = inum($d['base']);
            $exponent = inum($d['expoente']);
            return "{$base} elevado a {$exponent} é " . power_recursive($base, $exponent) . '.';
        },
    ],
    // 96) Calcula o MDC com recursão.
    '96' => [
        'title' => '96: MDC recursivo',
        'fields' => [
            ['name' => 'a', 'label' => 'Número A', 'type' => 'number'],
            ['name' => 'b', 'label' => 'Número B', 'type' => 'number'],
        ],
        'handler' => function ($d) {
            $a = inum($d['a']);
            $b = inum($d['b']);
            return "O MDC entre {$a} e {$b} é " . gcd_recursive($a, $b) . '.';
        },
    ],
    // 97) Inverte string usando recursão para praticar decomposição do problema.
    '97' => [
        'title' => '97: Inverter string recursivamente',
        'fields' => [['name' => 'texto', 'label' => 'Texto', 'type' => 'text']],
        'handler' => fn($d) => 'Texto invertido: ' . reverse_string_recursive($d['texto']),
    ],
    // 98) Encontra o menor valor do vetor usando recursão.
    '98' => [
        'title' => '98: Menor valor do vetor recursivamente',
        'fields' => [['name' => 'vetor', 'label' => 'Vetor de inteiros', 'type' => 'textarea', 'rows' => '4', 'placeholder' => '8 2 5 1 9']],
        'handler' => function ($d) {
            $values = parse_int_list($d['vetor']);
            return $values === [] ? 'Informe pelo menos um número.' : 'O menor valor do vetor é ' . min_recursive($values) . '.';
        },
    ],
    // 99) Testa palíndromo com recursão.
    '99' => [
        'title' => '99: Palíndromo recursivo',
        'fields' => [['name' => 'texto', 'label' => 'Palavra ou frase', 'type' => 'text']],
        'handler' => fn($d) => palindrome_recursive($d['texto']) ? 'O texto informado é um palíndromo.' : 'O texto informado não é um palíndromo.',
    ],
    // 100) Soma todos os elementos do vetor usando recursão.
    '100' => [
        'title' => '100: Soma recursiva dos elementos do vetor',
        'fields' => [['name' => 'vetor', 'label' => 'Vetor de inteiros', 'type' => 'textarea', 'rows' => '4', 'placeholder' => '3 6 9']],
        'handler' => function ($d) {
            $values = parse_int_list($d['vetor']);
            return 'A soma recursiva dos elementos do vetor é ' . sum_array_recursive($values) . '.';
        },
    ],
];

// Exercício selecionado no formulário. O padrão começa no 52.
$action = post('action') ?: '52';

// Prepara metadados dos campos para o JavaScript montar o formulário dinamicamente.
$meta = [];
foreach ($programs as $key => $program) {
    $fields = [];
    foreach ($program['fields'] as $field) {
        $name = $field['name'];
        $field['value'] = post($name);
        $fields[] = $field;
    }
    $meta[$key] = ['title' => $program['title'], 'fields' => $fields];
}

// Coleta apenas os dados dos campos do exercício atual.
$input = [];
foreach ($programs[$action]['fields'] ?? [] as $field) {
    $input[$field['name']] = post($field['name']);
}

// Executa o handler do exercício selecionado após o envio do formulário.
$result = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($programs[$action])) {
    $result = $programs[$action]['handler']($input);
}
?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercícios 52–100</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 24px; line-height: 1.5; }
        form { max-width: 860px; }
        label { display: block; margin: 10px 0 4px; font-weight: 600; }
        input, textarea, select, button { width: 100%; max-width: 100%; padding: 8px; box-sizing: border-box; }
        textarea { resize: vertical; }
        button { margin-top: 12px; cursor: pointer; }
        .resultado { margin-top: 20px; padding: 12px; border: 1px solid #ccc; background: #f7f7f7; }
    </style>
    <script>
        let programs = null;

        function buildField(field) {
            const wrapper = document.createElement('div');
            const label = document.createElement('label');
            label.textContent = field.label || field.name;

            let element;
            if (field.type === 'textarea') {
                element = document.createElement('textarea');
                element.rows = field.rows || 4;
            } else {
                element = document.createElement('input');
                element.type = field.type || 'text';
                if (field.min !== undefined) {
                    element.min = field.min;
                }
            }

            element.name = field.name;
            if (field.placeholder) {
                element.placeholder = field.placeholder;
            }
            if (field.value) {
                element.value = field.value;
            }

            label.appendChild(element);
            wrapper.appendChild(label);
            return wrapper;
        }

        window.addEventListener('DOMContentLoaded', () => {
            programs = window.__programs_meta || {};
            const select = document.getElementById('exercise');
            const fields = document.getElementById('fields');

            function render() {
                const current = programs[select.value] || { fields: [] };
                fields.innerHTML = '';
                (current.fields || []).forEach((field) => fields.appendChild(buildField(field)));
            }

            select.addEventListener('change', render);
            render();
        });
    </script>
</head>
<body>
<h1>Exercícios 52–100</h1>
<p>Escolha um exercício, preencha os campos necessários e clique em executar.</p>

<form method="post">
    <label for="exercise">Escolha o exercício:</label>
    <select id="exercise" name="action">
        <?php foreach ($programs as $key => $program): ?>
            <option value="<?= esc($key) ?>" <?= $action === $key ? 'selected' : '' ?>><?= esc($program['title']) ?></option>
        <?php endforeach; ?>
    </select>

    <div id="fields"></div>

    <button type="submit">Executar</button>
</form>

<?php if ($result !== ''): ?>
    <div class="resultado">
        <h2>Resultado</h2>
        <?php if (is_array($result)): ?>
            <ul>
                <?php foreach ($result as $item): ?>
                    <li><?= esc($item) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p><strong><?= esc($result) ?></strong></p>
        <?php endif; ?>
    </div>
<?php endif; ?>

<script>
    window.__programs_meta = <?= json_encode($meta, JSON_UNESCAPED_UNICODE) ?>;
</script>
</body>
</html>


