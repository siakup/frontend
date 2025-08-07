@props([
    'currentPage' => 1,
    'totalPages' => 1,
    'perPageInput' => 10,
    'defaultPerPageOptions' => [10, 25, 50, 100],
    'onPerPageChange' => '',
    'onPageChange' => '',
    'onPrevious' => '',
    'onNext' => '',
])

<div class="flex flex-col md:flex-row items-center gap-10 w-full">
    <!-- Per Page Selector -->
    <div class="flex items-center gap-3">
        <span class="text-sm text-gray-600">Tampilkan</span>
        <div class="relative group">
            <input type="number" value="{{ $perPageInput }}" min="1" max="100"
                class="w-20 border bg-white border-[#bfbfbf] rounded-lg px-3 py-1 text-sm text-center"
                onchange="{{ $onPerPageChange }}">
            <!-- Dropdown untuk pilihan cepat -->
            <div
                class="absolute right-0 mt-1 w-20 bg-white border border-[#bfbfbf] rounded-lg shadow-lg z-10 hidden group-hover:block">
                @foreach ($defaultPerPageOptions as $option)
                    <button onclick="{{ str_replace('{value}', $option, $onPerPageChange) }}"
                        class="block w-full px-3 py-1 text-sm text-center hover:bg-[#FBDADB]">
                        {{ $option }}
                    </button>
                @endforeach
            </div>
        </div>
        <span class="text-sm text-gray-600">Per Halaman</span>
    </div>

    <!-- Pagination Info and Controls -->
    <div class="flex flex-col sm:flex-row items-center gap-5">
        <!-- Text Hasil -->
        <div class="text-sm text-gray-600">
            Hasil: {{ $currentPage }} dari {{ $totalPages }}
        </div>

        <!-- Pagination Controls -->
        <div class="flex items-center gap-1">
            <!-- Previous Button -->
            @if ($currentPage > 1)
                <x-button.secondary onclick="{{ $onPrevious }}" label="Sebelumnya" iconPosition="left"
                    icon="{{ asset('assets/icon-arrow-left-red.svg') }}" class="!py-1 !px-3" />
            @endif

            <!-- Page Numbers -->
            @php
                // Selalu tampilkan halaman pertama
                echo '<button onclick="' .
                    str_replace('{page}', 1, $onPageChange) .
                    '" class="py-1 px-4 rounded-lg text-sm ' .
                    ($currentPage == 1 ? 'bg-[#FBDADB] text-[#E62129]' : 'text-[#8C8C8C]') .
                    '">1</button>';

                // Tampilkan elipsis jika ada gap di awal
                if ($currentPage > 3 && $totalPages > 5) {
                    echo '<span class="px-2 text-[#8C8C8C] text-sm">...</span>';
                }

                // Tentukan range halaman yang ditampilkan
                $startPage = max(2, $currentPage - 1);
                $endPage = min($totalPages - 1, $currentPage + 1);

                // Tampilkan halaman sekitar current page
                for ($i = $startPage; $i <= $endPage; $i++) {
                    if ($i > 1 && $i < $totalPages) {
                        echo '<button onclick="' .
                            str_replace('{page}', $i, $onPageChange) .
                            '" class="py-1 px-4 rounded-lg text-sm ' .
                            ($currentPage == $i ? 'bg-[#FBDADB] text-[#E62129]' : 'text-[#8C8C8C]') .
                            '">' .
                            $i .
                            '</button>';
                    }
                }

                // Tampilkan elipsis jika ada gap di akhir
                if ($currentPage < $totalPages - 2 && $totalPages > 5) {
                    echo '<span class="px-2 text-[#8C8C8C] text-sm">...</span>';
                }

                // Tampilkan halaman terakhir jika lebih dari 1
                if ($totalPages > 1) {
                    echo '<button onclick="' .
                        str_replace('{page}', $totalPages, $onPageChange) .
                        '" class="py-1 px-4 rounded-lg text-sm ' .
                        ($currentPage == $totalPages ? 'bg-[#FBDADB] text-[#E62129]' : 'text-[#8C8C8C]') .
                        '">' .
                        $totalPages .
                        '</button>';
                }
            @endphp

            <!-- Next Button -->
            @if ($currentPage < $totalPages)
                <x-button.secondary onclick="{{ $onNext }}" label="Selanjutnya" iconPosition="right"
                    icon="{{ asset('assets/icon-arrow-right-red.svg') }}" class="!py-1 !px-3" />
            @endif
        </div>
    </div>
</div>
