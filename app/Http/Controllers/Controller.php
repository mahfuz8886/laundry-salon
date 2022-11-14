<?php

namespace App\Http\Controllers;

use App\Deliveryman;
use App\LogActivity;
use App\Merchant;
use App\Pickupman;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function fileUpload($image, $path, $width = null, $height = null)
    {
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $imageUrl = $path . Str::random(50) . $image->getClientOriginalName();
        $img = Image::make($image);
        if ($width && $height) {
            $img->resize($width, $height);
        }
        $img->save($imageUrl);
        return $imageUrl;
    }

    public function fileUploadPHP($image, $path, $width = null, $height = null)
    {
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $name = Str::random(50) . $image->getClientOriginalName();
        $file = $image;
        $file->move($path, $name);
        $fileUrl = $path . $name;
        return $fileUrl;
    }

    public function slugify($text, string $divider = '-') {

        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', $divider, $text)));

        if (empty($slug)) {
            return 'n-a';
        }

        return $slug;
    }

    public function sendSMS($number, $msg)
    {
        $url = 'https://sms.novocom-bd.com/api/v2/SendSMS';
        $data = array(
            'ApiKey' => 'Yk8ptZe20K8CBy8etYS5Vvj48E6fXcgHZNp2+eoDRM8=',
            'ClientId' => 'd53c8d6c-1ed3-4d68-8b59-6cab7b63d574',
            'SenderId' => 8809638550066,
            'Message' => $msg,
            'MobileNumbers' => '88'.$number
        );

        $curl = curl_init($url);
        
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }

    public function sendOTPSMS($number, $msg)
    {
        $url = 'https://sms.novocom-bd.com/api/v2/SendSMS';
        $data = array(
            'ApiKey' => 'Yk8ptZe20K8CBy8etYS5Vvj48E6fXcgHZNp2+eoDRM8=',
            'ClientId' => 'd53c8d6c-1ed3-4d68-8b59-6cab7b63d574',
            'SenderId' => 8809638550066,
            'Message' => $msg,
            'MobileNumbers' => '88'.$number
        );

        $curl = curl_init($url);
        
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }

    public function getOTPBalance()
    {
        $url = 'https://isms.zaman-it.com/miscapi/C2001629629598d6e9b618.94751793/getBalance';
        // $url = 'https://isms.zaman-it.com/miscapi/C2001629629598d6e9b618.94751793/getDLR/getAll';
        $resp = $this->cURLGetRequest($url);
        return $resp;
    }

    public function getOTPDeliveryReport()
    {
        $url = 'https://isms.zaman-it.com/miscapi/C2001629629598d6e9b618.94751793/getDLR/getAll';
        $resp = $this->cURLGetRequest($url);
        return $resp;
    }

    function smsBalance()
    {
        $url = 'https://24smsbd.com/api/current-balance';
        // $apiKey = "T25lUG9pbnRJdFNvbHV0aW9uOlBvaW50ODUw";
        // $sender_id = 165;
        $apiKey = "c2Vuc29yYmQ6c2Vuc29yYmQxMjM0NTY3ODk=";
        $sender_id = 1498;

        $data = array(
            'sender_id' => $sender_id,
            'apiKey' => $apiKey
        );
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }


    public function merchant($api_token)
    {
        return Merchant::where('api_token', $api_token)->first();
    }

    public function deliveryman($api_token)
    {
        return Deliveryman::where('api_token', $api_token)->first();
    }

    public function pickupman($api_token = null)
    {
        return Pickupman::where('api_token', $api_token)->first();
    }

    function cURLGetRequest($url)
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $resp = curl_exec($curl);
        curl_close($curl);
        return $resp;
    }

    /*..........activity log...........*/
    public function addLog($userId, $userType, $subject,$orderId) {
        $log = [];
    	$log['subject'] = $subject;
    	$log['order_id'] = $orderId;
    	$log['user_id'] = $userId;
    	$log['user_type_id'] = $userType;
        LogActivity::create($log);
    }

    public function logList(Request $request) {
        return LogActivity::all();
    }

    public function findOrigin() {
        if (Session::get('section') == 'laundry') {
            $origin = 1;
        } elseif (Session::get('section') == 'salon') {
            $origin = 2;
        } elseif (Session::get('section') == 'pos') {
            $origin = 3;
        }
        return $origin;
    }
}
