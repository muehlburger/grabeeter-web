<h1>Tweet geo locations List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Latitude</th>
      <th>Longitude</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($tweet_geo_locations as $tweet_geo_location): ?>
    <tr>
      <td><a href="<?php echo url_for('geolocation/show?id='.$tweet_geo_location->getId()) ?>"><?php echo $tweet_geo_location->getId() ?></a></td>
      <td><?php echo $tweet_geo_location->getLatitude() ?></td>
      <td><?php echo $tweet_geo_location->getLongitude() ?></td>
      <td><?php echo $tweet_geo_location->getCreatedAt() ?></td>
      <td><?php echo $tweet_geo_location->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('geolocation/new') ?>">New</a>
