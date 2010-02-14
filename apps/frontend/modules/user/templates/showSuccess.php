<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $twitter_user->getId() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $twitter_user->getName() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $twitter_user->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $twitter_user->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('user/edit?id='.$twitter_user->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('user/index') ?>">List</a>
