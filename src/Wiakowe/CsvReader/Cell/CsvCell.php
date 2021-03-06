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
    protected $content;
    protected $row;
    protected $column;

    /**
     * @param string    $content
     */
    public function __construct($content)
    {
        $content = (string) $content;

        if (mb_detect_encoding($content) != 'UTF-8') {
            $content = iconv(mb_detect_encoding($content), 'UTF-8', $content);
        }

        $content = preg_replace('/\p{C}/u', '', $content);
        $content = preg_replace('/^\p{Z}*/u', '', $content);
        $content = preg_replace('/\p{Z}*$/u', '', $content);

        $this->content = $content;
    }

    /**
     * Sets the CsvRow to which this cell belongs.
     *
     * @param CsvRow $row
     */
    public function setRow(CsvRow $row)
    {
        $this->row = $row;
    }

    /**
     * Sets the CsvColumn to which this cell belongs.
     *
     * @param CsvColumn $column
     */
    public function setColumn(CsvColumn $column)
    {
        $this->column = $column;
    }

    /**
     * Gets the CSV Row at which this cell belongs.
     *
     * @return \Wiakowe\CsvReader\Row\CsvRow
     */
    public function getCsvRow()
    {
        return $this->row;
    }

    /**
     * Gets the CSV Column at which this cell belongs.
     *
     * @return \Wiakowe\CsvReader\Column\CsvColumn
     */
    public function getCsvColumn()
    {
        return $this->column;
    }

    /**
     * Returns true if this cell content is completely empty, false otherwise.
     *
     * @return boolean
     */
    public function isEmpty()
    {
        return '' === $this->content;
    }

    /**
     * Returns the content of the cell, as an string.
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    public function getPosition()
    {
        if (!$this->getCsvColumn() || !$this->getCsvRow()) {
            return array();
        }

        return array(
            'column' => $this->getCsvColumn()->getColumnPosition(),
            'row'    => $this->getCsvRow()->getRowPosition()
        );
    }
}
