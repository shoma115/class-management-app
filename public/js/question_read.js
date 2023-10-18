var questionAutocompleteRoute = $("#questionAutocompleteRoute").val();
var questionNiceIncreseRoute = $("#questionNiceIncreseRoute").val();
var questionNiceDecreseRoute = $("#questionNiceDecreseRoute").val(); 

// autocomplete機能
$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content") },
})
$(document).ready( function() {
    $('#searchQuestion').autocomplete({
        source: function(request, response) { 
                    
            $.ajax({
            url: questionAutocompleteRoute,
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
    var questionId = $(this).data('questionid');
    var heart = $(this).find(".heart-icon");
    var numberOfNice = $(this).find(".number-of-nice")
    // いいねを付けていない時にいいねボタンを押す（いいねを付ける）
    if(heart.hasClass("nice-button")) {            
        $.ajax({
        url: questionNiceIncreseRoute,
        method: "POST",
        data: { question_id : questionId },
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
        url: questionNiceDecreseRoute,
        method: "POST",
        data: { delete_id : questionId },
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