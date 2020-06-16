<!-- Modal -->
<div class="modal fade" id="limitCustom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Loop Customization</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="limit" class="col-form-label">How many times you want to repeat this video:</label>
          <input type="number" class="form-control" id="limit" name="limit" placeholder="EX: 5" min="1" value="1">
        </div>
        <div class="row" id="m2details">
          
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="watchVideo()">Save</button>
      </div>
    </div>
  </div>
</div>