function updateStuffBasketItemQuantity() {
    let id = $(this).attr('data-id');
    let value = $(this).val();

    if (value < 1) {
        $(this).val(1);
    } else if (value > 99) {
        $(this).val(99);
    }

    $.ajax({
        type: "POST",
        url: "/item/update-stuff-counter/" + id + "/inventory/1/" + value,
        dataType: 'html',
        timeout: 3000,
        success: function (response) {
            $('#stuff_list').empty()
                .html(response);
        },
        error: function () {
            console.log('AJAX error (counter) id: ' + id + ' value: ' + value + ' inventory: ' + 1);
        }
    });
}

function deleteStuffBasketItem() {
    let id = $(this).attr('data-id');

    $.ajax({
        type: "POST",
        url: "/item/delete-stuff/" + id + "/inventory/1",
        dataType: 'html',
        timeout: 3000,
        success: function (response) {
            $('#stuff_list').empty()
                .html(response);
        },
        error: function () {
            console.log('AJAX error (counter) id: ' + id + ' inventory: ' + 1);
        }
    });
}

function addStuffBasketItem() {
    $('#autocomplete').html('');
    let data_id = $(this).attr('data-id');

    bindCancel = false;
    $.ajax({
        type: "POST",
        url: `/item/add/${data_id}/1`,
        dataType: 'html',
        timeout: 3000,
        success: function (response) {
            $('#stuff_list').html(response);

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
                $('#autocomplete').find('.item-delete', deleteStuffBasketItem);
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
    $('#autocomplete_search').keyup(addStuffItemToResults);
    $(document).on('keyup mouseup', '.item-quantity', updateStuffBasketItemQuantity);
    $(document).on('click', '.item-delete', deleteStuffBasketItem);
});
