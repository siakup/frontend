function formatDateTime(dateTimeStr) {
  const date = new Date(dateTimeStr);
  const formattedDate = date.toLocaleDateString('id-ID', {
      day: '2-digit',
      month: 'long',
      year: 'numeric'
  });
  const formattedTime = date.toLocaleTimeString('id-ID', {
      hour: '2-digit',
      minute: '2-digit',
      hour12: false
  });
  return `${formattedDate}, ${formattedTime} WIB`;
}