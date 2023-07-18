
<div class="modal fade" id="addCreditedFromClassDatum{{ $classdatum->id }}" tabindex="-1" aria-labelledby="addCreditedFromClassDatumLabel{{ $classdatum->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addCreditedFromClassDatumLabel{{ $classdatum->id }}">授業を履修済みにする</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <p>
                この処理を行うと対象の授業が履修済み授業一覧に登録され、
                時間割から削除されます。<br>
                処理を行いますか？
            </p>
            <a href="{{ route('credited.migration', $classdatum) }}" class="button-all btn text-white rounded-pill m-2" role="button">はい</a>
            <button type="button" class="btn btn-outline-secondary rounded-pill m-2" data-bs-dismiss="modal" aria-label="Close">キャンセル</button>
      </div>
    </div>
  </div>
</div>