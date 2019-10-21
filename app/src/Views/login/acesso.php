
<body class="text-center card-body">
    <form class="form-signin" method="POST" action="">

        <h1 class="h3 mb-3 font-weight-normal">Área Restrita</h1>
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        if (isset($this->Dados['form'])) {
            $valorForm = $this->Dados['form'];
        }
        ?>
        <div class="card" style="width: 18rem;">
  <div class="card-body">
        <div class="form-group">
            <label>Usuário</label>
            <input name="usuario" type="text" class="form-control" placeholder="Digite o usuário" value="<?php if (isset($valorForm['usuario'])) {
            echo $valorForm['usuario'];
        } ?>">
        </div>
        <div class="form-group">
            <label>Senha</label>
            <input name="senha" type="password" class="form-control" placeholder="Digite a senha">
        </div>

        <input name="SendLogin" type="submit" class="btn btn-lg btn-primary btn-block" value="Acessar">
        <p class="text-center"><a href="<?php echo URL. 'novo-usuario/novo-usuario' ?>">Cadastrar</a> - <a href="<?php echo URL . 'esqueceu-senha/esqueceu-senha' ?>">Esqueceu a senha?</a></p>

        </div>
        </div>
    </form>
</body>
