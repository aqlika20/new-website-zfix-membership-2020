function setBrand(brand) {
  let tag = "variantNameList";
  let modelMenu = $("#variant_name_list")[0];

  //Removing all the select options and adding only one option in one go
  $("#variant_name_list").empty().append("<option>Select Variant Name</option>");
  $("#price").empty().append("<p>Pilih Type, Brand dan Variant Name untuk menampilkan Grade.</p>");

  var type = $("#type_list").val();

  $.ajax({
    url: "asset/php/load_data.php",
    dataType: "json",
    method: "post",
    data: { tag: tag, type: type, brand: brand },
    success: function (response) {
      response.forEach((item, index) => {
        // console.log(index,item);
        var option = document.createElement("option");
        option.value = item["variant_name"];
        option.text = item["variant_name"];
        modelMenu.appendChild(option);
      });
    },
  });
}
