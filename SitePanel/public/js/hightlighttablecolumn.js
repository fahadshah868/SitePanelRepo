$(document).ready(function(){
    $("#body-main-content").mouseup(function (e){
        var container = $("#tableview tr");
        if (!container.is(e.target) && container.has(e.target).length === 0){
            container.removeClass('highlight-row'); 
        }
    });
    $("#tablebody tr").click(function(){
        $("#tablebody tr").removeClass('highlight-row');
        $(this).addClass('highlight-row');
    });
});