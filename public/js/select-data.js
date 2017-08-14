(function () {

	var w = window;

	var data = {

		day: {
			min: 1,
			max: 31,
			id: "user_info_day"
		},

		month: {
			min: 1,
			max: 12,
			id: "user_info_month"
		},

		year: {
			min: 1950,
			max: parseInt(new Date().getFullYear()) - 3,
			id: "user_info_year"
		}

	}

	w.data = data;

	w.createOption = function (value) {
		var opt = document.createElement("option");

		opt.value = value;
		opt.innerHTML = value;

		return opt;
	}

	w.onload = function () {

		if(document.querySelector("#" + w.data.day.id)) {
			var dayElement = document.querySelector("#" + w.data.day.id),
				monthElement = document.querySelector("#" + w.data.month.id),
				yearElement = document.querySelector("#" + w.data.year.id);

			for(var i = w.data.day.min; i <= w.data.day.max ; i++)  {
				dayElement.appendChild(w.createOption(i));
			}

			for(var i = w.data.month.min; i <= w.data.month.max ; i++) {
				monthElement.appendChild(w.createOption(i))
			}

			for(var i = w.data.year.min; i <= w.data.year.max ; i++) {
				yearElement.appendChild(w.createOption(i))
			}
	}
	

	}

})()