--TEST--
Test protected properties
--SKIPIF--
<?php
  if (version_compare(PHP_VERSION, '5.0.0', '<')) die("skip PHP 5 or later is required");
  $dir = dirname(__FILE__).'/';
  require($dir.'test-helper.php');
  make_bytecode($dir.'a50-class.phps', $dir.'a50-class.phb');
  make_bytecode($dir.'a51-class_protvar.phpt', $dir.'a51-class_protvar.phb');
?>
--FILE--
<?php
include("a51-class_protvar.phb");
unlink(dirname(__FILE__).'/a51-class_protvar.phb');
unlink(dirname(__FILE__)."/a50-class.phb");
exit;
--CODE--
include(dirname(__FILE__)."/a50-class.phb");

$obj = new SubClass();
$obj->show();              /* a b c */
$obj->b = 15;              /* error */
$obj->show();
--EXPECTREGEX--
a=\[a\] b=\[b\] c=\[c\]

Fatal error: Cannot access protected property SubClass::\$b in .* on line 6
--CLEAN--
<?php
unlink(dirname(__FILE__).'/a51-class_protvar.phb');
unlink(dirname(__FILE__)."/a50-class.phb");
?>
