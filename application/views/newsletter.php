<div id="content">
<?php 

echo validation_errors(); 
echo form_open(base_url().'newsletter/adicionar'); 
                         	
echo form_label('Nome','nome'); 

echo form_input('nome',set_value('nome'));
						
echo form_label('e-mail','email'); 
echo form_input('email',set_value('email')); 

			
echo form_submit('mysubmit', 'Adicionar');
				
echo form_close(); 

?>
</div>