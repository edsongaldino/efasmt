(function($) {
	$.fn.maskMoney = function(settings) {
		settings = $.extend({
			symbol: "",
			decimal: ",",
			precision: 2,
			thousands: ".",
			showSymbol:true
		}, settings);

		settings.symbol=settings.symbol+"";

		return this.each(function() {
			var input=$(this);
			function money(e) {
				e=e||window.event;
				var k=e.charCode||e.keyCode||e.which;
				if (k == 8) { // tecla backspace
					preventDefault(e);
					var x = input.val().substring(0,input.val().length-1);
					input.val(maskValue(x));
					return false;
				} else if (k == 9) { // tecla tab
					return true;
				}
				if (k < 48 || k > 57) {
					preventDefault(e);
					return true;
				}
				var key = String.fromCharCode(k);  // valor para o c�digo da Chave
				preventDefault(e);
				input.val(maskValue(input.val()+key));
			}

			function preventDefault(e) {
				if (e.preventDefault) { // standart browsers
					e.preventDefault()
				} else { // internet explorer
					e.returnValue = false
				}
			}

			function maskValue(v) {
				v = v.replace(settings.symbol,"");
				var a = '';
				var strCheck = '0123456789';
				var len = v.length;
				var t = "";
				if (len== 0) {
					t = "0.00";
				}
				for (var i = 0; i < len; i++)
					if ((v.charAt(i) != '0') && (v.charAt(i) != settings.decimal))
						break;

				for (; i < len; i++) {
					if (strCheck.indexOf(v.charAt(i))!=-1) a+= v.charAt(i);
				}

				var n = parseFloat(a);
				n = isNaN(n) ? 0 : n/Math.pow(10, settings.precision);
				t = n.toFixed(settings.precision);

				var p, d = (t=t.split("."))[1].substr(0, settings.precision);
				for (p = (t=t[0]).length; (p-=3) >= 1;) {
					t = t.substr(0,p) + settings.thousands + t.substr(p);
				}
				return setSymbol(t+settings.decimal+d+Array(
					(settings.precision+1)-d.length).join(0));
			}

			function focusEvent() {
				if (input.val()=="") {
					input.val(setSymbol(getDefaultMask()));
				} else {
					input.val(setSymbol(input.val()));
				}
			}

			function blurEvent() {
				if (input.val()==setSymbol(getDefaultMask())) {
					input.val("");
				} else {
					input.val(input.val().replace(settings.symbol,""))
				}
			}

			function getDefaultMask() {
				var n = parseFloat("0")/Math.pow(10, settings.precision);
				return (n.toFixed(settings.precision)).replace(
					new RegExp("\\.", "g"), settings.decimal);
			}

			function setSymbol(v) {
				if (settings.showSymbol) {
					return settings.symbol+v;
				}
				return v;
			}

			input.bind("keypress",money);
			input.bind("blur",blurEvent);
			input.bind("focus",focusEvent);

			input.one("unmaskMoney",function() {
				input.unbind("focus",focusEvent);
				input.unbind("blur",blurEvent);
				input.unbind("keypress",money);
				if ($.browser.msie)
				this.onpaste= null;
				else if ($.browser.mozilla)
				this.removeEventListener('input',blurEvent,false);
			});
		});
	}

	$.fn.unmaskMoney=function() {
		return this.trigger("unmaskMoney");
	};
})(jQuery);