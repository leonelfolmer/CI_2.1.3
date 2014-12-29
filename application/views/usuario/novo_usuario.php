	<h1>Cadastro de novo usuário</h1>
    
    <?php echo $this->mensagem->display(); ?>
	
    <?php echo form_open("usuario/cadastro/novo_usuario");?>
      <label for="nome">Nome:</label>
      <?php echo form_input('first_name',set_value('first_name')); ?>
      
      <label for="sobrenome">Sobrenome:</label>
      <?php echo form_input('last_name',set_value('last_name')); ?>
      
      <label for="email">e-mail:</label>
      <?php echo form_input('email',set_value('email')); ?>  
      
      <label>Senha:</label>
      <?php echo form_input('password',set_value('password')); ?>
   
      <label>Confirmação de senha:</label>
      <?php echo form_input('password_confirm',set_value('password_confirm')); ?> 
      
      <?php echo form_submit('submit', 'Enviar');?>

      
    <?php echo form_close();?>
	
    <?php echo anchor('usuario/aut', 'Administra&ccedil;&atilde;o'); ?>