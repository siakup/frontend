@props([
  'min' => null,
  'max' => null,
  'disabled' => false
])
<x-container.container 
  x-data="{
    value: 0,
    min: {{ json_encode($min) }},
    max: {{ json_encode($max) }},
    disabled: {{ json_encode($disabled) }},
    checkIsMax() {
      if(!this.disabled) {
        if(this.max == null) return false
        else if(this.value < this.max) return false
      } 
      return true
    },
    checkIsMin() {
      if(!this.disabled) {
        if(this.min == null) return false
        else if(this.value > this.min) return false
      } 
      return true
    },
    checkIsMinOrMax(value) {
      if(!this.disabled) {
        if((value <= this.max || this.max == null) && (value >= this.min || this.min == null)) this.value = value
        else {
          this.value = (value > this.max && this.max !== null) 
            ? this.max 
            : ((value < this.min && this.min !== null) ? this.min : 0)
        }
      }
    }
  }"
  class="w-max h-max flex flex-row justify-between items-center gap-3 p-2 rounded-sm border border-gray-400"
  x-modelable="value"
  x-model="{{$attributes->whereStartsWith('x-model')->first()}}"
>
  <div x-on:click="if(!checkIsMin()) value -= 1">
    <template x-if="checkIsMin()">
      <x-icon :name="'circle-remove/grey-16'" />
    </template>
    <template x-if="!checkIsMin()">
      <x-icon :name="'circle-remove/red-16'" />
    </template>
  </div>
  <input 
    type="number" 
    class="appearance-none focus:outline-none border-none focus:border-none text-center caption [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none" 
    x-bind:class="{
      'text-gray-800': !disabled,
      'text-gray-500': disabled
    }"
    x-model="value"
    x-bind:readonly="disabled"
    x-bind:min="min"
    x-bind:max="max"
    x-on:input="checkIsMinOrMax($event.target.value)"
  />
  <div x-on:click="if(!checkIsMax()) value += 1">
    <template x-if="checkIsMax()">
      <x-icon :name="'circle-add/grey-16'" />
    </template>
    <template x-if="!checkIsMax()">
      <x-icon :name="'circle-add/red-16'" />
    </template>
  </div>
</x-container>