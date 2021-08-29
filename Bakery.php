<?php

const SPLIT_LENGTH = 2;
const TAX = 10;
const PRICE = [
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

/**
 * @param array<string> @argv
 * @return array<int, int>
 */
function getInput(array $argv): array
{
    $argument = array_slice($argv, 1);
    $arg = array_chunk($argument, SPLIT_LENGTH);

    $salesFigures = [];
    foreach ($arg as $salesData) {
        $salesFigures[$salesData[0]] = (int) $salesData[1];
    }
    return $salesFigures;
}

/**
 * @param array<int, int> $salesFigures
 * @return int
 */
function calculateTotalSales(array $salesFigures): int
{
    $sum = 0;
    foreach ($salesFigures as $itemNumber => $salesFigure) {
        $sum += $salesFigure * PRICE[$itemNumber];
    }
    return $sum * (100 + TAX) / 100;
}

/**
 * @param array<int, int> $salesFigures
 * @return array<int>
 */
function calculateMaxOfSalesFigures(array $salesFigures): array
{
    $max = max(array_values($salesFigures));
    return array_keys($salesFigures, $max);
}

/**
 * @param array<int, int> $salesFigures
 * @return array<int>
 */
function calculateMinOfSalesFigures(array $salesFigures): array
{
    $min = min(array_values($salesFigures));
    return array_keys($salesFigures, $min);
}

/**
 * @param array<int> $results
 */
function displaySalesData(array ...$results): void
{
    foreach ($results as $result) {
        echo implode(' ', $result) . PHP_EOL;
    }
}

$salesFigures = getInput($_SERVER['argv']);
$totalSales = calculateTotalSales($salesFigures);
$MaxOfSalesFigures = calculateMaxOfSalesFigures($salesFigures);
$MinOfSalesFigures = calculateMinOfSalesFigures($salesFigures);
displaySalesData([$totalSales], $MaxOfSalesFigures, $MinOfSalesFigures);
