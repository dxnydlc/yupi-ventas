
(function($){
	$(document).ready(function()
		{
			/*--------------------------------------*/
			/*--------------------------------------*/
			/*--------------------------------------*/
			$('#compra').change(function(event) {
				calcularUT();
			});
			/*--------------------------------------*/
			$('#precio').change(function(event) {
				calcularUT();
			});
			/*--------------------------------------*/
			/*--------------------------------------*/
			/*--------------------------------------*/
			/*--------------------------------------*/
		});

})(jQuery);


function calcularUT()
{
	//calcular utilidad
	var $diferecia = 0, $utilidad = 0;
	var _compra = ( $('#compra').val() ), _venta = $('#precio').val()
    $diferecia = _venta - _compra;
    $utilidad = ($diferecia*100) / _compra;
    $('#utilidad').val( $utilidad + '%' );
    console.log( _compra );
}
