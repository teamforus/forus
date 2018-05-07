<?php
namespace App\Repositories;

use App\Models\Identity;
use App\Repositories\Interfaces\IIdentityRepo;

class IdentityRepo extends BaseRepo implements IIdentityRepo
{
    public function __construct(
        Identity $model
    ) {
        $this->model = $model;
    }
}