<?php
namespace Wiakowe\CsvReader\Row;

/**
 * Row of data from a csv.
 */
class CsvRow
{
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
