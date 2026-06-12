@if (isset($attribute) and is_object($attribute))
    <div class="bg-white" style="background: #ddd; border-radius:5px; padding:1em; margin-bottom:1em; display:block">

        @foreach ($attribute->contentAattributeFields as $field)
        <input type="hidden" name="content_type_id" value="{{ $attribute->id }}">
        <?php
        // echo ($field->field_name);
        ?>
        <div class="col-6 col-md-6 col-xs-12">
            @include('admin.attribute.'.ucfirst($field->element_type))
        </div>
        @endforeach
    </div>
@endif
