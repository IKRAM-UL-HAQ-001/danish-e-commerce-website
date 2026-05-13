@extends('frontend.layouts.app')

@section('title', 'Terms and Conditions')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h1 class="mb-4">Terms and Conditions</h1>
            <div class="card">
                <div class="card-body">
                    {!! $term ? nl2br(e($term->content)) : 'No terms and conditions set yet.' !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
