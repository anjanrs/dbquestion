<?php
use App\Helpers\CategoryAmountAggregatorHelper as CategoryAmountAggregatorHelper;
use PHPUnit\Framework\TestCase ;

class CategoryAmountAggregatorHelperTest extends TestCase
{
    public function testAggregateCategoryAmountDataSet()
	{
		$dataSet = [
			(object) array('category' => 'A', 'subcategory' => '1', 'amount' => '53'),
			(object) array('category' => 'A', 'subcategory' => '4', 'amount' => '65'),
			(object) array('category' => 'A', 'subcategory' => '1', 'amount' => '58'),
			(object) array('category' => 'A', 'subcategory' => '5', 'amount' => '60'),
			(object) array('category' => 'B', 'subcategory' => '2', 'amount' => '10'),
			(object) array('category' => 'B', 'subcategory' => '5', 'amount' => '86'),
			(object) array('category' => 'B', 'subcategory' => '3', 'amount' => '75'),
			(object) array('category' => 'B', 'subcategory' => '2', 'amount' => '36'),
			(object) array('category' => 'C', 'subcategory' => '4', 'amount' => '20'),
			(object) array('category' => 'C', 'subcategory' => '3', 'amount' => '58'),
			(object) array('category' => 'C', 'subcategory' => '5', 'amount' => '44'),
			(object) array('category' => 'C', 'subcategory' => '4', 'amount' => '76'),
			(object) array('category' => 'A', 'subcategory' => '5', 'amount' => '66'),
			(object) array('category' => 'B', 'subcategory' => '3', 'amount' => '15'),
			(object) array('category' => 'C', 'subcategory' => '2', 'amount' => '87')
		];

		$resultDataSet = [
			(object) array('category' => 'A', 'subcategory' => '1', 'amount' => '111'),
			(object) array('category' => 'A', 'subcategory' => '4', 'amount' => '65'),
			(object) array('category' => 'A', 'subcategory' => '5', 'amount' => '126'),
			(object) array('category' => 'Total', 'subcategory' => '', 'amount' =>'302'),
			(object) array('category' => 'B', 'subcategory' => '2', 'amount' => '46'),
			(object) array('category' => 'B', 'subcategory' => '3', 'amount' => '90'),
			(object) array('category' => 'B', 'subcategory' => '5', 'amount' => '86'),
			(object) array('category' => 'Total', 'subcategory' => '', 'amount' =>'222'),
			(object) array('category' => 'C', 'subcategory' => '2', 'amount' => '87'),
			(object) array('category' => 'C', 'subcategory' => '3', 'amount' => '58'),
			(object) array('category' => 'C', 'subcategory' => '4', 'amount' => '96'),
			(object) array('category' => 'C', 'subcategory' => '5', 'amount' => '44'),
			(object) array('category' => 'Total', 'subcategory' => '', 'amount' =>'285')
		];

	    $aggregatorHelper = new CategoryAmountAggregatorHelper($dataSet);
	    $this->assertEquals($resultDataSet, $aggregatorHelper->getAggregatedDataSet());
	}
}
?>