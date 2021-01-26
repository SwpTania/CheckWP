
function ouibounce(el, custom_config) {
  "use strict";

  var config     = custom_config || {},
    aggressive   = config.aggressive || false,
    sensitivity  = setDefault(config.sensitivity, 20),
    timer        = setDefault(config.timer, 1000),
    delay        = setDefault(config.delay, 0),
    callback     = config.callback || function() {},
    cookieExpire = setDefaultCookieExpire(config.cookieExpire) || '',
    cookieDomain = config.cookieDomain ? ';domain=' + config.cookieDomain : '',
    cookieName   = config.cookieName ? config.cookieName : 'viewedOuibounceModal',
    sitewide     = config.sitewide === true ? ';path=/' : '',
    _delayTimer  = null,
    _html        = document.documentElement;

  function setDefault(_property, _default) {
    return typeof _property === 'undefined' ? _default : _property;
  }

  function setDefaultCookieExpire(days) {
    // transform days to milliseconds
    var ms = days*24*60*60*1000;

    var date = new Date();
    date.setTime(date.getTime() + ms);

    return "; expires=" + date.toUTCString();
  }

  setTimeout(attachOuiBounce, timer);
  function attachOuiBounce() {
    if (isDisabled()) { return; }

    _html.addEventListener('mouseleave', handleMouseleave);
    _html.addEventListener('mouseenter', handleMouseenter);
    _html.addEventListener('keydown', handleKeydown);
  }

  function handleMouseleave(e) {
    if (e.clientY > sensitivity) { return; }

    _delayTimer = setTimeout(fire, delay);
  }

  function handleMouseenter() {
    if (_delayTimer) {
      clearTimeout(_delayTimer);
      _delayTimer = null;
    }
  }

  var disableKeydown = false;
  function handleKeydown(e) {
    if (disableKeydown) { return; }
    else if(!e.metaKey || e.keyCode !== 76) { return; }

    disableKeydown = true;
    _delayTimer = setTimeout(fire, delay);
  }

  function checkCookieValue(cookieName, value) {
    return parseCookies()[cookieName] === value;
  }

  function parseCookies() {
    // cookies are separated by '; '
    var cookies = document.cookie.split('; ');

    var ret = {};
    for (var i = cookies.length - 1; i >= 0; i--) {
      var el = cookies[i].split('=');
      ret[el[0]] = el[1];
    }
    return ret;
  }

  function isDisabled() {
    return checkCookieValue(cookieName, 'true') && !aggressive;
  }

  // You can use ouibounce without passing an element
  // https://github.com/carlsednaoui/ouibounce/issues/30
  function fire() {
    if (isDisabled()) { return; }

    if (el) { el.style.display = 'block'; }

    callback();
    disable();
  }

  function disable(custom_options) {
    var options = custom_options || {};

    // you can pass a specific cookie expiration when using the OuiBounce API
    // ex: _ouiBounce.disable({ cookieExpire: 5 });
    if (typeof options.cookieExpire !== 'undefined') {
      cookieExpire = setDefaultCookieExpire(options.cookieExpire);
    }

    // you can pass use sitewide cookies too
    // ex: _ouiBounce.disable({ cookieExpire: 5, sitewide: true });
    if (options.sitewide === true) {
      sitewide = ';path=/';
    }

    // you can pass a domain string when the cookie should be read subdomain-wise
    // ex: _ouiBounce.disable({ cookieDomain: '.example.com' });
    if (typeof options.cookieDomain !== 'undefined') {
      cookieDomain = ';domain=' + options.cookieDomain;
    }

    if (typeof options.cookieName !== 'undefined') {
      cookieName = options.cookieName;
    }

    document.cookie = cookieName + '=true' + cookieExpire + cookieDomain + sitewide;

    // remove listeners
    _html.removeEventListener('mouseleave', handleMouseleave);
    _html.removeEventListener('mouseenter', handleMouseenter);
    _html.removeEventListener('keydown', handleKeydown);
  }

  return {
    fire: fire,
    disable: disable,
    isDisabled: isDisabled
  };
}
jQuery(document).ready(function(){(function(){jQuery("html").on("mouseout.ouibounce",function(){function e(){jQuery("#ouibounce-modal").modal()}return function(t){if(!(t.clientY<20))return;e();jQuery("html").off("mouseout.ouibounce")}}())})();jQuery("head").prepend('<style type="text/css">.modal-open{overflow:hidden}.modal{position:fixed;top:0;right:0;bottom:0;left:0;z-index:1040;display:none;overflow:auto;overflow-y:scroll}.modal.fade .modal-dialog{-webkit-transform:translate(0,-25%);-ms-transform:translate(0,-25%);transform:translate(0,-25%);-webkit-transition:-webkit-transform .3s ease-out;-moz-transition:-moz-transform .3s ease-out;-o-transition:-o-transform .3s ease-out;transition:transform .3s ease-out}.modal.in .modal-dialog{-webkit-transform:translate(0,0);-ms-transform:translate(0,0);transform:translate(0,0)}.modal-dialog{position:relative;z-index:1050;width:auto;margin:10px}.modal-content{position:relative;background-color:#fff;border:1px solid #999;border:1px solid rgba(0,0,0,0.2);border-radius:6px;outline:0;-webkit-box-shadow:0 3px 9px rgba(0,0,0,0.5);box-shadow:0 3px 9px rgba(0,0,0,0.5);background-clip:padding-box}.modal-backdrop{position:fixed;top:0;right:0;bottom:0;left:0;z-index:1030;background-color:#000}.modal-backdrop.fade{opacity:0;filter:alpha(opacity=0)}.modal-backdrop.in{opacity:.5;filter:alpha(opacity=50)}.modal-header{min-height:16.428571429px;padding:15px;border-bottom:1px solid #e5e5e5}.modal-header .close{margin-top:-2px}.modal-title{margin:0;line-height:1.428571429}.modal-body{position:relative;padding:20px;min-height:300px}.modal-footer{padding:19px 20px 20px;margin-top:15px;text-align:right;border-top:1px solid #e5e5e5}.modal-footer:before,.modal-footer:after{display:table;content:" "}.modal-footer:after{clear:both}.modal-footer:before,.modal-footer:after{display:table;content:" "}.modal-footer:after{clear:both}.modal-footer .btn+.btn{margin-bottom:0;margin-left:5px}.modal-footer .btn-group .btn+.btn{margin-left:-1px}.modal-footer .btn-block+.btn-block{margin-left:0}@media screen and (min-width:768px){.modal-dialog{width:600px;margin:30px auto}.modal-content{-webkit-box-shadow:0 5px 15px rgba(0,0,0,0.5);box-shadow:0 5px 15px rgba(0,0,0,0.5)}}.btn{display:inline-block;padding:6px 12px;margin-bottom:0;font-size:14px;font-weight:normal;line-height:1.428571429;text-align:center;white-space:nowrap;vertical-align:middle;cursor:pointer;background-image:none;border:1px solid transparent;border-radius:4px;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;-o-user-select:none;user-select:none}.btn-primary{color:#fff;background-color:#428bca;border-color:#357ebd}.btn-primary:hover,.btn-primary:focus,.btn-primary:active,.btn-primary.active,.open .dropdown-toggle.btn-primary{color:#fff;background-color:#3276b1;border-color:#285e8e}</style>');+function(e){"use strict";var t=function(t,n){this.options=n;this.jQueryelement=e(t);this.jQuerybackdrop=this.isShown=null;if(this.options.remote)this.jQueryelement.load(this.options.remote)};t.DEFAULTS={backdrop:true,keyboard:true,show:true};t.prototype.toggle=function(e){return this[!this.isShown?"show":"hide"](e)};t.prototype.show=function(t){var n=this;var r=e.Event("show.bs.modal",{relatedTarget:t});this.jQueryelement.trigger(r);if(this.isShown||r.isDefaultPrevented())return;this.isShown=true;this.escape();this.jQueryelement.on("click.dismiss.modal",'[data-dismiss="modal"]',e.proxy(this.hide,this));this.backdrop(function(){var r=e.support.transition&&n.jQueryelement.hasClass("fade");if(!n.jQueryelement.parent().length){n.jQueryelement.appendTo(document.body)}n.jQueryelement.show();if(r){n.jQueryelement[0].offsetWidth}n.jQueryelement.addClass("in").attr("aria-hidden",false);n.enforceFocus();var i=e.Event("shown.bs.modal",{relatedTarget:t});r?n.jQueryelement.find(".modal-dialog").one(e.support.transition.end,function(){n.jQueryelement.focus().trigger(i)}).emulateTransitionEnd(300):n.jQueryelement.focus().trigger(i)})};t.prototype.hide=function(t){if(t)t.preventDefault();t=e.Event("hide.bs.modal");this.jQueryelement.trigger(t);if(!this.isShown||t.isDefaultPrevented())return;this.isShown=false;this.escape();e(document).off("focusin.bs.modal");this.jQueryelement.removeClass("in").attr("aria-hidden",true).off("click.dismiss.modal");e.support.transition&&this.jQueryelement.hasClass("fade")?this.jQueryelement.one(e.support.transition.end,e.proxy(this.hideModal,this)).emulateTransitionEnd(300):this.hideModal()};t.prototype.enforceFocus=function(){e(document).off("focusin.bs.modal").on("focusin.bs.modal",e.proxy(function(e){if(this.jQueryelement[0]!==e.target&&!this.jQueryelement.has(e.target).length){this.jQueryelement.focus()}},this))};t.prototype.escape=function(){if(this.isShown&&this.options.keyboard){this.jQueryelement.on("keyup.dismiss.bs.modal",e.proxy(function(e){e.which==27&&this.hide()},this))}else if(!this.isShown){this.jQueryelement.off("keyup.dismiss.bs.modal")}};t.prototype.hideModal=function(){var e=this;this.jQueryelement.hide();this.backdrop(function(){e.removeBackdrop();e.jQueryelement.trigger("hidden.bs.modal")})};t.prototype.removeBackdrop=function(){this.jQuerybackdrop&&this.jQuerybackdrop.remove();this.jQuerybackdrop=null};t.prototype.backdrop=function(t){var n=this;var r=this.jQueryelement.hasClass("fade")?"fade":"";if(this.isShown&&this.options.backdrop){var i=e.support.transition&&r;this.jQuerybackdrop=e('<div class="modal-backdrop '+r+'" />').appendTo(document.body);this.jQueryelement.on("click.dismiss.modal",e.proxy(function(e){if(e.target!==e.currentTarget)return;this.options.backdrop=="static"?this.jQueryelement[0].focus.call(this.jQueryelement[0]):this.hide.call(this)},this));if(i)this.jQuerybackdrop[0].offsetWidth;this.jQuerybackdrop.addClass("in");if(!t)return;i?this.jQuerybackdrop.one(e.support.transition.end,t).emulateTransitionEnd(150):t()}else if(!this.isShown&&this.jQuerybackdrop){this.jQuerybackdrop.removeClass("in");e.support.transition&&this.jQueryelement.hasClass("fade")?this.jQuerybackdrop.one(e.support.transition.end,t).emulateTransitionEnd(150):t()}else if(t){t()}};var n=e.fn.modal;e.fn.modal=function(n,r){return this.each(function(){var i=e(this);var s=i.data("bs.modal");var o=e.extend({},t.DEFAULTS,i.data(),typeof n=="object"&&n);if(!s)i.data("bs.modal",s=new t(this,o));if(typeof n=="string")s[n](r);else if(o.show)s.show(r)})};e.fn.modal.Constructor=t;e.fn.modal.noConflict=function(){e.fn.modal=n;return this};e(document).on("click.bs.modal.data-api",'[data-toggle="modal"]',function(t){var n=e(this);var r=n.attr("href");var i=e(n.attr("data-target")||r&&r.replace(/.*(?=#[^\s]+jQuery)/,""));var s=i.data("modal")?"toggle":e.extend({remote:!/#/.test(r)&&r},i.data(),n.data());t.preventDefault();i.modal(s,this).one("hide",function(){n.is(":visible")&&n.focus()})});e(document).on("show.bs.modal",".modal",function(){e(document.body).addClass("modal-open")}).on("hidden.bs.modal",".modal",function(){e(document.body).removeClass("modal-open")})}(jQuery)});