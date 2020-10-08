<?php
namespace App\Repositories\Interfaces;

interface ProductRepositoryInterface
{
    /**
     * @param $request
     * @return mixed
     */
    public function createProduct($request);

    /**
     * @return mixed
     */
    public function getProducts();

    /**
     * @param $request
     * @param $id
     * @return mixed
     */
    public function updateProducts($request, $id);

    /**
     * @param $id
     * @return mixed
     */
    public function deleteProduct($id);
}
