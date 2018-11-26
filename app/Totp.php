<?php

namespace App;


use Symfony\Component\HttpFoundation\Response;

class Totp
{
    public $offset = 30;

    public $secretKey = "MKBSWN3DPEHPK2PXZ";

    public function generate(){
        // insert static cutoff time;
        $secret = $this->secretKey;
        // calculate the timestamp from the unix time and counter;
        // sha1 only accepts 8bytes strings so we need convert it to 8 bytes using the pack function
        $time = $this->getPack($this->timestamp());
        // Hash the timestamp and the secret key
        $hash = hash_hmac ('sha1', $time, $secret, true);
        // convert the sha1 hash to an integer one time password
        $offset = ord($hash[19]) & 0xf;
        $otp = (
                ((ord($hash[$offset+0]) & 0x7f) << 24 ) |
                ((ord($hash[$offset+1]) & 0xff) << 16 ) |
                ((ord($hash[$offset+2]) & 0xff) << 8 ) |
                (ord($hash[$offset+3]) & 0xff)
            ) % pow(10, 6);
        return $otp;
    }

    public function verify($otp){
        $generated = $this->generate();
        if($generated == $otp){
            return $this->successResponse($generated,$otp);
        }
        return $this->errorResponse($generated, $otp);
    }
    public function timestamp(){
        return floor(time()/$this->offset);
    }

    /**
     * @return int
     */
    public function getPack($timestamp)
    {
        return pack('N*', 0).pack('N*', $timestamp);
    }
    public function successResponse($generated, $otp) {
        return response()->json([
            "message" => "The code you supplied is correct",
            "otp" => $otp,
            "generated" => $generated,
        ]);
    }

    public function errorResponse($generated,$otp) {
        return response()->json([
            "error" => "The code you supplied is incorrect",
            "otp" => $otp,
            "generated" => $generated,
        ],Response::HTTP_BAD_REQUEST);
    }
}