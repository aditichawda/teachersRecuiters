{{--
  @param array $institutionTypeGroups  from institution-type-groups.php
  @param array|null $selectedValues   multiple select: array of selected values
  @param string|null $selectedValue   single select: one value
--}}
@php
    $selectedValues = isset($selectedValues) ? $selectedValues : null;
    $selectedValue = isset($selectedValue) ? $selectedValue : null;
@endphp
@foreach($institutionTypeGroups as $groupKey => $group)
    <optgroup label="{{ $group['label'] }}">
        @foreach($group['options'] as $val => $lbl)
            @php
                $isSel = false;
                if ($selectedValue !== null && $selectedValue !== '') {
                    $isSel = (string) $selectedValue === (string) $val;
                } elseif ($selectedValues !== null) {
                    $arr = (array) $selectedValues;
                    $isSel = in_array($val, $arr, true)
                        || in_array(str_replace('-', '_', $val), $arr, true);
                }
            @endphp
            <option value="{{ $val }}" @if($isSel) selected @endif>{{ $lbl }}</option>
        @endforeach
    </optgroup>
@endforeach
