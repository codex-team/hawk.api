<?php

declare(strict_types=1);

namespace App;

use App\Schema\TypeRegistry;
use Dotenv\Dotenv;
use GraphQL\GraphQL;
use GraphQL\Type\Schema;

/**
 * Define project's root
 */
define('ROOT', __DIR__);

/**
 * Load Composer Autoloader
 */
require_once ROOT . '/vendor/autoload.php';

/**
 * Load .env
 */
if (is_file(ROOT . '/.env')) {
    $de = new Dotenv(ROOT);
    $de->load();
}

$rawInput = file_get_contents('php://input');
$input = json_decode($rawInput, true);
$query = $input['query'];

$schema = new Schema([
    'query' => TypeRegistry::query()
]);

$result = GraphQL::executeQuery($schema, $query)->toArray();

header('Content-Type: application/json; charset=UTF-8');
echo json_encode($result);

//query and мутации
//
