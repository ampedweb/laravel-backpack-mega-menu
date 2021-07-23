@extends('crud::create')
@section('content')
    <div class="row">
        <div class="{{ $crud->getCreateContentClass() }}">
            <!-- Default box -->

            @include('crud::inc.grouped_errors')

            <form method="post"
                  action="{{ url($crud->route) }}"
                  @if ($crud->hasUploadFields('create'))
                  enctype="multipart/form-data"
                @endif
            >
            {!! csrf_field() !!}
            <!-- load the view from the application if it exists, otherwise load the one in the package -->
                @if(view()->exists('vendor.backpack.crud.form_content'))
                    @include('vendor.backpack.crud.form_content', [ 'fields' => $crud->fields(), 'action' => 'create' ])
                @else
                    @include('crud::form_content', [ 'fields' => $crud->fields(), 'action' => 'create' ])
                @endif

                @include('vendor.mega_menu.partials.mega_menu')

                @include('crud::inc.form_save_buttons')
            </form>
        </div>
        @endsection
        @push('after_scripts')
            <script src="{{ asset('packages/ampedweb/js/mega-menu-app.js') }}"></script>
        @endpush
