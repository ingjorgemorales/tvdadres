@extends('layouts.app')

@section('css')
<style>
    ul {
        list-style-type: none;
    }

    .d-none {
        display: none;
    }

    .open-dropdown {
        font-weight: bold;
        cursor: pointer;
    }
</style>
@endsection

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Archivos del Usuario</h3>
                </div>
                <div class="card-body">
                    <div>
                        <ul>
                            <li class="open-dropdown">{{ "+ ". "📁 " . $nombre }}</li>
                                <ul class="dropdown d-none">
                                @foreach ($archivos as $archivo)    
                                    <li><a href="{{ $url . "/" . $archivo->getFilename() }}" target="_blank"> {{ "📄 " . $archivo->getFilename() }}</a></li>
                                @endforeach
                                </ul>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@section('js')
    <script>
		$(document).ready(function(){
		  $(".open-dropdown").click(function(){
		    $(this).next( "ul.dropdown" ).toggleClass('d-none');
		  });
		});
	</script>
@endsection
@endsection
