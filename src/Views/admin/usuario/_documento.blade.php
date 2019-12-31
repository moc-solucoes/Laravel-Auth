<div class="card">
    <div class="card-block">
        <div class="col col-12">
            <table id="dataTable" class="table table-striped dataTable">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Projeto</th>
                    <th>Nome</th>
                    <th class="text-right">Tamanho</th>
                    <th>Tipo</th>
                    <th class="text-center">Data</th>
                    <th class="text-center">Downloads</th>
                    <th class="text-center">Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($documentos as $documento)
                    @foreach($documento->Files as $file)
                        <tr>
                            <th>#{{$file->id}}</th>
                            <td>{{$documento->nome}}</td>
                            <td data-toggle="tooltip" data-placement="top"
                                title="{{$file->filename}}">
                                {{$file->description}}
                            </td>
                            <td class="text-right">{{$file->filesize}}</td>
                            <td>{{$file->content_type}}</td>
                            <td class="text-center">{{$file->created_on}}</td>
                            <td class="text-center">{{$file->downloads}}</td>
                            {{--                <td>{{$documento->prazo}}</td>--}}
                            <th class="text-center">
                                <a class="btn btn-mini btn-outline-success"
                                   href="{{$file->content_url}}" target="_blank"
                                   data-toggle="tooltip"
                                   data-placement="top" title="Download">
                                    <i class="fa fa-download"></i>
                                </a>

                                <a class="btn btn-mini btn-outline-info"
                                   href="{{route('admin.notificar.documento', ['idFile' => $file->id, 'idProjeto' => $documento->id])}}"
                                   data-toggle="tooltip"
                                   data-placement="top" title="Notificar">
                                    <i class="fa fa-envelope"></i>
                                </a>
                            </th>
                        </tr>
                    @endforeach
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
