<form method="POST" action="/convert-to-pdf" enctype="multipart/form-data">
    @csrf
    <input type="file" name="image">
    <button type="submit">Convert to PDF</button>
</form>
