<?php

declare(strict_types=1);

namespace App\Components\Models;

use App\Components\Base\Mongo;
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
     * Model's constructor
     *
     * @param array $args
     */
    abstract public function __construct(array $args = []);

    /**
     * Return associated collection name
     *
     * @return string
     */
    abstract public function collectionName(): string;

    /**
     * Sync model with record at database
     *
     * @param array $args
     */
    abstract public function sync(array $args): void;

    /**
     * Fill the model fields
     *
     * @param array $data
     */
    protected function fillModel(array $data): void
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
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
    private function save(array $args): array
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
    private function update(array $args): array
    {
        $idOfUpdatedRecord = $args['_id'];

        unset($args['_id']);

        $query['_id'] = new ObjectId($idOfUpdatedRecord);

        $update = [
            '$set' => $args
        ];

        $options = [
            'upsert' => true,
            'returnDocument' => \MongoDB\Operation\FindOneAndUpdate::RETURN_DOCUMENT_AFTER
        ];

        $mongoResult = $this->assocCollection()->findOneAndUpdate($query, $update, $options);

        if ($mongoResult === null) {
            throw new RecordNotFoundException($this->collectionName());
        }

        return $mongoResult;
    }

    /**
     * Return all records from collection (by filter)
     *
     * @param array $filter Filter to find records
     *
     * @return array
     */
    public function all(array $filter = []): array
    {
        $cursor = $this->assocCollection()->find($filter);

        $result = [];

        foreach ($cursor as $value) {
            $result[] = new static($value);
        }

        return $result;
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
    protected function findOne(array $filter): array
    {
        $mongoResult = $this->assocCollection()->findOne($filter);

        if ($mongoResult === null) {
            throw new RecordNotFoundException($this->collectionName());
        }

        return $mongoResult;
    }

    /**
     * Find and fill model by _id
     *
     * @param string $id
     */
    public function findById(string $_id): void
    {
        $this->fillModel($this->findOne(['_id' => new ObjectId($_id)]));
    }

    /**
     * Find and fill model by custom condition
     *
     * @param array $conditions
     */
    public function findByConditions(array $conditions = []): void
    {
        $this->fillModel($this->findOne($conditions));
    }

    /**
     * Return the associated collection
     *
     * @return \MongoDB\Collection
     */
    public function assocCollection(): Collection
    {
        return Mongo::database()->{$this->collectionName()};
    }
}
