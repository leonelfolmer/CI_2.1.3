<div id="detalhes">
<?php foreach($detalhes_artigo as $detalhe): ?>

	<?php echo heading($detalhe->titulo, 3); ?>
	
		<?php echo date('d/m/Y', strtotime($detalhe->data)); ?> 
		
		<?php echo "<p>" . $detalhe->descricao . "</p>"; ?>
		
		
	<?php if ($detalhe->galeria == "Inativo") {} else { ?>	
		
	<ul class="gallery clearfix">
		
		<li>
			<a href="<?php echo base_url(); ?>assets/uploads/imagens/<?php echo $detalhe->imagem_0; ?>" rel="gallery[]" title="Descrição">Galeria</a>
		</li>


	        <?php for($i = 1; $i <= 9; $i++) { ?>
	        	
	        <?php $imagem = "imagem_".$i; ?>	
  
	        <?php if ($detalhe->$imagem == null) {
	        	
	        } else { ?>

					<li class="hidden">
						<a href="<?php echo base_url(); ?>assets/uploads/imagens/<?php echo $detalhe->$imagem; ?>" rel="gallery[]" title="Descrição">
							<img src="<?php echo base_url(); ?>assets/uploads/imagens/<?php echo $detalhe->$imagem; ?>" />
						</a>
					</li>	
					
				<?php } ?>
								
			<?php } ?>
			
		
                                
	</ul>
	<?php } ?>

	
	
<?php endforeach; ?>
						

</div><!-- end of detalhe -->


			