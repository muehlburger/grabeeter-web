<div class="entry" id="1">
	 <h3 class="storytitle"><a href="#" rel="bookmark">List of Users</a></h3>
<!--      <p class="date">10.02.2010</p>
	<ul class="meta nospace"><li>Category 1, Category 2</li><li>&#8212;Herbert Mühlburger <small>(10.02.2010)</small></li></ul>
	 -->
<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Screen name</th>
      <th>Twitter user</th>
      <th>Description</th>
      <th>Followers count</th>
      <th>Url</th>
      <th>Friends count</th>
      <th>Geo enabled</th>
      <th>Twitter created at</th>
      <th>Statuses Count</th>
      <th>Time zone</th>
      <th>Location</th>
      <th>Lang</th>
      <th>Utc offset</th>
      <th>Profile image url</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($tweet_users as $tweet_user): ?>
    <tr>
      <td><a href="<?php echo url_for('user/show?id='.$tweet_user->getId()) ?>"><img src="<?php echo $tweet_user->getProfileImageUrl() ?>" /></a></td>
      <td><?php echo $tweet_user->getName() ?></td>
      <td><?php echo $tweet_user->getScreenName() ?></td>
      <td><?php echo $tweet_user->getTwitterUserId() ?></td>
      <td><?php echo $tweet_user->getDescription() ?></td>
      <td><?php echo $tweet_user->getFollowersCount() ?></td>
      <td><?php echo $tweet_user->getUrl() ?></td>
      <td><?php echo $tweet_user->getFriendsCount() ?></td>
      <td><?php echo $tweet_user->getGeoEnabled() ?></td>
      <td><?php echo $tweet_user->getTwitterCreatedAt() ?></td>
      <td><?php echo $tweet_user->getStatusesCount() ?></td>
      <td><?php echo $tweet_user->getTimeZone() ?></td>
      <td><?php echo $tweet_user->getLocation() ?></td>
      <td><?php echo $tweet_user->getLang() ?></td>
      <td><?php echo $tweet_user->getUtcOffset() ?></td>
      <td><?php echo $tweet_user->getProfileImageUrl() ?></td>
      <td><?php echo $tweet_user->getCreatedAt() ?></td>
      <td><?php echo $tweet_user->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('user/new') ?>">New</a>
</div>
