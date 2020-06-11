<!-- Projekt megtekintése/szerkesztése MODAL -->
<div class="modal fade" id="projectView" tabindex="-2" role="dialog" aria-labelledby="projectViewLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="projectViewLabel"><?php echo textHome[$lang]["editProjectTitle"];?></h5>

        
        <!--<div class="actions">
          <svg data-toggle="tooltip" data-placement="bottom" title="<?php echo textHome[$lang]["shareTooltip"];?>" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"><path d="M20 3c0-1.657-1.344-3-3-3s-3 1.343-3 3c0 .312.061.606.149.889l-4.21 3.157c.473.471.878 1.01 1.201 1.599l4.197-3.148c.477.316 1.048.503 1.663.503 1.656 0 3-1.343 3-3zm-2 0c0 .551-.448 1-1 1s-1-.449-1-1 .448-1 1-1 1 .449 1 1zm3 12.062c1.656 0 3-1.343 3-3s-1.344-3-3-3c-1.281 0-2.367.807-2.797 1.938h-6.283c.047.328.08.66.08 1s-.033.672-.08 1h6.244c.396 1.195 1.509 2.062 2.836 2.062zm-1-3c0-.551.448-1 1-1s1 .449 1 1-.448 1-1 1-1-.448-1-1zm-20-.062c0 2.761 2.238 5 5 5s5-2.239 5-5-2.238-5-5-5-5 2.239-5 5zm2 0c0-1.654 1.346-3 3-3s3 1.346 3 3-1.346 3-3 3-3-1.346-3-3zm7.939 4.955l4.21 3.157c-.088.282-.149.576-.149.888 0 1.657 1.344 3 3 3s3-1.343 3-3-1.344-3-3-3c-.615 0-1.186.187-1.662.504l-4.197-3.148c-.324.589-.729 1.127-1.202 1.599zm6.061 4.045c0-.551.448-1 1-1s1 .449 1 1-.448 1-1 1-1-.449-1-1z"/></svg>

        <div class="btn-group dropright">
          <svg data-placement="bottom" title="<?php echo textHome[$lang]["settingsTooltip"];?>" xmlns="http://www.w3.org/2000/svg" data-toggle="dropdown" width="25" height="25" viewBox="0 0 24 24"><path d="M24 13.616v-3.232l-2.869-1.02c-.198-.687-.472-1.342-.811-1.955l1.308-2.751-2.285-2.285-2.751 1.307c-.613-.339-1.269-.613-1.955-.811l-1.021-2.869h-3.232l-1.021 2.869c-.686.198-1.342.471-1.955.811l-2.751-1.308-2.285 2.285 1.308 2.752c-.339.613-.614 1.268-.811 1.955l-2.869 1.02v3.232l2.869 1.02c.197.687.472 1.342.811 1.955l-1.308 2.751 2.285 2.286 2.751-1.308c.613.339 1.269.613 1.955.811l1.021 2.869h3.232l1.021-2.869c.687-.198 1.342-.472 1.955-.811l2.751 1.308 2.285-2.286-1.308-2.751c.339-.613.613-1.268.811-1.955l2.869-1.02zm-12 2.384c-2.209 0-4-1.791-4-4s1.791-4 4-4 4 1.791 4 4-1.791 4-4 4z"/></svg>
          <div class="dropdown-menu">
              <a class="dropdown-item" href="#">A</a>
              <a class="dropdown-item" href="#">B</a>
              <a class="dropdown-item" href="#">C</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">D</a>
          </div>
        </div>
        </div>-->

        <button type="button" class="close" data-dismiss="modal" aria-label="<?php echo textHome[$lang]["textCancel"];?>">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="projectViewBody">

      <form id="projectViewForm" action="">
      <div class="form-group">
        <span class="titleLabel" id="projectNameView"></span><br />
        <label for="projectInfoView"><?php echo textHome[$lang]["projectInfoTitle"];?></label>
        <textarea placeholder='<?php echo textHome[$lang]["projectInfoPlaceholder"];?>' class="form-control" id="projectInfoView" rows="3"></textarea>
      </div>

      <div class="form-group row">
        <div class="col-sm-12">
          <button type="submit" class="btn btn-primary float-right"><?php echo textHome[$lang]["textSave"];?></button>
        </div>
      </div>
      </form>

      <div class="row mb-3">
          <div class="col-md-6">
            <div class="mb-2"><?php echo textHome[$lang]["projectCreatedAt"];?><span id="create"></span></div>
          </div>
          
      <div class="col-md-6 ml-auto">
              <div id="countDiv">
                <span id="remains" class="rejtett">
                <?php echo textHome[$lang]["remains"];?><span id="count"></span><?php echo textHome[$lang]["items"];?>
                </span>
                <span id="none_remains" class="rejtett">
                <?php echo textHome[$lang]["allDone"];?>
                </span>
              </div>
          </div>
        </div>

        <form id="newActivityForm">
        <div class="form-group">
        <label for="item_name" class="titleLabel"><?php echo textHome[$lang]["newActivity"];?></label>
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="<?php echo textHome[$lang]["newActivityPlaceholder"];?>" aria-label="<?php echo textHome[$lang]["newActivityPlaceholder"];?>" aria-describedby="kiegeszites" name="item_name" id="item_name">
            <div class="input-group-append" id="newActivityFormKieg">
              <span class="input-group-text" id="kiegeszites"><svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M11 11v-11h1v11h11v1h-11v11h-1v-11h-11v-1h11z"/></svg></span>
            </div>
          </div>
        </div>

        <div id="dateSettings" class="row mb-2 rejtett">
          <div class="col-md-4">
            <div class="form-group">
              <label for="startDate"><?php echo textHome[$lang]["newActivityStart"];?></label>
              <input type="date" class="form-control" id="startDate" placeholder="<?php echo textHome[$lang]["newActivityOpenCalendar"];?>" min="1901-12-13" max="2038-01-18">
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label for="deadline"><?php echo textHome[$lang]["newActivityDeadline"];?></label>
              <input type="date" class="form-control" id="deadline" placeholder="<?php echo textHome[$lang]["newActivityOpenCalendar"];?>" min="1901-12-13" max="2038-01-18">
            </div>
          </div>
        </div>
        </form>

        <div class="row">
          <div class="col-md-8">
              <h5><?php echo textHome[$lang]["todoItem"];?></h5>
              <ul id="todoList"></ul>
          </div>
          
          <div class="col-md-4 ml-auto">
              <h5><?php echo textHome[$lang]["doneItem"];?></h5>
              <ul id="doneList"></ul>
          </div>
        </div>
      </div>
      <!-- Footer helye, kiszedtem -->
    </div>
  </div>
</div>