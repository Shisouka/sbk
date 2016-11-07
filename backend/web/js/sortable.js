$(document).ready(function() {
	$(function() {
		var target = $('[data-file-sort = true]');
		target.sortable(
			{
				items:'.file-preview-initial',
				cursor: 'move',
				update: function() {
					var files=new Array();
					target = $(this);
					target.sortable('toArray').forEach(function(e){
						attr=$('#'+e+' img').attr('id');
						if(typeof attr !== typeof undefined && attr !== false)
							files.push(attr);
					});
					$.ajax({
						url: '/admin/files/default/sort',
						type: 'POST',
						data:{files:files}
					});
				}
			});
		target.disableSelection();
	});
});