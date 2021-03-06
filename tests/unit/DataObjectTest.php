<?php
/*
 * This file is part of Paytrail.
 *
 * (c) 2013 Nord Software
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Codeception\Util\Stub;
use NordSoftware\Paytrail\Common\DataObject;

class DataDummy extends DataObject
{
    /**
     * @return array
     */
    public function toArray()
    {
        return array(
            'foo' => 1,
        );
    }
}

class DataObjectTest extends \Codeception\TestCase\Test
{
   /**
    * @var \CodeGuy
    */
    protected $codeGuy;

    public function testToJson()
    {
        $object = new DataDummy;
        $this->assertEquals('{"foo":1}', $object->toJson());
    }
}