@extends('layout.header')
@section('title', 'JavaScript一覧画面')
@section('content')



<script>

    const promiseFunc = (value) => {
        return new Promise((resolve, reject) => {
            setTimeout(() => resolve(value), 1000)
        });
    };

    // promiseの書き方
    promiseFunc(1)
    .then((num) => {
        console.log(num);
        return promiseFunc(2)
    })
    .then((num) => {
        console.log(num);
        return promiseFunc(3);
    })
    .then((num) => {
        console.log(num);
    });

    // async/awaitの書き方
    const asyncFunc = async() => {
        console.log(await promiseFunc(1));
        console.log(await promiseFunc(2));
        console.log(await promiseFunc(3));
    }
    asyncFunc();

</script>

@endsection
