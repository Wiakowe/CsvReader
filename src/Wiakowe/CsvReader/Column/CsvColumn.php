<?php
namespace Wiakowe\CsvReader\Column;

use Wiakowe\CsvReader\Header\CsvHeaderCell;

/**
 * Column of a CSV file.
 *
 * @author Roger Llopart Pla <lumbendil@gmail.com>
 */
class CsvColumn
{
    protected $cells;

    /**
     * @param \Wiakowe\CsvReader\Cell\CsvCell[] $csvCells
     */
    public function __construct(array $csvCells)
    {
        foreach($csvCells as $cell) {
            $cell->setColumn($this);
        }

        $this->cells = $csvCells;
    }

    /**
     * @param CsvHeaderCell $headerCell
     */
    public function setCsvHeaderCell(CsvHeaderCell $headerCell)
    {}

    /**
     * Returns the header cell which identifies this column.
     *
     * @return \Wiakowe\CsvReader\Header\CsvHeaderCell
     */
    public function getHeaderCell()
    {}

    /**
     * Returns true if the callable returns true for all the elements in the
     * column.
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
     * @param integer $row
     *
     * @return \Wiakowe\CsvReader\Cell\CsvCell
     *
     * @throws \Wiakowe\CsvReader\Exception\CellNotFoundException
     */
    public function getCell($row)
    {}

    /**
     * Gets all the cells.
     *
     * @return \Wiakowe\CsvReader\Cell\CsvCell[]
     */
    public function getCells()
    {
        return $this->cells;
    }
}
