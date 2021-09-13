{{-- modal start --}}
<div class="modal fade" id="delete-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you confirm to delete this item?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger btn-sm" form="modal-delete-form">Confirm</button>
        <form action="" method="post" id="modal-delete-form">
          @csrf
          @method('DELETE')
        </form>
      </div>
    </div>
  </div>
</div>
{{-- modal end --}}
