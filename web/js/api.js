$("document").ready(function () {

    /**
     * Ajax request on the user's subscription to the messenger
     */


    $('div.js_api').on('click', 'a.js_api', function () {
        var api = $(this).data('api');
        var apiId = $(this).data('api_id');
        var userId = $(this).data('user_id');

        $.ajax({
            url: '?r=api/messenger',
            type: 'POST',
            dataType: 'html',
            data: {
                'api': api,
                'userId': userId,
                'apiId': apiId
            },
            success: function (res) {
                $('div#js_user_' + api).html(res);
            },
            error: function () {
                alert('Сбой передачи');
            }
        });
        return false; //лучше так отключать дефолтное поведение html элементов
    });
});
