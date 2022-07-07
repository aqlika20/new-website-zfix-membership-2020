function setBrand(brand) {
  let tag = "variantNameList";
  let itemMenu = $("#variant_name_list")[0];

  //Removing all the old options from item list and model list and adding only one option in one go
  $("#variant_name_list").empty().append("<option>Select Variant Name</option>");
  $("#price").empty().append("<p>Pilih Brand dan Variant Name untuk menampilkan Grade.</p>");

  $.ajax({
    url: "asset/php/load_data.php",
    dataType: "json",
    method: "post",
    data: { tag: tag, brand: brand },
    success: function (response) {
      response.forEach((item, index) => {
        // console.log(index, item);
        var option = document.createElement("option");
        option.value = item["variant_name"];
        option.text = item["variant_name"];
        itemMenu.appendChild(option);
      });
    },
  });
}
