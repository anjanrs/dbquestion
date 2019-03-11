<?php
declare(strict_types=1);

namespace App\Views;

class CategoryAmountAggregatorView 
{
    /**
    * helper function to just pring the dataset in a html table
    *
    * @param array $dataset   (dataset containg collectoin of objects with fields category, subcategroy, amount)
    *
    * @return string $htmlStr (html string represenation of dataset in a html table)
    */
    static function displayCategoryAmountTable(array $newDataSet): string
    {

        $htmlStr = "<table style='width:50%;text-align: left;'>";
        $htmlStr .= "<tr><th>Category</th><th>Sub Category</th><th>Amount</th></tr>";
        foreach ($newDataSet as $key => $obj) {
            $htmlStr .= "<tr>";    
            $htmlStr .= "<td>" . $obj->category . "</td>";
            $htmlStr .= "<td>" . $obj->subcategory . "</td>";
            $htmlStr .= "<td>" . $obj->amount . "</td>";
            $htmlStr .= "</tr>";    
        }
        $htmlStr .= "</table>";
        return $htmlStr;
    }    
}
?>