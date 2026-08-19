@extends('layouts.app')
@section('content_title', 'Dashboard')
@section('content')
<div class="card">
    <div class="card-body">
        welcome to LUNCH ORDER PT SERAPHIM DIGITAL TECHNOLOGY, <strong class="capitalize">{{ auth()->user()->name }}</strong>
    </div>
</div>

@endsection