<?php
/* @var $this yii\web\View */
/* @var $user frontend\models\User */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>

<h1><?php echo Html::encode($user->username); ?></h1>
<p><?php echo HtmlPurifier::process($user->about); ?></p>

<?php if ($currentUser && !$user->equals($currentUser)): ?>
  <hr/>
  <?php if (!$currentUser->isFollowing($user)): ?>
    <a href="<?php echo Url::to(['/user/profile/subscribe', 'id' => $user->getId()]); ?>" class="btn btn-info">Subscribe</a>
  <?php else: ?>
    <a href="<?php echo Url::to(['/user/profile/unsubscribe', 'id' => $user->getId()]); ?>" class="btn btn-info">Unsubscribe</a>
  <?php endif; ?>

  <?php if ($mutualSubscriptions = $currentUser->getMutualSubscriptionsTo($user)): ?>
    <hr/>
    <h5>Friends, who are also following <?php echo Html::encode($user->username); ?>: </h5>
    <div class="row">
      <?php foreach ($mutualSubscriptions as $item): ?>
        <div class="col-md-12">
          <a href="<?php echo Url::to(['/user/profiles/view/', 'nickname' => ($item['nickname']) ? $item['nickname'] : $item['id']]); ?>">
            <?php echo Html::encode($item['username']); ?>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
<?php endif; ?>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal1">
  Subscritions: <?php echo $user->countSubscriptions(); ?>
</button>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2">
  Followers: <?php echo $user->countFollowers(); ?>
</button>

<!-- Modal subscriptions -->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Subscriptions</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <?php foreach ($user->getSubscriptions() as $subscription): ?>
            <div class="col-md-12">
              <a href="<?php echo Url::to(['/user/profile/view', 'nickname' => ($subscription['nickname']) ? $subscription['nickname'] : $subscription['id']]); ?>">
                <?php echo Html::encode($subscription['username']); ?>
              </a>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal subscriptions -->

<!-- Modal followers -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Followers</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <?php foreach ($user->getFollowers() as $follower): ?>
            <div class="col-md-12">
              <a href="<?php echo Url::to(['/user/profile/view', 'nickname' => ($follower['nickname']) ? $follower['nickname'] : $follower['id']]); ?>">
                <?php echo Html::encode($follower['username']); ?>
              </a>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal followers -->
