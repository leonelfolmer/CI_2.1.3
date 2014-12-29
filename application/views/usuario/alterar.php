
 <?php echo form_open(base_url().'usuario/perfil/gravar_usuario'); ?>
 <?php echo form_hidden('id',$user->id); ?>
  

            <label for="nome">Nome:</label>
            <?php echo form_input('first_name', $user->first_name, 'class="input-1"', 'id="field-1"'); ?>
          
          
          
            <label for="email">e-mail:</label>
            <?php echo form_input(array('name' => 'email','class' => 'input-1', 'id' => 'email'), $user->email); ?>
          
          
          
      		<label for="senha">Senha:</label>
      		<?php echo form_password(array('name' => 'password','class' => 'input-1', 'id' => 'password'), set_value('password')); ?>       
         
        
      		<label for="senha">Confirme a senha:</label>
            <?php echo form_password(array('name' => 'password_confirm','class' => 'input-1', 'id' => 'password_confirm'), set_value('password_confirm')); ?> 
      
              
                 
       
        	<?php echo form_reset('reset', 'Cancelar', "onclick=".'location.href="'.base_url().'usuario/perfil"'.""); ?>
            
            <input type="hidden" name="group_id" value="2" />
            
        	<input type="submit" name="submit" value="Alterar"/>
      
      
      <?php echo form_close(); ?> 
     
      <?php echo anchor("usuario/perfil/excluir/".$user->id, 'Excluir'); ?> 
      
      <?php echo anchor('usuario/aut/logout', 'Sair'); ?> | <?php echo anchor('usuario/area', '&Aacute;rea'); ?>

      
      
  

