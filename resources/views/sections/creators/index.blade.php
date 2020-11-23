@extends('indigo-layout::main')

@section('meta_title', _p('chromator::pages.creator.meta_title', 'Creator') . ' - ' . config('app.name'))
@section('meta_description', _p('chromator::pages.creator.meta_description', 'Extension creator  in application'))

@push('head')

@endpush

@section('title')
    {{ _p('chromator::pages.creator.headline', 'Creator') }}
@endsection

@section('content')
    <div class="grid">
        <div class="cell-1-3 cell--dsm">
            <h4>{{ _p('chromator::pages.creator.create_extension', 'Create extension') }}</h4>
            <div class="card">
                <div class="card-body">
                    <p>{{ _p('chromator::pages.creator.description_create_your_extension', 'Create your Chrome extension') }}</p>
                   <div class="section">
                       <form-builder url="/" send-text="{{ _p('chromator::pages.creator.send_text', 'Create') }}"
                                     @send="(data) => {AWEMA._store.commit('setData', {param: 'createExtension', data: data}); AWEMA.emit('modal::create_extension_confirm:open')}"
                                     disabled-dialog>
                           <fb-input name="name_extension" label="{{ _p('chromator::pages.creator.name_extension', 'Name extension') }}"
                           hint=""></fb-input>
                           <small class="text-caption">{{ _p('chromator::pages.creator.hint_only_letters', 'You can only use letters') }}</small>
                          <div class="mt-20">
                              <fb-switcher name="with_package" label="{{_p('chromator::pages.creator.create_extension_with_package', 'Create an extension with the Laravel package.')}}"></fb-switcher>
                          </div>
                       </form-builder>
                   </div>
                </div>
            </div>
        </div>
    </div>
    <div class="grid section">
        <div class="cell-1-1 cell--dsm">
            <h4>{{ _p('chromator::pages.example.history_extensions', 'History extensions') }}</h4>
            <div class="card">
                <div class="card-body">
                    <content-wrapper :url="$url.urlFromOnlyQuery('{{ route('chromator.creator.scope')}}', ['page', 'limit'], $route.query)"
                        :check-empty="function(test) { return !(test && (test.data && test.data.length || test.length)) }"
                        name="histories_table">
                        <template slot-scope="table">
                            <table-builder :default="table.data">
                                <tb-column name="created_at" label="{{ _p('chromator::pages.creator.created_at', 'Created at') }}">
                                    <template slot-scope="col">
                                        @{{ col.data.created_at }}
                                    </template>
                                </tb-column>
                                <tb-column name="name" label="{{ _p('chromator::pages.creator.name', 'Name') }}"></tb-column>
                                <tb-column name="with_package" label="{{ _p('chromator::pages.creator.with_package', 'Created at') }}">
                                    <template slot-scope="col">
                                       <span v-if="col.data.with_package">
                                           {{ _p('chromator::pages.creator.yes', 'Yes') }}
                                       </span>
                                        <span v-else>
                                           {{ _p('chromator::pages.creator.no', 'No') }}
                                       </span>
                                    </template>
                                </tb-column>
                            </table-builder>
                            <paginate-builder
                                :meta="table.meta"
                            ></paginate-builder>
                        </template>
                        @include('indigo-layout::components.base.loading')
                        @include('indigo-layout::components.base.empty')
                        @include('indigo-layout::components.base.error')
                    </content-wrapper>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modals')

    <content-window name="create_extension_confirm" class="modal_formbuilder"
                  title="{{ _p('chromator::pages.creator.confirm_create', 'Confirm create') }}">
        <form-builder :edited="true" url="{{ route('chromator.creator.store') }}"
                      @sended="AWEMA.emit('content::histories_table:update')"
                      send-text="{{ _p('chromator::pages.creator.confirm', 'Confirm') }}" store-data="createExtension"
                      disabled-dialog>
            <fb-input name="name_extension" label="{{ _p('chromator::pages.creator.name_extension', 'Name extension') }}"></fb-input>
            <div class="mt-20">
                <fb-switcher name="with_package" label="{{_p('chromator::pages.creator.create_extension_with_package', 'Create an extension with the Laravel package.')}}"></fb-switcher>
            </div>
        </form-builder>
    </content-window>
@endsection
