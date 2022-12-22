<?php

use Illuminate\Support\Arr;

return array(
    'category' => array(
           'ScrapCategory' => 1,
           'CharitableCategory' => 2,
           'ServiceCategory' => 3,
           'RecyclerCategory' => 4,
           'ProductCategory' =>5,
           'ShareCategory' => 6,
    ),
    'userRoles' => array(
        'Recycler' => 1,
        'Charitable Organization' => 2,
        'Scrap Dealer' => 3,
        //'Service Provider' => 4,
        'Customer' => 5,
    ),
    'fileTypes' => array(
        'profilePhoto' => 1,
        'agencyPhoto' => 2,
        'certification' => 3,
        'serviceRequestPhoto' => 4,
        'productPhoto' => 5,
    ),
    'fieldTypes' => array(
        'text' => 1,
        'email' => 2,
        'file' => 3,
        'number' => 4,
        'checkbox' => 5,
        'textarea' => 6
    ),
    'responseStatus' => array(
        'pending' => 1,
        'accepted' => 2,
        'rejected' => 3
    ),
    'sellOptions' => array(
        'toss' => 1,
        'donate' => 2,
        'recycle' => 4,
        'sell' => 5,
        'share' => 6, // change selloptions constant according to catType discuss with anil sir

    ),
    'productStatus' => array(
        'Pending' => 1,
        'Approved' => 2,
        'Rejected' => 3,
    ),
    'bidStatus' => array(
        'pending' => -1,
        'accepted' => 1,
        'rejected' => 0,
        'paid'  =>  2,
        'refundable'   =>   3,
        'paid_plus_assigned'=>6,
        'assign_by_admin'=> 5,
        'on_hold' => 4
    ),
    'iaStatus' => array(
        'assigned' => 1,
        'completed' => 2,
        'rejected' => 3,

    ),
    'otpStatus' => array(
        'open' => 0,
    ),
    'otpSection' => array(
        'signup' => 0,
    ),
    'roleSaleMapping' => array(
        '1' => 4,
        '2' => 3,
        '3' => 2,

    ),
    'payment'=>[
        'PAY-BID-AMOUNT'    =>  1,
        'PAY-SELLER'        =>  2,
        'PAY-MARGIN'        =>  3,
        'PAY-DA'            =>  4,
        'PAY-IA'            =>  5,
        'REFUND'            =>  6
    ],
    'ia_payment_status'=>[
        'not-needed'        =>  0,
        'pending'           =>  1,
        'initiated'         =>  2,
        'processed'         =>  3,
        'error'             =>  5,
        'details-needed'    =>  4,
    ],
    'da_payment_status'=>[
        'not-needed'        =>  0,
        'pending'           =>  1,
        'initiated'         =>  2,
        'processed'         =>  3,
        'error'             =>  5,
        'details-needed'    =>  4,
    ],
    'margin_payment_status'=>[
        'not-needed'        =>  0,
        'pending'           =>  1,
        'initiated'         =>  2,
        'processed'         =>  3,
        'error'             =>  5,
        'details-needed'    =>  4,
    ],
    'notificationTypes' => array(
        'bid-added' => 1,
        'product-approved' => 2,
        'product-rejected' => 3,
    ),
    'user_subscription_status' => array(
        'authenticated' => 1,
        'active' => 2,
        'expired' => 3,
        'completed' => 4,
        'canceled' => 5
    ),
    'subscription_status' => array(
        'enable' => 1,
        'disable' => 0
    ),

);
