<div id="content">
<?php 
echo heading('Principal', 3);
	foreach($artigos as $item):
		echo"<div class='artigo'>";
		echo heading($item->titulo,4);

		echo "<p>" . word_limiter($item->descricao, 4) . "</p>";
		
		echo "<a href='".base_url()."detalhe/". $item->url ."'>Ver Detalhes</a>";
		echo "</div>";
	endforeach;
		echo "</div>"; // end of content
echo $paginas;
?>



        
