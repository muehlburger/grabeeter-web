<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $tweet_source->getId() ?></td>
    </tr>
    <tr>
      <th>Label:</th>
      <td><?php echo $tweet_source->getLabel() ?></td>
    </tr>
    <tr>
      <th>Url:</th>
      <td><?php echo $tweet_source->getUrl() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $tweet_source->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $tweet_source->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('source_edit', $tweet_source) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('source') ?>">List</a>
