<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\ProductCategoryRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\Response;



class RestfulApiController extends Controller
{
    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepository;

    /**
     * @var ProductCategoryRepositoryInterface
     */
    private $productCategoryRepository;

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;


    /**
     * RestfulApiController constructor.
     * @param CategoryRepositoryInterface $categoryRepository
     * @param ProductCategoryRepositoryInterface $productCategoryRepository
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository, ProductCategoryRepositoryInterface $productCategoryRepository, ProductRepositoryInterface $productRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->productCategoryRepository = $productCategoryRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * me
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createProduct(Request $request)
    {
        $productName = $request->input('name');
        $productPrice = $request->input('price');
        $productCategory = $request->input('category');

        $data = [
          'productName' => $productName,
          'productPrice' => $productPrice,
          'productCategory' => $productCategory
        ];

        if($this->productRepository->createProduct($data))
        {
            return Response::json(['status' => 'success']);
        }

        return Response::json(['status' => 'error']);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProduct()
    {
        $result = $this->productRepository->getProducts();

        return Response::json([$result]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function editProduct(Request $request, $id)
    {

        $result = $this->productRepository->updateProducts($request, $id);

        if($result)
        {
            return Response::json(['status' => 'edit']);
        }

        return Response::json(['status' => 'error']);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteProduct($id)
    {
        $result = $this->productRepository->deleteProduct($id);

        if($result)
        {
            return Response::json(['status' => 'delete']);
        }

        return Response::json(['status' => 'error']);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createCategory(Request $request)
    {
        $categoryName = $request->input('name');

        if($this->categoryRepository->createCategory($categoryName))
        {
            return Response::json(['status' => 'success']);
        }

        return Response::json(['status' => 'error']);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteCategory($id)
    {
        $result = $this->categoryRepository->deleteCategory($id);

        if($result)
        {
            return Response::json(['status' => 'delete']);
        }

        return Response::json(['status' => 'error']);
    }
}
