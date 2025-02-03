<?php
namespace App\Services;

use Illuminate\Http\Request;

class ApiFilter {
    protected $safeParms = [];

    protected $operatorMap = [];

    protected $columnMap = [];
    
    
    public function transform(Request $request) {
        $eloQuery = [];
        foreach ($this->safeParms as $parm => $operators) {
            $query = $request->query($parm);

            if (!isset($query)) {
                continue;
            }

            $column = $this->columnMap[$parm] ?? $parm;

            foreach ($operators as $operator) {
                if ($operator === 'contain' && isset($query['contain'])) {
                    $eloQuery[] = [$column, 'LIKE', '%' . $query['contain'] . '%'];
                } elseif (isset($query[$operator])) {
                    $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }
    
    
        return $eloQuery;
    }
}