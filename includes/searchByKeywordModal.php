<!-- Modal -->
<div class="modal fade" id="searchByKeyword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Search By Keyword</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="keyword" class="col-form-label">Search:</label>
          <input type="text" class="form-control" id="keyword" name="keyword" placeholder="EX: Intensions Justin">
        </div>
        <div class="row" id="m2details">
          
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="SearchVideos()">Search</button>
      </div>
    </div>
  </div>
</div>