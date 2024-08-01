@extends('layouts.app')
@section('content')
    <h1>Fibonacci Execution Times</h1>

    <h2>Naive Recursive Fibonacci Execution Times</h2>
    <div class="table-responsive mt-5" bis_skin_checked="1">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>Input Size</th>
                <th>Execution Time (seconds)</th>
                <th>Result</th>
            </tr>
            </thead>
            <tbody>

            @foreach($naiveResults as $result)
                <tr>
                    <td>{{ $result['input'] }}</td>
                    <td>{{ $result['time']['time'] }}</td>
                    <td>{{ $result['time']['result'] }}</td>
                </tr>
            @endforeach


            </tbody>
        </table>
    </div>
    <h2>Optimized Iterative Fibonacci Execution Times</h2>
    <div class="table-responsive mt-5" bis_skin_checked="1">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>Input Size</th>
                <th>Execution Time (seconds)</th>
                <th>Result</th>
            </tr>
            </thead>
            <tbody>
            @foreach($optimizedResults as $result)
                <tr>
                    <td>{{ $result['input'] }}</td>
                    <td>{{ $result['time']['time'] }}</td>
                    <td>{{ $result['time']['result'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <h2>Memoized Recursive Fibonacci Execution Times</h2>
    <div class="table-responsive mt-5" bis_skin_checked="1">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>Input Size</th>
                <th>Execution Time (seconds)</th>
                <th>Result</th>
            </tr>
            </thead>
            <tbody>
            @foreach($memoizedResults as $result)
                <tr>
                    <td>{{ $result['input'] }}</td>
                    <td>{{ $result['time']['time'] }}</td>
                    <td>{{ $result['time']['result'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <p>
        Naive Recursive: This approach has exponential time complexity
        𝑂(2𝑛). It's not efficient for larger values of 𝑛.
        <br><br>

        Memoized Recursive: This approach uses memoization to cache previously computed results, reducing the time complexity to 𝑂(𝑛).
        <br><br>
        Optimized Iterative: This approach iterates through the sequence, also with a time complexity of 𝑂(𝑛).

        <br><br>
        Memoization and the iterative approach should show significantly better performance for larger values of 𝑛 compared to the naive recursive approach.
    </p>
@endsection
