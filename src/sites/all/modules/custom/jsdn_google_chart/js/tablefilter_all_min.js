﻿function tf_GetNodeText(t) {
    var e = t.textContent || t.innerText || t.innerHTML.replace(/\<[^<>]+>/g, "");
    return e = e.replace(/^\s+/, "").replace(/\s+$/, ""), e.tf_Trim()
}

function tf_IsObj(t) {
    var e = !1;
    return "string" == (typeof t).tf_LCase() ? window[t] && "object" == (typeof window[t]).tf_LCase() && (e = !0) : t && "object" == (typeof t).tf_LCase() && (e = !0), e
}

function tf_IsFn(t) {
    return t && t.constructor == Function
}

function tf_IsArray(t) {
    return t.constructor == Array
}

function tf_Id(t) {
    return document.getElementById(t)
}

function tf_Tag(t, e) {
    return t.getElementsByTagName(e)
}

function tf_RegexpEscape(t) {
    function e(e) {
        a = new RegExp("\\" + e, "g"), t = t.replace(a, "\\" + e)
    }
    chars = new Array("\\", "[", "^", "$", ".", "|", "?", "*", "+", "(", ")");
    for (var s = 0; s < chars.length; s++) e(chars[s]);
    return t
}

function tf_CreateElm(t) {
    if (void 0 != t && null != t && "" != t) {
        var e = document.createElement(t);
        if (arguments.length > 1)
            for (var s = 0; s < arguments.length; s++) {
                var i = typeof arguments[s];
                switch (i.tf_LCase()) {
                    case "object":
                        2 == arguments[s].length && e.setAttribute(arguments[s][0], arguments[s][1])
                }
            }
        return e
    }
}

function tf_CreateText(t) {
    return document.createTextNode(t)
}

function tf_CreateOpt(t, e, s) {
    var i = s ? !0 : !1,
        l = i ? tf_CreateElm("option", ["value", e], ["selected", "true"]) : tf_CreateElm("option", ["value", e]);
    return l.appendChild(tf_CreateText(t)), l
}

function tf_CreateCheckItem(t, e, s) {
    if (void 0 != t && void 0 != e && void 0 != s) {
        var i = tf_CreateElm("li"),
            l = tf_CreateElm("label", ["for", t]),
            a = tf_CreateElm("input", ["id", t], ["name", t], ["type", "checkbox"], ["value", e]);
        return l.appendChild(a), l.appendChild(tf_CreateText(s)), i.appendChild(l), i.label = l, i.check = a, i
    }
}

function tf_AddEvent(t, e, s, i) {
    t.attachEvent ? t.attachEvent("on" + e, s) : t.addEventListener ? t.addEventListener(e, s, void 0 == i ? !1 : i) : t["on" + e] = s
}

function tf_RemoveEvent(t, e, s, i) {
    t.detachEvent ? t.detachEvent("on" + e, s) : t.removeEventListener ? t.removeEventListener(e, s, void 0 == i ? !1 : i) : t["on" + e] = null
}

function tf_StopEvent(t) {
    t || (t = window.event), t.stopPropagation ? t.stopPropagation() : t.cancelBubble = !0
}

function tf_CancelEvent(t) {
    t || (t = window.event), t.preventDefault ? t.preventDefault() : t.returnValue = !1
}

function tf_ObjPosition(t, e) {
    var s = 0,
        i = 0;
    if (t && t.offsetParent && e.tf_Has(t.nodeName.tf_LCase()))
        do s += t.offsetLeft, i += t.offsetTop; while (t = t.offsetParent);
    return [s, i]
}

function tf_NumSortAsc(t, e) {
    return t - e
}

function tf_NumSortDesc(t, e) {
    return e - t
}

function tf_IgnoreCaseSort(t, e) {
    var s = t.tf_LCase(),
        i = e.tf_LCase();
    return i > s ? -1 : s > i ? 1 : 0
}

function tf_HasClass(t, e) {
    return t ? t.className.match(new RegExp("(\\s|^)" + e + "(\\s|$)")) : !1
}

function tf_AddClass(t, e) {
    t && (tf_HasClass(t, e) || (t.className += " " + e))
}

function tf_RemoveClass(t, e) {
    if (t && tf_HasClass(t, e)) {
        var s = new RegExp("(\\s|^)" + e + "(\\s|$)");
        t.className = t.className.replace(s, "")
    }
}

function tf_IsValidDate(t, e) {
    if (null == e && (e = "DMY"), e = e.toUpperCase(), 3 != e.length && "DDMMMYYYY" == e) {
        var s = tf_FormatDate(t, e);
        t = s.getDate() + "/" + (s.getMonth() + 1) + "/" + s.getFullYear(), e = "DMY"
    }
    if ((-1 == e.indexOf("M") || -1 == e.indexOf("D") || -1 == e.indexOf("Y")) && (e = "DMY"), "Y" == e.substring(0, 1)) var i = /^\d{2}(\-|\/|\.)\d{1,2}\1\d{1,2}$/,
        l = /^\d{4}(\-|\/|\.)\d{1,2}\1\d{1,2}$/;
    else if ("Y" == e.substring(1, 2)) var i = /^\d{1,2}(\-|\/|\.)\d{2}\1\d{1,2}$/,
        l = /^\d{1,2}(\-|\/|\.)\d{4}\1\d{1,2}$/;
    else var i = /^\d{1,2}(\-|\/|\.)\d{1,2}\1\d{2}$/,
        l = /^\d{1,2}(\-|\/|\.)\d{1,2}\1\d{4}$/;
    if (0 == i.test(t) && 0 == l.test(t)) return !1;
    var a = t.split(RegExp.$1);
    if ("M" == e.substring(0, 1)) var n = a[0];
    else if ("M" == e.substring(1, 2)) var n = a[1];
    else var n = a[2];
    if ("D" == e.substring(0, 1)) var r = a[0];
    else if ("D" == e.substring(1, 2)) var r = a[1];
    else var r = a[2];
    if ("Y" == e.substring(0, 1)) var o = a[0];
    else if ("Y" == e.substring(1, 2)) var o = a[1];
    else var o = a[2];
    parseFloat(o) <= 50 && (o = (parseFloat(o) + 2e3).toString()), parseFloat(o) <= 99 && (o = (parseFloat(o) + 1900).toString());
    var h = new Date(parseFloat(o), parseFloat(n) - 1, parseFloat(r), 0, 0, 0, 0);
    return parseFloat(r) != h.getDate() ? !1 : parseFloat(n) - 1 != h.getMonth() ? !1 : !0
}

function tf_FormatDate(t, e) {
    function s(t) {
        if (void 0 == t) return 0;
        if (t.length > 2) return t;
        var e;
        return 99 >= t && t > 50 && (e = "19" + t), (50 > t || "00" == t) && (e = "20" + t), e
    }

    function i(t) {
        if (void 0 == t) return 0;
        for (var e, s = new Array("january", "february", "march", "april", "may", "june", "july", "august", "september", "october", "november", "december", "jan", "feb", "mar", "apr", "may", "jun", "jul", "aug", "sep", "oct", "nov", "dec"), i = 0; i < s.length; i++) {
            var l = s[i];
            if (t.toLowerCase() === l) {
                e = i + 1;
                break
            }
        }
        return (e > 11 || 23 > e) && (e -= 12), 1 > e || e > 12 ? 0 : e
    }
    if (null === e && (e = "DMY"), !t || "" === t) return new Date(1001, 0, 1);
    var l, a;
    switch (e.toUpperCase()) {
        case "DDMMMYYYY":
            a = t.replace(/[- \/.]/g, " ").split(" "), l = new Date(s(a[2]), i(a[1]) - 1, a[0]);
            break;
        case "DMY":
            a = t.replace(/^(0?[1-9]|[12][0-9]|3[01])([- \/.])(0?[1-9]|1[012])([- \/.])((\d\d)?\d\d)$/, "$1 $3 $5").split(" "), l = new Date(s(a[2]), a[1] - 1, a[0]);
            break;
        case "MDY":
            a = t.replace(/^(0?[1-9]|1[012])([- \/.])(0?[1-9]|[12][0-9]|3[01])([- \/.])((\d\d)?\d\d)$/, "$1 $3 $5").split(" "), l = new Date(s(a[2]), a[0] - 1, a[1]);
            break;
        case "YMD":
            a = t.replace(/^((\d\d)?\d\d)([- \/.])(0?[1-9]|1[012])([- \/.])(0?[1-9]|[12][0-9]|3[01])$/, "$1 $4 $6").split(" "), l = new Date(s(a[0]), a[1] - 1, a[2]);
            break;
        default:
            a = t.replace(/^(0?[1-9]|[12][0-9]|3[01])([- \/.])(0?[1-9]|1[012])([- \/.])((\d\d)?\d\d)$/, "$1 $3 $5").split(" "), l = new Date(s(a[2]), a[1] - 1, a[0])
    }
    return l
}

function tf_RemoveNbFormat(t, e) {
    if (null != t) {
        null == e && (e = "us");
        var s = t;
        return s = "us" == e.tf_LCase() ? +s.replace(/[^\d\.-]/g, "") : +s.replace(/[^\d\,-]/g, "").replace(",", ".")
    }
}

function tf_IsImported(t, e) {
    for (var s = !1, i = void 0 == e ? "script" : e, l = "script" == i ? "src" : "href", a = tf_Tag(document, i), n = 0; n < a.length; n++)
        if (void 0 != a[n][l] && a[n][l].match(t)) {
            s = !0;
            break
        }
    return s
}

function tf_IsStylesheetImported(t) {
    var e = !1;
    if (!document.styleSheets) return e;
    for (var s = document.styleSheets, i = new RegExp(t), l = 0; l < s.length; l++)
        if (s[l].imports) {
            for (var a = s[l].imports, n = 0; n < a.length; n++)
                if (a[n].href.tf_LCase() == t.tf_LCase()) {
                    e = !0;
                    break
                }
        } else
            for (var r = s[l].cssRules ? s[l].cssRules : s[l].rules, n = 0; n < r.length; n++)
                if (i.test(r[n].cssText)) {
                    e = !0;
                    break
                }
    return e
}

function tf_WriteCookie(t, e, s) {
    var i = "";
    null != s && (i = new Date((new Date).getTime() + 36e5 * s), i = "; expires=" + i.toGMTString()), document.cookie = t + "=" + escape(e) + i
}

function tf_ReadCookie(t) {
    var e = "",
        s = t + "=";
    return document.cookie.length > 0 && (offset = document.cookie.indexOf(s), -1 != offset && (offset += s.length, end = document.cookie.indexOf(";", offset), -1 == end && (end = document.cookie.length), e = unescape(document.cookie.substring(offset, end)))), e
}

function tf_CookieValueArray(t, e) {
    void 0 == e && (e = ",");
    var s = tf_ReadCookie(t),
        i = s.split(e);
    return i
}

function tf_CookieValueByIndex(t, e, s) {
    void 0 == s && (s = ",");
    var i = tf_CookieValueArray(t, s);
    return i[e]
}

function tf_RemoveCookie(t) {
    tf_WriteCookie(t, "", -1)
}

function tf_HighlightWord(t, e, s, i) {
    if (t.hasChildNodes)
        for (var l = 0; l < t.childNodes.length; l++) tf_HighlightWord(t.childNodes[l], e, s, i);
    if (3 == t.nodeType) {
        var a = t.nodeValue.tf_LCase(),
            n = e.tf_LCase();
        if (-1 != a.indexOf(n)) {
            var r = t.parentNode;
            if (r && r.className != s) {
                var o = t.nodeValue,
                    h = a.indexOf(n),
                    d = tf_CreateText(o.substr(0, h)),
                    f = o.substr(h, e.length),
                    c = tf_CreateText(o.substr(h + e.length)),
                    p = tf_CreateText(f),
                    _ = tf_CreateElm("span");
                _.className = s, _.appendChild(p), r.insertBefore(d, t), r.insertBefore(_, t), r.insertBefore(c, t), r.removeChild(t), i.highlightedNodes.push(_.firstChild)
            }
        }
    }
}

function tf_UnhighlightWord(t, e, s) {
    for (var i = [], l = 0; l < t.highlightedNodes.length; l++) {
        var a = t.highlightedNodes[l];
        if (a) {
            var n = a.nodeValue.tf_LCase(),
                r = e.tf_LCase();
            if (-1 != n.indexOf(r)) {
                var o = a.parentNode;
                if (o && o.className == s) {
                    var h = o.previousSibling,
                        d = o.nextSibling;
                    if (!h || !d) continue;
                    d.nodeValue = h.nodeValue + a.nodeValue + d.nodeValue, h.nodeValue = "", a.nodeValue = "", i.push(l)
                }
            }
        }
    }
    for (var f = 0; f < i.length; f++) t.highlightedNodes.splice(i[f], 1)
}

function tf_SetOuterHtml() {
    if (document.body.__defineGetter__ && HTMLElement) {
        var t = HTMLElement.prototype;
        t.__defineGetter__ && t.__defineGetter__("outerHTML", function() {
            var t = this.parentNode,
                e = tf_CreateElm(t.tagName);
            e.appendChild(this);
            var s = e.innerHTML;
            return t.appendChild(this), s
        })
    }
    t.__defineSetter__ && HTMLElement.prototype.__defineSetter__("outerHTML", function(t) {
        var e = this.ownerDocument.createRange();
        e.setStartBefore(this);
        var s = e.createContextualFragment(t);
        return this.parentNode.replaceChild(s, this), t
    })
}

function setFilterGrid(t) {
    return 0 !== arguments.length ? (window["tf_" + t] = new TF(arguments[0], arguments[1], arguments[2]), window["tf_" + t].AddGrid(), window["tf_" + t]) : void 0
}

function initFilterGrid() {
    if (document.getElementsByTagName)
        for (var t, e = tf_Tag(document, "table"), s = 0; s < e.length; s++) {
            var i = e[s],
                l = i.getAttribute("id");
            tf_HasClass(i, "filterable") && l && (t = tf_IsObj(l + "_config") ? window[l + "_config"] : void 0, window[l + "_isUnob"] = !0, setFilterGrid(l, t))
        }
}

function grabEBI(t) {
    return tf_Id(t)
}

function grabTag(t, e) {
    return tf_Tag(t, e)
}

function tf_GetCellText(t) {
    return tf_GetNodeText(t)
}

function tf_isObject(t) {
    return tf_IsObj(t)
}

function tf_isObj(t) {
    return tf_IsObj(t)
}

function tf_isFn(t) {
    return tf_IsFn(t)
}

function tf_isArray(t) {
    return tf_IsArray(t)
}

function tf_addEvent(t, e, s) {
    return tf_AddEvent(t, e, s)
}

function tf_removeEvent(t, e, s) {
    return tf_RemoveEvent(t, e, s)
}

function tf_addClass(t, e) {
    tf_AddClass(t, e)
}

function tf_removeClass(t, e) {
    return tf_RemoveClass(t, e)
}

function tf_hasClass(t, e) {
    return tf_HasClass(t, e)
}

function tf_isValidDate(t, e) {
    return tf_IsValidDate(t, e)
}

function tf_formatDate(t, e) {
    return tf_FormatDate(t, e)
}

function tf_removeNbFormat(t, e) {
    return tf_RemoveNbFormat(t, e)
}
var TF = function(t) {
    if (0 !== arguments.length && (this.id = t, this.version = "2.5.1", this.year = (new Date).getFullYear(), this.tbl = tf_Id(t), this.startRow = void 0, this.refRow = null, this.headersRow = null, this.fObj = null, this.nbFilterableRows = null, this.nbRows = null, this.nbCells = null, this.hasGrid = !1, this.enableModules = !1, null != this.tbl && "table" == this.tbl.nodeName.tf_LCase() && this.GetRowsNb())) {
        if (arguments.length > 1)
            for (var e = 0; e < arguments.length; e++) {
                var s = typeof arguments[e];
                switch (s.tf_LCase()) {
                    case "number":
                        this.startRow = arguments[e];
                        break;
                    case "object":
                        this.fObj = arguments[e]
                }
            }
        var i = this.fObj ? this.fObj : {};
        this.refRow = void 0 == this.startRow ? 2 : this.startRow + 1;
        try {
            this.nbCells = this.GetCellsNb(this.refRow)
        } catch (l) {
            this.nbCells = this.GetCellsNb(0)
        }
        this.basePath = void 0 != i.base_path ? i.base_path : "TableFilter/", this.fltTypeInp = "input", this.fltTypeSlc = "select", this.fltTypeMulti = "multiple", this.fltTypeCheckList = "checklist", this.fltTypeNone = "none", this.fltCol = [];
        for (var e = 0; e < this.nbCells; e++) void 0 == this["col" + e] && (this["col" + e] = void 0 == i["col_" + e] ? this.fltTypeInp : i["col_" + e].tf_LCase()), this.fltCol.push(this["col" + e]);
        this.publicMethods = void 0 != i.public_methods ? i.public_methods : !1, this.fltGrid = 0 == i.grid ? !1 : !0, this.gridLayout = i.grid_layout ? !0 : !1, this.hasGridWidthsRow = !1, this.gridColElms = [], this.sourceTblHtml = null, this.gridLayout && (void 0 == this.tbl.outerHTML && tf_SetOuterHtml(), this.sourceTblHtml = this.tbl.outerHTML), this.filtersRowIndex = void 0 != i.filters_row_index ? i.filters_row_index : 0, this.headersRow = void 0 != i.headers_row_index ? i.headers_row_index : 0 == this.filtersRowIndex ? 1 : 0, this.gridLayout && (this.headersRow > 1 ? this.filtersRowIndex = this.headersRow + 1 : (this.filtersRowIndex = 1, this.headersRow = 0)), this.fltCellTag = void 0 != i.filters_cell_tag ? "th" != i.filters_cell_tag ? "td" : "th" : "td", this.fltIds = [], this.fltElms = [], this.searchArgs = null, this.tblData = [], this.validRowsIndex = null, this.fltGridEl = null, this.isFirstLoad = !0, this.infDiv = null, this.lDiv = null, this.rDiv = null, this.mDiv = null, this.contDiv = null, this.infDivCssClass = void 0 != i.inf_div_css_class ? i.inf_div_css_class : "inf", this.lDivCssClass = void 0 != i.left_div_css_class ? i.left_div_css_class : "ldiv", this.rDivCssClass = void 0 != i.right_div_css_class ? i.right_div_css_class : "rdiv", this.mDivCssClass = void 0 != i.middle_div_css_class ? i.middle_div_css_class : "mdiv", this.contDivCssClass = void 0 != i.content_div_css_class ? i.content_div_css_class : "cont", this.stylesheet = void 0 != i.stylesheet ? i.stylesheet : this.basePath + "", this.stylesheetId = this.id + "_style", this.fltsRowCssClass = void 0 != i.flts_row_css_class ? i.flts_row_css_class : "fltrow", this.enableIcons = void 0 != i.enable_icons ? i.enable_icons : !0, this.alternateBgs = i.alternate_rows ? !0 : !1, this.hasColWidth = i.col_width ? !0 : !1, this.colWidth = this.hasColWidth ? i.col_width : null, this.fixedHeaders = i.fixed_headers ? !0 : !1, this.tBodyH = i.tbody_height ? i.tbody_height : 200, this.fltCssClass = void 0 != i.flt_css_class ? i.flt_css_class : "flt", this.fltMultiCssClass = void 0 != i.flt_multi_css_class ? i.flt_multi_css_class : "flt_multi", this.fltSmallCssClass = void 0 != i.flt_small_css_class ? i.flt_small_css_class : "flt_s", this.singleFltCssClass = void 0 != i.single_flt_css_class ? i.single_flt_css_class : "single_flt", this.isStartBgAlternate = !0, this.rowBgEvenCssClass = void 0 != i.even_row_css_class ? i.even_row_css_class : "even", this.rowBgOddCssClass = void 0 != i.odd_row_css_class ? i.odd_row_css_class : "odd", this.enterKey = 0 == i.enter_key ? !1 : !0, this.isModFilterFn = i.mod_filter_fn ? !0 : !1, this.modFilterFn = this.isModFilterFn ? i.mod_filter_fn : null, this.onBeforeFilter = tf_IsFn(i.on_before_filter) ? i.on_before_filter : null, this.onAfterFilter = tf_IsFn(i.on_after_filter) ? i.on_after_filter : null, this.matchCase = i.match_case ? !0 : !1, this.exactMatch = i.exact_match ? !0 : !1, this.refreshFilters = i.refresh_filters ? !0 : !1, this.disableExcludedOptions = void 0 != i.disable_excluded_options ? i.disable_excluded_options : !1, this.activeFlt = null, this.activeFilterId = null, this.hasColOperation = i.col_operation ? !0 : !1, this.colOperation = null, this.hasVisibleRows = i.rows_always_visible ? !0 : !1, this.visibleRows = this.hasVisibleRows ? i.rows_always_visible : [], this.searchType = void 0 != i.search_type ? i.search_type : "include", this.isExternalFlt = i.external_flt_grid ? !0 : !1, this.externalFltTgtIds = void 0 != i.external_flt_grid_ids ? i.external_flt_grid_ids : null, this.externalFltEls = [], this.execDelay = i.exec_delay ? parseInt(i.exec_delay) : 100, this.status = i.status ? !0 : !1, this.onFiltersLoaded = tf_IsFn(i.on_filters_loaded) ? i.on_filters_loaded : null, this.singleSearchFlt = i.single_search_filter ? !0 : !1, this.onRowValidated = tf_IsFn(i.on_row_validated) ? i.on_row_validated : null, this.customCellDataCols = i.custom_cell_data_cols ? i.custom_cell_data_cols : [], this.customCellData = tf_IsFn(i.custom_cell_data) ? i.custom_cell_data : null, this.inpWatermark = void 0 != i.input_watermark ? i.input_watermark : "", this.inpWatermarkCssClass = void 0 != i.input_watermark_css_class ? i.input_watermark_css_class : "fltWatermark", this.isInpWatermarkArray = void 0 != i.input_watermark && tf_IsArray(i.input_watermark) ? !0 : !1, this.toolBarTgtId = void 0 != i.toolbar_target_id ? i.toolbar_target_id : null, this.helpInstructions = void 0 != i.help_instructions ? i.help_instructions : null, this.popUpFilters = void 0 != i.popup_filters ? i.popup_filters : !1, this.markActiveColumns = void 0 != i.mark_active_columns ? i.mark_active_columns : !1, this.activeColumnsCssClass = void 0 != i.active_columns_css_class ? i.active_columns_css_class : "activeHeader", this.onBeforeActiveColumn = tf_IsFn(i.on_before_active_column) ? i.on_before_active_column : null, this.onAfterActiveColumn = tf_IsFn(i.on_after_active_column) ? i.on_after_active_column : null, this.displayAllText = void 0 != i.display_all_text ? i.display_all_text : "", this.enableSlcResetFilter = void 0 != i.enable_slc_reset_filter ? i.enable_slc_reset_filter : !0, this.enableEmptyOption = i.enable_empty_option ? !0 : !1, this.emptyText = void 0 != i.empty_text ? i.empty_text : "(Empty)", this.enableNonEmptyOption = i.enable_non_empty_option ? !0 : !1, this.nonEmptyText = void 0 != i.non_empty_text ? i.non_empty_text : "(Non empty)", this.onSlcChange = 0 == i.on_change ? !1 : !0, this.sortSlc = 0 == i.sort_select ? !1 : !0, this.isSortNumAsc = i.sort_num_asc ? !0 : !1, this.sortNumAsc = this.isSortNumAsc ? i.sort_num_asc : null, this.isSortNumDesc = i.sort_num_desc ? !0 : !1, this.sortNumDesc = this.isSortNumDesc ? i.sort_num_desc : null, this.slcFillingMethod = void 0 != i.slc_filling_method ? i.slc_filling_method : "createElement", this.fillSlcOnDemand = i.fill_slc_on_demand ? !0 : !1, this.activateSlcTooltip = void 0 != i.activate_slc_tooltip ? i.activate_slc_tooltip : "Click to activate", this.multipleSlcTooltip = void 0 != i.multiple_slc_tooltip ? i.multiple_slc_tooltip : "Use Ctrl key for multiple selections", this.hasCustomSlcOptions = i.custom_slc_options && tf_IsObj(i.custom_slc_options) ? !0 : !1, this.customSlcOptions = void 0 != i.custom_slc_options ? i.custom_slc_options : null, this.onBeforeOperation = tf_IsFn(i.on_before_operation) ? i.on_before_operation : null, this.onAfterOperation = tf_IsFn(i.on_after_operation) ? i.on_after_operation : null, this.checkListDiv = [], this.checkListDivCssClass = void 0 != i.div_checklist_css_class ? i.div_checklist_css_class : "div_checklist", this.checkListCssClass = void 0 != i.checklist_css_class ? i.checklist_css_class : "flt_checklist", this.checkListItemCssClass = void 0 != i.checklist_item_css_class ? i.checklist_item_css_class : "flt_checklist_item", this.checkListSlcItemCssClass = void 0 != i.checklist_selected_item_css_class ? i.checklist_selected_item_css_class : "flt_checklist_slc_item", this.activateCheckListTxt = void 0 != i.activate_checklist_text ? i.activate_checklist_text : "Click to load data", this.checkListItemDisabledCssClass = void 0 != i.checklist_item_disabled_css_class ? i.checklist_item_disabled_css_class : "flt_checklist_item_disabled", this.enableCheckListResetFilter = void 0 != i.enable_checklist_reset_filter ? i.enable_checklist_reset_filter : !0, this.rgxOperator = void 0 != i.regexp_operator ? i.regexp_operator : "rgx:", this.emOperator = void 0 != i.empty_operator ? i.empty_operator : "[empty]", this.nmOperator = void 0 != i.nonempty_operator ? i.nonempty_operator : "[nonempty]", this.orOperator = void 0 != i.or_operator ? i.or_operator : "||", this.anOperator = void 0 != i.and_operator ? i.and_operator : "&&", this.grOperator = void 0 != i.greater_operator ? i.greater_operator : ">", this.lwOperator = void 0 != i.lower_operator ? i.lower_operator : "<", this.leOperator = void 0 != i.lower_equal_operator ? i.lower_equal_operator : "<=", this.geOperator = void 0 != i.greater_equal_operator ? i.greater_equal_operator : ">=", this.dfOperator = void 0 != i.different_operator ? i.different_operator : "!", this.lkOperator = void 0 != i.like_operator ? i.like_operator : "*", this.eqOperator = void 0 != i.equal_operator ? i.equal_operator : "=", this.stOperator = void 0 != i.start_with_operator ? i.start_with_operator : "{", this.enOperator = void 0 != i.end_with_operator ? i.end_with_operator : "}", this.curExp = void 0 != i.cur_exp ? i.cur_exp : "^[¥£€$]", this.separator = void 0 != i.separator ? i.separator : ",", this.rowsCounter = i.rows_counter ? !0 : !1, this.statusBar = i.status_bar ? i.status_bar : !1, this.loader = i.loader ? !0 : !1, this.displayBtn = i.btn ? !0 : !1, this.btnText = void 0 != i.btn_text ? i.btn_text : this.enableIcons ? "" : "Go", this.btnCssClass = void 0 != i.btn_css_class ? i.btn_css_class : this.enableIcons ? "btnflt_icon" : "btnflt", this.btnReset = i.btn_reset ? !0 : !1, this.btnResetCssClass = void 0 != i.btn_reset_css_class ? i.btn_reset_css_class : "reset", this.onBeforeReset = tf_IsFn(i.on_before_reset) ? i.on_before_reset : null, this.onAfterReset = tf_IsFn(i.on_after_reset) ? i.on_after_reset : null, this.paging = i.paging ? !0 : !1, this.hasResultsPerPage = i.results_per_page ? !0 : !1, this.btnPageCssClass = void 0 != i.paging_btn_css_class ? i.paging_btn_css_class : "pgInp", this.pagingSlc = null, this.resultsPerPage = null, this.resultsPerPageSlc = null, this.isPagingRemoved = !1, this.nbVisibleRows = 0, this.nbHiddenRows = 0, this.startPagingRow = 0, this.nbPages = 0, this.currentPageNb = 1, this.sort = i.sort ? !0 : !1, this.isSortEnabled = !1, this.sorted = !1, this.sortConfig = void 0 != i.sort_config ? i.sort_config : {}, this.sortConfig.name = void 0 != this.sortConfig.name ? i.sort_config.name : "sortabletable", this.sortConfig.src = void 0 != this.sortConfig.src ? i.sort_config.src : this.basePath + "sortabletable.js", this.sortConfig.adapterSrc = void 0 != this.sortConfig.adapter_src ? i.sort_config.adapter_src : this.basePath + "tfAdapter.sortabletable.js", this.sortConfig.initialize = void 0 != this.sortConfig.initialize ? i.sort_config.initialize : function(t) {
            t.SetSortTable && t.SetSortTable()
        }, this.sortConfig.sortTypes = void 0 != this.sortConfig.sort_types ? i.sort_config.sort_types : [], this.sortConfig.sortCol = void 0 != this.sortConfig.sort_col ? i.sort_config.sort_col : null, this.sortConfig.asyncSort = void 0 != this.sortConfig.async_sort ? !0 : !1, this.sortConfig.triggerIds = void 0 != this.sortConfig.sort_trigger_ids ? i.sort_config.sort_trigger_ids : [], this.selectable = void 0 != i.selectable ? i.selectable : !1, this.editable = void 0 != i.editable ? i.editable : !1, this.ezEditTableConfig = void 0 != i.ezEditTable_config ? i.ezEditTable_config : {}, this.ezEditTableConfig.name = void 0 != this.ezEditTableConfig.name ? i.ezEditTable_config.name : "ezedittable", this.ezEditTableConfig.src = void 0 != this.ezEditTableConfig.src ? i.ezEditTable_config.src : this.basePath + "ezEditTable/ezEditTable.js", this.ezEditTableConfig.loadStylesheet = void 0 != this.ezEditTableConfig.loadStylesheet ? i.ezEditTable_config.loadStylesheet : !1, this.ezEditTableConfig.stylesheet = void 0 != this.ezEditTableConfig.stylesheet ? i.ezEditTable_config.stylesheet : this.basePath + "ezEditTable/ezEditTable.css", this.ezEditTableConfig.stylesheetName = void 0 != this.ezEditTableConfig.stylesheetName ? i.ezEditTable_config.stylesheetName : "ezEditTableCss", this.ezEditTableConfig.err = 'Failed to instantiate EditTable object.\n"ezEditTable" module may not be available.', this.onKeyUp = i.on_keyup ? !0 : !1, this.onKeyUpDelay = void 0 != i.on_keyup_delay ? i.on_keyup_delay : 900, this.isUserTyping = null, this.onKeyUpTimer = void 0, this.highlightKeywords = i.highlight_keywords ? !0 : !1, this.highlightCssClass = void 0 != i.highlight_css_class ? i.highlight_css_class : "keyword", this.highlightedNodes = [], this.defaultDateType = void 0 != i.default_date_type ? i.default_date_type : "DMY", this.thousandsSeparator = void 0 != i.thousands_separator ? i.thousands_separator : ",", this.decimalSeparator = void 0 != i.decimal_separator ? i.decimal_separator : ".", this.hasColNbFormat = i.col_number_format ? !0 : !1, this.colNbFormat = this.hasColNbFormat ? i.col_number_format : null, this.hasColDateType = i.col_date_type ? !0 : !1, this.colDateType = this.hasColDateType ? i.col_date_type : null, this.msgFilter = void 0 != i.msg_filter ? i.msg_filter : "Filtering data...", this.msgPopulate = void 0 != i.msg_populate ? i.msg_populate : "Populating filter...", this.msgPopulateCheckList = void 0 != i.msg_populate_checklist ? i.msg_populate_checklist : "Populating list...", this.msgChangePage = void 0 != i.msg_change_page ? i.msg_change_page : "Collecting paging data...", this.msgClear = void 0 != i.msg_clear ? i.msg_clear : "Clearing filters...", this.msgChangeResults = void 0 != i.msg_change_results ? i.msg_change_results : "Changing results per page...", this.msgResetValues = void 0 != i.msg_reset_grid_values ? i.msg_reset_grid_values : "Re-setting filters values...", this.msgResetPage = void 0 != i.msg_reset_page ? i.msg_reset_page : "Re-setting page...", this.msgResetPageLength = void 0 != i.msg_reset_page_length ? i.msg_reset_page_length : "Re-setting page length...", this.msgSort = void 0 != i.msg_sort ? i.msg_sort : "Sorting data...", this.msgLoadExtensions = void 0 != i.msg_load_extensions ? i.msg_load_extensions : "Loading extensions...", this.msgLoadThemes = void 0 != i.msg_load_themes ? i.msg_load_themes : "Loading theme(s)...", this.prfxTf = "TF", this.prfxFlt = "flt", this.prfxValButton = "btn", this.prfxInfDiv = "inf_", this.prfxLDiv = "ldiv_", this.prfxRDiv = "rdiv_", this.prfxMDiv = "mdiv_", this.prfxContentDiv = "cont_", this.prfxCheckListDiv = "chkdiv_", this.prfxSlcPages = "slcPages_", this.prfxSlcResults = "slcResults_", this.prfxSlcResultsTxt = "slcResultsTxt_", this.prfxBtnNextSpan = "btnNextSpan_", this.prfxBtnPrevSpan = "btnPrevSpan_", this.prfxBtnLastSpan = "btnLastSpan_", this.prfxBtnFirstSpan = "btnFirstSpan_", this.prfxBtnNext = "btnNext_", this.prfxBtnPrev = "btnPrev_", this.prfxBtnLast = "btnLast_", this.prfxBtnFirst = "btnFirst_", this.prfxPgSpan = "pgspan_", this.prfxPgBeforeSpan = "pgbeforespan_", this.prfxPgAfterSpan = "pgafterspan_", this.prfxCounter = "counter_", this.prfxTotRows = "totrows_span_", this.prfxTotRowsTxt = "totRowsTextSpan_", this.prfxResetSpan = "resetspan_", this.prfxLoader = "load_", this.prfxStatus = "status_", this.prfxStatusSpan = "statusSpan_", this.prfxStatusTxt = "statusText_", this.prfxCookieFltsValues = "tf_flts_", this.prfxCookiePageNb = "tf_pgnb_", this.prfxCookiePageLen = "tf_pglen_", this.prfxMainTblCont = "gridCont_", this.prfxTblCont = "tblCont_", this.prfxHeadTblCont = "tblHeadCont_", this.prfxHeadTbl = "tblHead_", this.prfxGridFltTd = "_td_", this.prfxGridTh = "tblHeadTh_", this.prfxHelpSpan = "", this.prfxHelpDiv = "helpDiv_", this.prfxPopUpSpan = "popUpSpan_", this.prfxPopUpDiv = "popUpDiv_", this.hasStoredValues = !1, this.rememberGridValues = i.remember_grid_values ? !0 : !1, this.fltsValuesCookie = this.prfxCookieFltsValues + this.id, this.rememberPageNb = this.paging && i.remember_page_number ? !0 : !1, this.pgNbCookie = this.prfxCookiePageNb + this.id, this.rememberPageLen = this.paging && i.remember_page_length ? !0 : !1, this.pgLenCookie = this.prfxCookiePageLen + this.id, this.cookieDuration = i.set_cookie_duration ? parseInt(i.set_cookie_duration) : 1e5, this.hasExtensions = i.extensions ? !0 : !1, this.extensions = this.hasExtensions ? i.extensions : null, this.enableDefaultTheme = i.enable_default_theme ? !0 : !1, this.hasThemes = i.enable_default_theme || i.themes && tf_IsObj(i.themes) ? !0 : !1, this.themes = this.hasThemes ? i.themes : null, this.themesPath = void 0 != i.themes_path ? i.themes_path : this.basePath + "TF_Themes/", this.hasBindScript = i.bind_script ? !0 : !1, this.bindScript = this.hasBindScript ? i.bind_script : null;
        var a = this;
        this.Evt = {
            name: {
                filter: "Filter",
                populateselect: "Populate",
                populatechecklist: "PopulateCheckList",
                changepage: "ChangePage",
                clear: "Clear",
                changeresultsperpage: "ChangeResults",
                resetvalues: "ResetValues",
                resetpage: "ResetPage",
                resetpagelength: "ResetPageLength",
                sort: "Sort",
                loadextensions: "LoadExtensions",
                loadthemes: "LoadThemes"
            },
            _DetectKey: function(t) {
                if (a.enterKey) {
                    var e = t || window.event;
                    if (e) {
                        var s = e.charCode ? e.charCode : e.keyCode ? e.keyCode : e.which ? e.which : 0;
                        "13" == s ? (a._Filter(), tf_CancelEvent(e), tf_StopEvent(e)) : (a.isUserTyping = !0, window.clearInterval(a.onKeyUpTimer), a.onKeyUpTimer = void 0)
                    }
                }
            },
            _OnKeyUp: function(t) {
                function e() {
                    window.clearInterval(a.onKeyUpTimer), a.onKeyUpTimer = void 0, a.isUserTyping || (a.Filter(), a.isUserTyping = null)
                }
                if (a.onKeyUp) {
                    var s = t || window.event,
                        i = s.charCode ? s.charCode : s.keyCode ? s.keyCode : s.which ? s.which : 0;
                    a.isUserTyping = !1, 13 != i && 9 != i && 27 != i && 38 != i && 40 != i ? void 0 == a.onKeyUpTimer && (a.onKeyUpTimer = window.setInterval(e, a.onKeyUpDelay)) : (window.clearInterval(a.onKeyUpTimer), a.onKeyUpTimer = void 0)
                }
            },
            _OnKeyDown: function() {
                a.onKeyUp && (a.isUserTyping = !0)
            },
            _OnInpBlur: function() {
                a.onKeyUp && (a.isUserTyping = !1, window.clearInterval(a.onKeyUpTimer)), "" == this.value && "" != a.inpWatermark && (this.value = a.isInpWatermarkArray ? a.inpWatermark[this.getAttribute("ct")] : a.inpWatermark, tf_AddClass(this, a.inpWatermarkCssClass)), a.ezEditTable && (a.editable && a.ezEditTable.Editable.Set(), a.selectable && a.ezEditTable.Selection.Set())
            },
            _OnInpFocus: function(t) {
                var e = t || window.event;
                if (a.activeFilterId = this.getAttribute("id"), a.activeFlt = tf_Id(a.activeFilterId), a.isInpWatermarkArray) {
                    var s = a.inpWatermark[this.getAttribute("ct")];
                    this.value == s && "" != s && (this.value = "", tf_RemoveClass(this, a.inpWatermarkCssClass))
                } else this.value == a.inpWatermark && "" != a.inpWatermark && (this.value = "", tf_RemoveClass(this, a.inpWatermarkCssClass));
                a.popUpFilters && (tf_CancelEvent(e), tf_StopEvent(e)), a.ezEditTable && (a.editable && a.ezEditTable.Editable.Remove(), a.selectable && a.ezEditTable.Selection.Remove())
            },
            _OnSlcFocus: function(t) {
                var e = t || window.event;
                if (a.activeFilterId = this.getAttribute("id"), a.activeFlt = tf_Id(a.activeFilterId), a.fillSlcOnDemand && "0" == this.getAttribute("filled")) {
                    var s = this.getAttribute("ct");
                    a.PopulateSelect(s), tf_isIE || this.setAttribute("filled", "1")
                }
                a.popUpFilters && (tf_CancelEvent(e), tf_StopEvent(e))
            },
            _OnSlcChange: function(t) {
                if (!a.activeFlt || !a.activeFlt.getAttribute("colIndex") || a["col" + a.activeFlt.getAttribute("colIndex")] != a.fltTypeCheckList || a.Evt._OnSlcChange.caller) {
                    var e = t || window.event;
                    a.popUpFilters && tf_StopEvent(e), a.onSlcChange && a.Filter()
                }
            },
            _OnSlcBlur: function() {},
            _OnCheckListChange: function(t) {
                a.Evt._OnCheckListChange.caller && a.Evt._OnSlcChange(t)
            },
            _OnCheckListClick: function() {
                if (a.fillSlcOnDemand && "0" == this.getAttribute("filled")) {
                    var t = this.getAttribute("ct");
                    a.PopulateCheckList(t), a.checkListDiv[t].onclick = null, a.checkListDiv[t].title = ""
                }
            },
            _OnCheckListFocus: function() {
                a.activeFilterId = this.firstChild.getAttribute("id"), a.activeFlt = tf_Id(a.activeFilterId)
            },
            _OnCheckListBlur: function() {},
            _OnBtnClick: function() {
                a.Filter()
            },
            _OnSlcPagesChangeEvt: null,
            _EnableSlc: function() {
                this.firstChild.disabled = !1, this.firstChild.focus(), this.onclick = null
            },
            _Clear: function() {
                a.ClearFilters()
            },
            _OnHelpBtnClick: function() {
                a._ToggleHelp()
            },
            _Paging: {
                nextEvt: null,
                prevEvt: null,
                lastEvt: null,
                firstEvt: null
            }
        }
    }
};
TF.prototype = {
    AddGrid: function() {
        this._AddGrid()
    },
    Init: function() {
        this.AddGrid()
    },
    Initialize: function() {
        this.AddGrid()
    },
    init: function() {
        this.AddGrid()
    },
    initialize: function() {
        this.AddGrid()
    },
    _AddGrid: function() {
        if (!this.hasGrid) {
            this.gridLayout && (this.refRow = void 0 == this.startRow ? 0 : this.startRow), this.popUpFilters && (0 == this.filtersRowIndex && 1 == this.headersRow || this.gridLayout) && (this.headersRow = 0);
            var t, e = this.fObj ? this.fObj : {},
                s = this.singleSearchFlt ? 1 : this.nbCells;
            if (void 0 == window["tf_" + this.id] && (window["tf_" + this.id] = this), this.IncludeFile(this.stylesheetId, this.stylesheet, null, "link"), this.hasThemes && this._LoadThemes(), this.gridLayout && (this.isExternalFlt = !0, this.SetGridLayout(), this.refRow = tf_isIE || tf_isIE7 ? this.refRow + 1 : 0), this.loader && this.SetLoader(), this.popUpFilters && (this.isFirstLoad || this.gridLayout || this.headersRow--, this.SetPopupFilterIcons()), this.hasResultsPerPage && (this.resultsPerPage = void 0 != e.results_per_page ? e.results_per_page : this.resultsPerPage, this.resultsPerPage.length < 2 ? this.hasResultsPerPage = !1 : this.pagingLength = this.resultsPerPage[1][0]), this.fltGrid)
                if (this.isFirstLoad) {
                    if (!this.gridLayout) {
                        var i, l = tf_Tag(this.tbl, "thead");
                        i = l.length > 0 ? l[0].insertRow(this.filtersRowIndex) : this.tbl.insertRow(this.filtersRowIndex), this.headersRow > 1 && this.filtersRowIndex <= this.headersRow && !this.popUpFilters && this.headersRow++, this.popUpFilters && this.headersRow++, this.fixedHeaders && this.SetFixedHeaders(), i.className = this.fltsRowCssClass, !this.isExternalFlt || this.gridLayout && !this.popUpFilters || (i.style.display = "none")
                    }
                    this.nbFilterableRows = this.GetRowsNb(), this.nbVisibleRows = this.nbFilterableRows, this.nbRows = this.tbl.rows.length;
                    for (var a = 0; s > a; a++) {
                        var n = tf_CreateElm(this.fltCellTag);
                        if (this.singleSearchFlt && (n.colSpan = this.nbCells), this.gridLayout || i.appendChild(n), t = a == s - 1 && this.displayBtn ? this.fltSmallCssClass : this.fltCssClass, this.popUpFilters && this.SetPopupFilter(a), void 0 == this["col" + a] && (this["col" + a] = void 0 == e["col_" + a] ? this.fltTypeInp : e["col_" + a].tf_LCase()), this.singleSearchFlt && (this["col" + a] = this.fltTypeInp, t = this.singleFltCssClass), this["col" + a] == this.fltTypeSlc || this["col" + a] == this.fltTypeMulti) {
                            var r = tf_CreateElm(this.fltTypeSlc, ["id", this.prfxFlt + a + "_" + this.id], ["ct", a], ["filled", "0"]);
                            if (this["col" + a] == this.fltTypeMulti && (r.multiple = this.fltTypeMulti, r.title = this.multipleSlcTooltip), r.className = this["col" + a].tf_LCase() == this.fltTypeSlc ? t : this.fltMultiCssClass, this.isExternalFlt && this.externalFltTgtIds && tf_Id(this.externalFltTgtIds[a]) ? (tf_Id(this.externalFltTgtIds[a]).appendChild(r), this.externalFltEls.push(r)) : n.appendChild(r), this.fltIds.push(this.prfxFlt + a + "_" + this.id), this.fillSlcOnDemand || this._PopulateSelect(a), r.onkeypress = this.Evt._DetectKey, r.onchange = this.Evt._OnSlcChange, r.onfocus = this.Evt._OnSlcFocus, r.onblur = this.Evt._OnSlcBlur, this.fillSlcOnDemand) {
                                var o = tf_CreateOpt(this.displayAllText, "");
                                r.appendChild(o)
                            }
                            this.fillSlcOnDemand && tf_isIE && (r.disabled = !0, r.title = this.activateSlcTooltip, r.parentNode.onclick = this.Evt._EnableSlc, this["col" + a] == this.fltTypeMulti && this.__deferMultipleSelection(r, 0))
                        } else if (this["col" + a] == this.fltTypeCheckList) {
                            var h = tf_CreateElm("div", ["id", this.prfxCheckListDiv + a + "_" + this.id], ["ct", a], ["filled", "0"]);
                            h.className = this.checkListDivCssClass, this.isExternalFlt && this.externalFltTgtIds && tf_Id(this.externalFltTgtIds[a]) ? (tf_Id(this.externalFltTgtIds[a]).appendChild(h), this.externalFltEls.push(h)) : n.appendChild(h), this.checkListDiv[a] = h, this.fltIds.push(this.prfxFlt + a + "_" + this.id), this.fillSlcOnDemand || this._PopulateCheckList(a), h.onclick = this.Evt._OnCheckListFocus, this.fillSlcOnDemand && (h.onclick = this.Evt._OnCheckListClick, h.appendChild(tf_CreateText(this.activateCheckListTxt)))
                        } else {
                            var d;
                            d = this["col" + a] == this.fltTypeInp ? "text" : "hidden";
                            var f = tf_CreateElm(this.fltTypeInp, ["id", this.prfxFlt + a + "_" + this.id], ["type", d], ["ct", a]);
                            if ("hidden" != d && (f.value = this.isInpWatermarkArray ? this.inpWatermark[a] : this.inpWatermark), f.className = t, "" != this.inpWatermark && tf_AddClass(f, this.inpWatermarkCssClass), f.onfocus = this.Evt._OnInpFocus, this.isExternalFlt && this.externalFltTgtIds && tf_Id(this.externalFltTgtIds[a]) ? (tf_Id(this.externalFltTgtIds[a]).appendChild(f), this.externalFltEls.push(f)) : n.appendChild(f), this.fltIds.push(this.prfxFlt + a + "_" + this.id), f.onkeypress = this.Evt._DetectKey, f.onkeydown = this.Evt._OnKeyDown, f.onkeyup = this.Evt._OnKeyUp, f.onblur = this.Evt._OnInpBlur, this.rememberGridValues) {
                                var c = tf_ReadCookie(this.fltsValuesCookie),
                                    p = new RegExp(this.separator, "g"),
                                    _ = c.split(p);
                                " " != _[a] && this.SetFilterValue(a, _[a], !1)
                            }
                        }
                        if (a == s - 1 && this.displayBtn) {
                            var u = tf_CreateElm(this.fltTypeInp, ["id", this.prfxValButton + a + "_" + this.id], ["type", "button"], ["value", this.btnText]);
                            u.className = this.btnCssClass, this.isExternalFlt && this.externalFltTgtIds && tf_Id(this.externalFltTgtIds[a]) ? tf_Id(this.externalFltTgtIds[a]).appendChild(u) : n.appendChild(u), u.onclick = this.Evt._OnBtnClick
                        }
                    }
                } else this.__resetGrid();
            else this.refRow = this.refRow - 1, this.gridLayout && (this.refRow = 0), this.nbFilterableRows = this.GetRowsNb(), this.nbVisibleRows = this.nbFilterableRows, this.nbRows = this.nbFilterableRows + this.refRow;
            if (this.rowsCounter && this.SetRowsCounter(), this.statusBar && this.SetStatusBar(), this.fixedHeaders && !this.isFirstLoad && this.SetFixedHeaders(), this.paging && this.SetPaging(), this.hasResultsPerPage && this.paging && this.SetResultsPerPage(), this.btnReset && this.SetResetBtn(), this.helpInstructions && this.SetHelpInstructions(), this.hasColWidth && !this.gridLayout && this.SetColWidths(), this.alternateBgs && this.isStartBgAlternate && this.SetAlternateRows(), this.hasColOperation && this.fltGrid && (this.colOperation = e.col_operation, this.SetColOperation()), (this.sort || this.gridLayout) && this.SetSort(), (this.selectable || this.editable) && this.SetEditable(), this.hasBindScript && void 0 != this.bindScript.src) {
                var g = this.bindScript.src,
                    v = void 0 != this.bindScript.name ? this.bindScript.name : "";
                this.IncludeFile(v, g, this.bindScript.target_fn)
            }
            this.isFirstLoad = !1, this.hasGrid = !0, (this.rememberGridValues || this.rememberPageLen || this.rememberPageNb) && this.ResetValues(), this.gridLayout || tf_AddClass(this.tbl, this.prfxTf), this.loader && this.ShowLoader("none"), this.hasExtensions && this.LoadExtensions(), this.onFiltersLoaded && this.onFiltersLoaded.call(null, this)
        }
    },
    EvtManager: function(t, e) {
        function s() {
            if (void 0 != t) switch (t) {
                case i.Evt.name.filter:
                    i.isModFilterFn ? i.modFilterFn.call(null, i) : i._Filter();
                    break;
                case i.Evt.name.populateselect:
                    i.refreshFilters ? i._PopulateSelect(l, !0) : i._PopulateSelect(l, !1, a, n);
                    break;
                case i.Evt.name.populatechecklist:
                    i._PopulateCheckList(l, a, n);
                    break;
                case i.Evt.name.changepage:
                    i._ChangePage(r);
                    break;
                case i.Evt.name.clear:
                    i._ClearFilters(), i._Filter();
                    break;
                case i.Evt.name.changeresultsperpage:
                    i._ChangeResultsPerPage();
                    break;
                case i.Evt.name.resetvalues:
                    i._ResetValues(), i._Filter();
                    break;
                case i.Evt.name.resetpage:
                    i._ResetPage(i.pgNbCookie);
                    break;
                case i.Evt.name.resetpagelength:
                    i._ResetPageLength(i.pgLenCookie);
                    break;
                case i.Evt.name.sort:
                    break;
                case i.Evt.name.loadextensions:
                    i._LoadExtensions();
                    break;
                case i.Evt.name.loadthemes:
                    i._LoadThemes();
                    break;
                default:
                    i["_" + t].call(null, i, e)
            }(i.status || i.statusBar) && i.StatusMsg(""), i.loader && i.ShowLoader("none")
        }
        var i = this,
            l = void 0 != e && void 0 != e.slcIndex ? e.slcIndex : null,
            a = void 0 != e && void 0 != e.slcExternal ? e.slcExternal : !1,
            n = void 0 != e && void 0 != e.slcId ? e.slcId : null,
            r = void 0 != e && void 0 != e.pgIndex ? e.pgIndex : null;
        if (this.loader || this.status || this.statusBar) {
            try {
                this.ShowLoader(""), this.StatusMsg(i["msg" + t])
            } catch (o) {}
            window.setTimeout(s, this.execDelay)
        } else s()
    },
    ImportModule: function(t) {
        t.path && t.name && this.IncludeFile(t.name, t.path, t.init)
    },
    LoadExtensions: function() {
        if (!this.Ext) {
            var t = this;
            this.Ext = {
                list: {},
                add: function(e, s, i, l) {
                    var a = i.split("/")[i.split("/").length - 1],
                        n = new RegExp(a),
                        r = i.replace(n, "");
                    t.Ext.list[e] = {
                        name: e,
                        description: s,
                        file: a,
                        path: r,
                        callback: l
                    }
                }
            }
        }
        this.EvtManager(this.Evt.name.loadextensions)
    },
    _LoadExtensions: function() {
        if (this.hasExtensions && tf_IsArray(this.extensions.name) && tf_IsArray(this.extensions.src))
            for (var t = this.extensions, e = 0; e < t.name.length; e++) {
                var s = t.src[e],
                    i = t.name[e],
                    l = t.initialize && t.initialize[e] ? t.initialize[e] : null,
                    a = t.description && t.description[e] ? t.description[e] : null;
                this.Ext.add(i, a, s, l), tf_IsImported(s) ? l.call(null, this) : this.IncludeFile(i, s, l)
            }
    },
    LoadThemes: function() {
        this.EvtManager(this.Evt.name.loadthemes)
    },
    _LoadThemes: function() {
        if (this.hasThemes) {
            if (!this.Thm) {
                var t = this;
                this.Thm = {
                    list: {},
                    add: function(e, s, i, l) {
                        var a = i.split("/")[i.split("/").length - 1],
                            n = new RegExp(a),
                            r = i.replace(n, "");
                        t.Thm.list[e] = {
                            name: e,
                            description: s,
                            file: a,
                            path: r,
                            callback: l
                        }
                    }
                }
            }
            if (this.enableDefaultTheme && (this.themes = {
                    name: ["DefaultTheme"],
                    src: [this.themesPath + "Default/TF_Default.css"],
                    description: ["Default Theme"]
                }, this.Thm.add("DefaultTheme", this.themesPath + "Default/TF_Default.css", "Default Theme")), tf_IsArray(this.themes.name) && tf_IsArray(this.themes.src))
                for (var e = this.themes, s = 0; s < e.name.length; s++) {
                    var i = e.src[s],
                        l = e.name[s],
                        a = e.initialize && e.initialize[s] ? e.initialize[s] : null,
                        n = e.description && e.description[s] ? e.description[s] : null;
                    this.Thm.add(l, n, i, a), tf_IsImported(i, "link") || this.IncludeFile(l, i, null, "link"), tf_IsFn(a) && a.call(null, this)
                }
            this.btnResetText = null, this.btnResetHtml = '<input type="button" value="" class="' + this.btnResetCssClass + '" title="Clear filters" />', this.btnPrevPageHtml = '<input type="button" value="" class="' + this.btnPageCssClass + ' previousPage" title="Previous page" />', this.btnNextPageHtml = '<input type="button" value="" class="' + this.btnPageCssClass + ' nextPage" title="Next page" />', this.btnFirstPageHtml = '<input type="button" value="" class="' + this.btnPageCssClass + ' firstPage" title="First page" />', this.btnLastPageHtml = '<input type="button" value="" class="' + this.btnPageCssClass + ' lastPage" title="Last page" />', this.loader = !0, this.loaderHtml = '<div class="defaultLoader"></div>', this.loaderText = null
        }
    },
    RemoveGrid: function() {
        if (this.fltGrid && this.hasGrid) {
            var t = this.tbl.rows;
            this.paging && this.RemovePaging(), this.statusBar && this.RemoveStatusBar(), this.rowsCounter && this.RemoveRowsCounter(), this.btnReset && this.RemoveResetBtn(), (this.helpInstructions || null == this.helpInstructions) && this.RemoveHelpInstructions(), this.paging && this.RemoveResultsPerPage(), this.isExternalFlt && !this.popUpFilters && this.RemoveExternalFlts(), this.fixedHeaders && this.RemoveFixedHeaders(), this.infDiv && this.RemoveTopDiv(), this.highlightKeywords && this.UnhighlightAll(), this.sort && this.RemoveSort(), this.loader && this.RemoveLoader(), this.popUpFilters && this.RemovePopupFilters(), this.markActiveColumns && this.ClearActiveColumns(), (this.editable || this.selectable) && this.RemoveEditable();
            for (var e = this.refRow; e < this.nbRows; e++)
                if (null !== t[e]) {
                    t[e].style.display = "";
                    try {
                        t[e].hasAttribute("validRow") && t[e].removeAttribute("validRow")
                    } catch (s) {
                        for (var i = 0; i < t[e].attributes.length; i++) "validrow" == t[e].attributes[i].nodeName.tf_LCase() && t[e].removeAttribute("validRow")
                    }
                    this.alternateBgs && this.RemoveRowBg(e)
                }
            this.fltGrid && !this.gridLayout && (this.fltGridEl = t[this.filtersRowIndex], this.tbl.deleteRow(this.filtersRowIndex)), this.gridLayout && this.RemoveGridLayout(), tf_RemoveClass(this.tbl, this.prfxTf), this.activeFlt = null, this.isStartBgAlternate = !0, this.hasGrid = !1
        }
    },
    SetTopDiv: function() {
        if (null == this.infDiv) {
            var t = tf_CreateElm("div", ["id", this.prfxInfDiv + this.id]);
            t.className = this.infDivCssClass, this.toolBarTgtId ? tf_Id(this.toolBarTgtId).appendChild(t) : this.fixedHeaders && this.contDiv ? this.contDiv.parentNode.insertBefore(t, this.contDiv) : this.gridLayout ? (this.tblMainCont.appendChild(t), t.className = this.gridInfDivCssClass) : this.tbl.parentNode.insertBefore(t, this.tbl), this.infDiv = tf_Id(this.prfxInfDiv + this.id);
            var e = tf_CreateElm("div", ["id", this.prfxLDiv + this.id]);
            e.className = this.lDivCssClass, t.appendChild(e), this.lDiv = tf_Id(this.prfxLDiv + this.id);
            var s = tf_CreateElm("div", ["id", this.prfxRDiv + this.id]);
            s.className = this.rDivCssClass, t.appendChild(s), this.rDiv = tf_Id(this.prfxRDiv + this.id);
            var i = tf_CreateElm("div", ["id", this.prfxMDiv + this.id]);
            i.className = this.mDivCssClass, t.appendChild(i), this.mDiv = tf_Id(this.prfxMDiv + this.id), null == this.helpInstructions && this.SetHelpInstructions()
        }
    },
    RemoveTopDiv: function() {
        null != this.infDiv && (this.infDiv.parentNode.removeChild(this.infDiv), this.infDiv = null)
    },
    RemoveExternalFlts: function() {
        if (this.isExternalFlt || this.externalFltTgtIds)
            for (var t = 0; t < this.externalFltTgtIds.length; t++) tf_Id(this.externalFltTgtIds[t]) && (tf_Id(this.externalFltTgtIds[t]).innerHTML = "")
    },
    SetLoader: function() {
        if (null == this.loaderDiv) {
            var t = this.fObj;
            this.loaderTgtId = void 0 != t.loader_target_id ? t.loader_target_id : null, this.loaderDiv = null, this.loaderText = void 0 != t.loader_text ? t.loader_text : "Loading...", this.loaderHtml = void 0 != t.loader_html ? t.loader_html : null, this.loaderCssClass = void 0 != t.loader_css_class ? t.loader_css_class : "loader", this.loaderCloseDelay = 200, this.onShowLoader = tf_IsFn(t.on_show_loader) ? t.on_show_loader : null, this.onHideLoader = tf_IsFn(t.on_hide_loader) ? t.on_hide_loader : null;
            var e = tf_CreateElm("div", ["id", this.prfxLoader + this.id]);
            e.className = this.loaderCssClass;
            var s = null == this.loaderTgtId ? this.gridLayout ? this.tblCont : this.tbl.parentNode : tf_Id(this.loaderTgtId);
            null == this.loaderTgtId ? s.insertBefore(e, this.tbl) : s.appendChild(e), this.loaderDiv = tf_Id(this.prfxLoader + this.id), null == this.loaderHtml ? this.loaderDiv.appendChild(tf_CreateText(this.loaderText)) : this.loaderDiv.innerHTML = this.loaderHtml
        }
    },
    RemoveLoader: function() {
        if (null != this.loaderDiv) {
            var t = null == this.loaderTgtId ? this.gridLayout ? this.tblCont : this.tbl.parentNode : tf_Id(this.loaderTgtId);
            t.removeChild(this.loaderDiv), this.loaderDiv = null
        }
    },
    ShowLoader: function(t) {
        function e() {
            s.loaderDiv && (s.onShowLoader && "none" != t && s.onShowLoader.call(null, s), s.loaderDiv.style.display = t, s.onHideLoader && "none" == t && s.onHideLoader.call(null, s))
        }
        if (this.loader && this.loaderDiv && this.loaderDiv.style.display != t) {
            var s = this,
                i = "none" == t ? this.loaderCloseDelay : 1;
            window.setTimeout(e, i)
        }
    },
    SetSort: function() {
        var t = this.Evt._EnableSort;
        if (!tf_IsFn(t)) {
            var e = this;
            this.Evt._EnableSort = function() {
                (!e.isSortEnabled || e.gridLayout) && (tf_IsImported(e.sortConfig.adapterSrc) ? e.sortConfig.initialize.call(null, e) : e.IncludeFile(e.sortConfig.name + "_adapter", e.sortConfig.adapterSrc, function() {
                    e.sortConfig.initialize.call(null, e)
                }))
            }
        }
        tf_IsImported(this.sortConfig.src) ? this.Evt._EnableSort() : this.IncludeFile(this.sortConfig.name, this.sortConfig.src, this.Evt._EnableSort)
    },
    RemoveSort: function() {
        this.sort && (this.sort = !1)
    },
    Sort: function() {
        this.EvtManager(this.Evt.name.sort)
    },
    SetEditable: function() {
        tf_IsImported(this.ezEditTableConfig.src) ? this._EnableEditable() : this.IncludeFile(this.ezEditTableConfig.name, this.ezEditTableConfig.src, this._EnableEditable), this.ezEditTableConfig.loadStylesheet && !tf_IsImported(this.ezEditTableConfig.stylesheet, "link") && this.IncludeFile(this.ezEditTableConfig.stylesheetName, this.ezEditTableConfig.stylesheet, null, "link")
    },
    RemoveEditable: function() {
        this.ezEditTable && (this.selectable && (this.ezEditTable.Selection.ClearSelections(), this.ezEditTable.Selection.Remove()), this.editable && this.ezEditTable.Editable.Remove())
    },
    ResetEditable: function() {
        this.ezEditTable && (this.selectable && this.ezEditTable.Selection.Set(), this.editable && this.ezEditTable.Editable.Set())
    },
    _EnableEditable: function(t) {
        function e(e, s, i) {
            function l(i) {
                if ("row" == e.defaultSelection) e.Selection.SelectRowByIndex(i);
                else {
                    e.ClearSelections();
                    var l = s.cellIndex,
                        a = t.tbl.rows[i];
                    "both" == e.defaultSelection && e.Selection.SelectRowByIndex(i), a && e.Selection.SelectCell(a.cells[l])
                }
                if (t.validRowsIndex.length != t.GetRowsNb()) {
                    var a = t.tbl.rows[i];
                    a && a.scrollIntoView(!1), r && (r.cellIndex == t.GetCellsNb() - 1 && t.gridLayout ? t.tblCont.scrollLeft = 1e8 : 0 == r.cellIndex && t.gridLayout ? t.tblCont.scrollLeft = 0 : r.scrollIntoView(!1))
                }
            }
            if (t.validRowsIndex) {
                var a, n = "row" != e.defaultSelection ? s.parentNode : s,
                    r = "TD" == s.nodeName ? s : null,
                    o = void 0 != i ? e.Event.GetKey(i) : 0,
                    h = t.validRowsIndex.tf_Has(n.rowIndex),
                    d = 34 == o || 33 == o ? t.pagingLength || e.nbRowsPerPage : 1;
                if (h) 34 != o && 33 != o ? (t._lastValidRowIndex = t.validRowsIndex.tf_IndexByValue(n.rowIndex), t._lastRowIndex = n.rowIndex) : (a = 34 == o ? t._lastValidRowIndex + d <= t.validRowsIndex.length - 1 ? t.validRowsIndex[t._lastValidRowIndex + d] : t.validRowsIndex[t.validRowsIndex.length - 1] : t._lastValidRowIndex - d <= t.validRowsIndex[0] ? t.validRowsIndex[0] : t.validRowsIndex[t._lastValidRowIndex - d], t._lastRowIndex = a, t._lastValidRowIndex = t.validRowsIndex.tf_IndexByValue(a), l(a));
                else {
                    if (n.rowIndex > t._lastRowIndex)
                        if (n.rowIndex >= t.validRowsIndex[t.validRowsIndex.length - 1]) a = t.validRowsIndex[t.validRowsIndex.length - 1];
                        else {
                            var f = t._lastValidRowIndex + d;
                            a = f > t.validRowsIndex.length - 1 ? t.validRowsIndex[t.validRowsIndex.length - 1] : t.validRowsIndex[f]
                        }
                    else if (n.rowIndex <= t.validRowsIndex[0]) a = t.validRowsIndex[0];
                    else {
                        var c = t.validRowsIndex[t._lastValidRowIndex - d];
                        a = c ? c : t.validRowsIndex[0]
                    }
                    t._lastRowIndex = n.rowIndex, l(a)
                }
            }
        }

        function s(e, s) {
            var i = "row" != e.defaultSelection ? s.parentNode : s;
            if (t.paging && t.nbPages > 1) {
                e.nbRowsPerPage = t.pagingLength;
                var l = parseInt(t.startPagingRow) + parseInt(t.pagingLength),
                    a = i.rowIndex;
                a == t.validRowsIndex[t.validRowsIndex.length - 1] && t.currentPageNb != t.nbPages ? t.SetPage("last") : a == t.validRowsIndex[0] && 1 != t.currentPageNb ? t.SetPage("first") : a > t.validRowsIndex[l - 1] && a < t.validRowsIndex[t.validRowsIndex.length - 1] ? t.SetPage("next") : a < t.validRowsIndex[t.startPagingRow] && a > t.validRowsIndex[0] && t.SetPage("previous")
            }
        }
        t || (t = this);
        var i, l = tf_Tag(t.tbl, "thead");
        if (i = l.length > 0 && !t.ezEditTableConfig.startRow ? void 0 : t.ezEditTableConfig.startRow || t.refRow, t.ezEditTableConfig.scroll_into_view = void 0 != t.ezEditTableConfig.scroll_into_view ? t.ezEditTableConfig.scroll_into_view : !0, t.ezEditTableConfig.base_path = void 0 != t.ezEditTableConfig.base_path ? t.ezEditTableConfig.base_path : t.basePath + "ezEditTable/", t.ezEditTableConfig.editable = t.editable = t.fObj.editable, t.ezEditTableConfig.selection = t.selectable = t.fObj.selectable, t.selectable && (t.ezEditTableConfig.default_selection = void 0 != t.ezEditTableConfig.default_selection ? t.ezEditTableConfig.default_selection : "row"), t.ezEditTableConfig.active_cell_css = void 0 != t.ezEditTableConfig.active_cell_css ? t.ezEditTableConfig.active_cell_css : "ezETSelectedCell", t._lastValidRowIndex = 0, t._lastRowIndex = 0, t.selectable)
            if (t.paging && (t.onAfterChangePage = function(t) {
                    var e = t.ezEditTable.Selection.GetActiveRow();
                    e && e.scrollIntoView(!1);
                    var s = t.ezEditTable.Selection.GetActiveCell();
                    s && s.scrollIntoView(!1)
                }), "row" == t.ezEditTableConfig.default_selection) {
                var a = t.ezEditTableConfig.on_before_selected_row;
                t.ezEditTableConfig.on_before_selected_row = function() {
                    s(arguments[0], arguments[1], arguments[2]), a && a.call(null, arguments[0], arguments[1], arguments[2])
                };
                var n = t.ezEditTableConfig.on_after_selected_row;
                t.ezEditTableConfig.on_after_selected_row = function() {
                    e(arguments[0], arguments[1], arguments[2]), n && n.call(null, arguments[0], arguments[1], arguments[2])
                }
            } else {
                var a = t.ezEditTableConfig.on_before_selected_cell;
                t.ezEditTableConfig.on_before_selected_cell = function() {
                    s(arguments[0], arguments[1], arguments[2]), a && a.call(null, arguments[0], arguments[1], arguments[2])
                };
                var n = t.ezEditTableConfig.on_after_selected_cell;
                t.ezEditTableConfig.on_after_selected_cell = function() {
                    e(arguments[0], arguments[1], arguments[2]), n && n.call(null, arguments[0], arguments[1], arguments[2])
                }
            }
        if (t.editable) {
            var r = t.ezEditTableConfig.on_added_dom_row;
            if (t.ezEditTableConfig.on_added_dom_row = function() {
                    t.nbFilterableRows++, t.paging ? (t.nbRows++, t.nbVisibleRows++, t.nbFilterableRows++, t.paging = !1, t.RemovePaging(), t.AddPaging(!1)) : t.RefreshNbRows(), t.alternateBgs && t.SetAlternateRows(), r && r.call(null, arguments[0], arguments[1], arguments[2])
                }, t.ezEditTableConfig.actions && t.ezEditTableConfig.actions["delete"]) {
                var o = t.ezEditTableConfig.actions["delete"].on_after_submit;
                t.ezEditTableConfig.actions["delete"].on_after_submit = function() {
                    t.nbFilterableRows--, t.paging ? (t.nbRows--, t.nbVisibleRows--, t.nbFilterableRows--, t.paging = !1, t.RemovePaging(), t.AddPaging(!1)) : t.RefreshNbRows(), t.alternateBgs && t.SetAlternateRows(), o && o.call(null, arguments[0], arguments[1])
                }
            }
        }
        try {
            t.ezEditTable = new EditTable(t.id, t.ezEditTableConfig, i), t.ezEditTable.Init()
        } catch (h) {
            alert(t.ezEditTableConfig.err)
        }
    },
    SetPaging: function() {
        if ((this.hasGrid || this.isFirstLoad) && this.paging && (this.isPagingRemoved || this.isFirstLoad)) {
            var t = this.fObj;
            this.pagingTgtId = void 0 != t.paging_target_id ? t.paging_target_id : null, this.pagingLength = void 0 != t.paging_length ? t.paging_length : 10, this.resultsPerPageTgtId = void 0 != t.results_per_page_target_id ? t.results_per_page_target_id : null, this.pgSlcCssClass = void 0 != t.paging_slc_css_class ? t.paging_slc_css_class : "pgSlc", this.pgInpCssClass = void 0 != t.paging_inp_css_class ? t.paging_inp_css_class : "pgNbInp", this.resultsSlcCssClass = void 0 != t.results_slc_css_class ? t.results_slc_css_class : "rspg", this.resultsSpanCssClass = void 0 != t.results_span_css_class ? t.results_span_css_class : "rspgSpan", this.nbVisibleRows = 0, this.nbHiddenRows = 0, this.startPagingRow = 0, this.nbPages = 0, this.btnNextPageText = void 0 != t.btn_next_page_text ? t.btn_next_page_text : ">", this.btnPrevPageText = void 0 != t.btn_prev_page_text ? t.btn_prev_page_text : "<", this.btnLastPageText = void 0 != t.btn_last_page_text ? t.btn_last_page_text : ">|", this.btnFirstPageText = void 0 != t.btn_first_page_text ? t.btn_first_page_text : "|<", this.btnNextPageHtml = void 0 != t.btn_next_page_html ? t.btn_next_page_html : this.enableIcons ? '<input type="button" value="" class="' + this.btnPageCssClass + ' nextPage" title="Next page" />' : null, this.btnPrevPageHtml = void 0 != t.btn_prev_page_html ? t.btn_prev_page_html : this.enableIcons ? '<input type="button" value="" class="' + this.btnPageCssClass + ' previousPage" title="Previous page" />' : null, this.btnFirstPageHtml = void 0 != t.btn_first_page_html ? t.btn_first_page_html : this.enableIcons ? '<input type="button" value="" class="' + this.btnPageCssClass + ' firstPage" title="First page" />' : null, this.btnLastPageHtml = void 0 != t.btn_last_page_html ? t.btn_last_page_html : this.enableIcons ? '<input type="button" value="" class="' + this.btnPageCssClass + ' lastPage" title="Last page" />' : null, this.pageText = void 0 != t.page_text ? t.page_text : " "+Drupal.t("Showing")+" ", this.ofText = void 0 != t.of_text ? t.of_text : " "+Drupal.t("of")+" ", this.nbPgSpanCssClass = void 0 != t.nb_pages_css_class ? t.nb_pages_css_class : "nbpg", this.hasPagingBtns = 0 == t.paging_btns ? !1 : !0, this.pagingBtnEvents = null, this.pageSelectorType = void 0 != t.page_selector_type ? t.page_selector_type : this.fltTypeSlc, this.onBeforeChangePage = tf_IsFn(t.on_before_change_page) ? t.on_before_change_page : null, this.onAfterChangePage = tf_IsFn(t.on_after_change_page) ? t.on_after_change_page : null;
            var e = this.refRow,
                s = this.nbRows;
            if (this.nbPages = Math.ceil((s - e) / this.pagingLength), !this.Evt._Paging.next) {
                var i = this;
                this.Evt._Paging = {
                    slcIndex: function() {
                        return i.pageSelectorType == i.fltTypeSlc ? i.pagingSlc.options.selectedIndex : parseInt(i.pagingSlc.value) - 1
                    },
                    nbOpts: function() {
                        return i.pageSelectorType == i.fltTypeSlc ? parseInt(i.pagingSlc.options.length) - 1 : i.nbPages - 1
                    },
                    next: function() {
                        i.Evt._Paging.nextEvt && i.Evt._Paging.nextEvt();
                        var t = i.Evt._Paging.slcIndex() < i.Evt._Paging.nbOpts() ? i.Evt._Paging.slcIndex() + 1 : 0;
                        i.ChangePage(t)
                    },
                    prev: function() {
                        i.Evt._Paging.prevEvt && i.Evt._Paging.prevEvt();
                        var t = i.Evt._Paging.slcIndex() > 0 ? i.Evt._Paging.slcIndex() - 1 : i.Evt._Paging.nbOpts();
                        i.ChangePage(t)
                    },
                    last: function() {
                        i.Evt._Paging.lastEvt && i.Evt._Paging.lastEvt(), i.ChangePage(i.Evt._Paging.nbOpts())
                    },
                    first: function() {
                        i.Evt._Paging.firstEvt && i.Evt._Paging.firstEvt(), i.ChangePage(0)
                    },
                    _detectKey: function(t) {
                        var e = t ? t : window.event ? window.event : null;
                        if (e) {
                            var s = e.charCode ? e.charCode : e.keyCode ? e.keyCode : e.which ? e.which : 0;
                            "13" == s && (i.sorted ? (i.Filter(), i.ChangePage(i.Evt._Paging.slcIndex())) : i.ChangePage(), this.blur())
                        }
                    },
                    nextEvt: null,
                    prevEvt: null,
                    lastEvt: null,
                    firstEvt: null
                }
            }
            if (this.Evt._OnSlcPagesChange || (this.Evt._OnSlcPagesChange = function() {
                    i.Evt._Paging._OnSlcPagesChangeEvt && i.Evt._Paging._OnSlcPagesChangeEvt(), i.ChangePage(), this.blur(), this.parentNode && tf_isIE && this.parentNode.focus()
                }), this.pageSelectorType == this.fltTypeSlc) {
                var l = tf_CreateElm(this.fltTypeSlc, ["id", this.prfxSlcPages + this.id]);
                l.className = this.pgSlcCssClass, l.onchange = this.Evt._OnSlcPagesChange
            }
            if (this.pageSelectorType == this.fltTypeInp) {
                var l = tf_CreateElm(this.fltTypeInp, ["id", this.prfxSlcPages + this.id], ["value", this.currentPageNb]);
                l.className = this.pgInpCssClass, l.onkeypress = this.Evt._Paging._detectKey
            }
            var a, n, r, o;
            if (a = tf_CreateElm("span", ["id", this.prfxBtnNextSpan + this.id]), n = tf_CreateElm("span", ["id", this.prfxBtnPrevSpan + this.id]), r = tf_CreateElm("span", ["id", this.prfxBtnLastSpan + this.id]), o = tf_CreateElm("span", ["id", this.prfxBtnFirstSpan + this.id]), this.hasPagingBtns) {
                if (null == this.btnNextPageHtml) {
                    var h = tf_CreateElm(this.fltTypeInp, ["id", this.prfxBtnNext + this.id], ["type", "button"], ["value", this.btnNextPageText], ["title", "Next"]);
                    h.className = this.btnPageCssClass, h.onclick = this.Evt._Paging.next, a.appendChild(h)
                } else a.innerHTML = this.btnNextPageHtml, a.onclick = this.Evt._Paging.next;
                if (null == this.btnPrevPageHtml) {
                    var d = tf_CreateElm(this.fltTypeInp, ["id", this.prfxBtnPrev + this.id], ["type", "button"], ["value", this.btnPrevPageText], ["title", "Previous"]);
                    d.className = this.btnPageCssClass, d.onclick = this.Evt._Paging.prev, n.appendChild(d)
                } else n.innerHTML = this.btnPrevPageHtml, n.onclick = this.Evt._Paging.prev;
                if (null == this.btnLastPageHtml) {
                    var f = tf_CreateElm(this.fltTypeInp, ["id", this.prfxBtnLast + this.id], ["type", "button"], ["value", this.btnLastPageText], ["title", "Last"]);
                    f.className = this.btnPageCssClass, f.onclick = this.Evt._Paging.last, r.appendChild(f)
                } else r.innerHTML = this.btnLastPageHtml, r.onclick = this.Evt._Paging.last;
                if (null == this.btnFirstPageHtml) {
                    var c = tf_CreateElm(this.fltTypeInp, ["id", this.prfxBtnFirst + this.id], ["type", "button"], ["value", this.btnFirstPageText], ["title", "First"]);
                    c.className = this.btnPageCssClass, c.onclick = this.Evt._Paging.first, o.appendChild(c)
                } else o.innerHTML = this.btnFirstPageHtml, o.onclick = this.Evt._Paging.first
            }
            null == this.pagingTgtId && this.SetTopDiv();
            var p = null == this.pagingTgtId ? this.mDiv : tf_Id(this.pagingTgtId);
            "" != p.innerHTML && (p.innerHTML = ""), p.appendChild(o), p.appendChild(n);
            var _ = tf_CreateElm("span", ["id", this.prfxPgBeforeSpan + this.id]);
            _.appendChild(tf_CreateText(this.pageText)), _.className = this.nbPgSpanCssClass, p.appendChild(_), p.appendChild(l);
            var u = tf_CreateElm("span", ["id", this.prfxPgAfterSpan + this.id]);
            u.appendChild(tf_CreateText(this.ofText)), u.className = this.nbPgSpanCssClass, p.appendChild(u);
            var g = tf_CreateElm("span", ["id", this.prfxPgSpan + this.id]);
            g.className = this.nbPgSpanCssClass, g.appendChild(tf_CreateText(" " + this.nbPages + " ")), p.appendChild(g), p.appendChild(a), p.appendChild(r), this.pagingSlc = tf_Id(this.prfxSlcPages + this.id), (!this.rememberGridValues || this.isPagingRemoved) && this.SetPagingInfo(), this.fltGrid || (this.ValidateAllRows(), this.SetPagingInfo(this.validRowsIndex)), this.pagingBtnEvents = this.Evt._Paging, this.isPagingRemoved = !1
        }
    },
    RemovePaging: function() {
        if (this.hasGrid && null != this.pagingSlc) {
            var t, e, s, i, l, a, n;
            t = tf_Id(this.prfxBtnNextSpan + this.id), e = tf_Id(this.prfxBtnPrevSpan + this.id), s = tf_Id(this.prfxBtnLastSpan + this.id), i = tf_Id(this.prfxBtnFirstSpan + this.id), l = tf_Id(this.prfxPgBeforeSpan + this.id), a = tf_Id(this.prfxPgAfterSpan + this.id), n = tf_Id(this.prfxPgSpan + this.id), this.pagingSlc.parentNode.removeChild(this.pagingSlc), null != t && t.parentNode.removeChild(t), null != e && e.parentNode.removeChild(e), null != s && s.parentNode.removeChild(s), null != i && i.parentNode.removeChild(i), null != l && l.parentNode.removeChild(l), null != a && a.parentNode.removeChild(a), null != n && n.parentNode.removeChild(n), this.pagingBtnEvents = null, this.pagingSlc = null, this.isPagingRemoved = !0
        }
    },
    SetPagingInfo: function(t) {
        var e = this.tbl.rows,
            s = null == this.pagingTgtId ? this.mDiv : tf_Id(this.pagingTgtId),
            i = tf_Id(this.prfxPgSpan + this.id);
        if (void 0 != t) this.validRowsIndex = t;
        else {
            this.validRowsIndex = [];
            for (var l = this.refRow; l < this.nbRows; l++)
                if (e[l]) {
                    var a = e[l].getAttribute("validRow");
                    ("true" == a || null == a) && this.validRowsIndex.push(l)
                }
        }
        if (this.nbPages = Math.ceil(this.validRowsIndex.length / this.pagingLength), i.innerHTML = this.nbPages, this.pageSelectorType == this.fltTypeSlc && (this.pagingSlc.innerHTML = ""), this.nbPages > 0)
            if (s.style.visibility = "visible", this.pageSelectorType == this.fltTypeSlc)
                for (var n = 0; n < this.nbPages; n++) {
                    var r = new Option(n + 1, n * this.pagingLength, !1, !1);
                    this.pagingSlc.options[n] = r
                } else this.pagingSlc.value = this.currentPageNb;
            else s.style.visibility = "hidden";
        this.GroupByPage(this.validRowsIndex)
    },
    GroupByPage: function(t) {
        var e = this.tbl.rows,
            s = parseInt(this.startPagingRow) + parseInt(this.pagingLength);
        for (void 0 != t && (this.validRowsIndex = t), h = 0; h < this.validRowsIndex.length; h++)
            if (h >= this.startPagingRow && s > h) {
                var i = e[this.validRowsIndex[h]];
                ("true" == i.getAttribute("validRow") || void 0 == i.getAttribute("validRow")) && (i.style.display = ""), this.alternateBgs && this.SetRowBg(this.validRowsIndex[h], h)
            } else e[this.validRowsIndex[h]].style.display = "none", this.alternateBgs && this.RemoveRowBg(this.validRowsIndex[h]);
        this.nbVisibleRows = this.validRowsIndex.length, this.isStartBgAlternate = !1, this.ApplyGridProps()
    },
    SetPage: function(t) {
        if (this.hasGrid && this.paging) {
            var e = this.pagingBtnEvents,
                s = typeof t;
            if ("string" == s) switch (t.tf_LCase()) {
                case "next":
                    e.next();
                    break;
                case "previous":
                    e.prev();
                    break;
                case "last":
                    e.last();
                    break;
                case "first":
                    e.first();
                    break;
                default:
                    e.next()
            }
            "number" == s && this.ChangePage(t - 1)
        }
    },
    SetResultsPerPage: function() {
        if ((this.hasGrid || this.isFirstLoad) && null == this.resultsPerPageSlc && null != this.resultsPerPage) {
            if (!this.Evt._OnSlcResultsChange) {
                var t = this;
                this.Evt._OnSlcResultsChange = function() {
                    t.ChangeResultsPerPage(), this.blur(), this.parentNode && tf_isIE && this.parentNode.focus()
                }
            }
            var e = tf_CreateElm(this.fltTypeSlc, ["id", this.prfxSlcResults + this.id]);
            e.className = this.resultsSlcCssClass;
            var s = this.resultsPerPage[0],
                i = this.resultsPerPage[1],
                l = tf_CreateElm("span", ["id", this.prfxSlcResultsTxt + this.id]);
            l.className = this.resultsSpanCssClass, null == this.resultsPerPageTgtId && this.SetTopDiv();
            var a = null == this.resultsPerPageTgtId ? this.rDiv : tf_Id(this.resultsPerPageTgtId);
            l.appendChild(tf_CreateText(s)), a.appendChild(l), a.appendChild(e), this.resultsPerPageSlc = tf_Id(this.prfxSlcResults + this.id);
            for (var n = 0; n < i.length; n++) {
                var r = new Option(i[n], i[n], !1, !1);
                this.resultsPerPageSlc.options[n] = r
            }
            e.onchange = this.Evt._OnSlcResultsChange
        }
    },
    RemoveResultsPerPage: function() {
        if (this.hasGrid && null != this.resultsPerPageSlc && null != this.resultsPerPage) {
            var t, e;
            t = this.resultsPerPageSlc, e = tf_Id(this.prfxSlcResultsTxt + this.id), null != t && t.parentNode.removeChild(t), null != e && e.parentNode.removeChild(e), this.resultsPerPageSlc = null
        }
    },
    SetHelpInstructions: function() {
        if (null == this.helpInstrBtnEl) {
            var t = this.fObj;
            this.helpInstrTgtId = void 0 != t.help_instructions_target_id ? t.help_instructions_target_id : null, this.helpInstrContTgtId = void 0 != t.help_instructions_container_target_id ? t.help_instructions_container_target_id : null, this.helpInstrText = t.help_instructions_text ? t.help_instructions_text : 'Use the filters above each column to filter and limit table data. Avanced searches can be performed by using the following operators: <br /><b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>=</b>, <b>*</b>, <b>!</b>, <b>{</b>, <b>}</b>, <b>||</b>, <b>&amp;&amp;</b>, <b>[empty]</b>, <b>[nonempty]</b>, <b>rgx:</b><br/> These operators are described here:<br/><a href="http://tablefilter.free.fr/#operators" target="_blank">http://tablefilter.free.fr/#operators</a><hr/>', this.helpInstrHtml = void 0 != t.help_instructions_html ? t.help_instructions_html : null, this.helpInstrBtnText = void 0 != t.help_instructions_btn_text ? t.help_instructions_btn_text : "?", this.helpInstrBtnHtml = void 0 != t.help_instructions_btn_html ? t.help_instructions_btn_html : null, this.helpInstrBtnCssClass = void 0 != t.help_instructions_btn_css_class ? t.help_instructions_btn_css_class : "helpBtn", this.helpInstrContCssClass = void 0 != t.help_instructions_container_css_class ? t.help_instructions_container_css_class : "helpCont", this.helpInstrBtnEl = null, this.helpInstrContEl = null, this.helpInstrDefaultHtml = '<div class="helpFooter"><h4>HTML Table Filter Generator v. ' + this.version + '</h4><a href="http://tablefilter.free.fr" target="_blank">http://tablefilter.free.fr</a><br/><span>&copy;2009-' + this.year + ' Max Guglielmi.</span><div align="center" style="margin-top:8px;"><a href="javascript:;" onclick="window[\'tf_' + this.id + "']._ToggleHelp();\">Close</a></div></div>";
            var e = tf_CreateElm("span", ["id", this.prfxHelpSpan + this.id]),
                s = tf_CreateElm("div", ["id", this.prfxHelpDiv + this.id]);
            null == this.helpInstrTgtId && this.SetTopDiv();
            var i = null == this.helpInstrTgtId ? this.rDiv : tf_Id(this.helpInstrTgtId);
            i.appendChild(e);
            var l = null == this.helpInstrContTgtId ? e : tf_Id(this.helpInstrContTgtId);
            if (null == this.helpInstrBtnHtml) {
                l.appendChild(s);
                var a = tf_CreateElm("a", ["href", "javascript:void(0);"]);
                a.className = this.helpInstrBtnCssClass, a.appendChild(tf_CreateText(this.helpInstrBtnText)), e.appendChild(a), a.onclick = this.Evt._OnHelpBtnClick
            } else {
                e.innerHTML = this.helpInstrBtnHtml;
                var n = e.firstChild;
                n.onclick = this.Evt._OnHelpBtnClick, l.appendChild(s)
            }
            null == this.helpInstrHtml ? (s.innerHTML = this.helpInstrText, s.className = this.helpInstrContCssClass, s.ondblclick = this.Evt._OnHelpBtnClick) : (this.helpInstrContTgtId && l.appendChild(s), s.innerHTML = this.helpInstrHtml, this.helpInstrContTgtId || (s.className = this.helpInstrContCssClass, s.ondblclick = this.Evt._OnHelpBtnClick)), s.innerHTML += this.helpInstrDefaultHtml, this.helpInstrContEl = s, this.helpInstrBtnEl = e
        }
    },
    RemoveHelpInstructions: function() {
        null != this.helpInstrBtnEl && (this.helpInstrBtnEl.parentNode.removeChild(this.helpInstrBtnEl), this.helpInstrBtnEl = null, null != this.helpInstrContEl && (this.helpInstrContEl.parentNode.removeChild(this.helpInstrContEl), this.helpInstrContEl = null))
    },
    _ToggleHelp: function() {
        if (this.helpInstrContEl) {
            var t = this.helpInstrContEl.style.display;
            if ("" == t || "none" == t) {
                this.helpInstrContEl.style.display = "block";
                var e = tf_ObjPosition(this.helpInstrBtnEl, [this.helpInstrBtnEl.nodeName])[0];
                this.helpInstrContTgtId || (this.helpInstrContEl.style.left = e - this.helpInstrContEl.clientWidth + 25 + "px")
            } else this.helpInstrContEl.style.display = "none"
        }
    },
    ChangePage: function(t) {
        this.EvtManager(this.Evt.name.changepage, {
            pgIndex: t
        })
    },
    _ChangePage: function(t) {
        this.paging && (void 0 == t && (t = this.pageSelectorType == this.fltTypeSlc ? this.pagingSlc.options.selectedIndex : this.pagingSlc.value - 1), t >= 0 && t <= this.nbPages - 1 && (this.onBeforeChangePage && this.onBeforeChangePage.call(null, this, t), this.currentPageNb = parseInt(t) + 1, this.pageSelectorType == this.fltTypeSlc ? this.pagingSlc.options[t].selected = !0 : this.pagingSlc.value = this.currentPageNb, this.rememberPageNb && this.RememberPageNb(this.pgNbCookie), this.startPagingRow = this.pageSelectorType == this.fltTypeSlc ? this.pagingSlc.value : t * this.pagingLength, this.GroupByPage(), this.onAfterChangePage && this.onAfterChangePage.call(null, this, t)))
    },
    ChangeResultsPerPage: function() {
        this.EvtManager(this.Evt.name.changeresultsperpage)
    },
    _ChangeResultsPerPage: function() {
        if (this.paging) {
            var t = this.resultsPerPageSlc,
                e = this.pageSelectorType == this.fltTypeSlc ? this.pagingSlc.selectedIndex : parseInt(this.pagingSlc.value - 1);
            if (this.pagingLength = parseInt(t.options[t.selectedIndex].value), this.startPagingRow = this.pagingLength * e, !isNaN(this.pagingLength)) {
                if (this.startPagingRow >= this.nbFilterableRows && (this.startPagingRow = this.nbFilterableRows - this.pagingLength), this.SetPagingInfo(), this.pageSelectorType == this.fltTypeSlc) {
                    var s = this.pagingSlc.options.length - 1 <= e ? this.pagingSlc.options.length - 1 : e;
                    this.pagingSlc.options[s].selected = !0
                }
                this.rememberPageLen && this.RememberPageLength(this.pgLenCookie)
            }
        }
    },
    ResetPage: function() {
        this.EvtManager(this.Evt.name.resetpage)
    },
    _ResetPage: function(t) {
        var e = tf_ReadCookie(t);
        "" != e && this.ChangePage(e - 1)
    },
    ResetPageLength: function() {
        this.EvtManager(this.Evt.name.resetpagelength)
    },
    _ResetPageLength: function(t) {
        if (this.paging) {
            var e = tf_ReadCookie(t);
            "" != e && (this.resultsPerPageSlc.options[e].selected = !0, this.ChangeResultsPerPage())
        }
    },
    AddPaging: function(t) {
        this.hasGrid && !this.paging && (this.paging = !0, this.isPagingRemoved = !0, this.SetPaging(), this.ResetValues(), t && this.Filter())
    },
    PopulateSelect: function(t, e, s) {
        this.EvtManager(this.Evt.name.populateselect, {
            slcIndex: t,
            slcExternal: e,
            slcId: s
        })
    },
    _PopulateSelect: function(t, e, s, i) {
        function l() {
            if ("innerhtml" == f) p += '<option value="">' + h.displayAllText + "</option>";
            else {
                var t = tf_CreateOpt(h.enableSlcResetFilter ? h.displayAllText : "", "");
                if (h.enableSlcResetFilter || (t.style.display = "none"), o.appendChild(t), h.enableEmptyOption) {
                    var e = tf_CreateOpt(h.emptyText, h.emOperator);
                    o.appendChild(e)
                }
                if (h.enableNonEmptyOption) {
                    var s = tf_CreateOpt(h.nonEmptyText, h.nmOperator);
                    o.appendChild(s)
                }
            }
        }

        function a() {
            var s = o.value;
            o.innerHTML = "", l();
            for (var i = 0; i < c.length; i++)
                if ("" != c[i]) {
                    var a = c[i],
                        n = _ ? u[i] : c[i],
                        r = !1;
                    if (e && h.disableExcludedOptions && C.tf_Has(a.tf_MatchCase(h.matchCase), h.matchCase) && (r = !0), "innerhtml" == f) {
                        var d = "";
                        h.fillSlcOnDemand && s == c[i] && (d = 'selected="selected"'), p += '<option value="' + a + '" ' + d + (r ? 'disabled="disabled"' : "") + ">" + n + "</option>"
                    } else {
                        var b;
                        b = h.fillSlcOnDemand && s == c[i] && h["col" + t] == h.fltTypeSlc ? tf_CreateOpt(n, a, !0) : h["col" + t] != h.fltTypeMulti ? tf_CreateOpt(n, a, " " != g[t] && a == g[t] ? !0 : !1) : tf_CreateOpt(n, a, v.tf_Has(c[i].tf_MatchCase(h.matchCase), h.matchCase) || -1 != v.toString().indexOf(a) ? !0 : !1), r && (b.disabled = !0), o.appendChild(b)
                    }
                }
            "innerhtml" == f && (o.innerHTML += p), o.setAttribute("filled", "1")
        }
        s = void 0 == s ? !1 : s;
        var n = this.fltIds[t];
        if (!(null == tf_Id(n) && !s || null == tf_Id(i) && s)) {
            var r, o = tf_Id(s ? i : n),
                h = this,
                d = this.tbl.rows,
                f = this.slcFillingMethod.tf_LCase(),
                c = [],
                p = "",
                _ = this.hasCustomSlcOptions && this.customSlcOptions.cols.tf_Has(t),
                u = [];
            e && this.activeFilterId && (r = this.activeFilterId.split("_")[0], r = r.split(this.prfxFlt)[1]);
            var g = [],
                v = [];
            this.rememberGridValues && (g = tf_CookieValueArray(this.fltsValuesCookie, this.separator), void 0 != g && "" != g.toString().tf_Trim() && (this.hasCustomSlcOptions && this.customSlcOptions.cols.tf_Has(t) ? v.push(g[t]) : v = g[t].split(" " + h.orOperator + " ")));
            var C = null,
                b = null;
            e && this.disableExcludedOptions && (C = [], b = []);
            for (var m = this.refRow; m < this.nbRows; m++)
                if (!this.hasVisibleRows || !this.visibleRows.tf_Has(m) || this.paging) {
                    var w = d[m].cells,
                        x = w.length;
                    if (x == this.nbCells && !_)
                        for (var I = 0; x > I; I++)
                            if (t == I && (!e || e && this.disableExcludedOptions) || t == I && e && ("" == d[m].style.display && !this.paging || this.paging && (!this.validRowsIndex || this.validRowsIndex && this.validRowsIndex.tf_Has(m)) && (void 0 == r || r == t || r != t && this.validRowsIndex.tf_Has(m)))) {
                                var T = this.GetCellData(I, w[I]),
                                    R = T.tf_MatchCase(this.matchCase);
                                c.tf_Has(R, this.matchCase) || c.push(T), e && this.disableExcludedOptions && (b[I] || (b[I] = this.GetFilteredDataCol(I)), b[I].tf_Has(R, this.matchCase) || C.tf_Has(R, this.matchCase) || this.isFirstLoad || C.push(T))
                            }
                }
            if (_) {
                var E = this.__getCustomValues(t);
                c = E[0], u = E[1]
            }
            if (this.sortSlc && !_ && (this.matchCase ? (c.sort(), C && C.sort()) : (c.sort(tf_IgnoreCaseSort), C && C.sort(tf_IgnoreCaseSort))), this.sortNumAsc && this.sortNumAsc.tf_Has(t)) try {
                c.sort(tf_NumSortAsc), C && C.sort(tf_NumSortAsc), _ && u.sort(tf_NumSortAsc)
            } catch (y) {
                c.sort(), C && C.sort(), _ && u.sort()
            }
            if (this.sortNumDesc && this.sortNumDesc.tf_Has(t)) try {
                c.sort(tf_NumSortDesc), C && C.sort(tf_NumSortDesc), _ && u.sort(tf_NumSortDesc)
            } catch (y) {
                c.sort(), C && C.sort(), _ && u.sort()
            }
            a()
        }
    },
    __deferMultipleSelection: function(t, e, s) {
        if ("select" == t.nodeName.tf_LCase()) {
            var i = void 0 == s ? !1 : s,
                l = this;
            window.setTimeout(function() {
                t.options[0].selected = !1, t.options[e].selected = "" == t.options[e].value ? !1 : !0, i && l.Filter()
            }, .1)
        }
    },
    __getCustomValues: function(t) {
        if (void 0 != t) {
            var e = this.hasCustomSlcOptions && this.customSlcOptions.cols.tf_Has(t);
            if (e) {
                for (var s = [], i = [], l = this.customSlcOptions.cols.tf_IndexByValue(t), a = this.customSlcOptions.values[l], n = this.customSlcOptions.texts[l], r = this.customSlcOptions.sorts[l], o = 0; o < a.length; o++) i.push(a[o]), s.push(void 0 != n[o] ? n[o] : a[o]);
                return r && (i.sort(), s.sort()), [i, s]
            }
        }
    },
    PopulateCheckList: function(t, e, s) {
        this.EvtManager(this.Evt.name.populatechecklist, {
            slcIndex: t,
            slcExternal: e,
            slcId: s
        })
    },
    _PopulateCheckList: function(t, e, s) {
        function i() {
            var e = 1,
                s = tf_CreateCheckItem(h.fltIds[t] + "_0", "", h.displayAllText);
            if (s.className = h.checkListItemCssClass, r.appendChild(s), s.check.onclick = function(t) {
                    h.__setCheckListValues(this), r.onchange.call(null, t)
                }, h.enableCheckListResetFilter || (s.style.display = "none"), tf_isIE && (s.label.onclick = function() {
                    s.check.click()
                }), h.enableEmptyOption) {
                var i = tf_CreateCheckItem(h.fltIds[t] + "_1", h.emOperator, h.emptyText);
                i.className = h.checkListItemCssClass, r.appendChild(i), i.check.onclick = function(t) {
                    h.__setCheckListValues(this), r.onchange.call(null, t)
                }, tf_isIE && (i.label.onclick = function() {
                    i.check.click()
                }), e++
            }
            if (h.enableNonEmptyOption) {
                var l = tf_CreateCheckItem(h.fltIds[t] + "_2", h.nmOperator, h.nonEmptyText);
                l.className = h.checkListItemCssClass, r.appendChild(l), l.check.onclick = function(t) {
                    h.__setCheckListValues(this), r.onchange.call(null, t)
                }, tf_isIE && (l.label.onclick = function() {
                    l.check.click()
                }), e++
            }
            return e
        }

        function l(e) {
            var s = i(),
                l = [],
                a = tf_CookieValueByIndex(h.fltsValuesCookie, t, e);
            void 0 != a && a.tf_Trim().length > 0 && (h.hasCustomSlcOptions && h.customSlcOptions.cols.tf_Has(t) ? l.push(a) : l = a.split(" " + h.orOperator + " "));
            for (var n = 0; n < f.length; n++) {
                var o = f[n],
                    d = c ? p[n] : o,
                    u = tf_CreateCheckItem(h.fltIds[t] + "_" + (n + s), o, d);
                u.className = h.checkListItemCssClass, h.refreshFilters && h.disableExcludedOptions && _.tf_Has(o.tf_MatchCase(h.matchCase), h.matchCase) ? (tf_AddClass(u, h.checkListItemDisabledCssClass), u.check.disabled = !0, u.disabled = !0) : u.check.onclick = function(t) {
                    h.__setCheckListValues(this), r.onchange.call(null, t)
                }, r.appendChild(u), "" == o && (u.style.display = "none"), h.rememberGridValues && (h.hasCustomSlcOptions && h.customSlcOptions.cols.tf_Has(t) && -1 != l.toString().indexOf(o) || l.tf_Has(o.tf_MatchCase(h.matchCase), h.matchCase)) && (u.check.checked = !0, h.__setCheckListValues(u.check)), tf_isIE && (u.label.onclick = function() {
                    this.firstChild.click()
                })
            }
        }
        e = void 0 == e ? !1 : e;
        var a = this.prfxCheckListDiv + t + "_" + this.id;
        if (!(null == tf_Id(a) && !e || null == tf_Id(s) && e)) {
            var n = e ? tf_Id(s) : this.checkListDiv[t],
                r = tf_CreateElm("ul", ["id", this.fltIds[t]], ["colIndex", t]);
            r.className = this.checkListCssClass, r.onchange = this.Evt._OnCheckListChange;
            var o, h = this,
                d = this.tbl.rows,
                f = [],
                c = this.hasCustomSlcOptions && this.customSlcOptions.cols.tf_Has(t),
                p = [];
            this.refreshFilters && this.activeFilterId && (o = this.activeFilterId.split("_")[0], o = o.split(this.prfxFlt)[1]);
            var _ = null,
                u = null;
            this.refreshFilters && this.disableExcludedOptions && (_ = [], u = []);
            for (var g = this.refRow; g < this.nbRows; g++)
                if (!this.hasVisibleRows || !this.visibleRows.tf_Has(g) || this.paging) {
                    var v = d[g].cells,
                        C = v.length;
                    if (C == this.nbCells && !c)
                        for (var b = 0; C > b; b++)
                            if (t == b && (!this.refreshFilters || this.refreshFilters && this.disableExcludedOptions) || t == b && this.refreshFilters && ("" == d[g].style.display && !this.paging || this.paging && (void 0 == o || o == t || o != t && this.validRowsIndex.tf_Has(g)))) {
                                var m = this.GetCellData(b, v[b]),
                                    w = m.tf_MatchCase(this.matchCase);
                                f.tf_Has(w, this.matchCase) || f.push(m), this.refreshFilters && this.disableExcludedOptions && (u[b] || (u[b] = this.GetFilteredDataCol(b)), u[b].tf_Has(w, this.matchCase) || _.tf_Has(w, this.matchCase) || this.isFirstLoad || _.push(m))
                            }
                }
            if (c) {
                var x = this.__getCustomValues(t);
                f = x[0], p = x[1]
            }
            if (this.sortSlc && !c && (this.matchCase ? (f.sort(), _ && _.sort()) : (f.sort(tf_IgnoreCaseSort), _ && _.sort(tf_IgnoreCaseSort))), this.sortNumAsc && this.sortNumAsc.tf_Has(t)) try {
                f.sort(tf_NumSortAsc), _ && _.sort(tf_NumSortAsc), c && p.sort(tf_NumSortAsc)
            } catch (I) {
                f.sort(), _ && _.sort(), c && p.sort()
            }
            if (this.sortNumDesc && this.sortNumDesc.tf_Has(t)) try {
                f.sort(tf_NumSortDesc), _ && _.sort(tf_NumSortDesc), c && p.sort(tf_NumSortDesc)
            } catch (I) {
                f.sort(), _ && _.sort(), c && p.sort()
            }
            if (l(this.separator), this.fillSlcOnDemand && (n.innerHTML = ""), n.appendChild(r), n.setAttribute("filled", "1"), h.rememberGridValues && tf_isIE) {
                var T = r.getAttribute("indexes");
                if (null != T)
                    for (var R = T.split(","), E = 0; E < R.length; E++) {
                        var y = tf_Id(this.fltIds[t] + "_" + R[E]);
                        y && (y.checked = !0)
                    }
            }
        }
    },
    __setCheckListValues: function(t) {
        if (null != t) {
            for (var e = t.value, s = parseInt(t.id.split("_")[2]), i = "ul", l = "li", a = t; a.nodeName.tf_LCase() != i;) a = a.parentNode;
            if (a.nodeName.tf_LCase() == i) {
                var n = a.childNodes[s],
                    r = a.getAttribute("colIndex"),
                    o = a.getAttribute("value"),
                    h = a.getAttribute("indexes");
                if (t.checked) {
                    if ("" == e) {
                        if (null != h && "" != h)
                            for (var d = h.split(this.separator), f = 0; f < d.length; f++) {
                                var c = tf_Id(this.fltIds[r] + "_" + d[f]);
                                c && (c.checked = !1, tf_RemoveClass(a.childNodes[d[f]], this.checkListSlcItemCssClass))
                            }
                        a.setAttribute("value", ""), a.setAttribute("indexes", "")
                    } else o = o ? o : "", e = (o + " " + e + " " + this.orOperator).tf_Trim(), s = h + s + this.separator, a.setAttribute("value", e), a.setAttribute("indexes", s), tf_Id(this.fltIds[r] + "_0") && (tf_Id(this.fltIds[r] + "_0").checked = !1);
                    n.nodeName.tf_LCase() == l && (tf_RemoveClass(a.childNodes[0], this.checkListSlcItemCssClass), tf_AddClass(n, this.checkListSlcItemCssClass))
                } else {
                    if ("" != e) {
                        var p = new RegExp(tf_RegexpEscape(e + " " + this.orOperator));
                        o = o.replace(p, ""), a.setAttribute("value", o.tf_Trim());
                        var _ = new RegExp(tf_RegexpEscape(s + this.separator));
                        h = h.replace(_, ""), a.setAttribute("indexes", h)
                    }
                    n.nodeName.tf_LCase() == l && tf_RemoveClass(n, this.checkListSlcItemCssClass)
                }
            }
        }
    },
    SetResetBtn: function() {
        if ((this.hasGrid || this.isFirstLoad) && null == this.btnResetEl) {
            var t = this.fObj;
            this.btnResetTgtId = void 0 != t.btn_reset_target_id ? t.btn_reset_target_id : null, this.btnResetEl = null, this.btnResetText = void 0 != t.btn_reset_text ? t.btn_reset_text : "Reset", this.btnResetTooltip = void 0 != t.btn_reset_tooltip ? t.btn_reset_tooltip : "Clear filters", this.btnResetHtml = void 0 != t.btn_reset_html ? t.btn_reset_html : this.enableIcons ? '<input type="button" value="" class="' + this.btnResetCssClass + '" title="' + this.btnResetTooltip + '" />' : null;
            var e = tf_CreateElm("span", ["id", this.prfxResetSpan + this.id]);
            null == this.btnResetTgtId && this.SetTopDiv();
            var s = null == this.btnResetTgtId ? this.rDiv : tf_Id(this.btnResetTgtId);
            if (s.appendChild(e), null == this.btnResetHtml) {
                var i = tf_CreateElm("a", ["href", "javascript:void(0);"]);
                i.className = this.btnResetCssClass, i.appendChild(tf_CreateText(this.btnResetText)), e.appendChild(i), i.onclick = this.Evt._Clear
            } else {
                e.innerHTML = this.btnResetHtml;
                var l = e.firstChild;
                l.onclick = this.Evt._Clear
            }
            this.btnResetEl = tf_Id(this.prfxResetSpan + this.id).firstChild
        }
    },
    RemoveResetBtn: function() {
        if (this.hasGrid && null != this.btnResetEl) {
            var t = tf_Id(this.prfxResetSpan + this.id);
            null != t && t.parentNode.removeChild(t), this.btnResetEl = null
        }
    },
    SetStatusBar: function() {
        if (this.hasGrid || this.isFirstLoad) {
            var t = this.fObj;
            this.statusBarTgtId = void 0 != t.status_bar_target_id ? t.status_bar_target_id : null, this.statusBarDiv = null, this.statusBarSpan = null, this.statusBarSpanText = null, this.statusBarText = void 0 != t.status_bar_text ? t.status_bar_text : "", this.statusBarCssClass = void 0 != t.status_bar_css_class ? t.status_bar_css_class : "status", this.statusBarCloseDelay = 250;
            var e = tf_CreateElm("div", ["id", this.prfxStatus + this.id]);
            e.className = this.statusBarCssClass;
            var s = tf_CreateElm("span", ["id", this.prfxStatusSpan + this.id]),
                i = tf_CreateElm("span", ["id", this.prfxStatusTxt + this.id]);
            i.appendChild(tf_CreateText(this.statusBarText)), this.onBeforeShowMsg = tf_IsFn(t.on_before_show_msg) ? t.on_before_show_msg : null, this.onAfterShowMsg = tf_IsFn(t.on_after_show_msg) ? t.on_after_show_msg : null, null == this.statusBarTgtId && this.SetTopDiv();
            var l = null == this.statusBarTgtId ? this.lDiv : tf_Id(this.statusBarTgtId);
            this.statusBarDiv && tf_isIE && (this.statusBarDiv.outerHTML = ""), null == this.statusBarTgtId ? (e.appendChild(i), e.appendChild(s), l.appendChild(e)) : (l.appendChild(i), l.appendChild(s)), this.statusBarDiv = tf_Id(this.prfxStatus + this.id), this.statusBarSpan = tf_Id(this.prfxStatusSpan + this.id), this.statusBarSpanText = tf_Id(this.prfxStatusTxt + this.id)
        }
    },
    RemoveStatusBar: function() {
        this.hasGrid && this.statusBarDiv && (this.statusBarDiv.innerHTML = "", this.statusBarDiv.parentNode.removeChild(this.statusBarDiv), this.statusBarSpan = null, this.statusBarSpanText = null, this.statusBarDiv = null)
    },
    StatusMsg: function(t) {
        void 0 == t && this.StatusMsg(""), this.status && this.WinStatusMsg(t), this.statusBar && this.StatusBarMsg(t)
    },
    WinStatusMsg: function(t) {
        this.status && (this.onBeforeShowMsg && this.onBeforeShowMsg.call(null, this, t), window.status = t, this.onAfterShowMsg && this.onAfterShowMsg.call(null, this, t))
    },
    StatusBarMsg: function(t) {
        function e() {
            s.statusBarSpan.innerHTML = t, s.onAfterShowMsg && s.onAfterShowMsg.call(null, s, t)
        }
        if (this.statusBar && this.statusBarSpan) {
            this.onBeforeShowMsg && this.onBeforeShowMsg.call(null, this, t);
            var s = this,
                i = "" == t ? this.statusBarCloseDelay : 1;
            window.setTimeout(e, i)
        }
    },
    SetRowsCounter: function() {
        if ((this.hasGrid || this.isFirstLoad) && null == this.rowsCounterSpan) {
            var t = this.fObj;
            this.rowsCounterTgtId = void 0 != t.rows_counter_target_id ? t.rows_counter_target_id : null, this.rowsCounterDiv = null, this.rowsCounterSpan = null, this.rowsCounterText = void 0 != t.rows_counter_text ? t.rows_counter_text : "Rows: ", this.fromToTextSeparator = void 0 != t.from_to_text_separator ? t.from_to_text_separator : "-", this.overText = void 0 != t.over_text ? t.over_text : " / ", this.totRowsCssClass = void 0 != t.tot_rows_css_class ? t.tot_rows_css_class : "tot", this.onBeforeRefreshCounter = tf_IsFn(t.on_before_refresh_counter) ? t.on_before_refresh_counter : null, this.onAfterRefreshCounter = tf_IsFn(t.on_after_refresh_counter) ? t.on_after_refresh_counter : null;
            var e = tf_CreateElm("div", ["id", this.prfxCounter + this.id]);
            e.className = this.totRowsCssClass;
            var s = tf_CreateElm("span", ["id", this.prfxTotRows + this.id]),
                i = tf_CreateElm("span", ["id", this.prfxTotRowsTxt + this.id]);
            i.appendChild(tf_CreateText(this.rowsCounterText)), null == this.rowsCounterTgtId && this.SetTopDiv();
            var l = null == this.rowsCounterTgtId ? this.lDiv : tf_Id(this.rowsCounterTgtId);
            this.rowsCounterDiv && tf_isIE && (this.rowsCounterDiv.outerHTML = ""), null == this.rowsCounterTgtId ? (e.appendChild(i), e.appendChild(s), l.appendChild(e)) : (l.appendChild(i), l.appendChild(s)), this.rowsCounterDiv = tf_Id(this.prfxCounter + this.id), this.rowsCounterSpan = tf_Id(this.prfxTotRows + this.id), this.RefreshNbRows()
        }
    },
    RemoveRowsCounter: function() {
        this.hasGrid && null != this.rowsCounterSpan && (null == this.rowsCounterTgtId && this.rowsCounterDiv ? tf_isIE ? this.rowsCounterDiv.outerHTML = "" : this.rowsCounterDiv.parentNode.removeChild(this.rowsCounterDiv) : tf_Id(this.rowsCounterTgtId).innerHTML = "", this.rowsCounterSpan = null, this.rowsCounterDiv = null)
    },
    RefreshNbRows: function(t) {
        if (null != this.rowsCounterSpan) {
            this.onBeforeRefreshCounter && this.onBeforeRefreshCounter.call(null, this, this.rowsCounterSpan);
            var e;
            if (this.paging) {
                var s = parseInt(this.startPagingRow) + (this.nbVisibleRows > 0 ? 1 : 0),
                    i = s + this.pagingLength - 1 <= this.nbVisibleRows ? s + this.pagingLength - 1 : this.nbVisibleRows;
                e = s + this.fromToTextSeparator + i + this.overText + this.nbVisibleRows
            } else e = void 0 != t && "" != t ? t : this.nbFilterableRows - this.nbHiddenRows - (this.hasVisibleRows ? this.visibleRows.length : 0);
            this.rowsCounterSpan.innerHTML = e, this.onAfterRefreshCounter && this.onAfterRefreshCounter.call(null, this, this.rowsCounterSpan, e)
        }
    },
    SetWatermark: function(t) {
        if (this.fltGrid && "" != this.inpWatermark)
            for (var t = t || void 0 == t ? !0 : !1, e = 0; e < this.fltIds.length; e++)
                if (this["col" + e] == this.fltTypeInp) {
                    var s = this.isInpWatermarkArray ? this.inpWatermark[e] : this.inpWatermark;
                    this.GetFilterValue(e) == (t ? "" : s) && document.activeElement != this.GetFilterElement(e) && (this.SetFilterValue(e, t ? s : ""), tf_AddClass(this.GetFilterElement(e), this.inpWatermarkCssClass))
                }
    },
    SetGridLayout: function() {
        function t(t) {
            if (t) {
                for (var e = t.nbCells - 1; e >= 0; e--) {
                    var s = tf_CreateElm("col", ["id", t.id + "_col_" + e]);
                    t.tbl.firstChild.parentNode.insertBefore(s, t.tbl.firstChild), s.style.width = t.colWidth[e], t.gridColElms[e] = s
                }
                t.tblHasColTag = !0
            }
        }
        if (this.gridLayout) {
            var e = this.fObj;
            if (this.gridWidth = void 0 != e.grid_width ? e.grid_width : null, this.gridHeight = void 0 != e.grid_height ? e.grid_height : null, this.gridMainContCssClass = void 0 != e.grid_cont_css_class ? e.grid_cont_css_class : "grd_Cont", this.gridContCssClass = void 0 != e.grid_tbl_cont_css_class ? e.grid_tbl_cont_css_class : "grd_tblCont", this.gridHeadContCssClass = void 0 != e.grid_tblHead_cont_css_class ? e.grid_tblHead_cont_css_class : "grd_headTblCont", this.gridInfDivCssClass = void 0 != e.grid_inf_grid_css_class ? e.grid_inf_grid_css_class : "grd_inf", this.gridHeadRowIndex = void 0 != e.grid_headers_row_index ? e.grid_headers_row_index : 0, this.gridHeadRows = void 0 != e.grid_headers_rows ? e.grid_headers_rows : [0], this.gridEnableFilters = void 0 != e.grid_enable_default_filters ? e.grid_enable_default_filters : !0, this.gridDefaultColWidth = void 0 != e.grid_default_col_width ? e.grid_default_col_width : "100px", this.gridEnableColResizer = void 0 != e.grid_enable_cols_resizer ? e.grid_enable_cols_resizer : !0, this.gridColResizerPath = void 0 != e.grid_cont_col_resizer_path ? e.grid_cont_col_resizer_path : this.basePath + "TFExt_ColsResizer/TFExt_ColsResizer.js", !this.hasColWidth) {
                this.colWidth = [];
                for (var s = 0; s < this.nbCells; s++) {
                    var i, l = this.tbl.rows[this.gridHeadRowIndex].cells[s];
                    i = "" != l.width ? l.width : "" != l.style.width ? parseInt(l.style.width) : this.gridDefaultColWidth, this.colWidth[s] = i
                }
                this.hasColWidth = !0
            }
            this.SetColWidths(this.gridHeadRowIndex);
            var a;
            a = "" != this.tbl.width ? this.tbl.width : "" != this.tbl.style.width ? parseInt(this.tbl.style.width) : this.tbl.clientWidth, this.tblMainCont = tf_CreateElm("div", ["id", this.prfxMainTblCont + this.id]), this.tblMainCont.className = this.gridMainContCssClass, this.gridWidth && (this.tblMainCont.style.width = this.gridWidth), this.tbl.parentNode.insertBefore(this.tblMainCont, this.tbl), this.tblCont = tf_CreateElm("div", ["id", this.prfxTblCont + this.id]), this.tblCont.className = this.gridContCssClass, this.gridWidth && (this.tblCont.style.width = this.gridWidth), this.gridHeight && (this.tblCont.style.height = this.gridHeight), this.tbl.parentNode.insertBefore(this.tblCont, this.tbl);
            var n = this.tbl.parentNode.removeChild(this.tbl);
            this.tblCont.appendChild(n), "" == this.tbl.style.width && (this.tbl.style.width = (this.__containsStr("%", a) ? this.tbl.clientWidth : a) + "px");
            var r = this.tblCont.parentNode.removeChild(this.tblCont);
            this.tblMainCont.appendChild(r), this.headTblCont = tf_CreateElm("div", ["id", this.prfxHeadTblCont + this.id]), this.headTblCont.className = this.gridHeadContCssClass, this.gridWidth && (this.headTblCont.style.width = this.gridWidth), this.headTbl = tf_CreateElm("table", ["id", this.prfxHeadTbl + this.id]);
            for (var o = tf_CreateElm("tHead"), h = this.tbl.rows[this.gridHeadRowIndex], d = [], f = 0; f < this.nbCells; f++) {
                var l = h.cells[f],
                    c = l.getAttribute("id");
                c && "" != c || (c = this.prfxGridTh + f + "_" + this.id, l.setAttribute("id", c)), d.push(c)
            }
            var p = tf_CreateElm("tr");
            if (this.gridEnableFilters && this.fltGrid) {
                this.externalFltTgtIds = [];
                for (var _ = 0; _ < this.nbCells; _++) {
                    var u = this.prfxFlt + _ + this.prfxGridFltTd + this.id,
                        g = tf_CreateElm(this.fltCellTag, ["id", u]);
                    p.appendChild(g), this.externalFltTgtIds[_] = u
                }
            }
            for (var v = 0; v < this.gridHeadRows.length; v++) {
                var C = this.tbl.rows[this.gridHeadRows[0]];
                o.appendChild(C)
            }
            this.headTbl.appendChild(o), 0 == this.filtersRowIndex ? o.insertBefore(p, h) : o.appendChild(p), this.headTblCont.appendChild(this.headTbl), this.tblCont.parentNode.insertBefore(this.headTblCont, this.tblCont);
            var b = tf_Tag(this.tbl, "thead");
            b.length > 0 && this.tbl.removeChild(b[0]), this.headTbl.style.width = this.tbl.style.width, this.headTbl.style.tableLayout = "fixed", this.tbl.style.tableLayout = "fixed", this.headTbl.cellPadding = this.tbl.cellPadding, this.headTbl.cellSpacing = this.tbl.cellSpacing, this.headTblCont.style.width = this.tblCont.clientWidth + "px", this.SetColWidths(), this.tbl.style.width = "", (tf_isIE || tf_isIE7) && (this.headTbl.style.width = "");
            var m = this;
            this.tblCont.onscroll = function() {
                m.headTblCont.scrollLeft = this.scrollLeft;
                var t = this;
                if (!m.isPointerXOverwritten) try {
                    TF.Evt.pointerX = function(e) {
                        e = e || window.event;
                        var s = tf_StandardBody().scrollLeft + t.scrollLeft;
                        return e.pageX + t.scrollLeft || e.clientX + s
                    }, m.isPointerXOverwritten = !0
                } catch (e) {
                    m.isPointerXOverwritten = !1
                }
            };
            var e = void 0 == this.fObj ? {} : this.fObj;
            if (0 != e.sort && (this.sort = !0, this.sortConfig.asyncSort = !0, this.sortConfig.triggerIds = d), this.gridEnableColResizer && (this.hasExtensions ? this.__containsStr("colsresizer", this.extensions.src.toString().tf_LCase()) || (this.extensions.name.push("ColumnsResizer_" + this.id), this.extensions.src.push(this.gridColResizerPath), this.extensions.description.push("Columns Resizing"), this.extensions.initialize.push(function(t) {
                    t.SetColsResizer("ColumnsResizer_" + t.id)
                })) : (this.extensions = {
                    name: ["ColumnsResizer_" + this.id],
                    src: [this.gridColResizerPath],
                    description: ["Columns Resizing"],
                    initialize: [function(t) {
                        t.SetColsResizer("ColumnsResizer_" + t.id)
                    }]
                }, this.hasExtensions = !0)), e.col_resizer_cols_headers_table = this.headTbl.getAttribute("id"), e.col_resizer_cols_headers_index = this.gridHeadRowIndex, e.col_resizer_width_adjustment = 0, e.col_enable_text_ellipsis = !1, m.tblHasColTag = tf_Tag(m.tbl, "col").length > 0 ? !0 : !1, !tf_isIE && !tf_isIE7)
                if (m.tblHasColTag)
                    for (var w = tf_Tag(m.tbl, "col"), v = 0; v < m.nbCells; v++) w[v].setAttribute("id", m.id + "_col_" + v), w[v].style.width = m.colWidth[v], m.gridColElms.push(w[v]);
                else t(m);
            if (tf_isIE || tf_isIE7) {
                var x, I = tf_Tag(m.tbl, "tbody");
                x = I.length > 0 ? I[0].insertRow(0) : m.tbl.insertRow(0), x.style.height = "0px";
                for (var v = 0; v < m.nbCells; v++) {
                    var T = tf_CreateElm("td", ["id", m.id + "_col_" + v]);
                    T.style.width = m.colWidth[v], m.tbl.rows[1].cells[v].style.width = "", x.appendChild(T), m.gridColElms.push(T)
                }
                this.hasGridWidthsRow = !0, m.leadColWidthsRow = m.tbl.rows[0], m.leadColWidthsRow.setAttribute("validRow", "false");
                var R = tf_IsFn(e.on_before_sort) ? e.on_before_sort : null;
                e.on_before_sort = function(t, e) {
                    t.leadColWidthsRow.setAttribute("validRow", "false"), null != R && R.call(null, t, e)
                };
                var E = tf_IsFn(e.on_after_sort) ? e.on_after_sort : null;
                e.on_after_sort = function(t, e) {
                    if (0 != t.leadColWidthsRow.rowIndex) {
                        {
                            t.leadColWidthsRow
                        }
                        I.length > 0 ? I[0].moveRow(t.leadColWidthsRow.rowIndex, 0) : t.tbl.moveRow(t.leadColWidthsRow.rowIndex, 0)
                    }
                    null != E && E.call(null, t, e)
                }
            }
            var y = tf_IsFn(e.on_after_col_resized) ? e.on_after_col_resized : null;
            e.on_after_col_resized = function(t, e) {
                if (void 0 != e) {
                    var s = t.crWColsRow.cells[e].style.width,
                        i = t.gridColElms[e];
                    i.style.width = s;
                    var l = t.crWColsRow.cells[e].clientWidth,
                        a = t.crWRowDataTbl.cells[e].clientWidth;
                    (tf_isIE || tf_isIE7) && (t.tbl.style.width = t.headTbl.clientWidth + "px"), l == a || tf_isIE || tf_isIE7 || (t.headTbl.style.width = t.tbl.clientWidth + "px"), null != y && y.call(null, t, e)
                }
            }, this.tbl.clientWidth != this.headTbl.clientWidth && (this.tbl.style.width = this.headTbl.clientWidth + "px")
        }
    },
    RemoveGridLayout: function() {
        if (this.gridLayout) {
            var t = this.tbl.parentNode.removeChild(this.tbl);
            this.tblMainCont.parentNode.insertBefore(t, this.tblMainCont), this.tblMainCont.parentNode.removeChild(this.tblMainCont), this.tblMainCont = null, this.headTblCont = null, this.headTbl = null, this.tblCont = null, this.tbl.outerHTML = this.sourceTblHtml, this.tbl = tf_Id(this.id)
        }
    },
    SetPopupFilterIcons: function() {
        if (this.popUpFilters) {
            this.isExternalFlt = !0;
            var t = this.fObj;
            this.popUpImgFlt = void 0 != t.popup_filters_image ? t.popup_filters_image : this.themesPath + "icn_filter.gif", this.popUpImgFltActive = void 0 != t.popup_filters_image_active ? t.popup_filters_image_active : this.themesPath + "icn_filterActive.gif", this.popUpImgFltHtml = void 0 != t.popup_filters_image_html ? t.popup_filters_image_html : '<img src="' + this.popUpImgFlt + '" alt="Column filter" />', this.popUpDivCssClass = void 0 != t.popup_div_css_class ? t.popup_div_css_class : "popUpFilter", this.onBeforePopUpOpen = tf_IsFn(t.on_before_popup_filter_open) ? t.on_before_popup_filter_open : null, this.onAfterPopUpOpen = tf_IsFn(t.on_after_popup_filter_open) ? t.on_after_popup_filter_open : null, this.onBeforePopUpClose = tf_IsFn(t.on_before_popup_filter_close) ? t.on_before_popup_filter_close : null, this.onAfterPopUpClose = tf_IsFn(t.on_after_popup_filter_close) ? t.on_after_popup_filter_close : null, this.externalFltTgtIds = [], this.popUpFltSpans = [], this.popUpFltImgs = [], this.popUpFltElms = this.popUpFltElmCache ? this.popUpFltElmCache : [], this.popUpFltAdjustToContainer = !0;
            for (var e = this, s = 0; s < this.nbCells; s++)
                if (this["col" + s] != this.fltTypeNone) {
                    var i = tf_CreateElm("span", ["id", this.prfxPopUpSpan + this.id + "_" + s], ["ci", s]);
                    i.innerHTML = this.popUpImgFltHtml;
                    var l = this.GetHeaderElement(s);
                    l.appendChild(i), i.onclick = function(t) {
                        var s = t || window.event,
                            i = parseInt(this.getAttribute("ci"));
                        if (e.CloseAllPopupFilters(i), e.TogglePopupFilter(i), e.popUpFltAdjustToContainer) {
                            var l = e.popUpFltElms[i],
                                a = e.GetHeaderElement(i),
                                n = .95 * a.clientWidth;
                            if (!tf_isNotIE) {
                                var r = tf_ObjPosition(a, [a.nodeName])[0];
                                l.style.left = r + "px"
                            }
                            l.style.width = parseInt(n) + "px"
                        }
                        tf_CancelEvent(s), tf_StopEvent(s)
                    }, this.popUpFltSpans[s] = i, this.popUpFltImgs[s] = i.firstChild
                }
        }
    },
    SetPopupFilters: function() {
        for (var t = 0; t < this.popUpFltElmCache.length; t++) this.SetPopupFilter(t, this.popUpFltElmCache[t])
    },
    SetPopupFilter: function(t, e) {
        var s = e ? e : tf_CreateElm("div", ["id", this.prfxPopUpDiv + this.id + "_" + t]);
        s.className = this.popUpDivCssClass, this.externalFltTgtIds.push(this.prfxPopUpDiv + this.id + "_" + t);
        var i = this.GetHeaderElement(t);
        i.insertBefore(s, i.firstChild), s.onclick = function(t) {
            tf_StopEvent(t || window.event)
        }, this.popUpFltElms[t] = s
    },
    TogglePopupFilter: function(t) {
        var e = this.popUpFltElms[t];
        "none" == e.style.display || "" == e.style.display ? (null != this.onBeforePopUpOpen && this.onBeforePopUpOpen.call(null, this, this.popUpFltElms[t], t), e.style.display = "block", this["col" + t] == this.fltTypeInp && this.GetFilterElement(t).focus(), null != this.onAfterPopUpOpen && this.onAfterPopUpOpen.call(null, this, this.popUpFltElms[t], t)) : (null != this.onBeforePopUpClose && this.onBeforePopUpClose.call(null, this, this.popUpFltElms[t], t), e.style.display = "none", null != this.onAfterPopUpClose && this.onAfterPopUpClose.call(null, this, this.popUpFltElms[t], t))
    },
    CloseAllPopupFilters: function(t) {
        for (var e = 0; e < this.popUpFltElms.length; e++)
            if (e != t) {
                var s = this.popUpFltElms[e];
                s && (s.style.display = "none")
            }
    },
    RemovePopupFilters: function() {
        this.popUpFltElmCache = [];
        for (var t = 0; t < this.popUpFltElms.length; t++) {
            var e = this.popUpFltElms[t],
                s = this.popUpFltSpans[t];
            e && (e.parentNode.removeChild(e), this.popUpFltElmCache[t] = e), e = null, s && s.parentNode.removeChild(s), s = null
        }
    },
    SetPopupFilterIcon: function(t, e) {
        this.popUpFltImgs[t] && (this.popUpFltImgs[t].src = e ? this.popUpImgFltActive : this.popUpImgFlt)
    },
    SetAllPopupFiltersIcon: function(t) {
        for (var e = 0; e < this.popUpFltImgs.length; e++) this.SetPopupFilterIcon(e, !1)
    },
    RememberFiltersValue: function(t) {
        for (var e = [], s = 0; s < this.fltIds.length; s++) value = this.GetFilterValue(s), "" == value && (value = " "), e.push(value);
        e.push(this.fltIds.length), tf_WriteCookie(t, e.join(this.separator), this.cookieDuration)
    },
    RememberPageNb: function(t) {
        tf_WriteCookie(t, this.currentPageNb, this.cookieDuration)
    },
    RememberPageLength: function(t) {
        tf_WriteCookie(t, this.resultsPerPageSlc.selectedIndex, this.cookieDuration)
    },
    ResetValues: function() {
        this.EvtManager(this.Evt.name.resetvalues)
    },
    _ResetValues: function() {
        this.rememberGridValues && this.fillSlcOnDemand && this.ResetGridValues(this.fltsValuesCookie), this.rememberPageLen && this.ResetPageLength(this.pgLenCookie), this.rememberPageNb && this.ResetPage(this.pgNbCookie)
    },
    ResetGridValues: function(t) {
        if (this.fillSlcOnDemand) {
            var e = tf_ReadCookie(t),
                s = new RegExp(this.separator, "g"),
                i = e.split(s),
                l = this.GetFiltersByType(this.fltTypeSlc, !0),
                a = this.GetFiltersByType(this.fltTypeMulti, !0);
            if (i[i.length - 1] == this.fltIds.length) {
                for (var n = 0; n < i.length - 1; n++)
                    if (" " != i[n])
                        if (this["col" + n] == this.fltTypeSlc || this["col" + n] == this.fltTypeMulti) {
                            var r = tf_Id(this.fltIds[n]);
                            if (r.options[0].selected = !1, l.tf_Has(n)) {
                                var o = tf_CreateOpt(i[n], i[n], !0);
                                r.appendChild(o), this.hasStoredValues = !0
                            }
                            if (a.tf_Has(n)) {
                                var h = i[n].split(" " + this.orOperator + " ");
                                for (j = 0; j < h.length; j++)
                                    if ("" != h[j]) {
                                        var o = tf_CreateOpt(h[j], h[j], !0);
                                        r.appendChild(o), this.hasStoredValues = !0, tf_isIE && (this.__deferMultipleSelection(r, j, !1), hasStoredValues = !1)
                                    }
                            }
                        } else if (this["col" + n] == this.fltTypeCheckList) {
                    var d = this.checkListDiv[n];
                    d.title = d.innerHTML, d.innerHTML = "";
                    var f = tf_CreateElm("ul", ["id", this.fltIds[n]], ["colIndex", n]);
                    f.className = this.checkListCssClass;
                    var c = tf_CreateCheckItem(this.fltIds[n] + "_0", "", this.displayAllText);
                    c.className = this.checkListItemCssClass, f.appendChild(c), d.appendChild(f);
                    var h = i[n].split(" " + this.orOperator + " ");
                    for (j = 0; j < h.length; j++)
                        if ("" != h[j]) {
                            var p = tf_CreateCheckItem(this.fltIds[n] + "_" + (j + 1), h[j], h[j]);
                            p.className = this.checkListItemCssClass, f.appendChild(p), p.check.checked = !0, this.__setCheckListValues(p.check), this.hasStoredValues = !0
                        }
                }!this.hasStoredValues && this.paging && this.SetPagingInfo()
            }
        }
    },
    SetRowBg: function(t, e) {
        if (this.alternateBgs && !isNaN(t)) {
            var s = this.tbl.rows,
                i = void 0 == e ? t : e;
            this.RemoveRowBg(t), tf_AddClass(s[t], i % 2 ? this.rowBgEvenCssClass : this.rowBgOddCssClass)
        }
    },
    RemoveRowBg: function(t) {
        if (!isNaN(t)) {
            var e = this.tbl.rows;
            tf_RemoveClass(e[t], this.rowBgOddCssClass), tf_RemoveClass(e[t], this.rowBgEvenCssClass)
        }
    },
    SetAlternateRows: function() {
        if (this.hasGrid || this.isFirstLoad)
            for (var t = (this.tbl.rows, null == this.validRowsIndex), e = t ? this.refRow : 0, s = t ? this.nbFilterableRows + e : this.validRowsIndex.length, i = 0, l = e; s > l; l++) {
                var a = t ? l : this.validRowsIndex[l];
                this.SetRowBg(a, i), i++
            }
    },
    RemoveAlternateRows: function() {
        if (this.hasGrid) {
            for (var t = (this.tbl.rows, this.refRow); t < this.nbRows; t++) this.RemoveRowBg(t);
            this.isStartBgAlternate = !0
        }
    },
    SetFixedHeaders: function() {
        if ((this.hasGrid || this.isFirstLoad) && this.fixedHeaders && !this.contDiv) {
            var t = tf_Tag(this.tbl, "thead");
            if (0 != t.length) {
                var e = tf_Tag(this.tbl, "tbody");
                if (0 != e[0].clientHeight) this.prevTBodyH = e[0].clientHeight, this.prevTBodyOverflow = e[0].style.overflow, this.prevTBodyOverflowX = e[0].style.overflowX, e[0].style.height = this.tBodyH + "px", e[0].style.overflow = "auto", e[0].style.overflowX = "hidden";
                else {
                    var s = tf_CreateElm("div", ["id", this.prfxContentDiv + this.id]);
                    s.className = this.contDivCssClass, this.tbl.parentNode.insertBefore(s, this.tbl), s.appendChild(this.tbl), this.contDiv = tf_Id(this.prfxContentDiv + this.id), this.contDiv.style.position = "relative";
                    for (var i = 0, l = tf_Tag(t[0], "tr"), a = 0; a < l.length; a++) l[a].style.cssText += "position:relative; top:expression(offsetParent.scrollTop);", i += parseInt(l[a].clientHeight);
                    this.contDiv.style.height = this.tBodyH + i + "px";
                    var n = tf_Tag(this.tbl, "tfoot");
                    if (0 == n.length) return;
                    for (var r = tf_Tag(n[0], "tr"), o = 0; o < r.length; o++) r[o].style.cssText += "position:relative; overflow-x: hidden; top: expression(parentNode.parentNode.offsetHeight >= offsetParent.offsetHeight ? 0 - parentNode.parentNode.offsetHeight + offsetParent.offsetHeight + offsetParent.scrollTop : 0);"
                }
            }
        }
    },
    RemoveFixedHeaders: function() {
        if (this.hasGrid && this.fixedHeaders)
            if (this.contDiv) {
                this.contDiv.parentNode.insertBefore(this.tbl, this.contDiv), this.contDiv.parentNode.removeChild(this.contDiv), this.contDiv = null;
                var t = tf_Tag(this.tbl, "thead");
                if (0 == t.length) return;
                var e = tf_Tag(t[0], "tr");
                if (0 == e.length) return;
                for (var s = 0; s < e.length; s++) e[s].style.cssText = "";
                var i = tf_Tag(this.tbl, "tfoot");
                if (0 == i.length) return;
                for (var l = tf_Tag(i[0], "tr"), a = 0; a < l.length; a++) l[a].style.position = "relative", l[a].style.top = "", l[a].style.overeflowX = ""
            } else {
                var n = tf_Tag(this.tbl, "tbody");
                if (0 == n.length) return;
                n[0].style.height = this.prevTBodyH + "px", n[0].style.overflow = this.prevTBodyOverflow, n[0].style.overflowX = this.prevTBodyOverflowX
            }
    },
    Filter: function() {
        this.EvtManager(this.Evt.name.filter)
    },
    _Filter: function() {
        function t(t, e, s) {
            if (l.highlightKeywords && e) {
                t = t.replace(p, ""), t = t.replace(_, ""), t = t.replace(u, ""), t = t.replace(g, "");
                var i = t;
                (r.test(t) || o.test(t) || h.test(t) || d.test(t) || c.test(t)) && (i = tf_GetNodeText(s)), "" != i && tf_HighlightWord(s, i, l.highlightCssClass, l)
            }
        }

        function e(t, e, s) {
            var i, w = h.test(t),
                x = r.test(t),
                I = d.test(t),
                T = o.test(t),
                R = c.test(t),
                E = _.test(t),
                y = p.test(t),
                S = (v.test(t), u.test(t)),
                P = g.test(t),
                k = C == t,
                L = b == t,
                D = m.test(t),
                N = w && tf_IsValidDate(t.replace(h, ""), F),
                O = x && tf_IsValidDate(t.replace(r, ""), F),
                B = I && tf_IsValidDate(t.replace(d, ""), F),
                H = T && tf_IsValidDate(t.replace(o, ""), F),
                A = R && tf_IsValidDate(t.replace(c, ""), F),
                G = E && tf_IsValidDate(t.replace(_, ""), F);
            if (tf_IsValidDate(e, F)) {
                var V = tf_FormatDate(e, F);
                if (N) {
                    var M = tf_FormatDate(t.replace(h, ""), F);
                    i = M > V
                } else if (O) {
                    var M = tf_FormatDate(t.replace(r, ""), F);
                    i = M >= V
                } else if (H) {
                    var M = tf_FormatDate(t.replace(o, ""), F);
                    i = V >= M
                } else if (B) {
                    var M = tf_FormatDate(t.replace(d, ""), F);
                    i = V > M
                } else if (A) {
                    var M = tf_FormatDate(t.replace(c, ""), F);
                    i = V.toString() != M.toString()
                } else if (G) {
                    var M = tf_FormatDate(t.replace(_, ""), F);
                    i = V.toString() == M.toString()
                } else if (p.test(t)) i = l.__containsStr(t.replace(p, ""), e, null, !1);
                else if (tf_IsValidDate(t, F)) {
                    var M = tf_FormatDate(t, F);
                    i = V.toString() == M.toString()
                } else k ? i = "" == e.tf_Trim() ? !0 : !1 : L && (i = "" != e.tf_Trim() ? !0 : !1)
            } else if (l.hasColNbFormat && null != l.colNbFormat[s] ? (a = tf_RemoveNbFormat(e, l.colNbFormat[s]), n = l.colNbFormat[s]) : "," == l.thousandsSeparator && "." == l.decimalSeparator ? (a = tf_RemoveNbFormat(e, "us"), n = "us") : (a = tf_RemoveNbFormat(e, "eu"), n = "eu"), x) i = a <= tf_RemoveNbFormat(t.replace(r, ""), n);
            else if (T) i = a >= tf_RemoveNbFormat(t.replace(o, ""), n);
            else if (w) i = a < tf_RemoveNbFormat(t.replace(h, ""), n);
            else if (I) i = a > tf_RemoveNbFormat(t.replace(d, ""), n);
            else if (R) i = l.__containsStr(t.replace(c, ""), e) ? !1 : !0;
            else if (y) i = l.__containsStr(t.replace(p, ""), e, null, !1);
            else if (E) i = l.__containsStr(t.replace(_, ""), e, null, !0);
            else if (S) i = 0 == e.indexOf(t.replace(u, "")) ? !0 : !1;
            else if (P) {
                var z = t.replace(g, "");
                i = e.lastIndexOf(z, e.length - 1) == e.length - 1 - (z.length - 1) && e.lastIndexOf(z, e.length - 1) > -1 ? !0 : !1
            } else if (k) i = "" == e.tf_Trim() ? !0 : !1;
            else if (L) i = "" != e.tf_Trim() ? !0 : !1;
            else if (D) try {
                var z = t.replace(m, ""),
                    U = new RegExp(z);
                i = U.test(e)
            } catch (W) {
                i = !1
            } else i = l.__containsStr(t, e, void 0 == f["col_" + s] ? this.fltTypeInp : f["col_" + s]);
            return i
        }
        if (this.fltGrid && (this.hasGrid || this.isFirstLoad)) {
            this.onBeforeFilter && this.onBeforeFilter.call(null, this), "" != this.inpWatermark && this.SetWatermark(!1);
            var s = this.tbl.rows;
            f = void 0 != this.fObj ? this.fObj : [];
            var i = 0;
            this.validRowsIndex = [];
            var l = this;
            this.highlightKeywords && this.UnhighlightAll(), this.popUpFilters && this.SetAllPopupFiltersIcon(), this.markActiveColumns && this.ClearActiveColumns(), this.searchArgs = this.GetFiltersValue();
            for (var a, n, r = new RegExp(this.leOperator), o = new RegExp(this.geOperator), h = new RegExp(this.lwOperator), d = new RegExp(this.grOperator), c = new RegExp(this.dfOperator), p = new RegExp(tf_RegexpEscape(this.lkOperator)), _ = new RegExp(this.eqOperator), u = new RegExp(this.stOperator), g = new RegExp(this.enOperator), v = new RegExp(this.anOperator), C = (new RegExp(this.curExp), this.emOperator), b = this.nmOperator, m = new RegExp(tf_RegexpEscape(this.rgxOperator)), w = this.refRow; w < this.nbRows; w++) {
                "none" == s[w].style.display && (s[w].style.display = "");
                var x = s[w].cells,
                    I = x.length;
                if (I == this.nbCells) {
                    for (var T = [], R = "include" == this.searchType ? !0 : !1, E = !1, y = 0; I > y; y++) {
                        var S = this.searchArgs[this.singleSearchFlt ? 0 : y],
                            F = this.hasColDateType ? this.colDateType[y] : this.defaultDateType;
                        if ("" != S) {
                            var P = this.GetCellData(y, x[y]).tf_MatchCase(this.matchCase),
                                k = S.split(this.orOperator),
                                L = k.length > 1 ? !0 : !1,
                                D = S.split(this.anOperator),
                                N = D.length > 1 ? !0 : !1;
                            if (L || N) {
                                for (var O, B = !1, H = L ? k : D, A = 0; A < H.length && (O = H[A].tf_Trim(), B = e(O, P, y), t(O, B, x[y]), !L || !B) && (!N || B); A++);
                                T[y] = B
                            } else T[y] = e(S.tf_Trim(), P, y), t(S, T[y], x[y]);
                            T[y] || (R = "include" == this.searchType ? !1 : !0), this.singleSearchFlt && T[y] && (E = !0), this.popUpFilters && this.SetPopupFilterIcon(y, !0), this.markActiveColumns && w == this.refRow && (this.onBeforeActiveColumn && this.onBeforeActiveColumn.call(null, this, y), tf_AddClass(this.GetHeaderElement(y), this.activeColumnsCssClass), this.onAfterActiveColumn && this.onAfterActiveColumn.call(null, this, y))
                        }
                    }
                    this.singleSearchFlt && E && (R = !0), R ? (this.SetRowValidation(w, !0), this.validRowsIndex.push(w), this.alternateBgs && this.SetRowBg(w, this.validRowsIndex.length), this.onRowValidated && this.onRowValidated.call(null, this, w)) : (this.SetRowValidation(w, !1), this.hasVisibleRows && this.visibleRows.tf_Has(w) && !this.paging ? this.validRowsIndex.push(w) : i++)
                }
            }
            this.nbVisibleRows = this.validRowsIndex.length, this.nbHiddenRows = i, this.isStartBgAlternate = !1, this.rememberGridValues && this.RememberFiltersValue(this.fltsValuesCookie), this.paging || this.ApplyGridProps(), this.paging && (this.startPagingRow = 0, this.currentPageNb = 1, this.SetPagingInfo(this.validRowsIndex)), this.onAfterFilter && this.onAfterFilter.call(null, this)
        }
    },
    ApplyGridProps: function() {
        this.activeFlt && this.activeFlt.nodeName.tf_LCase() == this.fltTypeSlc && !this.popUpFilters && (this.activeFlt.blur(), this.activeFlt.parentNode && this.activeFlt.parentNode.focus()), this.visibleRows && this.SetVisibleRows(), this.colOperation && this.SetColOperation(), this.refreshFilters && this.RefreshFiltersGrid();
        var t = !this.paging && this.hasVisibleRows ? this.nbVisibleRows - this.visibleRows.length : this.nbVisibleRows;
        this.rowsCounter && this.RefreshNbRows(t), "" != this.inpWatermark && this.SetWatermark(!0), this.popUpFilters && this.CloseAllPopupFilters()
    },
    GetColValues: function(t, e, s) {
        if (this.fltGrid) {
            for (var i = this.tbl.rows, l = [], a = this.refRow; a < this.nbRows; a++) {
                var n = !1;
                void 0 != s && tf_IsObj(s) && (n = s.tf_Has(a));
                var r = i[a].cells,
                    o = r.length;
                if (o == this.nbCells && !n)
                    for (var h = 0; o > h; h++)
                        if (h == t && "" == i[a].style.display) {
                            var d = this.GetCellData(h, r[h]).tf_LCase(),
                                f = this.colNbFormat ? this.colNbFormat[t] : null;
                            l.push(e ? tf_RemoveNbFormat(d, f) : d)
                        }
            }
            return l
        }
    },
    GetFilterValue: function(t) {
        if (this.fltGrid) {
            var e, s = this.GetFilterElement(t);
            if (null == s) return e = "";
            if (this["col" + t] != this.fltTypeMulti && this["col" + t] != this.fltTypeCheckList) e = s.value;
            else if (this["col" + t] == this.fltTypeMulti) {
                e = "";
                for (var i = 0; i < s.options.length; i++) s.options[i].selected && (e = e.concat(s.options[i].value + " " + this.orOperator + " "));
                e = e.substr(0, e.length - 4)
            } else this["col" + t] == this.fltTypeCheckList && (null != s.getAttribute("value") ? (e = s.getAttribute("value"), e = e.substr(0, e.length - 3)) : e = "");
            return e
        }
    },
    GetFiltersValue: function() {
        if (this.fltGrid) {
            for (var t = [], e = 0; e < this.fltIds.length; e++) t.push(this.GetFilterValue(e).tf_MatchCase(this.matchCase).tf_Trim());
            return t
        }
    },
    GetFilterId: function() {
        return this.fltGrid ? this.fltIds[i] : void 0
    },
    GetFiltersByType: function(t, e) {
        if (this.fltGrid) {
            for (var s = [], i = 0; i < this.fltIds.length; i++) {
                var l = this["col" + i];
                if (l == t.tf_LCase()) {
                    var a = e ? i : this.fltIds[i];
                    s.push(a)
                }
            }
            return s
        }
    },
    GetFilterElement: function(t) {
        return this.fltGrid ? tf_Id(this.fltIds[t]) : null
    },
    GetCellsNb: function(t) {
        var e = void 0 == t ? this.tbl.rows[0] : this.tbl.rows[t];
        return e.cells.length
    },
    GetRowsNb: function(t) {
        var e = void 0 == this.refRow ? 0 : this.refRow,
            s = this.tbl.rows.length;
        return t && (e = 0), parseInt(s - e)
    },
    GetCellData: function(t, e) {
        return void 0 == t || null == e ? "" : this.customCellData && this.customCellDataCols.tf_Has(t) ? this.customCellData.call(null, this, e, t) : tf_GetNodeText(e)
    },
    GetTableData: function() {
        for (var t = this.tbl.rows, e = this.refRow; e < this.nbRows; e++) {
            var s;
            s = [e, []];
            for (var i = t[e].cells, l = 0; l < i.length; l++) {
                var a = this.GetCellData(l, i[l]);
                s[1].push(a)
            }
            this.tblData.push(s)
        }
        return this.tblData
    },
    GetFilteredData: function(t) {
        if (!this.validRowsIndex) return [];
        var e = this.tbl.rows,
            s = [];
        if (t) {
            for (var i = this.gridLayout ? this.headTbl : this.tbl, l = i.rows[this.headersRow], a = [l.rowIndex, []], n = 0; n < this.nbCells; n++) {
                var r = this.GetCellData(n, l.cells[n]);
                a[1].push(r)
            }
            s.push(a)
        }
        for (var o = this.GetValidRowsIndex(!0), h = 0; h < o.length; h++) {
            var a;
            a = [this.validRowsIndex[h],
                []
            ];
            for (var d = e[this.validRowsIndex[h]].cells, n = 0; n < d.length; n++) {
                var f = this.GetCellData(n, d[n]);
                a[1].push(f)
            }
            s.push(a)
        }
        return s
    },
    GetFilteredDataCol: function(t) {
        if (void 0 == t) return [];
        for (var e = this.GetFilteredData(), s = [], i = 0; i < e.length; i++) {
            var l = e[i],
                a = l[1],
                n = a[t];
            s.push(n)
        }
        return s
    },
    GetRowDisplay: function(t) {
        return this.fltGrid || tf_IsObj(t) ? t.style.display : void 0
    },
    SetRowValidation: function(t, e) {
        var s = this.tbl.rows[t];
        if (s && "boolean" == (typeof e).tf_LCase()) {
            this.hasVisibleRows && this.visibleRows.tf_Has(t) && !this.paging && (e = !0);
            var i = e ? "" : "none",
                l = e ? "true" : "false";
            s.style.display = i, this.paging && s.setAttribute("validRow", l)
        }
    },
    ValidateAllRows: function() {
        if (this.hasGrid) {
            this.validRowsIndex = [];
            for (var t = this.refRow; t < this.nbFilterableRows; t++) this.SetRowValidation(t, !0), this.validRowsIndex.push(t)
        }
    },
    SetFilterValue: function(t, e, s) {
        if ((this.fltGrid || this.isFirstLoad) && null != this.GetFilterElement(t)) {
            var i = this.GetFilterElement(t),
                l = void 0 == s ? !0 : s;
            if (e = void 0 == e ? "" : e, this["col" + t] != this.fltTypeMulti && this["col" + t] != this.fltTypeCheckList) i.value = e, this["col" + t] == this.fltTypeInp && "" != this.inpWatermark && tf_RemoveClass(i, this.inpWatermarkCssClass);
            else if (this["col" + t] == this.fltTypeMulti) {
                for (var a = e.split(" " + this.orOperator + " "), n = 0, r = 0; r < i.options.length; r++)
                    if ("" == a && (i.options[r].selected = !1), "" == i.options[r].value && (i.options[r].selected = !1), "" != i.options[r].value && a.tf_Has(i.options[r].value, !0))
                        if (tf_isIE) {
                            var o = n == a.length - 1 && l ? !0 : !1;
                            this.__deferMultipleSelection(i, r, o), n++
                        } else i.options[r].selected = !0
            } else if (this["col" + t] == this.fltTypeCheckList) {
                e = e.tf_MatchCase(this.matchCase);
                for (var a = e.split(" " + this.orOperator + " "), h = (i.setAttribute("value", ""), i.setAttribute("indexes", ""), 0); h < tf_Tag(i, "li").length; h++) {
                    var d = tf_Tag(i, "li")[h],
                        f = tf_Tag(d, "label")[0],
                        c = tf_Tag(d, "input")[0],
                        p = tf_GetNodeText(f).tf_MatchCase(this.matchCase);
                    "" != p && a.tf_Has(p, !0) ? (c.checked = !0, this.__setCheckListValues(c)) : (c.checked = !1, this.__setCheckListValues(c))
                }
            }
        }
    },
    SetColWidths: function(t) {
        function e(t) {
            if ((i || i.nbCells == i.colWidth.length) && i.nbCells == t.cells.length)
                for (var e = 0; e < i.nbCells; e++) t.cells[e].style.width = i.colWidth[e]
        }
        if (this.fltGrid && this.hasColWidth) {
            var s, i = this;
            s = void 0 == t ? "none" != this.tbl.rows[0].style.display ? 0 : 1 : t, e(this.tbl.rows[s])
        }
    },
    SetVisibleRows: function() {
        if (this.hasGrid && this.hasVisibleRows && !this.paging)
            for (var t = 0; t < this.visibleRows.length; t++) this.visibleRows[t] <= this.nbRows && this.SetRowValidation(this.visibleRows[t], !0)
    },
    ClearFilters: function() {
        this.EvtManager(this.Evt.name.clear)
    },
    _ClearFilters: function() {
        if (this.fltGrid) {
            this.onBeforeReset && this.onBeforeReset.call(null, this, this.GetFiltersValue());
            for (var t = 0; t < this.fltIds.length; t++) this.SetFilterValue(t, "");
            this.refreshFilters && (this.activeFilterId = "", this.RefreshFiltersGrid()), this.rememberPageLen && tf_RemoveCookie(this.pgLenCookie), this.rememberPageNb && tf_RemoveCookie(this.pgNbCookie), this.onAfterReset && this.onAfterReset.call(null, this)
        }
    },
    ClearActiveColumns: function() {
        for (var t = 0; t < this.fltIds.length; t++) tf_RemoveClass(this.GetHeaderElement(t), this.activeColumnsCssClass)
    },
    RefreshGrid: function(t) {
        var e = t ? t : this.fObj,
            s = this.sort;
        s && (this.sort = !1), this.nbRows = this.GetRowsNb(), this.RemoveGrid(), window["tf_" + this.id] = new TF(this.id, this.startRow, e), this.isFirstLoad = !0, this.fltIds = [], this._AddGrid(), s && (this.st.setTBody(this.tbl.tBodies[0]), this.sort = !0)
    },
    RefreshFiltersGrid: function() {
        var t = this.GetFiltersByType(this.fltTypeSlc, !0),
            e = this.GetFiltersByType(this.fltTypeMulti, !0),
            s = this.GetFiltersByType(this.fltTypeCheckList, !0),
            i = t.concat(e);
        if (i = i.concat(s), null != this.activeFilterId) {
            var l = this.activeFilterId.split("_")[0];
            l = l.split(this.prfxFlt)[1];
            for (var a, n = 0; n < i.length; n++) {
                var r = tf_Id(this.fltIds[i[n]]);
                if (a = this.GetFilterValue(i[n]), l != i[n] || this.paging && t.tf_Has(i[n]) && l == i[n] || !this.paging && (s.tf_Has(i[n]) || e.tf_Has(i[n])) || a == this.displayAllText) {
                    if (s.tf_Has(i[n]) ? this.checkListDiv[i[n]].innerHTML = "" : r.innerHTML = "", this.fillSlcOnDemand) {
                        var o = tf_CreateOpt(this.displayAllText, "");
                        r && r.appendChild(o)
                    }
                    s.tf_Has(i[n]) ? this._PopulateCheckList(i[n]) : this._PopulateSelect(i[n], !0), this.SetFilterValue(i[n], a)
                }
            }
        }
    },
    SetColOperation: function() {
        if (this.isFirstLoad || this.hasGrid) {
            this.onBeforeOperation && this.onBeforeOperation.call(null, this);
            var labelId = this.colOperation.id,
                colIndex = this.colOperation.col,
                operation = this.colOperation.operation,
                outputType = this.colOperation.write_method,
                totRowIndex = this.colOperation.tot_row_index,
                excludeRow = this.colOperation.exclude_row,
                decimalPrecision = void 0 != this.colOperation.decimal_precision ? this.colOperation.decimal_precision : 2,
                ucolIndex = [],
                ucolMax = 0;
            ucolIndex[ucolMax] = colIndex[0];
            for (var i = 1; i < colIndex.length; i++) {
                saved = 0;
                for (var j = 0; ucolMax >= j; j++) ucolIndex[j] == colIndex[i] && (saved = 1);
                0 == saved && (ucolMax++, ucolIndex[ucolMax] = colIndex[i])
            }
            if ("object" == (typeof labelId).tf_LCase() && "object" == (typeof colIndex).tf_LCase() && "object" == (typeof operation).tf_LCase())
                for (var row = this.tbl.rows, colvalues = [], ucol = 0; ucolMax >= ucol; ucol++) {
                    colvalues.push(this.GetColValues(ucolIndex[ucol], !0, excludeRow));
                    for (var result, nbvalues = 0, temp, meanValue = 0, sumValue = 0, minValue = null, maxValue = null, q1Value = null, medValue = null, q3Value = null, meanFlag = 0, sumFlag = 0, minFlag = 0, maxFlag = 0, q1Flag = 0, medFlag = 0, q3Flag = 0, theList = [], opsThisCol = [], decThisCol = [], labThisCol = [], oTypeThisCol = [], mThisCol = -1, i = 0; i < colIndex.length; i++)
                        if (colIndex[i] == ucolIndex[ucol]) switch (mThisCol++, opsThisCol[mThisCol] = operation[i].tf_LCase(), decThisCol[mThisCol] = decimalPrecision[i], labThisCol[mThisCol] = labelId[i], oTypeThisCol = void 0 != outputType && "object" == (typeof outputType).tf_LCase() ? outputType[i] : null, opsThisCol[mThisCol]) {
                            case "mean":
                                meanFlag = 1;
                                break;
                            case "sum":
                                sumFlag = 1;
                                break;
                            case "min":
                                minFlag = 1;
                                break;
                            case "max":
                                maxFlag = 1;
                                break;
                            case "median":
                                medFlag = 1;
                                break;
                            case "q1":
                                q1Flag = 1;
                                break;
                            case "q3":
                                q3Flag = 1
                        }
                    for (var j = 0; j < colvalues[ucol].length; j++) {
                        if ((1 == q1Flag || 1 == q3Flag || 1 == medFlag) && j < colvalues[ucol].length - 1)
                            for (k = j + 1; k < colvalues[ucol].length; k++) eval(colvalues[ucol][k]) < eval(colvalues[ucol][j]) && (temp = colvalues[ucol][j], colvalues[ucol][j] = colvalues[ucol][k], colvalues[ucol][k] = temp);
                        var cvalue = parseFloat(colvalues[ucol][j]);
                        theList[j] = parseFloat(cvalue), isNaN(cvalue) || (nbvalues++, (1 == sumFlag || 1 == meanFlag) && (sumValue += parseFloat(cvalue)), 1 == minFlag && (minValue = null == minValue ? parseFloat(cvalue) : parseFloat(cvalue) < minValue ? parseFloat(cvalue) : minValue), 1 == maxFlag && (maxValue = null == maxValue ? parseFloat(cvalue) : parseFloat(cvalue) > maxValue ? parseFloat(cvalue) : maxValue))
                    }
                    if (1 == meanFlag && (meanValue = sumValue / nbvalues), 1 == medFlag) {
                        var aux = 0;
                        nbvalues % 2 == 1 ? (aux = Math.floor(nbvalues / 2), medValue = theList[aux]) : medValue = (theList[nbvalues / 2] + theList[nbvalues / 2 - 1]) / 2
                    }
                    if (1 == q1Flag) {
                        var posa = 0;
                        posa = Math.floor(nbvalues / 4), q1Value = 4 * posa == nbvalues ? (theList[posa - 1] + theList[posa]) / 2 : theList[posa]
                    }
                    if (1 == q3Flag) {
                        var posa = 0,
                            posb = 0;
                        posa = Math.floor(nbvalues / 4), 4 * posa == nbvalues ? (posb = 3 * posa, q3Value = (theList[posb] + theList[posb - 1]) / 2) : q3Value = theList[nbvalues - posa - 1]
                    }
                    for (var i = 0; mThisCol >= i; i++) {
                        switch (opsThisCol[i]) {
                            case "mean":
                                result = meanValue;
                                break;
                            case "sum":
                                result = sumValue;
                                break;
                            case "min":
                                result = minValue;
                                break;
                            case "max":
                                result = maxValue;
                                break;
                            case "median":
                                result = medValue;
                                break;
                            case "q1":
                                result = q1Value;
                                break;
                            case "q3":
                                result = q3Value
                        }
                        var precision = void 0 == decThisCol[i] || isNaN(decThisCol[i]) ? 2 : decThisCol[i];
                        if (null != oTypeThisCol && result) {
                            if (result = result.toFixed(precision), void 0 != tf_Id(labThisCol[i])) switch (oTypeThisCol.tf_LCase()) {
                                case "innerhtml":
                                    tf_Id(labThisCol[i]).innerHTML = isNaN(result) || !isFinite(result) || 0 == nbvalues ? "." : result;
                                    break;
                                case "setvalue":
                                    tf_Id(labThisCol[i]).value = result;
                                    break;
                                case "createtextnode":
                                    var oldnode = tf_Id(labThisCol[i]).firstChild,
                                        txtnode = tf_CreateText(result);
                                    tf_Id(labThisCol[i]).replaceChild(txtnode, oldnode)
                            }
                        } else try {
                            tf_Id(labThisCol[i]).innerHTML = isNaN(result) || !isFinite(result) || 0 == nbvalues ? "." : result.toFixed(precision)
                        } catch (e) {}
                    }
                    void 0 != totRowIndex && row[totRowIndex[ucol]] && (row[totRowIndex[ucol]].style.display = "")
                }
            this.onAfterOperation && this.onAfterOperation.call(null, this)
        }
    },
    UnhighlightAll: function() {
        if (this.highlightKeywords && null != this.searchArgs) {
            for (var t = 0; t < this.searchArgs.length; t++) tf_UnhighlightWord(this, this.searchArgs[t], this.highlightCssClass);
            this.highlightedNodes = []
        }
    },
    __resetGrid: function() {
        function t(t) {
            t.tbl.deleteRow(t.filtersRowIndex), t.RemoveGrid(), t.fltIds = [], t.isFirstLoad = !0, t.popUpFilters && t.RemovePopupFilters(), t._AddGrid()
        }
        if (!this.isFirstLoad) {
            if (this.gridLayout || this.tbl.rows[this.filtersRowIndex].parentNode.insertBefore(this.fltGridEl, this.tbl.rows[this.filtersRowIndex]), this.isExternalFlt)
                for (var e = 0; e < this.externalFltTgtIds.length; e++) tf_Id(this.externalFltTgtIds[e]) && (tf_Id(this.externalFltTgtIds[e]).appendChild(this.externalFltEls[e]), this.gridLayout && "" == this.externalFltEls[e].innerHTML && this["col" + e] != this.fltTypeInp && ((this["col" + e] == this.fltTypeSlc || this["col" + e] == this.fltTypeMulti) && this.PopulateSelect(e), this["col" + e] == this.fltTypeCheckList && this.PopulateCheckList(e)));
            this.nbFilterableRows = this.GetRowsNb(), this.nbVisibleRows = this.nbFilterableRows, this.nbRows = this.tbl.rows.length, this.isSortEnabled && (this.sort = !0), "" == this.tbl.rows[this.filtersRowIndex].innerHTML ? t(this) : this.popUpFilters && (this.headersRow++, this.SetPopupFilters()), this.gridLayout || tf_AddClass(this.tbl, this.prfxTf), this.hasGrid = !0
        }
    },
    __containsStr: function(t, e, s, i) {
        var l, a = this.matchCase ? "g" : "gi",
            n = void 0 == i ? this.exactMatch : i;
        return l = n || s != this.fltTypeInp && void 0 != s ? new RegExp("(^\\s*)" + tf_RegexpEscape(t) + "(\\s*$)", a) : new RegExp(tf_RegexpEscape(t), a), l.test(e)
    },
    IncludeFile: function(t, e, s, i) {
        var l = void 0 == i ? "script" : i,
            a = tf_IsImported(e, l);
        if (!a) {
            var n, r = this,
                o = !1,
                h = tf_Tag(document, "head")[0];
            n = "link" == l.tf_LCase() ? tf_CreateElm("link", ["id", t], ["type", "text/css"], ["rel", "stylesheet"], ["href", e]) : tf_CreateElm("script", ["id", t], ["type", "text/javascript"], ["src", e]), n.onload = n.onreadystatechange = function() {
                o || this.readyState && "loaded" != this.readyState && "complete" != this.readyState || (o = !0, "function" == typeof s && s.call(null, r))
            }, n.onerror = function() {
                throw new Error("TF script could not load:\n" + this.src)
            }, h.appendChild(n)
        }
    },
    HasGrid: function() {
        return this.hasGrid
    },
    GetFiltersId: function() {
        return this.hasGrid ? this.fltIds : void 0
    },
    GetValidRowsIndex: function(t) {
        if (this.hasGrid) {
            if (!t) return this.validRowsIndex;
            this.validRowsIndex = [];
            for (var e = this.refRow; e < this.GetRowsNb(!0); e++) {
                var s = this.tbl.rows[e];
                this.paging ? ("true" == s.getAttribute("validRow") || null == s.getAttribute("validRow")) && this.validRowsIndex.push(s.rowIndex) : "none" != this.GetRowDisplay(s) && this.validRowsIndex.push(s.rowIndex)
            }
            return this.validRowsIndex
        }
    },
    GetFiltersRowIndex: function() {
        return this.hasGrid ? this.filtersRowIndex : void 0
    },
    GetHeadersRowIndex: function() {
        return this.hasGrid ? this.headersRow : void 0
    },
    GetStartRowIndex: function() {
        return this.hasGrid ? this.refRow : void 0
    },
    GetLastRowIndex: function() {
        return this.hasGrid ? this.nbRows - 1 : void 0
    },
    GetHeaderElement: function(t) {
        for (var e, s = this.gridLayout ? this.headTbl : this.tbl, i = tf_Tag(this.tbl, "thead"), l = 0; l < this.nbCells; l++)
            if (l == t) {
                0 == i.length && (e = s.rows[this.headersRow].cells[l]), 1 == i.length && (e = i[0].rows[this.headersRow].cells[l]);
                break
            }
        return e
    },
    GetConfigObject: function() {
        return this.fObj
    },
    GetFilterableRowsNb: function() {
        return this.GetRowsNb(!1)
    }
}, String.prototype.tf_MatchCase = function(t) {
    return t ? this.toString() : this.tf_LCase()
}, String.prototype.tf_Trim = function() {
    return this.replace(/(^[\s\xA0]*)|([\s\xA0]*$)/g, "")
}, String.prototype.tf_LCase = function() {
    return this.toLowerCase()
}, String.prototype.tf_UCase = function() {
    return this.toUpperCase()
}, Array.prototype.tf_Has = function(t, e) {
    var s = void 0 == e ? !1 : e;
    for (i = 0; i < this.length; i++)
        if (this[i].toString().tf_MatchCase(s) == t) return !0;
    return !1
}, Array.prototype.tf_IndexByValue = function(t, e) {
    var s = void 0 == e ? !1 : e;
    for (i = 0; i < this.length; i++)
        if (this[i].toString().tf_MatchCase(s) == t) return i;
    return -1
}, window.tf_isIE = window.innerHeight ? !1 : /msie|MSIE 6/.test(navigator.userAgent) ? !0 : !1, window.tf_isIE7 = window.innerHeight ? !1 : /msie|MSIE 7/.test(navigator.userAgent) ? !0 : !1, window.tf_isNotIE = !/msie|MSIE/.test(navigator.userAgent), tf_AddEvent(window, tf_isNotIE || "function" == typeof window.addEventListener ? "DOMContentLoaded" : "load", initFilterGrid);