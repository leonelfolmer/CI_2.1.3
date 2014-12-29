
<div id="content">
    <div class="artigo">
    <?php if($results == 0):?>
        Sem resultado.
    <?php else:?>
        <?php foreach($results as $r):?>
            <?=$r->nome?><br />
        <?php endforeach;?>
    <?php endif;?>
    <p>
        <?=$links?>
    </p>
    </div>
</div>
        
        
