$('.room-selector').click(function(e){
    e.preventDefault();
    // let is_selected = $(this).attr('data-selected');
    $('#myTab').append(
    $('<a class="list-room" data-id="' + $(this).attr('data-id') + '"data-toggle="tab"></a>')
        .append($(this).attr('data-name'))
        .addClass("list-room link")
        .on('click', function(e){
            let lol = $(this).attr('data-id');
            $('.tab-pane').fadeOut().hide();
            $('.tab-content').find('#lol' + lol).show().fadeIn();
    }));
    $('.tab-content').append("<div class='tab-pane' id=" + 'lol' +  $(this).attr('data-id') + "></div>");
    $(this).remove();
});

$('#myModal').on('shown.bs.modal', function () {
    $('#myInput').focus()
})

$('.list-room').click(function(e){
    e.preventDefault();
    // let is_selected = $(this).attr('data-selected');
    $('#myModal').append(
        $('<a class="list-room" data-id="' + $(this).attr('data-id') + '"data-toggle="tab"></a>')
            .append($(this).attr('data-name'))
           );
    $(this).remove();
});

