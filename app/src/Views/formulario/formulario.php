<?php
    if(isset($this->Dados['usuario'][0])) {
            extract($this->Dados['usuario'][0]);
    }

?>
<main class="container destaque">
    <div class="jumbotron blog">
    	<div class="container">
            <h2 class="display-4 text-center" style="margin-bottom: 40px;">Exemplo Cadastro</h2>
            <section class="busca">
            <form method="POST" action="">
                <input type="hidden" name="iduser" value="<?php echo isset($iduser) ? $iduser : ''; ?>">
                <div class="form-group col-md-6">
                    <label>Nome</label> <input type="text" name="username" class="form-control"
                        placeholder="Nome completo" value="<?php echo isset($username) ? utf8_decode($username): ''; ?>">
                </div>
                
                <div class="form-group col-md-6">
                    <label>Login</label> <input type="text" name="deslogin" class="form-control"
                        placeholder="Nome completo" value="<?php echo isset($deslogin) ? $deslogin : ''; ?>">
                </div>
                <input name="formMethod" type="submit" class="btn btn-danger" value="Enviar">
            </form>
            </section>
        </div>
    </div>
</main>
