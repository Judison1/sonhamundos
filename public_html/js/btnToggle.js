	function btnToggle(btn_status , url, edit_tr) {

		var btn_group = btn_status.parents('.btn-group-justified');
		var selected = btn_group.children('.selected');

		var tr = btn_group.parents("tr");
		var id = tr.data('id');
		var status = btn_status.data('value');

		
		url = url + "/" + id + "/" + status;
		
		$.get(url, function(msg) {

			if(msg == "success") {

				var btn = selected.children('.btn-success'); 
	  			btn.removeClass('btn-success').addClass('btn-default');
	  			selected.removeClass('selected');

	  			btn_status.parent('.btn-group').addClass('selected');
	  			btn_status.addClass('btn-success');

	  			if(edit_tr) {

	  				if(status == 1) {
	  					tr.removeClass('danger').addClass('success');
		  			} else {
		  				tr.removeClass('success').addClass('danger');
		  			}
		  			
	  			}
	  			
  			
			} else {

				alert("Não foi possível alterar o status do artigo");

			}

		});
  	}