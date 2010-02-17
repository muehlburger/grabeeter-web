<div class="entry" id="1">
	 <h3 class="storytitle"><a href="#" rel="bookmark">List of Tweets</a></h3>
<!--      <p class="date">10.02.2010</p>
	<ul class="meta nospace"><li>Category 1, Category 2</li><li>&#8212;Herbert Mühlburger <small>(10.02.2010)</small></li></ul>
	 -->
<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>User</th>
      <th>Source</th>
      <th>Geolocation</th>
      <th>In reply to user</th>
      <th>In reply to status</th>
      <th>Tweet created at</th>
      <th>Tweet twitter</th>
      <th>Text</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($tweets as $tweet): ?>
    <tr>
      <td><a href="<?php echo url_for('tweet/show?id='.$tweet->getId()) ?>"><?php echo $tweet->getId() ?></a></td>
      <td><?php echo $tweet->getUserId() ?></td>
      <td><?php echo $tweet->getSourceId() ?></td>
      <td><?php echo $tweet->getGeolocationId() ?></td>
      <td><?php echo $tweet->getInReplyToUserId() ?></td>
      <td><?php echo $tweet->getInReplyToStatusId() ?></td>
      <td><?php echo $tweet->getTweetCreatedAt() ?></td>
      <td><?php echo $tweet->getTweetTwitterId() ?></td>
      <td><?php echo $tweet->getText() ?></td>
      <td><?php echo $tweet->getCreatedAt() ?></td>
      <td><?php echo $tweet->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('tweet/new') ?>">New</a>

</div>