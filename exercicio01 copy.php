<?php
// Função para limpar e proteger valores que vêm do usuário.
function sanitizeInput($value) {
    return htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
}

// Converte o valor POST em número de ponto flutuante.
// Se o campo não existir, retorna 0.
function getPostedNumber($name) {
    return isset($_POST[$name]) ? floatval($_POST[$name]) : 0;
}

// Retorna o valor POST limpo para exibir no formulário.
function getPostedValue($name) {
    return isset($_POST[$name]) ? sanitizeInput($_POST[$name]) : '';
}

// Exibe um campo numérico com label e valor preenchido.
function renderInputField($name, $label) {
    $value = getPostedValue($name);
    echo "<label>{$label}: <input type='number' name='{$name}' value='{$value}' step='any' required></label><br><br>";
}

// Envolve o resultado em um bloco HTML estilizado.
function renderResult($content) {
    return "<div class='result'><h3>Resultado:</h3>{$content}</div>";
}

// Lista de exercícios, cada um com título e campos necessários.
$tasks = [
    '1' => ['title' => '1. Operações entre dois números', 'fields' => [['num1', 'Número 1'], ['num2', 'Número 2']]],
    '2' => ['title' => '2. Média aritmética de dois números', 'fields' => [['num1', 'Número 1'], ['num2', 'Número 2']]],
    '3' => ['title' => '3. Média aritmética de três notas', 'fields' => [['nota1', 'Nota 1'], ['nota2', 'Nota 2'], ['nota3', 'Nota 3']]],
    '4' => ['title' => '4. Cálculo do IMC', 'fields' => [['peso', 'Peso (kg)'], ['altura', 'Altura (m)']]],
    '5' => ['title' => '5. Perímetro de um círculo', 'fields' => [['raio', 'Raio']]],
    '6' => ['title' => '6. Área de um círculo', 'fields' => [['raio', 'Raio']]],
    '7' => ['title' => '7. Equação de segundo grau (Bhaskara)', 'fields' => [['a', 'Coeficiente a'], ['b', 'Coeficiente b'], ['c', 'Coeficiente c']]],
    '8' => ['title' => '8. Perímetro e área do retângulo', 'fields' => [['largura', 'Largura (l)'], ['comprimento', 'Comprimento (c)']]],
    '9' => ['title' => '9. Perímetro e área do triângulo', 'fields' => [['a', 'Lado a'], ['b', 'Lado b'], ['c', 'Lado c'], ['h', 'Altura relativa ao lado b']]],
];

// Pega o exercício selecionado pela URL, ex: ?task=3
$task = $_GET['task'] ?? null;

// Calcula o resultado de acordo com o exercício escolhido.
function calculateResult($task) {
    switch ($task) {
        case '1':
            $num1 = getPostedNumber('num1');
            $num2 = getPostedNumber('num2');
            return renderResult(
                "<p>Soma: " . number_format($num1 + $num2, 2) . "</p>" .
                "<p>Subtração: " . number_format($num1 - $num2, 2) . "</p>" .
                "<p>Multiplicação: " . number_format($num1 * $num2, 2) . "</p>" .
                "<p>Divisão: " . ($num2 !== 0 ? number_format($num1 / $num2, 2) : 'não é possível dividir por zero') . "</p>"
            );

        case '2':
            $num1 = getPostedNumber('num1');
            $num2 = getPostedNumber('num2');
            return renderResult("<p>Média aritmética: " . number_format(($num1 + $num2) / 2, 2) . "</p>");

        case '3':
            $nota1 = getPostedNumber('nota1');
            $nota2 = getPostedNumber('nota2');
            $nota3 = getPostedNumber('nota3');
            return renderResult("<p>Média aritmética: " . number_format(($nota1 + $nota2 + $nota3) / 3, 2) . "</p>");

        case '4':
            $peso = getPostedNumber('peso');
            $altura = getPostedNumber('altura');
            if ($altura <= 0) {
                return renderResult('<p>Altura inválida. Informe um valor maior que zero.</p>');
            }
            return renderResult("<p>IMC: " . number_format($peso / ($altura * $altura), 2) . "</p>");

        case '5':
            $raio = getPostedNumber('raio');
            if ($raio < 0) {
                return renderResult('<p>Raio inválido. Informe valor maior ou igual a zero.</p>');
            }
            return renderResult("<p>Perímetro do círculo: " . number_format(2 * pi() * $raio, 2) . "</p>");

        case '6':
            $raio = getPostedNumber('raio');
            if ($raio < 0) {
                return renderResult('<p>Raio inválido. Informe valor maior ou igual a zero.</p>');
            }
            return renderResult("<p>Área do círculo: " . number_format(pi() * $raio * $raio, 2) . "</p>");

        case '7':
            $a = getPostedNumber('a');
            $b = getPostedNumber('b');
            $c = getPostedNumber('c');
            if ($a == 0) {
                return renderResult('<p>Coeficiente a não pode ser zero em uma equação do segundo grau.</p>');
            }
            $delta = $b * $b - 4 * $a * $c;
            if ($delta < 0) {
                return renderResult('<p>Não há raízes reais (delta negativo).</p>');
            }
            $x1 = (-$b + sqrt($delta)) / (2 * $a);
            $x2 = (-$b - sqrt($delta)) / (2 * $a);
            return renderResult(
                "<p>Delta: " . number_format($delta, 2) . "</p>" .
                "<p>Raiz x₁: " . number_format($x1, 2) . "</p>" .
                "<p>Raiz x₂: " . number_format($x2, 2) . "</p>"
            );

        case '8':
            $largura = getPostedNumber('largura');
            $comprimento = getPostedNumber('comprimento');
            if ($largura < 0 || $comprimento < 0) {
                return renderResult('<p>Valores inválidos. Informe largura e comprimento maiores ou iguais a zero.</p>');
            }
            return renderResult(
                "<p>Perímetro: " . number_format(2 * ($largura + $comprimento), 2) . "</p>" .
                "<p>Área: " . number_format($largura * $comprimento, 2) . "</p>"
            );

        case '9':
            $a = getPostedNumber('a');
            $b = getPostedNumber('b');
            $c = getPostedNumber('c');
            $h = getPostedNumber('h');
            if ($a < 0 || $b < 0 || $c < 0 || $h < 0) {
                return renderResult('<p>Valores inválidos. Informe lados e altura maiores ou iguais a zero.</p>');
            }
            return renderResult(
                "<p>Perímetro: " . number_format($a + $b + $c, 2) . "</p>" .
                "<p>Área: " . number_format(($b * $h) / 2, 2) . "</p>"
            );

        default:
            return '';
    }
}
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

        <!-- Lista de exercícios disponíveis no menu -->
        <div class="menu">
            <?php foreach ($tasks as $id => $info): ?>
                <a href="?task=<?php echo $id; ?>"><?php echo $info['title']; ?></a><br>
            <?php endforeach; ?>
        </div>

        <!-- Se nenhum exercício estiver selecionado, mostra instrução simples -->
        <?php if (!$task || !isset($tasks[$task])): ?>
            <p>Selecione um dos exercícios acima para abrir o formulário correspondente.</p>
        <?php else: ?>
            <!-- Formulário do exercício selecionado -->
            <form method="post" action="?task=<?php echo sanitizeInput($task); ?>">
                <h2><?php echo $tasks[$task]['title']; ?></h2>
                <?php foreach ($tasks[$task]['fields'] as $field): ?>
                    <?php renderInputField($field[0], $field[1]); ?>
                <?php endforeach; ?>
                <button type="submit">Calcular</button>
            </form>

            <!-- Mostra o resultado quando o formulário for enviado -->
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                echo calculateResult($task);
            }
            ?>
        <?php endif; ?>
    </div>
</body>
</html>

