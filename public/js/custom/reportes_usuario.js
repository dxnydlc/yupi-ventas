var _servicio = 'http://localhost:8000/rep_venta_user_fil';
var _objeto = '';

(function($){
	$(document).ready(function()
		{
			/*-------------------------------------*/
			$('#filtroBusqueda .input-daterange').datepicker({
				language: "es",
    			autoclose: true
			});
			/*-------------------------------------*/
			$('#btnBuscarFiltro').click(function(event) {
				event.preventDefault();
				var _inicio = $('#inicio').val(), _fin = $('#fin').val(), _idUser = $('#cbousuario').val();
				var _dateInicio = _inicio.split('/'), _dateFin = _fin.split('/');
				if( _idUser == '' ){ _idUser = 'all'; }
				var _url = _servicio + '/'+_dateInicio[2]+'-'+_dateInicio[1]+'-'+_dateInicio[0]+'/'+_dateFin[2]+'-'+_dateFin[1]+'-'+_dateFin[0]+'/'+_idUser;
				//call service by GET
				document.location.href = _url;
			});
			/*-------------------------------------*/
			/*-------------------------------------*/
		});

})(jQuery);
