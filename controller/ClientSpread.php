<?php

namespace Control;

class ClientSpread extends Client 
{
    private $service;

    public function __construct()
    {
        $this->service = new \Google\Service\Sheets($this->getClient());
    }


    #Read
    public function readSheet($spreadsheetId,$sheet,$range)
    {
        $params = [
            "ranges"=>$sheet."!".$range
        ];
        $result = $this->service->spreadsheets_values->batchGet($spreadsheetId,$params);
        return $result->getValueRanges()[0];
    }


    public function updateSheet($spreadsheetId,$range,$values)
    {
        $body = new \Google\Service\Sheets\ValueRange(['values' => [$values]]);
        $params = ['valueInputOption' => 'RAW'];
        $result = $this->service->spreadsheets_values->update($spreadsheetId, $range, $body, $params);  
    }

}