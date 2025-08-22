<style>
  .modal-custom-content {
      max-width: 600px;
      z-index: 2;
      align-items: center !important;
      gap: 16px;
      align-self: auto !important;

  }
  .modal-custom {
      align-items: center !important;
  }
  @media (max-width: 900px) {
      .modal-custom-content {
          width: 90vw;
          min-width: unset;
          max-width: 98vw;
          padding: 16px;
      }
      .modal-custom-title {
          font-size: 18px;
      }
  }
</style>
<div id="{{ $modalId }}" class="modal-custom" style="display:none;">
    <div class="modal-custom-content  flex items-center justify-center">
        <div class="modal-custom-header">
            <span class="text-lg-bd">{{ $modalTitle }}</span>
            <img src="{{ $modalIcon }}" alt="ikon peringatan">
        </div>
        <div class="modal-custom-body">
            <div>{{ $modalMessage }}</div>
        </div>
        <div class="modal-custom-footer gap-[12px] w-full flex !justify-center p-[12px]">
            <button type="button" class="button button-clean" id="{{$modalId}}-btnCekKembali">{{ $cancelButtonLabel }}</button>
            <button type="submit" class="button button-outline" id="{{$modalId}}-btnSimpan">{{ $actionButtonLabel }}</button>
        </div>
    </div>
</div>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.{{$triggerButton}}');
        if (btn) {
            const idEvent = btn.getAttribute('data-id');
            document.getElementById('{{ $modalId }}').setAttribute('data-id', idEvent);
            document.getElementById('{{ $modalId }}').style.display = 'block';
        }
    });
    
    document.getElementById('{{$modalId}}-btnCekKembali').addEventListener('click', function() {
        document.getElementById('{{ $modalId }}').removeAttribute('data-id');
        document.getElementById('{{ $modalId }}').style.display = 'none';
    });
  });
</script>