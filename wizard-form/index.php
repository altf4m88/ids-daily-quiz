<!DOCTYPE html>
<html>
<head>
    <style>
        body{
            background-image: url('https://images.unsplash.com/photo-1612611741189-a9b9eb01d515?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
        }
    </style>
    <title>Modifikasi File JSON</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        var editedIndex = -1;  // Menyimpan indeks data yang sedang diedit

        $(document).ready(function() {
            // Mendapatkan data JSON saat halaman dimuat
            loadJSONData('usereal-daily.json');  // Menggunakan file JSON default saat halaman pertama kali dimuat

            // Event handler saat tombol "Ubah Data" diklik
            $('#ubah-data').click(function() {
                var question = $('#question').val();
                var answer = $('#answer').val();
                var explanation = $('#explanation').val();

                // Memeriksa apakah sedang dalam mode edit atau tambah
                if (editedIndex === -1) {
                    // Mode tambah data baru
                    var newData = {
                        question: question,
                        answer: answer,
                        explanation: explanation
                    };

                    addNewData(newData);
                } else {
                    // Mode edit data
                    var editedData = {
                        index: editedIndex,
                        question: question,
                        answer: answer,
                        explanation: explanation
                    };

                    updateData(editedData);

                    editedIndex = -1;  // Mengganti mode menjadi tambah setelah edit selesai
                }
            });

            // Event handler saat select box berubah
            $('#json-select').change(function() {
                var selectedJson = $(this).val();
                loadJSONData(selectedJson);
            });
        });

        // Fungsi untuk memuat data JSON dan menampilkan tabel
        function loadJSONData(jsonFile) {
            $.getJSON('../questions/' + jsonFile, function(data) {
                renderTable(data);  // Menampilkan tabel dengan data JSON yang dimuat
            });
        }

        // Fungsi untuk menambahkan data baru ke dalam JSON
        function addNewData(newData) {
            var selectedJson = $('#json-select').val();

            // Mendapatkan data JSON saat halaman dimuat
            $.getJSON('../questions/' + selectedJson, function(data) {
                data.push(newData);

                updateJSONFile(selectedJson, data);
            });
        }

        // Fungsi untuk memperbarui data yang sedang diedit
        function updateData(editedData) {
            var selectedJson = $('#json-select').val();

            // Mendapatkan data JSON saat halaman dimuat
            $.getJSON('../questions/' + selectedJson, function(data) {
                data[editedData.index].question = editedData.question;
                data[editedData.index].answer = editedData.answer;
                data[editedData.index].explanation = editedData.explanation;

                updateJSONFile(selectedJson, data);
            });
        }

        // Fungsi untuk mengupdate file JSON
        function updateJSONFile(jsonFile, data) {
            var selectedJson = $('#json-select').val();
            $.ajax({
                type: 'POST',
                url: 'update_json.php',
                data: { json: JSON.stringify(data) , thisFile:selectedJson },
                success: function(response) {
                    renderTable(data);  // Menampilkan tabel dengan data JSON yang diperbarui
                    clearForm();  // Mengosongkan formulir
                    Swal.fire('Success', '', 'success');
                },
                error: function() {
                    Swal.fire('Error', 'Terjadi kesalahan saat mengupdate file JSON.', 'error');
                }
            });
        }

        // Fungsi untuk menampilkan data JSON dalam bentuk tabel
        function renderTable(data) {
            var tableHtml = '<table class="table table-bordered"><thead><tr><th>Pertanyaan</th><th>Jawaban</th><th>Penjelasan</th><th>Aksi</th></tr></thead><tbody>';
            for (var i = 0; i < data.length; i++) {
                tableHtml += '<tr><td>' + data[i].question + '</td><td>' + data[i].answer + '</td><td>' + data[i].explanation + '</td><td><div class="d-flex gap-1"><button type="button" class="btn btn-primary btn-sm" onclick="editEntry(' + i + ')">Edit</button> <button type="button" class="btn btn-danger btn-sm" onclick="deleteEntry(' + i + ')">Hapus</button></div></td></tr>';
            }
            tableHtml += '</tbody></table```html
<!DOCTYPE html>
<html>
<head>
    <title>Modifikasi File JSON</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        var editedIndex = -1;  // Menyimpan indeks data yang sedang diedit

        $(document).ready(function() {
            // Mendapatkan data JSON saat halaman dimuat
            loadJSONData('usereal-daily.json');  // Menggunakan file JSON default saat halaman pertama kali dimuat

            // Event handler saat tombol "Ubah Data" diklik
            $('#ubah-data').click(function() {
                var question = $('#question').val();
                var answer = $('#answer').val();
                var explanation = $('#explanation').val();

                // Memeriksa apakah sedang dalam mode edit atau tambah
                if (editedIndex === -1) {
                    // Mode tambah data baru
                    var newData = {
                        question: question,
                        answer: answer,
                        explanation: explanation
                    };

                    addNewData(newData);
                } else {
                    // Mode edit data
                    var editedData = {
                        index: editedIndex,
                        question: question,
                        answer: answer,
                        explanation: explanation
                    };

                    updateData(editedData);

                    editedIndex = -1;  // Mengganti mode menjadi tambah setelah edit selesai
                }
            });

            // Event handler saat select box berubah
            $('#json-select').change(function() {
                var selectedJson = $(this).val();
                loadJSONData(selectedJson);
            });
        });

        // Fungsi untuk memuat data JSON dan menampilkan tabel
        function loadJSONData(jsonFile) {
            $.getJSON('../questions/' + jsonFile, function(data) {
                renderTable(data);  // Menampilkan tabel dengan data JSON yang dimuat
            });
        }

        // Fungsi untuk menambahkan data baru ke dalam JSON
        function addNewData(newData) {
            var selectedJson = $('#json-select').val();

            // Mendapatkan data JSON saat halaman dimuat
            $.getJSON('../questions/' + selectedJson, function(data) {
                data.push(newData);

                updateJSONFile(selectedJson, data);
            });
        }

        // Fungsi untuk memperbarui data yang sedang diedit
        function updateData(editedData) {
            var selectedJson = $('#json-select').val();

            // Mendapatkan data JSON saat halaman dimuat
            $.getJSON('../questions/' + selectedJson, function(data) {
                data[editedData.index].question = editedData.question;
                data[editedData.index].answer = editedData.answer;
                data[editedData.index].explanation = editedData.explanation;

                updateJSONFile(selectedJson, data);
            });
        }

        // Fungsi untuk mengupdate file JSON
        function updateJSONFile(jsonFile, data) {
            var selectedJson = $('#json-select').val();
            $.ajax({
                type: 'POST',
                url: 'update_json.php',
                data: { json: JSON.stringify(data) , thisFile:selectedJson},
                success: function(response) {
                    renderTable(data);  // Menampilkan tabel dengan data JSON yang diperbarui
                    clearForm();  // Mengosongkan formulir
                    Swal.fire('Success', '', 'success');
                },
                error: function() {
                    Swal.fire('Error', 'Terjadi kesalahan saat mengupdate file JSON.', 'error');
                }
            });
        }

        // Fungsi untuk menampilkan data JSON dalam bentuk tabel
        function renderTable(data) {
            var tableHtml = '<table class="table table-bordered"><thead><tr><th>Pertanyaan</th><th>Jawaban</th><th>Penjelasan</th><th>Aksi</th></tr></thead><tbody>';
            for (var i = 0; i < data.length; i++) {
                tableHtml += '<tr><td>' + data[i].question + '</td><td>' + data[i].answer + '</td><td>' + data[i].explanation + '</td><td><div class="d-flex gap-1"><button type="button" class="btn btn-primary btn-sm" onclick="editEntry(' + i + ')">Edit</button> <button type="button" class="btn btn-danger btn-sm" onclick="deleteEntry(' + i + ')">Hapus</button></div></td></tr>';
            }
            tableHtml += '</tbody></table>';

            $('#data-table').html(tableHtml);
        }

        // Fungsi untuk mengosongkan formulir
        function clearForm() {
            $('#question').val('');
            $('#answer').val('');
            $('#explanation').val('');
        }

        // Fungsi untuk menghapus entri dalam JSON
        function deleteEntry(index) {
            var selectedJson = $('#json-select').val();

            // Mendapatkan data JSON saat halaman dimuat
            $.getJSON('../questions/' + selectedJson, function(data) {
                data.splice(index, 1);

                updateJSONFile(selectedJson, data);
            });
        }

        // Fungsi untuk mengisi formulir dengan data yang akan diedit
        function editEntry(index) {
            var selectedJson = $('#json-select').val();

            // Mendapatkan data JSON saat halaman dimuat
            $.getJSON('../questions/' + selectedJson, function(data) {
                var editedData = data[index];

                $('#question').val(editedData.question);
                $('#answer').val(editedData.answer);
                $('#explanation').val(editedData.explanation);

                editedIndex = index;  // Menyimpan indeks data yang sedang diedit
            });
        }
    </script>
</head>
<body>
    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col d-flex justify-content-center">
                <h2>
                    Json Wizard
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="p-3 bg-light card">
                    <div class="mb-3">
                        <label for="json-select" class="form-label">Soucre:</label>
                        <select id="json-select" class="form-select">
                            <option value="usereal-daily.json" selected>Useral</option>
                            <option value="dolmen-daily.json">Dolmen</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="question" class="form-label">Pertanyaan:</label>
                        <input type="text" class="form-control" id="question">
                    </div>
                    <div class="mb-3">
                        <label for="answer" class="form-label">Jawaban:</label>
                        <input type="text" class="form-control" id="answer">
                    </div>
                    <div class="mb-3">
                        <label for="explanation" class="form-label">Penjelasan:</label>
                        <textarea class="form-control" id="explanation" rows="3"></textarea>
                    </div>
                    <button type="button" class="btn btn-primary" id="ubah-data">Submit</button>
                </div>
            </div>
            <div class="col-md">
                <div id="data-table"></div>
            </div>
        </div>
    </div>
</body>
</html>