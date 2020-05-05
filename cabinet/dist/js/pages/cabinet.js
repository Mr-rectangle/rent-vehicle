//пошук
var form_find=document.querySelector("#find-date");
form.onsubmit=function find(element){
	
	var link=element.dataset.link;
	//створюємо новий обєкт для выдправки http запиту
	var ajax=new XMLHttpRequest();
		// відкриваємо посилання, передаючи метод запиту і саме посилання 
		ajax.open("GET",link,false);
		//надсилаємо запит
		ajax.send();
	//event.preventDefault();
	console.log(ajax);
	var list_order=document.querySelector("#list-order");
		list_oreder.innerHTML=ajax.response;
//	ajax.close;
}
