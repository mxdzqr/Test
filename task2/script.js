$().ready(function(){
    $("#contact-submit").click(function(e){
        e.preventDefault();
        var form = $("#contact").serialize();
        $.ajax({
            type: "POST",
            url: "index.php",
            data: form,
            success: function(data){
                alert('Форма отправлена');
            }
        });
    });
});