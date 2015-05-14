$(function(){
	/** Datatables **/
	$('.dataTable').dataTable();
	/** select bootstrap **/
	$('.selectBootstrap').selectpicker();
	/** Confirm dialog **/
	$(document).on('click', '.confirm', function(e){
		e.preventDefault();
		var $this = $(this);
		bootbox.dialog({
			message: $this.data('message') || "Esta seguro de eliminar este elemento?",
			title: $this.data('title') || "Eliminar elemento",
			buttons: {
				success: {
				    label: $this.data('success') || "Si",
				    className: "btn-success",
				    callback: function() {
				    	window.location.href = $this.attr('href');  
				    }
			    },
			    danger: {
				    label: $this.data('danger') || "No",
				    className: "btn-danger",
				    callback: function() {
				    	
				    }
			    }
			}
		});
	});
	/** SlugAble **/
	if($('.slugable').length > 0){
		var $target = $('.slugable').find('.slug-target');
		var $source = $('.slugable').find('.slug-source');
		$target.slugify($source);
	}
});