   
			<div class="content">
			
				<ul class="breadcrumb bs-docs">
					<li><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a> <span class="divider">/</span></li>
					<li><a href="<?php echo base_url(); ?>admin/categorias">Categorias</a> <span class="divider">/</span></li>
					<li class="active">Pesquisa</li>
				</ul>
			</div>


   
           
          <div class="bs-docs">
   
	  	 <?php echo $this->mensagem->display(); ?>
          

            <h3 class="lead">Resultado da pesquisa por categorias</h3>

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
              
              <?php echo form_open_multipart(base_url().'admin/categorias/excluir_grupo', 'class="excluir_grupo"'); ?>
              <?php foreach($categorias as $categoria): ?>
 
              
                <tr>
                  <td><input type="checkbox" name="checkbox[]" value="<?php echo $categoria->id; ?>"/></td>
                  <td><?php echo $categoria->nome; ?></td>
                  <td>
                  	<!-- staus da categoria -->
					<?php 
                      if ($categoria->status == "Ativo")
                      {
                          ?> <span class="label label-success"><?php echo $categoria->status; ?></span> <?php     
                      }
					  
                      else
                      {
                          ?> <span class="label label-important"><?php echo $categoria->status; ?></span> <?
                      }
                    ?>
                  	
                    
                  </td>
                  <td>
                    <a href="<?php echo base_url(); ?>admin/categorias/alterar/<?php echo $categoria->id ?>" class="btn btn-mini btn-primary"><i class="icon-edit icon-white"></i> Alterar</a>					
                    <a href="<?php echo base_url(); ?>admin/categorias/excluir/<?php echo $categoria->id; ?>" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Excluir</a>
                    
                  </td>
                </tr>
 				
                <?php endforeach; ?>
                
              </tbody>
              
            </table>
            
            
            <div class="alert alert-warning">
            	<button type="button" class="btn" id="selectall" data-toggle="button">Selecionar todos</button>
                <button type="submit" class="btn btn-danger selectall">Excluir</button>
                <span class="help-inline">Ação em grupo.</span>
                <input name="excluir_grupo" value="<?php echo $categoria->id; ?>" type="hidden" />
            </div>

            
  
            <?php echo form_close(); ?>
            
          </div><!-- bs docs -->


    </div>

              
      




