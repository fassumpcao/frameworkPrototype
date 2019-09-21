<?php
if (! defined('URL')) {
    header("Location: /framework");
    exit();
}

var_dump($this->Dados);

/*
    //**************
    //Transforma os campos do array em variaveis
    //**************

    extract(json_decode($this->Dados,true));
    echo $nome;

*/

    //**************
    //Transforma os campos do array em objetos
    //**************

$dados = json_decode($this->Dados,false);
echo $dados->nome;

?>


<main class="container destaque">

    <section class="busca">
        <h2>Busca</h2>

        <form method="POST" action="">
            <div class="form-group col-md-6">
                <label>Nome</label> <input type="text" name="nome" class="form-control"
                    placeholder="Nome completo" value="<?php echo isset($dados->nome) ? $dados->nome : ''; ?>">
            </div>
            <input name="formMethod" type="submit" class="btn btn-danger" value="Enviar">
        </form>
    </section>
</main>
