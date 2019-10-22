<?php

if (isset($this->Dados)) {


    /*
        //*-------------------------*
        //Transforma os campos do array em variaveis
        //*-------------------------*
        extract(json_decode($this->Dados,true));
        echo "variavel nome=" . $nome;

    */

    //*-------------------------*
    //Transforma os campos do array em objetos
    //*-------------------------*
    $dados = json_decode(json_encode($this->Dados), false);
    var_dump($dados);
}
?>


<main class="container destaque">
    <div class="jumbotron blog">
    	<div class="container">
            <h2 class="display-4 text-center" style="margin-bottom: 40px;">Exemplo Post</h2>
            <section class="busca">
                <form method="POST" action="">
                    <div class="form-group col-md-6">
                        <label>Nome</label> <input type="text" name="nome" class="form-control"
                            placeholder="Nome completo" value="<?php echo isset($dados->nome) ? utf8_decode($dados->nome) : ''; ?>">
                    </div>
                    <input name="formMethod" type="submit" class="btn btn-danger" value="Enviar">
                </form>
            </section>

        </div>
    </div>
</main>
