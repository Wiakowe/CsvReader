<?php
namespace Wiakowe\Tests\CsvReader\Cell;

use Wiakowe\CsvReader\Cell\CsvCell;
/**
 * Created by JetBrains PhpStorm.
 * User: lumbendil
 * Date: 6/14/12
 * Time: 5:00 PM
 * To change this template use File | Settings | File Templates.
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

    public function testCellWithContentIsntEmpty()
    {
        $content = 'Cell with content';

        $cell = new CsvCell($content);

        $this->assertFalse($cell->isEmpty(),
            'The cell shouldn\'t be empty.');

        $this->assertInternalType('string', $cell->getContent(),
            'The content should always be an string.');

        $this->assertSame((string) $content, $cell->getContent(),
            'The contents of the cell should be the ones given to it, ' .
                'converted to string.');
    }

    public function testCellWithSetColumnReturnsIt()
    {
        $this->markTestIncomplete();
    }

    public function testCellWithSetRowReturnsIt()
    {
        $this->markTestIncomplete();
    }
}
