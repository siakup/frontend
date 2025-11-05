export default function fileUploadComponent(name) {
  return {
    drag: false,
    drop: false,
    fileName: '',
    name: name,
    setFileName(event) { 
      const files = event.dataTransfer.files;
      if(files.length === 0) return;
      const file = files[0];
      this.fileName = file.name 

      const dataTransfer = new DataTransfer();
      dataTransfer.items.add(file);
      this.$refs.fileInput.files = dataTransfer.files;
      this.$refs.fileInput.dispatchEvent(new Event('change'));

      this.onDrop();
    },
    onChangeFile(event) {
      const files = event.target.files;
      if (files.length === 0) return;
      const file = files[0];
      this.fileName = file.name;
      this.drop = true;
    },
    onRemoveFile() {
      this.$refs.fileInput.value = '';
      this.fileName = '';
      this.drop = false;
      this.drag = false;
    },
    onDrag() { this.drag = true },
    onLeaveDrag() { this.drag = false },
    onDrop() { this.drop = true }
  }
}