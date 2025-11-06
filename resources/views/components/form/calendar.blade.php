@props(['value' => null, 'placeholder' => 'dd-mm-yyyy, hh:mm'])
<div 
  x-data="{
    value: @js($value),
    onInput: @js($attributes->get('oninput')),
    active: false,
    icon: this.active ? '{{ asset('assets/active/icon-calendar.svg') }}' : '{{ asset('assets/base/icon-calendar.svg') }}'
  }"
  class="border-[1px] border-[#BFBFBF] flex items-center justify-between rounded-lg w-full text-[#262626] py-2 px-4"
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
    onfocus="this.nextElementSibling.src = '{{ asset('assets/active/icon-calendar.svg') }}'"
    onblur="this.nextElementSibling.src = '{{ asset('assets/base/icon-calendar.svg') }}'"
    oninput="{{$attributes->get('oninput')}}"
    x-model="value"
  />
  <img src="{{ asset('assets/base/icon-calendar.svg') }}" alt="Icon Calendar" class="me-2.5">
</div>
