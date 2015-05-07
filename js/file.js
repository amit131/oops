$("#id_'.$form_name.'").submit(function(e) {
		var dataString = $("#id_'.$form_name.'").serialize();
        //alert(dataString);
        $.ajax({
            type: "POST",
            url: "'.$form_action.'",
            data: dataString,
            beforeSend: function(){
				$("#msg").text("Saving....");
            },
            /*complete: function(){
            	$("#msg").text("");
            },	
            success: functiut(100, function() {
    			$(this).html(result);
			}).fadeIn(1000on(result) {
                $("#msg").fadeOut().delay(3000).html(result);
            }*/
            success: function(result) {
            $("#msg").fadeO);
        });
        return false; /// <=== that was missing.
        e.preventDefault();  /// Or this.
    	});