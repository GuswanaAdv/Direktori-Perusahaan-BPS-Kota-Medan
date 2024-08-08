<script>
document.getElementById('fileInput').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('preview');

    // Clear previous preview
    preview.innerHTML = '';

    if (file) {
        const reader = new FileReader();

        reader.onload = function(e) {
            const data = new Uint8Array(e.target.result);
            const workbook = XLSX.read(data, { type: 'array' });
            const firstSheetName = workbook.SheetNames[0];
            const worksheet = workbook.Sheets[firstSheetName];

            // Mengubah worksheet menjadi array
            const jsonData = XLSX.utils.sheet_to_json(worksheet, { header: 1 });

            // Membuat HTML tabel
            let html = `
            <div class="overflow-x-auto w-full mx-auto">
                <table class="table table-zebra">
                    <thead class="bg-grey">
                        <tr>
            `;

            // Menambahkan header
            jsonData[0].forEach(header => {
                html += `<th>${header}</th>`;
            });

            html += `</tr></thead><tbody>`;

            // Menambahkan baris data
            for (let i = 1; i < jsonData.length; i++) {
                if (i > 3) {
                    break; //Hanya Mengambil 3 baris pertama
                }
                html += '<tr>';
                jsonData[i].forEach(cell => {
                    html += `<td>${cell}</td>`;
                });
                html += '</tr>';
            }

            html += `</tbody></table></div>`;

            preview.innerHTML = html;
        };

        reader.readAsArrayBuffer(file);
    }

});
</script>
