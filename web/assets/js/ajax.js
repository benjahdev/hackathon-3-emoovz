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
            $('.tab-pane-active').html(response);
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
    // $(document).on("click", ".incr-btn", function (e) {
    //     let $button = $(this);
    //     let oldValue = $button.parent().find('.quantity').val();
    //     let newVal = 1;
    //     $button.parent().find('.incr-btn[data-action="decrease"]').removeClass('inactive');
    //     if ($button.data('action') == "increase") {
    //         newVal = parseFloat(oldValue) + 1;
    //     } else {
    //         // Don't allow decrementing below 1
    //         if (oldValue > 1) {
    //             newVal = parseFloat(oldValue) - 1;
    //         } else {
    //             newVal = 1;
    //             $button.addClass('inactive');
    //         }
    //     }
    //     $button.parent().find('.quantity').val(newVal);
    //
    //     updateStuffBasketItemQuantity();
    //
    //     e.preventDefault();
    // });
    //plugin bootstrap minus and plus
//http://jsfiddle.net/laelitenetwork/puJ6G/
    $(document).on('click', '.btn-number', function(e){
        e.preventDefault();

        fieldName = $(this).attr('data-field');
        type      = $(this).attr('data-type');
        var input = $("input[name='"+fieldName+"']");
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            if(type == 'minus') {

                if(currentVal > input.attr('min')) {
                    input.val(currentVal - 1).change();
                }
                if(parseInt(input.val()) == input.attr('min')) {
                    $(this).attr('disabled', true);
                }

            } else if(type == 'plus') {

                if(currentVal < input.attr('max')) {
                    input.val(currentVal + 1).change();
                }
                if(parseInt(input.val()) == input.attr('max')) {
                    $(this).attr('disabled', true);
                }

            }
        } else {
            input.val(0);
        }
    });
    $(document).on('focusin', '.input-number', function(){
        $(this).data('oldValue', $(this).val());
    });
    $(document).on('change', '.input-number', function() {

        minValue =  parseInt($(this).attr('min'));
        maxValue =  parseInt($(this).attr('max'));
        valueCurrent = parseInt($(this).val());

        namev = $(this).attr('name');
        if(valueCurrent >= minValue) {
            $(".btn-number[data-type='minus'][data-field='"+namev+"']").removeAttr('disabled')
        } else {
            alert('Sorry, the minimum value was reached');
            $(this).val($(this).data('oldValue'));
        }
        if(valueCurrent <= maxValue) {
            $(".btn-number[data-type='plus'][data-field='"+namev+"']").removeAttr('disabled')
        } else {
            alert('Sorry, the maximum value was reached');
            $(this).val($(this).data('oldValue'));
        }


    });
    $(document).on('keydown', ".input-number", function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
            // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });


    $('#autocomplete_search').keyup(addStuffItemToResults);
    $(document).on('change paste keyup', '.item-quantity', updateStuffBasketItemQuantity);
    $(document).on('click', '.item-delete', deleteStuffBasketItem);


});
