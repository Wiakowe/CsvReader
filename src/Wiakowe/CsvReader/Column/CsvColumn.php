<?php
namespace Wiakowe\CsvReader\Column;

use Wiakowe\CsvReader\Header\CsvHeaderCell;
use Wiakowe\CsvReader\Exception\CellNotFoundException;

/**
 * Column of a CSV file.
 *
 * @author Roger Llopart Pla <lumbendil@gmail.com>
 */
class CsvColumn
{
    protected $position;
    protected $cells;
    protected $headerCell;

    /**
     * @param integer                           $position
     * @param \Wiakowe\CsvReader\Cell\CsvCell[] $csvCells
     */
    public function __construct($position, array $csvCells)
    {
        foreach ($csvCells as $cell) {
            $cell->setColumn($this);
        }

        $this->cells    = $csvCells;
        $this->position = $position;
    }

    /**
     * @param CsvHeaderCell $headerCell
     */
    public function setHeaderCell(CsvHeaderCell $headerCell)
    {
        $this->headerCell = $headerCell;
    }

    /**
     * Returns the header cell which identifies this column.
     *
     * @return \Wiakowe\CsvReader\Header\CsvHeaderCell
     */
    public function getHeaderCell()
    {
        return $this->headerCell;
    }

    /**
     * Returns true if the callable returns true for all the elements in the
     * column.
     *
     * @param string|array|\Closure $condition
     *
     * @return boolean
     */
    public function forAll($condition)
    {
        foreach ($this->cells as $cell) {
            if (!call_user_func($condition, $cell)) {
                return false;
            }
        }

        return true;
    }

    public function filter($condition)
    {
        $return = array();
        foreach ($this->cells as $cell) {
            if (call_user_func($condition, $cell)) {
                $return[] = $cell;
            }
        }

        return $return;
    }

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
    {
        foreach ($this->cells as $cell) {
            if ($cell->getCsvRow()->getRowPosition() === $row) {
                return $cell;
            }
        }

        throw new CellNotFoundException(
            'That cell doesn\'t exist in the column');
    }

    /**
     * Gets all the cells.
     *
     * @return \Wiakowe\CsvReader\Cell\CsvCell[]
     */
    public function getCells()
    {
        return $this->cells;
    }

    /**
     * Gets the column position.
     *
     * @return integer
     */
    public function getColumnPosition()
    {
        return $this->position;
    }
}
