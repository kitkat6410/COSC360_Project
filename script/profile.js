function blogClicked(bid, event) {
  event.preventDefault();
  console.log(bid);
  window.location.href = "blogTemplate.php?bid=" + bid;
}
