<?php


namespace database\factories;

use \Facades\Hash;
use \Facades\Str;
use \Facades\Config;
use \Facades\DB;

use \Monolog\Logger;
use \Monolog\Handler\StreamHandler;
use Monolog\Formatter\JsonFormatter;

class UserFactory 
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password = 'password';

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected static function definition($num_users=100): array
    {
        $faker = \Faker\Factory::create();
        $users= [];

        for ($i = 0; $i < $num_users; $i++) 
        {
            $users[] = [
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'email_verified_at' => date("Y-m-d H:i:s"), 
                'password' => Hash::make(static::$password),
                'remember_token' => Str::random(10),
                'created_at' => $faker->dateTimeThisYear()->format('Y-m-d H:i:s'),
            ];
        }

        return $users;
    }

    public static function up($num_users = 100):void
    {
        Config::env();
        $logger = new Logger("Connection Error");
        $formatter = new JsonFormatter();

        $stream_handler = new StreamHandler("php://stdout");
        $stream_handler->setFormatter($formatter);

        $logger->pushHandler($stream_handler);

        $users = static::definition($num_users);

        $ok = [];
        for($i = 0 ; $i < sizeof($users); $i++)
        {
            $ok[] =DB::getInstance()->table('users')->insert($users[$i]);
        }


        if(static::areAllValuesSame($ok))
        {
            print_r('All users created'); die();
        }
        print_r('Please check if your database its online'); die();
    }

    
    protected static function areAllValuesSame($array) {
        if (empty($array)) {
            return true; // Or handle as per your requirement for empty arrays
        }
        return count(array_unique($array)) === 1;
    }
   
 
}
