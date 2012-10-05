<?php
namespace Wiakowe\CsvReader\File;

use Wiakowe\CsvReader\Header\CsvHeaderCell;
use Wiakowe\CsvReader\Header\CsvHeader;
use Wiakowe\CsvReader\Row\CsvRow;
use Wiakowe\CsvReader\Column\CsvColumn;
use Wiakowe\CsvReader\Cell\CsvCell;
use Wiakowe\CsvReader\Exception\CellNotFoundException;
use Wiakowe\CsvReader\Exception\RowNotFoundException;
use Wiakowe\CsvReader\Exception\ColumnNotFoundException;

/**
 * Class which abstracts the access to a csv file.
 */
class CsvFile
{
    protected $rows    = array();
    protected $columns = array();
    protected $headers = null;

    /**
     * Opens the file for reading and processes it.
     *
     * @param string|resource $inputFile
     * @param bool $hasHeaders If set to true, the headers are assumed to be on
     * the first row. Otherwise, the first row is considered a data row as well.
     * @param string $delimiter
     * @param string $enclosure
     * @param string $escape
     */
    public function __construct($inputFile, $hasHeaders = true,
                                $delimiter = ',', $enclosure = '"',
                                $escape = '\\')
    {
        $fopenByConstructor = false;

        if (is_string($inputFile)) {
            $fopenByConstructor = true;

            $inputFile = fopen($inputFile, 'r');
        }


        if ($hasHeaders) {
            $headerData = fgetcsv(
                $inputFile, null, $delimiter, $enclosure, $escape
            );
        }

        $columnsCells = $this->parseRowData(
            $inputFile, $delimiter, $enclosure, $escape
        );

        if ($fopenByConstructor) {
            fclose($inputFile);
        }

        $columnPosition = 1;
        $headerCells  = array();

        foreach ($columnsCells as $position => $columnData) {
            $columnData = array_filter(
                $columnData,
                function(CsvCell $cell) {
                    return !is_null($cell->getCsvRow());
                }
            );

            $column = new CsvColumn($columnPosition, $columnData);

            if ($hasHeaders) {
                $headerCell = new CsvHeaderCell(
                    $headerData[$position], $column
                );

                $headerCells[] = $headerCell;
                $column->setHeaderCell($headerCell);
            }

            $this->columns[$columnPosition] = $column;

            $columnPosition++;
        }

        if ($hasHeaders) {
            $this->headers = new CsvHeader($headerCells);
        }
    }

    /**
     * Obtains the row data, and returns the columnCells to be able to create
     * the columns easily afterwards.
     *
     * @param $inputFile
     * @param $delimiter
     * @param $enclosure
     * @param $escape
     * 
     * @return array
     */
    protected function parseRowData($inputFile, $delimiter, $enclosure, $escape)
    {
        $rowPosition = 1;
        $columnsCells = array();

        while (($rowData =
            fgetcsv($inputFile, null, $delimiter, $enclosure, $escape))
            !== false) {

            $rowCells = array();

            foreach ($rowData as $position => $cellData) {
                $cell = new CsvCell($cellData);

                $columnsCells[$position][] = $cell;
                $rowCells[] = $cell;
            }

            $emptyCellFunction = function(CsvCell $cell) {
                return !$cell->isEmpty();
            };

            if (!array_filter($rowCells, $emptyCellFunction)) {
                continue;
            }

            $this->rows[$rowPosition] = new CsvRow($rowPosition, $rowCells);

            $rowPosition++;
        }
        return $columnsCells;
    }

    /**
     * Tells the user if the file has headers.
     *
     * @return boolean
     */
    public function hasHeader()
    {
        return !is_null($this->headers);
    }

    /**
     * The headers of the file, or null if there are none.
     *
     * @return \Wiakowe\CsvReader\Header\CsvHeader
     */
    public function getHeader()
    {
        return $this->headers;
    }

    /**
     * The total of rows.
     *
     * @return integer
     */
    public function totalRows()
    {
        return count($this->rows);
    }

    /**
     * The total of columns.
     *
     * @return integer
     */
    public function totalColumns()
    {
        return count($this->columns);
    }

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
    {
        if (!array_key_exists($row, $this->rows)) {
            throw new RowNotFoundException;
        }

        return $this->rows[$row];
    }

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
    {
        $method = 'getColumnPosition';
        if ($column instanceof CsvHeaderCell) {
            $method = 'getHeaderCell';
        }

        $resultColumns = array_filter(
            $this->columns,
            function($iteratedColumn) use ($column, $method) {
                return $iteratedColumn->$method() === $column;
            }
        );

        if (!count($resultColumns)) {
            throw new ColumnNotFoundException;
        }

        return array_pop($resultColumns);
    }

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
    {
        try {
            return $this->getRow($row)->getCell($column);
        } catch (RowNotFoundException $e) {
            throw new CellNotFoundException(null, 0, $e);
        }
    }

    /**
     * An iterator which contains the rows.
     *
     * @return \Traversable
     */
    public function getRowIterator()
    {
        return $this->rows;
    }
}
