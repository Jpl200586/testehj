<?php
/**************************
 * FUNCOES DE DATA E HORA
 **************************/

echo "<h4> Buscando a data e hora </h4>";
echo date("d/m/Y");
echo "<br>";
echo date("H:i:s");
echo "<hr>";
/************************/
echo "<h4> Ajustando o fuso horario </h4>";
date_default_timezone_set("America/Sao_Paulo");
echo date("d/m/Y" . "-" . "h:i:s");
echo "<hr>";
/************************/
echo "<h4> Timestamp(tempo em segundos desde 1 janeiro de 1970) </h4>";
echo time();
echo "<br>";
echo "<hr>";
/************************/
$timestamp = time();

echo date("d/m/Y H:i:s", $timestamp);
echo "<br>";
echo "<hr>";
/************************/
echo "<h4> Timestamp apartir da data e hora </h4>";
$data = strtotime("20-12-2026");

echo date("d/m/Y", $data);
echo "<hr>";
/************************/
echo "<h4> Somar ou subtrair datas </h4>";
echo date("d/m/Y",strtotime("+10 days"));
echo "<br>";
echo date("d/m/Y",strtotime("-10 days"));
echo "<br>";
echo date("d/m/Y",strtotime("+1 week"));
echo "<br>";
echo date("d/m/Y",strtotime("+1 month"));
echo "<br>";
echo date("d/m/Y",strtotime("+1 year"));
echo "<br>";
echo "<hr>";
/************************/
echo "<h4> Retorna informações da data atual na forma de array</h4>";
print_r(getdate());
echo "<br>";
echo "<hr>";
/************************/
echo "<h4> Verifica se uma data existe</h4>";
if (checkdate(2, 29, 2024)) {
    echo "Data Existe";
} else {
    echo "Data não existe";
}
echo "<hr>";
/************************/
echo "<h4> Classe datatime </h4>";
$data = new DateTime();

echo $data->format("d/m/Y - H:i:s");
echo "<br>";
echo "<hr>";
/************************/
echo "<h4> Adicionando dias a uma data </h4>";

$data = new DateTime();

$data->modify("+30 days");

echo $data->format("d/m/Y");
echo "<hr>";
/************************/
echo "<h4> Diferença entre datas </h4>";
$inicio = new DateTime("2026-06-01");
$fim = new DateTime("2026-06-17");

$diferenca = $inicio->diff($fim);

echo $diferenca->days;
echo "<br>" . "<hr>";

echo "<h4> A partir do ano retorna a idade </h4>";
$nascimento = new DateTime("1985-05-10");

$hoje = new DateTime();

$idade = $nascimento->diff($hoje);

echo "Idade: " . $idade->y . " anos";

# exemplo prático

echo "<br>";
date_default_timezone_set("America/Sao_Paulo");
echo date("d/m/Y H:i:s");
?>