var autocompleteRoute = $("#autocompleteRoute").val();
var niceIncreseRoute = $("#niceIncrese").val();
var niceDecreseRoute = $("#niceDecrese").val();

// 検索のサジェスト機能
$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content") },
})
$(document).ready( function() {
    $('#searchReview').autocomplete({
        source: function(request, response) { 
                    
            $.ajax({
            url: autocompleteRoute,
            method: "POST",
            data: { search : request.term },
            dataType: "json",
            }).done(function(res){
                response(res.suggest);
                console.log(res.suggest);
                
                
            }).fail(function(){
                    alert('通信の失敗をしました');
            });
        }
    })
})

// いいね機能
$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content") },
})
$('span').on('click', function(){
    var postId = $(this).data('postid');
    var heart = $(this).find(".heart-icon");
    var numberOfNice = $(this).find(".number-of-nice")
    // いいねを付けていない時にいいねボタンを押す（いいねを付ける）
    if(heart.hasClass("nice-button")) {            
        $.ajax({
        url: niceIncreseRoute,
        method: "POST",
        data: { post_id : postId },
        dataType: "json",
        }).done(function(res){
            numberOfNice.text(res.sum_nice);
            heart.addClass('delete');
            heart.removeClass('nice-button');
        }).fail(function(){
                alert('通信に失敗しました');
        });
        // いいねを付けている時にいいねを押す（いいねを消す）
    }else if(heart.hasClass("delete")) {            
        $.ajax({
        url: niceDecreseRoute,
        method: "POST",
        data: { delete_id : postId },
        dataType: "json",
        }).done(function(res){
            numberOfNice.text(res.sum_nice);
            heart.addClass('nice-button');
            heart.removeClass('delete');
            
        }).fail(function(){
                alert('通信に失敗しました');
        });
    }
 });