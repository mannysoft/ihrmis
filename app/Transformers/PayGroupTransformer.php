<?php
namespace App\Transformers;

use App\Models\PayGroup;
use League\Fractal;

class PayGroupTransformer extends Fractal\TransformerAbstract
{
    public function transform(PayGroup $group)
    {
        return [
            'id'      => (int) $group->id,
            'name'   => $group->name,
            // 'year'    => (int) $book->yr,
            // 'links'   => [
            //     [
            //         'rel' => 'self',
            //         'uri' => '/books/'.$book->id,
            //     ]
            // ],
        ];
    }
}