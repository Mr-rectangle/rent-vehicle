//ссылка на главную страницу сайта
var siteURL = "http://rent-vehicle.local/";


	//при нажатии на кнопку "добавить еще"
	function getMore (button, id) {

		//текущая страница товаров
		var currentPageInput = document.querySelector("#current-page");

		console.log(currentPageInput.value);
		//cоздать новый объект XMLHttpRequest и поместить в переменную ajax его адрес
		ajax = new XMLHttpRequest();
		//oткрыть запрос на сервер и передать туда, метод запроса и ссылку где происходит запрос
		ajax.open( "GET", siteURL + "modules/get_more.php?page=" + currentPageInput.value, false );
		//перейти на выбранную страницу
		ajax.send();

		//увеличить текущую страницу на 1
		currentPageInput.value++;
		//если больше нет товаров - скрыть кнопку
		if (ajax.response == "") {
			showMoreBtn.style.display = "none";
		}

		//текущее количество товаров
		var	productsBlock = document.querySelector("#about" + id);
		//добавить заданое в файле get_more.php кол-во товаров
		productsBlock.innerHTML = productsBlock.innerHTML + ajax.response;

		
	}
