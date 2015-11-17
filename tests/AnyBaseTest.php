<?php

use Jphblais\AnyBase\AnyBase;

class AnyBaseTest extends PHPUnit_Framework_TestCase {

    public function testIncrement() {
        $t = new AnyBase('0123456789');
        $this->assertEquals('0', "$t");
        $t->increment();
        $this->assertEquals('1', "$t");
    }

    public function testTickOver() {
        $t = new AnyBase('0123456789', '9');
        $this->assertEquals('9', "$t");
        $t->increment();
        $this->assertEquals('10', "$t");
    }

    public function testTickOverWithHexBase() {
        $t = new AnyBase('0123456789ABCDEF', 'F');
        $this->assertEquals('F', "$t");
        $t->increment();
        $this->assertEquals('10', "$t");
    }

    public function testTickOverWithCustomBase() {
        $t = new AnyBase('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', '99');
        $this->assertEquals('99', "$t");
        $t->increment();
        $this->assertEquals('BAA', "$t");
    }
}
