<!-- Modal -->
<div class="modal fade" id="searchByID" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Search By Video ID</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="videoID" class="col-form-label">Video ID:</label>
          <input type="text" class="form-control" id="videoID" name="videoID">
        </div>
        <div class="row" id="videos">
          <div class="col-md-12" id="mdetails">

          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="getDetailsInModal()">Search</button>
      </div>
    </div>
  </div>
</div>