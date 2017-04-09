var contacto = function($){
	$(document).ready(function(){
		$(".wpcf7").each(function(i,domRef){
			var dom = $(domRef);
			var form = dom.find('form');
			var primerInput = form.find('input[type!=hidden]:first');
			var respuesta = form.find('.wpcf7-response-output');
			var alto = {
				'min': primerInput.outerHeight()+1,
				'max': form.outerHeight()
			}
			primerInput.on('click',function(ev){
				primerInput.off('click');
				ev.preventDefault();
				ev.stopPropagation();
				form.animate({
   					height: alto.max,
  					}, 1000, function() {
    					form.css('height','auto');			
  				});
			})
			form.css('height',alto.min);
			respuesta.on('DOMSubtreeModified',function(ev){
				console.log(arguments);
				if(respuesta.hasClass('wpcf7-mail-sent-ok')){
					form.find('p:first').hide();
				}	
			})
		});
	})
}(jQuery);