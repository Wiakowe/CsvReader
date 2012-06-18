<?php
namespace Wiakowe\CsvReader\Row;

use Wiakowe\CsvReader\Header\CsvHeaderCell;
use Wiakowe\CsvReader\Exception\CellNotFoundException;

/**
 * Row of data from a csv.
 */
class CsvRow
{
    protected $position;
    protected $cells;

    /**
     * @param integer                           $position
     * @param \Wiakowe\CsvReader\Cell\CsvCell[] $csvCells
     */
    public function __construct($position, array $csvCells)
    {
        $this->position = $position;

        foreach ($csvCells as $cell) {
            $cell->setRow($this);
        }

        $this->cells = $csvCells;
    }

    /**
     * The row position in the CSV, starting from 1.
     *
     * @return integer
     */
    public function getRowPosition()
    {
        return $this->position;
    }

    /**
     * Gets the cell on the given column.
     *
     * @param integer|\Wiakowe\CsvReader\Header\CsvHeaderCell $column
     *
     * @return \Wiakowe\CsvReader\Cell\CsvCell
     *
     * @throws \Wiakowe\CsvReader\Exception\CellNotFoundException
     */
    public function getCell($column)
    {
        $method = 'getColumnPosition';
        if ($column instanceof CsvHeaderCell) {
            $method = 'getHeaderCell';
        }

        $resultCells = array_filter(
            $this->cells,
            function($cell) use ($column, $method) {
                return $cell->getCsvColumn()->$method() === $column;
            }
        );

        if (!count($resultCells)) {
            throw new CellNotFoundException;
        }

        return array_pop($resultCells);
    }
}
