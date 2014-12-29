<div class="content">

	<ul class="breadcrumb bs-docs">
		<li><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a> <span
			class="divider">/</span></li>
		<li class="active"><a href="<?php echo base_url(); ?>admin/usuarios">Usuários</a></li>
		<span class="divider">/</span></li>
		<li class="active">Pesquisa</li>
	</ul>

	<div class="bs-docs">
	
	<?php echo $this->mensagem->display(); ?>

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
                  <td><input type="checkbox" name="checkbox[]" value="<?php echo $user->id; ?>"/></td>
                  <td><?php echo $user->first_name; ?> - <?php echo $user->group_description; ?></td>
     
                  <td>
                  	<!-- staus do usuário -->
					<?php 
                      if ($user->active == '1')
                      {
                          ?> <span class="label label-success">Ativo</span> <?php     
                      }
					  
                      if ($user->active == '0')
                      {
                          ?> <span class="label label-important">Inativo</span> <?
                      }
                    ?> 
                  </td>

                  <td>
                    <a href="<?php echo base_url(); ?>admin/usuarios/alterar_usuario/<?php echo $user->id; ?>" class="btn btn-mini btn-primary"><i class="icon-edit icon-white"></i> Alterar</a>					
                    <a href="<?php echo base_url(); ?>admin/usuarios/excluir/<?php echo $user->id; ?>" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Excluir</a>
                  </td>
                </tr>
 				
                <?php } ?>
                
              </tbody>
              
            </table>
            
            
            <div class="alert alert-warning">
            	<button type="button" class="btn" id="selectall" data-toggle="button">Selecionar todos</button>
                <button type="submit" class="btn btn-danger selectall">Excluir</button>
                <span class="help-inline">Ação em grupo.</span>
                <input name="excluir_grupo" value="<?php echo $user->id; ?>" type="hidden" />
            </div>
            

            
  
            <?php echo form_close(); ?>
            
          </div><!-- bs docs -->
          
 </div>