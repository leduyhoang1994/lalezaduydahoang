<?php require_once "clientRequestController.php";?>
<head>
	<script type="text/javascript" src="jquery.min.js"></script>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$("#GetOrders").submit(function(event) {
				$.ajax({
					url: 'https://htmlpreview.github.io/?https://github.com/leduyhoang1994/lalezaduydahoang/blob/master/index.php',
					type: 'GET',
					dataType: 'html',
					data: $("#GetOrders").serialize(),
				})
				.done(function(e) {
					console.log(e);
					iterateData(e);
				})
				.fail(function(e) {
					console.log(e);
					console.log("error");
					$("#debug-log").append(e);
				})
				.always(function() {
					console.log("complete");
				});
				event.preventDefault();
			});
		});

		function iterateData(data){
			$("#list").html("");
			$.each(data.SuccessResponse.Body.Orders, function(index, el) {
				var element = $('<tr/>');
				var id = $('<th/>',{text : index+1}).attr('scope','row');
				var name = $('<td/>',{text : el.CustomerFirstName + el.CustomerLastName});
				var price = $('<td/>',{text : el.Price});
				var paymentMethod = $('<td/>',{text : el.PaymentMethod});
				id.appendTo(element);
				name.appendTo(element);
				price.appendTo(element);
				paymentMethod.appendTo(element);
				element.appendTo('#list');
			});
		}
	</script>
</head>
<body>
	<div class="container">
		<form id="GetOrders" target="" method="GET">
			<div class="row">
				<input type="hidden" name="Action" value="GetOrders">
				Trạng thái :
				<select class="form-control" id="Status" name="Status">
					<option value="">Tất cả</option>
					<option value="pending">Đang chờ</option>
					<option value="Canceled">Đã hủy</option>
					<option value="ready_to_ship">Chuẩn bị ship</option>
					<option value="delivered">Đã nhận</option>
					<option value="returned">Đã trả lại</option>
					<option value="shipped">Đã chuyển</option>
					<option value="failed">Thất bại</option>
				</select>
			</div>
			<div class="row">
				Hiển thị tối đa :
				<input class="form-control" type="number" name="Limit" id="Limit" min="1">
			</div>
			<div class="row">
				Sắp xếp theo :
				<label><input class="form-control" type="radio" name="SortBy" value="created_at">Ngày tạo</label>
				<label><input class="form-control" type="radio" name="SortBy" value="updated_at">Ngày nhận</label>
			</div>
			<div class="row">
				Thứ tự :
				<label><input class="form-control" type="radio" name="SortDirection" value="ASC">Tăng</label>
				<label><input class="form-control" type="radio" name="SortDirection" value="DESC">Giảm</label>
			</div>
			<div class="row">
				<input type="submit" name="" value="Lọc" class="btn btn-default">
			</div>
		</form>
	</div>
	<table class="table table-hover">
	  <thead>
	    <tr>
	      <th>#</th>
	      <th>Name</th>
	      <th>Price</th>
	      <th>Payment Method</th>
	    </tr>
	  </thead>
	  <tbody id="list">
	  </tbody>
	</table>
	<div id="">
		<p id="debug-log">
			
		</p>
	</div>
</body>
