<?php
namespace App\Traits;
use Illuminate\Support\Facades\Log;

trait  deleteModelTraits {
    public function deleteModelTrait( $id, $model)
    {
        try {
          $model->find($id)->delete();
            return Response()->json([
                'code' => 200,
                'message' => 'success'
            ], status: 200);

        } catch (\Exception $exception) {

            Log:: error('Messeage:' .$exception->getMessage() . '----line :' . $exception->getLine() );
            return Response()->json([
                'code' => 500,
                'message' => 'fail'
            ], status: 500);
        }
    }
}