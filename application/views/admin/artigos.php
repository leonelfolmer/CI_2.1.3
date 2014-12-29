 <div id="loading"></div>
 
 <div class="content">

	<ul class="breadcrumb bs-docs">
		<li><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a> 
		<span class="divider">/</span></li>
		<li class="active">Artigos</li>
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
        
        <h3 class="lead">Cadastro de novo artigo</h3>
        
            <ul id="myTab" class="nav nav-tabs">
              <li class="active"><a href="#first" data-toggle="tab">Artigos</a></li>
              <li><a href="#second" data-toggle="tab">Galeria de imagens</a></li>
              <li><a href="#help" data-toggle="tab">Ajuda</a></li>
            </ul>
            
            <div id="myTabContent" class="tab-content">
            
              <div class="tab-pane fade active in" id="first">
    
                <?php echo form_open_multipart(base_url().'admin/artigos/cadastrar', 'class="form-horizontal"'); ?>
  				
  				<!-- backup 	
                  <div class="control-group">
                  <label class="control-label" for="status">Selecione uma categoria:</label>
                    
                    <div class="controls">
                        <?php //foreach($categorias as $categoria): ?>
		            	
		            	<?php //$drop[$categoria->url] = $categoria->nome; ?>
					
                        <?php //endforeach; ?>		                                  

								            
			            <?php //echo form_dropdown('categoria',$drop); ?>
		            
                        <span class="help-inline">A categoria que será relacionada a este artigo</span>    
                    </div>
                  </div>
                  
                  -->
                  
                  
                  
                  
                  
                
			     <!-- novo -->
			      <div class="control-group">
                  <label class="control-label" for="status">Selecione uma categoria:</label>
                    
                    <div class="controls">   
			            <select name="categoria" id="categoria">
				            <?php foreach($categorias as $categoria): ?>
							
							<option categoria_id="<?php echo $categoria->id; ?>" value="<?php echo $categoria->nome; ?>"><?php echo $categoria->nome; ?></option>

							<?php endforeach; ?>		                                  
						</select>
					<span class="help-inline">A categoria que será relacionada a este artigo</span>    
                    </div>
                  </div>
                  
						<input type="hidden" name="categoria_id" id="categoria_id" />
			            
			            <script>
			            $(document).ready(function () {
			                var option = $('option:selected', this).attr('categoria_id');                
			                $('#categoria_id').val(option);            

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
                      <?php echo form_input('data', set_value('data'), 'id="datapicker"'); ?>
                      <span class="help-inline">Data para este artigo</span>
                    </div>
                  </div>

    
                  <div class="control-group">
                    <label class="control-label" for="nome">Título do artigo:</label>
                    <div class="controls">
                      <?php echo form_input('titulo',set_value('titulo'), 'title-replace="title"'); ?>
                      <span class="help-inline">Título para este artigo</span>
                    </div>
                  </div>
                  
                  
                  <div class="control-group">
                    <label class="control-label" for="url">URL:</label>
                    <div class="controls">
                      <?php echo form_input('url',set_value('url'), 'url-replace="url"'); ?>
                      <span class="help-block">Link Permanente (URL Amigável - SEO), Ex: http://www.dominio.com.br/url-categoria/url-artigo</span>
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
                      	<?php echo form_textarea('descricao',set_value('descricao'), 'class="textarea-1"'); ?> 
						<?php echo display_ckeditor($ckeditor_1); ?>
                    </div>
                  </div>
 
                  
                  <div class="control-group">
                  <label class="control-label" for="status">Selecione:</label>
                    
                    <div class="controls">
                        <?php $options = array('Ativo' =>  'Ativo', 'Inativo' =>  'Inativo'); ?>
                  		<?php echo form_dropdown('status',$options, 'id=""', 'class=""'); ?>
                        <span class="help-inline">O status para este artigo</span>    
                    </div>
                  </div>
         
         
                <!-- <div class="form-actions">
                  <button type="submit" class="btn btn-success" onclick="$('#loading').show();">Cadastrar</button>
    			  <button type="reset" class="btn btn-inverse" onclick='location.href="<?php echo base_url(); ?>admin/dashboard"'>Cancelar</button>
                </div>-->
   
              </div>
              
              
              <div class="tab-pane fade in" id="second">
              
              
              <div class="row show-grid">

              <div class="span4">
	              <div class="control-group">
	                  <label class="control-label" for="status">Selecione o status da galeria:</label>
	                    
	                    <div class="controls">
	                        <?php $options_galeria = array('Inativo' =>  'Inativo', 'Ativo' =>  'Ativo'); ?>
	                  		<?php echo form_dropdown('galeria',$options_galeria, 'id=""', 'class=""'); ?>  
	                    </div>
	                  </div>
                  </div><!-- fim span 4 -->
                  
                 
              
				<div class="span6" style="border-left: 1px solid #ddd; padding-left: 20px;">
	                <div class="control-group">
	                    <label class="control-label" for="nome">Selecione as imagens:</label>
	                    <div class="controls">
	                      <?php echo form_upload('userfile[]', set_value('userfile[]'), 'multiple="multiple"'); ?>
	                      <span class="help-block">Galeria de imagens, selecione até 10 imagens de uma só vez.</span>
	                    </div>
	                  </div>
                 </div><!-- fim span 5 -->
                  
                 </div><!--  fim row grid -->
 
                  
                </div><!--  second -->
              
              
              
              

              <div class="tab-pane fade" id="help">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
              </div>
              
              
              
              	<div class="form-actions" style="padding-left: 180px;">
                  <button type="submit" class="btn btn-success" onclick="$('#loading').show();">Cadastrar</button>
    			  <button type="reset" class="btn btn-inverse" onclick='location.href="<?php echo base_url(); ?>admin/dashboard"'>Cancelar</button>
                </div>
  
  				<?php echo form_close(); ?>
  				
            </div>
            
          </div>

          
          <div class="bs-docs">
          <h3 class="lead">Pesquisa por artigos</h3>

    
              <ul class="nav nav-tabs">
                <li class="active"><a href="#lA" data-toggle="tab">Por título</a></li>
                <li class=""><a href="#lB" data-toggle="tab">Por categoria</a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="lA">

		            <?php echo form_open(base_url().'admin/artigos/pesquisa_artigos', 'class="form-search"'); ?>
		              <input type="text" class="input-large" name="pesquisa" placeholder="Título do artigo">
		              <button type="submit" class="btn" style="padding:7px;">Pesquisar</button>
		            <?php echo form_close(); ?>
                
                </div>
                
                <div class="tab-pane" id="lB">
                  
                  <?php echo form_open(base_url().'admin/artigos/pesquisa_categorias'); ?>
		    		<div class="control-group">
		                  <div class="controls">
		                     <?php 
								foreach($categorias as $categoria):
									$drop_filter[$categoria->nome] = $categoria->nome;
								endforeach;
							 ?>
							 
		                     <?php echo form_dropdown('pesquisa',$drop_filter,'', 'onchange="this.form.submit();"'); ?>
		                     <span class="help-inline" style="padding-bottom: 5px;">Selecione a categoria</span>    
		                  </div>
		            </div>

		            
		            <?php echo form_close(); ?>
                
                </div>
              </div>

          </div><!-- bs docs -->


           
          <div class="bs-docs">

            <h3 class="lead">Categorias cadastradas</h3>

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
              
              <?php echo form_open_multipart(base_url().'admin/artigos/excluir_grupo', 'class="excluir_grupo"'); ?>
              <?php foreach($artigos as $artigo): ?>
 
              
                <tr>
                  <td><input type="checkbox" name="checkbox[]" value="<?php echo $artigo->id; ?>"/></td>
                  <td><span class="link" data-original-title="<?php echo date('d-m-Y', strtotime($artigo->data)); ?>"><?php echo $artigo->titulo; ?></span></td>
                  	
                  	<script>
						$('.link').tooltip();
					</script>
                  
                  <td>
                  	<!-- staus da categoria -->
					<?php 
                      if ($artigo->status == "Ativo")
                      {
                          ?> <span class="label label-success"><?php echo $artigo->status; ?></span> <?php     
                      }
					  
                      else
                      {
                          ?> <span class="label label-important"><?php echo $artigo->status; ?></span> <?
                      }
                    ?>
                  	
                    
                  </td>
                  <td>
                    <a href="<?php echo base_url(); ?>admin/artigos/alterar/<?php echo $artigo->id; ?>" class="btn btn-mini btn-primary"><i class="icon-edit icon-white"></i> Alterar</a>					
                    <a href="<?php echo base_url(); ?>admin/artigos/excluir/<?php echo $artigo->id; ?>" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Excluir</a>
                    
                  </td>
                </tr>
 				
                <?php endforeach; ?>
                
              </tbody>
              
            </table>
            
            
            <div class="alert alert-warning">
            	<button type="button" class="btn" id="selectall" data-toggle="button">Selecionar todos</button>
                <button type="submit" class="btn btn-danger selectall">Excluir</button>
                <span class="help-inline">Ação em grupo.</span>
                <input name="excluir_grupo" value="<?php echo $artigo->id; ?>" type="hidden" />
            </div>
            

            <?php echo form_close(); ?>
            
          </div><!-- bs docs -->


    </div>

      
      
