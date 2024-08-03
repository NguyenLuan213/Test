<footer class="footer">
    <div class="container-fluid">
        <div class="row text-muted">
            <div class="col-6 text-start">
                <p class="mb-0">
                    <a class="text-muted" href="https://www.facebook.com/603879660" target="_blank"><strong>Admin - TL</strong></a>
                </p>
            </div>
            <div class="col-6 text-end">
                <ul class="list-inline">
                    
                </ul>
            </div>
        </div>
    </div>
</footer>
<script src="./js/app.js"></script>
<script src="./js/simple-datatables.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    let table1 = document.querySelector('#table1');
    let dataTable = new simpleDatatables.DataTable(table1);
</script>

<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('imagePreview');
            output.src = reader.result;
            output.classList.remove('d-none'); // Xóa class 'd-none'
        }
        reader.readAsDataURL(event.target.files[0]);
    }

    function previewVideo(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('videoPreview');
            output.src = reader.result;
            output.classList.remove('d-none'); // Xóa class 'd-none'
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
</body>

</html>