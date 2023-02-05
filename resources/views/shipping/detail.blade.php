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

        <form action="{{ route('update-tabela-frete', $customer->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="row">
                <div class="col-md-5">
                    <label for="file_csv">Arquivo</label>
                    <input type="file" name="file_csv" id="file_csv" class="form-control">
                </div>
                <div class="col-md-3 mt-4">
                    <button type="submit" class="btn btn-primary">Atualizar tabela</button>
                </div>
                <div class="col-md-4 mt-4 d-flex justify-content-end">
                    <a href="{{ route('index') }}" class="btn btn-primary">voltar</a>
                </div>
            </div>
        </form>


        <div class="row mt-3">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>de</th>
                            <th>até</th>
                            <th>peso inicial</th>
                            <th>peso final</th>
                            <th>custo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($shippings as $row)
                            <tr>
                                <td>{{ $row->from_postcode }}</td>
                                <td>{{ $row->to_postcode }}</td>
                                <td>{{ $row->from_weight }}</td>
                                <td>{{ $row->to_weight }}</td>
                                <td>{{ $row->cost }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                {{ $shippings->links() }}
            </div>
        </div>
    </div>
@include('elements.footer')
