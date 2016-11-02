<?php ob_start(); ?>
<div class="window [%%classes%%]" style="[%%style%%]">
  <div class="handle">
    <span class="icon">
      <i class="fa fa-[%%icon%%]" aria-hidden="true"></i>
    </span>
    <span class="title">[%%title%%]</span>
    <span class="controls">
      <i class="min fa fa-minus-circle" aria-hidden="true"></i>
      <i class="max fa fa-plus-circle" aria-hidden="true"></i>
      <i class="close fa fa-times-circle" aria-hidden="true"></i>
    </span>
  </div>

  <div class="content">
    [%%content%%]
  </div>
</div>
<?php $window_template = ob_get_clean(); ?>

<?php
function win($content, $title, $icon = null, $classes = null, $style = null) {
  global $window_template;

  if (!$icon) { $icon = "file-text-o"; }

  $style = array_to_css($style);

  echo strtr($window_template, array(
    '[%%content%%]'  => $content,
    '[%%title%%]'    => $title,
    '[%%icon%%]'     => $icon,
    '[%%style%%]'    => $style,
    '[%%classes%%]'  => $classes
  ));
}

function array_to_css($array) {
  if (!is_array($array) || !count($array)) { return ""; }
  $css = "";
  foreach ((array) $array as $property => $style) {
  	$css .= "$property:$style;";
  }
  return $css;
}
?>
