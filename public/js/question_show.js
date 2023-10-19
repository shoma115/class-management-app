var answerNiceIncreaseRoute = $("#answerNiceIncreaseRoute").val();
var answerNiceDecreaseRoute = $("#answerNiceDecreaseRoute").val();

// textareaの自動拡大
window.addEventListener("DOMContentLoaded", () => {
    // textareaタグを全て取得
    const textareaEls = document.querySelectorAll("textarea");
    textareaEls.forEach((textareaEl) => {
      // inputイベントが発生するたびに関数呼び出し
      textareaEl.addEventListener("input", setTextareaHeight);
    });
  
    // textareaの高さを計算して指定する関数
    function setTextareaHeight() {
      this.style.height = `${this.scrollHeight}px`;
    }
  });

//   返信入力欄・入力無しの時に送信ボタンを非活性
const textareaContent = document.getElementById('floatingTextarea2');
var submitButton = document.getElementById('submit');

textareaContent.addEventListener('input', () => {
    if(textareaContent.value.length === 0) {
        submitButton.disabled = true;
    } else {
        submitButton.disabled = false;
    }
    })

// 回答の編集
$(".editAnswer").on("click", function() {
    $(this).closest(".list-group-item").find(".editFrom").css("display", "block");
    $(this).closest(".default").css("display", "none");
})


// いいね機能
$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content") },
})
$('span').on('click', function(){
    var answerId = $(this).data('answerid');
    var heart = $(this).find(".heart-icon");
    var numberOfNice = $(this).find(".number-of-nice")
    // いいねを付けていない時にいいねボタンを押す（いいねを付ける）
    if(heart.hasClass("nice-button")) {            
        $.ajax({
        url: answerNiceIncreaseRoute,
        method: "POST",
        data: { answer_id : answerId },
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
        url: answerNiceDecreaseRoute,
        method: "POST",
        data: { delete_id : answerId },
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