<div class="content">

    <ul class="breadcrumb bs-docs">
        <li><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a> <span
                class="divider">/</span></li>
        <li class="active">Categorias</li>
    </ul>



    <div class="bs-docs">

        <?php if (form_error('nome') || form_error('url') || form_error('descricao') || form_error('status')): ?>

            <div class="alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Oops!</strong>
                <ul>
                    <?php echo form_error('nome', '<li>', '</li>'); ?>
                    <?php echo form_error('url', '<li>', '</li>'); ?>
                    <?php echo form_error('descricao', '<li>', '</li>'); ?>
                    <?php echo form_error('status', '<li>', '</li>'); ?>
                </ul>	
            </div>
        <?php endif; ?>


        <?php echo $this->mensagem->display(); ?>

        <h3 class="lead">Cadastro de nova categoria</h3>

        <ul id="myTab" class="nav nav-tabs">
            <li class="active"><a href="#first" data-toggle="tab">Categorias</a></li>
            <li><a href="#help" data-toggle="tab">Ajuda</a></li>
        </ul>

        <div id="myTabContent" class="tab-content">

            <div class="tab-pane fade active in" id="first">

                <?php echo form_open_multipart(base_url() . 'admin/categorias/adicionar', 'class="form-horizontal"'); ?>




                <!-- script path to ckfinder config file -->
                <script src="<?php echo base_url(); ?>js/admin/global/ckfinder.js"></script>
                <script>
                    function BrowseServer(startupPath, functionData)
                    {
                        var finder = new CKFinder();
                        finder.basePath = '<?php echo base_url(); ?>js/admin/global/';
                        finder.startupPath = startupPath;
                        finder.selectActionFunction = SetFileField;
                        finder.selectActionData = functionData;
                        finder.selectThumbnailActionFunction = ShowThumbnails;
                        finder.popup();
                    }

                    function SetFileField(fileUrl, data)
                    {
                        document.getElementById(data["selectActionData"]).value = fileUrl;
                    }
                    function ShowThumbnails(fileUrl, data)
                    {
                        var sFileName = this.getSelectedFile().name;
                        document.getElementById('thumbnails').innerHTML +=
                                '<div class="thumb">' +
                                '<img src="' + fileUrl + '" />' +
                                '<div class="caption">' +
                                '<a href="' + data["fileUrl"] + '" target="_blank">' + sFileName + '</a> (' + data["fileSize"] + 'KB)' +
                                '</div>' +
                                '</div>';

                        document.getElementById('preview').style.display = "";
                        return false;
                    }

                </script>


                <div class="control-group">
                    <div class="controls input-append">

                        <input class="span2" name="" id="xFilePath" type="text" value="<?php ?>" placeholder="Selecione um arquivo">
                        <button class="btn" type="button" onclick="BrowseServer('Files:/', 'xFilePath');">Buscar</button>
                    </div>
                </div>



                <div class="control-group">
                    <div class="controls input-append">

                        <input class="span2" name="" id="xImagePath" type="text" value="<?php ?>" placeholder="Selecione uma imagem">
                        <button class="btn" type="button" onclick="BrowseServer('Images:/', 'xImagePath');">Buscar</button>
                    </div>
                </div>

                <hr />

                <!-- para mais campos de imagens/arquivos muda o id -->
                <div class="control-group">
                    <div class="controls input-append">

                        <input class="span2" name="" id="xImagePath2" type="text" value="<?php ?>" placeholder="Selecione uma imagem 2">
                        <button class="btn" type="button" onclick="BrowseServer('Images:/', 'xImagePath2');">Buscar</button>
                    </div>
                </div>



                <hr />

                <div class="control-group">
                    <label class="control-label" for="nome">Nome:</label>
                    <div class="controls">
                        <?php echo form_input('nome', set_value('nome'), 'class="nome"'); ?>
                        <span class="help-inline">Nome da categoria</span>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="url">URL:</label>
                    <div class="controls">
                        <?php echo form_input('url', set_value('url'), 'onkeypress="return lower(event,this)"'); ?>
                        <span class="help-block">Link Permanente (URL Amigável - SEO), Ex: http://www.dominio.com.br/url-categoria/url-artigo</span>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="descricao">Descrição:</label>
                    <div class="controls">
                        <?php echo form_textarea('descricao', set_value('descricao'), 'id=""', 'class="textarea-1"'); ?> 
                        <?php echo display_ckeditor($ckeditor); ?>
                    </div>
                </div>


                <div class="control-group">
                    <label class="control-label" for="status">Selecione:</label>

                    <div class="controls">
                        <?php $options = array('Ativo' => 'Ativo', 'Inativo' => 'Inativo'); ?>
                        <?php echo form_dropdown('status', $options, 'id=""', 'class=""'); ?>
                        <span class="help-inline">O status para esta categoria</span>    
                    </div>
                </div>


                <div class="form-actions">
                    <button type="submit" class="btn btn-success">Cadastrar</button>
                    <button type="reset" class="btn btn-inverse" onclick='location.href = "<?php echo base_url(); ?>admin/dashboard"'>Cancelar</button>
                </div>

                <?php echo form_close(); ?>

            </div>


            <div class="tab-pane fade" id="help">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>

        </div>

    </div><!-- bs docs -->


    <div class="bs-docs">

        <h3 class="lead">Pesquisa por categorias</h3>

        <?php echo form_open(base_url() . 'admin/categorias/pesquisa_categorias', 'class="form-search"'); ?>
        <input type="text" class="input-large" name="pesquisa">
        <button type="submit" class="btn" style="padding:7px;">Pesquisar</button>

        <span class="help-inline">Digite o nome da categoria</span>



        <?php echo form_close(); ?>

    </div><!-- bs docs -->

    <div class="bs-docs">

        <h3 class="lead">Categorias cadastradas/últimas</h3>

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

                <?php echo form_open_multipart(base_url() . 'admin/categorias/excluir_grupo', 'class="excluir_grupo"'); ?>
                <?php foreach ($categorias as $categoria): ?>


                    <tr>
                        <td><input type="checkbox" name="checkbox[]" value="<?php echo $categoria->id; ?>" /></td>
                        <td><?php echo $categoria->nome; ?></td>
                        <td>
                            <!-- staus da categoria -->
                            <?php if ($categoria->status == "Ativo") { ?>
                                <span class="label label-success">
                                    <?php echo $categoria->status; ?>
                                </span> 
                            <?php } else { ?>
                                <span class="label label-important">
                                    <?php echo $categoria->status; ?>    
                                </span> 
                            <?php } ?>
                        </td>
                        <td>
                            <a href="<?php echo base_url(); ?>admin/categorias/alterar/<?php echo $categoria->id; ?>" class="btn btn-mini btn-primary"><i class="icon-edit icon-white"></i> Alterar</a>					
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

