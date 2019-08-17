$(document).ready(function(){
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


	$('.profile-picture img').on('click', function(){
		$('.profile-picture .avatar-upload').click();
	})
	$('.avatar-upload').on('change', function(){
		$('.profile-picture .text-message').hide();
		$('.profile-picture .text-message').empty();
		if(this.files[0]){
            if(this.files[0].size > 8388608){
               $('.profile-picture #message-error').show();
               $('.profile-picture #message-error').text('Dung lượng file tối đa là 8mb');
               return;
            }
        }
		var data;
		var _this = $(this);
	    data = new FormData();
	    data.append('file', $(this)[0].files[0]);
        $.ajax({
            type: "POST",
            data : data,
            url: _this.attr('action'),
            processData: false,  // tell jQuery not to process the data
       		contentType: false,  // tell jQuery not to set contentType
            success: function(response){
                var responseMessage = JSON.parse(response);
                console.log(responseMessage);
                if(responseMessage['success']){
                	$('.profile-picture .text-message').hide();
                	$('.profile-picture #message-success').show();
                	$('.profile-picture #message-success').text(responseMessage['success']);
                	setTimeout(function(){ 
                		location.reload();
                	}, 2000);
                }
                if(responseMessage && !responseMessage['success']){
                	$('.profile-picture .text-message').hide();
                	$('.profile-picture #message-error').show();
                	$.each(responseMessage , function (index, value){
						$('.profile-picture #message-error').append(value);
					});
                	
                }
            }
        })
	})
	$('#formEditProfile').on('submit', function(e){
		$('#update_user_information .text-message').hide();
		$('#update_user_information .text-message').empty();
		e.preventDefault();
		var _this = $(this);
        var data = new FormData($(this)[0]);
		$.ajax({
            type: "POST",
            data : data,
            url: _this.attr('action'),
            processData: false,  // tell jQuery not to process the data
       		contentType: false,  // tell jQuery not to set contentType
            success: function(response){
                var responseMessage = JSON.parse(response);
                console.log(responseMessage);
                if(responseMessage['success']){
                	$('#update_user_information .text-message').hide();
                	$('#update_user_information #message-success').show();
                	$('#update_user_information #message-success').text(responseMessage['success']);
                }
                if(responseMessage && !responseMessage['success']){
                	$('#update_user_information .text-message').hide();
                	$('#update_user_information #message-error').show();
                	$.each(responseMessage , function (index, value){
						$('#update_user_information #message-error').append(value);
					});
                	
                }
            }
        })
	})
})