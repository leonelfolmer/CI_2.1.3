
<div class="content">

	<ul class="breadcrumb bs-docs">
		<li><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a> 
		<span class="divider">/</span></li>
		<li class="active">Usuários</li>
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
        
        <h3 class="lead">Cadastro de usuários/admins</h3>
        
            <ul id="myTab" class="nav nav-tabs">
              <li class="active"><a href="#first" data-toggle="tab">Usuários</a></li>
              <li><a href="#help" data-toggle="tab">Ajuda</a></li>
            </ul>
            
            <div id="myTabContent" class="tab-content">
            
              <div class="tab-pane fade active in" id="first">
    
                <?php echo form_open(base_url().'admin/usuarios/cadastra', 'class="form-horizontal validation"'); ?>

    
                  <div class="control-group">
                    <label class="control-label" for="Nome">Nome:</label>
                    <div class="controls">
                      <?php echo form_input('first_name',set_value('first_name')); ?>
                      <span class="help-inline">Nome do usuário</span>
                    </div>
                  </div>
                  
                  <div class="control-group">
                    <label class="control-label" for="E-mail">E-mail:</label>
                    <div class="controls">
                      <?php echo form_input('email',set_value('email')); ?>
                    </div>
                  </div>
                  
                  <div class="control-group">
                    <label class="control-label" for="Senha">Senha:</label>
                    <div class="controls">
                      <?php echo form_password('password', set_value('password'), 'id="password"'); ?>
                    </div>
                  </div>
                  
                  <div class="control-group">
                    <label class="control-label" for="Senha">Confirmação de senha:</label>
                    <div class="controls">
                      <?php echo form_password('password_confirm', set_value('password_confirm')); ?>
                    </div>
                  </div>

                  <div class="control-group">
                  <label class="control-label" for="status">Selecione o status:</label>
                    
                    <div class="controls">
                        <?php $options = array('1' =>  'Ativo', '0' =>  'Inativo'); ?>
                  		<?php echo form_dropdown('active',$options, 'id=""', 'class=""'); ?> 
                        <span class="help-inline">O status para esta categoria</span>    
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
                  <button type="submit" class="btn btn-success">Cadastrar</button>
    			  <button type="reset" class="btn btn-inverse" onclick='location.href="<?php echo base_url(); ?>admin/dashboard"'>Cancelar</button>
                </div>
                
                <?php echo form_close(); ?>
  
              </div>
              

              <div class="tab-pane fade" id="help">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
              </div>
  
            </div>
            
          </div><!-- bs docs -->

          
          <div class="bs-docs">
          	
            <h3 class="lead">Pesquisa por usuários</h3>

            <?php echo form_open(base_url().'admin/usuarios/pesquisa_usuarios', 'class="form-search"'); ?>
              <input type="text" class="input-large" name="pesquisa_usuarios">
              <button type="submit" class="btn" style="padding:7px;">Pesquisar</button>
              
              <span class="help-inline">Digite o nome do usuário</span>
     
            <?php echo form_close(); ?>
          
          </div><!-- bs docs -->
          
          

           
          <div class="bs-docs">

            <h3 class="lead">Usuários cadastrados</h3>

          	<table class="table table-bordered table-striped">
              <thead>
              
                <tr>
                  <th width="5"></th>
                  <th width="700">Nome</th>
                  <th>Status</th>
                  <th width="150">Ações</th>
                </tr>
                
              </thead>

              <tbody>
              
              <?php echo form_open(base_url().'admin/usuarios/excluir_grupo', 'class="excluir_grupo"'); ?>
              <?php foreach($users as $user) { ?>

                <tr>
                  <td><input type="checkbox" name="checkbox[]" value="<?php echo $user['id']; ?>"/></td>
                  <td><?php echo $user['first_name']; ?> - <?php echo $user['group_description']; ?></td>
     
                  <td>
                  	<!-- staus do usuário -->
					<?php 
                      if ($user['active'] == '1')
                      {
                          ?> <span class="label label-success">Ativo</span> <?php     
                      }
					  
                      if ($user['active'] == '0')
                      {
                          ?> <span class="label label-important">Inativo</span> <?
                      }
                    ?> 
                  </td>

                  <td>
                    <a href="<?php echo base_url(); ?>admin/usuarios/alterar_usuario/<?php echo $user['id']; ?>" class="btn btn-mini btn-primary"><i class="icon-edit icon-white"></i> Alterar</a>					
                    <a href="<?php echo base_url(); ?>admin/usuarios/excluir/<?php echo $user['id']; ?>" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Excluir</a>
                  </td>
                </tr>
 				
                <?php } ?>
                
              </tbody>
              
            </table>
            
            
            <div class="alert alert-warning">
            	<button type="button" class="btn" id="selectall" data-toggle="button">Selecionar todos</button>
                <button type="submit" class="btn btn-danger selectall">Excluir</button>
                <span class="help-inline">Ação em grupo.</span>
                <input name="excluir_grupo" value="<?php echo $user['id']; ?>" type="hidden" />
            </div>
            

            <?php echo form_close(); ?>
            
          </div><!-- bs docs -->


    </div>

      
     