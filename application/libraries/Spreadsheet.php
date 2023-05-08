<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'libraries/PhpSpreadsheet/Bootstrap.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

class Spreadsheet
{
    public function __construct()
    {
        // Initialize PhpSpreadsheet library
        $this->spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    }

    public function load($filename)
    {
        // Load the spreadsheet file
        $inputFileType = IOFactory::identify($filename);
        $reader = IOFactory::createReader($inputFileType);
        $spreadsheet = $reader->load($filename);
        $this->spreadsheet = $spreadsheet;
    }

    public function getData()
    {
        // Get the data from the first worksheet
        $worksheet = $this->spreadsheet->getActiveSheet();
        $highestRow = $worksheet->getHighestRow();
        $highestColumn = $worksheet->getHighestColumn();

        $data = array();

        for ($row = 1; $row <= $highestRow; $row++) {
            $rowData = $worksheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, null, true, false);
            $data[] = $rowData[0];
        }

        return $data;
    }
}
