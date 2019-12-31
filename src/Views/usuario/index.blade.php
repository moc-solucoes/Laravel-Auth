@extends('Core::shared.able-pro')

@section('css')
    <link rel="stylesheet" href="{{asset('able-pro/icon/icofont/css/icofont.css')}}" type="text/css" media="all">
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{route('usuario.meus-dados')}}">Meus Dados</a>
    </li>
@endsection

@section('title')
    Meus Dados
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-12">
            @include('Core::shared/_messages')
            <!-- tab header start -->
            <div class="tab-header card">
                <ul class="nav nav-tabs md-tabs tab-timeline" role="tablist" id="mytab">
                    <li class="nav-item">
                        <a class="nav-link active show" data-toggle="tab" href="#personal" role="tab"
                           aria-selected="true">
                            <button type="button" class="btn btn-mini btn-outline-primary float-left ml-3">
                                <i class="fa fa-edit"></i>
                            </button>
                            Informações Pessoais
                        </a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#senha" role="tab" aria-selected="false">
                            Senha
                        </a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#vinculacao" role="tab" aria-selected="false">
                            Vinculações
                        </a>
                        <div class="slide"></div>
                    </li>
                </ul>
            </div>
            <!-- tab header end -->
            <!-- tab content start -->
            <div class="tab-content">
                <!-- Start: Pessoal -->
                <div class="tab-pane active show" id="personal" role="tabpanel">
                    <!-- personal card start -->
                    <div class="card">
                        <div class="card-block">
                            <br/>
                            <div class="view-info">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="general-info">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="table-responsive">
                                                        <table class="table m-0">
                                                            <tbody>
                                                            <tr>
                                                                <th scope="row">Nome Completo</th>
                                                                <td>{{$usuario->nome}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">E-mail</th>
                                                                <td>{{$usuario->email}}</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <!-- end of table col-lg-6 -->
                                            {{--
                                            <div class="col-lg-12 col-xl-6">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tbody>
                                                        <tr>
                                                            <th scope="row">Email</th>
                                                            <td><a href="#!">Demo@example.com</a></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Mobile Number</th>
                                                            <td>(0123) - 4567891</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Twitter</th>
                                                            <td>@xyz</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Skype</th>
                                                            <td>demo.skype</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Website</th>
                                                            <td><a href="#!">www.demo.com</a></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            --}}
                                            <!-- end of table col-lg-6 -->
                                            </div>
                                            <!-- end of row -->
                                        </div>
                                        <!-- end of general info -->
                                    </div>
                                    <!-- end of col-lg-12 -->
                                </div>
                                <!-- end of row -->
                            </div>
                            <!-- end of view-info -->
                            <div class="edit-info" style="display: none;">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="general-info form-material">
                                            <div class="row">
                                                <div class="col-lg-6 ">


                                                    <div class="material-group">
                                                        <div class="material-addone">
                                                            <i class="icofont icofont-user"></i>
                                                        </div>
                                                        <div class="form-group form-primary">
                                                            <input type="text" name="footer-email" class="form-control"
                                                                   required="">
                                                            <span class="form-bar"></span>
                                                            <label class="float-label">Full Name</label>
                                                        </div>
                                                    </div>
                                                    <div class="material-group">
                                                        <div class="material-addone">
                                                            <i class="fa fa-mars-double"></i>
                                                        </div>
                                                        <div class="form-group form-primary">
                                                            <div class="form-radio">
                                                                <div class="group-add-on">
                                                                    <div class="radio radiofill radio-inline">
                                                                        <label>
                                                                            <input type="radio" name="radio" checked=""><i
                                                                                class="helper"></i> Male
                                                                        </label>
                                                                    </div>
                                                                    <div class="radio radiofill radio-inline">
                                                                        <label>
                                                                            <input type="radio" name="radio"><i
                                                                                class="helper"></i> Female
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="material-group">
                                                        <div class="material-addone">
                                                            <i class="fa fa-birthday-cake"></i>
                                                        </div>
                                                        <div class="form-group form-primary">
                                                            <input type="text" name="footer-email" class="form-control"
                                                                   required="">
                                                            <span class="form-bar"></span>
                                                            <label class="float-label">Select Your Birth Date</label>
                                                        </div>
                                                    </div>


                                                    <div class="material-group">
                                                        <div class="material-addone">
                                                            <i class="fa fa-heart"></i>
                                                        </div>
                                                        <div class="form-group form-primary">
                                                            <select id="hello-single" class="form-control">
                                                                <option value="">---- Marital Status ----</option>
                                                                <option value="married">Married</option>
                                                                <option value="unmarried">Unmarried</option>
                                                            </select>
                                                            <span class="form-bar"></span>

                                                        </div>
                                                    </div>


                                                    <div class="material-group">
                                                        <div class="material-addone">
                                                            <i class="icofont icofont-location-pin"></i>
                                                        </div>
                                                        <div class="form-group form-primary">
                                                            <input type="text" name="footer-email" class="form-control"
                                                                   required="">
                                                            <span class="form-bar"></span>
                                                            <label class="float-label">Address</label>
                                                        </div>
                                                    </div>


                                                </div>
                                                <!-- end of table col-lg-6 -->
                                                <div class="col-lg-6">

                                                    <div class="material-group">
                                                        <div class="material-addone">
                                                            <i class="icofont icofont-mobile-phone"></i>
                                                        </div>
                                                        <div class="form-group form-primary">
                                                            <input type="text" name="footer-email" class="form-control"
                                                                   required="">
                                                            <span class="form-bar"></span>
                                                            <label class="float-label">Mobile Number</label>
                                                        </div>
                                                    </div>


                                                    <div class="material-group">
                                                        <div class="material-addone">
                                                            <i class="icofont icofont-social-twitter"></i>
                                                        </div>
                                                        <div class="form-group form-primary">
                                                            <input type="text" name="footer-email" class="form-control"
                                                                   required="">
                                                            <span class="form-bar"></span>
                                                            <label class="float-label">Twitter Id</label>
                                                        </div>
                                                    </div>


                                                    <div class="material-group">
                                                        <div class="material-addone">
                                                            <i class="icofont icofont-social-skype"></i>
                                                        </div>
                                                        <div class="form-group form-primary">
                                                            <input type="text" name="footer-email" class="form-control"
                                                                   required="">
                                                            <span class="form-bar"></span>
                                                            <label class="float-label">Skype Id</label>
                                                        </div>
                                                    </div>


                                                    <div class="material-group">
                                                        <div class="material-addone">
                                                            <i class="icofont icofont-earth"></i>
                                                        </div>
                                                        <div class="form-group form-primary">
                                                            <input type="text" name="footer-email" class="form-control"
                                                                   required="">
                                                            <span class="form-bar"></span>
                                                            <label class="float-label">website</label>
                                                        </div>
                                                    </div>


                                                </div>
                                                <!-- end of table col-lg-6 -->
                                            </div>
                                            <!-- end of row -->
                                            <div class="text-center">
                                                <a href="#!" class="btn btn-primary waves-effect waves-light m-r-20">Save</a>
                                                <a href="#!" id="edit-cancel" class="btn btn-default waves-effect">Cancel</a>
                                            </div>
                                        </div>
                                        <!-- end of edit info -->
                                    </div>
                                    <!-- end of col-lg-12 -->
                                </div>
                                <!-- end of row -->
                            </div>
                            <!-- end of edit-info -->
                        </div>
                        <!-- end of card-block -->
                    </div>
                    <!-- personal card end-->
                </div>
                <!-- End: Pessoal -->
                <!-- Start: Senha -->
                <div class="tab-pane" id="senha" role="tabpanel">
                    @include('usuario._alterar')
                </div>
                <!-- End: Senha -->
                <!-- Start: Vinculações -->
                <div class="tab-pane" id="vinculacao" role="tabpanel">
                    {{alert('Em breve estará disponível a vinculação com a conta das plataformas (Facebook e Google+).', 'warning')}}
                    <br />
                    {{alert('Clique nos botões abaixo para vincular sua conta.')}}
                    <br />

                    <div class="row col-md-4">
                        <div class="col-md-6">
                            <button class="btn btn-facebook m-b-20 btn-block">
                                <i class="icofont icofont-social-facebook"></i>
                                Facebook
                            </button>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-google-plus m-b-20 btn-block">
                                <i class="icofont icofont-social-google-plus"></i>
                                Google+
                            </button>
                        </div>
                    </div>
                </div>
                <!-- End: Vinculações -->
            </div>
            <!-- tab content end -->
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#dataTable').DataTable({
                "aaSorting": [[0, "desc"]]
            });
        });
    </script>
@endsection
