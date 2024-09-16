<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExcelGenerator
{
  /**
   * generate excel file with forecast data
   * @param string $city - selected city name
   * @param string $date - selected date
   * @param array $temps - array of temperatures
   * @param array $descriptions - array of descriptions
   * @return string $filePath - file path to created excel file
   */
  public static function generateExcel(string $city, string $date, array $temps, array $descriptions): string
  {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->setCellValue('A1', 'Mesto');
    $sheet->setCellValue('B1', 'Dátum');
    $sheet->setCellValue('C1', 'Teplota');
    $sheet->setCellValue('D1', 'Počasie');

    for ($i = 0; $i < count($temps); $i++) {
      $row = $i + 2;
      $sheet->setCellValue('A' . $row, $city);
      $sheet->setCellValue('B' . $row, $date);
      $sheet->setCellValue('C' . $row, $temps[$i]);
      $sheet->setCellValue('D' . $row, $descriptions[$i]);
    }
    $sheet->setCellValue('A' . $row + 1, 'Najnižšia teplota : ');
    $sheet->setCellValue('B' . $row + 1, min($temps));
    $sheet->setCellValue('A' . $row + 2, 'Najvyššia teplota : ');
    $sheet->setCellValue('B' . $row + 2, max($temps));

    $writer = new Xlsx($spreadsheet);

    $config = require_once 'config.php';
    $filePath = $config['excel_file_path'];
    $folderName = $config['excel_folder_name'];

    //check if directory exists, if not create it
    if (!is_dir($folderName)) {
      mkdir($folderName, 0777, true); //create the directory with appropriate permissions
    }
    $writer->save($filePath);

    return $filePath;
  }
}
