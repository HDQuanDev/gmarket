<?php include("../../config.php");
if (!$isSeller) header("Location: /users/login"); ?>

<!doctype html>
<html lang="en">

<head>
    <meta name="csrf-token" content="jeVFiapLZrmTexe2gwykiL1aVi2OH3FnaNVdk7e4">
    <meta name="app-url" content="//gmarketagents.com/">
    <meta name="file-base-url" content="//gmarketagents.com/public/">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon -->
    <link rel="icon" href="/public/uploads/all/gTpdv1822yoHhDKtwGLenMSNg19P86n99DzgA91a.jpg">
    <title>Gmarket Viet Nam | Buy Korean domestic products at original prices from the manufacturer</title>

    <!-- google font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">

    <!-- aiz core css -->
    <link rel="stylesheet" href="/public/assets/css/vendors.css">
    <link rel="stylesheet" href="/public/assets/css/aiz-seller.css">

    <style>
        body {
            font-size: 12px;
        }

        #map {
            width: 100%;
            height: 250px;
        }

        #edit_map {
            width: 100%;
            height: 250px;
        }

        .pac-container {
            z-index: 100000;
        }
    </style>
    <script>
        var AIZ = AIZ || {};
        AIZ.local = {
            nothing_selected: 'Nothing selected',
            nothing_found: 'Nothing found',
            choose_file: 'Choose File',
            file_selected: 'File selected',
            files_selected: 'Files selected',
            add_more_files: 'Add more files',
            adding_more_files: 'Adding more files',
            drop_files_here_paste_or: 'Drop files here, paste or',
            browse: 'Browse',
            upload_complete: 'Upload complete',
            upload_paused: 'Upload paused',
            resume_upload: 'Resume upload',
            pause_upload: 'Pause upload',
            retry_upload: 'Retry upload',
            cancel_upload: 'Cancel upload',
            uploading: 'Uploading',
            processing: 'Processing',
            complete: 'Complete',
            file: 'File',
            files: 'Files',
        }
    </script>

</head>

<body class="">

    <div class="aiz-main-wrapper">
        <?php include("../layout/sidebar.php")?>
        <div class="aiz-content-wrapper">
            <?php include("../layout/topbar.php")?>

            <div class="aiz-main-content">
                <div class="px-15px px-lg-25px">
                    <div class="aiz-titlebar text-left mt-2 mb-3">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h1 class="h3">Upload New File</h1>
                            </div>
                            <div class="col-md-6 text-md-right">
                                <a href="/seller/uploads" class="btn btn-link text-reset">
                                    <i class="las la-angle-left"></i>
                                    <span>Back to uploaded files</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">Drag &amp; drop your files</h5>
                        </div>
                        <div class="card-body">
                            <div id="aiz-upload-files" class="h-420px" style="min-height: 65vh">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white text-center py-3 px-15px px-lg-25px mt-auto border-sm-top">
                    <p class="mb-0">&copy; Gmarket Viet Nam v7.4.0</p>
                </div>
            </div><!-- .aiz-main-content -->
        </div><!-- .aiz-content-wrapper -->
    </div><!-- .aiz-main-wrapper -->



    <script src="/public/assets/js/vendors.js"></script>
    <script src="/public/assets/js/aiz-core.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            AIZ.plugins.aizUppy();
        });
    </script>

    <script type="text/javascript">
        if ($('#lang-change').length > 0) {
            $('#lang-change .dropdown-menu a').each(function() {
                $(this).on('click', function(e) {
                    e.preventDefault();
                    var $this = $(this);
                    var locale = $this.data('flag');
                    $.post('/language', {
                        _token: 'jeVFiapLZrmTexe2gwykiL1aVi2OH3FnaNVdk7e4',
                        locale: locale
                    }, function(data) {
                        location.reload();
                    });

                });
            });
        }

        function menuSearch() {
            var filter, item;
            filter = $("#menu-search").val().toUpperCase();
            items = $("#main-menu").find("a");
            items = items.filter(function(i, item) {
                if ($(item).find(".aiz-side-nav-text")[0].innerText.toUpperCase().indexOf(filter) > -1 && $(item).attr('href') !== '#') {
                    return item;
                }
            });

            if (filter !== '') {
                $("#main-menu").addClass('d-none');
                $("#search-menu").html('')
                if (items.length > 0) {
                    for (i = 0; i < items.length; i++) {
                        const text = $(items[i]).find(".aiz-side-nav-text")[0].innerText;
                        const link = $(items[i]).attr('href');
                        $("#search-menu").append(`<li class="aiz-side-nav-item"><a href="${link}" class="aiz-side-nav-link"><i class="las la-ellipsis-h aiz-side-nav-icon"></i><span>${text}</span></a></li`);
                    }
                } else {
                    $("#search-menu").html(`<li class="aiz-side-nav-item"><span	class="text-center text-muted d-block">Nothing found</span></li>`);
                }
            } else {
                $("#main-menu").removeClass('d-none');
                $("#search-menu").html('')
            }
        }
    </script>
    <script>
        var $jscomp = $jscomp || {};
        $jscomp.scope = {};
        $jscomp.arrayIteratorImpl = function(b) {
            var d = 0;
            return function() {
                return d < b.length ? {
                    done: !1,
                    value: b[d++]
                } : {
                    done: !0
                }
            }
        };
        $jscomp.arrayIterator = function(b) {
            return {
                next: $jscomp.arrayIteratorImpl(b)
            }
        };
        $jscomp.ASSUME_ES5 = !1;
        $jscomp.ASSUME_NO_NATIVE_MAP = !1;
        $jscomp.ASSUME_NO_NATIVE_SET = !1;
        $jscomp.SIMPLE_FROUND_POLYFILL = !1;
        $jscomp.defineProperty = $jscomp.ASSUME_ES5 || "function" == typeof Object.defineProperties ? Object.defineProperty : function(b, d, a) {
            b != Array.prototype && b != Object.prototype && (b[d] = a.value)
        };
        $jscomp.getGlobal = function(b) {
            return "undefined" != typeof window && window === b ? b : "undefined" != typeof global && null != global ? global : b
        };
        $jscomp.global = $jscomp.getGlobal(this);
        $jscomp.SYMBOL_PREFIX = "jscomp_symbol_";
        $jscomp.initSymbol = function() {
            $jscomp.initSymbol = function() {};
            $jscomp.global.Symbol || ($jscomp.global.Symbol = $jscomp.Symbol)
        };
        $jscomp.Symbol = function() {
            var b = 0;
            return function(d) {
                return $jscomp.SYMBOL_PREFIX + (d || "") + b++
            }
        }();
        $jscomp.initSymbolIterator = function() {
            $jscomp.initSymbol();
            var b = $jscomp.global.Symbol.iterator;
            b || (b = $jscomp.global.Symbol.iterator = $jscomp.global.Symbol("iterator"));
            "function" != typeof Array.prototype[b] && $jscomp.defineProperty(Array.prototype, b, {
                configurable: !0,
                writable: !0,
                value: function() {
                    return $jscomp.iteratorPrototype($jscomp.arrayIteratorImpl(this))
                }
            });
            $jscomp.initSymbolIterator = function() {}
        };
        $jscomp.initSymbolAsyncIterator = function() {
            $jscomp.initSymbol();
            var b = $jscomp.global.Symbol.asyncIterator;
            b || (b = $jscomp.global.Symbol.asyncIterator = $jscomp.global.Symbol("asyncIterator"));
            $jscomp.initSymbolAsyncIterator = function() {}
        };
        $jscomp.iteratorPrototype = function(b) {
            $jscomp.initSymbolIterator();
            b = {
                next: b
            };
            b[$jscomp.global.Symbol.iterator] = function() {
                return this
            };
            return b
        };
        $jscomp.iteratorFromArray = function(b, d) {
            $jscomp.initSymbolIterator();
            b instanceof String && (b += "");
            var a = 0,
                c = {
                    next: function() {
                        if (a < b.length) {
                            var e = a++;
                            return {
                                value: d(e, b[e]),
                                done: !1
                            }
                        }
                        c.next = function() {
                            return {
                                done: !0,
                                value: void 0
                            }
                        };
                        return c.next()
                    }
                };
            c[Symbol.iterator] = function() {
                return c
            };
            return c
        };
        $jscomp.polyfill = function(b, d, a, c) {
            if (d) {
                a = $jscomp.global;
                b = b.split(".");
                for (c = 0; c < b.length - 1; c++) {
                    var e = b[c];
                    e in a || (a[e] = {});
                    a = a[e]
                }
                b = b[b.length - 1];
                c = a[b];
                d = d(c);
                d != c && null != d && $jscomp.defineProperty(a, b, {
                    configurable: !0,
                    writable: !0,
                    value: d
                })
            }
        };
        $jscomp.polyfill("Array.prototype.values", function(b) {
            return b ? b : function() {
                return $jscomp.iteratorFromArray(this, function(b, a) {
                    return a
                })
            }
        }, "es8", "es3");
        $jscomp.findInternal = function(b, d, a) {
            b instanceof String && (b = String(b));
            for (var c = b.length, e = 0; e < c; e++) {
                var l = b[e];
                if (d.call(a, l, e, b)) return {
                    i: e,
                    v: l
                }
            }
            return {
                i: -1,
                v: void 0
            }
        };
        $jscomp.polyfill("Array.prototype.find", function(b) {
            return b ? b : function(b, a) {
                return $jscomp.findInternal(this, b, a).v
            }
        }, "es6", "es3");
        (function(b) {
            function d(a, c) {
                this._initialized = !1;
                this.settings = null;
                this.popups = [];
                this.options = b.extend({}, d.Defaults, c);
                this.$element = b(a);
                this.init();
                this.y = this.x = 0;
                this._interval;
                this._callbackOpened = this._popupOpened = this._menuOpened = !1;
                this.countdown = null
            }
            d.Defaults = {
                activated: !1,
                pluginVersion: "2.0.1",
                wordpressPluginVersion: !1,
                align: "right",
                mode: "regular",
                countdown: 0,
                drag: !1,
                buttonText: "Contact us",
                buttonSize: "large",
                menuSize: "normal",
                buttonIcon: '<svg width="20" height="20" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g transform="translate(-825 -308)"><g><path transform="translate(825 308)" fill="#FFFFFF" d="M 19 4L 17 4L 17 13L 4 13L 4 15C 4 15.55 4.45 16 5 16L 16 16L 20 20L 20 5C 20 4.45 19.55 4 19 4ZM 15 10L 15 1C 15 0.45 14.55 0 14 0L 1 0C 0.45 0 0 0.45 0 1L 0 15L 4 11L 14 11C 14.55 11 15 10.55 15 10Z"/></g></g></svg>',
                ajaxUrl: "server.php",
                action: "callback",
                phonePlaceholder: "+X-XXX-XXX-XX-XX",
                callbackSubmitText: "Waiting for call",
                reCaptcha: !1,
                reCaptchaAction: "callbackRequest",
                reCaptchaKey: "",
                errorMessage: "Connection error. Please try again.",
                callProcessText: "We are calling you to phone",
                callSuccessText: "Thank you.<br>We are call you back soon.",
                showMenuHeader: !1,
                menuHeaderText: "How would you like to contact us?",
                showHeaderCloseBtn: !0,
                menuInAnimationClass: "show-messageners-block",
                menuOutAnimationClass: "",
                eaderCloseBtnBgColor: "#787878",
                eaderCloseBtnColor: "#FFFFFF",
                items: [],
                itemsIconType: "rounded",
                iconsAnimationSpeed: 800,
                iconsAnimationPause: 2E3,
                promptPosition: "side",
                callbackFormFields: {
                    name: {
                        name: "name",
                        enabled: !0,
                        required: !0,
                        type: "text",
                        label: "Please enter your name",
                        placeholder: "Your full name"
                    },
                    email: {
                        name: "email",
                        enabled: !0,
                        required: !1,
                        type: "email",
                        label: "Enter your email address",
                        placeholder: "Optional field. Example: email@domain.com"
                    },
                    time: {
                        name: "time",
                        enabled: !0,
                        required: !1,
                        type: "dropdown",
                        label: "Please choose schedule time",
                        values: [{
                            value: "asap",
                            label: "Call me ASAP"
                        }, "00:00", "01:00", "02:00", "03:00", "04:00", "05:00", "06:00", "07:00", "08:00", "09:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00", "17:00", "18:00", "19:00", "20:00", "21:00", "22:00", "23:00"]
                    },
                    phone: {
                        name: "phone",
                        enabled: !0,
                        required: !0,
                        type: "tel",
                        label: "Please enter your phone number",
                        placeholder: "+X-XXX-XXX-XX-XX"
                    },
                    description: {
                        name: "description",
                        enabled: !0,
                        required: !1,
                        type: "textarea",
                        label: "Please leave a message with your request"
                    }
                },
                theme: "#000000",
                callbackFormText: "Please enter your phone number<br>and we call you back soon",
                closeIcon: '<svg width="12" height="13" viewBox="0 0 14 14" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g transform="translate(-4087 108)"><g><path transform="translate(4087 -108)" fill="currentColor" d="M 14 1.41L 12.59 0L 7 5.59L 1.41 0L 0 1.41L 5.59 7L 0 12.59L 1.41 14L 7 8.41L 12.59 14L 14 12.59L 8.41 7L 14 1.41Z"></path></g></g></svg>',
                callbackStateIcon: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M493.4 24.6l-104-24c-11.3-2.6-22.9 3.3-27.5 13.9l-48 112c-4.2 9.8-1.4 21.3 6.9 28l60.6 49.6c-36 76.7-98.9 140.5-177.2 177.2l-49.6-60.6c-6.8-8.3-18.2-11.1-28-6.9l-112 48C3.9 366.5-2 378.1.6 389.4l24 104C27.1 504.2 36.7 512 48 512c256.1 0 464-207.5 464-464 0-11.2-7.7-20.9-18.6-23.4z"></path></svg>'
            };
            d.prototype.init = function() {
                if (this._initialized) return !1;
                this.destroy();
                this.settings = b.extend({}, this.options);
                this.$element.addClass("arcontactus-widget").addClass("arcontactus-message");
                "left" === this.settings.align ? this.$element.addClass("left") : this.$element.addClass("right");
                this.settings.items.length ? (this.$element.append("\x3c!--noindex--\x3e"), this._initCallbackBlock(), "regular" == this.settings.mode && this._initMessengersBlock(), this.popups.length && this._initPopups(), this._initMessageButton(),
                    this._initPrompt(), this._initEvents(), this.startAnimation(), this.$element.append("\x3c!--/noindex--\x3e"), this.$element.addClass("active")) : console.info("jquery.contactus:no items");
                this._initialized = !0;
                this.$element.trigger("arcontactus.init")
            };
            d.prototype.destroy = function() {
                if (!this._initialized) return !1;
                this.$element.html("");
                this._initialized = !1;
                this.$element.trigger("arcontactus.destroy")
            };
            d.prototype._initCallbackBlock = function() {
                var a = b("<div>", {
                        class: "callback-countdown-block",
                        style: this._colorStyle()
                    }),
                    c = b("<div>", {
                        class: "callback-countdown-block-close",
                        style: "background-color:" + this.settings.theme + "; color: #FFFFFF"
                    });
                c.append(this.settings.closeIcon);
                var e = b("<div>", {
                    class: "callback-countdown-block-phone"
                });
                e.append("<p>" + this.settings.callbackFormText + "</p>");
                var d = b("<form>", {
                        id: "arcu-callback-form",
                        action: this.settings.ajaxUrl,
                        method: "POST"
                    }),
                    h = b("<div>", {
                        class: "callback-countdown-block-form-group"
                    }),
                    f = b("<input>", {
                        name: "action",
                        type: "hidden",
                        value: this.settings.action
                    }),
                    g = b("<input>", {
                        name: "gtoken",
                        class: "ar-g-token",
                        type: "hidden",
                        value: ""
                    });
                h.append(f);
                h.append(g);
                this._initCallbackFormFields(h);
                f = b("<div>", {
                    class: "arcu-form-group arcu-form-button"
                });
                g = b("<button>", {
                    id: "arcontactus-message-callback-phone-submit",
                    type: "submit",
                    style: this._backgroundStyle()
                });
                g.text(this.settings.callbackSubmitText);
                f.append(g);
                h.append(f);
                f = b("<div>", {
                    class: "callback-countdown-block-timer"
                });
                g = b("<p>" + this.settings.callProcessText + "</p>");
                var k = b("<div>", {
                    class: "callback-countdown-block-timer_timer"
                });
                f.append(g);
                f.append(k);
                g = b("<div>", {
                    class: "callback-countdown-block-sorry"
                });
                k = b("<p>" + this.settings.callSuccessText + "</p>");
                g.append(k);
                d.append(h);
                e.append(d);
                a.append(c);
                a.append(e);
                a.append(f);
                a.append(g);
                this.$element.append(a)
            };
            d.prototype._initCallbackFormFields = function(a) {
                var c = this;
                b.each(c.settings.callbackFormFields, function(e) {
                    var d = b("<div>", {
                            class: "arcu-form-group arcu-form-group-type-" + c.settings.callbackFormFields[e].type + " arcu-form-group-" + c.settings.callbackFormFields[e].name + (c.settings.callbackFormFields[e].required ?
                                " arcu-form-group-required" : "")
                        }),
                        h = "<input>";
                    switch (c.settings.callbackFormFields[e].type) {
                        case "textarea":
                            h = "<textarea>";
                            break;
                        case "dropdown":
                            h = "<select>"
                    }
                    if (c.settings.callbackFormFields[e].label) {
                        var f = b("<div>", {
                            class: "arcu-form-label"
                        });
                        f.html(c.settings.callbackFormFields[e].label);
                        d.append(f)
                    }
                    var g = b(h, {
                        name: c.settings.callbackFormFields[e].name,
                        class: "arcu-form-field arcu-field-" + c.settings.callbackFormFields[e].name,
                        required: c.settings.callbackFormFields[e].required,
                        type: "dropdown" == c.settings.callbackFormFields[e].type ?
                            null : c.settings.callbackFormFields[e].type,
                        value: ""
                    });
                    g.attr("placeholder", c.settings.callbackFormFields[e].placeholder);
                    "undefined" != typeof c.settings.callbackFormFields[e].maxlength && g.attr("maxlength", c.settings.callbackFormFields[e].maxlength);
                    "dropdown" == c.settings.callbackFormFields[e].type && b.each(c.settings.callbackFormFields[e].values, function(a) {
                        var d = c.settings.callbackFormFields[e].values[a],
                            l = c.settings.callbackFormFields[e].values[a];
                        "object" == typeof c.settings.callbackFormFields[e].values[a] &&
                            (d = c.settings.callbackFormFields[e].values[a].value, l = c.settings.callbackFormFields[e].values[a].label);
                        a = b("<option>", {
                            value: d
                        });
                        a.text(l);
                        g.append(a)
                    });
                    d.append(g);
                    a.append(d)
                })
            };
            d.prototype._initPopups = function() {
                var a = this,
                    c = b("<div>", {
                        class: "popups-block arcuAnimated"
                    }),
                    e = b("<div>", {
                        class: "popups-list-container"
                    });
                b.each(this.popups, function() {
                    var c = b("<div>", {
                            class: "arcu-popup",
                            id: "arcu-popup-" + this.id
                        }),
                        d = b("<div>", {
                            class: "arcu-popup-header",
                            style: a.settings.theme ? "background-color:" + a.settings.theme : null
                        }),
                        f = b("<div>", {
                            class: "arcu-popup-close",
                            style: a.settings.theme ? "background-color:" + a.settings.theme : null
                        }),
                        g = b("<div>", {
                            class: "arcu-popup-back",
                            style: a.settings.theme ? "background-color:" + a.settings.theme : null
                        });
                    f.append(a.settings.closeIcon);
                    g.append('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path fill="currentColor" d="M231.293 473.899l19.799-19.799c4.686-4.686 4.686-12.284 0-16.971L70.393 256 251.092 74.87c4.686-4.686 4.686-12.284 0-16.971L231.293 38.1c-4.686-4.686-12.284-4.686-16.971 0L4.908 247.515c-4.686 4.686-4.686 12.284 0 16.971L214.322 473.9c4.687 4.686 12.285 4.686 16.971-.001z" class=""></path></svg>');
                    d.text(this.title);
                    d.append(f);
                    d.append(g);
                    f = b("<div>", {
                        class: "arcu-popup-content"
                    });
                    f.html(this.popupContent);
                    c.append(d);
                    c.append(f);
                    e.append(c)
                });
                c.append(e);
                this.$element.append(c)
            };
            d.prototype._initMessengersBlock = function() {
                var a = b("<div>", {
                        class: "messangers-block arcuAnimated"
                    }),
                    c = b("<div>", {
                        class: "messangers-list-container"
                    }),
                    e = b("<ul>", {
                        class: "messangers-list"
                    });
                "normal" !== this.settings.menuSize && "large" !== this.settings.menuSize || a.addClass("lg");
                "small" === this.settings.menuSize && a.addClass("sm");
                this._appendMessengerIcons(e);
                if (this.settings.showMenuHeader) {
                    var d = b("<div>", {
                        class: "arcu-menu-header",
                        style: this.settings.theme ? "background-color:" + this.settings.theme : null
                    });
                    d.html(this.settings.menuHeaderText);
                    if (this.settings.showHeaderCloseBtn) {
                        var h = b("<div>", {
                            class: "arcu-header-close",
                            style: "color:" + this.settings.headerCloseBtnColor + "; background:" + this.settings.headerCloseBtnBgColor
                        });
                        h.append(this.settings.closeIcon);
                        d.append(h)
                    }
                    a.append(d);
                    a.addClass("has-header")
                }
                "rounded" == this.settings.itemsIconType ?
                    e.addClass("rounded-items") : e.addClass("not-rounded-items");
                c.append(e);
                a.append(c);
                this.$element.append(a)
            };
            d.prototype._appendMessengerIcons = function(a) {
                var c = this;
                b.each(this.settings.items, function(e) {
                    e = b("<li>", {});
                    if ("callback" == this.href) var d = b("<div>", {
                        class: "messanger call-back " + (this.class ? this.class : "")
                    });
                    else if ("_popup" == this.href) c.popups.push(this), d = b("<div>", {
                        class: "messanger arcu-popup-link " + (this.class ? this.class : ""),
                        "data-id": this.id ? this.id : null
                    });
                    else if (d = b("<a>", {
                            class: "messanger " +
                                (this.class ? this.class : ""),
                            id: this.id ? this.id : null,
                            href: this.href
                        }), this.onClick) {
                        var h = this;
                        d.on("click", function(a) {
                            h.onClick(a)
                        })
                    }
                    var f = "rounded" == c.settings.itemsIconType ? b("<span>", {
                        style: this.color ? "background-color:" + this.color : null
                    }) : b("<span>", {
                        style: (this.color ? "color:" + this.color : null) + "; background-color: transparent"
                    });
                    f.append(this.icon);
                    d.append(f);
                    f = b("<div>", {
                        class: "arcu-item-label"
                    });
                    var g = b("<div>", {
                        class: "arcu-item-title"
                    });
                    g.text(this.title);
                    f.append(g);
                    "undefined" != typeof this.subTitle && this.subTitle && (g = b("<div>", {
                        class: "arcu-item-subtitle"
                    }), g.text(this.subTitle), f.append(g));
                    d.append(f);
                    e.append(d);
                    a.append(e)
                })
            };
            d.prototype._initMessageButton = function() {
                var a = this,
                    c = b("<div>", {
                        class: "arcontactus-message-button",
                        style: this._backgroundStyle()
                    });
                "large" === this.settings.buttonSize && this.$element.addClass("lg");
                "huge" === this.settings.buttonSize && this.$element.addClass("hg");
                "medium" === this.settings.buttonSize && this.$element.addClass("md");
                "small" === this.settings.buttonSize && this.$element.addClass("sm");
                var e = b("<div>", {
                    class: "static"
                });
                e.append(this.settings.buttonIcon);
                !1 !== this.settings.buttonText ? e.append("<p>" + this.settings.buttonText + "</p>") : c.addClass("no-text");
                var d = b("<div>", {
                    class: "callback-state",
                    style: a._colorStyle()
                });
                d.append(this.settings.callbackStateIcon);
                var h = b("<div>", {
                        class: "icons hide"
                    }),
                    f = b("<div>", {
                        class: "icons-line"
                    });
                b.each(this.settings.items, function(c) {
                    c = b("<span>", {
                        style: a._colorStyle()
                    });
                    c.append(this.icon);
                    f.append(c)
                });
                h.append(f);
                var g = b("<div>", {
                    class: "arcontactus-close"
                });
                g.append(this.settings.closeIcon);
                var k = b("<div>", {
                        class: "pulsation",
                        style: a._backgroundStyle()
                    }),
                    m = b("<div>", {
                        class: "pulsation",
                        style: a._backgroundStyle()
                    });
                c.append(e).append(d).append(h).append(g).append(k).append(m);
                this.$element.append(c)
            };
            d.prototype._initPrompt = function() {
                var a = b("<div>", {
                        class: "arcontactus-prompt arcu-prompt-" + this.settings.promptPosition
                    }),
                    c = b("<div>", {
                        class: "arcontactus-prompt-close",
                        style: this._backgroundStyle() +
                            "; color: #FFFFFF"
                    });
                c.append(this.settings.closeIcon);
                var e = b("<div>", {
                    class: "arcontactus-prompt-inner"
                });
                a.append(c).append(e);
                this.$element.append(a)
            };
            d.prototype._initEvents = function() {
                var a = this.$element,
                    c = this;
                a.find(".arcontactus-message-button").on("mousedown", function(a) {
                    c.x = a.pageX;
                    c.y = a.pageY
                }).on("mouseup", function(a) {
                    if (c.settings.drag && a.pageX === c.x && a.pageY === c.y || !c.settings.drag) "regular" == c.settings.mode ? c._menuOpened || c._popupOpened || c._callbackOpened ? (c._menuOpened && c.closeMenu(),
                        c._popupOpened && c.closePopup()) : c.openMenu() : c.openCallbackPopup(), a.preventDefault()
                });
                this.settings.drag && (a.draggable(), a.get(0).addEventListener("touchmove", function(c) {
                    var b = c.targetTouches[0];
                    a.get(0).style.left = b.pageX - 25 + "px";
                    a.get(0).style.top = b.pageY - 25 + "px";
                    c.preventDefault()
                }, !1));
                b(document).on("click", function(a) {
                    c.closeMenu();
                    c.closePopup()
                });
                a.on("click", function(a) {
                    a.stopPropagation()
                });
                a.find(".call-back").on("click", function() {
                    c.openCallbackPopup()
                });
                a.find(".arcu-popup-link").on("click",
                    function() {
                        var a = b(this).data("id");
                        c.openPopup(a)
                    });
                a.find(".arcu-header-close").on("click", function() {
                    c.closeMenu()
                });
                a.find(".arcu-popup-close").on("click", function() {
                    c.closePopup()
                });
                a.find(".arcu-popup-back").on("click", function() {
                    c.closePopup();
                    c.openMenu()
                });
                a.find(".callback-countdown-block-close").on("click", function() {
                    null != c.countdown && (clearInterval(c.countdown), c.countdown = null);
                    c.closeCallbackPopup()
                });
                a.find(".arcontactus-prompt-close").on("click", function() {
                    c.hidePrompt()
                });
                a.find("#arcu-callback-form").on("submit",
                    function(b) {
                        b.preventDefault();
                        a.find(".callback-countdown-block-phone").addClass("ar-loading");
                        c.settings.reCaptcha ? grecaptcha.execute(c.settings.reCaptchaKey, {
                            action: c.settings.reCaptchaAction
                        }).then(function(b) {
                            a.find(".ar-g-token").val(b);
                            c.sendCallbackRequest()
                        }) : c.sendCallbackRequest()
                    });
                setTimeout(function() {
                    c._processHash()
                }, 500);
                b(window).on("hashchange", function(a) {
                    c._processHash()
                })
            };
            d.prototype._processHash = function() {
                switch (window.location.hash) {
                    case "#callback-form":
                    case "callback-form":
                        this.openCallbackPopup();
                        break;
                    case "#callback-form-close":
                    case "callback-form-close":
                        this.closeCallbackPopup();
                        break;
                    case "#contactus-menu":
                    case "contactus-menu":
                        this.openMenu();
                        break;
                    case "#contactus-menu-close":
                    case "contactus-menu-close":
                        this.closeMenu();
                        break;
                    case "#contactus-hide":
                    case "contactus-hide":
                        this.hide();
                        break;
                    case "#contactus-show":
                    case "contactus-show":
                        this.show()
                }
            };
            d.prototype._callBackCountDownMethod = function() {
                var a = this.settings.countdown,
                    c = this.$element,
                    b = this,
                    d = 60;
                c.find(".callback-countdown-block-phone, .callback-countdown-block-timer").toggleClass("display-flex");
                this.countdown = setInterval(function() {
                    --d;
                    var e = a,
                        f = d;
                    10 > a && (e = "0" + a);
                    10 > d && (f = "0" + d);
                    e = e + ":" + f;
                    c.find(".callback-countdown-block-timer_timer").html(e);
                    0 === d && 0 === a && (clearInterval(b.countdown), b.countdown = null, c.find(".callback-countdown-block-sorry, .callback-countdown-block-timer").toggleClass("display-flex"));
                    0 === d && (d = 60, --a)
                }, 20)
            };
            d.prototype.sendCallbackRequest = function() {
                var a = this,
                    c = a.$element;
                this.$element.trigger("arcontactus.beforeSendCallbackRequest");
                b.ajax({
                    url: a.settings.ajaxUrl,
                    type: "POST",
                    dataType: "json",
                    data: c.find("form").serialize(),
                    success: function(b) {
                        a.settings.countdown && a._callBackCountDownMethod();
                        c.find(".callback-countdown-block-phone").removeClass("ar-loading");
                        if (b.success) a.settings.countdown || c.find(".callback-countdown-block-sorry, .callback-countdown-block-phone").toggleClass("display-flex");
                        else if (b.errors) {
                            var d = b.errors.join("\n\r");
                            alert(d)
                        } else alert(a.settings.errorMessage);
                        a.$element.trigger("arcontactus.successCallbackRequest", b)
                    },
                    error: function() {
                        c.find(".callback-countdown-block-phone").removeClass("ar-loading");
                        alert(a.settings.errorMessage);
                        a.$element.trigger("arcontactus.errorCallbackRequest")
                    }
                })
            };
            d.prototype.show = function() {
                this.$element.addClass("active");
                this.$element.trigger("arcontactus.show")
            };
            d.prototype.hide = function() {
                this.$element.removeClass("active");
                this.$element.trigger("arcontactus.hide")
            };
            d.prototype.openPopup = function(a) {
                this.closeMenu();
                var c = this.$element;
                c.find("#arcu-popup-" + a).addClass("show-messageners-block");
                c.find("#arcu-popup-" + a).hasClass("popup-opened") || (this.stopAnimation(),
                    c.addClass("popup-opened"), c.find("#arcu-popup-" + a).addClass(this.settings.menuInAnimationClass), c.find(".arcontactus-close").addClass("show-messageners-block"), c.find(".icons, .static").addClass("hide"), c.find(".pulsation").addClass("stop"), this._popupOpened = !0, this.$element.trigger("arcontactus.openPopup"))
            };
            d.prototype.closePopup = function() {
                var a = this.$element;
                a.find(".arcu-popup").hasClass("show-messageners-block") && (setTimeout(function() {
                        a.removeClass("popup-opened")
                    }, 150), a.find(".arcu-popup").removeClass(this.settings.menuInAnimationClass).addClass(this.settings.menuOutAnimationClass),
                    setTimeout(function() {
                        a.removeClass("popup-opened")
                    }, 150), a.find(".arcontactus-close").removeClass("show-messageners-block"), a.find(".icons, .static").removeClass("hide"), a.find(".pulsation").removeClass("stop"), this.startAnimation(), this._popupOpened = !1, this.$element.trigger("arcontactus.closeMenu"))
            };
            d.prototype.openMenu = function() {
                if ("callback" == this.settings.mode) return console.log("Widget in callback mode"), !1;
                var a = this.$element;
                a.find(".messangers-block").hasClass(this.settings.menuInAnimationClass) ||
                    (this.stopAnimation(), a.addClass("open"), a.find(".messangers-block").addClass(this.settings.menuInAnimationClass), a.find(".arcontactus-close").addClass("show-messageners-block"), a.find(".icons, .static").addClass("hide"), a.find(".pulsation").addClass("stop"), this._menuOpened = !0, this.$element.trigger("arcontactus.openMenu"))
            };
            d.prototype.closeMenu = function() {
                if ("callback" == this.settings.mode) return console.log("Widget in callback mode"), !1;
                var a = this.$element,
                    c = this;
                a.find(".messangers-block").hasClass(this.settings.menuInAnimationClass) &&
                    (setTimeout(function() {
                        a.removeClass("open")
                    }, 150), a.find(".messangers-block").removeClass(this.settings.menuInAnimationClass).addClass(this.settings.menuOutAnimationClass), setTimeout(function() {
                        a.find(".messangers-block").removeClass(c.settings.menuOutAnimationClass)
                    }, 1E3), a.find(".arcontactus-close").removeClass("show-messageners-block"), a.find(".icons, .static").removeClass("hide"), a.find(".pulsation").removeClass("stop"), this.startAnimation(), this._menuOpened = !1, this.$element.trigger("arcontactus.closeMenu"))
            };
            d.prototype.toggleMenu = function() {
                var a = this.$element;
                this.hidePrompt();
                if (a.find(".callback-countdown-block").hasClass("display-flex")) return !1;
                a.find(".messangers-block").hasClass(this.settings.menuInAnimationClass) ? this.closeMenu() : this.openMenu();
                this.$element.trigger("arcontactus.toggleMenu")
            };
            d.prototype.openCallbackPopup = function() {
                var a = this.$element;
                a.addClass("opened");
                this.closeMenu();
                this.stopAnimation();
                a.find(".icons, .static").addClass("hide");
                a.find(".pulsation").addClass("stop");
                a.find(".callback-countdown-block").addClass("display-flex");
                a.find(".callback-countdown-block-phone").addClass("display-flex");
                a.find(".callback-state").addClass("display-flex");
                this._callbackOpened = !0;
                this.$element.trigger("arcontactus.openCallbackPopup")
            };
            d.prototype.closeCallbackPopup = function() {
                var a = this.$element;
                a.removeClass("opened");
                a.find(".messangers-block").removeClass(this.settings.menuInAnimationClass);
                a.find(".arcontactus-close").removeClass("show-messageners-block");
                a.find(".icons, .static").removeClass("hide");
                a.find(".pulsation").removeClass("stop");
                a.find(".callback-countdown-block, .callback-countdown-block-phone, .callback-countdown-block-sorry, .callback-countdown-block-timer").removeClass("display-flex");
                a.find(".callback-state").removeClass("display-flex");
                this.startAnimation();
                this._callbackOpened = !1;
                this.$element.trigger("arcontactus.closeCallbackPopup")
            };
            d.prototype.startAnimation = function() {
                var a = this.$element,
                    c = a.find(".icons-line"),
                    b = a.find(".static"),
                    d = a.find(".icons-line>span:first-child").width() +
                    40;
                if ("huge" === this.settings.buttonSize) var h = 2,
                    f = 0;
                "large" === this.settings.buttonSize && (h = 2, f = 0);
                "medium" === this.settings.buttonSize && (h = 4, f = -2);
                "small" === this.settings.buttonSize && (h = 4, f = -2);
                var g = a.find(".icons-line>span").length,
                    k = 0;
                this.stopAnimation();
                if (0 === this.settings.iconsAnimationSpeed) return !1;
                var m = this;
                this._interval = setInterval(function() {
                    0 === k && (c.parent().removeClass("hide"), b.addClass("hide"));
                    var a = "translate(" + -(d * k + h) + "px, " + f + "px)";
                    c.css({
                        "-webkit-transform": a,
                        "-ms-transform": a,
                        transform: a
                    });
                    k++;
                    if (k > g) {
                        if (k > g + 1) {
                            if (m.settings.iconsAnimationPause) return m.stopAnimation(), setTimeout(function() {
                                if (m._callbackOpened || m._menuOpened || m._popupOpened) return !1;
                                m.startAnimation()
                            }, m.settings.iconsAnimationPause), !1;
                            k = 0
                        }
                        c.parent().addClass("hide");
                        b.removeClass("hide");
                        a = "translate(" + -h + "px, " + f + "px)";
                        c.css({
                            "-webkit-transform": a,
                            "-ms-transform": a,
                            transform: a
                        })
                    }
                }, this.settings.iconsAnimationSpeed)
            };
            d.prototype.stopAnimation = function() {
                clearInterval(this._interval);
                var a = this.$element,
                    b = a.find(".icons-line");
                a = a.find(".static");
                b.parent().addClass("hide");
                a.removeClass("hide");
                b.css({
                    "-webkit-transform": "translate(-2px, 0px)",
                    "-ms-transform": "translate(-2px, 0px)",
                    transform: "translate(-2px, 0px)"
                })
            };
            d.prototype.showPrompt = function(a) {
                var b = this.$element.find(".arcontactus-prompt");
                a && a.content && b.find(".arcontactus-prompt-inner").html(a.content);
                b.addClass("active");
                this.$element.trigger("arcontactus.showPrompt")
            };
            d.prototype.hidePrompt = function() {
                this.$element.find(".arcontactus-prompt").removeClass("active");
                this.$element.trigger("arcontactus.hidePrompt")
            };
            d.prototype.showPromptTyping = function() {
                this.$element.find(".arcontactus-prompt").find(".arcontactus-prompt-inner").html("");
                this._insertPromptTyping();
                this.showPrompt({});
                this.$element.trigger("arcontactus.showPromptTyping")
            };
            d.prototype._insertPromptTyping = function() {
                var a = this.$element.find(".arcontactus-prompt-inner"),
                    c = b("<div>", {
                        class: "arcontactus-prompt-typing"
                    }),
                    d = b("<div>");
                c.append(d);
                c.append(d.clone());
                c.append(d.clone());
                a.append(c)
            };
            d.prototype.hidePromptTyping =
                function() {
                    this.$element.find(".arcontactus-prompt").removeClass("active");
                    this.$element.trigger("arcontactus.hidePromptTyping")
                };
            d.prototype._backgroundStyle = function() {
                return "background-color: " + this.settings.theme
            };
            d.prototype._colorStyle = function() {
                return "color: " + this.settings.theme
            };
            b.fn.contactUs = function(a) {
                var c = Array.prototype.slice.call(arguments, 1);
                return this.each(function() {
                    var e = b(this),
                        l = e.data("ar.contactus");
                    l || (l = new d(this, "object" == typeof a && a), e.data("ar.contactus", l));
                    "string" ==
                    typeof a && "_" !== a.charAt(0) && l[a].apply(l, c)
                })
            };
            b.fn.contactUs.Constructor = d
        })(jQuery);
    </script>
    <!--<style>
.arcontactus-widget{opacity:0;transition:.2s opacity;line-height:1}
.arcontactus-widget *{box-sizing:border-box}
.arcontactus-widget.left.arcontactus-message{left:20px;right:auto}
.arcontactus-widget.left .arcontactus-message-button{right:auto;left:0}
.arcontactus-widget.left .arcontactus-prompt{left:80px;right:auto;transform-origin:0 50%}
.arcontactus-widget.left .arcontactus-prompt.arcu-prompt-top{left:0;right:auto}
.arcontactus-widget.left .arcontactus-prompt.arcu-prompt-top:before{border-right:8px solid transparent;border-top:8px solid #fff;border-left:8px solid transparent;border-bottom:0 none;left:25px;right:auto}
.arcontactus-widget.left .arcontactus-prompt:before{border-right:8px solid #fff;border-top:8px solid transparent;border-left:8px solid transparent;border-bottom:8px solid transparent;right:auto;left:-15px}
.arcontactus-widget.left .messangers-block{right:auto;left:0;-webkit-transform-origin:10% 105%;-ms-transform-origin:10% 105%;transform-origin:10% 105%}
.arcontactus-widget.left .callback-countdown-block{left:0;right:auto}
.arcontactus-widget.left .messangers-block::before,.arcontactus-widget.left .callback-countdown-block::before{left:25px;right:auto}
.arcontactus-widget.hg.arcontactus-message{width:100px;height:100px}
.arcontactus-widget.hg .messangers-block,.arcontactus-widget.hg .callback-countdown-block,.arcontactus-widget.hg .arcu-popup{bottom:110px}
.arcontactus-widget.hg .arcontactus-prompt{bottom:5px}
.arcontactus-widget.hg .icons-line{top:22px;left:24px}
.arcontactus-widget.hg.left .messangers-block:before,.arcontactus-widget.hg.left .callback-countdown-block:before,.arcontactus-widget.hg.left .arcu-popup:before{left:41px}
.arcontactus-widget.hg.left .arcontactus-prompt{left:110px;bottom:26px}
.arcontactus-widget.hg.right .messangers-block:before,.arcontactus-widget.hg.right .callback-countdown-block:before,.arcontactus-widget.hg.right .arcu-popup:before{right:41px}
.arcontactus-widget.hg.right .arcontactus-prompt{right:110px;bottom:26px}
.arcontactus-widget.hg .arcontactus-message-button{width:100px;height:100px}
.arcontactus-widget.hg .arcontactus-message-button .pulsation{width:114px;height:114px;border-radius:60px}
.arcontactus-widget.hg .arcontactus-message-button .icons{width:70px;height:70px;margin-top:-35px;margin-left:-35px}
.arcontactus-widget.hg .arcontactus-message-button .callback-state{width:70px;height:70px;margin-top:-35px;margin-left:-35px}
.arcontactus-widget.md.arcontactus-message{width:60px;height:60px}
.arcontactus-widget.md .messangers-block,.arcontactus-widget.md .callback-countdown-block,.arcontactus-widget.md .arcu-popup{bottom:70px}
.arcontactus-widget.md .arcontactus-prompt{bottom:5px}
.arcontactus-widget.md.left .messangers-block:before,.arcontactus-widget.md.left .callback-countdown-block:before,.arcontactus-widget.md.left .arcu-popup:before{left:21px}
.arcontactus-widget.md.left .arcontactus-prompt{left:70px}
.arcontactus-widget.md.left .arcontactus-prompt.arcu-prompt-top{bottom:70px;left:0;right:auto}
.arcontactus-widget.md.left .arcontactus-prompt.arcu-prompt-top:before{border-right:8px solid transparent;border-top:8px solid #fff;border-left:8px solid transparent;border-bottom:0 none;left:21px;right:auto}
.arcontactus-widget.md.right .messangers-block:before,.arcontactus-widget.md.right .callback-countdown-block:before,.arcontactus-widget.md.right .arcu-popup:before{right:21px}
.arcontactus-widget.md.right .arcontactus-prompt{right:70px}
.arcontactus-widget.md.right .arcontactus-prompt.arcu-prompt-top{right:0;bottom:70px}
.arcontactus-widget.md.right .arcontactus-prompt.arcu-prompt-top:before{right:21px}
.arcontactus-widget.md .arcontactus-message-button{width:60px;height:60px}
.arcontactus-widget.md .arcontactus-message-button .pulsation{width:74px;height:74px}
.arcontactus-widget.md .arcontactus-message-button .icons{width:40px;height:40px;margin-top:-20px;margin-left:-20px}
.arcontactus-widget.md .arcontactus-message-button .callback-state{width:40px;height:40px;margin-top:-20px;margin-left:-20px}
.arcontactus-widget.sm.arcontactus-message{width:60px;height:60px}
.arcontactus-widget.sm .messangers-block,.arcontactus-widget.sm .callback-countdown-block,.arcontactus-widget.sm .arcu-popup{bottom:60px}
.arcontactus-widget.sm .arcontactus-prompt{bottom:0}
.arcontactus-widget.sm.left .messangers-block:before,.arcontactus-widget.sm.left .callback-countdown-block:before,.arcontactus-widget.sm.left .arcu-popup:before{left:16px}
.arcontactus-widget.sm.left .arcontactus-prompt{left:60px}
.arcontactus-widget.sm.left .arcontactus-prompt.arcu-prompt-top{bottom:60px;left:0;right:auto}
.arcontactus-widget.sm.left .arcontactus-prompt.arcu-prompt-top:before{border-right:8px solid transparent;border-top:8px solid #fff;border-left:8px solid transparent;border-bottom:0 none;left:16px;right:auto}
.arcontactus-widget.sm.right .messangers-block:before,.arcontactus-widget.sm.right .callback-countdown-block:before,.arcontactus-widget.sm.right .arcu-popup:before{right:16px}
.arcontactus-widget.sm.right .arcontactus-prompt{right:70px;bottom:7px}
.arcontactus-widget.sm.right .arcontactus-prompt.arcu-prompt-top{right:0;bottom:60px}
.arcontactus-widget.sm.right .arcontactus-prompt.arcu-prompt-top:before{right:16px}
.arcontactus-widget.sm .arcontactus-message-button{width:60px;height:60px}
.arcontactus-widget.sm .arcontactus-message-button .pulsation{width:74px;height:74px}
.arcontactus-widget.sm .arcontactus-message-button .icons{width:40px;height:40px;margin-top:-20px;margin-left:-20px}
.arcontactus-widget.sm .arcontactus-message-button .static{margin-top:-16px}
.arcontactus-widget.sm .arcontactus-message-button .callback-state{width:40px;height:40px;margin-top:-20px;margin-left:-20px}
.arcontactus-widget.active{opacity:1}
.arcontactus-widget.arcontactus-message{z-index:1000000;right:20px;bottom:20px;position:fixed!important;height:70px;width:70px}
.arcontactus-widget .arcontactus-message-button{width:70px;position:absolute;height:70px;right:0;background-color:red;border-radius:50px;-webkit-box-sizing:border-box;box-sizing:border-box;text-align:center;display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;-webkit-box-align:center;-ms-flex-align:center;align-items:center;cursor:pointer}
.arcontactus-widget .arcontactus-message-button p,.arcontactus-widget .arcontactus-message-button .arcu-item-label{font-family:Segoe UI,Frutiger,Frutiger Linotype,Dejavu Sans,Helvetica Neue,Arial,sans-serif;color:#fff;font-weight:700;font-size:10px;line-height:11px;margin:0}
.arcontactus-widget .arcontactus-message-button .pulsation{width:84px;height:84px;background-color:red;border-radius:50px;position:absolute;left:-7px;top:-7px;z-index:-1;-webkit-transform:scale(0);-ms-transform:scale(0);transform:scale(0);-webkit-animation:arcontactus-pulse 2s infinite;animation:arcontactus-pulse 2s infinite}
.arcontactus-widget .arcontactus-message-button .icons{background-color:#fff;width:44px;height:44px;border-radius:50px;position:absolute;overflow:hidden;top:50%;left:50%;margin-top:-22px;margin-left:-22px}
.arcontactus-widget .arcontactus-message-button .static{position:absolute;top:50%;left:50%;margin-top:-19px;margin-left:-26px;width:52px;height:52px;text-align:center}
.arcontactus-widget .arcontactus-message-button .static img{display:inline}
.arcontactus-widget .arcontactus-message-button .static svg{width:24px;height:24px;color:#fff}
.arcontactus-widget .arcontactus-message-button.no-text .static{margin-top:-12px}
.arcontactus-widget .pulsation:nth-of-type(2n){-webkit-animation-delay:.5s;animation-delay:.5s}
.arcontactus-widget .pulsation.stop{-webkit-animation:none;animation:none}
.arcontactus-widget .icons-line{top:10px;left:12px;display:-webkit-box;display:-ms-flexbox;display:flex;position:absolute;-webkit-transition:cubic-bezier(.13,1.49,.14,-0.4);-o-transition:cubic-bezier(.13,1.49,.14,-0.4);transition:cubic-bezier(.13,1.49,.14,-0.4);-webkit-animation-delay:0s;animation-delay:0s;-webkit-transform:translateX(30px);-ms-transform:translateX(30px);transform:translateX(30px);height:24px;transition:.2s all}
.arcontactus-widget .icons-line.stop{-webkit-animation-play-state:paused;animation-play-state:paused}
.arcontactus-widget .icons-line span{display:inline-block;width:24px;height:24px;color:red}
.arcontactus-widget .icons-line span svg,.arcontactus-widget .icons-line span i{width:24px;height:24px}
.arcontactus-widget .icons-line span i{display:block;font-size:24px;line-height:24px}
.arcontactus-widget .icons-line img,.arcontactus-widget .icons-line span{margin-right:40px}
.arcontactus-widget .static{transition:.2s all}
.arcontactus-widget .static.hide{transform:scale(0);opacity:0}
.arcontactus-widget .icons{transition:.2s all}
.arcontactus-widget .icons.hide{transform:scale(0);opacity:0}
.arcontactus-widget .icons.hide .icons-line{transform:scale(0)}
.arcontactus-widget .icons .icon:first-of-type{margin-left:0}
.arcontactus-widget .arcontactus-close{color:#fff}
.arcontactus-widget .arcontactus-close svg{-webkit-transform:rotate(180deg) scale(0);-ms-transform:rotate(180deg) scale(0);transform:rotate(180deg) scale(0);-webkit-transition:ease-in .12s all;-o-transition:ease-in .12s all;transition:ease-in .12s all;display:block}
.arcontactus-widget .arcontactus-close.show-messageners-block svg{-webkit-transform:rotate(0) scale(1);-ms-transform:rotate(0) scale(1);transform:rotate(0) scale(1)}
.arcontactus-widget .arcontactus-prompt{display:-webkit-box;display:-ms-flexbox;display:flex}
.arcontactus-widget .messangers-block,.arcontactus-widget .arcontactus-prompt,.arcontactus-widget .arcu-popup{background:#fff;box-shadow:0 0 40px rgba(0,0,0,0.2);width:300px;background-repeat:no-repeat;background-position:center;position:absolute;bottom:80px;right:0;-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;flex-direction:column;-webkit-box-align:start;-ms-flex-align:start;align-items:flex-start;padding:10px 0;-webkit-box-sizing:border-box;box-sizing:border-box;border-radius:7px;-webkit-transform-origin:80% 105%;-ms-transform-origin:80% 105%;transform-origin:80% 105%;-webkit-transform:scale(0);-ms-transform:scale(0);transform:scale(0);-webkit-transition:ease-out .12s all;-o-transition:ease-out .12s all;transition:ease-out .12s all;z-index:1000000}
.arcontactus-widget .messangers-block:before,.arcontactus-widget .arcontactus-prompt:before,.arcontactus-widget .arcu-popup:before{position:absolute;bottom:-7px;right:25px;left:auto;display:inline-block!important;border-right:8px solid transparent;border-top:8px solid #fff;border-left:8px solid transparent;content:&#39;&#39;}
.arcontactus-widget .messangers-block.show-messageners-block,.arcontactus-widget .arcontactus-prompt.show-messageners-block,.arcontactus-widget .arcu-popup.show-messageners-block{-webkit-transform:scale(1);-ms-transform:scale(1);transform:scale(1)}
.arcontactus-widget .arcu-popup{padding:0}
.arcontactus-widget .arcu-popup .arcu-popup-header{padding:18px 15px;color:#fff;background:#787878;border-radius:7px 7px 0 0;font-family:Segoe UI,Frutiger,Frutiger Linotype,Dejavu Sans,Helvetica Neue,Arial,sans-serif;margin-bottom:0;font-size:17px;position:relative;line-height:1.4}
.arcontactus-widget .arcu-popup .arcu-popup-content{padding:10px;max-height:300px;overflow:auto;line-height:initial}
.arcontactus-widget .arcontactus-prompt.arcu-prompt-top{right:0;max-width:260px;bottom:80px}
.arcontactus-widget .arcontactus-prompt.arcu-prompt-top:before{bottom:-7px;right:25px;left:auto;border-right:8px solid transparent;border-top:8px solid #fff;border-left:8px solid transparent;border-bottom:0 none}
.arcontactus-widget .messangers-block{display:block}
.arcontactus-widget .messangers-block.has-header{padding-top:0}
.arcontactus-widget .messangers-block .arcu-menu-header{padding:18px 15px;color:#fff;background:#787878;border-radius:7px 7px 0 0;font-family:Segoe UI,Frutiger,Frutiger Linotype,Dejavu Sans,Helvetica Neue,Arial,sans-serif;margin-bottom:10px;font-size:17px;position:relative;line-height:1.4}
.arcontactus-widget .arcu-header-close,.arcontactus-widget .arcu-popup-close,.arcontactus-widget .arcu-popup-back{position:absolute;right:0;top:-30px;padding:0;margin:0;border:0 none;background:none;line-height:1;width:26px;height:26px;cursor:pointer;color:#fff;background:#787878;border-radius:50%;text-align:center}
.arcontactus-widget .arcu-header-close svg,.arcontactus-widget .arcu-popup-close svg,.arcontactus-widget .arcu-popup-back svg{height:12px;width:12px;display:block;position:absolute;left:50%;top:50%;margin:-6px 0 0 -6px}
.arcontactus-widget .arcu-popup-back{right:auto;left:0;top:50%;margin-top:-13px;display:none}
.arcontactus-widget .arcu-popup-back svg{height:16px;width:16px;margin:-8px 0 0 -8px}
.arcontactus-widget .arcontactus-prompt{color:#787878;font-family:Segoe UI,Frutiger,Frutiger Linotype,Dejavu Sans,Helvetica Neue,Arial,sans-serif;font-size:16px;line-height:18px;width:auto;bottom:10px;right:80px;white-space:nowrap;padding:14px 20px 14px}
.arcontactus-widget .arcontactus-prompt:before{border-right:8px solid transparent;border-top:8px solid transparent;border-left:8px solid #fff;border-bottom:8px solid transparent;bottom:16px;right:-15px}
.arcontactus-widget .arcontactus-prompt.active{-webkit-transform:scale(1);-ms-transform:scale(1);transform:scale(1)}
.arcontactus-widget .arcontactus-prompt:hover .arcontactus-prompt-close{opacity:1}
.arcontactus-widget .arcontactus-prompt .arcontactus-prompt-close{opacity:0;transition:.2s all;position:absolute;right:-10px;top:-10px;padding:0;margin:0;border:0 none;background:none;line-height:1;width:26px;height:26px;cursor:pointer;color:#fff;background:#787878;border-radius:50%;text-align:center}
.arcontactus-widget .arcontactus-prompt .arcontactus-prompt-close svg{height:12px;width:12px;display:block;position:absolute;left:50%;top:50%;margin:-6px 0 0 -6px}
.arcontactus-widget .arcontactus-prompt .arcontactus-prompt-typing{border-radius:10px;display:inline-block;left:3px;padding:0 0 0 3px;position:relative;top:4px;width:50px}
.arcontactus-widget .arcontactus-prompt .arcontactus-prompt-typing&gt;div{position:relative;float:left;border-radius:50%;width:10px;height:10px;background:#ccc;margin:0 2px;-webkit-animation:arcontactus-updown 2s infinite;animation:arcontactus-updown 2s infinite}
.arcontactus-widget .arcontactus-prompt .arcontactus-prompt-typing&gt;div:nth-child(2){animation-delay:.1s}
.arcontactus-widget .arcontactus-prompt .arcontactus-prompt-typing&gt;div:nth-child(3){animation-delay:.2s}
.arcontactus-widget .messangers-block .messangers-list{list-style:none;margin:0;padding:0}
.arcontactus-widget .messangers-block .messangers-list li{margin:0;padding:0}
.arcontactus-widget .messangers-block.sm .arcu-menu-header{padding-top:12px;padding-bottom:12px}
.arcontactus-widget .messangers-block.sm .not-rounded-items .messanger{padding-left:42px}
.arcontactus-widget .messangers-block.sm .messanger{padding-left:50px;min-height:44px;padding-top:4px;padding-bottom:4px}
.arcontactus-widget .messangers-block.sm .messanger span{height:32px;width:32px;margin-top:-16px}
.arcontactus-widget .messangers-block.sm .messanger span svg,.arcontactus-widget .messangers-block.sm .messanger span i{height:20px;width:20px;line-height:20px;margin-top:-10px;margin-left:-10px;font-size:21px}
.arcontactus-widget .not-rounded-items .messanger{padding-left:48px}
.arcontactus-widget .not-rounded-items .messanger span{left:5px}
.arcontactus-widget .messanger{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-ms-flex-direction:row;flex-direction:row;-webkit-box-align:center;-ms-flex-align:center;align-items:center;margin:0;cursor:pointer;width:100%;padding:8px 20px 8px 60px;position:relative;min-height:54px;text-decoration:none}
.arcontactus-widget .messanger:hover{background-color:#eee}
.arcontactus-widget .messanger:before{background-repeat:no-repeat;background-position:center}
.arcontactus-widget .messanger.facebook span{background:#0084ff}
.arcontactus-widget .messanger.viber span{background:#7c529d}
.arcontactus-widget .messanger.telegram span{background:#2ca5e0}
.arcontactus-widget .messanger.skype span{background:#31c4ed}
.arcontactus-widget .messanger.email span{background:#ff8400}
.arcontactus-widget .messanger.contact span{background:#7eb105}
.arcontactus-widget .messanger.call-back span{background:#54cd81}
.arcontactus-widget .messanger span{position:absolute;left:10px;top:50%;margin-top:-20px;display:block;width:40px;height:40px;border-radius:50%;background-color:#0084ff;margin-right:10px;color:#fff;text-align:center;vertical-align:middle}
.arcontactus-widget .messanger span svg,.arcontactus-widget .messanger span i{width:24px;height:24px;vertical-align:middle;text-align:center;display:block;position:absolute;top:50%;left:50%;margin-top:-12px;margin-left:-12px}
.arcontactus-widget .messanger span i{font-size:24px;line-height:24px}
.arcontactus-widget .messanger p,.arcontactus-widget .messanger .arcu-item-label{margin:0;font-family:Segoe UI,Frutiger,Frutiger Linotype,Dejavu Sans,Helvetica Neue,Arial,sans-serif;font-size:15px;color:rgba(0,0,0,0.87);padding:0;line-height:17px}
.arcontactus-widget .messanger p .arcu-item-subtitle,.arcontactus-widget .messanger .arcu-item-label .arcu-item-subtitle{font-size:13px;color:#787878}
.arcontactus-widget .callback-countdown-block{background:#fff;box-shadow:0 0 40px rgba(0,0,0,0.2);width:410px;background-repeat:no-repeat;background-position:center;position:absolute;bottom:80px;left:auto;right:0;align-items:center;border-radius:7px;-webkit-transform-origin:80% 105%;-ms-transform-origin:80% 105%;transform-origin:80% 105%;-webkit-transform:scale(1);-ms-transform:scale(1);transform:scale(1);-webkit-transition:ease-out .12s all;-o-transition:ease-out .12s all;transition:ease-out .12s all;z-index:1000000;color:red;padding-top:5px;padding-left:8px;padding-right:8px;display:none}
.arcontactus-widget .callback-countdown-block .callback-countdown-block-timer_timer{font-size:38px;font-family:Segoe UI,Frutiger,Frutiger Linotype,Dejavu Sans,Helvetica Neue,Arial,sans-serif}
.arcontactus-widget .callback-countdown-block.display-flex{display:block}
.arcontactus-widget .callback-countdown-block:before{position:absolute;bottom:-7px;right:25px;left:auto;display:inline-block!important;border-right:8px solid transparent;border-top:8px solid #fff;border-left:8px solid transparent;content:&#39;&#39;}
.arcontactus-widget .callback-countdown-block .callback-countdown-block-phone{font-family:Segoe UI,Frutiger,Frutiger Linotype,Dejavu Sans,Helvetica Neue,Arial,sans-serif;font-size:15px;line-height:18px;padding:0 10px 10px;-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;flex-direction:column;-webkit-box-align:center;-ms-flex-align:center;align-items:center;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;display:none;width:100%;position:relative}
.arcontactus-widget .callback-countdown-block .callback-countdown-block-phone:before{transition:.2s all}
.arcontactus-widget .callback-countdown-block .callback-countdown-block-phone.ar-loading:before{background:rgba(255,255,255,0.8);content:&#39; &#39;;position:absolute;width:100%;height:100%;left:0;top:0;z-index:1}
.arcontactus-widget .callback-countdown-block .callback-countdown-block-phone.ar-loading:after{content:&#39; &#39;;position:absolute;width:30px;height:30px;z-index:2;top:50%;bottom:50%;margin-top:-15px;margin-bottom:-15px;left:50%;margin-left:-15px;background:url(&#39;../img/ring-alt.gif&#39;) no-repeat transparent scroll 0 0}
.arcontactus-widget .callback-countdown-block .callback-countdown-block-phone p,.arcontactus-widget .callback-countdown-block .callback-countdown-block-phone .arcu-item-label{text-align:center;margin-bottom:10px;margin-top:3px}
.arcontactus-widget .callback-countdown-block .callback-countdown-block-phone .callback-countdown-block-form-group{align-items:center}
.arcontactus-widget .callback-countdown-block .callback-countdown-block-phone .callback-countdown-block-form-group .arcu-form-group{margin-bottom:10px}
.arcontactus-widget .callback-countdown-block .callback-countdown-block-phone .callback-countdown-block-form-group .arcu-form-group.arcu-form-group-required .arcu-form-label:after{content:&quot; *&quot;;color:#c7254e}
.arcontactus-widget .callback-countdown-block .callback-countdown-block-phone .callback-countdown-block-form-group .arcu-form-group.arcu-form-group-type-checkbox{position:relative;padding-left:20px}
.arcontactus-widget .callback-countdown-block .callback-countdown-block-phone .callback-countdown-block-form-group .arcu-form-group.arcu-form-group-type-checkbox input{position:absolute;top:2px;left:0;width:16px;height:16px}
.arcontactus-widget .callback-countdown-block .callback-countdown-block-phone .callback-countdown-block-form-group .arcu-form-label{font-size:14px;margin-bottom:3px;color:#333}
.arcontactus-widget .callback-countdown-block .callback-countdown-block-phone .callback-countdown-block-form-group .arcu-form-field{display:block;width:100%;font-family:Segoe UI,Frutiger,Frutiger Linotype,Dejavu Sans,Helvetica Neue,Arial,sans-serif;font-size:14px;line-height:16px;border-radius:4px;border:0;height:36px;-webkit-box-sizing:border-box;box-sizing:border-box;padding:6px 10px 6px;border:1px solid #ddd;margin:0!important}
.arcontactus-widget .callback-countdown-block .callback-countdown-block-phone .callback-countdown-block-form-group textarea.arcu-form-field{height:80px;resize:vertical;max-height:140px;min-height:60px}
.arcontactus-widget .callback-countdown-block .callback-countdown-block-phone .callback-countdown-block-form-group button[type=submit]{display:block;width:100%;border-radius:4px;border:0;background-color:red;color:#fff;font-family:Segoe UI,Frutiger,Frutiger Linotype,Dejavu Sans,Helvetica Neue,Arial,sans-serif;font-size:14px;padding:7px 5px 7px;cursor:pointer;height:36px;margin:0;line-height:1}
.arcontactus-widget .callback-countdown-block .callback-countdown-block-phone .callback-countdown-block-form-group button[type=submit]:hover{opacity:.8}
.arcontactus-widget .callback-countdown-block .callback-countdown-block-sorry{height:140px;-webkit-box-align:center;-ms-flex-align:center;align-items:center;display:none}
.arcontactus-widget .callback-countdown-block .callback-countdown-block-sorry p{font-family:Segoe UI,Frutiger,Frutiger Linotype,Dejavu Sans,Helvetica Neue,Arial,sans-serif;font-size:16px;line-height:18px;text-align:center;margin-bottom:5px;margin-top:7px;width:100%}
.arcontactus-widget .callback-countdown-block .callback-countdown-block-close{position:absolute;right:9px;top:9px;padding:0;margin:0;border:0 none;background:none;line-height:1;width:26px;height:26px;cursor:pointer;color:#fff;background:#787878;border-radius:50%;z-index:1;text-align:center}
.arcontactus-widget .callback-countdown-block .callback-countdown-block-close svg{height:12px;width:12px;display:block;position:absolute;left:50%;top:50%;margin:-6px 0 0 -6px}
.arcontactus-widget .callback-countdown-block .callback-countdown-block-timer{-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;flex-direction:column;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;-webkit-box-align:center;-ms-flex-align:center;align-items:center;height:140px;display:none}
.arcontactus-widget .callback-countdown-block .callback-countdown-block-timer p{font-family:Segoe UI,Frutiger,Frutiger Linotype,Dejavu Sans,Helvetica Neue,Arial,sans-serif;font-size:16px;line-height:21px;text-align:center;margin-bottom:5px;margin-top:7px}
.arcontactus-widget .callback-countdown-block .callback-countdown-block-timer h1{font-family:Segoe UI,Frutiger,Frutiger Linotype,Dejavu Sans,Helvetica Neue,Arial,sans-serif;font-size:40px;line-height:46px;text-align:center;font-weight:300}
.arcontactus-widget .callback-countdown-block .callback-countdown-block-phone.display-flex{display:block}
.arcontactus-widget .callback-countdown-block .callback-countdown-block-timer.display-flex,.arcontactus-widget .callback-countdown-block .callback-countdown-block-sorry.display-flex{display:-webkit-box;display:-ms-flexbox;display:flex}
.arcontactus-widget .callback-state{background-color:#fff;width:44px;height:44px;border-radius:50px;position:absolute;overflow:hidden;top:50%;left:50%;margin-top:-22px;margin-left:-22px;display:none;-webkit-animation:none;animation:none;z-index:999999;transition:.2s all;transform:scale(0);color:red;display:-webkit-box;display:-ms-flexbox;display:flex}
.arcontactus-widget .callback-state.display-flex{transform:scale(1)}
.arcontactus-widget .callback-state svg{width:24px;height:24px;position:absolute;top:50%;left:50%;margin-top:-12px;margin-left:-12px}
.arcontactus-widget .callback-state .callback-state-img{position:absolute;top:12px;left:12px}
.arcontactus-widget .animation-pause{-webkit-animation-play-state:paused;animation-play-state:paused}
@-webkit-keyframes arcontactus-pulse{0%{-webkit-transform:scale(0);transform:scale(0);opacity:1}50%{opacity:.5}100%{-webkit-transform:scale(1);transform:scale(1);opacity:0}}
@media (max-width:468px){.arcontactus-widget.arcontactus-message.opened{width:auto;right:20px;left:20px}.arcontactus-widget .callback-countdown-block{width:auto}}
@media (max-height:400px){.arcontactus-widget .arcontactus-prompt .arcontactus-prompt-close{opacity:1}}
@media (max-width:428px){.arcontactus-widget .callback-countdown-block .callback-countdown-block-phone .callback-countdown-block-form-group{display:block}.arcontactus-widget .callback-countdown-block .callback-countdown-block-phone .callback-countdown-block-form-group input[type=tel],.arcontactus-widget .callback-countdown-block .callback-countdown-block-phone .callback-countdown-block-form-group button[type=submit]{display:block;width:100%;margin:0 0 5px 0}.arcontactus-widget .callback-countdown-block .callback-countdown-block-phone .callback-countdown-block-form-group input[type=tel]{margin-bottom:10px!important}.arcontactus-widget .callback-countdown-block .callback-countdown-block-phone.display-flex{display:block;width:100%}.arcontactus-widget .arcontactus-prompt .arcontactus-prompt-close{opacity:1}.arcontactus-widget.arcontactus-message .messangers-block,.arcontactus-widget.arcontactus-message .callback-countdown-block,.arcontactus-widget.arcontactus-message .arcu-popup{bottom:0;border-radius:0}.arcontactus-widget.arcontactus-message.open,.arcontactus-widget.arcontactus-message.opened,.arcontactus-widget.arcontactus-message.popup-opened{width:100%;left:0;right:0;bottom:0}.arcontactus-widget.arcontactus-message.open .messangers-block .arcu-menu-header,.arcontactus-widget.arcontactus-message.opened .messangers-block .arcu-menu-header,.arcontactus-widget.arcontactus-message.popup-opened .messangers-block .arcu-menu-header{border-radius:0;padding-right:40px}.arcontactus-widget.arcontactus-message.open .messangers-block .arcu-header-close,.arcontactus-widget.arcontactus-message.opened .messangers-block .arcu-header-close,.arcontactus-widget.arcontactus-message.popup-opened .messangers-block .arcu-header-close{right:5px;top:50%;margin-top:-13px}.arcontactus-widget.arcontactus-message.open .arcu-popup .arcu-popup-header,.arcontactus-widget.arcontactus-message.opened .arcu-popup .arcu-popup-header,.arcontactus-widget.arcontactus-message.popup-opened .arcu-popup .arcu-popup-header{border-radius:0;padding-right:40px;padding-left:30px}.arcontactus-widget.arcontactus-message.open .arcu-popup .arcu-popup-back,.arcontactus-widget.arcontactus-message.opened .arcu-popup .arcu-popup-back,.arcontactus-widget.arcontactus-message.popup-opened .arcu-popup .arcu-popup-back{display:block}.arcontactus-widget.arcontactus-message.open .arcu-popup .arcu-popup-close,.arcontactus-widget.arcontactus-message.opened .arcu-popup .arcu-popup-close,.arcontactus-widget.arcontactus-message.popup-opened .arcu-popup .arcu-popup-close{right:5px;top:50%;margin-top:-13px}.arcontactus-widget.arcontactus-message.open .messangers-block,.arcontactus-widget.arcontactus-message.opened .messangers-block,.arcontactus-widget.arcontactus-message.popup-opened .messangers-block,.arcontactus-widget.arcontactus-message.open .callback-countdown-block,.arcontactus-widget.arcontactus-message.opened .callback-countdown-block,.arcontactus-widget.arcontactus-message.popup-opened .callback-countdown-block,.arcontactus-widget.arcontactus-message.open .arcontactus-prompt,.arcontactus-widget.arcontactus-message.opened .arcontactus-prompt,.arcontactus-widget.arcontactus-message.popup-opened .arcontactus-prompt,.arcontactus-widget.arcontactus-message.open .arcu-popup,.arcontactus-widget.arcontactus-message.opened .arcu-popup,.arcontactus-widget.arcontactus-message.popup-opened .arcu-popup{width:100%}.arcontactus-widget.arcontactus-message.open .messangers-block .arcontactus-prompt-close,.arcontactus-widget.arcontactus-message.opened .messangers-block .arcontactus-prompt-close,.arcontactus-widget.arcontactus-message.popup-opened .messangers-block .arcontactus-prompt-close,.arcontactus-widget.arcontactus-message.open .callback-countdown-block .arcontactus-prompt-close,.arcontactus-widget.arcontactus-message.opened .callback-countdown-block .arcontactus-prompt-close,.arcontactus-widget.arcontactus-message.popup-opened .callback-countdown-block .arcontactus-prompt-close,.arcontactus-widget.arcontactus-message.open .arcontactus-prompt .arcontactus-prompt-close,.arcontactus-widget.arcontactus-message.opened .arcontactus-prompt .arcontactus-prompt-close,.arcontactus-widget.arcontactus-message.popup-opened .arcontactus-prompt .arcontactus-prompt-close,.arcontactus-widget.arcontactus-message.open .arcu-popup .arcontactus-prompt-close,.arcontactus-widget.arcontactus-message.opened .arcu-popup .arcontactus-prompt-close,.arcontactus-widget.arcontactus-message.popup-opened .arcu-popup .arcontactus-prompt-close{opacity:1}.arcontactus-widget.arcontactus-message.open .arcontactus-message-button,.arcontactus-widget.arcontactus-message.opened .arcontactus-message-button,.arcontactus-widget.arcontactus-message.popup-opened .arcontactus-message-button{display:none}}
@keyframes  arcontactus-updown{0%,43%,100%{transform:translate(0,0)}25%,35%{transform:translate(0,-10px)}}
@-webkit-keyframes arcontactus-updown{0%{transform:translate(0 0)}25%{transform:translate(-10px 0)}35%{transform:translate(-10px 0)}43%{transform:translate(0 0)}100%{transform:translate(0 0)}}
@keyframes  arcontactus-pulse{0%{-webkit-transform:scale(0);transform:scale(0);opacity:1}50%{opacity:.5}100%{-webkit-transform:scale(1);transform:scale(1);opacity:0}}
@-webkit-keyframes arcontactus-show-stat{0%,20%{-webkit-transform:scale(1);transform:scale(1)}21%,84%{-webkit-transform:scale(0);transform:scale(0)}85%,100%{-webkit-transform:scale(1);transform:scale(1)}}
@keyframes  arcontactus-show-stat{0%,20%{-webkit-transform:scale(1);transform:scale(1)}21%,84%{-webkit-transform:scale(0);transform:scale(0)}85%,100%{-webkit-transform:scale(1);transform:scale(1)}}
@-webkit-keyframes arcontactus-show-icons{0%,20%{-webkit-transform:scale(0);transform:scale(0)}21%,84%{-webkit-transform:scale(1);transform:scale(1)}85%,100%{-webkit-transform:scale(0);transform:scale(0)}}
@keyframes  arcontactus-show-icons{0%,20%{-webkit-transform:scale(0);transform:scale(0)}21%,84%{-webkit-transform:scale(1);transform:scale(1)}85%,100%{-webkit-transform:scale(0);transform:scale(0)}}
.arcontactus-widget .arcu-header-close{display:none!important}
</style>
<div id='contact_us'></div>
<script>
	window.addEventListener('load', function () {
		$('#contact_us').on('arcontactus.init', function () {
			$('#contact_us').addClass('arcuAnimated').addClass('flipInY');
			setTimeout(function () {
				$('#contact_us').removeClass('flipInY');
			}, 1000);
		});
		$('#contact_us').contactUs({
			
			align: 'right',
			
			drag: false,
			reCaptcha: false,
			menuSize: 'small',
			buttonSize: 'small',
			buttonText: 'Contact',
			iconsAnimationSpeed: 800,
			menuHeaderText: 'Contact Us',
			itemsIconType: 'rounded',
			countdown: 0,
			showMenuHeader: true,
			showHeaderCloseBtn: true,
			headerCloseBtnColor: '#ffffff',
			headerCloseBtnBgColor: '#0000cd',
			promptPosition: 'side',
			theme: '#0000cd',

			items: [
				/*{
				title: 'Hotline',
				subTitle: '0946 046 086',
				icon: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M493.4 24.6l-104-24c-11.3-2.6-22.9 3.3-27.5 13.9l-48 112c-4.2 9.8-1.4 21.3 6.9 28l60.6 49.6c-36 76.7-98.9 140.5-177.2 177.2l-49.6-60.6c-6.8-8.3-18.2-11.1-28-6.9l-112 48C3.9 366.5-2 378.1.6 389.4l24 104C27.1 504.2 36.7 512 48 512c256.1 0 464-207.5 464-464 0-11.2-7.7-20.9-18.6-23.4z"></path></svg>',
				href: 'tel:0946046086',
				color: '#4EB625'
				},
				
				{
				title: 'Email',
				subTitle: 'binhminhgarden.cskh@gmail.com',
				icon: '<svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M464 64H48C21.5 64 0 85.5 0 112v288c0 26.5 21.5 48 48 48h416c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48zM48 96h416c8.8 0 16 7.2 16 16v41.4c-21.9 18.5-53.2 44-150.6 121.3-16.9 13.4-50.2 45.7-73.4 45.3-23.2.4-56.6-31.9-73.4-45.3C85.2 197.4 53.9 171.9 32 153.4V112c0-8.8 7.2-16 16-16zm416 320H48c-8.8 0-16-7.2-16-16V195c22.8 18.7 58.8 47.6 130.7 104.7 20.5 16.4 56.7 52.5 93.3 52.3 36.4.3 72.3-35.5 93.3-52.3 71.9-57.1 107.9-86 130.7-104.7v205c0 8.8-7.2 16-16 16z"></path></svg>',
				href: 'test@gmail.com',
				color: '#FF643A'
				},
								   
				{
				title: 'Messenger',
				subTitle: 'm.me/',
				icon: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M224 32C15.9 32-77.5 278 84.6 400.6V480l75.7-42c142.2 39.8 285.4-59.9 285.4-198.7C445.8 124.8 346.5 32 224 32zm23.4 278.1L190 250.5 79.6 311.6l121.1-128.5 57.4 59.6 110.4-61.1-121.1 128.5z"></path></svg>',
				href: 'https://m.me/',
				color: '#31ADFF'
				},
				
							   
				{
				title: 'Zalo chat',
				//subTitle: 'https://www.livechat.com/expired-chat-link/?utm_source=expired_chat_link',
				icon: '<svg id="svg_zalo_icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 614.501 613.667" xml:space="preserve"><path fill="currentColor" d="M464.721,301.399c-13.984-0.014-23.707,11.478-23.944,28.312c-0.251,17.771,9.168,29.208,24.037,29.202   c14.287-0.007,23.799-11.095,24.01-27.995C489.028,313.536,479.127,301.399,464.721,301.399z"></path><path path fill="currentColor" d="M291.83,301.392c-14.473-0.316-24.578,11.603-24.604,29.024c-0.02,16.959,9.294,28.259,23.496,28.502   c15.072,0.251,24.592-10.87,24.539-28.707C315.214,313.318,305.769,301.696,291.83,301.392z"></path><path fill="currentColor" d="M310.518,3.158C143.102,3.158,7.375,138.884,7.375,306.3s135.727,303.142,303.143,303.142   c167.415,0,303.143-135.727,303.143-303.142S477.933,3.158,310.518,3.158z M217.858,391.083   c-33.364,0.818-66.828,1.353-100.133-0.343c-21.326-1.095-27.652-18.647-14.248-36.583c21.55-28.826,43.886-57.065,65.792-85.621   c2.546-3.305,6.214-5.996,7.15-12.705c-16.609,0-32.784,0.04-48.958-0.013c-19.195-0.066-28.278-5.805-28.14-17.652   c0.132-11.768,9.175-17.329,28.397-17.348c25.159-0.026,50.324-0.06,75.476,0.026c9.637,0.033,19.604,0.105,25.304,9.789   c6.22,10.561,0.284,19.512-5.646,27.454c-21.26,28.497-43.015,56.624-64.559,84.902c-2.599,3.41-5.119,6.88-9.453,12.725   c23.424,0,44.123-0.053,64.816,0.026c8.674,0.026,16.662,1.873,19.941,11.267C237.892,379.329,231.368,390.752,217.858,391.083z    M350.854,330.211c0,13.417-0.093,26.841,0.039,40.265c0.073,7.599-2.599,13.647-9.512,17.084   c-7.296,3.642-14.71,3.028-20.304-2.968c-3.997-4.281-6.214-3.213-10.488-0.422c-17.955,11.728-39.908,9.96-56.597-3.866   c-29.928-24.789-30.026-74.803-0.211-99.776c16.194-13.562,39.592-15.462,56.709-4.143c3.951,2.619,6.201,4.815,10.396-0.053   c5.39-6.267,13.055-6.761,20.271-3.357c7.454,3.509,9.935,10.165,9.776,18.265C350.67,304.222,350.86,317.217,350.854,330.211z    M395.617,369.579c-0.118,12.837-6.398,19.783-17.196,19.908c-10.779,0.132-17.593-6.966-17.646-19.512   c-0.179-43.352-0.185-86.696,0.007-130.041c0.059-12.256,7.302-19.921,17.896-19.222c11.425,0.752,16.992,7.448,16.992,18.833   c0,22.104,0,44.216,0,66.327C395.677,327.105,395.828,348.345,395.617,369.579z M463.981,391.868   c-34.399-0.336-59.037-26.444-58.786-62.289c0.251-35.66,25.304-60.713,60.383-60.396c34.631,0.304,59.374,26.306,58.998,61.986   C524.207,366.492,498.534,392.205,463.981,391.868z"></path></svg>',
				href: 'https://zalo.me/https://www.livechat.com/expired-chat-link/?utm_source=expired_chat_link',
				color: '#0165f8'
				},
				
				{
				title: 'Telegram',
				//subTitle: '@'+'@cskhnhauyen',
				icon: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M446.7 98.6l-67.6 318.8c-5.1 22.5-18.4 28.1-37.3 17.5l-103-75.9-49.7 47.8c-5.5 5.5-10.1 10.1-20.7 10.1l7.4-104.9 190.9-172.5c8.3-7.4-1.8-11.5-12.9-4.1L117.8 284 16.2 252.2c-22.1-6.9-22.5-22.1 4.6-32.7L418.2 66.4c18.4-6.9 34.5 4.1 28.5 32.2z"></path></svg>',
				href: 'https://t.me/@cskhnhauyen',
				color: '#20AFDE'
				},*/
				{
				title: 'Chat CSKH',
				//subTitle: '',
				icon: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M448 0H64C28.7 0 0 28.7 0 64v288c0 35.3 28.7 64 64 64h96v84c0 7.1 5.8 12 12 12 2.4 0 4.9-.7 7.1-2.4L304 416h144c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64zm32 352c0 17.6-14.4 32-32 32H293.3l-8.5 6.4L192 460v-76H64c-17.6 0-32-14.4-32-32V64c0-17.6 14.4-32 32-32h384c17.6 0 32 14.4 32 32v288zM280 240H136c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h144c4.4 0 8-3.6 8-8v-16c0-4.4-3.6-8-8-8zm96-96H136c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h240c4.4 0 8-3.6 8-8v-16c0-4.4-3.6-8-8-8z"></path></svg>',
				href: 'https://www.livechat.com/expired-chat-link/?utm_source=expired_chat_link',
				color: '#6685AD'
				},
				
			]
			});
	});
</script>-->

</body>

</html>