@extends('admin.layouts.app')

@section('title','component')

@section('style')

@section('header','component')

@section('content')
    @if(session()->get('lang') == 'mm')
        <h5>{{ __('localization.chose_myanmar_language') }}</h5>
    @else
        <h5>{{ __('localization.chose_english_language') }}</h5>
    @endif
    <pre>
        creating component
        ******************
        php artisan make:component Alert
 
        laravel component
        *****************
        (1) Component UI >>> (resources/view/components/...)
        (2) Component Controller (Business Logic) >>> (app/view/components/...)
 
        Component Attribute Databinding
        *******************************
        When you databind in the component attribute,
        There are two way ->
        (1) if you bind the value to the attribute, you can bind directly like the following example
            example > type="success"
        (2) if you bind the variable to the attribute, you can bind like the following example
            example > :type="$success"
 
        Note -
        (1) pass attribute value to Component Controller Constructor Arguments
        (2) assign the data from arguments to controller variables
        (3) bind controller variables to component user interface
    </pre>
    <h3>Components with static data</h3>
    <x-alert type="primary" title="Primary Alert" description="This is a primary alert"></x-alert>
    <x-alert type="warning" title="Warning Alert" description="This is a warning alert"></x-alert>
    <x-alert type="danger" title="Danger Alert" description="This is a danger alert"></x-alert>

    <h3>Components with dynamic data</h3>
    @foreach($alerts as $alert)
        <x-alert :type="$alert['type']" :title="$alert['title']" :description="$alert['description']"></x-alert>
    @endforeach

    <pre>
        Component assignment
        (1) button component
        (2) card component
    </pre>

    <hr>

    <h3>Child Slot</h3>
    <x-child-slot>
        <x-slot name="title">
            Card Title
        </x-slot>
        <x-slot name="description">
            Card Description
        </x-slot>
        <button class="btn btn-primary">Create</button>
    </x-child-slot>
    <x-child-slot>
        <x-slot name="title">
            Card Title-2
        </x-slot>
        <x-slot name="description">
            Card Description-2
        </x-slot>
        <button class="btn btn-danger">Create</button>
    </x-child-slot>
    <x-child-slot>
        <x-slot name="title">
            Card Title-3
        </x-slot>
        <x-slot name="description">
            Card Description-3
        </x-slot>
        <button class="btn btn-warning">Create</button>
    </x-child-slot>
@endsection

@section('script')
        <script>
            
        </script>
@endsection