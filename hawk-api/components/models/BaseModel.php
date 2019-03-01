<?php

declare(strict_types=1);

namespace App\Components\Models;

use App\Components\Base\Mongo;
use App\Components\Models\Exceptions\BaseModelException;
use App\Components\Models\Exceptions\RecordNotFoundException;
use MongoDB\BSON\ObjectId;
use MongoDB\Collection;

/**
 * Class BaseModel
 *
 * @package App\Components\Models
 */
abstract class BaseModel
{
    /**
     * Collection name, that associated with model
     * Must be override
     *
     * @var string
     */
    protected $collectionName = '';

    /**
     * Base Model's constructor
     *
     * @param array $args Values as assoc array to fill model
     */
    public function __construct(array $args = [])
    {
        if (!empty($args)) {
            $this->fillModel($args);
        }
    }

    /**
     * Fill the model fields
     *
     * @param array $data Assoc array with keys, that equals to model properties
     */
    protected function fillModel(array $data): void
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                if ($value instanceof ObjectId) {
                    $value = (string) $value;
                }
                $this->$key = $value;
            }
        }
    }

    /**
     * Synchronise model with record at database
     * Can be redeclared to modify $args before sync
     *
     * @param $args array Values as assoc array to synchronise
     */
    public function sync(array $args): void
    {
        $this->fillModel($this->baseSync($args));
    }

    /**
     * Insert or Update model record in collection
     *
     * @param array $args Values as assoc array to synchronise
     *
     * @return array
     */
    protected function baseSync(array $args): array
    {
        if ($args['_id'] != null) {
            $mongoResult = $this->update($args);
        } else {
            $mongoResult = $this->save($args);
        }

        return $mongoResult;
    }

    /**
     * Save record at assoc collection
     *
     * @param array $args Values to save
     *
     * @return array
     */
    protected function save(array $args): array
    {
        $args['_id'] = $this->assocCollection()->insertOne($args)->getInsertedId();

        return $args;
    }

    /**
     * Update record by given _id
     *
     * @param array $args Values to update
     *
     * @throws RecordNotFoundException
     *
     * @return array
     */
    protected function update(array $args): array
    {
        $idOfUpdatedRecord = $args['_id'];

        unset($args['_id']);

        $filter['_id'] = new ObjectId($idOfUpdatedRecord);

        $update = [
            '$set' => $args
        ];

        $options = [
            'returnDocument' => \MongoDB\Operation\FindOneAndUpdate::RETURN_DOCUMENT_AFTER
        ];

        $mongoResult = $this->assocCollection()->findOneAndUpdate($filter, $update, $options);

        if ($mongoResult === null) {
            throw new RecordNotFoundException(
                sprintf("No record found to update in collection '%s'", $this->getCollectionName())
            );
        }

        return $mongoResult;
    }

    /**
     * Get all records from collection
     *
     * @param array $filter Filter to find records
     *
     * @return array
     */
    public function all(array $filter = []): array
    {
        //TODO: универсальная функция преобразования в ObjectID
        if (array_key_exists('_id', $filter) && (!$filter['_id'] instanceof ObjectId)) {
            $filter['_id'] = new ObjectId($filter['_id']);
        }

        $cursor = $this->assocCollection()->find($filter);

        $result = [];

        foreach ($cursor as $value) {
            $result[] = new static($value);
        }

        return $result;
    }

    /**
     * Find and fill model by _id
     *
     * @param string $_id Identifier of searching record
     */
    public function findById(string $_id): void
    {
        $this->fillModel($this->findOneWrapper(['_id' => $_id]));
    }

    /**
     * Find and fill model by filter
     *
     * @param array $filter Filter to find record
     */
    public function findOne(array $filter): void
    {
        $this->fillModel($this->findOneWrapper($filter));
    }

    /**
     * Mongo findOne wrapper
     *
     * @param array $filter Filter to find record
     *
     * @throws RecordNotFoundException
     *
     * @return array
     */
    public function findOneWrapper(array $filter = []): array
    {
        if (array_key_exists('_id', $filter) && (!$filter['_id'] instanceof ObjectId)) {
            $filter['_id'] = new ObjectId($filter['_id']);
        }

        $mongoResult = $this->assocCollection()->findOne($filter);

        if ($mongoResult === null) {
            throw new RecordNotFoundException(
                sprintf("No record found in collection '%s'", $this->getCollectionName())
            );
        }

        return $mongoResult;
    }

    /**
     * Get associated collection name
     *
     * @throws BaseModelException
     *
     * @return string
     */
    private function getCollectionName(): string
    {
        if (empty($this->collectionName)) {
            throw new BaseModelException('Collection name is not defined');
        }

        return $this->collectionName;
    }

    /**
     * Get the associated collection
     *
     * @return \MongoDB\Collection
     */
    protected function assocCollection(): Collection
    {
        return Mongo::database()->{$this->getCollectionName()};
    }
}
