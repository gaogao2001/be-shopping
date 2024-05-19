<?php

namespace App\Http\Controllers;

use App\Components\Recusive;
use App\Http\Requests\ProductAddRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProducTag;
use App\Models\ProductImage;
use App\Models\Tag;
use App\Traits\deleteModelTraits;
use App\Traits\StorageImage;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Components\MenuRecusive;
use App\Models\Menu;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
class AdminProductController extends Controller
{
    use StorageImage,deleteModelTraits;
    private $category;
    private $product;
    private $productImage;
    private  $tag;
    private  $producTag;
    public function __construct(Category $category , Product $product , ProductImage $productImage,
                                Tag $tag , ProducTag $producTag )
    {
        $this->category = $category;
        $this->product = $product;
        $this->productImage = $productImage;
        $this->tag = $tag;
        $this->producTag = $producTag;

    }
    public function index()
    {
        $products = $this->product->latest()->paginate(5);
        return view('admin.product.index', compact('products'));
    }
    public function create()
    {
        $htmlOption = $this->getCategory($parentId = "");
        return view('admin.product.add', compact('htmlOption'));
    }
    public function getCategory($parentId)
    {
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryRecusive($parentId);
        return $htmlOption;
    }
    public function store( ProductAddRequest $request)
    {
        try {
            DB::beginTransaction();
            $dataProductCreate = [
                'name'=> $request->name,
                'price'=>$request->price,
                'content' => $request->contents,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id,
            ];


            $dataUploadFeatureImage= $this->storageTraitUpload($request , fieldName: 'feature_image_path', foderName: 'product');
            if (!empty($dataUploadFeatureImage)) {
                $dataProductCreate['feature_image_name'] =$dataUploadFeatureImage['file_name'];
                $dataProductCreate['feature_image_path'] =$dataUploadFeatureImage['file_path'];
            }
            $product = $this->product->create($dataProductCreate);

            //Indsert data to product_images
            if ($request->hasFile('image_path')) {
                foreach ($request->image_path as $fileItem) {
                    $dataProductImageDetail = $this->storageTraitUploadMutiple($fileItem, 'product');
                    $product->images()->create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name'],
                    ]);
                }
            }
            // Insert tags for product
            if (!empty($request->tags)) {
                foreach ($request->tags as $tagItem)
                {
                    $tagInstance = $this->tag->firstOrCreate(['name' => $tagItem]);
                    $tagIds[] = $tagInstance->id;

                }
                $product->tags()->attach($tagInstance);
//                $product->tags()->attach($tagIds);
            }
//
            DB::commit();
            return redirect()->route('product.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log:: error('Messeage:' .$exception->getMessage() . '----line :' . $exception->getLine() );
        }

    }
    public function edit($id)
    {
        $product = $this->product->find($id);
        $htmlOption = $this->getCategory($product->category_id);
       return view('admin.product.edit', compact('htmlOption', 'product'));
    }
    public function update(Request $request , $id)
    {
        try {
            DB::beginTransaction();

            $dataProductUpdate = [

                'name'=> $request->name,
                'price'=>$request->price,
                'content' => $request->contents,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id,
            ];

            $dataUploadFeatureImage= $this->storageTraitUpload($request , fieldName: 'feature_image_path', foderName: 'product');
            if (!empty($dataUploadFeatureImage)) {
                $dataProductUpdate['feature_image_name'] =$dataUploadFeatureImage['file_name'];
                $dataProductUpdate['feature_image_path'] =$dataUploadFeatureImage['file_path'];
            }
            $this->product->find($id)->update($dataProductUpdate);
            $product = $this->product->find($id);

            //Indsert data to product_images
            if ($request->hasFile('image_path')) {
                $this->productImage->where('product_id' , $id)->delete();
                foreach ($request->image_path as $fileItem) {
                    $dataProductImageDetail = $this->storageTraitUploadMutiple($fileItem, 'product');
                    $product->images()->create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name'],
                    ]);
                }
            }
            // Insert tags for product

            if (!empty($request->tags)) {
                foreach ($request->tags as $tagItem)
                {
                    $tagInstance = $this->tag->firstOrCreate(['name' => $tagItem]);
                    $tagIds[] = $tagInstance->id;
                    $product->tags()->sync($tagInstance);
                }
            }
//            $product->tags()->sync($tagIds);
            DB::commit();
            return redirect()->route('product.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log:: error('Messeage:' .$exception->getMessage() . '----line :' . $exception->getLine() );
        }
    }
    public function delete($id)
    {
        return $this->deleteModelTrait($id , $this->product);
    }
}



