<?php
namespace App\Repositories;

use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ProductsRepository implements ProductRepositoryInterface
{
    /**
     * @param $request
     * @return bool
     */
    public function createProduct($request)
    {
        $qb = DB::table('products')->insert(array('name' => $request['productName'], 'product_price' => $request["productPrice"], 'category_id' => $request['productCategory']));
        if ($qb)
        {
            return true;
        }
        return false;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getProducts()
    {
        $qb = DB::table('products')
            ->leftJoin('category', 'products.category_id', '=', 'category.id')
            ->select(
                'products.name',
                'products.category_id',
                'category.name as category_name',
                'products.product_price'
                )
            ->where('is_published', true)
            ->where('is_delete', false)
            ->get();

        return $qb;
    }

    /**
     * @param $request
     * @param $id
     * @return bool
     */
    public function updateProducts($request, $id)
    {

       $getProduct = DB::table('products')->select()->where(['id' => $id])->get();

        if(isset($request->name)) { $reqName = $request->name; } else { $reqName = $getProduct[0]->name; }
        if(isset($request->product_price)) { $reqPrice = $request->product_price; } else { $reqPrice = $getProduct[0]->product_price; }
        if(isset($request->category_id)) { $reqCat = $request->category_id; } else { $reqCat = $getProduct[0]->category_id; }

        $qb = DB::table('products')
            ->where(['id' => $id])
            ->update(array('name' => $reqName, 'product_price' => $reqPrice, 'category_id' => $reqCat))
        ;

        if ($qb)
        {
            return true;
        }
        return false;
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteProduct($id)
    {
        $qb = DB::table('products')->where(['id' => $id])->delete();

        if ($qb)
        {
            return true;
        }
        return false;
    }
}
