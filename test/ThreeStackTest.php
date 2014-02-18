<?php

/*
  Copyright (c) 2013, Junaid Najeeb All rights reserved.

  Redistribution and use in source and binary forms, with or
  without modification, are permitted provided that the following
  conditions are met:

 * Redistributions of source code must retain the above copyright
  notice, this list of conditions and the following disclaimer.

 * Redistributions in binary form must reproduce the above
  copyright notice, this list of conditions and the following
  disclaimer in the documentation and/or other materials provided
  with the distribution.

 * Neither the name of the origanization nor the names of its
  contributors may be used to endorse or promote products derived
  from this software without specific prior written permission.

  THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND
  CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES,
  INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES
  OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
  ARE DISCLAIMED.  IN NO EVENT SHALL THE COPYRIGHT HOLDER OR
  CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
  SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
  LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
  LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
  CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT,
  STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
  ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF
  ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */

require_once(dirname(__FILE__) . '/../library/ThreeStack.php');

/**
 * @author Junaid Najeeb
 * @link https://github.com/junaidnajeeb/threeStack
 */
class ThreeStackTest extends PHPUnit_Framework_TestCase {
	/*	 * **************************** __construct ********************************** */

	/**
	 * @expectedException Exception
	 */
	public function testInvalidStackConstructException() {

		try {
			$stack_obj = new threeStack('random');
		} catch (InvalidArgumentException $expected) {
			return;
		}

		$this->fail('InvalidStackConstructException exception has not been raised.');
	}

	public function testStackCreationWithNoData() {
		$stack_obj = new threeStack();
		$this->assertEquals(1, $stack_obj->getStackSize());
	}

	public function test__construct() {
		$stack_obj = new threeStack(9);
		$this->assertInstanceOf('ThreeStack', $stack_obj);
	}

	public function testGetStackSize() {
		$stack_obj = new threeStack(9);
		$this->assertEquals(3, $stack_obj->getStackSize());

		$stack_obj = new threeStack(30);
		$this->assertEquals(10, $stack_obj->getStackSize());

		$stack_obj = new threeStack(1);
		$this->assertEquals(1, $stack_obj->getStackSize());

		$stack_obj = new threeStack(4); // 4 will fall to size 6 (next higher multiple of 3)
		$this->assertEquals(2, $stack_obj->getStackSize());
	}

	/*	 * **************************** P U S H ********************************** */

	/**
	 * @expectedException Exception
	 */
	public function testInvalidStackPushException() {


		try {
			$stack_obj = new threeStack(9);
			$stack_obj->push(4, 'a');
		} catch (InvalidArgumentException $expected) {
			return;
		}

		$this->fail('InvalidStackPushException exception has not been raised.');
	}

	/**
	 * @expectedException Exception
	 */
	public function testPushInvalidStackNumberException() {


		try {
			$stack_obj = new threeStack(9);
			$stack_obj->push('invalid number', 'a');
		} catch (InvalidArgumentException $expected) {
			return;
		}

		$this->fail('PushInvalidStackNumberException exception has not been raised.');
	}

	/**
	 * @expectedException Exception
	 */
	public function testStackFullException() {


		try {
			$stack_obj = new threeStack(9);
			$stack_obj->push(1, 'a');
			$stack_obj->push(1, 'b');
			$stack_obj->push(1, 'c');
			$stack_obj->push(1, 'd');
		} catch (InvalidArgumentException $expected) {
			return;
		}

		$this->fail('StackFullException exception has not been raised.');
	}

	public function testPush() {
		$stack_obj = new threeStack(9);

		$stack_obj->push(1, 'a');
		$stack_obj->push(1, 'b');

		$stack_obj->push(2, 'x');
		$stack_obj->push(2, 'y');
		$stack_obj->push(2, 'z');

		$stack_obj->push(3, 'p');

		$main_array = $stack_obj->getMainArray();

		$this->assertEquals('a', $main_array[0]);
		$this->assertEquals('b', $main_array[1]);

		$this->assertEquals('x', $main_array[3]);
		$this->assertEquals('y', $main_array[4]);
		$this->assertEquals('z', $main_array[5]);

		$this->assertEquals('p', $main_array[6]);
	}

	/*	 * **************************** P E A K ********************************** */

	/**
	 * @expectedException Exception
	 */
	public function testInvalidStackPeakException() {


		try {
			$stack_obj = new threeStack(9);
			$stack_obj->peak(4);
		} catch (InvalidArgumentException $expected) {
			return;
		}

		$this->fail('InvalidStackPeakException exception has not been raised.');
	}

	/**
	 * @expectedException Exception
	 */
	public function testPeakInvalidStackNumberException() {


		try {
			$stack_obj = new threeStack(9);
			$stack_obj->peak('invalid number');
		} catch (InvalidArgumentException $expected) {
			return;
		}

		$this->fail('PeakInvalidStackNumberException exception has not been raised.');
	}

	public function testPeak() {
		$stack_obj = new threeStack(30);

		$stack_obj->push(1, 'a');
		$result = $stack_obj->peak(1);
		$this->assertEquals('a', $result);

		$stack_obj->push(1, 'b');
		$result = $stack_obj->peak(1);
		$this->assertEquals('b', $result);


		$stack_obj->push(2, 'x');
		$result = $stack_obj->peak(2);
		$this->assertEquals('x', $result);


		$stack_obj->push(3, 'j');
		$result = $stack_obj->peak(3);
		$this->assertEquals('j', $result);

		$stack_obj->push(3, 3322);
		$result = $stack_obj->peak(3);
		$this->assertEquals(3322, $result);

		$result = $stack_obj->peak(1);
		$this->assertNotEquals(122, $result);

		$result = $stack_obj->peak(2);
		$this->assertNotEquals(122, $result);

		$result = $stack_obj->peak(3);
		$this->assertNotEquals(123, $result);
	}

	/*	 * **************************** P O P ********************************** */

	/**
	 * @expectedException Exception
	 */
	public function testInvalidStackPopException() {


		try {
			$stack_obj = new threeStack(9);
			$stack_obj->pop(4);
		} catch (InvalidArgumentException $expected) {
			return;
		}

		$this->fail('InvalidStackPopException exception has not been raised.');
	}

	/**
	 * @expectedException Exception
	 */
	public function testPopInvalidStackNumberException() {


		try {
			$stack_obj = new threeStack(9);
			$stack_obj->pop('invalid number');
		} catch (InvalidArgumentException $expected) {
			return;
		}

		$this->fail('PopInvalidStackNumberException exception has not been raised.');
	}

	public function testPop() {
		$stack_obj = new threeStack(23);

		$stack_obj->push(1, 'a');
		$result = $stack_obj->pop(1);
		$this->assertEquals('a', $result);

		$stack_obj->push(2, 'b');
		$result = $stack_obj->pop(2);
		$this->assertEquals('b', $result);

		$stack_obj->push(3, 'c');
		$result = $stack_obj->pop(3);
		$this->assertEquals('c', $result);


		$stack_obj->push(1, 'a');
		$stack_obj->push(1, 'b');
		$stack_obj->push(1, 'c');

		$result = $stack_obj->pop(1);
		$this->assertEquals('c', $result);
		$result = $stack_obj->pop(1);
		$this->assertEquals('b', $result);
		$result = $stack_obj->pop(1);
		$this->assertEquals('a', $result);

		$result = $stack_obj->pop(1);
		$this->assertNull($result);
	}

}
