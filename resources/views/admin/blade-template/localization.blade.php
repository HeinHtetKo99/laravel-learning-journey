@extends('admin.layouts.app')

@section('title','localization')

@section('style')
    <style>
        h1{
            background-color : orange;
            color : white ; 
            text-align : center;
            padding : 10px
        }
    </style>

@section('header',__('localization.localization'))

@section('content')
    <h1>{{ __('localization.localization') }}</h1>
    <form action="{{ url('/admin/blade-template/localization')}}" method="post">
        @csrf()
        <div class="mb-3">
            <label class="form-label">{{ __('localization.select_language') }}</label>
            <select class="form-select" name="lang">
                <option value="en">{{ __('localization.english') }}</option>
                <option value="mm">{{ __('localization.myanmar') }}</option>
            </select>
        </div>
        <div class="mb-3">  
            <button class="btn btn-primary">{{ __('localization.change_language') }}</button>
        </div>
    </form>

    @if(session()->get('lang') == 'mm')
        <h5>{{ __('localization.chose_myanmar_language') }}</h5>
    @else
        <h5>{{ __('localization.chose_english_language') }}</h5>
    @endif
@endsection

@section('script')
        <script>
            
        </script>
@endsection