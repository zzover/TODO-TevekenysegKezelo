<!-- Felhasználó keresése MODAL -->
<div class="modal fade" id="searchModal" tabindex="-3" role="dialog" aria-labelledby="searchLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="searchLabel"><?php echo textHome[$lang]["searchTitle"];?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="<?php echo textHome[$lang]["textCancel"];?>">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="searchBody">
        <form id="searchForm">
        <!--div class="alert alert-info" role="alert">
        <?php echo textHome[$lang]["searchInfo"];?>
        </div-->
        <div class="form-group">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="<?php echo textHome[$lang]["searchPlaceholder"];?>" aria-label="<?php echo textHome[$lang]["searchPlaceholder"];?>" name="name" id="name">
          </div>
        </div>
        </form>

        <div id="results"></div>
      </div>
      <div class="modal-footer">
        <!-- Footer helye, kiszedtem -->
      </div>
    </div>
  </div>
</div>