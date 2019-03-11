<?php
declare(strict_types=1);
require_once __DIR__."/app/bootstrap.php";

use App\Core\Mysql as Mysql;
use App\Helpers\CategoryAmountAggregatorHelper as CategoryAmountAggregatorHelper;
use App\Views\CategoryAmountAggregatorView as CategoryAmountAggregatorView;
    

//can use group by sql as well
// $sql = "select category, subcategory, sum(amount) as amount from dataset " .
//      "group by category, subcategory  " .
//      "order by category asc, subcategory asc";

//can use query with out group by
$sql = "select * from dataset";
$mysql = new Mysql($ini_array["DB_HOST"], $ini_array["DB_USER"], $ini_array["DB_PASS"], $ini_array["DB_NAME"]);
$dataset = $mysql->executeRawQuery($sql);

$report = new CategoryAmountAggregatorHelper($dataset);
$aggregatedDataSet = $report->getAggregatedDataSet();


echo CategoryAmountAggregatorView::displayCategoryAmountTable($aggregatedDataSet);
?>