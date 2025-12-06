@extends('translation::layout')

@section('body')

    <div class="panel w-1/2">

        <div class="panel-header">

             
             {{ config('translation.en.add_language') }}

        </div>

        <form action="{{ route('languages.store') }}" method="POST">

            <fieldset>

                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="panel-body p-4">

                    @include('translation::forms.text', ['field' => 'name', 'label' => config('translation.en.language_name') ])

                    @include('translation::forms.text', ['field' => 'locale', 'label' => config('translation.en.locale') ])

                </div>

            </fieldset>

            <div class="panel-footer flex flex-row-reverse">

                <button class="button button-blue">
                   {{ config('translation.en.save') }}

                    
                </button>

            </div>

        </form>

    </div>

@endsection