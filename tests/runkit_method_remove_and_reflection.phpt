--TEST--
runkit7_method_remove() function with reflection
--SKIPIF--
<?php if(!extension_loaded("runkit7") || !RUNKIT7_FEATURE_MANIPULATION) print "skip"; ?>
--FILE--
<?php
class RunkitClass {
	function runkitMethod(RunkitClass $param) {
		echo "Runkit Method\n";
	}
}

$obj = new RunkitClass();

$reflClass = new ReflectionClass('RunkitClass');
$reflObject = new ReflectionObject($obj);
$reflMethod = new ReflectionMethod('RunkitClass', 'runkitMethod');

runkit7_method_remove('RunkitClass','runkitMethod');

try {
	var_dump($reflClass->getMethod('runkitMethod'));
	echo 'No exception!';
} catch (ReflectionException $e) {
}

try {
	var_dump($reflObject->getMethod('runkitMethod'));
	echo 'No exception!';
} catch (ReflectionException $e) {
}
var_dump($reflMethod);
$reflMethod->invoke($obj);
?>
--EXPECTF--
object(ReflectionMethod)#%d (2) {
  ["name"]=>
  string(28) "__method_removed_by_runkit__"
  ["class"]=>
  string(11) "RunkitClass"
}

Fatal error: RunkitClass::__method_removed_by_runkit__(): A method removed by runkit7 was somehow invoked in %s on line %d
