<?php
namespace Spl;

use ArrayIterator,
StdClass;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2012-07-16 at 15:34:14.
 */
class HashSetTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var HashSet
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new HashSet;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
    }

    /**
     * @covers Spl\HashSet::add
     */
    public function testAdd() {
        $this->object->add(new StdClass());
        $this->assertCount(1, $this->object);

        $item2 = new StdClass();
        $this->object->add($item2);
        $this->assertCount(2, $this->object);

        $this->object->add($item2);
        $this->assertCount(2, $this->object);
    }

    /**
     * @covers Spl\HashSet::addAll
     */
    public function testAddAll() {
        $items = array(0, '0', 1, 'one', new StdClass, fopen(__FILE__, 'r'), array());

        $this->object->addAll(new ArrayIterator($items));
        $this->assertCount(count($items) - 1, $this->object);
    }

    /**
     * @covers Spl\HashSet::remove
     * @depends testAdd
     */
    public function testRemove() {
        $item = new StdClass();
        $this->object->add($item);
        $this->object->remove($item);

        $this->assertCount(0, $this->object);

        $item2 = new StdClass();
        $this->object->add($item);
        $this->object->add($item2);
        $this->object->remove($item);

        $this->assertCount(1, $this->object);
    }

    /**
     * @covers Spl\HashSet::removeAll
     */
    public function testRemoveAll() {
        $items = array(0, 1, 'one', new StdClass, fopen(__FILE__, 'r'), array());
        $this->object->addAll(new ArrayIterator($items));

        $removeItems = array('0', 'one');
        $this->object->removeAll(new ArrayIterator($removeItems));

        $this->assertCount(count($items) - 2, $this->object);
    }

    /**
     * @covers Spl\HashSet::retainAll
     */
    public function testRetainAll() {
        $items = array(0, 1, 'one', new StdClass, fopen(__FILE__, 'r'), array());
        $this->object->addAll(new ArrayIterator($items));

        $retainItems = array('0', 'one');
        $this->object->retainAll(new ArrayIterator($retainItems));

        $this->assertCount(2, $this->object);
    }

    /**
     * @covers Spl\HashSet::current
     * @covers Spl\HashSet::key
     * @covers Spl\HashSet::next
     * @covers Spl\HashSet::valid
     * @covers Spl\HashSet::rewind
     * @depends testAdd
     */
    public function testIterator() {
        $key = $this->object->key();
        $current = $this->object->current();

        $this->assertNull($key);
        $this->assertFalse($current);

        $this->object->next();

        $this->assertNull($key);
        $this->assertFalse($current);

        $this->object->rewind();

        $item = new StdClass;
        $this->object->add($item);

        $key = $this->object->key();
        $current = $this->object->current();

        $this->assertNotEquals('', $key);
        $this->assertEquals($item, $current);

        $this->object->next();
        $key = $this->object->key();
        $current = $this->object->current();

        $this->assertNull($key);
        $this->assertFalse($current);
    }

    /**
     * @covers Spl\HashSet::clear
     * @depends testAdd
     */
    public function testClear() {
        $this->object->add(0);
        $this->object->clear();

        $this->assertCount(0, $this->object);
    }

    /**
     * @covers Spl\HashSet::contains
     * @depends testAdd
     */
    public function testContains() {
        $scalar = 0;
        $this->assertFalse($this->object->contains($scalar));
        $this->object->add($scalar);
        $this->assertTrue($this->object->contains($scalar));
        $this->assertTrue($this->object->contains('0'));

        $object = new StdClass();
        $this->assertFalse($this->object->contains($object));
        $this->object->add($object);
        $this->assertTrue($this->object->contains($object));

        $resource = fopen(__FILE__, 'r');
        $this->assertFalse($this->object->contains($resource));
        $this->object->add($resource);
        $this->assertTrue($this->object->contains($resource));
        fclose($resource);

        $emptyArray = array();
        $this->assertFalse($this->object->contains($emptyArray));
        $this->object->add($emptyArray);
        $this->assertTrue($this->object->contains($emptyArray));

        $array = array(0, 1);
        $this->assertFalse($this->object->contains($array));
        $this->object->add($array);
        $this->assertTrue($this->object->contains($array));

    }

    /**
     * @covers Spl\HashSet::isEmpty
     * @depends testAdd
     */
    public function testIsEmpty() {
        $this->assertTrue($this->object->isEmpty());

        $this->object->add(0);
        $this->assertFalse($this->object->isEmpty());
    }

}
