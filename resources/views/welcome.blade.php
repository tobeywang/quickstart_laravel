@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>

                <div class="panel-body">
                    Your Application's Landing Page.
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div>
            <p>Take a Show</p>
            <img src="data:{{$conttenttype}}};base64, {{ $body }}" alt="Red dot" />
          </div>
    </div>
</div>
@endsection
