$(document).ready(function(){
    $("#tableview tr td a, form a").click(function(event){
        event.preventDefault();
        $("#panel-body-container").load($(this).attr('href'));
    });
});