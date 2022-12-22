<?php

namespace App\Traits;

trait PushNotificationTrait
{

    public function sendPushNotification($registatoin_ids, $notification, $device_type)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        if ($device_type == "Android") {
            $fields = array(
                'to' => $registatoin_ids,
                'data' => $notification,

            );
        } else {
            $fields = array(
                'to' => $registatoin_ids,
                'notification' => $notification
            );
        }
        // Firebase API Key
        $headers = array('Authorization:key=AAAAOLlqjys:APA91bEy1Ei-c4fidGys_rOyXGyAFQK5GKL7uRGSVfX1fvJMzEp0rG3mzVLN7K39Bk1HruQBR7ziceGjw8r6zHG6_HPt4_LmkGd8F66F6d626bvwOuRPeT2wBMaSUk-x0t5G8nWwB_tI', 'Content-Type:application/json');
        // Open connection
        $ch = curl_init();
        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        curl_close($ch);
        return $result;
    }
}
