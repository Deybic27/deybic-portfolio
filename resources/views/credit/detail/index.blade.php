@extends('credit.app')

@section('content')
<!-- <link rel="stylesheet" href="../css/detail-credit.css"> -->
<!-- <link rel="stylesheet" href="../icons/css/all.min.css"> -->
<!-- <script type="text/javascript" src="../js/credit.js"></script> -->

<!-- Scripts -->
@vite(['resources/icons/css/all.min.css', 'resources/js/credit.js', 'resources/css/detail-credit.css'])

<div class="container">
    <div class="row w-100 container-children" style="--bs-columns: 3;">
        <div class="col-lg-4 text-lg-center colum-h">
            <div class="grid">
                <div class="p-4"><span class="bold-text">Detalle cuotas</span></div>
                    @if ($credits->count() > 0)
                    @foreach ($credits as $credit)
                            <div class="row @if ($credit->id == $details->id) focus @endif">
                                <div class="col d-flex align-items-center">{{$credit->name_loan}}</div>
                                <div class="col d-flex align-items-center">{{number_format($credit->value_loan)}}</div>
                                <div class="col">
                                    <a class="btn btn-primary m-1" href="{{route('credits.show',['credit' => $credit->id])}}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                                <div class="col">
                                    <form action="{{route('credits.destroy',[$credit->id]);}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger m-1">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                    @endforeach
                    @else
                        No hay créditos registrados
                    @endif
                <hr class="mt-4">
            </div>
        </div>
        <div class="col-lg-4 text-lg-center colum-h">
            <div class="grid">
                <div class="p-4"><span class="bold-text">Detalle credito</span></div>
                @if ($details->count() > 0)
                        <div class="row">
                            <div class="col"><span class="bold-text">Valor</span></div>
                            <div class="col"><span class="bold-text"># cuotas</span></div>
                            <div class="col"><span class="bold-text">% intereses</span></div>
                        </div>
                        <div class="row">
                            <div class="col">{{number_format($details->value_loan)}}</div>
                            <div class="col">{{number_format($details->number_fee)}}</div>
                            <div class="col">{{number_format($details->value_interest,2)}}</div>
                        </div>
                        <hr class="mt-4">
                        <div class="row">
                            <div class="col"><span class="bold-text">Total intereses</span></div>
                            <div class="col"><span class="bold-text">Total a pagar</span></div>
                        </div>
                        <div class="row">
                            <div class="col">{{number_format($details->total_interest)}}</div>
                            <div class="col">{{number_format($details->total_to_pay)}}</div>
                        </div>
                        <hr class="mt-4">
                        <div class="p-4"><span class="bold-text">Detalle cuotas</span></div>
                        <div class="scroll-y detailfee">
                            <div class="row">
                                <div class="col"><span class="bold-text">#</span></div>
                                <div class="col"><span class="bold-text">Interés</span></div>
                                <div class="col"><span class="bold-text">Cuota</span></div>
                                <div class="col"><span class="bold-text">Total</span></div>
                            </div>
                            @for ($i = 1; $i <= $details->number_fee; $i++)
                            <div class="row">
                                <div class="col">{{$i}}</div>
                                <div class="col">{{number_format($value_interest[$i],2)}}</div>
                                <div class="col">{{number_format($value_fee)}}</div>
                                <div class="col">{{number_format($var[$i],2)}}</div>
                            </div>
                            @endfor
                        </div>
                        <hr class="mt-4">
                @else
                    Seleccione un crédito
                @endif                
            </div>
        </div>

        <div class="col-lg-4 text-lg-center colum-h">
            <div class="grid">
                <div class="p-4"><span class="bold-text">Registrar cuota</span></div>
                @if ($details->count() > 0)
                    <form action="{{route('storefee',[$details->id])}}" method="GET">
                        @csrf
                        <div class="row m-3">
                            <div class="col">
                                <input type="number" class="form-control m-1" name="value_fee" id="value_fee" placeholder="Value"> 
                                <input type="date" class="form-control m-1" name="date_fee" id="date_fee"> </div>
                                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i></button>
                        </div>
                    </form>                
                    <div class="scroll-y registerfee">
                        @foreach ($fees as $fee)
                            <div class="row">
                                <div class="col">{{$fee->consec_fee}}</div>
                                <div class="col">{{$fee->value_fee}}</div>
                                <div class="col">{{$fee->date_fee}}</div>
                            </div>
                        @endforeach
                    </div> 
                @else  
                    Seleccione un crédito                
                @endif
            </div>
        </div>
    </div>
</div>
@endsection