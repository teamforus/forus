<?php

namespace App\Http\Controllers\Api\Identity;

use App\Http\Requests\Api\Records\RecordStoreRequest;
use App\Http\Requests\Api\Records\RecordUpdateRequest;
use App\Models\IdentityRecord;
use App\Repositories\Interfaces\IRecordRepo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RecordController extends Controller
{
    /** @var IRecordRepo $recordRepo */
    private $recordRepo;

    /**
     * RecordCategoryController constructor.
     * @param IRecordRepo $recordRepo
     */
    public function __construct(
        IRecordRepo $recordRepo
    ) {
        $this->recordRepo = $recordRepo;
    }

    /**
     * Get list records
     * @param Request $request
     * @return array
     */
    public function index(Request $request)
    {
        return $this->recordRepo->recordsList(
            $request->get('identity')
        );
    }

    /**
     * Create new record
     * @param RecordStoreRequest $request
     * @return array|bool
     */
    public function store(RecordStoreRequest $request)
    {
        return $this->recordRepo->recordCreate(
            $request->get('identity'),
            $request->get('key'),
            $request->get('value'),
            $request->get('record_category_id', null),
            $request->get('order', null)
        );
    }


    /**
     * Get record
     * @param Request $request
     * @param IdentityRecord $identityRecord
     * @return array
     */
    public function show(
        Request $request,
        IdentityRecord $identityRecord
    ) {
        $identity = $request->get('identity');

        if (empty($this->recordRepo->recordGet(
            $identity, $identityRecord->id
        ))) {
            abort(404);
        }

        return $this->recordRepo->recordGet(
            $request->get('identity'),
            $identityRecord->id
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  RecordUpdateRequest  $request
     * @param  \App\Models\IdentityRecord  $identityRecord
     * @return \Illuminate\Http\Response
     */
    public function update(
        RecordUpdateRequest $request,
        IdentityRecord $identityRecord
    ) {
        $identity = $request->get('identity');

        if (empty($this->recordRepo->recordGet(
            $identity, $identityRecord->id
        ))) {
            abort(404);
        }

        $success = $this->recordRepo->recordUpdate(
            $request->get('identity'),
            $identityRecord->id,
            $request->input('record_category_id', null),
            $request->input('order', null)
        );

        return compact('success');
    }

    /**
     * Delete record
     * @param Request $request
     * @param IdentityRecord $identityRecord
     * @return array
     * @throws \Exception
     */
    public function destroy(
        Request $request,
        IdentityRecord $identityRecord
    ) {
        $identity = $request->get('identity');

        if (empty($this->recordRepo->recordGet(
            $identity, $identityRecord->id
        ))) {
            abort(404);
        }

        $success = $this->recordRepo->recordDelete(
            $request->get('identity'),
            $identityRecord->id
        );

        return compact('success');
    }

    /**
     * Sort records
     * @param Request $request
     * @return array
     */
    public function sort(
        Request $request
    ) {
        $this->recordRepo->recordsSort(
            $request->get('identity'),
            collect($request->get('records', []))->toArray()
        );

        $success = true;

        return compact('success');
    }

    /**
     * Get available record type keys
     * @return array
     */
    public function typeKeys() {
        return $this->recordRepo->getRecordTypes();
    }
}
