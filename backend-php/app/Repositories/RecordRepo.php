<?php
namespace App\Repositories;

use App\Models\IdentityRecord;
use App\Models\IdentityRecordCategory;
use App\Models\RecordType;
use App\Repositories\Interfaces\IRecordRepo;

class RecordRepo implements IRecordRepo
{
    /**
     * Create or update records for given identity
     * @param $identityId
     * @param array $records
     * @return void
     */
    public function updateRecords(
        $identityId,
        array $records
    ) {
        $recordTypes = RecordType::getModel()->pluck(
            'id', 'key'
        )->toArray();

        foreach ($records as $key => $value) {
            IdentityRecord::firstOrCreate([
                'identity_id' => $identityId,
                'record_type_id' => $recordTypes[$key]
            ])->update([
                'value' => $value
            ]);
        }
    }

    /**
     * Get list all available record type keys
     * @return array
     */
    public function getRecordTypes() {
        return RecordType::getModel()->get()->map(function($recordType) {
            return collect($recordType)->only(['id', 'key', 'name']);
        })->toArray();
    }

    /**
     * Check if record type and value is unique
     * @param string $recordTypeKey
     * @param string $recordValue
     * @param mixed $excludeIdentity
     * @return mixed
     * @throws \Exception
     */
    public function isRecordUnique(
        string $recordTypeKey,
        string $recordValue,
        string $excludeIdentity = null
    ) {
        /**
         * @var RecordType $recordType
         */
        $recordType = RecordType::getModel()->where([
            'key' => $recordTypeKey
        ])->first();

        if (!$recordType) {
            throw new \Exception('Unknown record type: \"$recordTypeKey\"!');
        }

        $identityRecord = IdentityRecord::getModel()->where([
            'record_type_id' => $recordType->id,
            'value' => $recordValue
        ]);

        if ($excludeIdentity) {
            $identityRecord->where(
                'identity_id', '!=', $excludeIdentity
            );
        }

        return $identityRecord->count() == 0;
    }
    /**
     * Check if record type and value is already existing
     * @param string $recordTypeKey
     * @param string $recordValue
     * @param mixed $excludeIdentity
     * @return mixed
     * @throws \Exception
     */
    public function isRecordExists(
        string $recordTypeKey,
        string $recordValue,
        string $excludeIdentity = null
    ) {
        /**
         * @var RecordType $recordType
         */
        $recordType = RecordType::getModel()->where([
            'key' => $recordTypeKey
        ])->first();

        if (!$recordType) {
            throw new \Exception('Unknown record type: \"$recordTypeKey\"!');
        }

        $identityRecord = IdentityRecord::getModel()->where([
            'record_type_id' => $recordType->id,
            'value' => $recordValue
        ]);

        if ($excludeIdentity) {
            $identityRecord->where(
                'identity_id', '!=', $excludeIdentity
            );
        }

        return $identityRecord->count() != 0;
    }


    /**
     * Get identity id by email record
     * @param string $email
     * @return mixed
     */
    public function identityIdByEmail(
        string $email
    ) {
        $identity = IdentityRecord::getModel()->where([
            'record_type_id' => $this->getTypeIdByKey('email'),
            'value' => $email,
        ])->first();

        return $identity ? $identity->id : null;
    }


    /**
     * Get type id by key
     * @param string $key
     * @return mixed
     */
    public function getTypeIdByKey(
        string $key
    ) {
        return RecordType::getModel()->where('key', $key)->first()->id;
    }

    /**
     * Add new record category to identity
     * @param mixed $identityId
     * @param string $name
     * @param int $order
     * @return array|null
     */
    public function categoryCreate(
        $identityId,
        string $name,
        int $order
    ) {
        /** @var IdentityRecord $record */
        $record =  IdentityRecordCategory::getModel()->create([
            'identity_id' => $identityId,
            'name' => $name,
            'order' => $order ? $order : 0,
        ]);

        return $this->categoryGet($identityId, $record->id);
    }

    /**
     * Get identity record categories
     * @param mixed $identityId
     * @return array
     */
    public function categoriesList(
        $identityId
    ) {
        return IdentityRecordCategory::getModel()->where([
            'identity_id' => $identityId
        ])->select([
            'id', 'name', 'order'
        ])->orderBy('order')->get()->toArray();
    }

    /**
     * Get identity record category
     * @param mixed $identityId
     * @param mixed $recordCategoryId
     * @return array|null
     */
    public function categoryGet(
        $identityId,
        $recordCategoryId
    ) {
        $record =  IdentityRecordCategory::getModel()->where([
            'id' => $recordCategoryId,
            'identity_id' => $identityId
        ])->select([
            'id', 'name', 'order'
        ])->first();

        return !$record ? null : $record->toArray();
    }

    /**
     * Update identity record category
     * @param mixed $identityId
     * @param mixed $recordCategoryId
     * @param string|null $name
     * @param int|null $order
     * @return bool
     */
    public function categoryUpdate(
        $identityId,
        $recordCategoryId,
        string $name = null,
        int $order = null
    ) {
        $record =  IdentityRecordCategory::getModel()->where([
            'id' => $recordCategoryId,
            'identity_id' => $identityId
        ])->first();

        if (!$record) {
            return false;
        }

        return !!$record->update(collect(compact(
            'name', 'order'
        ))->filter(function($val) {
            return !is_null($val);
        })->toArray());
    }

    /**
     * Sort categories
     * @param mixed $identityId
     * @param array $orders
     * @return void
     */
    public function categoriesSort(
        $identityId,
        array $orders
    ) {
        $self = $this;

        collect($orders)->each(function(
            $categoryId, $order
        ) use ($identityId, $self) {
            $self->categoryUpdate($identityId, $categoryId, null, $order);
        });
    }

    /**
     * Delete category
     * @param mixed $identityId
     * @param mixed $recordCategoryId
     * @return mixed
     * @throws \Exception
     */
    public function categoryDelete(
        $identityId,
        $recordCategoryId
    ) {
        $record =  IdentityRecordCategory::getModel()->where([
            'id' => $recordCategoryId,
            'identity_id' => $identityId
        ])->first();

        if (!$record) {
            return false;
        }

        return !!$record->delete();
    }


    /**
     * Get identity records
     * @param mixed $identityId
     * @return array
     */
    public function recordsList(
        $identityId
    ) {
        // Todo: validation state
        return IdentityRecord::getModel()->where([
            'identity_id' => $identityId
        ])->with([
            'record_type'
        ])->orderBy('order')->get()->map(function($identityRecord) {
            /** @var IdentityRecord $identityRecord */
            return [
                'id' => $identityRecord->id,
                'value' => $identityRecord->value,
                'order' => $identityRecord->order,
                'key' => $identityRecord->record_type->key,
                'category_id' => $identityRecord->identity_record_category_id,
                'valid' => true,
                'validations' => $identityRecord->validations()->select([
                    'state', 'record_validator_id'
                ])->get()->toArray()
            ];
        })->toArray();
    }

    /**
     * Get identity record
     * @param mixed $identityId
     * @param mixed $recordId
     * @return array
     */
    public function recordGet(
        $identityId,
        $recordId
    ) {
        /** @var IdentityRecord $identityRecord */
        $identityRecord = IdentityRecord::getModel()->where([
            'id' => $recordId,
            'identity_id' => $identityId,
        ])->first();

        // Todo: validation state
        return [
            'id' => $identityRecord->id,
            'value' => $identityRecord->value,
            'order' => $identityRecord->order,
            'record_category_id' => $identityRecord->identity_record_category_id,
            'key' => $identityRecord->record_type->key,
            'valid' => true,
            'validations' => $identityRecord->validations()->select([
                'state', 'record_validator_id'
            ])->get()->toArray()
        ];
    }

    /**
     * Get identity record by key
     * @param mixed $identityId
     * @param mixed $typeKey
     * @return mixed
     * @throws \Exception
     */
    public function recordGetByKey(
        $identityId,
        $typeKey
    ) {
        $typeId = $this->getTypeIdByKey($typeKey);

        if (!$typeId) {
            throw new \Exception("Unknown record type.");
        }

        /** @var IdentityRecord $identityRecord */
        $identityRecord = IdentityRecord::getModel()->where([
            'record_type_id' => $typeId,
            'identity_id' => $identityId,
        ])->first();

        // Todo: validation state
        return [
            'id' => $identityRecord->id,
            'value' => $identityRecord->value,
            'order' => $identityRecord->order,
            'record_category_id' => $identityRecord->identity_record_category_id,
            'key' => $identityRecord->record_type->key,
            'valid' => true,
            'validations' => $identityRecord->validations()->select([
                'state', 'record_validator_id'
            ])->get()->toArray()
        ];
    }

    /**
     * Add new record to identity
     * @param mixed $identityId
     * @param string $typeKey
     * @param string $value
     * @param mixed|null $recordCategoryId
     * @param integer|null $order
     * @return bool|array
     * @throws \Exception
     */
    public function recordCreate(
        $identityId,
        string $typeKey,
        string $value,
        $recordCategoryId = null,
        $order = null
    ) {
        $typeId = $this->getTypeIdByKey($typeKey);

        if (!$typeId) {
            throw new \Exception("Unknown record type.");
        }

        /** @var IdentityRecord $record */
        $record = IdentityRecord::create([
            'identity_id' => $identityId,
            'order' => $order ? $order : 0,
            'value' => $value,
            'record_type_id' => $typeId,
            'record_category_id' => $recordCategoryId,
        ]);

        return $this->recordGet($identityId, $record->id);
    }

    /**
     * Update record
     * @param mixed $identityId
     * @param mixed $recordId
     * @param mixed|null $recordCategoryId
     * @param integer|null $order
     * @return bool
     */
    public function recordUpdate(
        $identityId,
        $recordId,
        $recordCategoryId = null,
        $order = null
    ) {
        $update = collect();

        if (is_numeric($recordCategoryId)) {
            $update->put('record_category_id', $recordCategoryId);
        }

        if (is_numeric($order)) {
            $update->put('order', $order);
        }

        return !!IdentityRecord::getModel()->where([
            'id' => $recordId,
            'identity_id' => $identityId
        ])->update($update->toArray());
    }

    /**
     * Sort records
     * @param mixed $identityId
     * @param array $orders
     * @return void
     */
    public function recordsSort(
        $identityId,
        array $orders
    ) {
        $self = $this;

        collect($orders)->each(function(
            $recordId, $order
        ) use ($identityId, $self) {
            $self->recordUpdate($identityId, $recordId, null, $order);
        });
    }

    /**
     * Delete record
     * @param mixed $identityId
     * @param mixed $recordId
     * @return bool
     * @throws \Exception
     */
    public function recordDelete(
        $identityId,
        $recordId
    ) {
        $record =  IdentityRecord::getModel()->where([
            'id' => $recordId,
            'identity_id' => $identityId
        ])->first();

        if (!$record) {
            return false;
        }

        return !!$record->delete();
    }
}