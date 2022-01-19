<?php
  # Multistep form inherit settings
  $form = get_field("multistep_form");

  # Fill in data
  $json = json_encode(array('data' => $form));
  file_put_contents("wp-content/themes/" . get_current_theme() . "/js/multistep-form/multistep-settings.json", $json);
?>

<div id="multistep"></div>
