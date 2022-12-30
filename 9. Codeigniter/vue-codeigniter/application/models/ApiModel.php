<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ApiModel extends MY_Model
{
    public $table = 'user_management';

    public function __construct()
    {
        parent::__construct();
    }
}
