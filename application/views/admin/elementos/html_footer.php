     
     
	<script>
	  // generic vaidation
	  $().ready(function() {			 
	      $(".validation").validate({
			  rules: {	
				  email: {
						required: true,
						email: true
				  },
				  password: {
						required: true,
						minlength: 5
				  },
				  password_confirm: {
						required: true,
						minlength: 5,
						equalTo: "#password"
				  }
				}, 
	
				messages: {
					email:       {
						 required: "Preencha com seu e-mail",
						    email: "Preencha com um e-mail válido"
					},
					
					password: {
						required: "O campo senha é obrigatório",
					   minlength: "A senha deve ter no mínimo 6 caracteres"
					},
					
					password_confirm: {
						required: "O campo confirmação de senha é obrigatório",
					   minlength: "A senha deve ter no mínimo 6 caracteres",
						 equalTo: "A confirmação de senha deve ser igual a senha"
					},
				}  
	      });  // end of generic validation

	  });		
	  </script>
     
     
     
     
    <footer>
        <p>Versão: 2.6.6 &copy; <a href="http://leonelfolmer.com" title="Leonel Folmer">leonelfolmer.com</a></p>
    </footer><!-- end of footer -->
    
    
    
    </div><!-- end of container -->
    


	</body>
</html>