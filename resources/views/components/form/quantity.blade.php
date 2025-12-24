@props([
  'min' => null,
  'max' => null,
  'disabled' => false
])

<x-container.wrapper 
  x-data="{
    value: 0,
    min: {{ json_encode($min) }},
    max: {{ json_encode($max) }},
    disabled: {{ json_encode($disabled) }},
    holdInterval: null,
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
      value = Number(value);
      // Jika value negatif, set ke 0 atau min value
      if(value < 0) {
        this.value = (this.min !== null && this.min >= 0) ? this.min : 0;
        return;
      }
      if(!this.disabled) {
        if((value <= this.max || this.max == null) && (value >= this.min || this.min == null)) this.value = value
        else {
          this.value = (value > this.max && this.max !== null) 
            ? this.max 
            : ((value < this.min && this.min !== null) ? this.min : 0)
        }
      }
    },
    startHold(operation) {
      if(this.disabled) return;
      // First execution
      if(operation === 'increment' && !this.checkIsMax()) {
        this.value = Number(this.value) + 1;
      } else if(operation === 'decrement' && !this.checkIsMin()) {
        this.value = Number(this.value) - 1;
      }
      // Then start interval
      let delay = 500; // Initial delay before continuous
      this.holdInterval = setTimeout(() => {
        this.holdInterval = setInterval(() => {
          if(operation === 'increment' && !this.checkIsMax()) {
            this.value = Number(this.value) + 1;
          } else if(operation === 'decrement' && !this.checkIsMin()) {
            this.value = Number(this.value) - 1;
          } else {
            this.stopHold();
          }
        }, 70); // Speed of continuous increment/decrement
      }, delay);
    },
    stopHold() {
      if(this.holdInterval) {
        clearInterval(this.holdInterval);
        clearTimeout(this.holdInterval);
        this.holdInterval = null;
      }
    }
  }"
  width="fit"
  x-modelable="value"
  x-model="{{$attributes->whereStartsWith('x-model')->first()}}"
>
  <x-container.container col="1" class="rounded-sm border border-gray-400">
    <x-container.wrapper cols="3" gap="2" items="center" padding="p-2">
      
      {{-- Minus Button --}}
      <x-container.container col="1" class="cursor-pointer flex items-center justify-center select-none" 
        x-on:mousedown="startHold('decrement')"
        x-on:mouseup="stopHold()"
        x-on:mouseleave="stopHold()">
        <template x-if="checkIsMin()">
          <x-icon :name="'circle-remove/grey-16'" />
        </template>
        <template x-if="!checkIsMin()">
          <x-icon :name="'circle-remove/red-16'" />
        </template>
      </x-container.container>

      {{-- Input --}}
      <x-container.container col="1" class="flex items-center justify-center">
        <style>
          .no-spinners::-webkit-inner-spin-button,
          .no-spinners::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
          }
        </style>
        <input 
          type="number" 
          class="no-spinners appearance-none focus:outline-none border-none focus:border-none text-center caption [-moz-appearance:textfield] w-full p-0" 
          x-bind:class="{
            'text-gray-800': !disabled,
            'text-gray-500': disabled
          }"
          style="background-color: transparent;"
          x-model.number="value"
          x-bind:readonly="disabled"
          x-bind:min="min"
          x-bind:max="max"
          x-on:input="checkIsMinOrMax($event.target.value)"
        />
      </x-container.container>

      {{-- Plus Button --}}
      <x-container.container col="1" class="cursor-pointer flex items-center justify-center select-none" 
        x-on:mousedown="startHold('increment')"
        x-on:mouseup="stopHold()"
        x-on:mouseleave="stopHold()">
        <template x-if="checkIsMax()">
          <x-icon :name="'circle-add/grey-16'" />
        </template>
        <template x-if="!checkIsMax()">
          <x-icon :name="'circle-add/red-16'" />
        </template>
      </x-container.container>
    </x-container.wrapper>
  </x-container.container>
</x-container.wrapper>