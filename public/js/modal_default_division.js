var division1 = $(".division1");
var division2 = $(".division2");
var division3 = $(".division3");
var division2List = $(".division2_list");
var division3List = $(".division3_list");
var div1Value = $(division1).val();
console.log(div1Value)

// 初期値で表示を変える
if(div1Value === '共通教育') {
    division3.hide();
    division2.show();
    division2List.prop('disabled', false);
    division3List.prop('disabled', true);

}else if(div1Value === '専門教育') {
    division2.hide();
    division3.show();
    division2List.prop('disabled', true);
    division3List.prop('disabled', false);
}else if(div1Value === '他学科・他学部科目' || 'その他') {
    division2.hide();
    division3.hide();
    division2List.prop('disabled', true);
    division3List.prop('disabled', true);
};

division1.change(function() {
    var div1Value = $(this).val();
    // 科目枠組1で「共通教育」を選んでいた場合
    if(div1Value === '共通教育') {
        division3.hide();
        division2.show();
        division2List.prop('disabled', false);
        division3List.prop('disabled', true);
       

        // 科目枠組1で「専門教育」を選んだ場合
    }else if(div1Value === '専門教育') {
        division2.hide();
        division3.show();
        division2List.prop('disabled', true);
        division3List.prop('disabled', false);
        // 科目枠組み1で他学部科目を選んだ
    }else if(div1Value === '他学科・他学部科目' || 'その他') {
    division2.hide();
    division3.hide();
    division2List.prop('disabled', true);
    division3List.prop('disabled', true);
};
});