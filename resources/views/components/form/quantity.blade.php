@props([
  'min' => null,
  'max' => null,
  'disabled' => false,
  'alertMessage' => 'Minimal untuk menambahkan adalah 1 item',
])

<x-container.wrapper 
  x-data="{
    value: 0,
    min: {{ json_encode($min) }},
    max: {{ json_encode($max) }},
    disabled: {{ json_encode($disabled) }},
    alertMessage: {{ json_encode($alertMessage) }},
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

    checkIsMinOrMax(inputValue) {
      if (inputValue === '' || inputValue === '-') return;

      let val = Number(inputValue);
      if (isNaN(val)) return;

      if(!this.disabled) {
        if (this.max !== null && val > this.max) {
             this.value = this.max;
        } else if (this.min !== null && val < this.min) {
             this.value = this.min;
        } else {
             this.value = val;
        }
      }
    },

    startHold(operation) {
      if(this.disabled) return;
      if(operation === 'increment' && !this.checkIsMax()) {
        this.value = Number(this.value) + 1;
      } else if(operation === 'decrement' && !this.checkIsMin()) {
        this.value = Number(this.value) - 1;
      }
      
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
        }, 75); // Speed of continuous increment/decrement
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
  x-modelable="value"
  x-model="{{$attributes->whereStartsWith('x-model')->first()}}"
>
  <x-container.container>
    <x-container.wrapper>
      <x-container.container col="1" class="rounded-sm border border-gray-400">
        <x-container.wrapper items="center" class="p-1 gap-1 relative inline-grid auto-cols-max grid-flow-col">
            
          {{-- Minus Button --}}
          <x-container.container col="1" class="cursor-pointer items-center justify-center select-none" 
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
          <x-container.container col="1" class="items-center justify-center">
            <input 
              size="3"
              type="number" 
              class="[&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none appearance-none focus:outline-none border-none focus:border-none text-center caption [-moz-appearance:textfield] w-full p-0 bg-transparent" 
              x-bind:class="{
                'text-gray-800': !disabled,
                'text-gray-500': disabled
              }"
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
  </x-container.container>

  <x-container.container col="1" class="w-fit">
    <template x-if="min==0 && max==1 && !disabled">
      <x-typography variant="body-small-regular" class="text-red-500 !text-xs" x-text="alertMessage"></x-typography>
    </template>
  </x-container.container>
</x-container.wrapper>