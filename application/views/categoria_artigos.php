<div id="content">
<?php
	echo heading($artigos_categoria[0]->nome_categoria, 3);
	foreach($artigos_categoria as $item):
		echo "<span class='artigo'>";
			echo heading($item->titulo,4);
			echo "<p>" . word_limiter($item->descricao, 4) . "</p>";			
			echo "<a href='".base_url()."detalhe/". $item->url ."'>";
				echo "Ver Detalhes";
			echo "</a>";
		echo "</span>";
	endforeach;
	
	echo "</div>"; // end of content
?>
	