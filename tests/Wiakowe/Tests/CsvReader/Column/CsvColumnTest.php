<?php
namespace Wiakowe\Tests\CsvReader\Column;

use Wiakowe\CsvReader\Column\CsvColumn;

class CsvColumnTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Mockery\MockInterface|\Wiakowe\CsvReader\Cell\CsvCell
     */
    protected $cellMock;

    /**
     * @var CsvColumn
     */
    protected $csvColumn;

    /**
     * @var \Mockery\MockInterface[]|\Wiakowe\CsvReader\Cell\CsvCell[]
     */
    protected $content;

    public function setUp()
    {
        $this->cellMock = \Mockery::mock('\Wiakowe\CsvReader\Cell\CsvCell');
        $cellMock2      = \Mockery::mock('\Wiakowe\CsvReader\Cell\CsvCell');

        $cellMock2->shouldIgnoreMissing();
        $this->cellMock->shouldIgnoreMissing();

        $this->cellMock->shouldReceive('getCsvRow->getRowPosition')
                    ->andReturn(1)->byDefault();

        $cellMock2->shouldReceive('getCsvRow->getRowPosition')
                    ->andReturn(2)->byDefault();

        $this->content = array($this->cellMock, $cellMock2);

        $this->csvColumn = new CsvColumn(1, $this->content);
    }

    /**
     * @dataProvider cellDataProvider
     *
     * @covers \Wiakowe\CsvReader\Column\CsvColumn::getCells
     */
    public function testGetAllCells(array $cellArray)
    {
        $csvColumn = new CsvColumn(1, $cellArray);

        $cellsFromGetCells = $csvColumn->getCells();

        $this->assertInternalType('array', $cellsFromGetCells,
            'The return must be an array.');

        $this->assertContainsOnly(
            'Wiakowe\CsvReader\Cell\CsvCell', $cellsFromGetCells,
            null, 'The return from must only contain CsvCells');

        foreach ($cellArray as $cell) {
            $this->assertContains($cell, $cellsFromGetCells,
                'The getCells must contain the cells that where given to it');
        }
    }

    public static function cellDataProvider()
    {
        $cell1 = \Mockery::mock('\Wiakowe\CsvReader\Cell\CsvCell');
        $cell2 = \Mockery::mock('\Wiakowe\CsvReader\Cell\CsvCell');
        $cell3 = \Mockery::mock('\Wiakowe\CsvReader\Cell\CsvCell');

        $cell1->shouldIgnoreMissing();
        $cell2->shouldIgnoreMissing();
        $cell3->shouldIgnoreMissing();

        return array(
            array(
                array(
                    $cell1,
                    $cell2,
                    $cell3
                )
            ),
            array(
                array()
            )
        );
    }

    /**
     * @covers \Wiakowe\CsvReader\Column\CsvColumn::__construct
     */
    public function testConstructor()
    {
        foreach ($this->content as $cell) {
            $cell->shouldReceive('setColumn')
                ->with(\Mockery::type('\Wiakowe\CsvReader\Column\CsvColumn'))
                ->atLeast()->once();
        }

        new CsvColumn(1, $this->content);
    }

    /**
     * @covers \Wiakowe\CsvReader\Column\CsvColumn::getCell
     */
    public function testGetCell()
    {
        $cell = $this->csvColumn->getCell(1);

        $this->assertSame($this->cellMock, $cell,
            'The cell should be returned by the call to CsvColumn::getCell()');
    }

    /**
     * @covers \Wiakowe\CsvReader\Column\CsvColumn::getCell
     * @expectedException \Wiakowe\CsvReader\Exception\CellNotFoundException
     */
    public function testGetCellWithoutExistingCell()
    {
        $cell = $this->csvColumn->getCell(5);
    }

    /**
     * @covers \Wiakowe\CsvReader\Column\CsvColumn::setHeaderCell
     * @covers \Wiakowe\CsvReader\Column\CsvColumn::getHeaderCell
     */
    public function testGetHeaderCell()
    {
        $this->assertNull($this->csvColumn->getHeaderCell(),
            'The header cell should be null if it hasn\'t been set.');

        $headerCell = \Mockery::mock('\Wiakowe\CsvReader\Header\CsvHeaderCell');

        $this->csvColumn->setHeaderCell($headerCell);

        $this->assertSame($headerCell, $this->csvColumn->getHeaderCell(),
            'The header cell should have the value of the set object.');
    }

    /**
     * @covers \Wiakowe\CsvReader\Column\CsvColumn::forAll
     */
    public function testForAll()
    {
        $this->csvColumn->forAll(function($cell) {
            $this->assertInstanceOf('\Wiakowe\CsvReader\Cell\CsvCell', $cell,
                'The cell should be an element of CsvCell.');

            return true;
        });

        $this->assertTrue($this->csvColumn->forAll(function($cell) {
                return in_array($cell->getCsvRow()->getRowPosition(),
                    array(1, 2));
            }),
            'Should be true if the condition is true for all the cells.');

        $this->assertFalse($this->csvColumn->forAll(function($cell) {
                return in_array($cell->getCsvRow()->getRowPosition(),
                    array(1));
            }),
            'Should be true if the condition is false for any cell.');
    }

    /**
     * @covers \Wiakowe\CsvReader\Column\CsvColumn::getColumnPosition
     */
    public function testGetColumnPosition()
    {
        $this->assertEquals(1, $this->csvColumn->getColumnPosition(),
            'The column position should be the one set in the position.');
    }
}
