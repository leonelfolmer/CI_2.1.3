
/* Check and uncheck all checkbox
 * ================================= */

$(document).ready(function() {
	
	$('.selectall').hide();

	$('#selectall').toggle(function() {
		$('input:checkbox').attr('checked', 'checked');

		$('.selectall').show();

	}, function() {
		$('input:checkbox').removeAttr('checked');

		$('.selectall').hide();
	});
	
	/* If some one is checked
	 * ================================= */
	
	$('input').click(function() {

		var ischecked = $('input[type="checkbox"]').is(':checked');

		if (ischecked)

			$('.selectall').show();
		else
			$('.selectall').hide();
	});
	
})

/*
 * Datapicker ======================
 */
$(function() {
	$('#datapicker').datepicker({
		format : 'dd-mm-yyyy',
	});

});

/* Lowercase while type and add a hífen 
 * ======================= */
//input
$('input[title-replace="title"]').keyup(function() {
	$('input[url-replace="url"]').val($('input[title-replace="title"]').val());

	var value = $('input[url-replace="url"]').val();

	$('input[url-replace="url"]').val(value.replace(/\s+/g, '-').toLowerCase());

});

/*
 * Lowercase while type =======================
 */
/*
function lower(e, obj) {
	key = (document.all) ? e.keyCode : e.which;
	if (key != "8" && key != "0") {
		obj.value += String.fromCharCode(key).toLowerCase();
		return false;
	} else {
		return true;
	}
}
*/

/*alert modal - alert user until do something 
 * ============================================ */
$(function() {

	$("a.btn-danger").click(
			function(e) {
				e.preventDefault();
				var location = $(this).attr('href');
				bootbox.confirm("Confirma a exclusão?",
						"Cancelar", "Confirma", function(confirmed) {
							if (confirmed) {
								window.location.replace(location);
							}
						});
			});

	$('form.excluir_grupo')
			.submit(
					function(e) {
						e.preventDefault();
						var currentForm = this;
						bootbox
								.confirm(
										"Confirma a exclusão em grupo?<br />Impossível desfazer.",
										"Cancelar", "Confirma", function(
												confirmed) {
											if (confirmed) {
												currentForm.submit();
											}
										});
					});
});// end