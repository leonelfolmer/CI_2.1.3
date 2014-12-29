<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Área do usuário</title>
</head>

<body>
<h1>Perfíl do usuário</h1>
<p>Está área é para colocar os links para editar o perfíl do usuário.</p>

		<?php $perfil = $this->session->userdata('user_id'); ?>
		
        <?php $query = $this->db->query("select * from users where id = $perfil"); ?>	
	    
		<?php if ($query->num_rows() > 0) { ?>
       
        <?php $row = $query->row(); ?> 
			
		<?php echo $row->username; ?>
		
		<?php echo $row->email; ?>	   
   
		<?php echo anchor("usuario/perfil/alterar/".$row->id, "Alterar"); ?>
  
        <?php } ?>


<?php echo anchor('usuario/aut/logout', 'Sair'); ?> | <?php echo anchor('usuario/area', '&Aacute;rea'); ?>

</body>
</html>