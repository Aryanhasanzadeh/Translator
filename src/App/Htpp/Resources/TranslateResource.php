<?php

namespace Aryanhasanzadeh\Translator\App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TranslateResource extends JsonResource
{
    private $loc='en';
    
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return dd($this);

        if(isset($request->lang)){
            $this->loc=$request->lang;
        }

        return [
            '_id'=>$this->id,
            'lang'=>$this->lang,
            'type'=>[
                '_'=>intval($this->type),
                'name'=>$this->type == 0 ? "title" : "body",
            ],
            'data'=>$this->data,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
        ];
    }
}
