# verificar se existe algum numero no texto
<?php
$texto = "O número é 12345";
if (preg_match('/\d+/', $texto, $matches)) {
    echo "Número encontrado: " . $matches[0];
} else {
    echo "Nenhum número encontrado.";
}       
?>

# validar email
<?php
$email = "usuario@18bimtz.com.br";
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Email válido.";
} else {
    echo "Email inválido.";
}
?>

# validar url<?php
$url = "https://www.exemplo.com";   
if (filter_var($url, FILTER_VALIDATE_URL)) {
    echo "URL válida.";
} else {
    echo "URL inválida.";
}
?>

# validar telefone 
<?php
$telefone = "(11) 98765-4321";  
if (preg_match('/^\(\d{2}\) \d{5}-\d{4}$/', $telefone)) {
    echo "Telefone válido.";
} else {
    echo "Telefone inválido.";
}

# substituir números em um texto por asterisco <?php
$texto = "Meu número de telefone é (11) 98765-4321";    
$textoModificado = preg_replace('/\d/', '*', $texto);
echo $textoModificado;
?>
     


