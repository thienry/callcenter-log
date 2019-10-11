const dateNow = new Date();
const fullYear = dateNow.getFullYear();
const year = document.querySelector(".year");

year.innerText = fullYear;


//-------------
//- DONUT CHART -
//-------------
// Get context with jQuery - using jQuery's .get() method.
$(function() {
  var donutChartCanvas = $("#donutChart")
    .get(0)
    .getContext("2d");
  var donutData = {
    labels: ["Marcações Confirmadas", "Marcações Sem Resposta", "Marcações Desmarcadas"],
    datasets: [
      {
        data: [151, 7257, 15],
        backgroundColor: [
          "#28a745",
          "#ffc107",
          "#dc3545",
        ]
      }
    ]
  };
  var donutOptions = {
    maintainAspectRatio: false,
    responsive: true
  };
  //Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  var donutChart = new Chart(donutChartCanvas, {
    type: "doughnut",
    data: donutData,
    options: donutOptions
  });

  var readURL = function (input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $('.profile-pic').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  $(".file-upload").on('change', function () {
    readURL(this);
  });

  $(".upload-button").on('click', function () {
    $(".file-upload").click();
  });


  //Datemask dd/mm/yyyy
  $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
  //Datemask2 mm/dd/yyyy
  $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
  //Money Euro
  $('[data-mask]').inputmask()
 
});

document.querySelector("#file").addEventListener("change", function () {
  let file = new FileReader();
  file.onload = function () {
    document.querySelector("#image-preview").src = file.result;
  };
  file.readAsDataURL(this.files[0]);
});