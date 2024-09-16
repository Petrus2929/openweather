<?php

class ApiHandler
{
    const BASE_URL = "http://api.openweathermap.org/data/2.5/";
    /**
     * constructor
     * @param string $apiKey
     */
    public function __construct(private string $apiKey)
    {

    }

    /**
     * get forecast data by city
     * @param string $city - selected city name
     * @return null|array
     */
    public function getForecastData(string $city): ?array
    {
        try {
            $url = self::BASE_URL . "forecast?q={$city}&appid={$this->apiKey}&units=metric";
            $response = file_get_contents($url);

            //if we did not find a forecast for the selected city
            if ($response === FALSE) {
                $this->logError("Chyba: Nedokázali sme získať odpoveď z OpenWeather API pre mesto: $city.");
                return null;
            }

            $forecastData = json_decode($response, true);

            if (isset($forecastData['cod']) && $forecastData['cod'] != 200) {
                $this->logError("Chyba: API odpoveď s kódom " . $forecastData['cod'] . " - " . $forecastData['message']);
                return null;
            }
            return $forecastData;

        } catch (Exception $e) {
            $this->logError("Výnimka: " . $e->getMessage());
            return null;
        }
    }

    /**
     * return forecast data by date
     * @param array $forecastData
     * @param string $date
     * @return array
     */
    public function findForecastByDate(array $forecastData, string $date): array
    {
        $temps = [];
        $descriptions = [];

        $result = false;

        foreach ($forecastData['list'] as $forecast) {
            $forecastDate = date('Y-m-d', strtotime($forecast['dt_txt']));
            if ($forecastDate === $date) {
                $temps[] = $forecast['main']['temp'];
                $descriptions[] = $forecast['weather'][0]['description'];

                $result = true;
            }
        }

        //if we did not find a forecast for the selected day => write log
        if ($result === false) {
            $this->logError("Chyba: Nedokázali sme získať odpoveď z OpenWeather API pre deň: $date.");
        }

        return ['result' => $result, 'temps' => $temps, 'descriptions' => $descriptions];
    }

    /**
     * log errors to file
     * @param string $message - error message
     * @return void
     */
    private function logError(string $message): void
    {
        $config = require_once 'config.php';

        //path to log file from config
        $filePath = $config['log_file_path'];
        $folderName = $config['logs'];

        //check if directory exists, if not create it
        if (!is_dir($folderName)) {
            mkdir($folderName, 0777, true); //create the directory with appropriate permissions
        }

        $errorMessage = "[" . date('Y-m-d H:i:s') . "] " . $message . PHP_EOL;

        //write to log file
        file_put_contents($filePath, $errorMessage, FILE_APPEND);
    }
}
