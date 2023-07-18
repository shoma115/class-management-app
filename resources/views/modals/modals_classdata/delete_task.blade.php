<div class="modal fade" id="deleteTask{{ $classdatum->id }}" tabindex="-1" aria-labelledby="deleteTaskLabel{{ $classdatum->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteTaskLabel{{ $classdatum->id }}">授業の削除</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
    

                <div>
                   <h5>課題を削除します。よろしいですか？</h5>
                    <form action="{{ route('classdata.taskupdate', $classdatum) }}" method='post'>
                    @csrf
                    @method('patch')
                        
                        <button type="submit" class="btn btn-danger rounded-pill">削除</button>
                    </form>
                </div>    
                        
                
      </div>
    </div>
  </div>
</div>