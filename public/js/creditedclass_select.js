var autocompleteRoute = $("#autocompleteRoutes").val();

$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content") },
})
$(document).ready( function() {
    $('#searchCredited').autocomplete({
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