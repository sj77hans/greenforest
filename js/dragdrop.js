$(document).ready(function () {
    $('table tbody').sortable({
        update: function (event, ui) {
            $(this).children().each(function (index) {
                    if ($(this).attr('data-position') != (index+1)) {
                        $(this).attr('data-position', (index+1)).addClass('updated');
                    }
            });

            saveNewPositions();
        }
    });
});

function saveNewPositions() {
    var positions = [];
    $('.updated').each(function () {
    positions.push([$(this).attr('data-index'), $(this).attr('data-position')]);
    $(this).removeClass('updated');
    });

    $.ajax({
        url: '../products/category_positon_save.php',
        method: 'POST',
        dataType: 'text',
        data: {
            update: 1,
            positions: positions
        }, 
        success: function(response) {
            if(response == 'success') {
                window.location.reload();
            }
        }
    });
}