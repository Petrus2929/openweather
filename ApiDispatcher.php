<?php

require_once 'ApiHandler.php';
require_once 'ExcelGenerator.php';
require_once 'vendor/autoload.php';

class ApiDispatcher
{
    /**
     * apiHandler
     * @var ApiHandler
     */
    private $apiHandler;

    /**
     * FREE API_KEY
     * @var string
     */
    const API_KEY = 'fa71460b38c7460e4e2223a3b75bc738';

    /**
     * constructor
     * @param string $city
     * @param string $date
     */
    public function __construct(private string $city, private string $date)
    {
        $this->apiHandler = new ApiHandler(self::API_KEY);
    }

    /**
     * handle user's request, try reach forecast data and create excel file in case of success
     * @return void
     */
    public function handleRequest(): void
    {
        //get forecast data by city
        $forecastData = $this->apiHandler->getForecastData($this->city);

        if ($forecastData === null) {
            header('Location: index.php?status=error');
            exit();
        }

        //find forecast data for the selected date
        $forecastDataByDate = $this->apiHandler->findForecastByDate($forecastData, $this->date);

        if ($forecastDataByDate['result'] === false) {
            header('Location: index.php?status=error');
            exit();
        }

        //generate excel file
        $filePath = ExcelGenerator::generateExcel($this->city, $this->date, $forecastDataByDate['temps'], $forecastDataByDate['descriptions']);

        //redirect with success message
        header('Location: index.php?status=success');

    }
}

