$(document).ready(function() {
    $("#editbutton").click(function() {
        var $tabs=$('.listTable')
        $( "tbody.connectedSortable" )
            .sortable({
                connectWith: ".connectedSortable",
                items: "> tr:not(:first)",
                appendTo: $tabs,
                helper:"clone",
                zIndex: 999990,
                receive: function(event, ui) {
                    var addedTo = $(this).closest("table.listTable"),
                        removedFrom = $("table.listTable").not(addedTo),
                        row_id = $(ui.item);
                    $.ajax({url: "updatecolour.php?student_id=" + row_id.attr("id") + "&colour=" + addedTo.attr("id")});
                }

            })
            .disableSelection();
        
        var $tab_items = $( ".nav-tabs > li", $tabs ).droppable({
        accept: ".connectedSortable tr",
        hoverClass: "ui-state-hover",
        
        drop: function( event, ui ) {
            return false;
        }
        });
    });
});