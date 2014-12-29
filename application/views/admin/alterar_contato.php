
      	<div class="content">

		<ul class="breadcrumb bs-docs">
			<li><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a> <span class="divider">/</span></li>
			<li class="active"><a href="#">Contato</a> <span class="divider">/</span></li>
		</ul>



	<div class="bs-docs">
 
				<?php if (form_error('nome') || form_error('url') || form_error('descricao') || form_error('status')): ?>
                
                <div class="alert">
           			<button type="button" class="close" data-dismiss="alert">×</button>
                     <strong>Oops!</strong>
                     <ul>
                        <?php echo form_error('descricao','<li>','</li>'); ?>
                      </ul>	
        		</div>
                <?php endif; ?>
		
		 
	  	<?php echo $this->mensagem->display(); ?>
        
        <h3 class="lead">Alterar contato</h3>
        
            <ul id="myTab" class="nav nav-tabs">
              <li class="active"><a href="#first" data-toggle="tab">Alterar Categoria</a></li>
              <li><a href="#help" data-toggle="tab">Ajuda</a></li>
            </ul>
            
            <div id="myTabContent" class="tab-content">
            
              <div class="tab-pane fade active in" id="first">
		
  				<?php echo form_open(base_url().'admin/contato/gravar_alteracao', 'class="form-horizontal"'); ?> 
  				<?php echo form_hidden('id',$dados_contato[0]->id); ?>
                
	

                  <div class="control-group">
                    <label class="control-label" for="nome">Descrição:</label>
                    <div class="controls">
                      <?php echo form_textarea('descricao',$dados_contato[0]->descricao); ?>
                      <?php echo display_ckeditor($ckeditor); ?>
                    </div>
                  </div>
                   
                
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

      
      
      