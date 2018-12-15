{{-- Modal thêm mới todo --}}
<div class="modal fade" id="modal-add">
	<div class="modal-dialog">
		<div class="modal-content">

			<form action="" data-url="{{ route('studentajax.store') }}" id="form-add" method="POST" role="form">
				@csrf
				<div class="modal-header">
					<h4 class="modal-title">Add student</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">

					<div class="form-group">
						<label for="">Họ tên</label>
						<input name="hoten" type="text" class="form-control" id="hoten-add" placeholder="Nhập vào họ tên">
					</div>

					<div class="form-group">
						<label for="">Giới tính</label>
						<select name="gioitinh" id="gioitinh-add" class="form-control" required="required">
							<option value="Nam">Nam</option>
							<option value="Nữ">Nữ</option>
						</select>
					</div>

					<div class="form-group">
						<label for="">Ngày sinh</label>
						<input name="ngaysinh" type="date" name="" id="ngaysinh-add" class="form-control" value="" required="required" title="">
					</div>

					<div class="form-group">
						<label for="">Số điện thoại</label>
						<input name="sdt" type="number" class="form-control" id="sdt-add" placeholder="Nhập vào số điện thoại">
					</div>

					<div class="form-group">
						<label for="">Địa chỉ</label>
						<input name="diachi" type="text" class="form-control" id="diachi-add" placeholder="Nhập vào địa chỉ">
					</div>



				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Add</button>
				</div>
			</form>
		</div>
	</div>
</div>
