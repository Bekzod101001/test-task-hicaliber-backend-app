<?php

namespace App\Services;

class CsvParserService
{
    public static function parse($filePath, callable | null $callback = null)
    {
        if(!$filePath) {
            throw new \Exception('File path is required');
        }

        if(!file_exists($filePath)) {
            throw new \Exception('File not found');
        }

        $file = fopen($filePath, "r");
        $header = fgetcsv($file); // Read the first row as header
        $rows = [];
        while (($data = fgetcsv($file, 200, ",")) !== FALSE) {
            $row = array_combine($header, $data);
            $rows[] = $row;

            if($callback) $callback($row);
        }

        fclose($file);

        return $rows;
    }
}
