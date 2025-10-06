@props([
  'title' => 'Section',
  'rows' => [],   
  'open' => false,
])

<div x-data="{ open: {{ $open ? 'true':'false' }} }"
     class="rounded-lg border border-[#E8E8E8] overflow-hidden">
  
  <button type="button"
          @click="open = !open"
          class="w-full flex items-center justify-between px-4 py-3 font-semibold"
          style="background: linear-gradient(to right, #FFFFFF, #FFECED);">
    <span class="text-[#262626]">{{ $title }}</span>

    <span class="inline-flex items-center gap-2 text-sm"
          :class="open ? 'text-[#E62129]' : 'text-[#E62129]'">
      <span x-text="open ? 'Tutup' : 'Buka'"></span>
      <img src="{{ asset('assets/icon-arrow-right-red.svg') }}"
           alt="arrow"
           class="w-4 h-4 transition-transform duration-200"
           :class="open ? 'rotate-90' : 'rotate-0'">
    </span>
  </button>

  
  <div x-show="open" x-collapse class="bg-white border-t border-[#F1F5F9]">
    <table class="min-w-full table-fixed text-sm text-[#262626]">
      <tbody>
        @forelse($rows as $i => $r)
          @php
            $leftBg  = $i % 2 === 0 ? '#E8E8E8' : '#F5F5F5';
            $rightBg = $i % 2 === 0 ? '#F5F5F5' : '#FFFFFF';
          @endphp
          <tr class="h-[38px] align-top">
            <td class="w-[320px] px-6 py-3 font-normal"
                style="background: {{ $leftBg }};">{{ $r['label'] ?? '-' }}</td>
            <td class="px-6 py-3 font-semibold"
                style="background: {{ $rightBg }};">
              {!! $r['value'] ?? '-' !!}
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="2" class="px-6 py-4 text-center text-gray-500">Belum ada data.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
