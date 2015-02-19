            $(document).ready(function(){
                
            });

            function sendPushNotification(id){
                var data = $('form#'+id).serialize();
                $('form#'+id).unbind('submit');                
                $.ajax({
                    url: "send_push_notification_message.php",
                    type: 'GET',
                    data: data,
                    beforeSend: function() {
                         
                    },
                    success: function(data, textStatus, xhr) {
                          $('.push_message').val("");
                    },
                    error: function(xhr, textStatus, errorThrown) {
                         
                    }
                });
                return false;
            }