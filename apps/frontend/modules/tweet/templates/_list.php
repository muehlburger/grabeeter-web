<table>
  <?php foreach ($tweets as $i => $tweet): ?>
    <tr class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
	  <td class="image">
        <img src="<?php echo $tweet->getTweetUser()->getProfileImageUrl() ?>" />
      </td>
    </tr>
  <?php endforeach; ?>
</table>