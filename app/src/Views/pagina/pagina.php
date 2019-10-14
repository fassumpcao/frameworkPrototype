<?php
if (! defined('URL')) {
    header("Location: /site_curso");
    exit();
}

//var_dump($this->Dados);
extract($this->Dados['paginacao']);

//Link Primeira
$paginacao = "<nav aria-label=\"paginacao\">";
$paginacao .= "<ul class=\"pagination justify-content-center\">";
$paginacao .= "<li class=\"page-item\"><a class=\"page-link\" href=\"$link/pg\" tabindex=\"-1\">Primeira</a></li>";
//Anteriores
for ($iPag = ($pagina - $maxLinks); $iPag <= ($pagina - 1); $iPag++) {
    if ($iPag >= 1) {
        $paginacao .= "<li class=\"page-item\"><a class=\"page-link\" href=\"$link/pg/$iPag\">$iPag</a></li>";
    }
}

//Pagina atual
$paginacao .= "<li class=\"page-item active\"><a class=\"page-link\" href=\"#\">$pagina<span class=\"sr-only\">(current)</span></a></li>";

//Proximas
for ($dPag = ($pagina + 1); $dPag <= ($pagina + $maxLinks); $dPag++) {
    if ($dPag <= $totalPaginas) {
        $paginacao .= "<li class=\"page-item\"><a class=\"page-link\" href=\"$link/pg/$dPag\">$dPag</a></li>";
    }
}

//Link Ultima
$paginacao .= "<li class=\"page-item\"><a class=\"page-link\" href=\"$link/pg/$totalPaginas\">Última</a></li>";
$paginacao .= "</ul>";
$paginacao .= "</nav>";

?>

<main role="main">

<div class="jumbotron blog">
	<div class="container">
		<h2 class="display-4 text-center" style="margin-bottom: 40px;">Exemplo Paginação</h2>
		<div class="row">
			<div class="col-md-12">
				<table class="table">
				 	<thead class="thead-dark">
				    <tr>
						<th scope="col">#</th>
						<th scope="col">Nome</th>
						<th scope="col">Login</th>
						<th scope="col">Data Cadastro</th>
						<th scope="col">Editar Dados</th>
				    </tr>
				  	</thead>
				  	<tbody>
						<?php foreach ($this->Dados['dados'] as $dados) {
			                extract($dados); ?>
							<tr>
							    <th scope="row"><?php echo $iduser?></th>
							    <td><?php echo utf8_encode($username)?></td>
							    <td><?php echo $deslogin?></td>
							    <td><?php echo $dtregister?></td>
								<td><a class="btn btn-primary" href="<?php echo URL . '/formulario/exibirUsuario/' . $iduser; ?>" role="button">Acessar</a></td>
						    </tr>
			    		<?php
			            }
            			?>
					</tbody>
				</table>

				<hr class="featurette-divider">

				<?php echo $paginacao; ?>
			</div>

		</div> <!--row-->
	</div> <!--container-->
</div><!--jumbotron-->

</main>
