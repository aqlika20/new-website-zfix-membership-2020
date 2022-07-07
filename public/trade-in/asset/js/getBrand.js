function setType(type) {
  let tag = "brandList";
  let itemMenu = $("#brand_list")[0];

  //Removing all the old options from item list and model list and adding only one option in one go
  $("#brand_list").empty().append("<option>Select Brand</option>");
  $("#variant_name_list").empty().append("<option>Select Variant Name</option>");
  $("#price").empty().append("<p>Pilih Type, Brand dan Variant Name untuk menampilkan Grade.</p>");

  $.ajax({
    url: "asset/php/load_data.php",
    dataType: "json",
    method: "post",
    data: { tag: tag, type: type },
    success: function (response) {
      response.forEach((item, index) => {
        // console.log(index, item);
        var option = document.createElement("option");
        option.value = item["brand"];
        option.text = item["brand"];
        itemMenu.appendChild(option);
      });
    },
  });
}
