<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $tweet->getId() ?></td>
    </tr>
    <tr>
      <th>User:</th>
      <td><?php echo $tweet->getUserId() ?></td>
    </tr>
    <tr>
      <th>Source:</th>
      <td><?php echo $tweet->getSourceId() ?></td>
    </tr>
    <tr>
      <th>Geolocation:</th>
      <td><?php echo $tweet->getGeolocationId() ?></td>
    </tr>
    <tr>
      <th>In reply to user:</th>
      <td><?php echo $tweet->getInReplyToUserId() ?></td>
    </tr>
    <tr>
      <th>In reply to status:</th>
      <td><?php echo $tweet->getInReplyToStatusId() ?></td>
    </tr>
    <tr>
      <th>Tweet created at:</th>
      <td><?php echo $tweet->getTweetCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Tweet twitter:</th>
      <td><?php echo $tweet->getTweetTwitterId() ?></td>
    </tr>
    <tr>
      <th>Text:</th>
      <td><?php echo $tweet->getText() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $tweet->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $tweet->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('tweet/edit?id='.$tweet->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('tweet/index') ?>">List</a>
