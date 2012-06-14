<?php
namespace Wiakowe\CsvReader\Header;

use Wiakowe\CsvReader\Column\CsvColumn;
/**
 * A cell of the header row.
 */
class CsvHeaderCell
{
    /**
     * @param string    $name
     * @param CsvColumn $column
     */
    public function __construct($name, CsvColumn $column)
    {}

    /**
     * Gets the name (contents) of the cell.
     */
    public function getName()
    {}

    /**
     * Gets the column associated with this header.
     */
    public function getColumn()
    {}
}
