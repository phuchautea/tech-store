! function (e) {
    var t = {};

    function a(s) {
        if (t[s]) return t[s].exports;
        var o = t[s] = {
            i: s,
            l: !1,
            exports: {}
        };
        return e[s].call(o.exports, o, o.exports, a), o.l = !0, o.exports
    }
    a.m = e, a.c = t, a.d = function (e, t, s) {
        a.o(e, t) || Object.defineProperty(e, t, {
            enumerable: !0,
            get: s
        })
    }, a.r = function (e) {
        "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, {
            value: "Module"
        }), Object.defineProperty(e, "__esModule", {
            value: !0
        })
    }, a.t = function (e, t) {
        if (1 & t && (e = a(e)), 8 & t) return e;
        if (4 & t && "object" == typeof e && e && e.__esModule) return e;
        var s = Object.create(null);
        if (a.r(s), Object.defineProperty(s, "default", {
            enumerable: !0,
            value: e
        }), 2 & t && "string" != typeof e)
            for (var o in e) a.d(s, o, function (t) {
                return e[t]
            }.bind(null, o));
        return s
    }, a.n = function (e) {
        var t = e && e.__esModule ? function () {
            return e.default
        } : function () {
            return e
        };
        return a.d(t, "a", t), t
    }, a.o = function (e, t) {
        return Object.prototype.hasOwnProperty.call(e, t)
    }, a.p = "", a(a.s = 3)
}([function (e, t, a) {
    a.p = window.flatsomeVars ? window.flatsomeVars.assets_url : "/"
}, , , function (e, t, a) {
    a(0), e.exports = a(4)
}, function (e, t) {
    ! function (e) {
        "use strict";
        var t = "stacked" === flatsomeVars.options.swatches_layout,
            a = '<span class="ux-swatch-selected-value__separator">:&nbsp</span>',
            s = "ontouchstart" in window;
        e.fn.flatsomeSwatches = function () {
            return this.each((function () {
                var s = e(this);

                function o() {
                    setTimeout((function () {
                        s.find("tbody tr").each((function () {
                            var t = e(this),
                                a = t.find("select").find("option"),
                                s = a.filter(":selected"),
                                o = [];
                            a.each((function (e, t) {
                                "" !== t.value && o.push(t.value)
                            })), t.find(".ux-swatch").each((function () {
                                var t = e(this),
                                    a = t.attr("data-value"); - 1 !== o.indexOf(a) ? t.removeClass("disabled") : (t.addClass("disabled"), s.length && a === s.val() && t.removeClass("selected"))
                            }))
                        }))
                    }), 100)
                }

                function n() {
                    t && s.find(".ux-swatch.selected").each((function () {
                        var t = e(this).attr("data-name");
                        e(this).parents("tr").find(".ux-swatch-selected-value").html(a + t)
                    }))
                }
                s.hasClass("ux-swatches-js-attached") || (t && s.find(".variations td.label").append('<span class="ux-swatch-selected-value"></span>'), s.on("click", ".ux-swatch", (function (s) {
                    s.preventDefault();
                    var o = e(this),
                        n = o.closest(".value").find("select"),
                        c = o.data("value"),
                        i = o.data("name");
                    o.hasClass("disabled") || (o.hasClass("selected") ? (n.val(""), o.removeClass("selected"), t && o.parents("tr").find(".ux-swatch-selected-value").html("")) : (o.addClass("selected").siblings(".selected").removeClass("selected"), n.val(c), t && o.parents("tr").find(".ux-swatch-selected-value").html(a + i)), n.change())
                })), s.on("click", ".reset_variations", (function () {
                    s.find(".ux-swatch.selected").removeClass("selected"), s.find(".ux-swatch.disabled").removeClass("disabled"), t && s.find(".ux-swatch-selected-value").html("")
                })), o(), s.on("woocommerce_update_variation_values", (function () {
                    o()
                })), n(), s.on("show_variation", (function () {
                    n()
                })), s.addClass("ux-swatches-js-attached"))
            }))
        };
        var o = !flatsomeVars.options.swatches_box_behavior_selected,
            n = Boolean(flatsomeVars.options.swatches_box_update_urls),
            c = "click" === flatsomeVars.options.swatches_box_select_event ? "click" : "hover",
            i = Boolean(flatsomeVars.options.swatches_box_reset),
            r = flatsomeVars.options.swatches_box_reset_extent,
            l = parseInt(flatsomeVars.options.swatches_box_reset_time);
        e.fn.flatsomeSwatchesLoop = function () {
            return this.each((function () {
                var t = e(this);
                if (!t.hasClass("ux-swatches-in-loop-js-attached")) {
                    var a, u, d, f, h, m = t.closest(".product-small"),
                        v = m.find(".box-image a").first().attr("href"),
                        p = [],
                        w = !1;
                    if ("hover" === c && t.on("mouseenter", ".ux-swatch", (function (t) {
                        if (!s) {
                            var a = e(this);
                            x(), b(a)
                        }
                    })), t.on("click", ".ux-swatch", (function (t) {
                        t.preventDefault();
                        var a = e(this);
                        if (a.hasClass("selected")) {
                            if (o) return void (window.location = f || v);
                            a.removeClass("selected"), m.removeClass("ux-swatch-active"), C(), n && g(p)
                        } else x(), b(a)
                    })), t.on("click", ".ux-swatches__limiter", (function (t) {
                        var a = e(this);
                        a.parent().find(".ux-swatch.hidden").removeClass("hidden").fadeOut(0).fadeIn(500), a.hide(), e(document).trigger("flatsome-equalize-box")
                    })), i) {
                        var _ = "product-box" === r ? "" : ".ux-swatch";
                        ("product-box" === r ? m : t).on("mouseenter mouseleave", _, (function (e) {
                            if ("mouseleave" === e.type) {
                                var a = t.find(".selected");
                                a.length && (h = setTimeout((function () {
                                    a.removeClass("selected"), m.removeClass("ux-swatch-active"), C(), n && g(p)
                                }), l))
                            } else clearTimeout(h)
                        }))
                    }
                    t.addClass("ux-swatches-in-loop-js-attached")
                }

                function x() {
                    w || (a = m.find(".box-image img:not(.back-image)").first(), u = a.attr("src"), d = a.attr("srcset"), p.push(m.find(".box-image a").first()), p.push(m.find(".woocommerce-loop-product__link")), p.push(m.find(".product_type_variable.add_to_cart_button")), w = !0)
                }

                function b(e) {
                    e.hasClass("selected") || (t.find(".selected").removeClass("selected"), e.addClass("selected"), m.addClass("ux-swatch-active"), function (e) {
                        a.attr("src", e.data("image-src")), d && a.attr("srcset", e.data("image-srcset"))
                    }(e), n && function (e, t, a) {
                        var s = (t.indexOf("?") > -1 ? "&" : "?") + e.data("attribute_name") + "=" + e.data("value");
                        a.forEach((function (e) {
                            e.attr("href", t + s)
                        })), f = t + s
                    }(e, v, p))
                }

                function C() {
                    a && a.attr("src", u), d && a.attr("srcset", d)
                }

                function g(e) {
                    e.forEach((function (e) {
                        e.attr("href", v)
                    }))
                }
            }))
        }, e((function () {
            var t = ".ux-swatches-in-loop:not(.js-ux-swatches)";
            e(".variations_form").flatsomeSwatches(), e(t).flatsomeSwatchesLoop(), e(document).on("wc_variation_form", (function () {
                e(".variations_form").flatsomeSwatches()
            })), e(document.body).on("wc-composite-initializing", ".composite_data", (function (t, a) {
                a.actions.add_action("component_options_state_changed", (function (t) {
                    e(t.$component_content).find(".variations_form").removeClass("ux-swatches-js-attached")
                }))
            })), e(document).on("flatsome-infiniteScroll-append", (function (a, s, o, n) {
                e(t, n).flatsomeSwatchesLoop()
            })), "undefined" != typeof wp && wp.customize && wp.customize.selectiveRefresh && wp.customize.selectiveRefresh.bind("partial-content-rendered", (function (a) {
                e(t, a.container).flatsomeSwatchesLoop()
            })), e(document).ajaxComplete((function () {
                setTimeout((function () {
                    e(".variations_form:not(.ux-swatches-js-attached)").each((function () {
                        e(this).wc_variation_form()
                    })), e(t).flatsomeSwatchesLoop()
                }), 100)
            }))
        }))
    }(jQuery)
}]);