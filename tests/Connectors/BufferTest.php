<?php

namespace Posprint\Tests\Connectors;

/**
 * Unit Tests for Buffer connector Class
 * 
 * @author Roberto L. Machado <linux dot rlm at gmail dot com>
 */

use Posprint\Connectors\Buffer;

class BufferTest extends \PHPUnit_Framework_TestCase
{
    public function testInstantiable()
    {
        $buffer = new Buffer();
        $this->assertInstanceOf(Buffer::class, $buffer);
    }
    
    /**
     * @depends testInstantiable
     */
    public function testWrite()
    {
        $buffer = new Buffer();
        $data = "1234567890ASDFG";
        $buffer->write($data);
        $response = $buffer->getDataBinary(true);
        $expected = array($data);
        $this->assertEquals($response, $expected);
    }
    
    /**
     * @depends testInstantiable
     */
    public function testGetDataJson()
    {
        $buffer = new Buffer();
        $data = "1234567890ASDFG";
        $buffer->write($data);
        $response = $buffer->getDataJson(true);
        $expected = json_encode(array($data));
        $this->assertEquals($response, $expected);
    }
    
    /**
     * @depends testInstantiable
     */
    public function testGetDataBase64()
    {
        $buffer = new Buffer();
        $data = "1234567890ASDFG";
        $buffer->write($data);
        $response = $buffer->getDataBase64(false);
        $expected = base64_encode($data);
        $this->assertEquals($response, $expected);
    }
    
    /**
     * @depends testInstantiable
     * @covers Posprint\Connectors\Buffer::getDataReadable
     * @covers Posprint\Connectors\Buffer::friendlyBinary
     */
    public function testGetDataReadable()
    {
        $buffer = new Buffer();
        $data = "123".chr(10)."45678".chr(8)."90A".chr(0)."SDFG";
        $buffer->write($data);
        $response = $buffer->getDataReadable(false);
        $expected = '123 [LF] 45678\x0890A [NUL] SDFG';
        $this->assertEquals($response, $expected);
    }
}
