<?php


namespace database\migrations;

use \Facades\Config;
use \Monolog\Logger;
use \Monolog\Handler\StreamHandler;
use Monolog\Formatter\JsonFormatter;
use \Core\Datatables;

class UserMigration
{
    public static function up()
    {
        Config::env();
        $conn = Datatables::getInstance()->getConnection();
        $logger = new Logger("Connection Error");
        $formatter = new JsonFormatter();

        $stream_handler = new StreamHandler("php://stdout");
        $stream_handler->setFormatter($formatter);
        $logger->pushHandler($stream_handler);

        try
        {
            $stmt = $conn->query("SELECT * FROM users ORDER BY id DESC LIMIT 1");
            $user = $stmt->fetchAll();

            if($user != false || !empty($user))
            {
                echo 'Table users already up'.PHP_EOL; return;
            }

            $SQL = "CREATE TABLE `users` (
                    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                    `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
                    `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
                    `email_verified_at` timestamp NULL DEFAULT NULL,
                    `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
                    `active` char(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '1',
                    `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
                    `created_at` timestamp NULL DEFAULT NULL,
                    `updated_at` timestamp NULL DEFAULT NULL,
                    `last_activity` timestamp NULL DEFAULT NULL,
                    `admin` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '0',
                    `avatar` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
                    PRIMARY KEY (`id`) USING BTREE,
                    UNIQUE KEY `email` (`email`) USING BTREE
                    ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";

            if($conn->exec($SQL))
            {
                echo "Table users created..".PHP_EOL; return;
            }
        }
        catch(\Exception $err)
        {
            $logger->error("failed: " . $err->getMessage()); die();
        }


    }

    private $logger;
}

