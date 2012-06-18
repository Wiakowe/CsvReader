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

    public function testGetName()
    {
        $this->assertSame('Name1', $this->csvHeaderCell->getName(),
            'The name isn\'t the same as the set one.');
    }

    public function testGetColumn()
    {
        $this->assertSame($this->csvColumn, $this->csvHeaderCell->getColumn(),
            'The column isn\'t the same as the set one.');
    }
}