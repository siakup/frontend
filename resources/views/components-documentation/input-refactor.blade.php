@extends('layouts.main')

@section('title', 'Input Refactor Documentation')

@section('content')
    <x-container variant="content-wrapper">
        <div class="mb-6">
            <x-typography variant="body-large-semibold">Komponen Input - Refactored Version</x-typography>
            <p class="text-sm text-gray-600 mt-2">
                Komponen input yang sudah direfactor dengan fitur lengkap: prefix/suffix container, icon left/right, clear button, dan size variants.
            </p>
        </div>

        <div x-data="{
            form: {
                demo1: '',
                demo2: '',
                demo3: '',
                demo4: '',
                demo5: '',
                demo6: ''
            }
        }">
            <x-container class="flex flex-col gap-10 p-6 bg-white border border-gray-200" borderRadius="rounded-lg">

                {{-- Demo 1: Full Featured (Sesuai Desain) --}}
                <div>
                    <x-typography variant="body-medium-semibold" class="mb-4">
                        1. Full Featured Input (Sesuai Desain Figma)
                    </x-typography>
                    <div class="grid grid-cols-1 gap-6">
                        <div class="space-y-4">
                            {{-- Default State --}}
                            <div>
                                <p class="text-sm font-medium mb-2">Default State</p>
                                <x-form.refactor.input 
                                    name="demo1"
                                    label="Label"
                                    placeholder="Placeholder"
                                    size="lg"
                                    :showPrefix="true"
                                    prefix="Rp"
                                    :showSuffix="true"
                                    suffix="Years"
                                    :showClearData2="true"
                                    helperText="Helper text"
                                    x-model="form.demo1"
                                />
                            </div>

                            {{-- Hover State --}}
                            <div>
                                <p class="text-sm font-medium mb-2">Hover State (Purple Border)</p>
                                <x-form.refactor.input 
                                    name="demo2"
                                    label="Label"
                                    placeholder="Placeholder"
                                    size="lg"
                                    :showPrefix="true"
                                    prefix="Rp"
                                    :showSuffix="true"
                                    suffix="Years"
                                    :showClearData2="true"
                                    helperText="Helper text"
                                    x-model="form.demo2"
                                />
                            </div>

                            {{-- With Value --}}
                            <div>
                                <p class="text-sm font-medium mb-2">With Value (Clear Button Visible)</p>
                                <x-form.refactor.input 
                                    name="demo3"
                                    label="Label"
                                    value="345 x 86 Hug"
                                    placeholder="Placeholder"
                                    size="lg"
                                    :showPrefix="true"
                                    prefix="Rp"
                                    :showSuffix="true"
                                    suffix="Years"
                                    :showClearData2="true"
                                    helperText="Helper text"
                                    x-model="form.demo3"
                                />
                            </div>

                            {{-- Disabled State --}}
                            <div>
                                <p class="text-sm font-medium mb-2">Disabled State</p>
                                <x-form.refactor.input 
                                    name="demo4"
                                    label="Label"
                                    placeholder="Placeholder"
                                    size="lg"
                                    :showPrefix="true"
                                    prefix="Rp"
                                    :showSuffix="true"
                                    suffix="Years"
                                    :showClearData2="true"
                                    helperText="Helper text"
                                    :disabled="true"
                                    x-model="form.demo4"
                                />
                            </div>

                            {{-- Error State --}}
                            <div>
                                <p class="text-sm font-medium mb-2">Error State</p>
                                <x-form.refactor.input 
                                    name="demo5"
                                    label="Label"
                                    placeholder="Placeholder"
                                    size="lg"
                                    :showPrefix="true"
                                    prefix="Rp"
                                    :showSuffix="true"
                                    suffix="Years"
                                    :showClearData2="true"
                                    error="Helper text"
                                    :required="true"
                                    x-model="form.demo5"
                                />
                            </div>

                            {{-- Error State with Value --}}
                            <div>
                                <p class="text-sm font-medium mb-2">Error State with Value</p>
                                <x-form.refactor.input 
                                    name="demo6"
                                    label="Label"
                                    value="Test value"
                                    placeholder="Placeholder"
                                    size="lg"
                                    :showPrefix="true"
                                    prefix="Rp"
                                    :showSuffix="true"
                                    suffix="Years"
                                    :showClearData2="true"
                                    error="Helper text"
                                    :required="true"
                                    x-model="form.demo6"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="border-gray-200">

                {{-- Demo 2: Size Variants --}}
                <div>
                    <x-typography variant="body-medium-semibold" class="mb-4">
                        2. Size Variants (sm, md, lg)
                    </x-typography>
                    <div class="space-y-4">
                        <x-form.refactor.input 
                            name="size_sm"
                            label="Small Size"
                            placeholder="Small input"
                            size="sm"
                            :showPrefix="true"
                            prefix="Rp"
                            helperText="Small size input"
                        />

                        <x-form.refactor.input 
                            name="size_md"
                            label="Medium Size"
                            placeholder="Medium input"
                            size="md"
                            :showPrefix="true"
                            prefix="Rp"
                            helperText="Medium size input"
                        />

                        <x-form.refactor.input 
                            name="size_lg"
                            label="Large Size"
                            placeholder="Large input"
                            size="lg"
                            :showPrefix="true"
                            prefix="Rp"
                            helperText="Large size input"
                        />
                    </div>
                </div>

                <hr class="border-gray-200">

                {{-- Demo 3: Prefix/Suffix Options --}}
                <div>
                    <x-typography variant="body-medium-semibold" class="mb-4">
                        3. Prefix/Suffix Combinations
                    </x-typography>
                    <div class="space-y-4">
                        <x-form.refactor.input 
                            name="prefix_only"
                            label="Prefix Only"
                            placeholder="Amount"
                            :showPrefix="true"
                            prefix="Rp"
                            helperText="Input with prefix"
                        />

                        <x-form.refactor.input 
                            name="suffix_only"
                            label="Suffix Only"
                            placeholder="Duration"
                            :showSuffix="true"
                            suffix="Years"
                            helperText="Input with suffix"
                        />

                        <x-form.refactor.input 
                            name="both"
                            label="Prefix + Suffix"
                            placeholder="Value"
                            :showPrefix="true"
                            prefix="Rp"
                            :showSuffix="true"
                            suffix="Years"
                            helperText="Input with both"
                        />

                        <x-form.refactor.input 
                            name="none"
                            label="No Prefix/Suffix"
                            placeholder="Regular input"
                            helperText="Regular input"
                        />
                    </div>
                </div>

                <hr class="border-gray-200">

                {{-- Code Example --}}
                <div>
                    <x-typography variant="body-medium-semibold" class="mb-4">
                        4. Cara Penggunaan
                    </x-typography>
                    <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs overflow-x-auto">
&lt;x-form.refactor.input 
    name="amount"
    label="Label"
    placeholder="Placeholder"
    size="lg"
    :showPrefix="true"
    prefix="Rp"
    :showSuffix="true"
    suffix="Years"
    :showClearData2="true"
    helperText="Helper text"
    x-model="form.amount"
/&gt;

&lt;!-- Props Available: --&gt;
- size: "sm" | "md" | "lg" (default: "lg")
- showPrefix: boolean (default: false)
- prefix: string (default: "Rp")
- showSuffix: boolean (default: false)
- suffix: string (default: "Years")
- showIconLeft: boolean (default: false)
- iconLeft: string (icon name)
- showIconRight: boolean (default: false)
- iconRight: string (icon name)
- showClearData: boolean (default: false)
- showClearData2: boolean (default: true)
- variant: "nip" | "ktp" | "username" | "email" | "password" | "phone"
- required: boolean (default: false)
- disabled: boolean (default: false)</pre>
                </div>

            </x-container>
        </div>
    </x-container>
@endsection
