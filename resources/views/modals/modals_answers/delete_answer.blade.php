<div class="modal fade" id="deleteAnswer{{ $answer->id }}" tabindex="-1" aria-labelledby="deleteAnswerLabel{{ $answer->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteAnswerLabel{{ $answer->id }}">回答の削除</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
    
                <h5>返信を削除します。よろしいですか？</h5>
                <form action="{{ route('answer.delete', ['answer' => $answer, 'question' => $question]) }}" method="POST">
                @csrf
                @method('delete')
                    <button type="submit" class="btn btn-danger rounded-pill" name="submit" value="create">削除</button>
                    <button type="button" class="btn btn-outline-secondary rounded-pill m-2" data-bs-dismiss="modal" aria-label="Close">キャンセル</button>
                </form>
      </div>
    </div>
  </div>
</div>