<?php

namespace App\Repositories\Interfaces;


interface CategoryRepositoryInterface
{
    /**
     * @param $request
     * @return mixed
     */
    public function createCategory($request);

    /**
     * @param $id
     * @return mixed
     */
    public function deleteCategory($id);
}
