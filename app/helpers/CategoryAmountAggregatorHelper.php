<?php
declare(strict_types=1);

namespace App\Helpers;

/**
* simple class to aggregate the category amount dataset
*
*/
class CategoryAmountAggregatorHelper 
{

    private $dataSet = array();

    /**
    * Constructor function
    *
    * @param array $dataSet (dataset of objects containing category, subcategory and amount fields)
    */
    public function __construct(array $dataSet) {
        $this->dataSet = $dataSet;
    }


    /**
    * orders dataset element by catgory in acending order
    * @param  array $dataSet (dataset of objects containing category, subcategory and amount fields)
    *
    * @return array $dataSet (return new dataset order by category in acending order)
    */
    private function orderByCategory(array $dataSet): array
    {

        if(count($dataSet) === 0) {
            return $dataSet;
        }

        usort($dataSet, function ($a, $b) {
            return strcmp($a->category, $b->category);
        });
        return $dataSet;
    }

    /**
    * orders dataset element by sub catgory in acending order
    *
    * @param  array $dataSet (dataset of objects containing category, subcategory and amount fields)
    *
    * @return array $dataSet (return new dataset order by subcategory in acending order)
    */
    private function orderBySubCategory(array $dataSet): array
    {

        if(count($dataSet) === 0) {
            return $dataSet;
        }
        usort($dataSet, function ($a, $b) {
            if ($a->category === $b->category) {
                return ($a->subcategory>$b->subcategory);  
            }
            return 0;
        });
        return $dataSet;
    }


    /**
    * sum up amount by subcategory 
    *
    * @param  array $dataSet (dataset of objects containing category, subcategory and amount fields)
    *
    * @return array $dataSet (return new dataset with amount summed up for subcategory)
    */
    private function sumUpAmountBySubCategory(array $dataSet): array
    {

        if(count($dataSet) === 0) {
            return $dataSet;
        }

        //sum amount by grouped by sub category
        $tmpArray = array();
        foreach($dataSet as $key => $obj) {
            $category = $obj->category;
            $subcategory = $obj->subcategory;
            if(isset($tmpArray[$category][$subcategory])) {
                $tmpArray[$category][$subcategory] += $obj->amount;   
            } else {
                $tmpArray[$category][$subcategory] = $obj->amount;   
            }
        }

        //create new dataset with aggregrated amount for sub category
        $newDataSet = array();
        foreach ($tmpArray as $categoryKey => $arrVal) {
            foreach ($arrVal as $subcategoryKey => $val) {
                $obj = (object) array('category' => $categoryKey, 'subcategory' => $subcategoryKey, 'amount' => $val);
                $newDataSet[] = $obj;
            }
        }

        return $newDataSet;
    }


    /**
    * add aggregate row grouped by category
    * 
    * @param  array $dataSet (dataset of objects containing category, subcategory and amount fields)
    *
    * @return array $dataSet (return new dataset with row total, summed by category)
    */
    private function addTotalRow(array $dataSet): array
    {
        $newDataSet = $dataSet;
        $newCategory = "";
        $totalByCategory = 0;
        $offsetIndex = 0;

        if(count($dataSet) === 0) {
            return $dataSet;
        }

        foreach($dataSet as $key => $obj) {
            if($obj->category !== $newCategory) {
               if($key !== 0) {
                  $totalRowObj = (object) array(
                      "category" => "Total", 
                      "subcategory" => "", 
                      "amount" => $totalByCategory
                  );

                  array_splice($newDataSet, $key+$offsetIndex, 0, array($totalRowObj));
                  $offsetIndex++;
                }
                $newCategory = $obj->category;
                $totalByCategory = $obj->amount;
            } else {
                $totalByCategory += $obj->amount;
            }
        }

        $newDataSet[] = (object) array(
            "category" => "Total", 
            "subcategory" => "", 
            "amount" => $totalByCategory
        );;
        return $newDataSet;
    }

    /**
    * aggregate dataset with, and add total row for each category for 
    * the dataset containing category, 
    *
    * subcategory and amount field
    * @param  array $dataSet (dataset of objects containing category, subcategory and amount fields)
    *
    * @return array $dataSet (return new dataset with row total, summed by category)
    */
    public function getAggregatedDataSet()
    {
        $newDataSet = $this->OrderByCategory($this->dataSet);
        $newDataSet = $this->OrderBySubCategory($newDataSet);
        $newDataSet = $this->sumUpAmountBySubCategory($newDataSet);
        $newDataSet = $this->addTotalRow($newDataSet);
        return $newDataSet;
    }

}
?>
