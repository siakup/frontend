<div 
  {{
    $attributes->merge([
      'class' => 'fixed inset-0 z-9999 items-center justify-center hidden'
    ])
  }}>
  <div 
    class="fixed inset-0 bg-black opacity-25" 
    onclick="
      this.parentElement.classList.add('hidden');
      this.parentElement.classList.remove('flex');
    "></div>
  <div class="relative bg-white rounded-[14px] min-w-[340px] max-w-[900px] w-max z-999 flex flex-col items-center gap-[16px]">
    <div class="rounded-t-xl border-[1px] border-[#D9D9D9] flex items-center justify-center p-5 self-stretch w-full">
      {{ $header }}
    </div>
    <div class="px-5 py-3 w-full box-border text-center">
      {{ $body }}
    </div>
    <div class="flex justify-center border-t-1 border-t-[#D9D9D9] w-full p-5 gap-4 items-center">
      {{ $footer }}
    </div>
  </div>
</div>