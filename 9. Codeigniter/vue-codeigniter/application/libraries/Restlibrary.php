<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RestLibrary
{
    protected $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
        $this->ci->load->helper('constants');
    }

    public function settingUpHeaders()
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS, post, get, put, delete');
        header("Access-Control-Max-Age", "3600");
        header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
        header("Access-Control-Allow-Credentials", "true");
    }

    // validating type of content request
    public function validatingAcceptHeader($dataType)
    {
        if (isset($_SERVER['HTTP_ACCEPT']) && $_SERVER['HTTP_ACCEPT'] != $dataType) {
            $this->responseStatus(
                true,
                REQUEST_SUCCESS,
                'Accept content type should by application/json'
            );
        }
    }

    // return error if input not found
    public function inPutValidationErrorAndFiltteringData(
        $inputArray,
        $input
    ) {
        if (
            empty($inputArray) ||
            !isset($inputArray[$input]) ||
            empty($inputArray[$input])
        ) {

            $input = $input ? str_replace('_',' ', $input) : $input;
            $input = strtolower($input);
            $input = ucfirst($input);

            $this->responseStatus(
                true,
                REQUEST_NOT_VALID,
                "$input filed required"
            );
        } else {
            $data = trim($inputArray[$input]);
            $data = htmlspecialchars($data);
            return $data;
        }
    }

    //post inputs
    public function basicFunctionForPostInputs()
    {
        if (empty($_POST)) {
            $this->responseStatus(
                true,
                REQUEST_NOT_VALID,
                'parameters are missing'
            );
        }
        return $_POST;
    }
    
    // setting content for respons or request for the webpage
    public function settinPageContentHeader(string $dataType = ''): void
    {
        header("Content-Type: application/$dataType");
    }

    // returning reponse success or errors
    public function responseStatus(
        $error,
        $code,
        $message
    ) {
        $this->settinPageContentHeader('json');
        echo json_encode(['error' => $error, 'status' => $code, 'data' => $message]);
        exit;
    }
}
