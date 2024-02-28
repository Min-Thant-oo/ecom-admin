{{-- type default is text --}}
@props(['name', 'type'=>'text', 'class'=>'', 'value'=>''])
<div class="form-group">
    <label 
        for="{{$name}}"
    >
        {{ucwords($name)}}
    </label>
    <input 
        type="{{$type}}" 
        name="{{$name}}" 
        {{-- first parameter of old function is for when the validation fails 
             second parameter is for edit page --}}
        value="{{old($name, $value)}}" 
        class="form-control rounded-md {{$class}}" 
        id="{{$name}}" 
        placeholder="Please Enter {{ucwords($name)}}"
        step="0.01" 
    >
    <x-error :name='$name' />
</div>