@props(['value' => null, 'placeholder' => 'dd-mm-yyyy, hh:mm'])
<div 
  x-data="{
    value: @js($value),
    onInput: @js($attributes->get('oninput')),
    active: false,
    icon: this.active ? '{{ asset('assets/icons/schedule/red-20.svg') }}' : '{{ asset('assets/icons/schedule/grey-20.svg') }}'
  }"
  class="border border-gray-500 flex items-center justify-between rounded-md w-full text-gray-800 py-2 px-4"
  x-on:click="$refs.input.focus()"
  x-modelable="value"
  x-model="{{$attributes->get('x-model')}}"
>
  <input 
    type="text"
    id="{{$attributes->get('id')}}" 
    class="{{ $attributes->get('class') }}bg-white outline-none border-none" 
    name="{{ $attributes->get('name') }}"
    value="{{ $value ?? '' }}"
    placeholder="{{ $placeholder }}"
    x-ref="input"
    x-on:focus="active = true"
    x-on:blur="active = false"
    onfocus="this.nextElementSibling.src = '{{ asset('assets/icons/schedule/red-20.svg') }}'"
    onblur="this.nextElementSibling.src = '{{ asset('assets/icons/schedule/grey-20.svg') }}'"
    oninput="{{$attributes->get('oninput')}}"
    x-model="value"
  />
  <img src="{{ asset('assets/icons/schedule/grey-20.svg') }}" alt="Icon Calendar" class="me-2.5">
</div>
