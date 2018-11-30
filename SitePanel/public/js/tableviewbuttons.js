$(document).ready(function(){
    $("#tableview tr td a:first").click(function(event){
        event.preventDefault();
        $("#panel-body-container").load($(this).attr('href'));
    });
});