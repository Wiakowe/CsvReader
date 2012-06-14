<?php
namespace Wiakowe\CsvReader\Cell;

use Wiakowe\CsvReader\Row\CsvRow;
use Wiakowe\CsvReader\Column\CsvColumn;

/**
 * Content of a single CSV cell.
 *
 * @author Roger Llopart Pla <lumbendil@gmail.com>
 */
class CsvCell
{
    /**
     * @param string    $content
     */
    public function __construct($content)
    {}

    /**
     * Sets the CsvRow to which this cell belongs.
     *
     * @param CsvRow $row
     */
    public function setRow(CsvRow $row)
    {}

    /**
     * Sets the CsvColumn to which this cell belongs.
     *
     * @param CsvColumn $column
     */
    public function setColumn(CsvColumn $column)
    {}

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
