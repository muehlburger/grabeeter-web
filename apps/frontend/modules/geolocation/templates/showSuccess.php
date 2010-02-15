<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $tweet_geo_location->getId() ?></td>
    </tr>
    <tr>
      <th>Latitude:</th>
      <td><?php echo $tweet_geo_location->getLatitude() ?></td>
    </tr>
    <tr>
      <th>Longitude:</th>
      <td><?php echo $tweet_geo_location->getLongitude() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $tweet_geo_location->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $tweet_geo_location->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('geolocation/edit?id='.$tweet_geo_location->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('geolocation/index') ?>">List</a>
