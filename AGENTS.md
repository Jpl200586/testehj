# AGENTS.md

## Visão geral

- Repositório didático pequeno, com arquivos PHP independentes para aulas (`aula*.php`) e exercícios (`exercicio*.php`).
- Não há `composer.json`, suíte de testes, framework nem autoload.
- O projeto roda em dois contextos: navegador via XAMPP e terminal via PHP CLI.

## Idioma

- Escreva explicações, comentários novos e mensagens exibidas ao usuário em português do Brasil, salvo pedido explícito em outro idioma.
- Preserve nomes de variáveis, rótulos e textos já existentes em português.
- Evite "traduzir" identificadores existentes sem necessidade funcional.

## Convenções do código

- Trate cada arquivo como script autônomo; não introduza estrutura de projeto, namespaces ou dependências sem pedido explícito.
- Preserve o estilo simples e direto dos exercícios.
- Em arquivos web, mantenha compatibilidade com HTML gerado pelo PHP e com `POST` simples.
- Em arquivos CLI, preserve leitura por `fgets(STDIN)` e saída por `echo` com `\n`.

## Contexto de execução

- Antes de editar, confirme se o arquivo é para navegador ou terminal.
- Exemplo de arquivo CLI: `exercicio04.php`.
- Exemplo de arquivo web: `exercicio03.php`.
- Arquivos `aula*.php` normalmente servem como exemplos isolados e não compartilham código entre si.

## Validação

- Para checar sintaxe de um arquivo PHP, use `php -l <arquivo>`.
- Para validar scripts CLI, execute `php <arquivo>` quando houver um fluxo de entrada simples.
- Para páginas web, prefira validação de sintaxe e preserve a estrutura existente se não houver ambiente HTTP configurado na tarefa.

## Cuidados

- Não reformate vários arquivos sem necessidade.
- Não assuma que arquivos `.txt` são descartáveis; podem ser parte dos exercícios.
- Preserve acentuação e tratamento de texto existentes, especialmente em saídas visíveis ao usuário.