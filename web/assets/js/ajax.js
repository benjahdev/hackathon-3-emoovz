$(document).ready(function () {
    $('#autocomplete_search').keyup(function () {
        const inputstuff = $(this).val().toUpperCase();
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
                        let highlightstuff = stuff.name.replace(inputstuff, `<span class="highlight">${inputstuff}</span>`);
                        html += `<li data-id="${stuff.id}" class="list-group-item"><span class="stuff">${highlightstuff}</span></li>`;
                    }
                    $('#autocomplete').html(html);
                    $('#autocomplete li').on('click', function () {
                        $('#autocomplete').html('');
                        let data_id = $(this).attr('data-id');
                        $.ajax({
                            type: "POST",
                            url: `/item/add/${data_id}/1`,
                            dataType: 'html',
                            timeout: 3000,
                            success: function (response) {
                                console.log(response);
                                $('#stuff_list').append(response);
                            },
                            error: function() {
                                $('#autocomplete').text('Ajax call error 2');
                            }
                        });
                    });
                },
                error: function () {
                    $('#autocomplete').text('Ajax call error');
                }
            });
        } else {
            $('#autocomplete').html('');
        }
    });
});



// let getstuff = $(this).children('span').first().text();
// //$('#autocomplete_search').val(getstuff);
// $('#autocomplete').html('');
// let selectioned = $('<li></li>')
//     .addClass('list-group-item')
//     .append($('<span></span>'))
//     .append(getstuff)
//     .append("<span class='delete glyphicon glyphicon-trash'></span>");
// $('#stuff_added').append(selectioned);
// $(".delete").on('click', function (e) {
//     e.preventDefault();
//     $(this).parent(2).remove();
// })