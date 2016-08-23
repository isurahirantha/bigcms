            $(document).ready(function() {
                $('#submitbtn').click(function() {
                    $(".noticebody").html('');
                    $(".noticebody").html('<img src="img/loading.gif" />');
                    $(".uploadform").ajaxForm({
                        target: '.noticebody';
                    }).
                submit();
                });
            });