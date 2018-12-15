
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<!-- Latest compiled and minified CSS & JS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">

	<meta name="csrf-token" content="{{ csrf_token() }}">​
</head>
<body>
	<div class="container">
		<a href="#" class="btn btn-success btn-add" data-target="#modal-add" data-toggle="modal">Add</a>
		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Họ tên</th>
						<th>Giới tính</th>
						<th>Ngày sinh</th>
						<th>Số điện thoại</th>
						<th>Địa chỉ</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					{{-- biến $todos được controller trả cho view
						chứa dữ liệu tất cả các bản ghi trong bảng students. Dùng foreach để hiển
						thị từng bản ghi ra table này. --}}

						@foreach ($students as $student)
						<tr>
							<td>{{$student->id}}</td>
							<td>{{$student->hoten}}</td>
							<td>{{$student->gioitinh}}</td>
							<td>{{$student->ngaysinh}}</td>
							<td>{{$student->sdt}}</td>
							<td>{{$student->diachi}}</td>
							<td>
								<button data-url="{{ route('studentajax.show',$student->id) }}"​ type="button" data-target="#show" data-toggle="modal" class="btn btn-info btn-show">Detail</button>
								<button data-url="{{ route('studentajax.update',$student->id) }}"​ type="button" class="btn btn-warning btn-edit">Edit</button>
								<button data-url="{{ route('studentajax.destroy',$student->id) }}"​ type="button" class="btn btn-danger btn-delete">Delete</button>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			{{$students->links()}}
		</div>

		<script
		  src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"
		 ></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" type="text/javascript" charset="utf-8" async defer></script>
		<script type="text/javascript" charset="utf-8">
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
		</script>
		@include('student.add')
		@include('student.detail')
		@include('student.edit')
		<script type="text/javascript">
			$(document).ready(function () {

				$('#form-add').submit(function(e){

					e.preventDefault();

					var url = $(this).attr('data-url');

					$.ajax({
						type: 'post',
						url: url,
						data: {
							hoten: $('#hoten-add').val(),
							gioitinh: $('#gioitinh-add').val(),
							ngaysinh: $('#ngaysinh-add').val(),
							sdt: $('#sdt-add').val(),
							diachi: $('#diachi-add').val(),
						},
						success: function(response) {
							toastr.success('Add new student success!')
							//ẩn modal add đi
							$('#modal-add').modal('hide');
							setTimeout(function () {
								window.location.href="{{ route('studentajax.index') }}";
							},500);
						},
						error: function (jqXHR, textStatus, errorThrown) {
							//xử lý lỗi tại đây
						}
					})
				})

				$('.btn-show').click(function(){
					var url = $(this).attr('data-url');
					$.ajax({
						type: 'get',
						url: url,
						success: function(response) {
							console.log(response)

							$('h1#id').text(response.data.id)
							$('h1#hoten').text(response.data.hoten)
							$('h1#gioitinh').text(response.data.gioitinh)
							$('h1#ngaysinh').text(response.data.ngaysinh)
							$('h1#sdt').text(response.data.sdt)
							$('h1#diachi').text(response.data.diachi)
							$('h1#created_at').text(response.data.created_at)
							$('h1#update_at').text(response.data.update_at)
						},
						error: function (jqXHR, textStatus, errorThrown) {
							//xử lý lỗi tại đây
						}
					})
				})

				$('.btn-delete').click(function(){
					var url = $(this).attr('data-url');
					if (confirm('May co chac muon xoa khong?')) {
						$.ajax({
							type: 'delete',
							url: url,
							success: function(response) {
								window.location.reload()
							},
							error: function (jqXHR, textStatus, errorThrown) {
								//xử lý lỗi tại đây
							}
						})
					}
				})

				$('.btn-edit').click(function(e){

					var url = $(this).attr('data-url');

					$('#modal-edit').modal('show');

					e.preventDefault();

					$.ajax({
							//phương thức get
							type: 'get',
							url: url,
							success: function (response) {
								//đưa dữ liệu controller gửi về điền vào input trong form edit.
								$('#hoten-edit').val(response.data.hoten);
								$('#ngaysinh-edit').val(response.data.ngaysinh);
								$('#gioitinh-edit').val(response.data.gioitinh);
								$('#sdt-edit').val(response.data.sdt);
								$('#diachi-edit').val(response.data.diachi);
								//thêm data-url chứa route sửa todo đã được chỉ định vào form sửa.
								$('#form-edit').attr('data-url','{{ asset('studentajax/') }}/'+response.data.id)
							},
							error: function (error) {
								
							}
						})
				})

				$('#form-edit').submit(function(e){
					e.preventDefault();

					var url=$(this).attr('data-url');

					$.ajax({
						type: 'put',
						url: url,
						data: {
							hoten: $('#hoten-edit').val(),
							gioitinh: $('#gioitinh-edit').val(),
							ngaysinh: $('#ngaysinh-edit').val(),
							sdt: $('#sdt-edit').val(),
							diachi: $('#diachi-edit').val(),
						},
						success: function(response) {
							window.location.reload();
						},
						error: function (jqXHR, textStatus, errorThrown) {
							//xử lý lỗi tại đây
						}
					})
				})
			})
		</script>
	</body>
	</html>​