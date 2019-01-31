$(document).ready(function(){
    $("#tablebody tr").click(function(){
        $("#tablebody tr").removeClass('highlight-row');
        $(this).addClass('highlight-row');
    });
});