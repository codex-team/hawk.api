<?php

declare(strict_types=1);

namespace App\Components\Models;

use App\Components\Base\Mongo;
use App\Components\Models\Exceptions\ModelException;
use MongoDB\BSON\ObjectId;
use MongoDB\Collection;

abstract class BaseModel
{
    /**
     * Model's constructor
     *
     * @param array $args
     */
    abstract public function __construct(array $args = []);

    abstract public function collectionName(): string;

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
     * @param null|string $_id
     * @param array       $args
     *
     * @throws \Exception
     *
     * @return array|null|object
     */
    protected function baseSync(array $args)
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
     * @param array $args
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
     * @param array $args
     *
     * @throws ModelException
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
            throw new ModelException("Record with _id = $idOfUpdatedRecord not found in {$this->collectionName()}");
        }

        return $mongoResult;
    }

    /**
     * Return all records from collection
     *
     * @return array
     */
    public function all(): array
    {
        $collection = $this->assocCollection();

        $cursor = $collection->find();

        $result = [];

        foreach ($cursor as $value) {
            $result[] = new static($value);
        }

        return $result;
    }

    /**
     * Find model by _id
     *
     * @param string $id
     *
     * @throws ModelException
     */
    public function findOne(string $_id): void
    {
        $collection = $this->assocCollection();

        $mongoResult = $collection->findOne(['_id' => new ObjectId($_id)]);

        if ($mongoResult === null) {
            throw new ModelException("Record with _id = $_id not found in {$this->collectionName()}");
        }

        $this->fillModel($mongoResult);
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
