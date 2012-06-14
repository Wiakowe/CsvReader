<?php
namespace Wiakowe\CsvReader\Row;

/**
 * Row of data from a csv.
 */
class CsvRow
{
    /**
     * @param integer                           $position
     * @param \Wiakowe\CsvReader\Cell\CsvCell[] $csvCells
     */
    public function __construct($position, array $csvCells)
    {}

    /**
     * The row position in the CSV, starting from 1.
     */
    public function getRowPosition()
    {}

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
    {}
}
