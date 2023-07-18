<div class="modal fade" id="deleteClassdatum{{ $classdatum->id }}" tabindex="-1" aria-labelledby="deleteClassDatumLabel{{ $classdatum->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteClassDatumLabel{{ $classdatum->id }}">授業の削除</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
    

                <div>
                    <h3>{{ $classdatum->class_name }}を時間割から削除してもよろしいですか？</h3>
                    <form action="{{ route('classdata.delete', $classdatum) }}" method='post'>
                    @csrf
                    @method('delete')
                      
                        <button type="submit" class="btn btn-danger rounded-pill">削除</button>
                        <button type="button" class="btn btn-outline-secondary rounded-pill m-2" data-bs-dismiss="modal" aria-label="Close">キャンセル</button>
                    </form>
                </div>    
                        
                
      </div>
    </div>
  </div>
</div>