<?php

namespace Aryanhasanzadeh\Translator\App\Http\Controllers;

use Aryanhasanzadeh\Translator\App\Http\Resources\TranslateResource;
use Aryanhasanzadeh\Translator\App\Models\Repository\TranslateRepository;
use Aryanhasanzadeh\Translator\App\Models\Translate;
use Illuminate\Http\Request;

/**
 * @group Translator
*/

class TranslatorController extends ApiController
{

    protected TranslateRepository $transRepo;

    public function __construct(TranslateRepository $transRepo)
    {
        $this->transRepo=$transRepo;
    }

    /**
     * get list of Translate
     * 
    */
    public function index(Request $request)
    {
        $this->validate($request,[

        ]);

        try {
            $this->successResponse([
                'translators'=>TranslateResource::collection($this->transRepo->get($request))
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            $this->errorResponse([],500,$th->getMessage());
        }
    }


    /**
     * get specified Translate
     * 
     * @urlParam id required the id of the translate
    */
    public function show(Translate $translate)
    {
        try {
            $this->successResponse([
                'translate'=>TranslateResource::make($translate)
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            $this->errorResponse([],500,$th->getMessage());
        }
    }

    /**
     * Update the Specified Translate
     * 
     * @urlParam id required the id of the translate
     * 
     * @bodyParam data string required New text  to be replaced. Example: new text
    */
    public function update(Request $request,Translate $translate)
    {
        $this->validate($request,[
            'data' => 'required|string|max:'.config('Translator.base_api_max_char_size'),
        ]);

        try {
            $this->successResponse([
                'translate'=>TranslateResource::make($this->transRepo->setTranslate($translate)->update($request->data)->getTranslateModel())
            ]);

        } catch (\Throwable $th) {
            //throw $th;
            $this->errorResponse([],500,$th->getMessage());
        }
    }

    /**
     * Remove the specified translate
     * 
     * 
     * @urlParam id integer required The ID of the translate
     * 
    */
    public function destroy(Translate $translate)
    {
        try {

            $this->transRepo->setTranslate($translate)->delete();

            $this->successResponse([
            ],400,'item delete successfully');
        } catch (\Throwable $th) {
            //throw $th;
            $this->errorResponse([],500,$th->getMessage());
        }
    }
}
