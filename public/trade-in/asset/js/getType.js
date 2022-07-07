$(document).ready(function () {
  let tag = "typeList";
  let select_menu = $("#type_list")[0]; // this expression is same as document.getElementById('dynamic_menu')
  $.ajax({
    url: "asset/php/load_data.php",
    dataType: "json",
    method: "post",
    data: { tag: tag },
    success: function (response) {
      // console.log(response.length);
      // console.log($.isArray(response)); // if response is an array, this function will return true

      response.forEach((item, index) => {
        // console.log(index, item);
        var option = document.createElement("option");
        option.value = item["type"];
        option.text = item["type"];
        select_menu.appendChild(option);
      });
    } 
  });
});
