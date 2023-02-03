<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" rel="stylesheet" >
    <title>Testello</title>

</head>
<body>
    @empty(!$errors)

        @foreach ($errors->all() as $item)
            <div class="row">
                <div class="col-md-12">
                    <p class="alert alert-danger">{{ $item }}</p>
                </div>
            </div>
        @endforeach
    @endempty

    @isset($message)
        <div class="row">
            <div class="col-md-12">
                <p class="alert alert-danger">{{ $message }}</p>
            </div>
        </div>
    @endisset

    <div class="container mt-3">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
