<h1>Twitter users List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($twitter_users as $twitter_user): ?>
    <tr>
      <td><a href="<?php echo url_for('user/show?id='.$twitter_user->getId()) ?>"><?php echo $twitter_user->getId() ?></a></td>
      <td><?php echo $twitter_user->getName() ?></td>
      <td><?php echo $twitter_user->getCreatedAt() ?></td>
      <td><?php echo $twitter_user->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('user/new') ?>">New</a>
