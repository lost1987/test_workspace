<?php
/**
 * Created by PhpStorm.
 * User: lost
 * Date: 14-8-15
 * Time: 下午3:51
 */

class Foo {
    public    $foo  = 1;
    protected $bar  = 2;
    private   $baz  = 3;
    static     $bs = 4;
}

$foo = new Foo();

$reflect = new ReflectionClass($foo);
$props   = $reflect->getProperties(ReflectionProperty::IS_PUBLIC & ReflectionProperty::IS_PRIVATE);

foreach ($props as $prop) {
    print $prop->getName() . chr(10);
}