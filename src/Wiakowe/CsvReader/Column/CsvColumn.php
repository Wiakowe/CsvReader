<?php
namespace Wiakowe\CsvReader\Column;

/**
 * Column of a CSV file.
 *
 * @author Roger Llopart Pla <lumbendil@gmail.com>
 */
class CsvColumn
{
    /**
     * Returns the header cell which identifies this column.
     *
     * @return \Wiakowe\CsvReader\Header\CsvHeaderCell
     */
    public function getHeaderCell()
    {}

    /**
     * Returns true if the callable returns true for all the elements in the column.
     *
     * @param string|array|\Closure $condition
     *
     * @return boolean
     */
    public function forAll($condition)
    {}

    /**
     * Returns the cell for the given row.
     *
     * @param $row
     *
     * @return \Wiakowe\CsvReader\Cell\CsvCell
     *
     * @throws \Wiakowe\CsvReader\Exception\CellNotFoundException
     */
    public function getCell($row)
    {}
}
