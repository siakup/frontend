<div 
  class="border-[1px] border-[#BFBFBF] flex items-center justify-between rounded-lg w-full text-[#262626] py-2 px-4"
  onclick="this.querySelector('input').focus()"
>
  <input 
    type="text"
    id="{{$attributes->get('id')}}" 
    class="{{ $attributes->get('class') }}bg-white outline-none border-none" 
    name="{{ $attributes->get('name') }}"
    value=""
    placeholder="dd-mm-yyyy, hh:mm"
    onfocus="this.nextElementSibling.src = '{{ asset('assets/active/icon-calendar.svg') }}'"
    onblur="this.nextElementSibling.src = '{{ asset('assets/base/icon-calendar.svg') }}'"
    oninput="{{$attributes->get('oninput')}}"
  />
  <img src="{{ asset('assets/base/icon-calendar.svg') }}" alt="Icon Calendar" class="me-2.5">
</div>
