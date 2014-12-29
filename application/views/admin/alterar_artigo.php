
      
	<div class="content">

		<ul class="breadcrumb bs-docs">
			<li><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a> <span class="divider">/</span></li>
			<li class="active"><a href="<?php echo base_url(); ?>admin/artigos">Artigos</a> <span class="divider">/</span></li>
			<li class="active">Alterar Artigo <?php echo $dados_artigo[0]->titulo; ?></li>
		</ul>



	<div class="bs-docs">
 
				<?php if (form_error('titulo') || form_error('url') || form_error('descricao') || form_error('status')): ?>
                
                <div class="alert">
           			<button type="button" class="close" data-dismiss="alert">×</button>
                     <strong>Oops!</strong>
                     <ul>
						<?php echo form_error('titulo','<li>','</li>'); ?>
                        <?php echo form_error('url','<li>','</li>'); ?>
                        <?php echo form_error('descricao','<li>','</li>'); ?>
                        <?php echo form_error('status','<li>','</li>'); ?>
                      </ul>	
        		</div>
                <?php endif; ?>
		
		 
	  	<?php echo $this->mensagem->display(); ?>
        
        <h3 class="lead">Informações Necessárias</h3>
        
            <ul id="myTab" class="nav nav-tabs">
              <li class="active"><a href="#first" data-toggle="tab">Alterar Artigo</a></li>
              <li><a href="#help" data-toggle="tab">Ajuda</a></li>
            </ul>
            
            <div id="myTabContent" class="tab-content">
            
              <div class="tab-pane fade active in" id="first">
    
                <?php echo form_open_multipart(base_url().'admin/artigos/gravar_alteracao', 'class="form-horizontal"'); ?> 
  				<?php echo form_hidden('id',$dados_artigo[0]->id); ?>
  				
  				
  				<!-- backup
  				<div class="control-group">
                  <label class="control-label" for="status">Selecione uma categoria:</label>
                    
                    <div class="controls">
                        <?php //foreach($categorias as $categoria):
		            		//$drop[$categoria->url] = $categoria->nome;
		            		//endforeach;
					    ?>
			            
			            <?php //echo form_dropdown('categoria',$drop,$dados_artigo[0]->categoria,'class=""','id=""'); ?>
                        <span class="help-inline">A categoria que será relacionada a este artigo</span>    
                    </div>
                  </div>
                  -->
                  
                  
                  
                  
                  <!-- novo -->
			      <div class="control-group">
                  <label class="control-label" for="status">Selecione uma categoria:</label>
                    
                    <div class="controls">   
                    
                    	<?php $categoria_id =  $dados_artigo[0]->categoria_id; ?>
			            <select name="categoria" id="categoria">
				            <?php foreach($categorias as $categoria): ?>

							<option categoria_id="<?php echo $categoria->id; ?>"
	
								<?php if ($categoria_id == $categoria->id) { ?>
									selected="<?php echo $categoria->nome; ?>"
								<?php } ?>

							 value="<?php echo $categoria->nome; ?>"><?php echo $categoria->nome; ?></option>
			
	                        <?php endforeach; ?>		                                  
						</select>
					<span class="help-inline">A categoria que será relacionada a este artigo</span>    
                    </div>
                  </div>
                  
						<input type="hidden" name="categoria_id" id="categoria_id" value="<?php echo $dados_artigo[0]->categoria_id; ?>" />
			            
			            <script>
			            $(document).ready(function () {
			                $('#categoria').change(function () {
			                	var option = $('option:selected', this).attr('categoria_id');                
			                	 $('#categoria_id').val(option);            
			                });
			            });
			            </script>
			         	<!-- novo -->
             
                  
                  <div class="control-group">
                    <label class="control-label" for="nome">Data do artigo:</label>
                    <div class="controls">
                      <?php echo form_input('data', date('d-m-Y', strtotime($dados_artigo[0]->data)), 'id="datapicker"'); ?>
                      <span class="help-inline">Data atual deste artigo</span>
                    </div>
                  </div>
                  

                  <div class="control-group">
                    <label class="control-label" for="nome">Título do artigo:</label>
                    <div class="controls">
                      <?php echo form_input('titulo',$dados_artigo[0]->titulo, 'title-replace="title"'); ?>
                      <span class="help-inline">Título atual deste artigo</span>
                    </div>
                  </div>
     
 
                  <div class="control-group">
                    <label class="control-label" for="url">URL:</label>
                    <div class="controls">
                      <?php echo form_input('url',$dados_artigo[0]->url, 'url-replace="url"'); ?>
                      <span class="help-inline">Link Permanente atual (URL Amigável - SEO)</span>
                    </div>
                  </div>
                  
                  <script>
                  $('input[title-replace="title"]').keyup(function() {
                		$('input[url-replace="url"]').val($('input[title-replace="title"]').val());

                		var value = $('input[url-replace="url"]').val();

                		$('input[url-replace="url"]').val(value.replace(/\s+/g, '-').toLowerCase());

                	});
                  </script>
     
                  
                  <div class="control-group">
                    <label class="control-label" for="descricao">Descrição:</label>
                    <div class="controls">
                      	<?php echo form_textarea('descricao',$dados_artigo[0]->descricao, 'id=""', 'class="textarea-1"'); ?> 
						<?php echo display_ckeditor($ckeditor_1); ?>
                    </div>
                  </div>
	
                  
                  <div class="control-group">
                  <label class="control-label" for="status">Selecione:</label>
                    
                    <div class="controls">
                        <?php $options = array('Ativo' =>  'Ativo', 'Inativo' =>  'Inativo'); ?>
                  		<?php echo form_dropdown('status', $options, $dados_artigo[0]->status, 'id=""', 'class=""'); ?>
                        <span class="help-inline">O status para esta artigo</span>    
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

      
      
            
      
          
      
      
    