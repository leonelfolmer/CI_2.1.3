

        <div id="navbar" class="navbar navbar-static">
          <div class="navbar-inner">
            <div class="container" style="width: auto;">
              <a class="brand" href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a>
              
 
              <ul class="nav" role="navigation">
                <li class="dropdown">
                  <a id="drop1" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Categorias <b class="caret"></b></a>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="drop1">
                    <li><a tabindex="-1" href="<?php echo base_url(); ?>admin/categorias">Categoria 1</a></li>
                    <li><a tabindex="-1" href="<?php echo base_url(); ?>">Categoria 2</a></li>
                    <li class="divider"></li>
                    <li><a tabindex="-1" href="<?php echo base_url(); ?>">Categoria 3</a></li>
                  </ul>
                </li>
                
                
                
                
                <!-- vertical division -->
                <li class="divider-vertical"></li>
                <li><a tabindex="-1" href="<?php echo base_url(); ?>admin/artigos">Artigos</a></li>
                <li class="divider-vertical"></li>
                <li><a tabindex="-1" href="<?php echo base_url(); ?>admin/midia">Mídia</a></li>
                <li class="divider-vertical"></li>
                <li><a tabindex="-1" href="<?php echo base_url(); ?>admin/contato/alterar/1">Contato</a></li>
                <li class="divider-vertical"></li>
                <li><a tabindex="-1" href="<?php echo base_url(); ?>admin/usuarios">Usuários</a></li>
              </ul>
              
              
              
           
              
              
              
              
              
              
              <ul class="nav pull-right">
                <li id="fat-menu" class="dropdown">
                  <a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown">Olá, <?php echo $this->session->userdata('email'); ?> <i class="icon-user icon-black"></i><b class="caret"></b></a>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
                    <li><a tabindex="-1" href="<?php echo base_url(); ?>"><i class="icon-home icon-black"></i> Site</a></li>
                    <li><a tabindex="-1" href="#">---</a></li>
                    <li class="divider"></li>
                    <li><a tabindex="-1" href="<?php echo base_url(); ?>admin/aut/logout"><i class="icon-off icon-black"></i> Sair</a></li>
                  </ul>
                </li>
              </ul>
            
            
            
            
            
            </div>
          </div>
        </div>