<div class="modal fade" id="addTask{{ $classdatum->id }}" tabindex="-1" aria-labelledby="addTaskLabel{{ $classdatum->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addTaskLabel{{ $classdatum->id }}">課題の追加</h5>
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

                <form action="{{ route('classdata.update', ['classdatum' => $classdatum, 'task' => 2]) }}" method="post">
                @csrf
                @method('patch')
                    <div class="form-group">
                        <label for="date" class="col-form-label">課題の締め切り日時を入力</label>
                        <input type="datetime-local" class="form-control" id="date" name="deadline" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="button-all btn text-white rounded-pill m-2" name="submit">追加</button>
                    </div>
                </form>                
      </div>
    </div>
  </div>
</div>