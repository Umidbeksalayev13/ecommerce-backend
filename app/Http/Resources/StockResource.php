<?php

namespace App\Http\Resources;

use App\Models\Attribute;
use App\Models\Value;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StockResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        $result = [
            'quantity'=>$this->quantity,

        ];

        return $this->getAttributes($result);

    }

    public function getAttributes(array $result)
    {
        $attributs =json_decode($this->attributes);
        foreach($attributs as $StockAttribut){
            $attribute = Attribute::find($StockAttribut->attribute_id);
            $value = Value::find($StockAttribut->value_id);

            $result[$attribute->name] = $value->name;
        }
        return $result;
    }
}
