
@if($photoPatch != false)
    <img src="{{ url($photoPatch) }}"
         style="width: 220px; height: 230px">
@else
    <img src="{{ url('uploads/images/default.png') }}" style="width: 220px; height: 230px">
@endif