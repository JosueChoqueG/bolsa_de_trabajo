<script type="text/javascript">
	@if (Session::has('msg-info'))
 	toastr.info("{!! Session::get('msg-info') !!}","Aviso",{
		"closeButton": true,
 		"timeOut":10000,
 		"progressBar": true,
 		"showMethod": "fadeIn",
			"hideMethod": "fadeOut"

 	})
 	@endif	
 	@if (Session::has('msg-success'))
 	toastr.success("{!! Session::get('msg-success') !!}","Operacion realizada con exito",{
		"closeButton": true,
 		"timeOut":10000,
 		"progressBar": true,
 		"showMethod": "fadeIn",
			"hideMethod": "fadeOut"

 	})
 	@endif	
 	@if (Session::has('msg-warning'))
 	toastr.warning("{!! Session::get('msg-warning') !!}","Advertencia",{
		"closeButton": true,
 		"timeOut":10000,
 		"progressBar": true,
 		"showMethod": "fadeIn",
			"hideMethod": "fadeOut"

 	})
 	@endif	
 	@if (Session::has('msg-error'))
 	toastr.error("{!! Session::get('msg-error') !!}","Ocurrio un error",{
		"closeButton": true,
 		"timeOut":10000,
 		"progressBar": true,
 		"showMethod": "fadeIn",
			"hideMethod": "fadeOut"

 	})
	 @endif	
	 @if (Session::has('msg-danger'))
 	toastr.error("{!! Session::get('msg-error') !!}","Ocurrio un error",{
		"closeButton": true,
 		"timeOut":10000,
 		"progressBar": true,
 		"showMethod": "fadeIn",
			"hideMethod": "fadeOut"

 	})
 	@endif	
</script>
