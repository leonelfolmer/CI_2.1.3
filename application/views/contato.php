<div id="contact">
<?php 

		$query = $this->db->get('contato'); 
		foreach ($query->result_array() as $row) {
   			echo $row['descricao'];
		}
		
		echo br(1);

		echo validation_errors();
		echo form_open_multipart(base_url().'contato/enviar');
		echo form_fieldset("Fale conosco");
		echo br(1);
		echo form_label('Informe o seu nome','nome');
		echo form_input('nome',set_value('nome'));
		echo br();
		echo form_label('Informe o seu e-mail','email');
		echo form_input('email',set_value('email'));
		echo br();
		echo form_label('Mensagem','mensagem');
		echo form_textarea('mensagem',set_value('mensagem'));
		
		// anexo
		echo br(1);
		echo form_label('Anexo [.pdf, .doc]','anexo');
		echo form_upload('anexo','Anexo');
		
		echo br(2);
		echo "<div class='buttons'>";
		echo form_button("enviar","Enviar", "onclick='submit()'");
		echo "</div>";
		echo form_fieldset_close();
		echo form_close();
?>
</div>