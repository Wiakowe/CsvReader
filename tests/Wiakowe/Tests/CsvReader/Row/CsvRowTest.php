<?php
namespace Wiakowe\Tests\CsvReader\Row;

use Wiakowe\CsvReader\Row\CsvRow;

class CsvRowTest extends \PHPUnit_Framework_TestCase
{
    protected $cellMock;
    protected $content;
    protected $csvRow;
    protected $headerCell;

    public function setUp()
    {
        $this->cellMock = \Mockery::mock('\Wiakowe\CsvReader\Cell\CsvCell');
        $cellMock2      = \Mockery::mock('\Wiakowe\CsvReader\Cell\CsvCell');

        $this->headerCell = \Mockery::mock(
            '\Wiakowe\CsvReader\Header\CsvHeaderCell'
        );

        $this->cellMock->shouldIgnoreMissing();
        $cellMock2->shouldIgnoreMissing();


        $columnMock = \Mockery::mock('\Wiakowe\CsvReader\Column\CsvColumn')
                ->shouldReceive('getColumnPosition')
                ->andReturn(1)
            ->getMock()
                ->shouldReceive('getHeaderCell')
                ->andReturn($this->headerCell)
            ->getMock();

        $this->cellMock->shouldReceive('getCsvColumn')
            ->andReturn($columnMock);

        $this->content = array($this->cellMock, $cellMock2);

        $this->csvRow = new CsvRow(1, $this->content);
    }

    public function testConstructor()
    {
        $cell = \Mockery::mock('\Wiakowe\CsvReader\Cell\CsvCell');

        $cell->shouldReceive('setRow')
            ->with(\Mockery::type('\Wiakowe\CsvReader\Row\CsvRow'))
            ->once();

        new CsvRow(1, array($cell));
    }

    public function testGetRowPosition()
    {
        $this->assertEquals(1, $this->csvRow->getRowPosition(),
            'The row position should be equal to the one defined in the' .
                ' constructor');
    }

    public function testGetCellByColumnPosition()
    {
        $this->assertSame($this->cellMock, $this->csvRow->getCell(1),
            'The cell returned must be the one which has the column set as 1.');
    }

    public function testGetCellByColumnHeaderCell()
    {
        $this->assertSame(
            $this->cellMock,
            $this->csvRow->getCell($this->headerCell),
            'The returned cell must be the one which has it\'s header cell' .
                ' set to the one which we queried for.'
        );
    }

    /**
     * @expectedException \Wiakowe\CsvReader\Exception\CellNotFoundException
     */
    public function testGetCellByNonExistingColumnPositionThrowsException()
    {
        $this->csvRow->getCell(2);
    }


    /**
     * @expectedException \Wiakowe\CsvReader\Exception\CellNotFoundException
     */
    public function testGetCellByNonExistingColumnHeaderCellThrowsException()
    {
        $this->csvRow->getCell(\Mockery::mock(
            '\Wiakowe\CsvReader\Header\CsvHeaderCell'
        ));
    }
}
