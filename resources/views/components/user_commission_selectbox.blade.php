<div class="col-md-6">
    <div class="text-start">
        <label class="form-label" style="color: #d33a9e">
            {{ $label }}
        </label>
    </div>
    <div class="input-group input-group-outline my-3 mt-1">
        <select class="form-control" name="{{ $name }}">
            @php
                $values = [];
                for ($i = 0; $i <= $max; $i += 0.01) {
                    $values[] = $i;
                }

                rsort($values);
            @endphp
            @foreach ($values as $value)
                @php
                    $selected = $attributes->get('value') ? $attributes->get('value') == $value : false;
                @endphp
                <option {{ $selected ? 'selected' : '' }}>{{ $value }}</option>
            @endforeach
        </select>
    </div>
    @error($name)
        <span class="d-block text-danger">*{{ $message }}</span>
    @enderror
</div>
