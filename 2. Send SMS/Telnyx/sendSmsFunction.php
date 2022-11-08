<?php
require_once __DIR__ . '/vendor/autoload.php';

$directoryName = "./uploadFile/";

function sendSms(
    string $toNumber = '',
    string $message = ''
) {
    try {
        \Telnyx\Telnyx::setApiKey('KEY0181610ABD5604C4FD96554264D6B313_y8mWQ6GGCQJeJCbDq5aVYF');

        $your_telnyx_number = '+15129578005';
        $new_message = \Telnyx\Message::Create(
            [
                'from' => $your_telnyx_number,
                'to' => $toNumber,
                'text' => $message
            ]
        );
        return $new_message;
    } catch (Exception $e) {
        return false;
    }
}

function uploadAndDeleteCsvFile(array $fileArray = [])
{
    global $directoryName;
    $b = scandir($directoryName, 1);

    $count = count($b) - 2;

    for ($x = 0; $x < $count; $x++) {

        if (!empty($b[$x])) {
            unlink($directoryName . $b[$x]);
        }
    }

    $RandomAccountNumber = uniqid();
    $upload = $RandomAccountNumber . ($fileArray['csv_file']['name']);
    $source = $fileArray['csv_file']['tmp_name'];
    $target = $directoryName . $upload;
    move_uploaded_file($source, $target);

    $b = scandir($directoryName, 1);
    $count = count($b) - 2;

    for ($x = 0; $x < $count; $x++) {

        $fileName = $b[$x];
    }
    return $directoryName . $fileName;
}

function getAllNumbers(
    string $fileName = ''
) {
    $file = fopen($fileName, "r");
    $z = 0;
    while (!feof($file)) {
        $numbers[$z] = (float) fgets($file);
        ++$z;
    }
    fclose($file);

    return $numbers;
}
