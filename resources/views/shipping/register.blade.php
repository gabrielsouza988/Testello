@include('elements.header')
    <div class="container mt-3">
        @empty(!$errors)

            @foreach ($errors->all() as $item)
                <div class="row">
                    <div class="col-md-12">
                        <p class="alert alert-danger">{{ $item }}</p>
                    </div>
                </div>
            @endforeach
        @endempty

        @if(session('message'))
            <div class="row">
                <div class="col-md-12">
                    <p class="alert alert-danger">{{ session('message') }}</p>
                </div>
            </div>
        @endif

        <form action="{{ route('register-tabela-frete') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-5">
                    <label for="customer">Cliente</label>
                    <select name="customer" id="customer" class="form-control">
                        <option value=""></option>
                        @foreach ($customers as $row)
                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5">
                    <label for="file_csv">Arquivo</label>
                    <input type="file" name="file_csv" id="file_csv" class="form-control">
                </div>
            </div>
            <div class="row mt-2 mb-2">
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </div>
        </form>


        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Detalhes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $row)
                            <tr>
                                <td>{{ $row->name }}</td>
                                <td>
                                    <a href="{{ route('detail', $row->id) }}" class="text-primary">
                                        Detalhes
                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" fill="currentColor" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352c79.5 0 144-64.5 144-144s-64.5-144-144-144S64 128.5 64 208s64.5 144 144 144z"/></svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@include('elements.footer')
