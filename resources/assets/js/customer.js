/**
Customer script to handle the theme customer
**/

var Customer = function() {

    /**
     * 主题设置
     */
    var handleTheme = function() {

        var panel = $('.theme-panel');

        if ($('body').hasClass('page-boxed') === false) {
            $('.layout-option', panel).val("fluid");
        }

        $('.sidebar-option', panel).val("default");
        $('.page-header-option', panel).val("fixed");
        $('.page-footer-option', panel).val("default");
        if ($('.sidebar-pos-option').attr("disabled") === false) {
            $('.sidebar-pos-option', panel).val(Theme.isRTL() ? 'right' : 'left');
        }

        /**
         * 主题布局设置
         */
        var resetLayout = function() {
            $("body").
            removeClass("page-boxed").
            removeClass("page-footer-fixed").
            removeClass("page-sidebar-fixed").
            removeClass("page-header-fixed").
            removeClass("page-sidebar-reversed");

            $('.page-header > .page-header-inner').removeClass("container");

            if ($('.page-container').parent(".container").size() === 1) {
                $('.page-container').insertAfter('body > .clearfix');
            }

            if ($('.page-footer > .container').size() === 1) {
                $('.page-footer').html($('.page-footer > .container').html());
            } else if ($('.page-footer').parent(".container").size() === 1) {
                $('.page-footer').insertAfter('.page-container');
                $('.scroll-to-top').insertAfter('.page-footer');
            }

             $(".top-menu > .navbar-nav > li.dropdown").removeClass("dropdown-dark");

            $('body > .container').remove();
        };

        var lastSelectedLayout = '';

        var setLayout = function() {

            var layoutOption = $('.layout-option', panel).val();
            var sidebarOption = $('.sidebar-option', panel).val();
            var headerOption = $('.page-header-option', panel).val();
            var footerOption = $('.page-footer-option', panel).val();
            var sidebarPosOption = $('.sidebar-pos-option', panel).val();
            var sidebarStyleOption = $('.sidebar-style-option', panel).val();
            var sidebarMenuOption = $('.sidebar-menu-option', panel).val();
            var headerTopDropdownStyle = $('.page-header-top-dropdown-style-option', panel).val();

            if (sidebarOption == "fixed" && headerOption == "default") {
                alert('Default Header with Fixed Sidebar option is not supported. Proceed with Fixed Header with Fixed Sidebar.');
                $('.page-header-option', panel).val("fixed");
                $('.sidebar-option', panel).val("fixed");
                sidebarOption = 'fixed';
                headerOption = 'fixed';
            }

            resetLayout(); // reset layout to default state

            if (layoutOption === "boxed") {
                $("body").addClass("page-boxed");

                /**
                 * 设置顶部
                 */
                $('.page-header > .page-header-inner').addClass("container");
                var cont = $('body > .clearfix').after('<div class="container"></div>');

                /**
                 * 设置内容
                 */
                $('.page-container').appendTo('body > .container');

                /**
                 * 设置顶部
                 */
                if (footerOption === 'fixed') {
                    $('.page-footer').html('<div class="container">' + $('.page-footer').html() + '</div>');
                } else {
                    $('.page-footer').appendTo('body > .container');
                }
            }

            if (lastSelectedLayout != layoutOption) {
                Theme.runResizeHandlers();
            }
            lastSelectedLayout = layoutOption;

            //header
            if (headerOption === 'fixed') {
                $("body").addClass("page-header-fixed");
                $(".page-header").removeClass("navbar-static-top").addClass("navbar-fixed-top");
            } else {
                $("body").removeClass("page-header-fixed");
                $(".page-header").removeClass("navbar-fixed-top").addClass("navbar-static-top");
            }

            //sidebar
            if ($('body').hasClass('page-full-width') === false) {
                if (sidebarOption === 'fixed') {
                    $("body").addClass("page-sidebar-fixed");
                    $("page-sidebar-menu").addClass("page-sidebar-menu-fixed");
                    $("page-sidebar-menu").removeClass("page-sidebar-menu-default");
                    Layout.initFixedSidebarHoverEffect();
                } else {
                    $("body").removeClass("page-sidebar-fixed");
                    $("page-sidebar-menu").addClass("page-sidebar-menu-default");
                    $("page-sidebar-menu").removeClass("page-sidebar-menu-fixed");
                    $('.page-sidebar-menu').unbind('mouseenter').unbind('mouseleave');
                }
            }

            // top dropdown style
            if (headerTopDropdownStyle === 'dark') {
                $(".top-menu > .navbar-nav > li.dropdown").addClass("dropdown-dark");
            } else {
                $(".top-menu > .navbar-nav > li.dropdown").removeClass("dropdown-dark");
            }

            //footer 
            if (footerOption === 'fixed') {
                $("body").addClass("page-footer-fixed");
            } else {
                $("body").removeClass("page-footer-fixed");
            }

            //sidebar style
            if (sidebarStyleOption === 'light') {
                $(".page-sidebar-menu").addClass("page-sidebar-menu-light");
            } else {
                $(".page-sidebar-menu").removeClass("page-sidebar-menu-light");
            }

            //sidebar menu 
            if (sidebarMenuOption === 'hover') {
                if (sidebarOption == 'fixed') {
                    $('.sidebar-menu-option', panel).val("accordion");
                    alert("Hover Sidebar Menu is not compatible with Fixed Sidebar Mode. Select Default Sidebar Mode Instead.");
                } else {
                    $(".page-sidebar-menu").addClass("page-sidebar-menu-hover-submenu");
                }
            } else {
                $(".page-sidebar-menu").removeClass("page-sidebar-menu-hover-submenu");
            }

            //sidebar position
            if (Theme.isRTL()) {
                if (sidebarPosOption === 'left') {
                    $("body").addClass("page-sidebar-reversed");
                    $('#frontend-link').tooltip('destroy').tooltip({
                        placement: 'right'
                    });
                } else {
                    $("body").removeClass("page-sidebar-reversed");
                    $('#frontend-link').tooltip('destroy').tooltip({
                        placement: 'left'
                    });
                }
            } else {
                if (sidebarPosOption === 'right') {
                    $("body").addClass("page-sidebar-reversed");
                    $('#frontend-link').tooltip('destroy').tooltip({
                        placement: 'left'
                    });
                } else {
                    $("body").removeClass("page-sidebar-reversed");
                    $('#frontend-link').tooltip('destroy').tooltip({
                        placement: 'right'
                    });
                }
            }

            Layout.fixContentHeight(); // fix content height            
            Layout.initFixedSidebar(); // reinitialize fixed sidebar
        };

        /**
         * 设置模板颜色
         */
        var setColor = function(color) {
            var color_ = (Theme.isRTL() ? color + '-rtl' : color);
            var css,data;
            $.ajaxSetup({async:false});
            $.get(Layout.getElixirPath()+'rev-manifest.json',function(e){
                data = e;
            });
            var key = "css/backend/"+color_+".css";
            css = data[key];
            color_ = Layout.getElixirPath() + css;
            $('#style_color').attr("href",  color_);
            if (color == 'light2') {
                $('.page-logo img').attr('src', Layout.getLayoutImgPath() + 'logo-invert.png');
            } else {
                $('.page-logo img').attr('src', Layout.getLayoutImgPath() + 'logo.png');
            }
        };

        $('.toggler', panel).click(function() {
            $('.toggler').hide();
            $('.toggler-close').show();
            $('.theme-panel > .theme-options').show();
        });

        $('.toggler-close', panel).click(function() {
            $('.toggler').show();
            $('.toggler-close').hide();
            $('.theme-panel > .theme-options').hide();
        });

        $('.theme-colors > ul > li', panel).click(function() {
            var color = $(this).attr("data-style");
            setColor(color);
            $('ul > li', panel).removeClass("current");
            $(this).addClass("current");
        });

        // set default theme options:

        if ($("body").hasClass("page-boxed")) {
            $('.layout-option', panel).val("boxed");
        }

        if ($("body").hasClass("page-sidebar-fixed")) {
            $('.sidebar-option', panel).val("fixed");
        }

        if ($("body").hasClass("page-header-fixed")) {
            $('.page-header-option', panel).val("fixed");
        }

        if ($("body").hasClass("page-footer-fixed")) {
            $('.page-footer-option', panel).val("fixed");
        }

        if ($("body").hasClass("page-sidebar-reversed")) {
            $('.sidebar-pos-option', panel).val("right");
        }

        if ($(".page-sidebar-menu").hasClass("page-sidebar-menu-light")) {
            $('.sidebar-style-option', panel).val("light");
        }

        if ($(".page-sidebar-menu").hasClass("page-sidebar-menu-hover-submenu")) {
            $('.sidebar-menu-option', panel).val("hover");
        }

        var sidebarOption = $('.sidebar-option', panel).val();
        var headerOption = $('.page-header-option', panel).val();
        var footerOption = $('.page-footer-option', panel).val();
        var sidebarPosOption = $('.sidebar-pos-option', panel).val();
        var sidebarStyleOption = $('.sidebar-style-option', panel).val();
        var sidebarMenuOption = $('.sidebar-menu-option', panel).val();

        $('.layout-option, .page-header-option, .page-header-top-dropdown-style-option, .sidebar-option, .page-footer-option, .sidebar-pos-option, .sidebar-style-option, .sidebar-menu-option', panel).change(setLayout);
    };

    /**
     * 模板样式设置
     */
    var setThemeStyle = function(style) {
        var file = (style === 'rounded' ? 'components-rounded' : 'components');
        file = (Theme.isRTL() ? file + '-rtl' : file);
        var data;
        $.ajaxSetup({async:false});
        $.get(Layout.getElixirPath()+'rev-manifest.json',function(e){
            data = e;
        });
        var key = "css/backend/"+file+".css";
        file = data[key];
        file = Layout.getElixirPath() + file;
        $('#style_components').attr("href", file);

        if ($.cookie) {
            $.cookie('layout-style-option', style);
        }
    };

    /**
     * 日历设置
     */
    var dashboardDaterange = function(){
        jQuery().daterangepicker&&($("#dashboard-report-range").daterangepicker({
            "autoThemely": true,
            ranges:{
                "今天":[moment(),moment()],
                "昨天":[moment().subtract("days",1),moment().subtract("days",1)],
                "最近7天":[moment().subtract("days",6),moment()],
                "最近30天":[moment().subtract("days",29),moment()]
            },
            locale:{
                format:"YYYY-MM-DD",
                separator:" - ",
                applyLabel:"确定",
                cancelLabel:"取消",
                fromLabel:"开始时间",
                toLabel:"结束时间",
                customRangeLabel:"自定义",
                daysOfWeek:["日","一","二","三","四","五","六"],
                monthNames:["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"],
                firstDay:1
            },
            opens:Theme.isRTL()?"right":"left"
        },function(e,t,a){
            "0"!=$("#dashboard-report-range").attr("data-display-range")&&$("#dashboard-report-range span").html(e.format("YYYY-MM-DD")+" - "+t.format("YYYY-MM-DD"))
        }),
        "0"!=$("#dashboard-report-range").attr("data-display-range")&&$("#dashboard-report-range span").html(moment().subtract("days",29).format("YYYY-MM-DD")+" - "+moment().format("YYYY-MM-DD")),
        $("#dashboard-report-range").show())
    };

    /**
     * 时间设置
     */
    var initPickers = function () {
        $('.date-picker').datepicker({
            rtl: Theme.isRTL(),
            autoclose: true,
            todayBtn: true,
            language: "zh-CN"
        });
    }

    /**
     * 时间设置
     */
    var initTimepicker = function () {
        $('.date-timepicker').datetimepicker({
            rtl: Theme.isRTL(),
            format: "yyyy-mm-dd hh:ii:ss",
            autoclose: true,
            todayBtn: true,
            todayHighlight: true,
            language: "zh-CN"
        });
    }

    return {

        init: function() {
            /**
             * 处理模板风格
             */
            handleTheme(); 
            
            /**
             * 处理主题更换
             */
            $('.theme-panel .layout-style-option').change(function() {
                 setThemeStyle($(this).val());
            });
            
            /**
             * 从cookie读取样式设置
             */
            if ($.cookie && $.cookie('layout-style-option') === 'rounded') {
                setThemeStyle($.cookie('layout-style-option'));
                $('.theme-panel .layout-style-option').val($.cookie('layout-style-option'));
            }
            //日历插件初始化
            dashboardDaterange();     
            //时间插件初始化
            initPickers();
            initTimepicker();
        },
        /**
         * 表单删除
         */
        addDeleteForms: function () {
            $('[data-method="destroy"]').append(function () {
                if (! $(this).find('form').length > 0) {
                    return "\n" +
                        "<form action='" + $(this).attr('href') + "' method='POST' name='delete_item' style='display:none'>\n" +
                        "   <input type='hidden' name='_method' value='delete'>\n" +
                        "   <input type='hidden' name='_token' value='" + $('meta[name="_token"]').attr('content') + "'>\n" +
                        "</form>\n";
                } else {
                    return "";
                }
            })
            .removeAttr('href')
            .attr('style', 'cursor:pointer;')
            .attr('onclick', '$(this).find("form").submit();');

            $('[data-method="delete"]').append(function () {
                if (! $(this).find('form').length > 0) {
                    return "\n" +
                        "<form action='" + $(this).attr('href') + "' method='get' name='delete_item' style='display:none'>\n" +
                        "   <input type='hidden' name='_token' value='" + $('meta[name="_token"]').attr('content') + "'>\n" +
                        "</form>\n";
                } else {
                    return "";
                }
            })
            .removeAttr('href')
            .attr('style', 'cursor:pointer;')
            .attr('onclick', '$(this).find("form").submit();');
        }
    };

}();


$(function(){   
    Theme.init(); // init metronic core components
    Theme.initAjax(); // init after ajax complete
    Layout.init(); // init current layout
    QuickSidebar.init(); // init quick sidebar
    Customer.init(); // init customer features
    Customer.addDeleteForms();

    /**
     * ajax默认添加token
     */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    //绑定所有引导提示
    $("body").tooltip({
        selector: '[data-toggle="tooltip"]'
    });

    //表单提交搜索
    // $('.filter-submit').on('click', function(e) {
    //     $(this).closest('form').submit(function(){
    //         grid.draw();
    //         e.preventDefault();
    //     })
    // });

    /**
     * 删除操作
     */
    $('body').on('submit', 'form[name=delete_item]', function(e){
        e.preventDefault();
        var form = this;
        var link = $('a[data-method="delete"]');
        var cancel = (link.attr('data-trans-button-cancel')) ? link.attr('data-trans-button-cancel') : "返回";
        var confirm = (link.attr('data-trans-button-confirm')) ? link.attr('data-trans-button-confirm') : "确定";
        var title = (link.attr('data-trans-title')) ? link.attr('data-trans-title') : "警告";
        var text = (link.attr('data-trans-text')) ? link.attr('data-trans-text') : "你确定要删除吗？";

        swal({
            title: title,
            text: text,
            type: "warning",
            showCancelButton: true,
            cancelButtonText: cancel,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: confirm,
            closeOnConfirm: true
        }, function(confirmed) {
            if (confirmed)
                form.submit();
        });
    });

    //灯箱插件
    $(document).on('click', '[data-toggle="lightbox"]:not([data-gallery="navigateTo"])', function(event) {
        event.preventDefault();
        return $(this).ekkoLightbox({
        });
    });

    //用户资料
    function formatUser(user) {
        if (user.loading) return user.text;
        var markup = "<div class='select2-result-repository clearfix'>" +
        "<div class='select2-result-repository__avatar'><img src='" + user.avatar + "' /></div>" +
        "<div class='select2-result-repository__meta'>" +
        "<div class='select2-result-repository__title'>" + user.mobile + "</div>";
        if (user.username) {
            markup += "<div class='select2-result-repository__description'>用户名：" + user.username + "</div>";
        }
        markup += "</div></div>";
        return markup;
    }

    function formatUserSelection(user) {
        return user.username || user.mobile || user.text;
    }
    $.fn.select2.defaults.set("theme", "bootstrap");
    $(".user-ajax").select2({
        ajax: {
            url: "/backend/users/ajax",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term, // search term
                    page: params.page
                };
            },
            processResults: function(data, page) {
                return {
                    results: data.data
                };
            },
            cache: true
        },
        escapeMarkup: function(markup) {
            return markup;
        }, // let our custom formatter work
        minimumInputLength: 1,
        templateResult: formatUser,
        templateSelection: formatUserSelection
    });

    //公司资料
    function formatCompany(company) {
        if (company.loading) return company.text;
        var markup = "<div class='select2-result-label'>" +
        "<span class='select2-match'>" + company.name + "</span>" +
        "</div>";
        return markup;
    }

    function formatCompanySelection(company) {
        return company.name || company.text;
    }
    $.fn.select2.defaults.set("theme", "bootstrap");
    $(".company-ajax").select2({
        ajax: {
            url: "/backend/companies/ajax",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term, // search term
                    page: params.page
                };
            },
            processResults: function(data, page) {
                return {
                    results: data.data
                };
            },
            cache: true
        },
        escapeMarkup: function(markup) {
            return markup;
        }, // let our custom formatter work
        minimumInputLength: 1,
        templateResult: formatCompany,
        templateSelection: formatCompanySelection
    });
});
