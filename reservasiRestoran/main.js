// Fungsi untuk menghasilkan nomor tiket secara acak
function generateTicketNumber() {
  const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
  let ticketNumber = '';
  for (let i = 0; i < 6; i++) {
    ticketNumber += characters.charAt(Math.floor(Math.random() * characters.length));
  }
  return ticketNumber;
}

// Fungsi untuk membuat dan menampilkan gambar QR Code
function generateQRCode(url) {
  const qrCodeImg = document.createElement('img');
  qrCodeImg.src = url;
  qrCodeImg.alt = 'QR Code';
  qrCodeImg.width = 150;
  qrCodeImg.height = 150;
  document.getElementById('qrCodeContainer').appendChild(qrCodeImg);
}

document.getElementById('reservationForm').addEventListener('submit', function(event) {
  event.preventDefault();

  const name = document.getElementById('name').value;
  const date = document.getElementById('date').value;
  const time = document.getElementById('time').value;
  const people = document.getElementById('people').value;
  const table = document.getElementById('table').value;
  const ticketNumber = generateTicketNumber(); // Memanggil fungsi generateTicketNumber untuk mendapatkan nomor tiket
  const qrCodeUrl = `https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=${encodeURIComponent(ticketNumber)}`;

  // Simpan data reservasi ke database atau local storage
  // Di sini hanya mencetak hasil ke konsol
  console.log("Reservasi:", {
    name: name,
    date: date,
    time: time,
    people: people,
    table: table,
    ticketNumber: ticketNumber // Menambahkan nomor tiket ke data reservasi
  });

  // Tampilkan konfirmasi reservasi beserta nomor tiket dan QR Code
  document.getElementById('confirmationName').textContent = name;
  document.getElementById('confirmationDate').textContent = date;
  document.getElementById('confirmationTime').textContent = time;
  document.getElementById('confirmationPeople').textContent = people;
  document.getElementById('confirmationTable').textContent = "Meja " + table;
  document.getElementById('confirmationTicket').textContent = ticketNumber; // Menampilkan nomor tiket dalam konfirmasi
  generateQRCode(qrCodeUrl); // Memanggil fungsi untuk membuat QR Code

  document.getElementById('reservationForm').reset();
  document.getElementById('reservationForm').classList.add('hidden');
  document.getElementById('confirmation').classList.remove('hidden');
});
