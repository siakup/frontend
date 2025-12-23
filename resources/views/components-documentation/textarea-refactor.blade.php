@extends('layouts.main')

@section('title', 'Textarea Refactor Documentation')

@section('content')
    <x-container.wrapper>
        <x-container.container>
            <div class="mb-6">
                <x-typography variant="body-large-semibold">Komponen Textarea - Refactored Version</x-typography>
                <p class="text-sm text-gray-600 mt-2">
                    Komponen textarea yang sudah direfactor sesuai Figma dengan state management, label, resizer control, helper text, dan character counter.
                </p>
            </div>

            <div x-data="{
                form: {
                    demo1: '',
                    demo2: '',
                    demo3: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                    demo4: '',
                    demo5: '',
                    demo6: ''
                }
            }">
                <x-container.wrapper rows="5" class="gap-10">

                {{-- Demo 1: Basic States --}}
                <div>
                    <x-typography variant="body-medium-semibold" class="mb-4">
                        1. Basic States (Sesuai Figma)
                    </x-typography>
                    <div class="grid grid-cols-1 gap-6">
                        {{-- Default State --}}
                        <div>
                            <p class="text-sm font-medium mb-2">Default State</p>
                            <x-form.refactor.textarea 
                                name="demo1"
                                label="Label"
                                placeholder="Placeholder"
                                :showLabel="true"
                                :resizer="true"
                                :helperContainer="true"
                                :showHelperText="true"
                                helperText="Helper text"
                                :wordCounter="true"
                                :maxChar="200"
                                x-model="form.demo1"
                            />
                        </div>

                        {{-- Hover State --}}
                        <div>
                            <p class="text-sm font-medium mb-2">Hover State (Purple Border)</p>
                            <x-form.refactor.textarea 
                                name="demo2"
                                label="Label"
                                placeholder="Hover over me"
                                :showLabel="true"
                                helperText="Helper text"
                                :maxChar="200"
                                x-model="form.demo2"
                            />
                        </div>

                        {{-- With Value --}}
                        <div>
                            <p class="text-sm font-medium mb-2">With Value (Character Counter Active)</p>
                            <x-form.refactor.textarea 
                                name="demo3"
                                label="Label"
                                value="Lorem ipsum dolor sit amet, consectetur adipiscing elit."
                                placeholder="Placeholder"
                                :showLabel="true"
                                helperText="Helper text"
                                :maxChar="200"
                                x-model="form.demo3"
                            />
                        </div>

                        {{-- Disabled State --}}
                        <div>
                            <p class="text-sm font-medium mb-2">Disabled State</p>
                            <x-form.refactor.textarea 
                                name="demo4"
                                label="Label"
                                placeholder="Disabled textarea"
                                :showLabel="true"
                                :disabled="true"
                                helperText="This textarea is disabled"
                                :maxChar="200"
                                x-model="form.demo4"
                            />
                        </div>

                        {{-- Error State --}}
                        <div>
                            <p class="text-sm font-medium mb-2">Error State</p>
                            <x-form.refactor.textarea 
                                name="demo5"
                                label="Label"
                                placeholder="Placeholder"
                                :showLabel="true"
                                :required="true"
                                error="This field is required"
                                :maxChar="200"
                                x-model="form.demo5"
                            />
                        </div>

                        {{-- Error with Value --}}
                        <div>
                            <p class="text-sm font-medium mb-2">Error State with Value</p>
                            <x-form.refactor.textarea 
                                name="demo6"
                                label="Label"
                                value="Invalid input"
                                placeholder="Placeholder"
                                :showLabel="true"
                                :required="true"
                                error="Content validation failed"
                                :maxChar="200"
                                x-model="form.demo6"
                            />
                        </div>
                    </div>
                </div>

                {{-- Demo 2: Resizer Options --}}
                <div>
                    <x-typography variant="body-medium-semibold" class="mb-4">
                        2. Resizer Control
                    </x-typography>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-sm font-medium mb-2">Resizable (resizer=true)</p>
                            <x-form.refactor.textarea 
                                name="resizable"
                                label="Resizable Textarea"
                                placeholder="You can resize this vertically"
                                :resizer="true"
                                helperText="Drag bottom-right corner to resize"
                            />
                        </div>

                        <div>
                            <p class="text-sm font-medium mb-2">Fixed (resizer=false)</p>
                            <x-form.refactor.textarea 
                                name="fixed"
                                label="Fixed Textarea"
                                placeholder="This cannot be resized"
                                :resizer="false"
                                helperText="Resizing is disabled"
                            />
                        </div>
                    </div>
                </div>

                {{-- Demo 3: Helper & Counter Options --}}
                <div>
                    <x-typography variant="body-medium-semibold" class="mb-4">
                        3. Helper Container Options
                    </x-typography>
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm font-medium mb-2">With Helper Text + Counter</p>
                            <x-form.refactor.textarea 
                                name="both"
                                label="Description"
                                placeholder="Enter description"
                                :helperContainer="true"
                                :showHelperText="true"
                                helperText="Provide detailed information"
                                :wordCounter="true"
                                :maxChar="150"
                            />
                        </div>

                        <div>
                            <p class="text-sm font-medium mb-2">Counter Only (no helper text)</p>
                            <x-form.refactor.textarea 
                                name="counter_only"
                                label="Notes"
                                placeholder="Enter notes"
                                :helperContainer="true"
                                :showHelperText="false"
                                :wordCounter="true"
                                :maxChar="100"
                            />
                        </div>

                        <div>
                            <p class="text-sm font-medium mb-2">Helper Text Only (no counter)</p>
                            <x-form.refactor.textarea 
                                name="helper_only"
                                label="Comments"
                                placeholder="Enter comments"
                                :helperContainer="true"
                                :showHelperText="true"
                                helperText="Optional comments"
                                :wordCounter="false"
                            />
                        </div>

                        <div>
                            <p class="text-sm font-medium mb-2">No Helper Container</p>
                            <x-form.refactor.textarea 
                                name="no_helper"
                                label="Basic"
                                placeholder="Minimal textarea"
                                :helperContainer="false"
                            />
                        </div>
                    </div>
                </div>

                {{-- Demo 4: Label Options --}}
                <div>
                    <x-typography variant="body-medium-semibold" class="mb-4">
                        4. Label Control
                    </x-typography>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-sm font-medium mb-2">With Label</p>
                            <x-form.refactor.textarea 
                                name="with_label"
                                :showLabel="true"
                                label="Custom Label"
                                placeholder="Has label above"
                                helperText="Label is visible"
                            />
                        </div>

                        <div>
                            <p class="text-sm font-medium mb-2">Without Label</p>
                            <x-form.refactor.textarea 
                                name="no_label"
                                :showLabel="false"
                                placeholder="No label above"
                                helperText="Label is hidden"
                            />
                        </div>
                    </div>
                </div>

                {{-- Demo 5: Usage Guide --}}
                <div>
                    <x-typography variant="body-medium-semibold" class="mb-4">
                        5. Cara Penggunaan
                    </x-typography>
                    <pre class="bg-gray-900 text-gray-300 p-4 rounded-lg text-xs overflow-x-auto">
&lt;x-form.refactor.textarea 
    name="description"
    label="Label"
    placeholder="Placeholder"
    :showLabel="true"
    :resizer="true"
    :helperContainer="true"
    :showHelperText="true"
    helperText="Helper text"
    :wordCounter="true"
    :maxChar="200"
    x-model="form.description"
/&gt;

&lt;!-- Props Available: --&gt;
- name: string (default: 'textarea')
- label: string (default: 'Label')
- showLabel: boolean (default: true) - show/hide label
- placeholder: string (default: 'Placeholder')
- value: string (default: '')
- rows: number (default: 4)
- resizer: boolean (default: true) - allow vertical resize
- helperContainer: boolean (default: true) - show helper/counter container
- helperText: string (default: '') - helper text message
- showHelperText: boolean (default: true) - show/hide helper text
- wordCounter: boolean (default: true) - show character counter
- maxChar: number (default: null) - max characters (null = unlimited)
- required: boolean (default: false)
- disabled: boolean (default: false)
- error: string (default: null) - error message (shows error state)
- state: string (default: 'default') - 'default'|'error'|'disabled'
- class: string - additional CSS classes

Note: Clear button (X) automatically appears when textarea has content</pre>
                </div>

                </x-container.wrapper>
            </div>
        </x-container.container>
    </x-container.wrapper>
@endsection
