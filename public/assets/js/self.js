(function (window, document, $, undefined) {
    'use strict';

    let options = {
        appear: function (elements_left, settings) {
            $(this).wrap('<div class="load_box"></div>')
        },
        load: function (elements_left, settings) {
            $(this).unwrap()
        },
        threshold: 200
    };
    // $('img.lazy').lazyload(options);
    // $('img.lazy_side').lazyload(options);

    window.sleep = function (ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }

    window.ajaxError = function (err) {
        let msg;
        // console.log(err);
        switch (err.status) {
            case 401:
                msg = '请在页面顶部右上角头像处，登录';
                break;
            case 422:
                msg = '请填写完整';
                if (err.responseJSON.errors) {
                    let errors = err.responseJSON.errors;
                    for (let e in errors) {
                        if (errors.hasOwnProperty(e)) {
                            msg = errors[e][0];
                            break;
                        }
                    }
                }
                break;
            case 403:
                msg = err.responseJSON.message;
                break;
            case 429:
                msg = '太快，太暴力了，客官慢点';
                break;
            default:
                msg = '失败';
                break;
        }
        window.showMessage(msg);
    }

    window.showMessage = function (str) {
        bs4pop.notice(str, {position: 'bottomcenter', type: 'light', className: 'custom-alert', autoClose: 2000})
    }

    window.showConfirm = function (str, callback) {
        bs4pop.confirm(str, callback, {title: '提示', className: 'custom-modal', isCenter: true})
    }

    $('.collection').click(function () {
        window.showConfirm('收藏本站Ctrl+D,手机请手动添加到收藏夹');
    })

    $('.re-check-friend').click(function () {
        let self = $(this);
        $.ajax({
            method: 'post',
            url: '/friends/' + self.attr('data-key') + '/re-check',
            data: {
                _token: HUB._token,
            },
            success: async function (res) {
                window.showMessage(res.msg)
            },
            error: window.ajaxError
        });
    })
})(window, document, jQuery);
