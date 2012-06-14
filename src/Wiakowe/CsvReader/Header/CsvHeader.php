<?php
namespace Wiakowe\CsvReader\Header;

/**
 * A row which acts as a header.
 */
class CsvHeader
{
    /**
     * @param CsvHeaderCell[] $headerCells
     */
    public function __construct(array $headerCells)
    {}

    /**
     * The total number of headers, which should be equal to the number of rows
     * returned by <code>CsvFile::getNumRows()</code>.
     *
     * @return integer
     */
    public function getNumHeaders()
    {}

    /**
     * Gets a header by it's name.
     *
     * @param string $name
     *
     * @return CsvHeaderCell
     */
    public function getHeaderCellByName($name)
    {}

    /**
     * @param integer $position
     *
     * @return CsvHeaderCell
     */
    public function getHeaderCellByPosition($position)
    {}

    /**
     * Gets all the header cells as an array.
     *
     * @return CsvHeaderCell[]
     */
    public function getHeaderCells()
    {}
}
