<?php

function getVatRate($countyCode) {
    $client = new SoapClient('https://ec.europa.eu/taxation_customs/tedb/ws/VatRetrievalService.wsdl');

    $req = [
        'memberStates' => [$countyCode],
        'situationOn' => '2023-06-08T00:00:00',
        'cpaCodes' => ['47'],
    ];

    $vatRateResults = $client->retrieveVatRates($req)->vatRateResults;

    if (!is_array($vatRateResults)) $vatRateResults = [ $vatRateResults ];

    foreach ($vatRateResults as $result) {
        if ($result->type === "STANDARD") return $result->rate->value;
    }

    return null;
} 
