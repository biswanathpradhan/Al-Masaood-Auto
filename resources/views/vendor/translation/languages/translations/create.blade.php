@extends('translation::layout')

@section('body')

    <div class="panel w-1/2">

        <div class="panel-header">

  
            {{ config('translation.en.add_translation') }}



        </div>

        <form action="{{ route('languages.translations.store', $language) }}" method="POST">

            <fieldset>

                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="panel-body p-4">

                    @include('translation::forms.text', ['field' => 'group', 'label' =>  config('translation.en.group_label')  , 'placeholder' =>  config('translation.en.group_placeholder')])
                    
                    @include('translation::forms.text', ['field' => 'key', 'label' => config('translation.en.key_label') , 'placeholder' => config('translation.en.key_placeholder')])

                    @include('translation::forms.text', ['field' => 'value', 'label' => config('translation.en.value_label'), 'placeholder' => config('translation.en.value_placeholder')])
                    
                    <div class="input-group">

                        <button v-on:click="toggleAdvancedOptions" class="text-blue">{{ config('translation.en.advanced_options') }}</button>

                    </div>

                    <div v-show="showAdvancedOptions">

                        @include('translation::forms.text', ['field' => 'namespace', 'label' => 
                        config('translation.en.namespace_label')
                        , 'placeholder' => 
                        config('translation.en.namespace_placeholder')
                        ])
                    
                    </div>

  
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