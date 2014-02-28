
	    $(document).ready(function(){
	    	$("#select_encarrec").on("change", function(){
		    	var hi = $("#select_encarrec").find("option:selected").text();
		    	console.log(hi);
		    	$("#delete_encarrec").html('<img src="http://openclipart.org/people/molumen/molumen_red_round_error_warning_icon.svg" width="30" height="30" />');
		    	$("#fitxa_encarrec").find("h1").html("Dades de l'encarrec:");
		    	$("#fitxa_encarrec").html("<h1>Dades de l'encàrrec:</h1><div class='content'>Codi: "+$("#select_encarrec").find("option:selected").data("codi")+"<br>"+
		    										   "Km: "+ $("#select_encarrec").find("option:selected").data("km")+"<br>"+
													   "Pes: "+ $("#select_encarrec").find("option:selected").data("pes")+"<br>"+
												       "Direcció: "+$("#select_encarrec").find("option:selected").data("direccio")+"</div>");		    										   		    	
		    });

			

	    	$("#select_transportista").on("change", function(){
		    	var hi = $("#select").find("option:selected").text();
		    	console.log(hi);
		    	$("#delete_trans").html('<img src="http://openclipart.org/people/molumen/molumen_red_round_error_warning_icon.svg" width="30" height="30" />');		    	
		    	$("#fitxa_transportista").find("h1").html("Dades de l'encarrec:");
		    	$("#fitxa_transportista").html("<h1>Dades del transportista:</h1><div class='content'>Nom: "+$("#select_transportista").find("option:selected").data("nom")+"<br>"+
		    										   "Id: "+$("#select_transportista").find("option:selected").data("codi")+"<br>"+
		    										   "Vehicle: "+ $("#select_transportista").find("option:selected").data("vehicle")+"<br>"+	
		    										   "Despesa: "+ $("#select_transportista").find("option:selected").data("despesa")+"</div>");	
		    });

		    $("#delete_encarrec").on("click", function(){
		    	$("#delete_encarrec").html("");
		    	$("#fitxa_encarrec").html("");
		    });

		    $("#delete_trans").on("click", function(){
		    	$("#delete_trans").html("");
		    	$("#fitxa_transportista").html("");
		    });	    		    
	    });
