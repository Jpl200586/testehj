<?php
# MANIPULAÇÃO DE ARQUIVOS
########## Principais Modos ################
/* 
| Modo | Descrição                          |
| ---- | ---------------------------------- |
| r    | Apenas leitura                     |
| w    | Escrita (apaga conteúdo existente) |
| a    | Adiciona conteúdo ao final         |
| r+   | Leitura e escrita                  |
| w+   | Leitura e escrita (apaga conteúdo) |
| a+   | Leitura e escrita ao final         |
*/

####### Resumo das Funções Mais Importantes ##
/*
| Função               | Utilidade            |
| -------------------- | -------------------- |
| fopen()              | Abrir arquivo        |
| fclose()             | Fechar arquivo       |
| fwrite()             | Escrever             |
| fread()              | Ler                  |
| fgets()              | Ler linha            |
| fgetc()              | Ler caractere        |
| feof()               | Final do arquivo     |
| file()               | Arquivo em array     |
| file_get_contents()  | Ler tudo             |
| file_put_contents()  | Escrever tudo        |
| mkdir()              | Criar diretório      |
| rmdir()              | Remover diretório    |
| unlink()             | Excluir arquivo      |
| file_exists()        | Verificar existência |
| move_uploaded_file() | Upload               |
| pathinfo()           | Obter extensão       |
*/

# fopen("arquivo.txt", "w");

$arquivo = fopen("arquivo.txt", "w");

if($arquivo){
    echo "Arquivo aberto com sucesso";
}else{
    echo "Erro ao abrir o arquivo";
}

# ESCREVENDO NO ARQUIVO
# fwrite()

fwrite($arquivo, "dados da aula do dia 19/06");

# FECHANDO O ARQUIVO
fclose($arquivo);

# FAZENDO UMA LEITURA DO ARQUIVO

$arquivo = fopen("dados.txt", "w");

fwrite($arquivo, "Olá Mundo!");

fclose($arquivo);

$arquivo = fopen("dados.txt", "r");

$conteudo = fread($arquivo, filesize("dados.txt"));

fclose($arquivo);

echo "<br>" . $conteudo;

#### EXEMPLO COMPLETO ####
$arquivo = fopen("mensagem.txt", "w");

fwrite($arquivo, "PHP é incrível!");

fclose($arquivo);

$arquivo = fopen("mensagem.txt", "r");

echo "<br>" . fread($arquivo, filesize("mensagem.txt"));

fclose($arquivo);

# LEITURA LINHA POR LINHA

### fgets()

$arquivo = fopen("alunos.txt", "r");

while(!feof($arquivo)){
    echo "<br>";
    echo fgets($arquivo);
}

fclose($arquivo);

# feof();  // Verifica se chegou ao final do arquivo.

## Ler Caractere por Caractere

### fgetc()

$arquivo = fopen("texto.txt", "r");

while(!feof($arquivo)){
    echo "<br>";
    echo fgetc($arquivo);
}

fclose($arquivo);

# PEGA AS LINHAS E ADICIONA AO ARRAY
$alunos = file("alunos.txt");

print_r($alunos);

echo "<br>" . $alunos[1];

### LÊ TODO ARQUIVO

$conteudo = file_get_contents("dados.txt");

echo "<br>" . $conteudo;

## ACRESCENTAR CONTEUDO

$novo = file_put_contents("dados.txt", "Novo conteúdo");
echo "<br>" . $novo;

## TRABALHANDO COM DIRETORIOS
## CRIAR PASTA

### mkdir()

mkdir("uploads");

## Verificar se Existe

if(file_exists("uploads")){
    echo "<br>" . "Pasta existe";
}

## EXCLUIR ARQUIVO

### unlink()

unlink("dados.txt");

## REMOVER DIRETÓRIO

### rmdir()

rmdir("uploads");

## Exemplo de Upload

if(isset($_FILES['arquivo'])){

    move_uploaded_file(
        $_FILES['arquivo']['tmp_name'],
        "uploads/" . $_FILES['arquivo']['name']
    );

    echo "Upload realizado!";
}

## Validar Extensão

$extensao = pathinfo(
    $_FILES['arquivo']['name'],
    PATHINFO_EXTENSION
);

if($extensao == "pdf"){
    echo "Arquivo permitido";
}

## Validar Tamanho

if($_FILES['arquivo']['size'] <= 2000000){
    echo "Tamanho válido";
}

?>

<!-- ### Formulário HTML -->
<!-- /************************************************* -->
<form method="post" enctype="multipart/form-data">

    <input type="file" name="arquivo">

    <input type="submit" value="Enviar">

</form>
<!-- *************************************************/ -->
Crie um sistema que:

1. Crie uma pasta chamada:

```txt
documentos
```

2. Crie um arquivo:

```txt
usuarios.txt
```
3. Grave 5 nomes.

4. Leia o conteúdo.

execute o comando acima e me mostre o resultado.Para criar o sistema solicitado, você pode usar o seguinte código PHP. Este código cria uma pasta chamada "documentos", cria um arquivo chamado "usuarios.txt" dentro dessa pasta, grava 5 nomes no arquivo e, em seguida, lê o conteúdo do arquivo para exibir os nomes gravados.```php
<?php

mkdir("documentos");
$arquivo = fopen("documentos/usuarios.txt", "w");
fwrite($arquivo, "João\nMaria\nPedro\nAna\nCarlos");
fclose($arquivo);
$arquivo = fopen("documentos/usuarios.txt", "r");
echo fread($arquivo, filesize("documentos/usuarios.txt"));
fclose($arquivo);
```


