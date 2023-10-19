<div class="modal fade" id="editQuestion" tabindex="-1" aria-labelledby="editQuestionLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editQuestionLabel">質問の編集</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

                @if($errors->any())
                <div>
                    <ul>
                    @foreach($errors->all() as $error)
                    
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
                @endif
                <form action="{{ route('question.update', $question) }}" method="POST">
                @csrf
                @method('patch')
                    <div class="d-flex flex-column">
                        <label class="fw-bold">質問のタイトル</label>
                        <input class="form-control" type="text" name="title" value="{{ old('title', $question->title) }}">
                        <label class="fw-bold">内容</label>
                        <textarea class="form-control" name="content" rows="5">{{ old('content', $question->content) }}</textarea>
                    </div>
                    <button type="submit" class="button-all btn text-white rounded-pill m-2" name="submit" value="create">更新</button>
                </form>
      </div>
    </div>
  </div>
</div>