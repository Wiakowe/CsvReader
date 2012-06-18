<?php
namespace Wiakowe\Tests\CsvReader\Cell;

use Wiakowe\CsvReader\Cell\CsvCell;
/**
 * Tests for the CsvCell class.
 */
class CsvCellTest extends \PHPUnit_Framework_TestCase
{
    public function testEmptyCellIsEmpty()
    {
        $cell = new CsvCell('');

        $this->assertTrue($cell->isEmpty(),
            'The cell should be empty.');

        $this->assertSame('', $cell->getContent(),
            'The content of an empty cell should be an empty string.');
    }

    /**
     * @dataProvider cellContentProvider
     *
     * @covers \Wiakowe\CsvReader\Cell\CsvCell::__construct
     * @covers \Wiakowe\CsvReader\Cell\CsvCell::isEmpty
     * @covers \Wiakowe\CsvReader\Cell\CsvCell::getContent
     */
    public function testCellWithContentIsntEmpty($content)
    {
        $cell = new CsvCell($content);

        $this->assertFalse($cell->isEmpty(),
            'The cell shouldn\'t be empty.');

        $this->assertInternalType('string', $cell->getContent(),
            'The content should always be an string.');

        $this->assertSame((string) $content, $cell->getContent(),
            'The contents of the cell should be the ones given to it, ' .
                'converted to string.');
    }

    /**
     * @covers \Wiakowe\CsvReader\Cell\CsvCell::setColumn
     * @covers \Wiakowe\CsvReader\Cell\CsvCell::getCsvColumn
     */
    public function testCellWithSetColumnReturnsIt()
    {
        $cell = new CsvCell('dummy content');

        $this->assertNull($cell->getCsvColumn(),
            'If the column hasn\'t been set, it should be "null".');

        $csvColumn = \Mockery::mock('Wiakowe\CsvReader\Column\CsvColumn');

        $cell->setColumn($csvColumn);

        $this->assertSame($csvColumn, $cell->getCsvColumn(),
            'The csv column should be the one that was given with "set".');
    }

    /**
     * @covers \Wiakowe\CsvReader\Cell\CsvCell::setRow
     * @covers \Wiakowe\CsvReader\Cell\CsvCell::getCsvRow
     */
    public function testCellWithSetRowReturnsIt()
    {
        $cell = new CsvCell('dummy content');

        $this->assertNull($cell->getCsvRow(),
            'If the row hasn\'t been set, it should be "null".');

        $csvRow = \Mockery::mock('Wiakowe\CsvReader\Row\CsvRow');

        $cell->setRow($csvRow);

        $this->assertSame($csvRow, $cell->getCsvRow(),
            'The csv row should be the one that was given with "set".');
    }

    public static function cellContentProvider()
    {
        return array(
            array('Content 1'),
            array('Content 2'),
            array(123)
        );
    }
}
