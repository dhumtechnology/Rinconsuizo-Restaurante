<?php
if (!isset($rsMenuPage) || $rsMenuPage === '') {
	$rsMenuPage = 'productos.php';
}
$rsMenuPageJs = json_encode($rsMenuPage, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
?>
<script>
(function () {
  var menuPage = <?php echo $rsMenuPageJs; ?>;
  var select = document.getElementById("rs-filtro-categoria");
  if (select) {
    select.addEventListener("change", function () {
      var params = new URLSearchParams();
      if (this.value) params.set("id", this.value);
      var qInput = document.getElementById("rs-buscar-producto");
      if (qInput && qInput.value.trim()) params.set("q", qInput.value.trim());
      var qs = params.toString();
      window.location.href = menuPage + (qs ? "?" + qs : "");
    });
  }

  var input = document.getElementById("rs-buscar-producto");
  if (!input) return;
  var timer = null;
  function filtrar() {
    var q = (input.value || "").trim().toLowerCase();
    var cards = document.querySelectorAll(".ajax_block_product[data-nombre]");
    var visibles = 0;
    cards.forEach(function (card) {
      var nombre = (card.getAttribute("data-nombre") || "").toLowerCase();
      var ok = q === "" || nombre.indexOf(q) !== -1;
      card.style.display = ok ? "" : "none";
      if (ok) visibles++;
    });
    var msg = document.querySelector(".rs-search-live-msg");
    if (!msg) {
      msg = document.createElement("div");
      msg.className = "col-12 rs-search-live-msg";
      var row = document.querySelector("#js-product-list .row");
      if (row) row.insertBefore(msg, row.firstChild);
    }
    if (q !== "" && cards.length) {
      msg.innerHTML = "<p>Mostrando <strong>" + visibles + "</strong> producto(s) para &ldquo;" + q.replace(/</g, "&lt;") + "&rdquo;</p>";
      msg.style.display = "";
    } else if (msg) {
      msg.style.display = "none";
    }
  }
  input.addEventListener("input", function () {
    clearTimeout(timer);
    timer = setTimeout(filtrar, 120);
  });
  if (input.value) filtrar();
})();
</script>
