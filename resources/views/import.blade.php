
    <div class="card bg-light mt-3">
        @if (session('import_error'))
            <div class="alert alert-danger">{{ session("import_error") }}</div>
        @endif
        
        <div class="card-body">
            <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data" style="    width: 300px;   text-align: center;    margin: 0 auto;">
                @csrf
                <input type="file" name="file" class="form-control">
                <br>
                <button class="btn btn-success">Import User Data</button>
            </form>
        </div>
    </div>