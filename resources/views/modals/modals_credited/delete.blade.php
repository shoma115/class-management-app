<div class="modal fade" id="deleteCredited" tabindex="-1" aria-labelledby="deleteCreditedLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteCreditedLabel">授業の削除</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
    

                <div>    
                    <form name="deleteModalForm" action="" method='post'>
                    @csrf
                    @method('delete')
                        <h3 id="deleteMessage"></h3>
                        <button type="submit" class="btn btn-danger rounded-pill">削除</button>
                        <button type="button" class="btn btn-outline-secondary rounded-pill m-2" data-bs-dismiss="modal" aria-label="Close">キャンセル</button>
                    </form>
                </div>

                <script>
                  var deleteModal = document.getElementById('deleteCredited');
                  const deleteModalForm = document.forms.deleteModalForm;
                  const deleteMessage = document.getElementById('deleteMessage');

                  deleteModal.addEventListener('show.bs.modal', (event) => {
                        let deleteButton = event.relatedTarget;
                        let creditedId = deleteButton.dataset.creditedId;
                        let creditedName = deleteButton.dataset.creditedName;

                        deleteModalForm.action = `${creditedId}`;
                        deleteMessage.textContent = `${creditedName}を履修済み授業から削除します。よろしいですか？`
                  })
                </script>        
                
      </div>
    </div>
  </div>
</div>