--TEST--
copy method with finally
--SKIPIF--
<?php
	if(!extension_loaded("runkit7") || !RUNKIT7_FEATURE_MANIPULATION) print "skip";
?>
--FILE--
<?php

class Test {

	function foo() {
		try {

		} finally {
		}
		echo "test\n";
	}
}

runkit7_method_copy("Test", "bar", "Test", "foo");
runkit7_method_remove("Test", "foo");

$o = new Test;
$o->bar();

?>
--EXPECTF--
test
