--TEST--
runkit7_import() Importing and overriding classes
--SKIPIF--
<?php if(!extension_loaded("runkit7") || !RUNKIT7_FEATURE_MANIPULATION) print "skip";
if (!function_exists('runkit_import')) print "skip";
?>
--FILE--
<?php

class MyTestClass {
    public static $v = "v\n";
    function foo()
    {
	    return "foo()\n";
    }
    public function myFoo()
    {
	    return "myFoo()\n";
    }
    static function myStaticFoo()
    {
	    return "myStaticFoo()\n";
    }
}

$obj = new MyTestClass;
print(MyTestClass::$v);
print($obj->foo());
print($obj->myFoo());
print(MyTestClass::myStaticFoo());
runkit7_import(dirname(__FILE__) . '/runkit_import_class.inc', RUNKIT7_IMPORT_CLASS_METHODS);
print(MyTestClass::$v);
print($obj->foo());
print($obj->myFoo());
print(MyTestClass::myStaticFoo());
runkit7_import(dirname(__FILE__) . '/runkit_import_class.inc', RUNKIT7_IMPORT_OVERRIDE | RUNKIT7_IMPORT_CLASSES);
print(MyTestClass::$v);
print($obj->foo());
print($obj->myFoo());
print(MyTestClass::myStaticFoo());
?>
--EXPECTF--
v
foo()
myFoo()
myStaticFoo()

Notice: runkit7_import(): MyTestClass::foo() already exists, not importing in %s on line %d

Notice: runkit7_import(): MyTestClass::myFoo() already exists, not importing in %s on line %d

Notice: runkit7_import(): MyTestClass::myStaticFoo() already exists, not importing in %s on line %d
v
foo()
myFoo()
myStaticFoo()
IMPORTED: v
IMPORTED: foo()
IMPORTED: myFoo()
IMPORTED: myStaticFoo()
--XFAIL--
Overriding properties in runkit_import is not supported
