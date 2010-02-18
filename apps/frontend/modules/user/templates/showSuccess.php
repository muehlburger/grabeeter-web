<?php slot('title', sprintf('%s\'s User Profile on Twitter', $tweet_user->getName()))?>
<table>
  <tbody>
    <tr>
      <th>&nbsp;</th>
      <td><img src="<?php echo $tweet_user->getProfileImageUrl() ?>" alt="<?php echo $tweet_user->getName() ?>" title="<?php echo $tweet_user->getName() ?>" /></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $tweet_user->getName() ?></td>
    </tr>
    <tr>
      <th>Screen name:</th>
      <td><?php echo $tweet_user->getScreenName() ?></td>
    </tr>
    <tr>
      <th>Twitter user:</th>
      <td><?php echo $tweet_user->getTwitterUserId() ?></td>
    </tr>
    <tr>
      <th>Description:</th>
      <td><?php echo $tweet_user->getDescription() ?></td>
    </tr>
    <tr>
      <th>Followers count:</th>
      <td><?php echo $tweet_user->getFollowersCount() ?></td>
    </tr>
    <tr>
      <th>Statuses count:</th>
      <td><?php echo $tweet_user->getStatusesCount() ?></td>
    </tr>
    <tr>
      <th>Url:</th>
      <td><?php echo $tweet_user->getUrl() ?></td>
    </tr>
    <tr>
      <th>Friends count:</th>
      <td><?php echo $tweet_user->getFriendsCount() ?></td>
    </tr>
    <tr>
      <th>Geo enabled:</th>
      <td><?php echo $tweet_user->getGeoEnabled() ?></td>
    </tr>
    <tr>
      <th>Twitter created at:</th>
      <td><?php echo $tweet_user->getTwitterCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Time zone:</th>
      <td><?php echo $tweet_user->getTimeZone() ?></td>
    </tr>
    <tr>
      <th>Location:</th>
      <td><?php echo $tweet_user->getLocation() ?></td>
    </tr>
    <tr>
      <th>Lang:</th>
      <td><?php echo $tweet_user->getLang() ?></td>
    </tr>
    <tr>
      <th>Utc offset:</th>
      <td><?php echo $tweet_user->getUtcOffset() ?></td>
    </tr>
    <tr>
      <th>Profile image url:</th>
      <td><?php echo $tweet_user->getProfileImageUrl() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $tweet_user->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $tweet_user->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('user/edit?id='.$tweet_user->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('user/index') ?>">List</a>
