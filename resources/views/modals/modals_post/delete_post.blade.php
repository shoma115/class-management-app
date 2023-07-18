<div class="modal fade" id="deletePost" tabindex="-1" aria-labelledby="deletePostLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deletePostLabel">レビューの削除</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      

                <div>
                    <h3>{{ $post->class_name }}のレビューを削除します。よろしいですか？</h3>
                   
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