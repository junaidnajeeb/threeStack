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

class ThreeStack {

	private $main_array;
	private $stack_size;
	private $s1_head;
	private $s2_head;
	private $s3_head;

	public function __construct($data = 3) {

		if (empty($data)) {
			$data = 3;
		} else if (!is_numeric($data)) {
			throw new Exception('invalid number sent');
		}

		if ($data > 2) {
			$input_size = ceil($data / 3.0) * 3;
		} else {
			$input_size = 3;
		}

		$this->main_array = array_pad(array(), $input_size, NULL);

		$this->stack_size = $input_size / 3;
		$this->s1_head = 0;
		$this->s2_head = $this->stack_size;
		$this->s3_head = $this->stack_size * 2;
	}

	public function push($stack_number, $value) {

		if (!is_numeric($stack_number)) {
			throw new Exception('invalid stack number sent');
		}

		if ($stack_number == 1) {

			if ($this->s1_head + 1 > $this->stack_size) {
				throw new Exception('Stack 1 full');
			}
			$this->main_array[$this->s1_head] = $value;
			$this->s1_head++;
		} else if ($stack_number == 2) {

			if ($this->s2_head + 1 > $this->stack_size * 2) {
				throw new Exception('Stack 2 full');
			}

			$this->main_array[$this->s2_head] = $value;
			$this->s2_head++;
		} else if ($stack_number == 3) {

			if ($this->s3_head + 1 > $this->stack_size * 3) {
				throw new Exception('Stack 3 full');
			}
			$this->main_array[$this->s3_head] = $value;
			$this->s3_head++;
		} else {
			throw new Exception('Invalid stack');
		}
	}

	public function peak($stack_number) {

		if (!is_numeric($stack_number)) {
			throw new Exception('invalid stack number sent');
		}

		if ($stack_number == 1) {
			if ($this->s1_head == 0) {
				return null;
			}
			return $this->main_array[$this->s1_head - 1];
		} else if ($stack_number == 2) {
			if ($this->s2_head == $this->stack_size) {
				return null;
			}
			return $this->main_array[$this->s2_head - 1];
		} else if ($stack_number == 3) {
			if ($this->s3_head == 0) {
				return null;
			}
			return $this->main_array[$this->s3_head - 1];
		} else {
			throw new Exception('Invalid stack');
		}
	}

	public function pop($stack_number) {

		if (!is_numeric($stack_number)) {
			throw new Exception('invalid stack number sent');
		}

		if ($stack_number == 1) {
			if ($this->s1_head == 0 || $this->s1_head - 1 < 0) {
				return null;
			}
			$item = $this->main_array[$this->s1_head - 1];
			$this->main_array[$this->s1_head - 1] = NULL;
			$this->s1_head--;
			return $item;
		} else if ($stack_number == 2) {
			if ($this->s2_head == $this->stack_size || $this->s2_head - 1 < $this->stack_size) {
				return null;
			}
			$item = $this->main_array[$this->s2_head - 1];
			$this->main_array[$this->s2_head - 1] = NULL;
			$this->s2_head--;
			return $item;
		} else if ($stack_number == 3) {
			if ($this->s3_head == $this->stack_size * 2 || $this->s3_head - 1 < $this->stack_size * 2) {
				return null;
			}
			$item = $this->main_array[$this->s3_head - 1];
			$this->main_array[$this->s3_head - 1] = NULL;
			$this->s3_head--;
			return $item;
		} else {
			throw new Exception('Invalid stack');
		}
	}

	public function getStackSize() {
		return $this->stack_size;
	}

	// this function is to be used by the Unit Test to test other functions
	public function getMainArray() {
		return $this->main_array;
	}

}
