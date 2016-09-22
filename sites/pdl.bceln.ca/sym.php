<?
  $target = $_SERVER["DOCUMENT_ROOT"];
  $link = $target .'/pdl';
  symlink($target, $link);
?>