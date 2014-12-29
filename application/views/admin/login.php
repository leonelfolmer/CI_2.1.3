
               
    <div class="form-signin" >   

        <div class="tabbable tabs-top">
          <ul id="login-tabs" class="nav nav-tabs">
            <li class="active"><a href="#lA" data-toggle="tab">Painel</a></li>
            <li><a href="#lB" data-toggle="tab">Não consegue acessar sua conta?</a></li>
          </ul>
			
          
          <div class="tab-content">
            <div class="tab-pane active" id="lA">

            <?php echo $this->mensagem->display('wrong_login'); ?>

            <?php if ( form_error('email') || form_error('password') ): ?>
            <div class="alert alert-error">
            <button type="button" class="close" data-dismiss="alert">×</button>
            	<strong>Oh snap!</strong>
                    <ul>
                        <?php echo form_error('email','<li>','</li>'); ?>
                        <?php echo form_error('password','<li>','</li>'); ?>
                    </ul>
                 </div><!-- end of alerts -->
            <?php endif; ?>
  
              <form action="<?php echo base_url(); ?>admin/aut/login" method="post">
                
                <input type="text" name="email" class="input-block-level" placeholder="E-mail">
                
                <input type="password" name="password" class="input-block-level" placeholder="Senha">  
                
                <button class="btn btn-large btn-block btn-primary" type="submit">Entrar no painel de controle</button>
 
              </form>
              
            </div><!-- end of tabcontent lA -->
            
            <div class="tab-pane" id="lB">
            
            <?php echo $this->mensagem->display(); ?>
        
              <form action="<?php echo base_url(); ?>admin/aut/esqueceu" method="post">

				  <?php $identity_human; ?>
  
                  <input type="text" name="email" class="input-block-level" placeholder="E-mail" />
                  <button class="btn btn-large btn-block btn-primary" type="submit">Recuperar</button>
                  
               </form>
              
            </div>
  
          </div>
        </div><!-- end of tabbable tabs-left -->

         
     </div><!-- end of form signin --> 
     
