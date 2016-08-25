
(function($){
	$(document).ready(function()
		{
			/*--------------------------------------*/
			$('.combito').chosen({width: "95%"}); 
			/*--------------------------------------*/
			$('#lt_vencimiento').datepicker({
			    startView: 1,
			    autoclose: true,
			    language: "es",
			    todayHighlight: true
			});
			/*--------------------------------------*/
			$('#btnBuscarProd').click(function(event) {
				event.preventDefault();
				var _texto = $('#txtTexto').val(), _url = '';
				_url = 'productolote_filtro/'+encodeURI(_texto);
				document.location.href = _url;
			});
			/*--------------------------------------*/
			/*--------------------------------------*/
			/*--------------------------------------*/
			/*--------------------------------------*/
			/*--------------------------------------*/
		});

})(jQuery);
