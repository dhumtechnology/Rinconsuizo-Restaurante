(function (w, d) {
	'use strict';
	if (w.__rsDialogReady) {
		return;
	}
	w.__rsDialogReady = true;

	var nativeAlert = w.alert;
	var nativeConfirm = w.confirm;
	var queue = [];
	var busy = false;
	var els = null;

	function ensure() {
		if (els) {
			return els;
		}
		var root = d.createElement('div');
		root.className = 'rs-dlg-root';
		root.setAttribute('role', 'dialog');
		root.setAttribute('aria-modal', 'true');
		root.innerHTML = ''
			+ '<div class="rs-dlg-backdrop" data-rs-dlg-cancel></div>'
			+ '<div class="rs-dlg-card">'
			+ '  <div class="rs-dlg-bar"></div>'
			+ '  <div class="rs-dlg-body">'
			+ '    <div class="rs-dlg-icon" data-rs-dlg-icon>i</div>'
			+ '    <h3 class="rs-dlg-title" data-rs-dlg-title>Aviso</h3>'
			+ '    <p class="rs-dlg-text" data-rs-dlg-text></p>'
			+ '  </div>'
			+ '  <div class="rs-dlg-actions">'
			+ '    <button type="button" class="rs-dlg-btn rs-dlg-btn-cancel" data-rs-dlg-cancel>Cancelar</button>'
			+ '    <button type="button" class="rs-dlg-btn rs-dlg-btn-ok" data-rs-dlg-ok>Aceptar</button>'
			+ '  </div>'
			+ '</div>';
		d.body.appendChild(root);
		els = {
			root: root,
			icon: root.querySelector('[data-rs-dlg-icon]'),
			title: root.querySelector('[data-rs-dlg-title]'),
			text: root.querySelector('[data-rs-dlg-text]'),
			ok: root.querySelector('[data-rs-dlg-ok]'),
			cancelBtns: root.querySelectorAll('[data-rs-dlg-cancel]')
		};
		return els;
	}

	function setBusy(on) {
		busy = !!on;
		if (els) {
			els.root.classList.toggle('is-open', busy);
		}
	}

	function runNext() {
		if (busy || !queue.length) {
			return;
		}
		var job = queue.shift();
		var ui = ensure();
		var isConfirm = job.type === 'confirm';
		var isDanger = !!job.danger;
		ui.title.textContent = job.title || (isConfirm ? 'Confirmar' : 'Aviso');
		ui.text.textContent = job.message || '';
		ui.icon.textContent = isDanger || isConfirm ? '!' : 'i';
		ui.icon.className = 'rs-dlg-icon' + (isDanger || isConfirm ? ' is-warn' : '');
		ui.ok.textContent = job.okText || 'Aceptar';
		ui.ok.className = 'rs-dlg-btn rs-dlg-btn-ok' + (isDanger ? ' is-danger' : '');
		for (var i = 0; i < ui.cancelBtns.length; i++) {
			var c = ui.cancelBtns[i];
			if (c.tagName === 'BUTTON') {
				c.style.display = isConfirm ? '' : 'none';
				c.textContent = job.cancelText || 'Cancelar';
			}
		}
		setBusy(true);
		function finish(ok) {
			ui.ok.onclick = null;
			d.removeEventListener('keydown', onKey);
			for (var j = 0; j < ui.cancelBtns.length; j++) {
				ui.cancelBtns[j].onclick = null;
			}
			setBusy(false);
			if (typeof job.resolve === 'function') {
				job.resolve(!!ok);
			}
			setTimeout(runNext, 40);
		}
		function onKey(ev) {
			if (ev.key === 'Escape') {
				finish(false);
			} else if (ev.key === 'Enter') {
				finish(true);
			}
		}
		ui.ok.onclick = function () { finish(true); };
		for (var k = 0; k < ui.cancelBtns.length; k++) {
			ui.cancelBtns[k].onclick = function () { finish(!isConfirm); };
		}
		d.addEventListener('keydown', onKey);
		setTimeout(function () { ui.ok.focus(); }, 30);
	}

	function enqueue(opts) {
		return new Promise(function (resolve) {
			opts = opts || {};
			opts.resolve = resolve;
			queue.push(opts);
			if (d.body) {
				runNext();
			} else {
				d.addEventListener('DOMContentLoaded', runNext);
			}
		});
	}

	function cleanMsg(msg) {
		return String(msg == null ? '' : msg).replace(/\\n/g, '\n');
	}

	w.rsAlert = function (msg, title) {
		return enqueue({ type: 'alert', message: cleanMsg(msg), title: title || 'Aviso' });
	};
	w.rsConfirm = function (msg, title, extra) {
		extra = extra || {};
		return enqueue({
			type: 'confirm',
			message: cleanMsg(msg),
			title: title || 'Confirmar',
			danger: !!extra.danger,
			okText: extra.okText,
			cancelText: extra.cancelText
		});
	};
	w.rsAlertRedirect = function (msg, url) {
		return w.rsAlert(msg).then(function () {
			if (url) {
				w.location.href = url;
			}
		});
	};

	w.alert = function (msg) {
		if (!d.body) {
			nativeAlert(msg);
			return;
		}
		w.rsAlert(msg);
	};

	function looksConfirmOnclick(oc) {
		return /return\s+confirm\s*\(/i.test(oc || '');
	}

	function bindOnclickConfirms() {
		var nodes = d.querySelectorAll('[onclick]');
		for (var i = 0; i < nodes.length; i++) {
			(function (el) {
				var oc = el.getAttribute('onclick') || '';
				if (!looksConfirmOnclick(oc) || el.getAttribute('data-rs-dlg-bound') === '1') {
					return;
				}
				var m = oc.match(/confirm\s*\(\s*(['"])([\s\S]*?)\1\s*\)/i);
				if (!m) {
					return;
				}
				el.setAttribute('data-rs-dlg-bound', '1');
				el.removeAttribute('onclick');
				el.addEventListener('click', function (ev) {
					ev.preventDefault();
					ev.stopPropagation();
					var href = el.getAttribute('href');
					w.rsConfirm(m[2], 'Confirmar', { danger: /eliminar|cierre|cerrar/i.test(m[2]) }).then(function (ok) {
						if (!ok) {
							return;
						}
						if (href && href !== '#' && href.toLowerCase().indexOf('javascript:') !== 0) {
							w.location.href = href;
						}
					});
					return false;
				});
			})(nodes[i]);
		}
	}

	function onReady(fn) {
		if (d.readyState === 'loading') {
			d.addEventListener('DOMContentLoaded', fn);
		} else {
			fn();
		}
	}
	onReady(bindOnclickConfirms);

	w.__rsNativeAlert = nativeAlert;
	w.__rsNativeConfirm = nativeConfirm;
})(window, document);
