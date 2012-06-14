<?php
namespace Wiakowe\CsvReader\Cell;

/**
 * Content of a single CSV cell.
 *
 * @author Roger Llopart Pla <lumbendil@gmail.com>
 */
class CsvCell
{
    /**
     * Gets the CSV Row at which this cell belongs.
     *
     * @return \Wiakowe\CsvReader\Row\CsvRow
     */
    public function getCsvRow()
    {}

    /**
     * Gets the CSV Column at which this cell belongs.
     *
     * @return \Wiakowe\CsvReader\Column\CsvColumn
     */
    public function getCsvColumn()
    {}

    /**
     * Returns true if this cell content is completely empty, false otherwise.
     *
     * @return boolean
     */
    public function isEmpty()
    {}

    /**
     * Returns the content of the cell, as an string.
     *
     * @return string
     */
    public function getContent()
    {}
}
