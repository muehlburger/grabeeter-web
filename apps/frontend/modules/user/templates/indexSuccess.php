<h1>Tweet users List</h1>

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
