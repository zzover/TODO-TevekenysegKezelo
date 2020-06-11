<!-- Új projekt MODAL -->
<div class="modal fade" id="newProjectModal" tabindex="-1" role="dialog" aria-labelledby="newProjectModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newProjectModalLabel"><?php echo textHome[$lang]["newProjectTitle"];?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="<?php echo textHome[$lang]["textCancel"];?>">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="newProjectModalBody">
      <form id="newProjectForm">
          <div class="form-group">
            <label for="projectName" class="col-form-label"><?php echo textHome[$lang]["newProjectNameLabel"];?></label>
            <input type="text" class="form-control" id="projectName" tabindex="1">
          </div>
          <div class="form-group">
            <label for="projectInfo" class="col-form-label"><?php echo textHome[$lang]["newProjectInfoLabel"];?></label>
            <textarea class="form-control" id="projectInfo" tabindex="2"></textarea>
          </div>
          <div class="row">
      <div class="col-md-5 mb-3">
          <label for="colorSelect"><?php echo textHome[$lang]["newProjectColorLabel"];?></label>
            <select class="form-control" id="colorSelect" tabindex="3">
            <option value="bg-primary text-white"><?php echo textHome[$lang]["1"];?></option>
            <option value="bg-secondary text-white"><?php echo textHome[$lang]["2"];?></option>
            <option value="bg-success text-white"><?php echo textHome[$lang]["3"];?></option>
            <option value="bg-danger text-white"><?php echo textHome[$lang]["4"];?></option>
            <option value="bg-warning text-dark"><?php echo textHome[$lang]["5"];?></option>
            <option value="bg-info text-white"><?php echo textHome[$lang]["6"];?></option>
            <option value="bg-light text-dark"><?php echo textHome[$lang]["7"];?></option>
            <option value="bg-dark text-white"><?php echo textHome[$lang]["8"];?></option>
            </select>
      </div>

      <div class="col-md-3 ml-auto">
        <div class="card bg-primary text-white" id="bemutato">
            <div class="card-header"></div>
            <div class="card-body"></div>
        </div>
      </div>
    </div>
    
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" tabindex="5"><?php echo textHome[$lang]["textCancel"];?></button>
        <button type="button" class="btn btn-primary" id="newProjectButton" tabindex="4"><?php echo textHome[$lang]["textSave"];?></button>
      </div>
    </div>
  </div>
</div>