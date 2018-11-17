<?php

namespace App\Components\Models;

use App\Components\Base\Mongo;
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
     * Base sync for child
     *
     * @param string $id
     * @param array  $args
     *
     * @throws \Exception
     *
     * @return
     */
    protected function baseSync(string $id, array $args)
    {
        $mongoResult = [];
        $collection = $this->assocCollection();

        if ($id) {
            $query['_id'] = new ObjectId($id);

            $options = [
                'upsert' => true,
                'returnDocument' => \MongoDB\Operation\FindOneAndUpdate::RETURN_DOCUMENT_AFTER
            ];

            $update = [
                '$set' => $args
            ];

            unset($args['id']);

            $mongoResult = $collection->findOneAndUpdate($query, $update, $options);

            if ($mongoResult === null) {
                throw new \Exception("Record with _id = $id not found");
            }
        } else {
            $mongoResult['id'] = $collection->insertOne($args)->getInsertedId();
        }

        return $mongoResult;
    }

    abstract public function sync(): void;

    /**
     * Find model by _id
     *
     * @param string $id
     */
    public function findOne(string $id)
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

    abstract public function collectionName(): string;
}
