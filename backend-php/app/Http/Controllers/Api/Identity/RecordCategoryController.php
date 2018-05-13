<?php

namespace App\Http\Controllers\Api\Identity;

use App\Http\Requests\Api\RecordCategories\RecordCategoryStoreRequest;
use App\Http\Requests\Api\RecordCategories\RecordCategoryUpdateRequest;
use App\Models\IdentityRecordCategory;
use App\Repositories\Interfaces\IRecordRepo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RecordCategoryController extends Controller
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
     * Get list categories
     * @param Request $request
     * @return array
     */
    public function index(Request $request)
    {
        return $this->recordRepo->categoriesList(
            $request->get('identity')
        );
    }

    /**
     * Create new record category
     * @param RecordCategoryStoreRequest $request
     * @return array
     */
    public function store(
        RecordCategoryStoreRequest $request
    ) {
        $success = !!$this->recordRepo->categoryCreate(
            $request->get('identity'),
            $request->get('name'),
            $request->input('order', null)
        );

        return compact('success');
    }

    /**
     * Get record category
     * @param Request $request
     * @param IdentityRecordCategory $identityRecordCategory
     * @return array|null
     */
    public function show(
        Request $request,
        IdentityRecordCategory $identityRecordCategory
    ) {
        $identity = $request->get('identity');

        if (empty($this->recordRepo->categoryGet(
            $identity, $identityRecordCategory->id
        ))) {
            abort(404);
        }

        $category = $this->recordRepo->categoryGet(
            $identity,
            $identityRecordCategory->id
        );

        if (!$category) {
            return abort(404);
        }

        return $category;
    }

    /**
     * Update record category
     * @param RecordCategoryUpdateRequest $request
     * @param IdentityRecordCategory $identityRecordCategory
     * @return array
     */
    public function update(
        RecordCategoryUpdateRequest $request,
        IdentityRecordCategory $identityRecordCategory
    ) {
        $identity = $request->get('identity');

        if (empty($this->recordRepo->categoryGet(
            $identity, $identityRecordCategory->id
        ))) {
            abort(404);
        }

        $success = $this->recordRepo->categoryUpdate(
            $request->get('identity'),
            $identityRecordCategory->id,
            $request->input('name', null),
            $request->input('order', null)
        );

        return compact('success');
    }

    /**
     * Delete record category
     * @param Request $request
     * @param IdentityRecordCategory $identityRecordCategory
     * @return array
     * @throws \Exception
     */
    public function destroy(
        Request $request,
        IdentityRecordCategory $identityRecordCategory
    ) {
        $identity = $request->get('identity');

        if (empty($this->recordRepo->categoryGet(
            $identity, $identityRecordCategory->id
        ))) {
            abort(404);
        }

        $success = $this->recordRepo->categoryDelete(
            $request->get('identity'),
            $identityRecordCategory->id
        );

        return compact('success');
    }

    /**
     * Sort record categories
     * @param Request $request
     * @return array
     */
    public function sort(
        Request $request
    ) {
        $this->recordRepo->categoriesSort(
            $request->get('identity'),
            collect($request->get('categories', []))->toArray()
        );

        $success = true;

        return compact('success');
    }
}
