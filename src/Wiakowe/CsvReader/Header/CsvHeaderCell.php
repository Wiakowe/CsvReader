<?php
namespace Wiakowe\CsvReader\Header;

use Wiakowe\CsvReader\Column\CsvColumn;
/**
 * A cell of the header row.
 */
class CsvHeaderCell
{
    protected $name;
    protected $column;

    /**
     * @param string    $name
     * @param CsvColumn $column
     */
    public function __construct($name, CsvColumn $column)
    {
        $this->name   = $name;
        $this->column = $column;
    }

    /**
     * Gets the name (contents) of the cell.
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Gets the column associated with this header.
     */
    public function getColumn()
    {
        return $this->column;
    }
}
