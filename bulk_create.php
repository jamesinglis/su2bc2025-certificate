<?php

require __DIR__ . '/vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client();

$domain = "https://au.tm50kcertificate.org";
$filename = __DIR__ . '/resources/recipients.csv';
$filename_output = __DIR__ . '/resources/recipients_output.csv';

if (file_exists($filename)) {
    $count = 0;
    $fh = fopen($filename, "r");
    $fho = fopen($filename_output, "a+");
    while (($data = fgetcsv($fh, 2048, ",")) !== false) {
        $url = sprintf("%s/?name=%s&distance=%s&amount=%s", $domain, $data[0], $data[3], $data[2]);
        $output_data = $data;
        array_push($output_data, $url);
        echo ++$count . sprintf(". Generating certificate for %s...", $data[0]) . PHP_EOL;
//        echo $url . PHP_EOL;
        $client->get($url);
        fputcsv($fho, $output_data, ",", '"');
    }
    fclose($fh);
    fclose($fho);
}