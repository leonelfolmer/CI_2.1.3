
<script language="JavaScript" type="text/javascript">
$(function()
{
    $('#estado').chainSelect('#cidade','<?php echo site_url('pesquisa/combobox') ?>',
    { 
        before:function (target) //before request hide the target combobox and display the loading message
        { 
            $("#loading").css("display","block");
            $(target).css("display","none");
        },
        after:function (target) //after request show the target combobox and hide the loading message
        { 
            $("#loading").css("display","none");
            $(target).css("display","inline");
        }
    });
    $('#cidade').chainSelect('#bairro','<?php echo site_url('pesquisa/combobox') ?>',
    { 
        before:function (target) 
        { 
            $("#loading").css("display","block");
            $(target).css("display","none");
        },
        after:function (target) 
        { 
            $("#loading").css("display","none");
            $(target).css("display","inline");
        }
    });
});
    </script>
<style type="text/css">
code {
	font-family: Monaco, Verdana, Sans-serif;
	font-size: 12px;
	background-color: #f9f9f9;
	border: 1px solid #D0D0D0;
	color: #002166;
	display: block;
	margin: 14px 0 14px 0;
	padding: 12px 10px 12px 10px;
}
#loading {
	position:absolute;
	top:0px;
	right:0px;
	background:#ff0000;
	color:#fff;
	font-size:14px;
	font-familly:Arial;
	padding:2px;
	display:none;
}
</style>

<div id="loading">Aguarde ...</div>

<form name="formname" method="post" action="">
  <!-- estado combobox -->
  <select id="estado" name="estado">
  	<!-- depois popular da base -->
		<option value="1" selected>Acre</option>
		<option value="2">Alagoas</option>
		<option value="3">Amap&aacute;</option>
		<option value="4">Amazonas</option>
		<option value="5">Bahia</option>
		<option value="6">Cear&aacute;</option>
		<option value="7">Distrito Federal</option>
		<option value="8">Esp&iacute;rito Santo</option>
		<option value="9">Goi&aacute;s</option>
		<option value="10">Maranh&atilde;o</option>
		<option value="11">Mato Grosso</option>
		<option value="12">Mato Grosso do Sul</option>
		<option value="13">Minas Gerais</option>
		<option value="14">Par&aacute;</option>
		<option value="15">Para&iacute;ba</option>
		<option value="16">Paran&aacute;</option>
		<option value="17">Pernambuco</option>
		<option value="18">Piau&iacute;</option>
		<option value="19">Rio de Janeiro</option>
		<option value="20">Rio Grande do Norte</option>
		<option value="21">Rio Grande do Sul</option>
		<option value="22">Rond&ocirc;nia</option>
		<option value="23">Roraima</option>
		<option value="24">Santa Catarina</option>
		<option value="25">S&atilde;o Paulo</option>
		<option value="26">Sergipe</option>
		<option value="27">Tocantins</option>
  </select>

  <select name="cidade" id="cidade" style="display:none">
  </select>

  <select name="bairro" id="bairro" style="display:none">
  </select>
</form>

