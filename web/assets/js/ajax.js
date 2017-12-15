function updateStuffBasketItemQuantity() {
    let id = $(this).attr('data-id');
    let value = $(this).val();
    let room_id = $('.tab-pane-active').attr('data-id');

    if (value < 1) {
        $(this).val(1);
    } else if (value > 99) {
        $(this).val(99);
    }

    $.ajax({
        type: "POST",
        url: "/item/update-stuff-counter/" + id + "/room/" + room_id + "/inventory/1/" + value,
        dataType: 'html',
        timeout: 3000,
        success: function (response) {
            $('.tab-pane-active').html(response);
        },
        error: function () {
            console.log('AJAX error (counter) id: ' + id + ' value: ' + value + ' inventory: ' + 1);
        }
    });
}

function deleteStuffBasketItem() {
    let id = $(this).attr('data-id');
    let room_id = $('.tab-pane-active').attr('data-id');

    $.ajax({
        type: "POST",
        url: "/item/delete-stuff/" + id + "/inventory/1/room/" + room_id,
        dataType: 'html',
        timeout: 3000,
        success: function (response) {
            $('.tab-pane-active').html(response);
        },
        error: function () {
            console.log('AJAX error (counter) id: ' + id + ' inventory: ' + 1);
        }
    });
}

function addStuffBasketItem() {
    $('#autocomplete').html('');
    let data_id = $(this).attr('data-id');
    let room_id = $('.tab-pane-active').attr('data-id');

    console.log('BLA');
    console.log('room_id: ' + room_id);

    $.ajax({
        type: "POST",
        url: `/item/add/${data_id}/${room_id}`,
        dataType: 'html',
        timeout: 3000,
        success: function (response) {
            $('.tab-pane-active').html(response);
        },
        error: function () {
            $('#autocomplete').text('Ajax click stuff list error');
        }
    });
}

function addStuffItemToResults() {
    let inputstuff = $(this).val().toUpperCase();

    if (inputstuff.length >= 3) {
        $.ajax({
            type: "POST",
            url: "/stuff/list/" + inputstuff,
            dataType: 'json',
            timeout: 3000,
            success: function (response) {
                let stuffs = JSON.parse(response.data);
                let html = "";

                for (stuff of stuffs) {
                    html += `<li data-id="${stuff.id}" class="list-group-item">${stuff.name}</li>`;
                }

                $('#autocomplete').html(html);
                $('#autocomplete').find('li').on('click', addStuffBasketItem);
                //$('#autocomplete').find('.item-delete', deleteStuffBasketItem);
            },
            error: function () {
                console.log('Ajax stuff list error')
            }
        });
    } else {
        $('#autocomplete').html('');
    }
}

$(document).ready(function () {
    $(document).on("click", ".incr-btn", function (e) {
        let $button = $(this);
        let oldValue = $button.parent().find('.quantity').val();
        let newVal = 1;
        $button.parent().find('.incr-btn[data-action="decrease"]').removeClass('inactive');
        if ($button.data('action') == "increase") {
            newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below 1
            if (oldValue > 1) {
                newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 1;
                $button.addClass('inactive');
            }
        }
        $button.parent().find('.quantity').val(newVal);
        e.preventDefault();

        updateStuffBasketItemQuantity();
    });

    $('#autocomplete_search').keyup(addStuffItemToResults);
    $(document).on('change paste keyup', '.item-quantity', updateStuffBasketItemQuantity);
    $(document).on('click', '.item-delete', deleteStuffBasketItem);


});
