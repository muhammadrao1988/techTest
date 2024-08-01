<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FibonacciController extends Controller
{
    private $memo = [];

    public function fibonacciNaive($n) {
        if ($n <= 1) {
            return $n;
        }
        return $this->fibonacciNaive($n - 1) + $this->fibonacciNaive($n - 2);
    }

    public function fibonacciMemoized($n) {
        if (isset($this->memo[$n])) {
            return $this->memo[$n];
        }

        if ($n <= 1) {
            return $n;
        }

        $this->memo[$n] = $this->fibonacciMemoized($n - 1) + $this->fibonacciMemoized($n - 2);
        return $this->memo[$n];
    }

    public function fibonacciOptimized($n) {
        if ($n <= 1) {
            return $n;
        }

        $a = 0;
        $b = 1;

        for ($i = 2; $i <= $n; $i++) {
            $temp = $a + $b;
            $a = $b;
            $b = $temp;
        }

        return $b;
    }

    public function measureExecutionTime($func, $input) {
        $start = microtime(true);
        $result = call_user_func([$this, $func], $input);
        $end = microtime(true);
        return ['time' => $end - $start, 'result' => $result];
    }

    public function index(Request $request) {
        $inputSizes = [10, 20, 30, 35]; // Adjust the input sizes as needed
        $naiveResults = [];
        $memoizedResults = [];
        $optimizedResults = [];

        foreach ($inputSizes as $size) {
            $naiveResults[] = [
                'input' => $size,
                'time' => $this->measureExecutionTime('fibonacciNaive', $size)
            ];
        }

        foreach ($inputSizes as $size) {
            $memoizedResults[] = [
                'input' => $size,
                'time' => $this->measureExecutionTime('fibonacciMemoized', $size)
            ];
        }

        foreach ($inputSizes as $size) {
            $optimizedResults[] = [
                'input' => $size,
                'time' => $this->measureExecutionTime('fibonacciOptimized', $size)
            ];
        }

        return view('fibonacci.index', compact('naiveResults', 'memoizedResults', 'optimizedResults'));
    }
}
