
$('.list-room').click(function(e){
    e.preventDefault();
    // let is_selected = $(this).attr('data-selected');
    $('#myModal').append(
        $('<a class="list-room" data-id="' + $(this).attr('data-id') + '" data-toggle="tab"></a>')
            .append($(this).attr('data-name'))
    );
    $(this).remove();
});

$('.room-selector').click(function(e){
    e.preventDefault();
    // let is_selected = $(this).attr('data-selected');
    $('#myTab').append(
    $('<a class="list-room" data-id="' + $(this).attr('data-id') + '" data-toggle="tab"></a>')
        .append($(this).attr('data-name'))
        .append('<span class="btn btn-danger delete-room glyphicon glyphicon-trash"></span>')
        .addClass("list-room link")
        .on('click', function(e){
            let lol = $(this).attr('data-id');

            $.ajax({
                type: "POST",
                url: "/item/room/" + lol + "/inventory/1",
                dataType: 'html',
                timeout: 3000,
                success: function (response) {
                    $('.tab-content').find('#lol' + lol).html(response);
                },
                error: function () {
                    console.log('AJAX error (counter) id: ' + id + ' inventory: ' + 1);
                }
            });

            $('.delete-room').on('click', function(){
                let roomName =  $(this).parent().text();
                let roomId = $(this).parent().attr('data-id');
                $('.modal-body').append(
                  $('<div></div>').addClass('room-selector')
                      .attr('data-id', roomId)
                      .attr('data-name', roomName)
                      .append($('<a></a>')
                          .append(roomName))
                );
                $(this).parent().remove();
            });

            $('.list-room').removeClass('btn-room');

            $('.tab-pane')
                .fadeOut()
                .hide()
                .removeClass('tab-pane-active');

            $(this).addClass('btn-room');

            $('.tab-content').find('#lol' + lol)
                .addClass('tab-pane-active')
                .attr('data-id', lol)
                .show()
                .fadeIn();

    }));

    $('.tab-content').append("<div class='tab-pane' id=" + 'lol' +  $(this).attr('data-id') + "></div>");
    $(this).remove();
});

$('#myModal').on('shown.bs.modal', function () {
    $('#myInput').focus()
});
