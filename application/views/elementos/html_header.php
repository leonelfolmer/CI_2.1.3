<?php
echo doctype('xhtml1-strict');
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br" />
<head>
<?php
			// meta
			$meta = array(
				array('name' => 'robots', 'content' => 'no-cache, index, follow'), 
				array('name' => 'description', 'content' => 'Descri&ccedil;&atilde;o do website'),
				array('name' => 'keywords', 'content' => 'palavra1, palavra2, palavra3,'),
				array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv')
				);
			echo meta($meta);
    
    		//<meta http-equiv="cache-Control" content="no-cache, no-store, must-revalidate" />
			//<meta http-equiv="pragma" content="no-cache" />
			
			//<meta http-equiv="expires" content="0" />

?>

<title><?php echo $titulo; ?> | + Descrição do site</title>

<?php
			
			// styles
			echo link_tag('styles/global/reset.css');
			echo link_tag('styles/global/global.css');
			echo link_tag('styles/global/navigation.css');

			// gallery			
			echo link_tag('styles/global/prettyPhoto.css');

			
			// favicon
			echo link_tag('assets/images/favicon.ico', 'shortcut icon', 'image/x-icon');
			echo link_tag('assets/images/favicon.ico', 'icon', 'image/x-icon');
						
?>
<!-- jquery -->
<script src="<?php echo base_url(); ?>js/libs/jquery-1.8.3.min.js"></script>

<script src="<?php echo base_url(); ?>js/global/jquery.prettyPhoto.js"></script>

<!-- functions -->
<script src="<?php echo base_url(); ?>js/global/libs/func.js"></script> 

<!-- chained selects -->
<script src="<?php echo base_url(); ?>js/global/chainedselects.js"></script>



	<script>
	// galeria prettyPhoto
	$(document).ready(function(){
		$(".gallery a[rel^='gallery']").prettyPhoto({
			social_tools: false
		});	
	});
	</script>
	
	<!--  galeria prettyPhoto -->
	<style>
		.hidden { display:none }
 	</style> 

</head>
	<body>
<noscript><p>O JavaScript do seu navegador precisa ser habilitado!</p></noscript>	



<div id="wrapper">
  <div id="header">header
  	<div class="brand">brand</div><!--end of brand-->
    
  	<div class="accessibility">

		<?php echo form_open(base_url().'artigos/pesquisa'); ?>
            <input type="text" name="searchterm">
                
                <div class="buttons"> 
                   <button type="button" onClick="submit()">Pesquisa</button>
                   <button type="button" onClick="location.href='<?php echo base_url(); ?>pesquisa'">Pesquisa avan&ccedil;ada</button>
                </div><!-- end of buttons -->
            
        <?php echo form_close(); ?>

    </div><!--end of accessibility-->
    
  </div><!--end of header-->
   
  <!-- navigation -->
  <div id="top-navigation">top navigation</div><!-- end of top navigation -->
  
 
  <div id="main">main</div><!--end of main-->
