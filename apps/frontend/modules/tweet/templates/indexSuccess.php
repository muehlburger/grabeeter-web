<table>
  <thead>
    <tr>
      <th>Tweets</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($tweets as $tweet): ?>
    <tr>
      <td><a href="<?php echo url_for('tweet_show', $tweet) ?>"><?php echo $tweet->getText() ?></a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('@tweet_new') ?>">New</a>
