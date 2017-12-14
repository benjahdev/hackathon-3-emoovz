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
                        console.log(stuff);
                        let highlightstuff = stuff.name.replace(inputstuff, `<span class="highlight">${inputstuff}</span>`);
                        html += `<li class="list-group-item"><span class="stuff">${highlightstuff}</span></li>`;
                    }
                    $('#autocomplete').html(html);
                    $('#autocomplete li').on('click', function () {
                        let getstuff = $(this).children('span').first().text();
                        //$('#autocomplete_search').val(getstuff);
                        $('#autocomplete').html('');
                        let selectioned = $('<li></li>')
                            .addClass('list-group-item')
                            .append(getstuff);
                        $('#stuff_added').append(selectioned);
                    });
                },
                error: function () {
                    $('#autocomplete').text('Ajax call error');
                }
            });
        } else {
            $('#autocomplete').html('ekorkpoefi');
        }
    });
});
