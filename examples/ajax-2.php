<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<style>
	form {
		width: 300px;
		margin-bottom: 30px;
	}
	form input, form textarea {
		width: 300px;
		float:left;
		margin-bottom: 20px;
	}
</style>
	<div>Добавим/обновим/удалим элемент из базы данных</div>
	<h2>Добавим</h2>
	<form action="/" data-method="PUT">
		<input type="text" name="name" placeholder="Имя">
		<input type="text" name="age" placeholder="Возвраст">
		<textarea name="text" id="" cols="30" rows="10"></textarea>
		<button>Добавить</button>
	</form>
	<hr>
	<h3>Изменим</h3>
	<form action="/" data-method="POST">
		<input type="text" name="id" placeholder="id элемента">
		<input type="text" name="name" placeholder="Имя">
		<input type="text" name="age" placeholder="Возвраст">
		<textarea name="text" id="" cols="30" rows="10"></textarea>
		<button>Изменить</button>
	</form>
	<hr>
	<h3>Удалим</h3>
	<form action="/" data-method="DELETE">
		<input type="text" name="id" placeholder="id элемента">
		<button>УДАЛИТЬ</button>
	</form>
	<script>
		$('form').on('submit', function(e) {
			e.preventDefault();
			var data = $(this).serialize();
			var method = $(this).data('method');

			$.ajax({
				type:method,
				url:"/ajax/putchangedelete.php",
				data:data,
				success:function(data) {
					console.log(data);
				}
			})
		})
	</script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>