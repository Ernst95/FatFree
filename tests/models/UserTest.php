<?php

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase {

    public function testWork(): void {

        $this->assertEquals('jam', 'jams');

    }

    public function testPass(): void {

        $this->assertEquals('peanut butter', 'peanut butter');

    }

}

?>