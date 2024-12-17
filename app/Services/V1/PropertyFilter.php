<?php
namespace App\Services\V1;

use App\Services\ApiFilter;

class PropertyFilter extends ApiFilter{
    protected $safeParms = [
        'hostId' => ['eq'],
        'propertyType' => ['eq'],
        'propertyCountry' => ['contain'],
        'propertyCity' => ['contain'],
        'propertyPrice' => ['gt', 'lt'],
        'propertyCapacity' => ['gt', 'lt'],
        'propertyStatus' => ['eq'],
        'checkInDate' => ['eq'],
        'checkOutDate' => ['eq'],
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
        'hostId' => 'host_id',
        'propertyType' => 'property_type',
        'propertyCountry' => 'property_country',
        'propertyCity' => 'property_city',
        'propertyPrice' => 'property_price',
        'propertyCapacity' => 'property_capacity',
        'propertyStatus' => 'property_status',
        'checkInDate' => 'check_in_date',
        'checkOutDate' => 'check_out_date',
    ];
}