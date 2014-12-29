<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>



        <?php echo validation_errors
		('<div class="login-box-error-small corners"> 
				<p>', '</p>
		  </div>'); 
		?>
        
        <?php echo $this->mensagem->display(); ?>
        
        <form action="<?php echo base_url(); ?>usuario/aut/login" method="post">
            
              <label for="email">Usu&aacute;rio:</label>
              <input type="text" id="email" name="email" class="input-1"/>
              <label for="password">Senha:</label>
              <input type="password" id="password" name="password" class="input-1 password"/>
              <input type="submit" name="" value="Entrar" id="submit"/>
          
         </form>
    
        
      
      
      <!-- tab 3 -->
      <!--<div id="tabs-3" class="tabbox">
                    <div class="login-box-succes-small corners">
                        <p>Cadastrado com sucesso!</p>
                    </div>
      <div class="infobox">
                    <h3>Cadastrar</h3>
                        <p>Lorem ipsum</p>
                    </div>
                    <div class="login-box-row-wrap corners">
                        <label for="field1">Nome:</label><input type="text" id="field1" value="" name="" class="input-1"/>
                    </div>
                    <div class="login-box-row-wrap corners">
                        <label for="field2">e-mail:</label> <input type="text" id="field2" value="" name="" class="input-1"/>    
                    </div>
                     <div class="login-box-row-wrap corners">
                        <label for="field3">Senha:</label><input type="text" id="field3" value="" name="" class="input-1"/>
                    </div>             
                    <div class="login-box-row corners">
                    	<input type="checkbox" name="" id="field01"/> <label for="field01">Concordo com as politicas do site</label>
                        <input type="submit" name="" value="Send" id="submit"/>
                    </div>                    
                </div>-->
                
                
                
      	
        <?php echo validation_errors
		('<div class="login-box-error-small corners"> 
				<p>', '</p>
		  </div>'); 
		?>
        
        <?php echo $this->mensagem->display(); ?>
        
      
      	<form action="<?php echo base_url(); ?>usuario/aut/esqueceu" method="post">
            

            <?php $identity_human; ?>
            
			
                <label for="field10">e-mail:</label>
                <input type="text" id="field10" name="email" class="input-1"/>
         

                <input type="submit" value="Enviar" id="submit"/>
            
            
         </form>       
         
         <?php echo anchor('usuario/cadastro/', 'Cadastrar usu&aacute;rio'); ?>    



</body>
</html>