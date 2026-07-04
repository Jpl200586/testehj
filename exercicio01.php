<?php
function sanitize($value) {
    return htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
}

function inputValue($name) {
    return isset($_POST[$name]) ? sanitize($_POST[$name]) : '';
}

function showFormValue($name, $label, $type = 'number', $step = 'any') {
    $value = inputValue($name);
    echo "<label>{$label}: <input type='{$type}' name='{$name}' value='{$value}' step='{$step}' required></label><br><br>";
}

$tasks = [
    '1' => [
        'title' => '1. Operações entre dois números',
        'fields' => [
            ['num1', 'Número 1'],
            ['num2', 'Número 2'],
        ],
    ],
    '2' => [
        'title' => '2. Média aritmética de dois números',
        'fields' => [
            ['num1', 'Número 1'],
            ['num2', 'Número 2'],
        ],
    ],
    '3' => [
        'title' => '3. Média aritmética de três notas',
        'fields' => [
            ['nota1', 'Nota 1'],
            ['nota2', 'Nota 2'],
            ['nota3', 'Nota 3'],
        ],
    ],
    '4' => [
        'title' => '4. Cálculo do IMC',
        'fields' => [
            ['peso', 'Peso (kg)'],
            ['altura', 'Altura (m)'],
        ],
    ],
    '5' => [
        'title' => '5. Perímetro de um círculo',
        'fields' => [
            ['raio', 'Raio'],
        ],
    ],
    '6' => [
        'title' => '6. Área de um círculo',
        'fields' => [
            ['raio', 'Raio'],
        ],
    ],
    '7' => [
        'title' => '7. Equação de segundo grau (Bhaskara)',
        'fields' => [
            ['a', 'Coeficiente a'],
            ['b', 'Coeficiente b'],
            ['c', 'Coeficiente c'],
        ],
    ],
    '8' => [
        'title' => '8. Perímetro e área do retângulo',
        'fields' => [
            ['largura', 'Largura (l)'],
            ['comprimento', 'Comprimento (c)'],
        ],
    ],
    '9' => [
        'title' => '9. Perímetro e área do triângulo',
        'fields' => [
            ['a', 'Lado a'],
            ['b', 'Lado b'],
            ['c', 'Lado c'],
            ['h', 'Altura relativa ao lado b'],
        ],
    ],
];

$task = isset($_GET['task']) ? $_GET['task'] : null;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Exercícios PHP</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        input[type=number] { width: 120px; }
        .box { padding: 20px; border: 1px solid #ccc; border-radius: 6px; max-width: 520px; }
        .result { margin-top: 20px; padding: 16px; background: #f7f7f7; border: 1px solid #ddd; border-radius: 6px; }
        .menu a { display: inline-block; margin: 6px 0; }
    </style>
</head>
<body>
    <div class="box">
        <h1>Exercícios PHP</h1>
        <p>Escolha um exercício e preencha os valores.</p>
        <div class="menu">
            <?php foreach ($tasks as $id => $info): ?>
                <a href="?task=<?php echo $id; ?>"><?php echo $info['title']; ?></a><br>
            <?php endforeach; ?>
        </div>

        <?php if (!$task || !isset($tasks[$task])): ?>
            <p>Selecione um dos exercícios acima para abrir o formulário correspondente.</p>
        <?php else: ?>
            <form method="post" action="?task=<?php echo sanitize($task); ?>">
                <h2><?php echo $tasks[$task]['title']; ?></h2>
                <?php foreach ($tasks[$task]['fields'] as $field): ?>
                    <?php showFormValue($field[0], $field[1]); ?>
                <?php endforeach; ?>
                <button type="submit">Calcular</button>
            </form>

            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $result = null;
                switch ($task) {
                    case '1':
                        $num1 = floatval($_POST['num1']);
                        $num2 = floatval($_POST['num2']);
                        $result = "<h3>Resultados:</h3>";
                        $result .= "<p>Soma: " . ($num1 + $num2) . "</p>";
                        $result .= "<p>Subtração: " . ($num1 - $num2) . "</p>";
                        $result .= "<p>Multiplicação: " . ($num1 * $num2) . "</p>";
                        $result .= $num2 != 0 ? "<p>Divisão: " . ($num1 / $num2) . "</p>" : '<p>Divisão: não é possível dividir por zero.</p>';
                        break;
                    case '2':
                        $num1 = floatval($_POST['num1']);
                        $num2 = floatval($_POST['num2']);
                        $result = "<h3>Resultado:</h3><p>Média aritmética: " . (($num1 + $num2) / 2) . "</p>";
                        break;
                    case '3':
                        $nota1 = floatval($_POST['nota1']);
                        $nota2 = floatval($_POST['nota2']);
                        $nota3 = floatval($_POST['nota3']);
                        $result = "<h3>Resultado:</h3><p>Média aritmética: " . (($nota1 + $nota2 + $nota3) / 3) . "</p>";
                        break;
                    case '4':
                        $peso = floatval($_POST['peso']);
                        $altura = floatval($_POST['altura']);
                        if ($altura > 0) {
                            $result = "<h3>Resultado:</h3><p>IMC: " . number_format($peso / ($altura * $altura), 2) . "</p>";
                        } else {
                            $result = '<h3>Resultado:</h3><p>Altura inválida. Informe um valor maior que zero.</p>';
                        }
                        break;
                    case '5':
                        $raio = floatval($_POST['raio']);
                        if ($raio >= 0) {
                            $result = "<h3>Resultado:</h3><p>Perímetro do círculo: " . number_format(2 * pi() * $raio, 2) . "</p>";
                        } else {
                            $result = '<h3>Resultado:</h3><p>Raio inválido. Informe um valor maior ou igual a zero.</p>';
                        }
                        break;
                    case '6':
                        $raio = floatval($_POST['raio']);
                        if ($raio >= 0) {
                            $result = "<h3>Resultado:</h3><p>Área do círculo: " . number_format(pi() * $raio * $raio, 2) . "</p>";
                        } else {
                            $result = '<h3>Resultado:</h3><p>Raio inválido. Informe um valor maior ou igual a zero.</p>';
                        }
                        break;
                    case '7':
                        $a = floatval($_POST['a']);
                        $b = floatval($_POST['b']);
                        $c = floatval($_POST['c']);
                        if ($a == 0) {
                            $result = '<h3>Resultado:</h3><p>Coeficiente a não pode ser zero em uma equação do segundo grau.</p>';
                        } else {
                            $delta = $b * $b - 4 * $a * $c;
                            if ($delta < 0) {
                                $result = '<h3>Resultado:</h3><p>Não há raízes reais (delta negativo).</p>';
                            } else {
                                $x1 = (-$b + sqrt($delta)) / (2 * $a);
                                $x2 = (-$b - sqrt($delta)) / (2 * $a);
                                $result = "<h3>Resultado:</h3><p>Delta: {$delta}</p>";
                                $result .= "<p>Raiz x₁: " . number_format($x1, 2) . "</p>";
                                $result .= "<p>Raiz x₂: " . number_format($x2, 2) . "</p>";
                            }
                        }
                        break;
                    case '8':
                        $largura = floatval($_POST['largura']);
                        $comprimento = floatval($_POST['comprimento']);
                        if ($largura >= 0 && $comprimento >= 0) {
                            $result = "<h3>Resultado:</h3><p>Perímetro: " . number_format(2 * ($largura + $comprimento), 2) . "</p>";
                            $result .= "<p>Área: " . number_format($largura * $comprimento, 2) . "</p>";
                        } else {
                            $result = '<h3>Resultado:</h3><p>Valores inválidos. Informe largura e comprimento maiores ou iguais a zero.</p>';
                        }
                        break;
                    case '9':
                        $a = floatval($_POST['a']);
                        $b = floatval($_POST['b']);
                        $c = floatval($_POST['c']);
                        $h = floatval($_POST['h']);
                        if ($a >= 0 && $b >= 0 && $c >= 0 && $h >= 0) {
                            $result = "<h3>Resultado:</h3><p>Perímetro: " . number_format($a + $b + $c, 2) . "</p>";
                            $result .= "<p>Área: " . number_format(($b * $h) / 2, 2) . "</p>";
                        } else {
                            $result = '<h3>Resultado:</h3><p>Valores inválidos. Informe lados e altura maiores ou iguais a zero.</p>';
                        }
                        break;
                }

                if ($result !== null) {
                    echo '<div class="result">' . $result . '</div>';
                }
            }
            ?>
        <?php endif; ?>
    </div>
</body>
</html>
