<h1>Tweet sources List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Label</th>
      <th>Url</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($pager->getResults() as $tweet_source): ?>
    <tr>
      <td><a href="<?php echo url_for('source_show', $tweet_source) ?>"><?php echo $tweet_source->getId() ?></a></td>
      <td><?php echo $tweet_source->getLabel() ?></td>
      <td><?php echo $tweet_source->getUrl() ?></td>
      <td><?php echo $tweet_source->getCreatedAt() ?></td>
      <td><?php echo $tweet_source->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('source_new') ?>">New</a>
