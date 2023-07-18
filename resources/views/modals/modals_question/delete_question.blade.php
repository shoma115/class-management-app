<div class="modal fade" id="deleteQuestion" tabindex="-1" aria-labelledby="deleteQuestionLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteQuestionLabel">質問の削除</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div>
                <h3>質問を削除します。よろしいですか？</h3>
                    <form action="{{ route('question.delete', $question) }}" method="post">
                    @csrf
                    @method('delete')
                        <button type="submit" class="btn btn-danger">削除</button>
                    </form>
                </div>    
                
      </div>
    </div>
  </div>
</div>