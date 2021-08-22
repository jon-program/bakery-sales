<?php

// ◯インプット例

// 1 10 2 3 5 1 7 5 10 1

// ◯アウトプット例

// 2464
// 1
// 5 10

// ◯実行コマンド例
// php quiz.php 1 10 2 3 5 1 7 5 10 1

const TAX = 1.1;
$price = [
    1 => 100,
    2 => 120,
    3 => 150,
    4 => 250,
    5 => 80,
    6 => 120,
    7 => 100,
    8 => 180,
    9 => 50,
    10 => 300,
];

function getInputValue(): array
{
    $inputValue = array_slice($_SERVER['argv'], 1);
    $salesFigures = array_chunk($inputValue, 2);

    return $salesFigures;
}

function calculateTotalPrice(array $salesFigures, array $price): float
{
    $sales = [];
    foreach ($salesFigures as $salesFigure) {
        $itemNumber = $salesFigure[0];
        $salesFigure = $salesFigure[1];
        $itemPrice = $price[$itemNumber];
        $prices = [$itemPrice * $salesFigure];
        $sales = array_merge($sales, $prices);
    }

    $taxIncludedPrice = array_sum($sales) * TAX;

    return $taxIncludedPrice;
}

function maxSalesFigure(array $salesFigures): array
{
    $maxSalesFigure = 0;
    foreach ($salesFigures as $salesFigure) {
        $maxSalesFigure = max($maxSalesFigure, $salesFigure[1]);
    }

    $maxSalesItemNumbers = [];
    foreach ($salesFigures as $salesFigure) {
        if ($salesFigure[1] === $maxSalesFigure) {
            $maxSalesItemNumbers = array_merge($maxSalesItemNumbers, [$salesFigure[0]]);
        }
    }

    return $maxSalesItemNumbers;
}

function minSalesFigure(array $salesFigures): array
{
    $minSalesFigure = $salesFigures[0][1];
    foreach ($salesFigures as $salesFigure) {
        $minSalesFigure = min($minSalesFigure, $salesFigure[1]);
    }

    $minSalesItemNumbers = [];
    foreach ($salesFigures as $salesFigure) {
        if ($salesFigure[1] === $minSalesFigure) {
            $minSalesItemNumbers = array_merge($minSalesItemNumbers, [$salesFigure[0]]);
        }
    }

    return $minSalesItemNumbers;
}

function displayValue(float $taxIncludedPrice, array $maxSalesItemNumbers, array $minSalesItemNumbers): void
{
    echo $taxIncludedPrice . PHP_EOL;

    foreach ($maxSalesItemNumbers as $maxSalesItemNumber) {
        echo $maxSalesItemNumber . ' ';
    }

    echo '' . PHP_EOL;

    foreach ($minSalesItemNumbers as $minSalesItemNumber) {
            echo $minSalesItemNumber . ' ';
    }

    echo '' . PHP_EOL;
}

$salesFigures = getInputValue();
$taxIncludedPrice = calculateTotalPrice($salesFigures, $price);
$maxSalesItemNumbers = maxSalesFigure($salesFigures);
$minSalesItemNumbers = minSalesFigure($salesFigures);
displayValue($taxIncludedPrice, $maxSalesItemNumbers, $minSalesItemNumbers);
