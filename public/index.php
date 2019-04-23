<?php
declare(strict_types=1);

namespace App;

use App\Schema\TypeRegistry;
use Exception;
use GraphQL\Error\Debug;
use GraphQL\GraphQL;
use GraphQL\Type\Schema;

/**
 * Set Endpoint mode
 */
define('MODE', 'api');

/**
 * Disable CLI usage
 */
if (PHP_SAPI === 'cli') {
    echo 'Current entry point is not available as cli';
    exit;
}

require_once dirname(__DIR__) . '/app/bootstrap.php';

try {
    /**
     * Получаем данные запроса в формате JSON
     */
    $rawInput = file_get_contents('php://input');

    /**
     * декодируем JSON в ассоциативный массив
     */
    $input = json_decode($rawInput, true);

    /**
     * Получаем запрос из массива
     */
    $query = $input['query'];

    /**
     * Полученаем переменные запроса
     */
    $variables = isset($input['variables']) ? json_decode($input['variables'], true) : null;

    /**
     * Создаем схему для GraphQL (запросы и мутации)
     */
    $schema = new Schema([
        'query' => TypeRegistry::query(),
        'mutation' => TypeRegistry::mutation()
    ]);

    /**
     * Исполняем запрос и дебажим исполнение
     */
    $debug = getenv('DEBUG') ? Debug::INCLUDE_DEBUG_MESSAGE | Debug::INCLUDE_TRACE: false;
    $result = GraphQL::executeQuery($schema, $query, null, null, $variables)->toArray($debug);
} catch (Exception $e) {
    $result = [
        'error' => [
            'message' => $e->getMessage()
        ]
    ];
}

/**
 * Возвращаем ответ в виде JSON
 */
header('Content-Type: application/json; charset=UTF-8');
echo json_encode($result);
