function onChangeFile(element) {
  const uploadCard = element.parentElement.parentElement;
  const container = uploadCard.parentElement;
  const unggahButton = container.querySelector('#btnUnggah');
  const batalButton = container.querySelector('#btnBatalUnggah');
  const fileNameSpan = container.querySelector('#fileName');
  const filenameInput = container.querySelector("#filenameInput");
  const filePreview = container.querySelector('#filePreview');

  if (element.files.length) {
    unggahButton.disabled = false;
    batalButton.disabled = false;

    fileNameSpan.textContent = element.files[0].name;
    filenameInput.value = element.files[0]?.name || '';

    filePreview.classList.add("flex");
    filePreview.classList.remove("hidden");
    filePreview.nextElementSibling.classList.add('w-90/100');

    container.classList.add('gap-5');

    uploadCard.classList.add('hidden');
    uploadCard.classList.remove('flex');
  } else {
    unggahButton.disabled = true;
    batalButton.disabled = true;

    filePreview.classList.add('hidden');
    filePreview.classList.remove('flex');
    filePreview.nextElementSibling.classList.remove('w-90/100');
    
    uploadCard.classList.add('flex');
    uploadCard.classList.remove('hidden');

    container.classList.remove('gap-5');
  }
}

function onRemoveFile(element, name) {
  const uploadCard = element.parentElement.previousElementSibling;
  const container = element.parentElement.parentElement;
  const fileInput = container.querySelector(`input[type='file'][name='${name}']`)
  const unggahButton = container.querySelector('#btnUnggah')
  const batalButton = container.querySelector('#btnBatalUnggah');
  const filePreview = container.querySelector('#filePreview');

  fileInput.value = "";

  unggahButton.disabled = true;
  batalButton.disabled = true;

  filePreview.classList.add('hidden');
  filePreview.classList.remove('flex');
  filePreview.nextElementSibling.classList.remove('w-90/100');
  
  uploadCard.classList.add('flex');
  uploadCard.classList.remove('hidden');

  container.classList.remove('gap-5');
}

function onDropFile(element, event, name) {
  event.preventDefault();
  event.stopPropagation();

  element.classList.remove('border-[#E62129]');
  element.classList.remove('bg-[#FDF4F4]');

  const files = event.dataTransfer.files;
  if (files.length === 0) return;

  const file = files[0];
  const dataTransfer = new DataTransfer();
  dataTransfer.items.add(file);
  
  const container = element.parentElement;
  const unggahButton = container.querySelector('#btnUnggah');
  const batalButton = container.querySelector('#btnBatalUnggah');
  const fileNameSpan = container.querySelector('#fileName');
  const filenameInput = container.querySelector("#filenameInput");
  const filePreview = container.querySelector('#filePreview');
  const fileInput = container.querySelector(`input[type='file'][name='${name}']`);

  unggahButton.disabled = false;
  batalButton.disabled = false;

  fileNameSpan.textContent = file.name;
  filenameInput.value = file.name;
  fileInput.files = dataTransfer.files;

  filePreview.classList.add("flex");
  filePreview.classList.remove("hidden");
  filePreview.nextElementSibling?.classList.add('w-90/100');

  container.classList.add('gap-5');

  element.classList.add('hidden');
  element.classList.remove('flex');
}