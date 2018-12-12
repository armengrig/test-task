<?php

function sieve($n) {
    $limit = intval(sqrt($n));
    $A = array_fill(1, $n, true);
    for ($i = 2; $i <= $limit; $i++) {
        if ($A[$i - 1]) {
            for ($j = $i * $i; $j <= $n; $j += $i) {
                $A[$j - 1] = false;
            }
        }
    }
    $result = array();
    foreach ($A as $i => $is_prime) {
        if ($is_prime) {
            $result[] = $i + 1;
        }
    }
    return $result;
}

function calculateSumPrime($primesCount, $primes) {
    $sumArray = [];
    $sum = 0;
    for ($i = 0; $i <= $primesCount; $i++) {
        $sum = $primes[$i] + $sum;
        array_push($sumArray, $sum);
    }

    return $sumArray;
}

function binarySearch(Array $arr, $x)
{
    // check for empty array
    if (count($arr) === 0) return false;
    $low = 0;
    $high = count($arr) - 1;

    while ($low <= $high) {

        // compute middle index
        $mid = floor(($low + $high) / 2);

        // element found at mid
        if($arr[$mid] == $x) {
            return true;
        }

        if ($x < $arr[$mid]) {
            // search the left side of the array
            $high = $mid -1;
        }
        else {
            // search the right side of the array
            $low = $mid + 1;
        }
    }

    // If we reach here element x doesnt exist
    return false;
}

$limit = 1000;
$result = 0;
$numberOfPrimes = 0;
$primes = sieve($limit);
$primeSum = calculateSumPrime(count($primes) -1 , $primes );

$primeSum[0] = 0;

for ($i = 0; $i < count($primes); $i++) {
    $primeSum[$i+1] = $primeSum[$i] + $primes[$i];
}


for ($i = $numberOfPrimes; $i < count($primeSum); $i++) {
    for ($j = $i-($numberOfPrimes+1); $j >= 0; $j--) {
        if ($primeSum[$i] - $primeSum[$j] > $limit) break;

        if (binarySearch($primes, $primeSum[$i] - $primeSum[$j])) {
            $numberOfPrimes = $i - $j;
            $result = $primeSum[$i] - $primeSum[$j];
        }
    }
}
echo 'Largest primes below ' .$limit. ' written as consequtive primes is ' .$result.'<br/>';
echo 'It consists of '.$numberOfPrimes.' primes';
