@extends('indigo-layout::installation')

@section('meta_title', _p('chromator::pages.installation.meta_title', 'Installation chromator') . ' - ' . config('app.name'))
@section('meta_description', _p('chromator::pages.installation.meta_description', 'Installation chromator in application'))

@push('head')

@endpush

@section('title')
    <h2>{{ _p('chromator::pages.installation.headline', 'Installation chromator') }}</h2>
@endsection

@section('content')
    <form-builder disabled-dialog="" url="{{ route('chromator.installation.index') }}" send-text="{{ _p('chromator::pages.installation.send_text', 'Install') }}"
    edited>
        <div class="section">
            <ul>
                <li>
                    {{ _p('chromator::pages.installation.will_be_execute_migrations', 'Will be execute package migrations') }}
                </li>
            </ul>
        </div>
    </form-builder>
@endsection
