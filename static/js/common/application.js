(function() {
    var __slice = [].slice;

    (function($, window) {
        "use strict";
        var BootstrapSwitch;
        BootstrapSwitch = (function() {
            function BootstrapSwitch(element, options) {
                if (options == null) {
                    options = {};
                }
                this.$element = $(element);
                this.options = $.extend({}, $.fn.bootstrapSwitch.defaults, {
                    state: this.$element.is(":checked"),
                    size: this.$element.data("size"),
                    animate: this.$element.data("animate"),
                    disabled: this.$element.is(":disabled"),
                    readonly: this.$element.is("[readonly]"),
                    indeterminate: this.$element.data("indeterminate"),
                    onColor: this.$element.data("on-color"),
                    offColor: this.$element.data("off-color"),
                    onText: this.$element.data("on-text"),
                    offText: this.$element.data("off-text"),
                    labelText: this.$element.data("label-text"),
                    baseClass: this.$element.data("base-class"),
                    wrapperClass: this.$element.data("wrapper-class"),
                    radioAllOff: this.$element.data("radio-all-off")
                }, options);
                this.$wrapper = $("<div>", {
                    "class": (function(_this) {
                        return function() {
                            var classes;
                            classes = ["" + _this.options.baseClass].concat(_this._getClasses(_this.options.wrapperClass));
                            classes.push(_this.options.state ? "" + _this.options.baseClass + "-on" : "" + _this.options.baseClass + "-off");
                            if (_this.options.size != null) {
                                classes.push("" + _this.options.baseClass + "-" + _this.options.size);
                            }
                            if (_this.options.animate) {
                                classes.push("" + _this.options.baseClass + "-animate");
                            }
                            if (_this.options.disabled) {
                                classes.push("" + _this.options.baseClass + "-disabled");
                            }
                            if (_this.options.readonly) {
                                classes.push("" + _this.options.baseClass + "-readonly");
                            }
                            if (_this.options.indeterminate) {
                                classes.push("" + _this.options.baseClass + "-indeterminate");
                            }
                            if (_this.$element.attr("id")) {
                                classes.push("" + _this.options.baseClass + "-id-" + (_this.$element.attr("id")));
                            }
                            return classes.join(" ");
                        };
                    })(this)()
                });
                this.$container = $("<div>", {
                    "class": "" + this.options.baseClass + "-container"
                });
                this.$on = $("<span>", {
                    html: this.options.onText,
                    "class": "" + this.options.baseClass + "-handle-on " + this.options.baseClass + "-" + this.options.onColor
                });
                this.$off = $("<span>", {
                    html: this.options.offText,
                    "class": "" + this.options.baseClass + "-handle-off " + this.options.baseClass + "-" + this.options.offColor
                });
                this.$label = $("<label>", {
                    html: this.options.labelText,
                    "class": "" + this.options.baseClass + "-label"
                });
                if (this.options.indeterminate) {
                    this.$element.prop("indeterminate", true);
                }
                this.$element.on("init.bootstrapSwitch", (function(_this) {
                    return function() {
                        return _this.options.onInit.apply(element, arguments);
                    };
                })(this));
                this.$element.on("switchChange.bootstrapSwitch", (function(_this) {
                    return function() {
                        return _this.options.onSwitchChange.apply(element, arguments);
                    };
                })(this));
                this.$container = this.$element.wrap(this.$container).parent();
                this.$wrapper = this.$container.wrap(this.$wrapper).parent();
                this.$element.before(this.$on).before(this.$label).before(this.$off).trigger("init.bootstrapSwitch");
                this._elementHandlers();
                this._handleHandlers();
                this._labelHandlers();
                this._formHandler();
            }

            BootstrapSwitch.prototype._constructor = BootstrapSwitch;

            BootstrapSwitch.prototype.state = function(value, skip) {
                if (typeof value === "undefined") {
                    return this.options.state;
                }
                if (this.options.disabled || this.options.readonly || this.options.indeterminate) {
                    return this.$element;
                }
                if (this.options.state && !this.options.radioAllOff && this.$element.is(':radio')) {
                    return this.$element;
                }
                value = !!value;
                this.$element.prop("checked", value).trigger("change.bootstrapSwitch", skip);
                return this.$element;
            };

            BootstrapSwitch.prototype.toggleState = function(skip) {
                if (this.options.disabled || this.options.readonly || this.options.indeterminate) {
                    return this.$element;
                }
                return this.$element.prop("checked", !this.options.state).trigger("change.bootstrapSwitch", skip);
            };

            BootstrapSwitch.prototype.size = function(value) {
                if (typeof value === "undefined") {
                    return this.options.size;
                }
                if (this.options.size != null) {
                    this.$wrapper.removeClass("" + this.options.baseClass + "-" + this.options.size);
                }
                if (value) {
                    this.$wrapper.addClass("" + this.options.baseClass + "-" + value);
                }
                this.options.size = value;
                return this.$element;
            };

            BootstrapSwitch.prototype.animate = function(value) {
                if (typeof value === "undefined") {
                    return this.options.animate;
                }
                value = !!value;
                this.$wrapper[value ? "addClass" : "removeClass"]("" + this.options.baseClass + "-animate");
                this.options.animate = value;
                return this.$element;
            };

            BootstrapSwitch.prototype.disabled = function(value) {
                if (typeof value === "undefined") {
                    return this.options.disabled;
                }
                value = !!value;
                this.$wrapper[value ? "addClass" : "removeClass"]("" + this.options.baseClass + "-disabled");
                this.$element.prop("disabled", value);
                this.options.disabled = value;
                return this.$element;
            };

            BootstrapSwitch.prototype.toggleDisabled = function() {
                this.$element.prop("disabled", !this.options.disabled);
                this.$wrapper.toggleClass("" + this.options.baseClass + "-disabled");
                this.options.disabled = !this.options.disabled;
                return this.$element;
            };

            BootstrapSwitch.prototype.readonly = function(value) {
                if (typeof value === "undefined") {
                    return this.options.readonly;
                }
                value = !!value;
                this.$wrapper[value ? "addClass" : "removeClass"]("" + this.options.baseClass + "-readonly");
                this.$element.prop("readonly", value);
                this.options.readonly = value;
                return this.$element;
            };

            BootstrapSwitch.prototype.toggleReadonly = function() {
                this.$element.prop("readonly", !this.options.readonly);
                this.$wrapper.toggleClass("" + this.options.baseClass + "-readonly");
                this.options.readonly = !this.options.readonly;
                return this.$element;
            };

            BootstrapSwitch.prototype.indeterminate = function(value) {
                if (typeof value === "undefined") {
                    return this.options.indeterminate;
                }
                value = !!value;
                this.$wrapper[value ? "addClass" : "removeClass"]("" + this.options.baseClass + "-indeterminate");
                this.$element.prop("indeterminate", value);
                this.options.indeterminate = value;
                return this.$element;
            };

            BootstrapSwitch.prototype.toggleIndeterminate = function() {
                this.$element.prop("indeterminate", !this.options.indeterminate);
                this.$wrapper.toggleClass("" + this.options.baseClass + "-indeterminate");
                this.options.indeterminate = !this.options.indeterminate;
                return this.$element;
            };

            BootstrapSwitch.prototype.onColor = function(value) {
                var color;
                color = this.options.onColor;
                if (typeof value === "undefined") {
                    return color;
                }
                if (color != null) {
                    this.$on.removeClass("" + this.options.baseClass + "-" + color);
                }
                this.$on.addClass("" + this.options.baseClass + "-" + value);
                this.options.onColor = value;
                return this.$element;
            };

            BootstrapSwitch.prototype.offColor = function(value) {
                var color;
                color = this.options.offColor;
                if (typeof value === "undefined") {
                    return color;
                }
                if (color != null) {
                    this.$off.removeClass("" + this.options.baseClass + "-" + color);
                }
                this.$off.addClass("" + this.options.baseClass + "-" + value);
                this.options.offColor = value;
                return this.$element;
            };

            BootstrapSwitch.prototype.onText = function(value) {
                if (typeof value === "undefined") {
                    return this.options.onText;
                }
                this.$on.html(value);
                this.options.onText = value;
                return this.$element;
            };

            BootstrapSwitch.prototype.offText = function(value) {
                if (typeof value === "undefined") {
                    return this.options.offText;
                }
                this.$off.html(value);
                this.options.offText = value;
                return this.$element;
            };

            BootstrapSwitch.prototype.labelText = function(value) {
                if (typeof value === "undefined") {
                    return this.options.labelText;
                }
                this.$label.html(value);
                this.options.labelText = value;
                return this.$element;
            };

            BootstrapSwitch.prototype.baseClass = function(value) {
                return this.options.baseClass;
            };

            BootstrapSwitch.prototype.wrapperClass = function(value) {
                if (typeof value === "undefined") {
                    return this.options.wrapperClass;
                }
                if (!value) {
                    value = $.fn.bootstrapSwitch.defaults.wrapperClass;
                }
                this.$wrapper.removeClass(this._getClasses(this.options.wrapperClass).join(" "));
                this.$wrapper.addClass(this._getClasses(value).join(" "));
                this.options.wrapperClass = value;
                return this.$element;
            };

            BootstrapSwitch.prototype.radioAllOff = function(value) {
                if (typeof value === "undefined") {
                    return this.options.radioAllOff;
                }
                this.options.radioAllOff = value;
                return this.$element;
            };

            BootstrapSwitch.prototype.onInit = function(value) {
                if (typeof value === "undefined") {
                    return this.options.onInit;
                }
                if (!value) {
                    value = $.fn.bootstrapSwitch.defaults.onInit;
                }
                this.options.onInit = value;
                return this.$element;
            };

            BootstrapSwitch.prototype.onSwitchChange = function(value) {
                if (typeof value === "undefined") {
                    return this.options.onSwitchChange;
                }
                if (!value) {
                    value = $.fn.bootstrapSwitch.defaults.onSwitchChange;
                }
                this.options.onSwitchChange = value;
                return this.$element;
            };

            BootstrapSwitch.prototype.destroy = function() {
                var $form;
                $form = this.$element.closest("form");
                if ($form.length) {
                    $form.off("reset.bootstrapSwitch").removeData("bootstrap-switch");
                }
                this.$container.children().not(this.$element).remove();
                this.$element.unwrap().unwrap().off(".bootstrapSwitch").removeData("bootstrap-switch");
                return this.$element;
            };

            BootstrapSwitch.prototype._elementHandlers = function() {
                return this.$element.on({
                    "change.bootstrapSwitch": (function(_this) {
                        return function(e, skip) {
                            var checked;
                            e.preventDefault();
                            e.stopImmediatePropagation();
                            checked = _this.$element.is(":checked");
                            if (checked === _this.options.state) {
                                return;
                            }
                            _this.options.state = checked;
                            _this.$wrapper.removeClass(checked ? "" + _this.options.baseClass + "-off" : "" + _this.options.baseClass + "-on").addClass(checked ? "" + _this.options.baseClass + "-on" : "" + _this.options.baseClass + "-off");
                            if (!skip) {
                                if (_this.$element.is(":radio")) {
                                    $("[name='" + (_this.$element.attr('name')) + "']").not(_this.$element).prop("checked", false).trigger("change.bootstrapSwitch", true);
                                }
                                return _this.$element.trigger("switchChange.bootstrapSwitch", [checked]);
                            }
                        };
                    })(this),
                    "focus.bootstrapSwitch": (function(_this) {
                        return function(e) {
                            e.preventDefault();
                            return _this.$wrapper.addClass("" + _this.options.baseClass + "-focused");
                        };
                    })(this),
                    "blur.bootstrapSwitch": (function(_this) {
                        return function(e) {
                            e.preventDefault();
                            return _this.$wrapper.removeClass("" + _this.options.baseClass + "-focused");
                        };
                    })(this),
                    "keydown.bootstrapSwitch": (function(_this) {
                        return function(e) {
                            if (!e.which || _this.options.disabled || _this.options.readonly || _this.options.indeterminate) {
                                return;
                            }
                            switch (e.which) {
                                case 37:
                                    e.preventDefault();
                                    e.stopImmediatePropagation();
                                    return _this.state(false);
                                case 39:
                                    e.preventDefault();
                                    e.stopImmediatePropagation();
                                    return _this.state(true);
                            }
                        };
                    })(this)
                });
            };

            BootstrapSwitch.prototype._handleHandlers = function() {
                this.$on.on("click.bootstrapSwitch", (function(_this) {
                    return function(e) {
                        _this.state(false);
                        return _this.$element.trigger("focus.bootstrapSwitch");
                    };
                })(this));
                return this.$off.on("click.bootstrapSwitch", (function(_this) {
                    return function(e) {
                        _this.state(true);
                        return _this.$element.trigger("focus.bootstrapSwitch");
                    };
                })(this));
            };

            BootstrapSwitch.prototype._labelHandlers = function() {
                return this.$label.on({
                    "mousemove.bootstrapSwitch touchmove.bootstrapSwitch": (function(_this) {
                        return function(e) {
                            var left, pageX, percent, right;
                            if (!_this.isLabelDragging) {
                                return;
                            }
                            e.preventDefault();
                            _this.isLabelDragged = true;
                            pageX = e.pageX || e.originalEvent.touches[0].pageX;
                            percent = ((pageX - _this.$wrapper.offset().left) / _this.$wrapper.width()) * 100;
                            left = 25;
                            right = 75;
                            if (_this.options.animate) {
                                _this.$wrapper.removeClass("" + _this.options.baseClass + "-animate");
                            }
                            if (percent < left) {
                                percent = left;
                            } else if (percent > right) {
                                percent = right;
                            }
                            _this.$container.css("margin-left", "" + (percent - right) + "%");
                            return _this.$element.trigger("focus.bootstrapSwitch");
                        };
                    })(this),
                    "mousedown.bootstrapSwitch touchstart.bootstrapSwitch": (function(_this) {
                        return function(e) {
                            if (_this.isLabelDragging || _this.options.disabled || _this.options.readonly || _this.options.indeterminate) {
                                return;
                            }
                            e.preventDefault();
                            _this.isLabelDragging = true;
                            return _this.$element.trigger("focus.bootstrapSwitch");
                        };
                    })(this),
                    "mouseup.bootstrapSwitch touchend.bootstrapSwitch": (function(_this) {
                        return function(e) {
                            if (!_this.isLabelDragging) {
                                return;
                            }
                            e.preventDefault();
                            if (_this.isLabelDragged) {
                                _this.isLabelDragged = false;
                                _this.state(parseInt(_this.$container.css("margin-left"), 10) > -(_this.$container.width() / 6));
                                if (_this.options.animate) {
                                    _this.$wrapper.addClass("" + _this.options.baseClass + "-animate");
                                }
                                _this.$container.css("margin-left", "");
                            } else {
                                _this.state(!_this.options.state);
                            }
                            return _this.isLabelDragging = false;
                        };
                    })(this),
                    "mouseleave.bootstrapSwitch": (function(_this) {
                        return function(e) {
                            return _this.$label.trigger("mouseup.bootstrapSwitch");
                        };
                    })(this)
                });
            };

            BootstrapSwitch.prototype._formHandler = function() {
                var $form;
                $form = this.$element.closest("form");
                if ($form.data("bootstrap-switch")) {
                    return;
                }
                return $form.on("reset.bootstrapSwitch", function() {
                    return window.setTimeout(function() {
                        return $form.find("input").filter(function() {
                            return $(this).data("bootstrap-switch");
                        }).each(function() {
                            return $(this).bootstrapSwitch("state", this.checked);
                        });
                    }, 1);
                }).data("bootstrap-switch", true);
            };

            BootstrapSwitch.prototype._getClasses = function(classes) {
                var c, cls, _i, _len;
                if (!$.isArray(classes)) {
                    return ["" + this.options.baseClass + "-" + classes];
                }
                cls = [];
                for (_i = 0, _len = classes.length; _i < _len; _i++) {
                    c = classes[_i];
                    cls.push("" + this.options.baseClass + "-" + c);
                }
                return cls;
            };

            return BootstrapSwitch;

        })();
        $.fn.bootstrapSwitch = function() {
            var args, option, ret;
            option = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
            ret = this;
            this.each(function() {
                var $this, data;
                $this = $(this);
                data = $this.data("bootstrap-switch");
                if (!data) {
                    $this.data("bootstrap-switch", data = new BootstrapSwitch(this, option));
                }
                if (typeof option === "string") {
                    return ret = data[option].apply(data, args);
                }
            });
            return ret;
        };
        $.fn.bootstrapSwitch.Constructor = BootstrapSwitch;
        return $.fn.bootstrapSwitch.defaults = {
            state: true,
            size: null,
            animate: true,
            disabled: false,
            readonly: false,
            indeterminate: false,
            onColor: "primary",
            offColor: "default",
            onText: "ON",
            offText: "OFF",
            labelText: "&nbsp;",
            baseClass: "bootstrap-switch",
            wrapperClass: "wrapper",
            radioAllOff: false,
            onInit: function() {},
            onSwitchChange: function() {}
        };
    })(window.jQuery, window);

}).call(this);

(function ($) {
    "use strict";

    var defaultOptions = {
        tagClass: function(item) {
            return 'label label-info';
        },
        itemValue: function(item) {
            return item ? item.toString() : item;
        },
        itemText: function(item) {
            return this.itemValue(item);
        },
        freeInput: true,
        addOnBlur: true,
        maxTags: undefined,
        maxChars: undefined,
        confirmKeys: [13, 44],
        onTagExists: function(item, $tag) {
            $tag.hide().fadeIn();
        },
        trimValue: false,
        allowDuplicates: false
    };

    /**
     * Constructor function
     */
    function TagsInput(element, options) {
        this.itemsArray = [];

        this.$element = $(element);
        this.$element.hide();

        this.isSelect = (element.tagName === 'SELECT');
        this.multiple = (this.isSelect && element.hasAttribute('multiple'));
        this.objectItems = options && options.itemValue;
        this.placeholderText = element.hasAttribute('placeholder') ? this.$element.attr('placeholder') : '';
        this.inputSize = Math.max(1, this.placeholderText.length);

        this.$container = $('<div class="bootstrap-tagsinput"></div>');
        this.$input = $('<input type="text" placeholder="' + this.placeholderText + '"/>').appendTo(this.$container);

        this.$element.after(this.$container);

        var inputWidth = (this.inputSize < 3 ? 3 : this.inputSize) + "em";
        this.$input.get(0).style.cssText = "width: " + inputWidth + " !important;";
        this.build(options);
    }

    TagsInput.prototype = {
        constructor: TagsInput,

        /**
         * Adds the given item as a new tag. Pass true to dontPushVal to prevent
         * updating the elements val()
         */
        add: function(item, dontPushVal) {
            var self = this;

            if (self.options.maxTags && self.itemsArray.length >= self.options.maxTags)
                return;

            // Ignore falsey values, except false
            if (item !== false && !item)
                return;

            // Trim value
            if (typeof item === "string" && self.options.trimValue) {
                item = $.trim(item);
            }

            // Throw an error when trying to add an object while the itemValue option was not set
            if (typeof item === "object" && !self.objectItems)
                throw("Can't add objects when itemValue option is not set");

            // Ignore strings only containg whitespace
            if (item.toString().match(/^\s*$/))
                return;

            // If SELECT but not multiple, remove current tag
            if (self.isSelect && !self.multiple && self.itemsArray.length > 0)
                self.remove(self.itemsArray[0]);

            if (typeof item === "string" && this.$element[0].tagName === 'INPUT') {
                var items = item.split(',');
                if (items.length > 1) {
                    for (var i = 0; i < items.length; i++) {
                        this.add(items[i], true);
                    }

                    if (!dontPushVal)
                        self.pushVal();
                    return;
                }
            }

            var itemValue = self.options.itemValue(item),
                itemText = self.options.itemText(item),
                tagClass = self.options.tagClass(item);

            // Ignore items allready added
            var existing = $.grep(self.itemsArray, function(item) { return self.options.itemValue(item) === itemValue; } )[0];
            if (existing && !self.options.allowDuplicates) {
                // Invoke onTagExists
                if (self.options.onTagExists) {
                    var $existingTag = $(".tag", self.$container).filter(function() { return $(this).data("item") === existing; });
                    self.options.onTagExists(item, $existingTag);
                }
                return;
            }

            // if length greater than limit
            if (self.items().toString().length + item.length + 1 > self.options.maxInputLength)
                return;

            // raise beforeItemAdd arg
            var beforeItemAddEvent = $.Event('beforeItemAdd', { item: item, cancel: false });
            self.$element.trigger(beforeItemAddEvent);
            if (beforeItemAddEvent.cancel)
                return;

            // register item in internal array and map
            self.itemsArray.push(item);

            // add a tag element
            var $tag = $('<span class="tag ' + htmlEncode(tagClass) + '">' + htmlEncode(itemText) + '<span data-role="remove"></span></span>');
            $tag.data('item', item);
            self.findInputWrapper().before($tag);
            $tag.after(' ');

            // add <option /> if item represents a value not present in one of the <select />'s options
            if (self.isSelect && !$('option[value="' + encodeURIComponent(itemValue) + '"]',self.$element)[0]) {
                var $option = $('<option selected>' + htmlEncode(itemText) + '</option>');
                $option.data('item', item);
                $option.attr('value', itemValue);
                self.$element.append($option);
            }

            if (!dontPushVal)
                self.pushVal();

            // Add class when reached maxTags
            if (self.options.maxTags === self.itemsArray.length || self.items().toString().length === self.options.maxInputLength)
                self.$container.addClass('bootstrap-tagsinput-max');

            self.$element.trigger($.Event('itemAdded', { item: item }));
        },

        /**
         * Removes the given item. Pass true to dontPushVal to prevent updating the
         * elements val()
         */
        remove: function(item, dontPushVal) {
            var self = this;

            if (self.objectItems) {
                if (typeof item === "object")
                    item = $.grep(self.itemsArray, function(other) { return self.options.itemValue(other) ==  self.options.itemValue(item); } );
                else
                    item = $.grep(self.itemsArray, function(other) { return self.options.itemValue(other) ==  item; } );

                item = item[item.length-1];
            }

            if (item) {
                var beforeItemRemoveEvent = $.Event('beforeItemRemove', { item: item, cancel: false });
                self.$element.trigger(beforeItemRemoveEvent);
                if (beforeItemRemoveEvent.cancel)
                    return;

                $('.tag', self.$container).filter(function() { return $(this).data('item') === item; }).remove();
                $('option', self.$element).filter(function() { return $(this).data('item') === item; }).remove();
                if($.inArray(item, self.itemsArray) !== -1)
                    self.itemsArray.splice($.inArray(item, self.itemsArray), 1);
            }

            if (!dontPushVal)
                self.pushVal();

            // Remove class when reached maxTags
            if (self.options.maxTags > self.itemsArray.length)
                self.$container.removeClass('bootstrap-tagsinput-max');

            self.$element.trigger($.Event('itemRemoved',  { item: item }));
        },

        /**
         * Removes all items
         */
        removeAll: function() {
            var self = this;

            $('.tag', self.$container).remove();
            $('option', self.$element).remove();

            while(self.itemsArray.length > 0)
                self.itemsArray.pop();

            self.pushVal();
        },

        /**
         * Refreshes the tags so they match the text/value of their corresponding
         * item.
         */
        refresh: function() {
            var self = this;
            $('.tag', self.$container).each(function() {
                var $tag = $(this),
                    item = $tag.data('item'),
                    itemValue = self.options.itemValue(item),
                    itemText = self.options.itemText(item),
                    tagClass = self.options.tagClass(item);

                // Update tag's class and inner text
                $tag.attr('class', null);
                $tag.addClass('tag ' + htmlEncode(tagClass));
                $tag.contents().filter(function() {
                    return this.nodeType == 3;
                })[0].nodeValue = htmlEncode(itemText);

                if (self.isSelect) {
                    var option = $('option', self.$element).filter(function() { return $(this).data('item') === item; });
                    option.attr('value', itemValue);
                }
            });
        },

        /**
         * Returns the items added as tags
         */
        items: function() {
            return this.itemsArray;
        },

        /**
         * Assembly value by retrieving the value of each item, and set it on the
         * element.
         */
        pushVal: function() {
            var self = this,
                val = $.map(self.items(), function(item) {
                    return self.options.itemValue(item).toString();
                });

            self.$element.val(val, true).trigger('change');
        },

        /**
         * Initializes the tags input behaviour on the element
         */
        build: function(options) {
            var self = this;

            self.options = $.extend({}, defaultOptions, options);
            // When itemValue is set, freeInput should always be false
            if (self.objectItems)
                self.options.freeInput = false;

            makeOptionItemFunction(self.options, 'itemValue');
            makeOptionItemFunction(self.options, 'itemText');
            makeOptionFunction(self.options, 'tagClass');

            // Typeahead Bootstrap version 2.3.2
            if (self.options.typeahead) {
                var typeahead = self.options.typeahead || {};

                makeOptionFunction(typeahead, 'source');

                self.$input.typeahead($.extend({}, typeahead, {
                    source: function (query, process) {
                        function processItems(items) {
                            var texts = [];

                            for (var i = 0; i < items.length; i++) {
                                var text = self.options.itemText(items[i]);
                                map[text] = items[i];
                                texts.push(text);
                            }
                            process(texts);
                        }

                        this.map = {};
                        var map = this.map,
                            data = typeahead.source(query);

                        if ($.isFunction(data.success)) {
                            // support for Angular callbacks
                            data.success(processItems);
                        } else if ($.isFunction(data.then)) {
                            // support for Angular promises
                            data.then(processItems);
                        } else {
                            // support for functions and jquery promises
                            $.when(data)
                                .then(processItems);
                        }
                    },
                    updater: function (text) {
                        self.add(this.map[text]);
                    },
                    matcher: function (text) {
                        return (text.toLowerCase().indexOf(this.query.trim().toLowerCase()) !== -1);
                    },
                    sorter: function (texts) {
                        return texts.sort();
                    },
                    highlighter: function (text) {
                        var regex = new RegExp( '(' + this.query + ')', 'gi' );
                        return text.replace( regex, "<strong>$1</strong>" );
                    }
                }));
            }

            // typeahead.js
            if (self.options.typeaheadjs) {
                var typeaheadjs = self.options.typeaheadjs || {};

                self.$input.typeahead(null, typeaheadjs).on('typeahead:selected', $.proxy(function (obj, datum) {
                    if (typeaheadjs.valueKey)
                        self.add(datum[typeaheadjs.valueKey]);
                    else
                        self.add(datum);
                    self.$input.typeahead('val', '');
                }, self));
            }

            self.$container.on('click', $.proxy(function(event) {
                if (! self.$element.attr('disabled')) {
                    self.$input.removeAttr('disabled');
                }
                self.$input.focus();
            }, self));

            if (self.options.addOnBlur && self.options.freeInput) {
                self.$input.on('focusout', $.proxy(function(event) {
                    // HACK: only process on focusout when no typeahead opened, to
                    //       avoid adding the typeahead text as tag
                    if ($('.typeahead, .twitter-typeahead', self.$container).length === 0) {
                        self.add(self.$input.val());
                        self.$input.val('');
                    }
                }, self));
            }


            self.$container.on('keydown', 'input', $.proxy(function(event) {
                var $input = $(event.target),
                    $inputWrapper = self.findInputWrapper();

                if (self.$element.attr('disabled')) {
                    self.$input.attr('disabled', 'disabled');
                    return;
                }

                switch (event.which) {
                    // BACKSPACE
                    case 8:
                        if (doGetCaretPosition($input[0]) === 0) {
                            var prev = $inputWrapper.prev();
                            if (prev) {
                                self.remove(prev.data('item'));
                            }
                        }
                        break;

                    // DELETE
                    case 46:
                        if (doGetCaretPosition($input[0]) === 0) {
                            var next = $inputWrapper.next();
                            if (next) {
                                self.remove(next.data('item'));
                            }
                        }
                        break;

                    // LEFT ARROW
                    case 37:
                        // Try to move the input before the previous tag
                        var $prevTag = $inputWrapper.prev();
                        if ($input.val().length === 0 && $prevTag[0]) {
                            $prevTag.before($inputWrapper);
                            $input.focus();
                        }
                        break;
                    // RIGHT ARROW
                    case 39:
                        // Try to move the input after the next tag
                        var $nextTag = $inputWrapper.next();
                        if ($input.val().length === 0 && $nextTag[0]) {
                            $nextTag.after($inputWrapper);
                            $input.focus();
                        }
                        break;
                    default:
                    // ignore
                }

                // Reset internal input's size
                var textLength = $input.val().length,
                    wordSpace = Math.ceil(textLength / 5),
                    size = textLength + wordSpace + 1;
                $input.attr('size', Math.max(this.inputSize, $input.val().length));
            }, self));

            self.$container.on('keypress', 'input', $.proxy(function(event) {
                var $input = $(event.target);

                if (self.$element.attr('disabled')) {
                    self.$input.attr('disabled', 'disabled');
                    return;
                }

                var text = $input.val(),
                    maxLengthReached = self.options.maxChars && text.length >= self.options.maxChars;
                if (self.options.freeInput && (keyCombinationInList(event, self.options.confirmKeys) || maxLengthReached)) {
                    self.add(maxLengthReached ? text.substr(0, self.options.maxChars) : text);
                    $input.val('');
                    event.preventDefault();
                }

                // Reset internal input's size
                var textLength = $input.val().length,
                    wordSpace = Math.ceil(textLength / 5),
                    size = textLength + wordSpace + 1;
                $input.attr('size', Math.max(this.inputSize, $input.val().length));
            }, self));

            // Remove icon clicked
            self.$container.on('click', '[data-role=remove]', $.proxy(function(event) {
                if (self.$element.attr('disabled')) {
                    return;
                }
                self.remove($(event.target).closest('.tag').data('item'));
            }, self));

            // Only add existing value as tags when using strings as tags
            if (self.options.itemValue === defaultOptions.itemValue) {
                if (self.$element[0].tagName === 'INPUT') {
                    self.add(self.$element.val());
                } else {
                    $('option', self.$element).each(function() {
                        self.add($(this).attr('value'), true);
                    });
                }
            }
        },

        /**
         * Removes all tagsinput behaviour and unregsiter all event handlers
         */
        destroy: function() {
            var self = this;

            // Unbind events
            self.$container.off('keypress', 'input');
            self.$container.off('click', '[role=remove]');

            self.$container.remove();
            self.$element.removeData('tagsinput');
            self.$element.show();
        },

        /**
         * Sets focus on the tagsinput
         */
        focus: function() {
            this.$input.focus();
        },

        /**
         * Returns the internal input element
         */
        input: function() {
            return this.$input;
        },

        /**
         * Returns the element which is wrapped around the internal input. This
         * is normally the $container, but typeahead.js moves the $input element.
         */
        findInputWrapper: function() {
            var elt = this.$input[0],
                container = this.$container[0];
            while(elt && elt.parentNode !== container)
                elt = elt.parentNode;

            return $(elt);
        }
    };

    /**
     * Register JQuery plugin
     */
    $.fn.tagsinput = function(arg1, arg2) {
        var results = [];

        this.each(function() {
            var tagsinput = $(this).data('tagsinput');
            // Initialize a new tags input
            if (!tagsinput) {
                tagsinput = new TagsInput(this, arg1);
                $(this).data('tagsinput', tagsinput);
                results.push(tagsinput);

                if (this.tagName === 'SELECT') {
                    $('option', $(this)).attr('selected', 'selected');
                }

                // Init tags from $(this).val()
                $(this).val($(this).val());
            } else if (!arg1 && !arg2) {
                // tagsinput already exists
                // no function, trying to init
                results.push(tagsinput);
            } else if(tagsinput[arg1] !== undefined) {
                // Invoke function on existing tags input
                var retVal = tagsinput[arg1](arg2);
                if (retVal !== undefined)
                    results.push(retVal);
            }
        });

        if ( typeof arg1 == 'string') {
            // Return the results from the invoked function calls
            return results.length > 1 ? results : results[0];
        } else {
            return results;
        }
    };

    $.fn.tagsinput.Constructor = TagsInput;

    /**
     * Most options support both a string or number as well as a function as
     * option value. This function makes sure that the option with the given
     * key in the given options is wrapped in a function
     */
    function makeOptionItemFunction(options, key) {
        if (typeof options[key] !== 'function') {
            var propertyName = options[key];
            options[key] = function(item) { return item[propertyName]; };
        }
    }
    function makeOptionFunction(options, key) {
        if (typeof options[key] !== 'function') {
            var value = options[key];
            options[key] = function() { return value; };
        }
    }
    /**
     * HtmlEncodes the given value
     */
    var htmlEncodeContainer = $('<div />');
    function htmlEncode(value) {
        if (value) {
            return htmlEncodeContainer.text(value).html();
        } else {
            return '';
        }
    }

    /**
     * Returns the position of the caret in the given input field
     * http://flightschool.acylt.com/devnotes/caret-position-woes/
     */
    function doGetCaretPosition(oField) {
        var iCaretPos = 0;
        if (document.selection) {
            oField.focus ();
            var oSel = document.selection.createRange();
            oSel.moveStart ('character', -oField.value.length);
            iCaretPos = oSel.text.length;
        } else if (oField.selectionStart || oField.selectionStart == '0') {
            iCaretPos = oField.selectionStart;
        }
        return (iCaretPos);
    }

    /**
     * Returns boolean indicates whether user has pressed an expected key combination.
     * @param object keyPressEvent: JavaScript event object, refer
     *     http://www.w3.org/TR/2003/WD-DOM-Level-3-Events-20030331/ecma-script-binding.html
     * @param object lookupList: expected key combinations, as in:
     *     [13, {which: 188, shiftKey: true}]
     */
    function keyCombinationInList(keyPressEvent, lookupList) {
        var found = false;
        $.each(lookupList, function (index, keyCombination) {
            if (typeof (keyCombination) === 'number' && keyPressEvent.which === keyCombination) {
                found = true;
                return false;
            }

            if (keyPressEvent.which === keyCombination.which) {
                var alt = !keyCombination.hasOwnProperty('altKey') || keyPressEvent.altKey === keyCombination.altKey,
                    shift = !keyCombination.hasOwnProperty('shiftKey') || keyPressEvent.shiftKey === keyCombination.shiftKey,
                    ctrl = !keyCombination.hasOwnProperty('ctrlKey') || keyPressEvent.ctrlKey === keyCombination.ctrlKey;
                if (alt && shift && ctrl) {
                    found = true;
                    return false;
                }
            }
        });

        return found;
    }

    /**
     * Initialize tagsinput behaviour on inputs and selects which have
     * data-role=tagsinput
     */
    $(function() {
        $("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();
    });
})(window.jQuery);



