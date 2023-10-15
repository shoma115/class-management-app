var week = $("#week").val();
var time = $("#time").val();
var autocompleteRoute = $("#autocompleteRoute").val();

$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content") },
})
$(document).ready( function() {
    $('#searchForm').autocomplete({
        source: function(request, response) { 
                    
            $.ajax({
            url: autocompleteRoute,
            method: "POST",
            data: { 
                    search : request.term,
                    week : week,
                    time : time 
                },
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