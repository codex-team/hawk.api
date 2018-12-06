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

    abstract public function sync(): void;

    /**
     * Fill the model fields
     *
     * @param array $data
     */
    protected function fillModel(array $data): void
    {
        if (array_key_exists('_id', $data)) {
            $this->id = $data['_id'];
        }

        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    /**
     * Insert or Update model record in collection
     *
     * @param null|string $id
     * @param array       $args
     *
     * @throws \Exception
     *
     * @return array|null|object
     */
    protected function baseSync(?string $id, array $args)
    {
        $mongoResult = [];
        $collection = $this->assocCollection();

        unset($args['id']);

        if ($id) {
            $query['_id'] = new ObjectId($id);

            $options = [
                'upsert' => true,
                'returnDocument' => \MongoDB\Operation\FindOneAndUpdate::RETURN_DOCUMENT_AFTER
            ];

            $update = [
                '$set' => $args
            ];

            $mongoResult = $collection->findOneAndUpdate($query, $update, $options);

            if ($mongoResult === null) {
                throw new ModelException("Record with _id = $id not found in {$this->collectionName()}");
            }
        } else {
            $mongoResult['id'] = $collection->insertOne($args)->getInsertedId();
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
     */
    public function findOne(string $id): void
    {
        $collection = $this->assocCollection();

        $mongoResult = $collection->findOne(['_id' => new ObjectId($id)]);

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
