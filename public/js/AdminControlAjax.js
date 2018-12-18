$(document).ready(function () {

    $(document).on('click', '.chanel_click', function () {
        //alert($(this).data('chanelplaylists'));
        $('#footer_action_button').text(" Update");
        $('#footer_action_button').addClass('glyphicon-check');
        $('#footer_action_button').removeClass('glyphicon-trash');
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').addClass('edit');
        $('.modal-title').text('Edit');
        $('.deleteContent').hide();
        $('.form-horizontal').show();
        $('#chanelI').val($(this).data('chanelid'));
        $('#chanelD').val($(this).data('chaneldescription'));
        $('#chanelN').val($(this).data('chanelname'));      
        $('#myModal').modal('show');
    });


    $('.modal-footer').on('click', '.edit', function () {
        //var arr = $("#chanelP").val();
        //arr = arr.data;
        //arr.forEach(function (item, i, arr) {
        //    alert(i + ": " + item + " (массив:" + arr + ")");
        //});
        $.ajax({
            type: 'post',
            url: 'http://mytube.loc/admin/updatechanel',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('#chanelI').val(),
                'name': $('#chanelN').val(),
                'description': $("#chanelD").val(),               
            },
            success: function (data) {
                $('.chanelInList' + data.id).replaceWith("<li class='chanelInList" +
                        data.id + "'><span data-chanelid='" + data.id + "' data-chanelname='" + data.name + "'data-chaneldescription='" +
                        data.description +
                        "' class='chanel_click'>" + data.name + "</span></li>");
            }
        });

    });









});

