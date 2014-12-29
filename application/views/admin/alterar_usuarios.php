

      
      
      
      
      
      
      
      
      
      
      
      
      

<div class="content">

	<ul class="breadcrumb bs-docs">
		<li><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a> <span
			class="divider">/</span></li>
		<li class="active">Alterar usuários</li>
	</ul>



	<div class="bs-docs">
 
				<?php if (form_error('first_name') || form_error('email') || form_error('password') || form_error('password_confirm') ): ?>
                
                <div class="alert">
           			<button type="button" class="close" data-dismiss="alert">×</button>
                     <strong>Oops!</strong>
                     <ul>
						<?php echo form_error('first_name','<li>','</li>'); ?>
                        <?php echo form_error('email','<li>','</li>'); ?>
                        <?php echo form_error('password','<li>','</li>'); ?>
                        <?php echo form_error('password_confirm','<li>','</li>'); ?>
                      </ul>	
        		</div>
                <?php endif; ?>
		
		 
	  	<?php echo $this->mensagem->display(); ?>
        
        <h3 class="lead">Alterar usuários/admins</h3>
        
        
        
            <ul id="myTab" class="nav nav-tabs">
              <li class="active"><a href="#first" data-toggle="tab">Usuários</a></li>
              <li><a href="#help" data-toggle="tab">Ajuda</a></li>
            </ul>
            
            <div id="myTabContent" class="tab-content">
            
              <div class="tab-pane fade active in" id="first">
    
                <?php echo form_open(base_url().'admin/usuarios/gravar_usuario', 'class="form-horizontal validation"'); ?>
 				<?php echo form_hidden('id',$user->id); ?>

    
                  <div class="control-group">
                    <label class="control-label" for="Nome">Nome:</label>
                    <div class="controls">
                      <?php echo form_input('first_name', $user->first_name); ?>
                      <span class="help-inline">Nome do usuário</span>
                    </div>
                  </div>
                  
                  <div class="control-group">
                    <label class="control-label" for="E-mail">E-mail:</label>
                    <div class="controls">
                      <?php echo form_input('email', $user->email); ?>
                      <span class="help-inline"></span>
                    </div>
                  </div>
                  
                  <div class="control-group">
                    <label class="control-label" for="Senha">Senha:</label>
                    <div class="controls">
                      <?php echo form_password('password', set_value('password'), 'id="password"'); ?>
                      <span class="help-inline"></span>
                    </div>
                  </div>
                  
                  <div class="control-group">
                    <label class="control-label" for="Senha">Confirmação de senha:</label>
                    <div class="controls">
                      <?php echo form_password('password_confirm', set_value('password_confirm')); ?>
                      <span class="help-inline"></span>
                    </div>
                  </div>

                  <div class="control-group">
                  <label class="control-label" for="status">Selecione o status:</label>
                    
                    <div class="controls">
                        <?php $options = array('1' =>  'Ativo', '0' =>  'Inativo'); ?>
            			<?php echo form_dropdown('active',$options, $user->active, 'class=""', 'id=""'); ?> 
                        <span class="help-inline">O status para este usuário</span>    
                    </div>
                  </div>
                  
    
          
		          <!-- retirar para habilitar a opção de grupo abaixo, 
		          sempre o administradror que delega os grupos -->
		          <input type="hidden" name="group_id" value="1" />
		          
		          <!-- descomentar para habilitar a opção de grupos -->
				  <!-- 
		          <div class="control-group">
                  <label class="control-label" for="status">Selecione o status:</label>
                    <div class="controls">
                        <select name="group_id">
			                <option value="1" selected="selected">Administrador</option>
		                	<option value="2">Editor</option>
		                	<option value="3">Colaborador</option>
			              </select>
                        <span class="help-inline">O status para esta categoria</span>    
                    </div>
                  </div>
                  -->
                  
         
                
                <div class="form-actions">
                  <button type="submit" class="btn btn-success">Alterar</button>
    			  <button type="reset" class="btn btn-inverse" onclick='location.href="<?php echo base_url(); ?>admin/dashboard"'>Cancelar</button>
                </div>
                
                <?php echo form_close(); ?>
  
              </div>
              

              <div class="tab-pane fade" id="help">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
              </div>
  
            </div>
            
          </div><!-- bs docs -->


    </div>

      
     
      
      