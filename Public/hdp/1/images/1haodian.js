// JavaScript Document


function O() {
			var h = $("#lunbo_1");
			var g = h.closest("li").find(".mini_promo img");
			k(g);
			var m = $("#lunbo_2");
			if (m.length > 0) {
				e(m, function() {
					if (!m.data("data-loaded")) {
						$("#lunboNum").show();
						f("#promo_show");
						m.data("data-loaded", 1)
					}
				});
				setTimeout(function() {
					if (!m.data("data-loaded")) {
						$("#lunboNum").show();
						f("#promo_show");
						m.data("data-loaded", 1)
					}
				}, 5000)
			}
			function f(n) {
				o();

				function o() {
					var u = $("ol", "#promo_show").width(),
						p = $("#promo_show>ul>li"),
						B = $("#index_menu_carousel>ol"),
						r = $("#index_menu_carousel>ol>li"),
						y = r.length,
						A;
					var s = r.first();
					r.last().clone().prependTo(B);
					B.width(u * (y + 2) + 100).css("left", "-" + u + "px");
					$("#promo_show").hover(function() {
						$(this).children("a").show();
						clearInterval(A)
					}, function() {
						$(this).children("a").hide();
						clearInterval(A);
						A = setInterval(function() {
							t(z())
						}, 5000)
					}).trigger("mouseout");
					p.hover(function() {
						var C = p.index(this);
						$(this).addClass("cur").siblings().removeClass("cur");
						$("ol", "#index_menu_carousel").stop(true).animate({
							left: "-" + (C + 1) * u + "px"
						}, 360);
						w(z())
					});
					$(".show_next,.show_pre", "#promo_show").click(function() {
						var C = z();
						if ($("ol", "#index_menu_carousel").is(":animated")) {
							return
						}
						if ($(this).hasClass("show_pre")) {
							$("ol", "#index_menu_carousel").animate({
								left: "+=" + u + "px"
							}, 360, function() {
								if (C > 0) {
									p.eq(C - 1).addClass("cur").siblings().removeClass("cur");
									w(C - 1)
								} else {
									if (C == 0) {
										$("ol", "#index_menu_carousel").css("left", "-" + u * (y) + "px");
										p.eq(-1).addClass("cur").siblings().removeClass("cur");
										var D = $("#index_menu_carousel>ol>li").eq(0).find(".mini_promo img");
										k(D);
										w(y - 1)
									}
								}
							})
						} else {
							t(C)
						}
						return false
					});

					function t(C) {
						if (C == y - 1) {
							s.addClass("cur").css("left", u * y)
						}
						$("ol", "#index_menu_carousel").stop(true, true).animate({
							left: "-=" + u + "px"
						}, 360, function() {
							if (C < y - 1) {
								p.eq(C + 1).addClass("cur").siblings().removeClass("cur");
								w(C + 1)
							} else {
								if (C == y - 1) {
									s.removeClass("cur").css("left", -u);
									$("ol", "#index_menu_carousel").css("left", "-" + u + "px");
									p.eq(0).addClass("cur").siblings().removeClass("cur")
								}
							}
						})
					}
					function z() {
						return $("ul>li", "#promo_show").index($("ul>li.cur", "#promo_show"))
					}
					function w(ac) {
						var D = $(r.eq(ac));
						var ad = D.data("data-loader");
						if (!ad && ad != 1) {
							var C = D.find(".mini_promo img");
							k(C);
							D.data("data-loaded", 1)
						}
					}
					var x = l();
					var v = $("#promo_show").find(".big_pic img[" + x + "]");
					len = v.length, flag = 0;
					var q = setInterval(function() {
						if (flag >= len) {
							clearInterval(q);
							return
						}
						var D = $(v[flag]);
						var C = D.attr(x);
						if (C) {
							D.attr("src", C);
							D.removeAttr(x)
						}
						flag++
					}, 200)
				}
			}
			function k(o) {
				var n = o.length;
				for (var q = 0; q < n; q++) {
					var r = $(o[q]);
					var p = r.attr(l());
					if (p) {
						r.attr("src", p);
						r.removeAttr(l())
					}
				}
			}
			function e(q, o) {
				q = $(q);
				var n = l();
				var p = q.attr(n);
				if (p) {
					q.load(function() {
						var r = q.data("data-callback");
						if (o && !r) {
							o.call(this);
							q.data("data-callback", 1)
						}
					});
					q.attr("src", p);
					q.removeAttr(n)
				}
			}
			function l() {
				var n = "si";
				if (window.isWidescreen) {
					n = "wi"
				}
				return n
			}
		}




O()