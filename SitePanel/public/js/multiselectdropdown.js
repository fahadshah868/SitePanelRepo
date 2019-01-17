$(document).ready(function(){
    $(".multiselectdropdown").multiselect({
        nonSelectedText: 'Selected None',
        allSelectedText: 'Selected All',
        enableFiltering: true,
        buttonWidth: '100%',
        minHeight: 310,
        enableCaseInsensitiveFiltering: true,
        includeSelectAllOption: true,
        buttonClass: 'btn btn-secondary',
        templates: {
                        li: '<li><a class="dropdown-item" tabindex="0"><label style="padding-left: 10px; width: 100%; color: #000; font-size: 13px !important;"></label></a></li>',
                        ul: ' <ul class="multiselect-container dropdown-menu p-1 m-0" style="width: 100%;"></ul>',
                        button: '<button type="button" class="multiselect dropdown-toggle" data-toggle="dropdown" data-flip="false" style="color: #000; text-align: left; position: none !important;"><span class="multiselect-selected-text"></span> <b class="caret"></b></button>',
                        filter: '<li class="multiselect-item filter"><div class="input-group m-0"><input class="form-control multiselect-search" type="text"></div></li>',
                        filterClearBtn: '<span class="input-group-btn"><button class="btn btn-secondary multiselect-clear-filter" type="button" style="height: 38px;"><i class="fas fa-times"></i></button></span>'
                    },
                    buttonContainer: '<div class="dropdown"/>',
                    buttonClass: 'btn btn-default'
    });
});