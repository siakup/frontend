@props(['value' => false, 'variant' => 'default'])

@php
  $variants = [
    'default' => [
      'imgSource' => asset('components/toggle-on-disabled-false.svg'),
      'span' => 'text-[#262626] font-bold leading-5.5'
    ],
    'readonly' => [
      'imgSource' => asset('components/toggle-on-disabled-true.svg'),
      'span' => 'text-[#8C8C8C] font-semibold pl-4'
    ]
  ]   
@endphp

<div 
  class="flex items-center gap-3 m-2"
  x-data="{
    value: @js($value),
    variant: @js($variant),
    variants: @js($variants),
    offSrc: @js(asset('components/toggle-off-disabled-true.svg')),
    onSrc: @js($variants[$variant]['imgSource']),
    onClick () {
      if(this.variant !== 'readonly') {
        this.value = ! this.value;
      }
    }
  }"
  x-modelable="value"
  x-model="{{$attributes->whereStartsWith('x-model')->first()}}"
>
  <label class="whitespace-nowrap text-[#262626] text-sm font-semibold flex w-[200px] items-center gap-2" for="status">Status</label>
  <button 
    type="button"
    class="p-0 border-none bg-transparent outline-none flex items-center cursor-pointer gap-4" 
    x-on:click="onClick()"
  >
      <img 
        src="{{ asset('components/toggle-off-disabled-true.svg') }}" 
        x-bind:src="value ? onSrc : offSrc"
        alt="Toggle Icon" 
      />
      <span class="text-sm {{ $variants[$variant]['span'] }}" x-text="value ? 'Aktif' : 'Tidak Aktif'">Tidak Aktif</span>
  </button>
  <input type="hidden" x-model="value">
</div>