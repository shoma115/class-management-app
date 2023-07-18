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
                    <div>
                        <label>質問のタイトル</label>
                        <input type="text" name="title" value="{{ old('title', $question->title) }}">

                        <label>内容</label>
                        <textarea name="content">{{ old('content', $question->content) }}</textarea>
                    </div>
                    </div>
                    <button type="submit" class="submit-btn" name="submit" value="create">更新</button>
                </form>
      </div>
    </div>
  </div>
</div>