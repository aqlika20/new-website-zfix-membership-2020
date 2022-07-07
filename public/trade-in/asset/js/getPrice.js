function setVariantName(variant_name) {
  let tag = "priceList";

  //Removing all the select options and adding only one option in one go
  $("#price").empty().append("<p>Pilih Type, Brand dan Variant Name untuk menampilkan Grade.</p>");

  $.ajax({
    url: "asset/php/load_data.php",
    dataType: "json",
    method: "post",
    data: { tag: tag, variant_name: variant_name },
    success: function (response) {
      // console.log(response);
      if (response[0]) {
        text = "<div class='row'>";
        text += "<div class='col'><p>Grade A : <br> Rp. " + response[0]["grade_a"].replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + "</p></div>";
        text += "<div class='col'><p>Grade B : <br> Rp. " + response[0]["grade_b"].replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + "</p></div>";
        text += "<div class='col'><p>Grade C : <br> Rp. " + response[0]["grade_c"].replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + "</p></div>";
        text += "</div>";
        // texts += "Grade C : Rp." + response[0]["grade_c"];
        $("#price").html(text);
        // console.log("ini change");
      }
      else {
        text = "Pilih Type, Brand dan Variant Name untuk menampilkan Grade.";
      }
    }
  });
}
