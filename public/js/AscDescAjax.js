$(document).ready(function () {
    
    var h = $('.video_player_description')[0].scrollHeight;

    $("#more").click(function (e) {
         e.preventDefault();
        $('.video_player_description').animate({
            'height': h
        });
    });

    $(".video_player_description").click(function () {
        $('.video_player_description').animate({
            'height': '90px'
        });
    });






});

