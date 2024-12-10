<?php
namespace App\Services\V1;

use App\Services\ApiFilter;
use Illuminate\Http\Request;

class PropertyFilter extends ApiFilter{
    protected $safeParms = [
        'propertyType' => ['eq'],
        'propertyCountry' => ['contain'],
        'propertyCity' => ['contain'],
        'propertyPrice' => ['gt', 'lt'],
        'propertyCapacity' => ['gt', 'lt'],
        'propertyStatus' => ['eq']
    ];

    protected $operatorMap = [
        'eq' => '=',
        'gt' => '>',
        'lt' => '<',
        'lte' => '<=',
        'gte' => '>=',
        'contain' => 'LIKE',
    ];

    protected $columnMap = [
        
        'propertyType' => 'property_type',
        'propertyCountry' => 'property_country',
        'propertyCity' => 'property_city',
        'propertyPrice' => 'property_price',
        'propertyCapacity' => 'property_capacity',
        'propertyStatus' => 'property_status',
    ];
}