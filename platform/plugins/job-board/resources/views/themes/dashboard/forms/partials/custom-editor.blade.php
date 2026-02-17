@php
    
    $editor = new \Botble\Base\Supports\Editor();
    $editor->registerAssets();
    
    $attributes = Arr::set($attributes, 'class', Arr::get($attributes, 'class', 'form-control') . ' editor-' . setting('rich_editor', config('core.base.general.editor.primary')));
    
    $attributes['id'] = $name;
    $attributes['rows'] = 3;
    
@endphp

{!! Form::textarea($name, $value, $attributes) !!}

@push('scripts')
    <script>
        'use strict';

        var RV_MEDIA_URL = {
            base: '{{ url('') }}',
            filebrowserImageBrowseUrl: false,
            media_upload_from_editor: '{{ route('public.account.upload-from-editor') }}'
        }

        function setImageValue(file) {
            $('.mce-btn.mce-open').parent().find('.mce-textbox').val(file);
        }

        document.addEventListener('core-editor-init', function (ev) {
            ev.detail.tinyMceConfigUsing(function (config) {
                var sel = config.selector;
                if (typeof sel === 'string' && sel.indexOf('#') === 0) {
                    var id = sel.slice(1);
                    var $el = $('#' + id);
                    if ($el.length && $el.data('placeholder')) {
                        config.placeholder = $el.data('placeholder');
                    }
                }
                return config;
            });
        });
    </script>
    <iframe
        id="form_target"
        name="form_target"
        style="display:none"
    ></iframe>
    <form
        id="tinymce_form"
        style="width:0; height:0; overflow:hidden; display: none;"
        action="{{ route('public.account.upload-from-editor') }}"
        target="form_target"
        method="post"
        enctype="multipart/form-data"
    >
        @csrf
        <input
            id="upload_file"
            name="upload"
            type="file"
            onchange="$('#tinymce_form').submit();this.value='';"
        >
        <input
            name="upload_type"
            type="hidden"
            value="tinymce"
        >
    </form>
@endpush
