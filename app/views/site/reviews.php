<?php use dergus\fw\helpers\Html; ?>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h1>Reviews</h1>

        <div class="panel-group">
            <?php foreach ($reviews as $key => $review):?>

                <div class="panel panel-info">
                    <div class="panel-heading">
                        <?= $review->name ?>
                        <span class="text-info pull-right">
                            <?= date('d.m.Y',strtotime($review->created_at)) ?>
                        </span>
                    </div>
                    <div class="panel-body"><?= Html::encode($review->msg) ?></div>
                </div>

            <?php endforeach;?>
        </div>
    </div>
    <div class="col-md-2">
        <button type="button" class="btn btn-primary addReviewBtn" data-toggle="modal" data-target="#addReview">
            Write a review
        </button>
    </div>
</div>


<!-- Modal -->
<div id="addReview" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add a review</h4>
      </div>
      <div class="modal-body">
    <div class="alert alert-success hidden js_success ">
      <strong>Added!</strong> Your review is added.
    </div>
    <div class="hidden js_fail">
        <div class="alert alert-danger">
            <strong>Errors!</strong> Fix the following errors!
        </div>
        <ul class="list-group js_errors">
          <li class="list-group-item list-group-item-danger js_errorItem"></li>
        </ul>
    </div>
      <form role="form" class="js_reviewForm">
            <div class="form-group">
              <label for="name">Name:</label>
              <input type="text" class="form-control" id="name" name="review[name]">
            </div>
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="text" class="form-control" id="email" name="review[email]">
            </div>
            <div class="form-group">
              <label for="msg">Review:</label>
              <textarea class="form-control" rows="5" id="msg" name="review[msg]"></textarea>
            </div>
            <button type="submit" class="btn btn-default pull-right">Submit</button>
            <div class="clearfix"></div>
        </form>
      </div>

    </div>

  </div>
</div>