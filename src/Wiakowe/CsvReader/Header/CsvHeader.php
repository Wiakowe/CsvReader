<?php
namespace Wiakowe\CsvReader\Header;

use Wiakowe\CsvReader\Exception\CellNotFoundException;

/**
 * A row which acts as a header.
 */
class CsvHeader
{
    protected $cells;

    /**
     * @param CsvHeaderCell[] $headerCells
     */
    public function __construct(array $headerCells)
    {
        $this->cells = $headerCells;
    }

    /**
     * The total number of headers, which should be equal to the number of
     * columns returned by <code>CsvFile::totalColumns()</code>.
     *
     * @return integer
     */
    public function getNumHeaders()
    {
        return count($this->cells);
    }

    /**
     * Gets a header by it's name.
     *
     * @param string $name
     *
     * @return CsvHeaderCell
     *
     * @throws \Wiakowe\CsvReader\Exception\CellNotFoundException
     */
    public function getHeaderCellByName($name)
    {
        foreach ($this->cells as $cell) {
            if ($cell->getName() === $name) {
                return $cell;
            }
        }

        throw new CellNotFoundException;
    }

    /**
     * @param integer $position
     *
     * @return CsvHeaderCell
     *
     * @throws \Wiakowe\CsvReader\Exception\CellNotFoundException
     */
    public function getHeaderCellByPosition($position)
    {

        foreach ($this->cells as $cell) {
            if ($cell->getColumn()->getColumnPosition() === $position) {
                return $cell;
            }
        }

        throw new CellNotFoundException;
    }

    /**
     * Gets all the header cells as an array.
     *
     * @return CsvHeaderCell[]
     */
    public function getHeaderCells()
    {
        return $this->cells;
    }
}
