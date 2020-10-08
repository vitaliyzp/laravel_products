<?php
namespace App\Repositories;

use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CategoryRepository implements CategoryRepositoryInterface
{
    /**
     * @param $request
     * @return bool
     */
    public function createCategory($request)
    {
        $database = DB::table('category')->insert(array('name' => $request));
        if ($database)
        {
            return true;
        }
        return false;
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteCategory($id)
    {
        $database = DB::table('category')->where(['id' => $id])->delete();

        if ($database)
        {
            return true;
        }
        return false;
    }
}
