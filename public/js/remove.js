function removeElement(btn_remove, token, route) {

  		res = confirm("Deseja realmente deletar esse artigo?");
  			if(res == true) {

	  			var tr = btn_remove.parents('tr');
	  			var id = tr.data('id');	

	  			$.ajax({
					url: route,
					type: 'DELETE',
					dataType: 'json',
					data: {id: id, _token: token },
				})
				.done(function(response) {

					if(response.result == true) {
						tr.remove();
						alert(response.mensage);
					} else {
						alert(response.mensage);
					}
					
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
			}

  	}