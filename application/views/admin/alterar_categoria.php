      	<div class="content">

		<ul class="breadcrumb bs-docs">
			<li><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a> <span class="divider">/</span></li>
			<li class="active"><a href="<?php echo base_url(); ?>admin/categorias">Categorias</a> <span class="divider">/</span></li>
			<li class="active">Alterar Categoria <?php echo $dados_categoria[0]->nome; ?></li>
		</ul>



	<div class="bs-docs">
 
				<?php if (form_error('nome') || form_error('url') || form_error('descricao') || form_error('status')): ?>
                
                <div class="alert">
           			<button type="button" class="close" data-dismiss="alert">×</button>
                     <strong>Oops!</strong>
                     <ul>
						<?php echo form_error('nome','<li>','</li>'); ?>
                        <?php echo form_error('url','<li>','</li>'); ?>
                        <?php echo form_error('descricao','<li>','</li>'); ?>
                        <?php echo form_error('status','<li>','</li>'); ?>
                      </ul>	
        		</div>
                <?php endif; ?>
		
		 
	  	<?php echo $this->mensagem->display(); ?>
        
        <h3 class="lead">Informações Necessárias</h3>
        
            <ul id="myTab" class="nav nav-tabs">
              <li class="active"><a href="#first" data-toggle="tab">Alterar Categoria</a></li>
              <li><a href="#help" data-toggle="tab">Ajuda</a></li>
            </ul>
            
            <div id="myTabContent" class="tab-content">
            
              <div class="tab-pane fade active in" id="first">
    
                <?php echo form_open_multipart(base_url().'admin/categorias/gravar_alteracao', 'class="form-horizontal"'); ?> 
  				<?php echo form_hidden('id',$dados_categoria[0]->id); ?>
                
	

                  <div class="control-group">
                    <label class="control-label" for="nome">Nome:</label>
                    <div class="controls">
                      <?php echo form_input('nome',$dados_categoria[0]->nome); ?>
                      <span class="help-inline">Nome atual desta categoria</span>
                    </div>
                  </div>
          
 
                  <div class="control-group">
                    <label class="control-label" for="url">URL:</label>
                    <div class="controls">
                      <?php echo form_input('url',$dados_categoria[0]->url, 'onkeypress="return lower(event,this)"'); ?>
                      <span class="help-inline">Link Permanente atual (URL Amigável - SEO)</span>
                    </div>
                  </div>
     
                  
                  <div class="control-group">
                    <label class="control-label" for="descricao">Descrição:</label>
                    <div class="controls">
                      	<?php echo form_textarea('descricao',$dados_categoria[0]->descricao, 'id=""', 'class="textarea-1"'); ?> 
						<?php echo display_ckeditor($ckeditor); ?>
                    </div>
                  </div>
	
                  
                  <div class="control-group">
                  <label class="control-label" for="status">Selecione:</label>
                    
                    <div class="controls">
                        <?php $options = array('Ativo' =>  'Ativo', 'Inativo' =>  'Inativo'); ?>
                  		<?php echo form_dropdown('status',$options, $dados_categoria[0]->status, 'id=""', 'class=""'); ?>
                        <span class="help-inline">O status para esta categoria</span>    
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

      
      
      