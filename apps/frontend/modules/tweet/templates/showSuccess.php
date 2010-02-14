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
