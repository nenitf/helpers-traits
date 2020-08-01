<?php

namespace Tests;

class TestCase extends \PHPUnit\Framework\TestCase {
    // THANKS: https://stackoverflow.com/a/2798203/9881278
    protected function invokeProtectedMethod(object $object, string $methodName, ?array $args = []) {
        $method = new \ReflectionMethod(get_class($object), $methodName);
        $method->setAccessible(true);
        return $method->invokeArgs($object, $args);
    }

    protected function newTrait($traitName) {
        $phpunitMock = $this->getMockForTrait($traitName);
        return new class($phpunitMock) {
            public $mockedTrait;

            public function __construct($mockedTrait){
                $this->mockedTrait = $mockedTrait;
            }

            public function __call($name, $arguments) {
                $method = new \ReflectionMethod(get_class($this->mockedTrait), $name);
                $method->setAccessible(true);
                return $method->invokeArgs($this->mockedTrait, $arguments);
            }
        };
    }
}
