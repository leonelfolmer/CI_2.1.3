<?php 
echo "<div id='left-navigation'>";


	// links
	echo heading('P&aacute;ginas', 3);
	echo anchor(base_url(),"Home");
    echo br();
    echo anchor(base_url().'contato',"Contato");
	echo br();
    echo anchor(base_url().'newsletter',"Newsletter");
	echo br();
    echo anchor(base_url().'admin/aut',"Administra&ccedil;&atilde;o");
    echo br();
	echo anchor(base_url().'usuario/aut',"Usu&aacute;rio");
    echo br(2);
	
	echo heading('Categorias', 3);
	
	foreach($categorias as $categoria):
		$lista[] = "<a href='" . base_url() . "categoria/". $categoria->url . "'>" . $categoria->nome ."</a>";
		endforeach;
		
		echo ul($lista);
echo"</div>";
?>