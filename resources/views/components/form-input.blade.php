@props(['label','name','type'=>'text','value'=>''])

<label for="{{$name}}" class="from-label">{{$label}}</label>
<input type="{{$type}}" name="{{$name}}" id="{{$name}}" value="{{old($name,$value)}}"
    {{$attributes->merge(['class'=>'form-control'])}}>