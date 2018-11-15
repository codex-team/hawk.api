<?php

namespace App\Components\Models;

abstract class BaseModel
{
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

    abstract public function collectionName(): string;

    abstract public function sync();

    abstract public function find(int $id);
}