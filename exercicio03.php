<?php
// Lê e sanitiza um valor vindo via POST.
function post(string $k): string { return filter_input(INPUT_POST, $k, FILTER_SANITIZE_SPECIAL_CHARS) ?? ''; }
// Converte texto numérico para float aceitando vírgula decimal.
function fnum(string $v): float { return (float) str_replace(',', '.', trim($v)); }
// Verifica se um número inteiro está em um intervalo fechado [a, b].
function in_range(int $n, int $a, int $b): bool { return $n >= $a && $n <= $b; }

// Catálogo dos exercícios: título, campos esperados e regra de cálculo.
$programs = [
    // 31) Verifica aprovação individual em duas provas (nota mínima 6).
    '31' => [ 'title'=>'31: Aprovado por prova (>=6)', 'fields'=>[['n1','Nota 1'],['n2','Nota 2']], 'handler'=>fn($d)=>
        ((fnum($d['n1'])>=6?"Prova1: Aprovado":"Prova1: Reprovado") . ' | ' . (fnum($d['n2'])>=6?"Prova2: Aprovado":"Prova2: Reprovado"))
    ],
    // 32) Calcula a média de duas notas e classifica em aprovado/reprovado.
    '32' => [ 'title'=>'32: Média de duas notas (>=6)', 'fields'=>[['n1','Nota 1'],['n2','Nota 2']], 'handler'=>function($d){ $m = (fnum($d['n1'])+fnum($d['n2']))/2; return "Média: " . number_format($m,2) . ' - ' . ($m>=6?"Aprovado":"Reprovado"); } ],
    // 33) Soma três números e verifica se o total é divisível por 5.
    '33' => [ 'title'=>'33: Soma divisível por 5?', 'fields'=>[['a','Num 1'],['b','Num 2'],['c','Num 3']], 'handler'=>function($d){ $s = fnum($d['a'])+fnum($d['b'])+fnum($d['c']); return (fmod($s,5)==0) ? "Soma {$s} é divisível por 5" : "Soma {$s} não é divisível por 5"; } ],
    // 34) Classifica a soma de três números como positiva, negativa ou zero.
    '34' => [ 'title'=>'34: Soma positiva/negativa/zero', 'fields'=>[['a','Num 1'],['b','Num 2'],['c','Num 3']], 'handler'=>fn($d)=> (($s=fnum($d['a'])+fnum($d['b'])+fnum($d['c']))>0?"Soma {$s} é positiva":($s<0?"Soma {$s} é negativa":"Soma é zero")) ],
    // 35) Identifica o maior e o menor valor entre três números.
    '35' => [ 'title'=>'35: Maior e menor entre três', 'fields'=>[['a','Num 1'],['b','Num 2'],['c','Num 3']], 'handler'=>fn($d)=> ("Maior: " . max(fnum($d['a']),fnum($d['b']),fnum($d['c'])) . " | Menor: " . min(fnum($d['a']),fnum($d['b']),fnum($d['c']))) ],
    // 36) Analisa três idades para saber se todas, alguma ou nenhuma é maior de idade.
    '36' => [ 'title'=>'36: Idades - alguma/ todas/ todas menores de 18', 'fields'=>[['i1','Idade 1'],['i2','Idade 2'],['i3','Idade 3']], 'handler'=>function($d){ $v=[(int)fnum($d['i1']),(int)fnum($d['i2']),(int)fnum($d['i3'])]; $any=array_reduce($v,fn($c,$x)=>$c||($x>=18),false); $all=array_reduce($v,fn($c,$x)=>$c&&($x>=18),true); return $all?"Todas maiores de idade":($any?"Alguma é maior de idade":"Todas menores de idade"); } ],
    // 37) Verifica se três lados atendem à regra de existência de triângulo.
    '37' => [ 'title'=>'37: Possíveis lados de um triângulo?', 'fields'=>[['a','Lado a'],['b','Lado b'],['c','Lado c']], 'handler'=>fn($d)=> (((fnum($d['a'])+fnum($d['b'])>fnum($d['c'])) && (fnum($d['a'])+fnum($d['c'])>fnum($d['b'])) && (fnum($d['b'])+fnum($d['c'])>fnum($d['a'])))?"Pode formar triângulo":"Não pode formar triângulo") ],
    // 38) Calcula idade pelo ano de nascimento e valida aptidão para votar (>=16).
    '38' => [ 'title'=>'38: Aptidão para votar (>=16)', 'fields'=>[['year','Ano de nascimento']], 'handler'=>fn($d)=>(((int)date('Y')-(int)fnum($d['year']))>=16?"Apta a votar":"Não apta a votar") ],
    // 39) Placeholder inicial; a regra definitiva é sobrescrita logo abaixo.
    '39' => [ 'title'=>'39: Aptidão/Obrigatoriedade de votar', 'fields'=>[['idade','Idade']], 'handler'=>fn($d)=>function(){ global $d; } ],
    // 40) Média de três notas com três possíveis situações finais.
    '40' => [ 'title'=>'40: Aprovado/Reprovado/Recuperação (3 notas)', 'fields'=>[['n1','Nota1'],['n2','Nota2'],['n3','Nota3']], 'handler'=>fn($d)=>($m=(fnum($d['n1'])+fnum($d['n2'])+fnum($d['n3']))/3) >=7?"Aprovado (".number_format($m,2).")":($m<4?"Reprovado (".number_format($m,2).")":"Recuperação (".number_format($m,2).")") ],
    // 41) Classifica um dia informado como dia útil ou fim de semana.
    '41' => [ 'title'=>'41: Dia útil ou fim de semana', 'fields'=>[['dia','Dia']], 'handler'=>fn($d)=> (in_array(mb_strtolower(trim($d['dia'])),['segunda','segunda-feira','terça','terça-feira','terca','terca-feira','quarta','quarta-feira','quinta','quinta-feira','sexta','sexta-feira'])?"Dia útil":"Fim de semana") ],
    // 42) Calcula IMC e retorna a categoria conforme faixas padrão.
    '42' => [ 'title'=>'42: IMC com categoria', 'fields'=>[['peso','Peso (kg)'],['altura','Altura (m)']], 'handler'=>function($d){ $altura = fnum($d['altura']); if($altura<=0) return 'Altura inválida'; $imc = fnum($d['peso']) / ($altura * $altura); if($imc < 18.5) $cat = 'Abaixo do peso'; elseif($imc < 25) $cat = 'Peso normal'; elseif($imc < 30) $cat = 'Sobrepeso'; elseif($imc < 40) $cat = 'Obesidade'; else $cat = 'Obesidade grave'; return "IMC: " . number_format($imc,2) . " - " . $cat; } ],
    // 43) Testa divisibilidade simultânea por 3 e por 5.
    '43' => [ 'title'=>'43: Divisível por 3 e 5 simultaneamente?', 'fields'=>[['n','Número']], 'handler'=>fn($d)=> (((int)fnum($d['n'])%3===0 && (int)fnum($d['n'])%5===0)?"Sim":"Não") ],
    // 44) Retorna a faixa etária com base na idade informada.
    '44' => [ 'title'=>'44: Faixa etária (criança/adolescente/adulto/idoso)', 'fields'=>[['idade','Idade']], 'handler'=>fn($d)=> ( ($i=(int)fnum($d['idade']))<=12?"Criança":($i<=17?"Adolescente":($i<=59?"Adulto":"Idoso")) ) ],
    // 45) Verifica se o primeiro número é divisível pelo segundo (com proteção para divisor zero).
    '45' => [ 'title'=>'45: Primeiro divisível pelo segundo?', 'fields'=>[['a','N1'],['b','N2']], 'handler'=>fn($d)=> ( (fnum($d['b'])==0)?"Divisor zero":(fmod(fnum($d['a']),fnum($d['b']))==0?"Sim":"Não") ) ],
    // 46) Gera a sequência de 1 até 10.
    '46' => [ 'title'=>'46: Números de 1 a 10', 'fields'=>[], 'handler'=>fn($d)=> array_map(fn($n)=> (string)$n, range(1,10)) ],
    // 47) Gera a sequência de 1 até 100.
    '47' => [ 'title'=>'47: Números de 1 a 100', 'fields'=>[], 'handler'=>fn($d)=> array_map(fn($n)=>(string)$n, range(1,100)) ],
    // 48) Gera apenas os números pares de 1 até 100.
    '48' => [ 'title'=>'48: Números pares de 1 a 100', 'fields'=>[], 'handler'=>fn($d)=> array_map(fn($n)=>(string)$n, range(2,100,2)) ],
    // 49) Monta dois blocos: pares de 1 a 50 e ímpares de 51 a 100.
    '49' => [ 'title'=>'49: Pares 1-50 e ímpares 51-100', 'fields'=>[], 'handler'=>fn($d)=> [ 'Pares 1-50: '.implode(',',array_map(fn($n)=>$n,range(2,50,2))), 'Impares 51-100: '.implode(',',array_map(fn($n)=>$n,range(51,99,2))) ] ],
    // 50) Gera a tabuada de 1 a 10 para o número informado.
    '50' => [ 'title'=>'50: Tabuada (1..10)', 'fields'=>[['n','Número']], 'handler'=>fn($d)=> array_map(fn($i)=> "$i x {$d['n']} = " . ($i * fnum($d['n'])), range(1,10)) ],
];

// Regra do exercício 39 definida separadamente para ficar mais legível.
$programs['39']['handler'] = function($d){ $i=(int)fnum($d['idade']); if($i<16) return 'Não apto a votar'; if(in_array($i,[16,17])|| $i>=70) return 'Apto, não obrigado'; return 'Obrigatório'; };

// Exercício selecionado no formulário (31 por padrão).
$action = post('action') ?: '31';

// Escapa qualquer saída textual antes de enviar ao HTML.
function esc($v){ return htmlspecialchars((string)$v, ENT_QUOTES); }

$values = fn($name)=> esc(post($name));

// Monta metadados (títulos, campos e valores atuais) para o JavaScript.
$meta = [];
foreach($programs as $k=>$p){
    $flds = [];
    foreach($p['fields'] as $f){
        $name = $f[0];
        $flds[] = ['name'=>$name,'label'=>$f[1],'value'=>post($name)];
    }
    $meta[$k] = ['title'=>$p['title'],'fields'=>$flds];
}

// Coleta os inputs do exercício atual e executa a regra correspondente.
$input = [];
foreach($programs[$action]['fields'] ?? [] as $f){ $input[$f[0]] = post($f[0]); }
$result = '';
if(isset($programs[$action])){ $result = $programs[$action]['handler']($input); }
?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Exercícios 31–50</title>
    <style>input{display:block;margin:6px 0;padding:6px} label{display:block}</style>
    <script>
    // Campos dinâmicos: criados com base no exercício selecionado.
    let programs = null;
    function buildField(f){
        const wrapper = document.createElement('div');
        const label = document.createElement('label');
        label.textContent = f.label || f.name;
        const input = document.createElement('input');
        input.name = f.name;
        input.placeholder = f.label;
        if(f.value) input.value = f.value;
        label.appendChild(input);
        wrapper.appendChild(label);
        return wrapper;
    }
    window.addEventListener('DOMContentLoaded', ()=>{
        // Lê os metadados injetados pelo PHP.
        programs = window.__programs_meta || {};
        const sel = document.getElementById('exercise');
        const fields = document.getElementById('fields');
        function render(){
            const key = sel.value;
            const current = programs[key] || { fields: [] };
            fields.innerHTML = '';
            (current.fields || []).forEach(f=> fields.appendChild(buildField(f)));
        }
        sel.addEventListener('change', render);
        render();
    });
    </script>
</head>
<body>
<h1>Exercícios 31–50 (formulário único)</h1>

<form method="post">
    <label>Escolha o exercício:
        <select id="exercise" name="action">
            <?php foreach($programs as $k=>$p): ?>
                <option value="<?=esc($k)?>" <?= $action===$k? 'selected':''?>><?=esc($p['title'])?></option>
            <?php endforeach; ?>
        </select>
    </label>

    <div id="fields"></div>
    <div style="margin-top:8px">
        <button type="button" id="printBtn">Versão para impressão</button>
    </div>
    <button type="submit">Executar</button>
</form>

<?php
// Renderiza o resultado do exercício após o submit.
if($result!==''){
    // Quando o handler retorna lista, exibimos em itens (<ul><li>...</li></ul>).
        if(is_array($result)){
                echo '<h3>Resultado</h3><ul id="result">'; foreach($result as $it) echo '<li>'.esc($it).'</li>'; echo '</ul>';
        } else {
        // Quando o handler retorna texto simples, exibimos em um parágrafo.
                echo '<h3>Resultado</h3><p id="result"><strong>'.esc($result).'</strong></p>';
        }
}

// Exporta $meta para JavaScript como objeto global.
// JSON_UNESCAPED_UNICODE preserva acentos legíveis no HTML gerado.
echo "<script>window.__programs_meta = ".json_encode($meta, JSON_UNESCAPED_UNICODE).";</script>";
// Área usada exclusivamente na impressão.
echo "<div id=\"print-area\" style=\"display:none;\"></div>";
// Em modo impressão, mostra apenas o conteúdo de #print-area.
echo "<style>@media print{ body *{display:none!important} #print-area, #print-area *{display:block!important} #print-area{position:static;padding:0} }</style>";
?>
<script>
// Monta uma versão limpa para impressão com campos e resultado atual.
document.addEventListener('DOMContentLoaded', ()=>{
    const printBtn = document.getElementById('printBtn');
    const sel = document.getElementById('exercise');
    const printArea = document.getElementById('print-area');
    printBtn.addEventListener('click', ()=>{
        // Descobre qual exercício está selecionado no momento do clique.
        const key = sel.value;
        // Lê os metadados do exercício; se faltar, usa estrutura vazia como fallback.
        const program = (window.__programs_meta||{})[key] || {title:'',fields:[]};
        // Inicia o HTML da impressão com o título do exercício.
        let html = '<h2>'+ (program.title||'') +'</h2>';
        html += '<ul>';
        (program.fields||[]).forEach(f=>{
            // Procura, no formulário atual, o input com o mesmo nome do campo.
            const el = document.querySelector('[name="'+f.name+'"]');
            // Prioriza o valor digitado agora; se não existir input, usa valor salvo.
            const val = el ? el.value : (f.value||'');
            html += '<li><strong>'+ (f.label||f.name) +':</strong> '+ (val||'') +'</li>';
        });
        html += '</ul>';
        // Se houver resultado na tela, inclui o mesmo resultado na versão impressa.
        const res = document.getElementById('result');
        if(res) html += '<h3>Resultado</h3>'+res.innerHTML;
        // Injeta conteúdo, mostra área de impressão, dispara print e oculta novamente.
        printArea.innerHTML = html;
        printArea.style.display = 'block';
        window.print();
        printArea.style.display = 'none';
    });
});
</script>
</body>
</html>
