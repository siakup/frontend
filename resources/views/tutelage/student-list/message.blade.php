@extends('layouts.main')

@section('title', 'Kelompok Perwalian')

@section('breadcrumbs')
    <div class="breadcrumb-item">Beranda</div>
    <div class="breadcrumb-item active">Kelompok Perwalian</div>
@endsection

@section('content')
  <script type="module">
    document.addEventListener('alpine:init', () => {
      Alpine.store('detailPage', { 
        subjectData: @js($subjectData),
        receiverId: @js($receiverData->id),
        subjects: @js($subjectList),
        receiver: @js($receiverData),
        sender: @js($senderData),
        messages: @js($messages)
      });

      Alpine.data('studentMessage', window.PerwalianKRSController.studentMessage);
    });
  </script>

  <x-container.container :variant="'content-wrapper'" x-data="studentMessage">
    <x-typography variant="body-large-semibold">Pesan untuk Mahasiswa</x-typography>
    <x-button :variant="'tertiary'" :icon="'arrow-left/red-16'" :href="route('tutelage-group.list-student')">Kelompok Perwalian</x-button>
    <x-container.container :variant="'content-wrapper'" :class="'!gap-0 !px-0 py-4'">
      <x-tab 
        :bgActive="'bg-disable-red'"
        :tabItems="[
          (object)[
            'routeName' => 'tutelage-group.student-list.detail-krs',
            'routeQuery' => 'tutelage-group.student-list.detail-krs',
            'title' => 'KRS',
            'param' => ['id' => $id]
          ],
          (object)[
            'routeName' => 'tutelage-group.student-list.detail-student-data',
            'routeQuery' => 'tutelage-group.student-list.detail-student-data',
            'title' => 'Data Mahasiswa',
            'param' => ['id' => $id]
          ],
          (object)[
            'routeName' => 'tutelage-group.student-list.detail-transkrip-resmi',
            'routeQuery' => 'tutelage-group.student-list.detail-transkrip-resmi',
            'title' => 'Transk. Resmi',
            'param' => ['id' => $id]
          ],
          (object)[
            'routeName' => 'tutelage-group.student-list.detail-transkrip-historis',
            'routeQuery' => 'tutelage-group.student-list.detail-transkrip-historis',
            'title' => 'Transk. Historis',
            'param' => ['id' => $id]
          ],
          (object)[
            'routeName' => 'tutelage-group.student-list.detail-transkrip-kurikulum',
            'routeQuery' => 'tutelage-group.student-list.detail-transkrip-kurikulum',
            'title' => 'Transk. Kurikulum',
            'param' => ['id' => $id]
          ],
          (object)[
            'routeName' => 'tutelage-group.student-list.detail-transkrip-pem',
            'routeQuery' => 'tutelage-group.student-list.detail-transkrip-pem',
            'title' => 'Transk. PEM',
            'param' => ['id' => $id]
          ],
          (object)[
            'routeName' => 'tutelage-group.student-list.message.add',
            'routeQuery' => 'tutelage-group.student-list.message.add',
            'title' => 'Pesan untuk Mahasiswa',
            'param' => ['id' => $id],
            'iconActive' => 'notification/red-24',
            'iconInactive' => 'notification/grey-24'
          ],
        ]"
      />
        <x-container.container :class="'!gap-4 !rounded-tr-none !p-0 items-stretch my-0 border-t !border-t-red-200 relative !z-0 overflow-hidden'">
          <x-container.container :variant="'red-gradient'" class="!rounded-none w-full !p-0 overflow-hidden">
            <x-container.container :variant="'content-wrapper'" class="!gap-1 py-5">
              <x-typography :variant="'body-large-bold'">Pesan untuk Mahasiswa</x-typography>
              <x-container.container :variant="'flat'" class="flex gap-5 items-center">
                <x-typography :variant="'caption-regular'" x-text="$store.detailPage.sender.name"></x-typography>
                <ul><li class="list-disc"><x-typography :variant="'caption-regular'" x-text="$store.detailPage.sender.role + ' ' + $store.detailPage.sender.program_studi"></x-typography></li></ul>
              </x-container>
            </x-container>
            <img src="{{ asset('assets/images/blue-pattern.svg') }}" class="absolute top-1 right-0" alt="">
          </x-container>
          <x-container.container :variant="'content-wrapper'" class="!flex-row items-start justify-between py-4">
            <template x-if="$store.detailPage.subjectData == null"><x-dialog :variant="'success'">Belum ada pesan, klik pesan baru untuk memulai sebuah pesan</x-dialog></template>
            <template x-if="$store.detailPage.subjectData != null">
              <x-container.container class="!p-0 flex flex-col !gap-0 overflow-hidden !bg-disable-white w-full">
                <x-container.container :variant="'red-gradient'" class="!flex-row justify-between items-center !rounded-none border-b border-b-gray-500 w-full !gap-0 !py-2.5 !px-4">
                  <x-profile-header>
                    <x-slot name="imageSlot"><img src="{{asset('assets/icons/human/women.svg')}}" class="w-12.5 h-12.5 rounded-full" /></x-slot>
                    <x-slot name="nameSlot"><x-typography :variant="'body-small-bold'" x-text="$store.detailPage.receiver.name+' - '+$store.detailPage.receiver.nim"></x-typography></x-slot>
                    <x-slot name="roleSlot"><x-typography :variant="'caption-regular'">Mahasiswa</x-typography></x-slot>
                    <x-slot name="programStudiSlot"><x-typography :variant="'caption-regular'" x-text="'Program Studi '+$store.detailPage.receiver.program_studi"></x-typography></x-slot>
                  </x-profile-header>
                  <x-container.container :variant="'content-wrapper'" class="!gap-0 !px-0">
                    <x-container.container :variant="'content-wrapper'" class="!px-0 !gap-1 !flex-row">
                      <x-icon :name="'survey/black-20'" />
                      <x-typography :variant="'body-small-regular'">Subjek: </x-typography>
                    </x-container>
                    <x-container.container :variant="'content-wrapper'" class="!px-0 text-blue-500"><x-typography :variant="'body-small-bold'" x-text="$store.detailPage.subjectData.subject_name"></x-typography></x-container>
                  </x-container>
                  <x-container.container class="!p-0 !border-none">
                    <x-form.dropdown 
                      :buttonId="'sortStudentList'"
                      :dropdownId="'studentList'"
                      :label="'Pilih Mahasiswa'"
                      :imgSrc="asset('assets/icons/arrow-down/red-16.svg')"
                      :isIconCanRotate="true"
                      :isUsedForInputField="true"
                      :dropdownItem="array_merge(
                        array_column(array_map(function ($item) {
                          $data = [
                            'nama' => $item->nama . ' - ' . $item->nim,
                            'id' => $item->id
                          ];
                          return $data;
                        }, $listStudent), 'id', 'nama')
                      )"
                      x-model="$store.detailPage.receiverId"
                    />
                  </x-container>
                </x-container>
                <x-container.container :variant="'content-wrapper'" class="!px-5 !py-3">
                  <template x-for="message in $store.detailPage.messages">
                    <x-bubble-chat 
                      x-data="{
                        type: message.type,
                        name: message.name + (message.nim ? ' '+message.nim : ''),
                        role: message.role,
                        imgProfile: message.imgProfile,
                        timestamp: message.last_updated,
                        message: message.message
                      }"
                    >
                      <template x-if="type == 'receiver'"><x-button :variant="'text-link'" :size="'sm'" :icon="'reply/red-16'" class="self-end">Balas Pesan</x-button></template>
                      <template x-if="type == 'sender'"><x-button :variant="'text-link'" :size="'sm'" :icon="'edit/red-16'" class="self-start">Ubah</x-button></template>
                    </x-bubble-chat>
                  </template>
                </x-container>
              </x-container>
            </template>
            <x-container.container :variant="'content-wrapper'">
              <x-profile-header>
                <x-slot name="imageSlot"><img src="{{asset('assets/icons/human/women.svg')}}" class="w-12.5 h-12.5 rounded-full" /></x-slot>
                <x-slot name="onlineSlot"><x-container.container :variant="'flat'" class="bg-green-500 w-2 h-2"></x-container></x-slot>
                <x-slot name="nameSlot"><x-typography :variant="'body-small-bold'" x-text="$store.detailPage.sender.name"></x-typography></x-slot>
                <x-slot name="roleSlot"><x-typography :variant="'caption-regular'" x-text="$store.detailPage.sender.role"></x-typography></x-slot>
                <x-slot name="programStudiSlot"><x-typography :variant="'pixie-regular'" x-text="$store.detailPage.sender.program_studi"></x-typography></x-slot>
                <x-slot name="footerSlot">
                  <x-button 
                    :variant="'primary'" 
                    :size="'md'" 
                    :iconPosition="'right'" 
                    :icon="'message/white-12'"
                    class="min-w-full justify-center"
                    x-on:click="isModalCreateOpen = true"
                  >
                    Buat Pesan
                  </x-button>
                </x-slot>
              </x-profile-header>
              <template x-if="$store.detailPage.subjects && $store.detailPage.subjects.length > 0">
                <x-container.container :variant="'content-disable-white'">
                  <x-container.container :variant="'content-wrapper'" class="border-b border-gray-500 !flex-row !gap-1 rounded-none !px-0">
                    <x-icon :name="'survey-solid/solid-blue-24'" />
                    <x-typography :variant="'body-medium-bold'">Subject Pesan Terakhir</x-typography>
                  </x-container>
                  <template x-for="(subject, index) in $store.detailPage.subjects">
                    <button class="cursor-pointer w-full border-b border-gray-500 py-1">
                      <x-container.container :variant="'content-wrapper'" class="!gap-1 rounded-none items-start !px-0 w-full">
                        <x-container.container :variant="'flat'" class="flex gap-2 items-center">
                          <x-container.container :variant="'flat'" class="flex items-center justify-center w-7 h-7 text-white bg-green-600 rounded-sm"><x-typography :variant="'body-small-regular'" x-text="index+1"></x-typography></x-container>
                          <x-typography :variant="'caption-semibold'" x-text="subject.student_name+ ' - '+subject.student_nim"></x-typography>
                          <x-container.container :variant="'flat'" class="text-gray-600"><x-typography :variant="'caption-regular'">Mahasiswa</x-typography></x-container>
                        </x-container>
                        <x-container.container :variant="'flat'" class="text-blue-500"><x-typography :variant="'body-medium-semibold'" x-text="subject.subject_name"></x-typography></x-container>
                        <x-container.container :variant="'flat'" class="flex gap-0.5">
                          <x-icon :name="'sub/grey-16'" />
                          <x-badge :variant="'gray-filled'" :size="'md'" x-text="'Balasan terakhir ' + subject.latest_chat_at + ' dari ' + subject.latest_chat_by "></x-badge>
                        </x-container>
                      </x-container>
                    </button>
                  </template>
                </x-container>
              </template>
            </x-container>
          </x-container>
        </x-container>
        <x-modal.container x-model="isModalCreateOpen">
          <x-slot name="header" class="bg-green-500">
            <x-container.container :variant="'flat'" class="grid grid-cols-3 justify-between">
              <x-container.container :variant="'flat'" class="col-start-2 col-end-3">
                <x-typography :variant="'heading-h5'" :tag="'h5'">Tulis Pesan Baru</x-typography>
              </x-container>
              <x-container.container :variant="'flat'" class="col-start-3 col-end-4 justify-items-end">
                <x-icon :name="'mail/outline-black-32'" />
              </x-container>
            </x-container>
          </x-slot>
          <x-slot name="slot"></x-slot>
        </x-modal.container>
    </x-container>
  </x-container>
@endsection