<?php


namespace Core;


use \Facades\DB;


class PersonalAccessToken
{
    public static function findToken($token)
    {
        $token=  DB::getInstance()->table(self::getTable())->where('token', '=', $token)->get();
        if(!empty($token) && isset($token[0]) )
        {
            if(strtotime($token[0]['expires_at']) <=strtotime(date('Y-m-d H:i:s')))
            {
                DB::getInstance()->table(self::getTable())->delete('token', '=', $token);
             
                echo json_encode(['error'=>true,'success'=>false,'msg'=>'Token expired']);
                return false;
            }
            return true;
        }
    }

    public static function createToken($userID)
    {
        $bytes = random_bytes(32);
        $apiToken = bin2hex($bytes);
        $apiToken = base64_encode($apiToken);
        $apiToken  = substr($apiToken,0, 64);
        static::saveToken( $userID, $apiToken);
        return $apiToken;
    }

    private static function saveToken($userID, $apiToken)
    {
        $now = new \DateTime(); // Get current date and time
		$now->add(new \DateInterval('PT8H')); // Add 8 hours
		$expire = $now->format('Y-m-d H:i:s'); // Format the result

        $data = 
        [
            'tokenable_type'=>'App\Models\User',
            'tokenable_id' => $userID,
            'name'=>'ApiToken',
            'token'=>$apiToken,
            'abilities'=>'[ * ]',
            'expires_at'=> $expire,
            'created_at' => date('Y-m-d H:i:s')
        ];

        DB::getInstance()->table(static::getTable())->insert($data); 
    }

    protected static function getUserByToken($token)
    {
        $data=  DB::getInstance()->table(self::getTable())->where('token', '=', $token)->get();
        $tokenable_id = $data[0]['tokenable_id'];
        $user  = \App\Models\User::find($tokenable_id);
        return array_values($user);
    }

    private static function getTable()
    {
        return 'personal_access_tokens';
    }
}

?>