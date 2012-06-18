<?php
namespace Wiakowe\Tests\CsvReader\Header;

use Wiakowe\CsvReader\Header\CsvHeaderCell;

class CsvHeaderCellTest extends \PHPUnit_Framework_TestCase
{
    protected $csvHeaderCell;
    protected $csvColumn;

    public function setUp()
    {
        $this->csvColumn = \Mockery::mock(
            '\Wiakowe\CsvReader\Column\CsvColumn'
        );

        $this->csvHeaderCell = new CsvHeaderCell('Name1', $this->csvColumn);
    }

    /**
     * @covers \Wiakowe\CsvReader\Header\CsvHeaderCell::__construct
     * @covers \Wiakowe\CsvReader\Header\CsvHeaderCell::getName
     */
    public function testGetName()
    {
        $this->assertSame('Name1', $this->csvHeaderCell->getName(),
            'The name isn\'t the same as the set one.');
    }

    /**
     * @covers \Wiakowe\CsvReader\Header\CsvHeaderCell::__construct
     * @covers \Wiakowe\CsvReader\Header\CsvHeaderCell::getColumn
     */
    public function testGetColumn()
    {
        $this->assertSame($this->csvColumn, $this->csvHeaderCell->getColumn(),
            'The column isn\'t the same as the set one.');
    }
}