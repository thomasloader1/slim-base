/**!
 * Sortable
 * @author	RubaXa   <trash@rubaxa.org>
 * @license MIT
 */
!(function(t) {
    "use strict";
    "function" == typeof define && define.amd ? define(t) : "undefined" != typeof module && void 0 !== module.exports ? (module.exports = t()) : (window.Sortable = t());
})(function() {
    "use strict";
    if ("undefined" == typeof window || !window.document)
        return function() {
            throw new Error("Sortable.js requires a window with a document");
        };
    var t,
        e,
        n,
        i,
        o,
        r,
        a,
        s,
        l,
        c,
        d,
        h,
        u,
        f,
        p,
        g,
        v,
        m,
        b,
        _,
        D,
        y = {},
        w = /\s+/g,
        T = /left|right|inline/,
        C = "Sortable" + new Date().getTime(),
        S = window,
        E = S.document,
        x = S.parseInt,
        N = S.jQuery || S.Zepto,
        k = S.Polymer,
        B = !1,
        Y = !!("draggable" in E.createElement("div")),
        O = !navigator.userAgent.match(/Trident.*rv[ :]?11\./) && (((D = E.createElement("x")).style.cssText = "pointer-events:auto"), "auto" === D.style.pointerEvents),
        X = !1,
        A = Math.abs,
        M = Math.min,
        P = [],
        R = [],
        I = nt(function(t, e, n) {
            if (n && e.scroll) {
                var i,
                    o,
                    r,
                    a,
                    d,
                    h,
                    u = n[C],
                    f = e.scrollSensitivity,
                    p = e.scrollSpeed,
                    g = t.clientX,
                    v = t.clientY,
                    m = window.innerWidth,
                    b = window.innerHeight;
                if (l !== n && ((s = e.scroll), (l = n), (c = e.scrollFn), !0 === s)) {
                    s = n;
                    do {
                        if (s.offsetWidth < s.scrollWidth || s.offsetHeight < s.scrollHeight) break;
                    } while ((s = s.parentNode));
                }
                s && ((i = s), (o = s.getBoundingClientRect()), (r = (A(o.right - g) <= f) - (A(o.left - g) <= f)), (a = (A(o.bottom - v) <= f) - (A(o.top - v) <= f))),
                    r || a || ((a = (b - v <= f) - (v <= f)), ((r = (m - g <= f) - (g <= f)) || a) && (i = S)),
                    (y.vx === r && y.vy === a && y.el === i) ||
                    ((y.el = i),
                        (y.vx = r),
                        (y.vy = a),
                        clearInterval(y.pid),
                        i &&
                        (y.pid = setInterval(function() {
                            if (((h = a ? a * p : 0), (d = r ? r * p : 0), "function" == typeof c)) return c.call(u, d, h, t);
                            i === S ? S.scrollTo(S.pageXOffset + d, S.pageYOffset + h) : ((i.scrollTop += h), (i.scrollLeft += d));
                        }, 24)));
            }
        }, 30),
        L = function(t) {
            function e(t, e) {
                return (
                    (void 0 !== t && !0 !== t) || (t = n.name),
                    "function" == typeof t ?
                    t :
                    function(n, i) {
                        var o = i.options.group.name;
                        return e ? t : t && (t.join ? t.indexOf(o) > -1 : o == t);
                    }
                );
            }
            var n = {},
                i = t.group;
            (i && "object" == typeof i) || (i = { name: i }), (n.name = i.name), (n.checkPull = e(i.pull, !0)), (n.checkPut = e(i.put)), (n.revertClone = i.revertClone), (t.group = n);
        };

    function F(t, e) {
        if (!t || !t.nodeType || 1 !== t.nodeType) throw "Sortable: `el` must be HTMLElement, and not " + {}.toString.call(t);
        (this.el = t), (this.options = e = it({}, e)), (t[C] = this);
        var n = {
            group: Math.random(),
            sort: !0,
            disabled: !1,
            store: null,
            handle: null,
            scroll: !0,
            scrollSensitivity: 30,
            scrollSpeed: 10,
            draggable: /[uo]l/i.test(t.nodeName) ? "li" : ">*",
            ghostClass: "sortable-ghost",
            chosenClass: "sortable-chosen",
            dragClass: "sortable-drag",
            ignore: "a, img",
            filter: null,
            preventOnFilter: !0,
            animation: 0,
            setData: function(t, e) {
                t.setData("Text", e.textContent);
            },
            dropBubble: !1,
            dragoverBubble: !1,
            dataIdAttr: "data-id",
            delay: 0,
            forceFallback: !1,
            fallbackClass: "sortable-fallback",
            fallbackOnBody: !1,
            fallbackTolerance: 0,
            fallbackOffset: { x: 0, y: 0 },
        };
        for (var i in n) !(i in e) && (e[i] = n[i]);
        for (var o in (L(e), this)) "_" === o.charAt(0) && "function" == typeof this[o] && (this[o] = this[o].bind(this));
        (this.nativeDraggable = !e.forceFallback && Y),
        W(t, "mousedown", this._onTapStart),
            W(t, "touchstart", this._onTapStart),
            W(t, "pointerdown", this._onTapStart),
            this.nativeDraggable && (W(t, "dragover", this), W(t, "dragenter", this)),
            R.push(this._onDragOver),
            e.store && this.sort(e.store.get(this));
    }

    function U(e, n) {
        "clone" !== e.lastPullMode && (n = !0), i && i.state !== n && (z(i, "display", n ? "none" : ""), n || (i.state && (e.options.group.revertClone ? (o.insertBefore(i, r), e._animate(t, i)) : o.insertBefore(i, t))), (i.state = n));
    }

    function j(t, e, n) {
        if (t) {
            n = n || E;
            do {
                if ((">*" === e && t.parentNode === n) || et(t, e)) return t;
            } while ((t = H(t)));
        }
        return null;
    }

    function H(t) {
        var e = t.host;
        return e && e.nodeType ? e : t.parentNode;
    }

    function W(t, e, n) {
        t.addEventListener(e, n, B);
    }

    function V(t, e, n) {
        t.removeEventListener(e, n, B);
    }

    function q(t, e, n) {
        if (t)
            if (t.classList) t.classList[n ? "add" : "remove"](e);
            else {
                var i = (" " + t.className + " ").replace(w, " ").replace(" " + e + " ", " ");
                t.className = (i + (n ? " " + e : "")).replace(w, " ");
            }
    }

    function z(t, e, n) {
        var i = t && t.style;
        if (i) {
            if (void 0 === n) return E.defaultView && E.defaultView.getComputedStyle ? (n = E.defaultView.getComputedStyle(t, "")) : t.currentStyle && (n = t.currentStyle), void 0 === e ? n : n[e];
            e in i || (e = "-webkit-" + e), (i[e] = n + ("string" == typeof n ? "" : "px"));
        }
    }

    function G(t, e, n) {
        if (t) {
            var i = t.getElementsByTagName(e),
                o = 0,
                r = i.length;
            if (n)
                for (; o < r; o++) n(i[o], o);
            return i;
        }
        return [];
    }

    function Q(t, e, n, o, r, a, s) {
        t = t || e[C];
        var l = E.createEvent("Event"),
            c = t.options,
            d = "on" + n.charAt(0).toUpperCase() + n.substr(1);
        l.initEvent(n, !0, !0), (l.to = e), (l.from = r || e), (l.item = o || e), (l.clone = i), (l.oldIndex = a), (l.newIndex = s), e.dispatchEvent(l), c[d] && c[d].call(t, l);
    }

    function Z(t, e, n, i, o, r, a, s) {
        var l,
            c,
            d = t[C],
            h = d.options.onMove;
        return (
            (l = E.createEvent("Event")).initEvent("move", !0, !0),
            (l.to = e),
            (l.from = t),
            (l.dragged = n),
            (l.draggedRect = i),
            (l.related = o || e),
            (l.relatedRect = r || e.getBoundingClientRect()),
            (l.willInsertAfter = s),
            t.dispatchEvent(l),
            h && (c = h.call(d, l, a)),
            c
        );
    }

    function J(t) {
        t.draggable = !1;
    }

    function K() {
        X = !1;
    }

    function $(t) {
        for (var e = t.tagName + t.className + t.src + t.href + t.textContent, n = e.length, i = 0; n--;) i += e.charCodeAt(n);
        return i.toString(36);
    }

    function tt(t, e) {
        var n = 0;
        if (!t || !t.parentNode) return -1;
        for (; t && (t = t.previousElementSibling);) "TEMPLATE" === t.nodeName.toUpperCase() || (">*" !== e && !et(t, e)) || n++;
        return n;
    }

    function et(t, e) {
        if (t) {
            var n = (e = e.split(".")).shift().toUpperCase(),
                i = new RegExp("\\s(" + e.join("|") + ")(?=\\s)", "g");
            return !(("" !== n && t.nodeName.toUpperCase() != n) || (e.length && ((" " + t.className + " ").match(i) || []).length != e.length));
        }
        return !1;
    }

    function nt(t, e) {
        var n, i;
        return function() {
            void 0 === n &&
                ((n = arguments),
                    (i = this),
                    setTimeout(function() {
                        1 === n.length ? t.call(i, n[0]) : t.apply(i, n), (n = void 0);
                    }, e));
        };
    }

    function it(t, e) {
        if (t && e)
            for (var n in e) e.hasOwnProperty(n) && (t[n] = e[n]);
        return t;
    }

    function ot(t) {
        return N ? N(t).clone(!0)[0] : k && k.dom ? k.dom(t).cloneNode(!0) : t.cloneNode(!0);
    }
    (F.prototype = {
        constructor: F,
        _onTapStart: function(e) {
            var n,
                i = this,
                o = this.el,
                r = this.options,
                s = r.preventOnFilter,
                l = e.type,
                c = e.touches && e.touches[0],
                d = (c || e).target,
                h = (e.target.shadowRoot && e.path && e.path[0]) || d,
                u = r.filter;
            if (
                ((function(t) {
                    var e = t.getElementsByTagName("input"),
                        n = e.length;
                    for (; n--;) {
                        var i = e[n];
                        i.checked && P.push(i);
                    }
                })(o), !t && !((/mousedown|pointerdown/.test(l) && 0 !== e.button) || r.disabled) && (d = j(d, r.draggable, o)) && a !== d)
            ) {
                if (((n = tt(d, r.draggable)), "function" == typeof u)) {
                    if (u.call(this, e, d, this)) return Q(i, h, "filter", d, o, n), void(s && e.preventDefault());
                } else if (
                    u &&
                    (u = u.split(",").some(function(t) {
                        if ((t = j(h, t.trim(), o))) return Q(i, t, "filter", d, o, n), !0;
                    }))
                )
                    return void(s && e.preventDefault());
                (r.handle && !j(h, r.handle, o)) || this._prepareDragStart(e, c, d, n);
            }
        },
        _prepareDragStart: function(n, i, s, l) {
            var c,
                d = this,
                h = d.el,
                u = d.options,
                p = h.ownerDocument;
            s &&
                !t &&
                s.parentNode === h &&
                ((m = n),
                    (o = h),
                    (e = (t = s).parentNode),
                    (r = t.nextSibling),
                    (a = s),
                    (g = u.group),
                    (f = l),
                    (this._lastX = (i || n).clientX),
                    (this._lastY = (i || n).clientY),
                    (t.style["will-change"] = "transform"),
                    (c = function() {
                        d._disableDelayedDrag(), (t.draggable = d.nativeDraggable), q(t, u.chosenClass, !0), d._triggerDragStart(n, i), Q(d, o, "choose", t, o, f);
                    }),
                    u.ignore.split(",").forEach(function(e) {
                        G(t, e.trim(), J);
                    }),
                    W(p, "mouseup", d._onDrop),
                    W(p, "touchend", d._onDrop),
                    W(p, "touchcancel", d._onDrop),
                    W(p, "pointercancel", d._onDrop),
                    W(p, "selectstart", d),
                    u.delay ?
                    (W(p, "mouseup", d._disableDelayedDrag),
                        W(p, "touchend", d._disableDelayedDrag),
                        W(p, "touchcancel", d._disableDelayedDrag),
                        W(p, "mousemove", d._disableDelayedDrag),
                        W(p, "touchmove", d._disableDelayedDrag),
                        W(p, "pointermove", d._disableDelayedDrag),
                        (d._dragStartTimer = setTimeout(c, u.delay))) :
                    c());
        },
        _disableDelayedDrag: function() {
            var t = this.el.ownerDocument;
            clearTimeout(this._dragStartTimer),
                V(t, "mouseup", this._disableDelayedDrag),
                V(t, "touchend", this._disableDelayedDrag),
                V(t, "touchcancel", this._disableDelayedDrag),
                V(t, "mousemove", this._disableDelayedDrag),
                V(t, "touchmove", this._disableDelayedDrag),
                V(t, "pointermove", this._disableDelayedDrag);
        },
        _triggerDragStart: function(e, n) {
            (n = n || ("touch" == e.pointerType ? e : null)) ?
            ((m = { target: t, clientX: n.clientX, clientY: n.clientY }), this._onDragStart(m, "touch")) :
            this.nativeDraggable ?
                (W(t, "dragend", this), W(o, "dragstart", this._onDragStart)) :
                this._onDragStart(m, !0);
            try {
                E.selection ?
                    setTimeout(function() {
                        E.selection.empty();
                    }) :
                    window.getSelection().removeAllRanges();
            } catch (t) {}
        },
        _dragStarted: function() {
            if (o && t) {
                var e = this.options;
                q(t, e.ghostClass, !0), q(t, e.dragClass, !1), (F.active = this), Q(this, o, "start", t, o, f);
            } else this._nulling();
        },
        _emulateDragOver: function() {
            if (b) {
                if (this._lastX === b.clientX && this._lastY === b.clientY) return;
                (this._lastX = b.clientX), (this._lastY = b.clientY), O || z(n, "display", "none");
                var t = E.elementFromPoint(b.clientX, b.clientY),
                    e = t,
                    i = R.length;
                if (e)
                    do {
                        if (e[C]) {
                            for (; i--;) R[i]({ clientX: b.clientX, clientY: b.clientY, target: t, rootEl: e });
                            break;
                        }
                        t = e;
                    } while ((e = e.parentNode));
                O || z(n, "display", "");
            }
        },
        _onTouchMove: function(t) {
            if (m) {
                var e = this.options,
                    i = e.fallbackTolerance,
                    o = e.fallbackOffset,
                    r = t.touches ? t.touches[0] : t,
                    a = r.clientX - m.clientX + o.x,
                    s = r.clientY - m.clientY + o.y,
                    l = t.touches ? "translate3d(" + a + "px," + s + "px,0)" : "translate(" + a + "px," + s + "px)";
                if (!F.active) {
                    if (i && M(A(r.clientX - this._lastX), A(r.clientY - this._lastY)) < i) return;
                    this._dragStarted();
                }
                this._appendGhost(), (_ = !0), (b = r), z(n, "webkitTransform", l), z(n, "mozTransform", l), z(n, "msTransform", l), z(n, "transform", l), t.preventDefault();
            }
        },
        _appendGhost: function() {
            if (!n) {
                var e,
                    i = t.getBoundingClientRect(),
                    r = z(t),
                    a = this.options;
                q((n = t.cloneNode(!0)), a.ghostClass, !1),
                    q(n, a.fallbackClass, !0),
                    q(n, a.dragClass, !0),
                    z(n, "top", i.top - x(r.marginTop, 10)),
                    z(n, "left", i.left - x(r.marginLeft, 10)),
                    z(n, "width", i.width),
                    z(n, "height", i.height),
                    z(n, "opacity", "0.8"),
                    z(n, "position", "fixed"),
                    z(n, "zIndex", "100000"),
                    z(n, "pointerEvents", "none"),
                    (a.fallbackOnBody && E.body.appendChild(n)) || o.appendChild(n),
                    (e = n.getBoundingClientRect()),
                    z(n, "width", 2 * i.width - e.width),
                    z(n, "height", 2 * i.height - e.height);
            }
        },
        _onDragStart: function(e, n) {
            var r = e.dataTransfer,
                a = this.options;
            this._offUpEvents(),
                g.checkPull(this, this, t, e) && (((i = ot(t)).draggable = !1), (i.style["will-change"] = ""), z(i, "display", "none"), q(i, this.options.chosenClass, !1), o.insertBefore(i, t), Q(this, o, "clone", t)),
                q(t, a.dragClass, !0),
                n ?
                ("touch" === n ?
                    (W(E, "touchmove", this._onTouchMove), W(E, "touchend", this._onDrop), W(E, "touchcancel", this._onDrop), W(E, "pointermove", this._onTouchMove), W(E, "pointerup", this._onDrop)) :
                    (W(E, "mousemove", this._onTouchMove), W(E, "mouseup", this._onDrop)),
                    (this._loopId = setInterval(this._emulateDragOver, 50))) :
                (r && ((r.effectAllowed = "move"), a.setData && a.setData.call(this, r, t)), W(E, "drop", this), setTimeout(this._dragStarted, 0));
        },
        _onDragOver: function(a) {
            var s,
                l,
                c,
                f,
                p = this.el,
                m = this.options,
                b = m.group,
                D = F.active,
                y = g === b,
                w = !1,
                S = m.sort;
            if (
                (void 0 !== a.preventDefault && (a.preventDefault(), !m.dragoverBubble && a.stopPropagation()), !t.animated && ((_ = !0), D && !m.disabled && (y ? S || (f = !o.contains(t)) : v === this || ((D.lastPullMode = g.checkPull(this, D, t, a)) && b.checkPut(this, D, t, a))) && (void 0 === a.rootEl || a.rootEl === this.el)))
            ) {
                if ((I(a, m, this.el), X)) return;
                if (((s = j(a.target, m.draggable, p)), (l = t.getBoundingClientRect()), v !== this && ((v = this), (w = !0)), f)) return U(D, !0), (e = o), void(i || r ? o.insertBefore(t, i || r) : S || o.appendChild(t));
                if (
                    0 === p.children.length ||
                    p.children[0] === n ||
                    (p === a.target &&
                        (function(t, e) {
                            var n = t.lastElementChild.getBoundingClientRect();
                            return e.clientY - (n.top + n.height) > 5 || e.clientX - (n.left + n.width) > 5;
                        })(p, a))
                ) {
                    if ((0 !== p.children.length && p.children[0] !== n && p === a.target && (s = p.lastElementChild), s)) {
                        if (s.animated) return;
                        c = s.getBoundingClientRect();
                    }
                    U(D, y), !1 !== Z(o, p, t, l, s, c, a) && (t.contains(p) || (p.appendChild(t), (e = p)), this._animate(l, t), s && this._animate(c, s));
                } else if (s && !s.animated && s !== t && void 0 !== s.parentNode[C]) {
                    d !== s && ((d = s), (h = z(s)), (u = z(s.parentNode)));
                    var E = (c = s.getBoundingClientRect()).right - c.left,
                        x = c.bottom - c.top,
                        N = T.test(h.cssFloat + h.display) || ("flex" == u.display && 0 === u["flex-direction"].indexOf("row")),
                        k = s.offsetWidth > t.offsetWidth,
                        B = s.offsetHeight > t.offsetHeight,
                        Y = (N ? (a.clientX - c.left) / E : (a.clientY - c.top) / x) > 0.5,
                        O = s.nextElementSibling,
                        A = !1;
                    if (N) {
                        var M = t.offsetTop,
                            P = s.offsetTop;
                        A = M === P ? (s.previousElementSibling === t && !k) || (Y && k) : s.previousElementSibling === t || t.previousElementSibling === s ? (a.clientY - c.top) / x > 0.5 : P > M;
                    } else w || (A = (O !== t && !B) || (Y && B));
                    var R = Z(o, p, t, l, s, c, a, A);
                    !1 !== R &&
                        ((1 !== R && -1 !== R) || (A = 1 === R),
                            (X = !0),
                            setTimeout(K, 30),
                            U(D, y),
                            t.contains(p) || (A && !O ? p.appendChild(t) : s.parentNode.insertBefore(t, A ? O : s)),
                            (e = t.parentNode),
                            this._animate(l, t),
                            this._animate(c, s));
                }
            }
        },
        _animate: function(t, e) {
            var n = this.options.animation;
            if (n) {
                var i = e.getBoundingClientRect();
                1 === t.nodeType && (t = t.getBoundingClientRect()),
                    z(e, "transition", "none"),
                    z(e, "transform", "translate3d(" + (t.left - i.left) + "px," + (t.top - i.top) + "px,0)"),
                    e.offsetWidth,
                    z(e, "transition", "all " + n + "ms"),
                    z(e, "transform", "translate3d(0,0,0)"),
                    clearTimeout(e.animated),
                    (e.animated = setTimeout(function() {
                        z(e, "transition", ""), z(e, "transform", ""), (e.animated = !1);
                    }, n));
            }
        },
        _offUpEvents: function() {
            var t = this.el.ownerDocument;
            V(E, "touchmove", this._onTouchMove),
                V(E, "pointermove", this._onTouchMove),
                V(t, "mouseup", this._onDrop),
                V(t, "touchend", this._onDrop),
                V(t, "pointerup", this._onDrop),
                V(t, "touchcancel", this._onDrop),
                V(t, "pointercancel", this._onDrop),
                V(t, "selectstart", this);
        },
        _onDrop: function(a) {
            var s = this.el,
                l = this.options;
            clearInterval(this._loopId),
                clearInterval(y.pid),
                clearTimeout(this._dragStartTimer),
                V(E, "mousemove", this._onTouchMove),
                this.nativeDraggable && (V(E, "drop", this), V(s, "dragstart", this._onDragStart)),
                this._offUpEvents(),
                a &&
                (_ && (a.preventDefault(), !l.dropBubble && a.stopPropagation()),
                    n && n.parentNode && n.parentNode.removeChild(n),
                    (o !== e && "clone" === F.active.lastPullMode) || (i && i.parentNode && i.parentNode.removeChild(i)),
                    t &&
                    (this.nativeDraggable && V(t, "dragend", this),
                        J(t),
                        (t.style["will-change"] = ""),
                        q(t, this.options.ghostClass, !1),
                        q(t, this.options.chosenClass, !1),
                        Q(this, o, "unchoose", t, o, f),
                        o !== e ?
                        (p = tt(t, l.draggable)) >= 0 && (Q(null, e, "add", t, o, f, p), Q(this, o, "remove", t, o, f, p), Q(null, e, "sort", t, o, f, p), Q(this, o, "sort", t, o, f, p)) :
                        t.nextSibling !== r && (p = tt(t, l.draggable)) >= 0 && (Q(this, o, "update", t, o, f, p), Q(this, o, "sort", t, o, f, p)),
                        F.active && ((null != p && -1 !== p) || (p = f), Q(this, o, "end", t, o, f, p), this.save()))),
                this._nulling();
        },
        _nulling: function() {
            (o = t = e = n = r = i = a = s = l = m = b = _ = p = d = h = v = g = F.active = null),
            P.forEach(function(t) {
                    t.checked = !0;
                }),
                (P.length = 0);
        },
        handleEvent: function(e) {
            switch (e.type) {
                case "drop":
                case "dragend":
                    this._onDrop(e);
                    break;
                case "dragover":
                case "dragenter":
                    t &&
                        (this._onDragOver(e),
                            (function(t) {
                                t.dataTransfer && (t.dataTransfer.dropEffect = "move");
                                t.preventDefault();
                            })(e));
                    break;
                case "selectstart":
                    e.preventDefault();
            }
        },
        toArray: function() {
            for (var t, e = [], n = this.el.children, i = 0, o = n.length, r = this.options; i < o; i++) j((t = n[i]), r.draggable, this.el) && e.push(t.getAttribute(r.dataIdAttr) || $(t));
            return e;
        },
        sort: function(t) {
            var e = {},
                n = this.el;
            this.toArray().forEach(function(t, i) {
                    var o = n.children[i];
                    j(o, this.options.draggable, n) && (e[t] = o);
                }, this),
                t.forEach(function(t) {
                    e[t] && (n.removeChild(e[t]), n.appendChild(e[t]));
                });
        },
        save: function() {
            var t = this.options.store;
            t && t.set(this);
        },
        closest: function(t, e) {
            return j(t, e || this.options.draggable, this.el);
        },
        option: function(t, e) {
            var n = this.options;
            if (void 0 === e) return n[t];
            (n[t] = e), "group" === t && L(n);
        },
        destroy: function() {
            var t = this.el;
            (t[C] = null),
            V(t, "mousedown", this._onTapStart),
                V(t, "touchstart", this._onTapStart),
                V(t, "pointerdown", this._onTapStart),
                this.nativeDraggable && (V(t, "dragover", this), V(t, "dragenter", this)),
                Array.prototype.forEach.call(t.querySelectorAll("[draggable]"), function(t) {
                    t.removeAttribute("draggable");
                }),
                R.splice(R.indexOf(this._onDragOver), 1),
                this._onDrop(),
                (this.el = t = null);
        },
    }),
    W(E, "touchmove", function(t) {
        F.passive && t.preventDefault();
    });
    try {
        window.addEventListener(
            "test",
            null,
            Object.defineProperty({}, "passive", {
                get: function() {
                    B = { capture: !1, passive: !1 };
                },
            })
        );
    } catch (t) {}
    return (
        (F.utils = {
            on: W,
            off: V,
            css: z,
            find: G,
            is: function(t, e) {
                return !!j(t, e, t);
            },
            extend: it,
            throttle: nt,
            closest: j,
            toggleClass: q,
            clone: ot,
            index: tt,
        }),
        (F.create = function(t, e) {
            return new F(t, e);
        }),
        (F.version = "1.6.1"),
        F
    );
});