$(document).ready(function () {
    $("#appbundle_room_stuff").keyup(function () {
        const inputObject = $(this).val().toUpperCase();
        if (inputObject.length >= 3) {
            $.ajax({
                type: "POST",
                url: "/stuff/list" + inputObject,
                dataType: 'json',
                timeout: 3000,
                success: function (response) {
                    const stuffs = JSON.parse(response.data);
                    let html = "";
                    for (stuff of stuffs) {
                        let highlightObject = stuff.stuff.replace(inputObject, `<span class="highlight">${inputObject}</span>`);
                        html += `<li class="list-group-item"><span class="stuff">${highlightObject}</span></li>`;
                    }
                    $('#autocomplete').html(html);
                    $('#autocomplete li').on('click', function () {
                        let getObject = $(this).children('span').first().text();
                        $('#appbundle_room_stuff').val(getObject);
                        $('#autocomplete').html('');
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
