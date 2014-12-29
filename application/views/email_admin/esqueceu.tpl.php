<html>
<body>
	<p>O endere&ccedil;o de e-mail: <a href="mailto:<?php echo $identity; ?>"><?php echo $identity; ?></a>, solicitou a recupera&ccedil;&atilde;o da senha. Por favor, clique no link: <?php echo anchor('admin/aut/resetar/'. $forgotten_password_code, 'resetar senha');?> para que seja gerada uma nova.</p>
    <p>Se n&atilde;o conseguir abrir o link, copie e cole na barra de endere&ccedil;o do navegador o seguinte endere&ccedil;o: <span style="background:#ff0">http://wwww.leonelfolmer.com/CI_2.1.3/admin/aut/resetar/<?php echo $forgotten_password_code; ?></span></p>
</body>
</html>