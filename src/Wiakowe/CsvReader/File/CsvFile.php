<?php
namespace Wiakowe\CsvReader\File;

/**
 * Class which abstracts the access to a csv file.
 */
class CsvFile
{
    /**
     * Opens the file for reading and processes it.
     *
     * @param $inputFile
     * @param bool $hasHeaders If set to true, the headers are assumed to be on
     * the first row. Otherwise, the first row is considered a data row as well.
     *
     * @throws \Wiakowe\CsvReader\Exception\FileNotReadableException
     */
    public function __construct($inputFile, $hasHeaders = true)
    {}

    /**
     * Tells the user if the file has headers.
     *
     * @return boolean
     */
    public function hasHeader()
    {}

    /**
     * The headers of the file, or null if there are none.
     *
     * @return \Wiakowe\CsvReader\Header\CsvHeader
     */
    public function getHeader()
    {}

    /**
     * The total of rows.
     *
     * @return integer
     */
    public function totalRows()
    {}

    /**
     * The total of columns.
     *
     * @return integer
     */
    public function totalColumns()
    {}

    /**
     * Returns the row on the given position.
     *
     * @param integer $row
     *
     * @return \Wiakowe\CsvReader\Row\CsvRow
     *
     * @throws \Wiakowe\CsvReader\Exception\RowNotFoundException
     */
    public function getRow($row)
    {}

    /**
     * Returns the column on the given position.
     *
     * @param integer|\Wiakowe\CsvReader\Header\CsvHeaderCell $column
     *
     * @return \Wiakowe\CsvReader\Column\CsvColumn
     *
     * @throws \Wiakowe\CsvReader\Exception\ColumnNotFoundException
     */
    public function getColumn($column)
    {}

    /**
     * Returns the cell on the given position of row and column.
     *
     * @param integer $row
     * @param integer|\Wiakowe\CsvReader\Header\CsvHeaderCell $column
     *
     * @return \Wiakowe\CsvReader\Cell\CsvCell
     *
     * @throws \Wiakowe\CsvReader\Exception\CellNotFoundException
     */
    public function getCell($row, $column)
    {}

    /**
     * An iterator which contains the rows.
     *
     * @return \Traversable
     */
    public function getRowIterator()
    {}
}
