<?php

declare(strict_types=1);

namespace App;

use App\Schema\TypeRegistry;
use Dotenv\Dotenv;
use GraphQL\Error\Debug;
use GraphQL\GraphQL;
use GraphQL\Type\Schema;

/**
 * Define project's root
 */
define('ROOT', __DIR__);

/**
 * Load Composer Autoloader
 */
require_once ROOT . '../vendor/autoload.php';

/**
 * Exception handling.
 */
//set_exception_handler(['\App\Components\Base\Error', 'exceptionHandler']);

/**
 * Load .env
 */
if (file_exists(ROOT . '/.env')) {
    $de = new Dotenv(ROOT);
    $de->load();
}

try {
    //получаем данные запроса в формате JSON
    $rawInput = file_get_contents('php://input');
    //декодируем JSON в ассоциативный массив
    $input = json_decode($rawInput, true);
    //получаем запрос из массива
    $query = $input['query'];
    //полученаем переменные запроса
    $variables = isset($input['variables']) ? json_decode($input['variables'], true) : null;

    //создаем схему для GraphQL (запросы и мутации)
    $schema = new Schema([
        'query' => TypeRegistry::query(),
        'mutation' => TypeRegistry::mutation()
    ]);

    //исполняем запрос и дебажим исполнение
    $debug = Debug::INCLUDE_DEBUG_MESSAGE | Debug::INCLUDE_TRACE;
    $result = GraphQL::executeQuery($schema, $query, null, null, $variables)->toArray($debug);
} catch (\Exception $e) {
    $result = [
        'error' => [
            'message' => $e->getMessage()
        ]
    ];
}

//возвращаем ответ в виде JSON
header('Content-Type: application/json; charset=UTF-8');
echo json_encode($result);
