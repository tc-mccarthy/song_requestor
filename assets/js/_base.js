var app = {
	ele: {},
	template: {},
	init: function () {
		var _this = this;
		$(_this.onReady.bind(_this));
		$(window).scroll(_this.onScroll.bind(_this));
		$(window).resize(_this.onResize.bind(_this));
		$(window).load(_this.onLoad.bind(_this));
	},

	onReady: function () {
		var _this = this;
		this.binds();
		this.registerTemplates();
		this.resultsVirgin = $("#results").html();
	},

	onLoad: function () {
		var _this = this;
	},

	onScroll: function () {
		var _this = this;
	},

	onResize: function () {
		var _this = this;
	},

	binds: function () {
		var _this = this;

		$("body").on("keyup", "#search", { context: _this }, function (e) {
			clearTimeout(_this.searchTimer);
			_this.searchTimer = setTimeout(function () {
				_this.searchAutocomplete();
			}, 250);
		});
		$("body").on("click", "a.play", { context: _this }, _this.startTrack);
		$("body").on("click", "a.pause", { context: _this }, _this.stopTrack);
	},

	registerTemplates: function () {
		var _this = this;
		_this.registerTemplate($("#results_template"), "results");
	},

	registerTemplate: function (ele, key) {
		var _this = this;

		if (ele.length > 0) {
			_this.template[key] = _.template(ele.html());
		}
	},

	searchAutocomplete: function () {
		var term = $("#search").val(),
			_this = this;

		if (term.length >= 3) {
			$("#results").removeClass("active");
			$("#results table").html(_this.resultsVirgin);
			_this.spotifyLookup(term, "track", function (data) {
				var items = _.map(data.tracks.items, function (item) {
					return {
						track_name: item.name,
						spotify_id: item.id,
						artist: item.artists[0].name,
						album: item.album.name,
						album_image: item.album.images[1].url,
						preview_track: item.preview_url
					};
				});

				_.each(items, function (item) {
					$("#results table").append(_this.template.results({ item: item }));
				});

				$("#results").addClass("active");


			});
		}
	},

	spotifyLookup: function (term, type, cb) {
		var _this = this,
			response;
		$.getJSON("https://api.spotify.com/v1/search?type=track&q=" + term, function (success) {
			response = success;
		}).done(function () {
			cb(response);
		});
	},

	startTrack: function (e) {
		e.preventDefault();

		var ele = $(this),
			_this = e.data.context,
			audio = ele.next("audio");

		ele.removeClass("play").addClass("pause");

		$("audio").each(function () {
			var ele = $(this);
			_this.pause(ele);
		});

		_this.play(audio);
	},

	stopTrack: function (e) {
		e.preventDefault();

		var ele = $(this),
			_this = e.data.context,
			audio = ele.next("audio");

		ele.removeClass("pause").addClass("play");

		_this.pause(audio);
	},

	pause: function (audio) {
		audio[0].pause();
		audio.closest(".item").find(".fa.fa-pause-circle-o").removeClass("fa-pause-circle-o").addClass("fa-play-circle-o");
	},

	play: function (audio) {
		audio[0].play();
		audio.closest(".item").find(".fa.fa-play-circle-o").removeClass("fa-play-circle-o").addClass("fa-pause-circle-o");
	}
};

app.init();
