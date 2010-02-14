<h2>Tweets List</h2>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>User</th>
      <th>Text</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($tweets as $tweet): ?>
    <tr>
      <td><a href="<?php echo url_for('tweet_show', $tweet) ?>"><?php echo $tweet->getId() ?></a></td>
      
      <td><?php echo $tweet->getUserId() ?></td>
      <td><?php echo $tweet->getText() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('tweet/new') ?>">New</a>
