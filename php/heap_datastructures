<?php

/*
 * Complete the 'runningMedian' function below.
 *
 * The function is expected to return a DOUBLE_ARRAY.
 * The function accepts INTEGER_ARRAY a as parameter.
 */

function runningMedian($a) {
    // Write your code here
    $results = [];
    $median = 0;
    $maxHeap = new SplMaxHeap();
    $minHeap = new SplMinHeap();

    foreach ($a as $item) {
        if ($item > $median) {
            $minHeap->insert($item);
        } else {
            $maxHeap->insert($item);            
        }

        if ($minHeap->count() > $maxHeap->count() + 1) {
            $maxHeap->insert($minHeap->top());
            $minHeap->extract();
        }
        if ($maxHeap->count() > $minHeap->count() + 1) {
            $minHeap->insert($maxHeap->top());
            $maxHeap->extract();
        }

        if ($minHeap->count() == $maxHeap->count()) {
            $median = ($maxHeap->top() + $minHeap->top()) / 2;
        } else if($minHeap->count() > $maxHeap->count()) {
            $median = (int)$minHeap->top();
        } else {
            $median = (int)$maxHeap->top();
        }

        array_push($results, round($median, 1));
    }

    return $results;    

}

$fptr = fopen(getenv("OUTPUT_PATH"), "w");

$a_count = intval(trim(fgets(STDIN)));

$a = array();

for ($i = 0; $i < $a_count; $i++) {
    $a_item = intval(trim(fgets(STDIN)));
    $a[] = $a_item;
}

$result = runningMedian($a);

fwrite($fptr, implode("\n", $result) . "\n");

fclose($fptr);
