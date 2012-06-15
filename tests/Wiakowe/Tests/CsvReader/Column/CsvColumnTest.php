<?php
namespace Wiakowe\Tests\CsvReader\Column;

use Wiakowe\CsvReader\Column\CsvColumn;

class CsvColumnTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider cellDataProvider
     */
    public function testGetAllCells(array $cellArray)
    {
        $csvColumn = new CsvColumn($cellArray);

        $cellsFromGetCells = $csvColumn->getCells();

        $this->assertInternalType('array', $cellsFromGetCells,
            'The return must be an array.');

        $this->assertContainsOnly(
            '\Wiakowe\CsvReader\Cell\CsvCell', $cellsFromGetCells,
            'The return from must only contain CsvCells');

        foreach($cellArray as $cell) {
            $this->assertContains($cell, $cellsFromGetCells,
                'The getCells must contain the cells that where given to it');
        }
    }

    public function testConstructor()
    {
        $cell = \Mockery::mock('\Wiakowe\CsvReader\Cell\CsvCell');

        $cellArray = array($cell);
        $cell->shouldReceive('setColumn')
            ->with(\Mockery::type('\Wiakowe\CsvReader\Column\CsvColumn'))
            ->atLeast()->once();

        new CsvColumn($cellArray);

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
}
