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
        data: [17, 131, 3],
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

  $('.toastrDefaultSuccess').click(function () {
    toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
  });
  $('.toastrDefaultError').click(function () {
    toastr.error('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
  });
});
