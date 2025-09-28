@props([
    'currentPage' => 1,
    'totalPages' => 1,
    'perPageInput' => 10,
    'defaultPerPageOptions' => [10, 25, 50, 100],
    'onPerPageChange' => '',
    'onPageChange' => '',
    'onPrevious' => '',
    'onNext' => '',
    'totalItems' => null,
])

<div class="flex flex-col md:flex-row items-center justify-between gap-10 w-full">
    <!-- Per Page Selector -->
    <div class="flex items-center gap-3">
        <span class="text-sm text-gray-600">Tampilkan</span>
        <div class="relative group">
            <select class="w-24 border bg-white border-[#bfbfbf] rounded-lg px-3 py-1 text-sm text-center"
                    onchange="{{ $onPerPageChange }}">
                @foreach ($defaultPerPageOptions as $option)
                    <option value="{{ $option }}" {{ $perPageInput == $option ? 'selected' : '' }}>
                        {{ $option }}
                    </option>
                @endforeach
            </select>
        </div>
        <span class="text-sm text-gray-600">Per Halaman</span>
    </div>

    <!-- Pagination Info and Controls -->
    <div class="flex flex-col sm:flex-row items-center gap-5">
        <!-- Text Hasil -->
        <div class="text-sm text-gray-600">
            @if ($totalItems)
                <span>Menampilkan halaman {{ $currentPage }} dari {{ $totalPages }} (Total: {{ $totalItems }} data)</span>
            @else
                <span>Halaman {{ $currentPage }} dari {{ $totalPages }}</span>
            @endif
        </div>

        <!-- Pagination Controls -->
        <div class="flex items-center gap-1">
            <!-- Previous Button -->
            <x-button.secondary x-show="currentPage > 1" onclick="{{ $onPrevious }}" label="Sebelumnya"
                                iconPosition="left" icon="{{ asset('assets/icon-arrow-left-red.svg') }}" class="!py-1 !px-3" />

            <!-- Page Numbers -->
            @php
                echo '<button onclick="' .
                    str_replace('{page}', 1, $onPageChange) .
                    '" class="py-1 px-4 rounded-lg text-sm cursor-pointer ' .
                    ($currentPage == 1 ? 'bg-[#FBDADB] text-[#E62129]' : 'text-[#8C8C8C]') .
                    '">1</button>';

                if ($currentPage > 3 && $totalPages > 5) {
                    echo '<span class="px-2 text-[#8C8C8C] text-sm">...</span>';
                }

                $startPage = max(2, $currentPage - 1);
                $endPage = min($totalPages - 1, $currentPage + 1);

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

                if ($currentPage < $totalPages - 2 && $totalPages > 5) {
                    echo '<span class="px-2 text-[#8C8C8C] text-sm">...</span>';
                }

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
            <x-button.secondary x-show="currentPage < totalPages" onclick="{{ $onNext }}" label="Selanjutnya"
                                iconPosition="right" icon="{{ asset('assets/icon-arrow-right-red.svg') }}" class="!py-1 !px-3" />
        </div>
    </div>
</div>
