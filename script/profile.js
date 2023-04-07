function blogClicked(bid, event) {
  event.preventDefault();
  window.location.href = "blogTemplate.php?bid=" + bid;
}
